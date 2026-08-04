<?php

namespace App\Livewire\Admin\Ui;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class MediaPickerModal extends Component
{
    use WithFileUploads;

    public $isOpen = false;
    public $targetEvent = '';
    public $targetParams = [];
    
    public $viewMode = 'folder'; // 'folder' or 'all'
    public $currentFolder = ''; // '' for root, 'public_images/...' or 'uploads/...'
    
    public $directories = [];
    public $images = []; // files
    public $upload;

    protected $listeners = ['open-media-picker' => 'openModal'];

    public function openModal($targetEvent, $params = [])
    {
        abort_if(!auth()->user()->can('manage media'), 403);
        $this->targetEvent = $targetEvent;
        $this->targetParams = is_array($params) ? $params : [$params];
        $this->loadMedia();
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
        $this->reset(['upload', 'targetEvent', 'targetParams']);
    }

    public function setViewMode($mode)
    {
        $this->viewMode = $mode;
        if ($mode === 'all') {
            $this->currentFolder = '';
        }
        $this->loadMedia();
    }

    public function openFolder($folderPath)
    {
        $this->currentFolder = $folderPath;
        $this->viewMode = 'folder';
        $this->loadMedia();
    }

    public function navigateUp()
    {
        if (empty($this->currentFolder)) return;
        
        $parts = explode('/', $this->currentFolder);
        array_pop($parts);
        $this->currentFolder = implode('/', $parts);
        $this->loadMedia();
    }

    public function loadMedia()
    {
        $this->directories = [];
        $this->images = [];
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp', 'svg'];

        if ($this->viewMode === 'all') {
            // Load all files from both disks recursively
            $storageFiles = Storage::disk('public')->allFiles();
            foreach ($storageFiles as $file) {
                if (in_array(strtolower(pathinfo($file, PATHINFO_EXTENSION)), $allowedExtensions)) {
                    $this->images[] = [
                        'url' => '/storage/' . $file,
                        'name' => basename($file),
                        'path' => $file,
                    ];
                }
            }

            $publicImagesPath = public_path('images');
            if (File::exists($publicImagesPath)) {
                $publicFiles = File::allFiles($publicImagesPath);
                foreach ($publicFiles as $file) {
                    if (in_array(strtolower($file->getExtension()), $allowedExtensions)) {
                        $relativePath = str_replace(public_path() . DIRECTORY_SEPARATOR, '', $file->getPathname());
                        $relativePath = str_replace('\\', '/', $relativePath);
                        $this->images[] = [
                            'url' => '/' . $relativePath,
                            'name' => $file->getFilename(),
                            'path' => $relativePath,
                        ];
                    }
                }
            }
        } else {
            // Folder mode
            if (empty($this->currentFolder)) {
                // Root view: show the two main virtual folders
                $this->directories = [
                    ['path' => 'public_images', 'name' => 'Public Images', 'icon' => 'folder-public'],
                    ['path' => 'uploads', 'name' => 'Uploads', 'icon' => 'folder-upload']
                ];
            } else {
                // We are inside a virtual folder
                $isPublicImages = str_starts_with($this->currentFolder, 'public_images');
                $isUploads = str_starts_with($this->currentFolder, 'uploads');
                
                // Get the real relative path inside the disk/folder
                $relativePath = '';
                if ($isPublicImages) {
                    $relativePath = substr($this->currentFolder, strlen('public_images'));
                } elseif ($isUploads) {
                    $relativePath = substr($this->currentFolder, strlen('uploads'));
                }
                $relativePath = ltrim($relativePath, '/');

                if ($isUploads) {
                    // Use Storage Facade
                    $dirs = Storage::disk('public')->directories($relativePath);
                    foreach ($dirs as $dir) {
                        $this->directories[] = [
                            'path' => 'uploads/' . $dir,
                            'name' => basename($dir),
                            'icon' => 'folder'
                        ];
                    }

                    $files = Storage::disk('public')->files($relativePath);
                    foreach ($files as $file) {
                        if (in_array(strtolower(pathinfo($file, PATHINFO_EXTENSION)), $allowedExtensions)) {
                            $this->images[] = [
                                'url' => '/storage/' . $file,
                                'name' => basename($file),
                                'path' => $file,
                            ];
                        }
                    }
                } elseif ($isPublicImages) {
                    // Use File Facade
                    $basePath = public_path('images');
                    $currentRealPath = empty($relativePath) ? $basePath : $basePath . DIRECTORY_SEPARATOR . str_replace('/', DIRECTORY_SEPARATOR, $relativePath);
                    
                    if (File::exists($currentRealPath)) {
                        $dirs = File::directories($currentRealPath);
                        foreach ($dirs as $dir) {
                            $dirName = basename($dir);
                            $this->directories[] = [
                                'path' => $this->currentFolder . '/' . $dirName,
                                'name' => $dirName,
                                'icon' => 'folder'
                            ];
                        }

                        $files = File::files($currentRealPath);
                        foreach ($files as $file) {
                            if (in_array(strtolower($file->getExtension()), $allowedExtensions)) {
                                $fileRelativePath = str_replace(public_path() . DIRECTORY_SEPARATOR, '', $file->getPathname());
                                $fileRelativePath = str_replace('\\', '/', $fileRelativePath);
                                $this->images[] = [
                                    'url' => '/' . $fileRelativePath,
                                    'name' => $file->getFilename(),
                                    'path' => $fileRelativePath,
                                ];
                            }
                        }
                    }
                }
            }
        }

        // Sort directories and images by name
        usort($this->directories, fn($a, $b) => strcasecmp($a['name'], $b['name']));
        usort($this->images, fn($a, $b) => strcasecmp($a['name'], $b['name']));
    }

    public function getBreadcrumbsProperty()
    {
        if (empty($this->currentFolder) || $this->viewMode === 'all') return [];

        $parts = explode('/', $this->currentFolder);
        $breadcrumbs = [];
        $currentPath = '';

        foreach ($parts as $index => $part) {
            $currentPath .= ($index === 0 ? '' : '/') . $part;
            $name = $part;
            
            if ($index === 0) {
                if ($part === 'public_images') $name = 'Public Images';
                if ($part === 'uploads') $name = 'Uploads';
            }

            $breadcrumbs[] = [
                'name' => $name,
                'path' => $currentPath
            ];
        }

        return $breadcrumbs;
    }

    public function updatedUpload()
    {
        abort_if(!auth()->user()->can('manage media'), 403);
        $this->validate([
            'upload' => 'image|max:5120', // 5MB max
        ]);

        if ($this->viewMode === 'folder') {
            if (str_starts_with($this->currentFolder, 'public_images')) {
                $relativePath = substr($this->currentFolder, strlen('public_images'));
                $relativePath = ltrim($relativePath, '/');
                
                $basePath = public_path('images');
                $targetDir = empty($relativePath) ? $basePath : $basePath . DIRECTORY_SEPARATOR . str_replace('/', DIRECTORY_SEPARATOR, $relativePath);
                
                if (!File::exists($targetDir)) {
                    File::makeDirectory($targetDir, 0755, true);
                }
                
                $filename = time() . '_' . $this->upload->getClientOriginalName();
                // Move the file directly to the public/images directory
                File::copy($this->upload->getRealPath(), $targetDir . DIRECTORY_SEPARATOR . $filename);
                
            } else {
                $uploadPath = 'media'; // Default fallback
                if (str_starts_with($this->currentFolder, 'uploads')) {
                    $relativePath = substr($this->currentFolder, strlen('uploads'));
                    $relativePath = ltrim($relativePath, '/');
                    $uploadPath = empty($relativePath) ? '' : $relativePath;
                }
                $this->upload->store($uploadPath, 'public');
            }
        } else {
            $this->upload->store('media', 'public');
        }
        
        $this->loadMedia();
        
        $this->dispatch('notify', message: 'Image uploaded successfully!', type: 'success');
    }

    public function selectImage($url)
    {
        $this->dispatch($this->targetEvent, url: $url, params: $this->targetParams);
        $this->closeModal();
    }

    public function render()
    {
        return view('livewire.admin.ui.media-picker-modal');
    }
}
