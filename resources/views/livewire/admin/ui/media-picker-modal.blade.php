<div>
    <div x-data="{ open: @entangle('isOpen') }" 
         x-show="open" 
         class="relative z-[100]" 
         aria-labelledby="modal-title" 
         role="dialog" 
         aria-modal="true" 
         style="display: none;">
        
        <div x-show="open" 
             x-transition:enter="ease-out duration-300" 
             x-transition:enter-start="opacity-0" 
             x-transition:enter-end="opacity-100" 
             x-transition:leave="ease-in duration-200" 
             x-transition:leave-start="opacity-100" 
             x-transition:leave-end="opacity-0" 
             class="fixed inset-0 bg-slate-950/80 backdrop-blur-sm transition-opacity"></div>

        <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <div x-show="open" 
                     x-transition:enter="ease-out duration-300" 
                     x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" 
                     x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" 
                     x-transition:leave="ease-in duration-200" 
                     x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" 
                     x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" 
                     @click.away="open = false; $wire.closeModal()"
                     class="relative transform overflow-hidden rounded-3xl bg-slate-900 border border-slate-700 text-left shadow-2xl transition-all sm:my-8 sm:w-full sm:max-w-6xl flex flex-col max-h-[85vh]">
                    
                    <!-- Header -->
                    <div class="flex-none bg-slate-900 px-6 py-4 border-b border-slate-800 flex items-center justify-between">
                        <div>
                            <h3 class="text-lg font-bold text-white" id="modal-title">Media Library</h3>
                            <p class="text-sm text-slate-400 mt-1">Select an image from the server or upload a new one.</p>
                        </div>
                        <div class="flex items-center gap-4">
                            <!-- View Toggle -->
                            <div class="flex bg-slate-950/50 p-1 rounded-xl border border-slate-800">
                                <button type="button" wire:click="setViewMode('folder')" class="px-4 py-1.5 text-xs font-semibold rounded-lg transition-colors {{ $viewMode === 'folder' ? 'bg-slate-800 text-teal-400' : 'text-slate-500 hover:text-slate-300 hover:bg-slate-800/50' }}">
                                    Folders
                                </button>
                                <button type="button" wire:click="setViewMode('all')" class="px-4 py-1.5 text-xs font-semibold rounded-lg transition-colors {{ $viewMode === 'all' ? 'bg-slate-800 text-teal-400' : 'text-slate-500 hover:text-slate-300 hover:bg-slate-800/50' }}">
                                    Show All
                                </button>
                            </div>
                            
                            <button type="button" wire:click="closeModal" class="text-slate-400 hover:text-white transition bg-slate-800/50 hover:bg-slate-700 p-2 rounded-xl">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Breadcrumbs (Only show in folder mode) -->
                    @if($viewMode === 'folder')
                    <div class="flex-none bg-slate-950/80 px-6 py-3 border-b border-slate-800/50 flex items-center gap-2 text-sm font-medium">
                        <button type="button" wire:click="openFolder('')" class="{{ empty($currentFolder) ? 'text-white font-bold' : 'text-slate-400 hover:text-teal-400' }} transition">
                            <svg class="h-5 w-5 inline-block -mt-0.5 mr-1" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" /></svg>
                            Home
                        </button>
                        
                        @foreach($this->breadcrumbs as $crumb)
                            <svg class="h-4 w-4 text-slate-600" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" /></svg>
                            <button type="button" wire:click="openFolder('{{ $crumb['path'] }}')" class="{{ $loop->last ? 'text-white font-bold' : 'text-slate-400 hover:text-teal-400' }} transition">
                                {{ $crumb['name'] }}
                            </button>
                        @endforeach
                    </div>
                    @endif

                    <!-- Body -->
                    <div class="flex-1 overflow-hidden flex flex-col bg-slate-950/50 p-6">
                        
                        <!-- Upload Section -->
                        <div class="mb-6 flex-none">
                            <div class="flex items-center justify-center w-full">
                                <label for="dropzone-file" class="flex flex-col items-center justify-center w-full h-28 border-2 border-slate-700 border-dashed rounded-2xl cursor-pointer bg-slate-900/50 hover:bg-slate-800/50 hover:border-teal-500/50 transition relative overflow-hidden group">
                                    <div wire:loading.remove wire:target="upload" class="flex flex-col items-center justify-center pt-5 pb-6">
                                        <svg class="w-6 h-6 mb-2 text-slate-400 group-hover:text-teal-400 transition" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" /></svg>
                                        <p class="mb-1 text-sm text-slate-300"><span class="font-bold">Click to upload</span> or drag and drop</p>
                                        <p class="text-xs text-slate-500">
                                            @if($viewMode === 'folder' && !empty($currentFolder))
                                                Uploading to: <strong class="text-slate-300">{{ $currentFolder }}</strong>
                                            @elseif(empty($currentFolder))
                                                Uploading to: <strong class="text-slate-300">Uploads (Root)</strong>
                                            @endif
                                        </p>
                                    </div>
                                    <div wire:loading wire:target="upload" class="flex flex-col items-center justify-center pt-5 pb-6">
                                        <svg class="h-6 w-6 animate-spin text-teal-500 mb-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                                        <p class="text-sm font-semibold text-teal-400">Uploading...</p>
                                    </div>
                                    <input id="dropzone-file" type="file" wire:model="upload" class="hidden" accept="image/*" />
                                </label>
                            </div>
                            @error('upload') <p class="mt-2 text-xs text-rose-400">{{ $message }}</p> @enderror
                        </div>

                        <!-- Gallery Section -->
                        <div class="flex-1 overflow-y-auto custom-scrollbar pr-2 pb-10">
                            
                            @if(count($directories) > 0 || count($images) > 0)
                                <div class="grid grid-cols-3 sm:grid-cols-4 md:grid-cols-5 lg:grid-cols-6 gap-4">
                                    
                                    <!-- Folders -->
                                    @foreach($directories as $dir)
                                        <div wire:click="openFolder('{{ $dir['path'] }}')" class="group flex flex-col items-center justify-center gap-3 p-4 rounded-xl bg-slate-900 border border-slate-800 hover:border-teal-500 hover:bg-slate-800/80 cursor-pointer transition-all aspect-square">
                                            @if(($dir['icon'] ?? 'folder') === 'folder-public')
                                                <svg class="w-12 h-12 text-blue-400 group-hover:scale-110 transition-transform" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" /></svg>
                                            @elseif(($dir['icon'] ?? 'folder') === 'folder-upload')
                                                <svg class="w-12 h-12 text-teal-400 group-hover:scale-110 transition-transform" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 16.5V9.75m0 0l3 3m-3-3l-3 3M6.75 19.5a4.5 4.5 0 01-1.41-8.775 5.25 5.25 0 0110.233-2.33 3 3 0 013.758 3.848A3.752 3.752 0 0118 19.5H6.75z" /></svg>
                                            @else
                                                <svg class="w-12 h-12 text-slate-400 group-hover:text-amber-400 group-hover:scale-110 transition-transform" fill="currentColor" viewBox="0 0 24 24"><path d="M19 5h-7l-2-2H4c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h15c1.1 0 2-.9 2-2V7c0-1.1-.9-2-2-2z"/></svg>
                                            @endif
                                            <p class="text-xs font-bold text-slate-300 text-center px-2 line-clamp-2">{{ $dir['name'] }}</p>
                                        </div>
                                    @endforeach

                                    <!-- Images -->
                                    @foreach($images as $image)
                                        <div wire:click="selectImage('{{ $image['url'] }}')" 
                                             class="group relative aspect-square rounded-xl bg-slate-900 border border-slate-800 overflow-hidden cursor-pointer hover:border-teal-500 hover:ring-2 hover:ring-teal-500/50 transition-all">
                                            
                                            <!-- Checkerboard background for transparent images (like SVGs/PNGs) -->
                                            <div class="absolute inset-0 bg-[url('data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAoAAAAKCAYAAACNMs+9AAAAHElEQVQYV2N89+7dfwYcYPv27fTzQ14U49P0AAAAAElFTkSuQmCC')] opacity-20"></div>
                                            
                                            <img src="{{ asset($image['url']) }}" alt="{{ $image['name'] }}" loading="lazy" class="absolute inset-0 w-full h-full object-contain p-2 group-hover:scale-110 transition-transform duration-300">
                                            
                                            <div class="absolute inset-x-0 bottom-0 bg-slate-950/80 backdrop-blur-sm p-2 translate-y-full group-hover:translate-y-0 transition-transform flex flex-col gap-1">
                                                <p class="text-[10px] text-white font-medium truncate text-center" title="{{ $image['name'] }}">
                                                    {{ $image['name'] }}
                                                </p>
                                                @if($viewMode === 'all')
                                                    <p class="text-[9px] text-slate-400 truncate text-center leading-tight">
                                                        {{ $image['path'] }}
                                                    </p>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="flex flex-col items-center justify-center py-16 text-slate-500">
                                    <svg class="w-12 h-12 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                                    <p>This folder is empty.</p>
                                </div>
                            @endif
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
