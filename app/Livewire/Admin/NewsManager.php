<?php

namespace App\Livewire\Admin;

use App\Models\NewsEvent;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Livewire\Attributes\On;
use Livewire\Attributes\Rule;

class NewsManager extends Component
{
    use WithPagination, WithFileUploads;

    public function mount()
    {
        abort_if(!auth()->user()->can('view news'), 403);
    }

    public $search = '';
    public $sortField = 'created_at';
    public $sortDirection = 'desc';

    public $isModalOpen = false;
    public $editId = null;

    #[Rule('required|string|max:255')]
    public $title = '';

    #[Rule('required|in:news,event')]
    public $type = 'news';

    #[Rule('nullable|string')]
    public $excerpt = '';

    #[Rule('required|string')]
    public $body = '';

    #[Rule('nullable|date')]
    public $event_date = null;

    public $image = null; // Existing image path

    #[Rule('nullable|image|max:2048')]
    public $newImage = null; // Uploaded new image

    #[Rule('boolean')]
    public $is_published = false;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
            $this->sortField = $field;
        }
    }

    public function create()
    {
        abort_if(!auth()->user()->can('create news'), 403);

        $this->resetInputFields();
        $this->isModalOpen = true;
    }

    public function edit($id)
    {
        abort_if(!auth()->user()->can('edit news'), 403);

        $this->resetInputFields();
        $news = NewsEvent::findOrFail($id);
        
        $this->editId = $id;
        $this->title = $news->title;
        $this->type = $news->type;
        $this->excerpt = $news->excerpt;
        $this->body = $news->body;
        $this->event_date = $news->event_date ? $news->event_date->format('Y-m-d') : null;
        $this->image = $news->image;
        $this->is_published = $news->is_published;

        $this->isModalOpen = true;
    }

    public function save()
    {
        abort_if(!auth()->user()->can($this->editId ? 'edit news' : 'create news'), 403);

        $this->validate();

        $data = [
            'title' => $this->title,
            'slug' => Str::slug($this->title),
            'type' => $this->type,
            'excerpt' => $this->excerpt,
            'body' => $this->body,
            'event_date' => $this->event_date ?: null,
            'is_published' => $this->is_published,
        ];

        if ($this->newImage) {
            $data['image'] = $this->newImage->store('news-images', 'public');
        }

        if ($this->editId) {
            NewsEvent::findOrFail($this->editId)->update($data);
            $this->dispatch('notify', message: 'News/Event updated successfully.', type: 'success');
        } else {
            NewsEvent::create($data);
            $this->dispatch('notify', message: 'News/Event created successfully.', type: 'success');
        }

        $this->closeModal();
    }

    public function confirmDelete($id)
    {
        abort_if(!auth()->user()->can('delete news'), 403);

        $this->dispatch('confirm-action',
            title: 'Delete News/Event',
            message: 'Are you sure you want to delete this item? This action cannot be undone.',
            action: 'deleteConfirmed',
            params: [$id]
        );
    }

    #[On('deleteConfirmed')]
    public function delete($id)
    {
        abort_if(!auth()->user()->can('delete news'), 403);

        NewsEvent::findOrFail($id)->delete();
        $this->dispatch('notify', message: 'News/Event deleted successfully.', type: 'success');
    }

    public function togglePublish($id)
    {
        abort_if(!auth()->user()->can('edit news'), 403);

        $news = NewsEvent::findOrFail($id);
        $news->update(['is_published' => !$news->is_published]);
        $this->dispatch('notify', message: 'Publish status updated successfully.', type: 'success');
    }

    public function closeModal()
    {
        $this->isModalOpen = false;
        $this->resetInputFields();
    }

    private function resetInputFields()
    {
        $this->editId = null;
        $this->title = '';
        $this->type = 'news';
        $this->excerpt = '';
        $this->body = '';
        $this->event_date = null;
        $this->image = null;
        $this->newImage = null;
        $this->is_published = false;
        $this->resetValidation();
    }

    public function render()
    {
        $newsEvents = NewsEvent::where('title', 'like', '%' . $this->search . '%')
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate(10);
            
        $totalNews = NewsEvent::where('type', 'news')->count();
        $totalEvents = NewsEvent::where('type', 'event')->count();
        $publishedCount = NewsEvent::published()->count();

        return view('livewire.admin.news-manager', [
            'newsEvents' => $newsEvents,
            'totalNews' => $totalNews,
            'totalEvents' => $totalEvents,
            'publishedCount' => $publishedCount,
        ])->layout('layouts.admin');
    }
}
