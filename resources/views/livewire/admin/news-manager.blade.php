<div class="space-y-6">
    @section('title', 'News & Events - Admin Panel')
    @section('page_title', 'News & Events')
    <x-admin.page-header 
        title="News & Events Management" 
        description="Create, edit, and manage news articles and upcoming events." 
        module="Content" 
        actionText="Add News/Event" 
        actionMethod="create" 
        actionPermission="create news"
    />

    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">
        <x-admin.stat-card 
            title="Total Items" 
            value="{{ $newsEvents->total() }}" 
            icon="<svg class='h-6 w-6' fill='none' viewBox='0 0 24 24' stroke='currentColor'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10' /></svg>"
            color="teal"
        />
        <x-admin.stat-card 
            title="Published" 
            value="{{ $publishedCount }}" 
            icon="<svg class='h-6 w-6' fill='none' viewBox='0 0 24 24' stroke='currentColor'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z' /></svg>"
            color="emerald"
        />
        <x-admin.stat-card 
            title="News Articles" 
            value="{{ $totalNews }}" 
            icon="<svg class='h-6 w-6' fill='none' viewBox='0 0 24 24' stroke='currentColor'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z' /></svg>"
            color="sky"
        />
        <x-admin.stat-card 
            title="Events" 
            value="{{ $totalEvents }}" 
            icon="<svg class='h-6 w-6' fill='none' viewBox='0 0 24 24' stroke='currentColor'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z' /></svg>"
            color="indigo"
        />
    </div>

    <!-- Filters and Data Table Container -->
    <div class="rounded-3xl border border-slate-700/60 bg-slate-900/70 p-6 shadow-2xl shadow-slate-950/20 backdrop-blur-xl">
        <!-- Toolbar -->
        <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div class="relative max-w-md w-full">
                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4">
                    <svg class="h-5 w-5 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
                <input 
                    type="text" 
                    wire:model.live.debounce.300ms="search"
                    class="block w-full rounded-2xl border border-slate-700/50 bg-slate-950/50 py-3 pl-11 pr-4 text-sm text-white placeholder-slate-500 shadow-inner focus:border-teal-500 focus:outline-none focus:ring-1 focus:ring-teal-500" 
                    placeholder="Search news or events..."
                >
            </div>
        </div>

        <x-admin.data-table>
            <x-slot name="head">
                <tr>
                    <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-slate-400 uppercase tracking-wider cursor-pointer" wire:click="sortBy('title')">
                        <div class="flex items-center gap-2">
                            Title
                            @if($sortField === 'title')
                                <span>{!! $sortDirection === 'asc' ? '&#8593;' : '&#8595;' !!}</span>
                            @endif
                        </div>
                    </th>
                    <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-slate-400 uppercase tracking-wider cursor-pointer" wire:click="sortBy('type')">
                        <div class="flex items-center gap-2">
                            Type
                            @if($sortField === 'type')
                                <span>{!! $sortDirection === 'asc' ? '&#8593;' : '&#8595;' !!}</span>
                            @endif
                        </div>
                    </th>
                    <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-slate-400 uppercase tracking-wider cursor-pointer" wire:click="sortBy('created_at')">
                        <div class="flex items-center gap-2">
                            Date
                            @if($sortField === 'created_at')
                                <span>{!! $sortDirection === 'asc' ? '&#8593;' : '&#8595;' !!}</span>
                            @endif
                        </div>
                    </th>
                    <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-slate-400 uppercase tracking-wider">
                        Status
                    </th>
                    <th scope="col" class="px-6 py-4 text-right text-xs font-semibold text-slate-400 uppercase tracking-wider">
                        Actions
                    </th>
                </tr>
            </x-slot>
            
            <x-slot name="body">
                @forelse($newsEvents as $item)
                    <tr class="group transition-colors hover:bg-slate-800/40">
                        <td class="whitespace-nowrap px-6 py-4">
                            <div class="flex items-center gap-4">
                                @if($item->image)
                                    <img src="{{ Storage::url($item->image) }}" class="h-10 w-10 rounded-lg object-cover bg-slate-800" alt="{{ $item->title }}" />
                                @else
                                    <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-slate-800 text-slate-500">
                                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                @endif
                                <div>
                                    <div class="text-sm font-semibold text-white">{{ $item->title }}</div>
                                    <div class="text-xs text-slate-500 truncate max-w-xs">{{ $item->excerpt ?? Str::limit(strip_tags($item->body), 50) }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="whitespace-nowrap px-6 py-4">
                            <span class="inline-flex items-center rounded-md px-2 py-1 text-xs font-medium ring-1 ring-inset {{ $item->type === 'news' ? 'bg-sky-400/10 text-sky-400 ring-sky-400/20' : 'bg-indigo-400/10 text-indigo-400 ring-indigo-400/20' }}">
                                {{ ucfirst($item->type) }}
                            </span>
                        </td>
                        <td class="whitespace-nowrap px-6 py-4 text-sm text-slate-300">
                            @if($item->type === 'event' && $item->event_date)
                                <div class="font-medium text-indigo-300">{{ $item->event_date->format('M d, Y') }}</div>
                                <div class="text-xs text-slate-500">Event Date</div>
                            @else
                                <div class="font-medium text-slate-300">{{ $item->created_at->format('M d, Y') }}</div>
                                <div class="text-xs text-slate-500">Created At</div>
                            @endif
                        </td>
                        <td class="whitespace-nowrap px-6 py-4">
                            @can('edit news')
                            <button 
                                wire:click="togglePublish({{ $item->id }})"
                                class="inline-flex items-center rounded-md px-2 py-1 text-xs font-medium ring-1 ring-inset transition-colors {{ $item->is_published ? 'bg-emerald-400/10 text-emerald-400 ring-emerald-400/20 hover:bg-emerald-400/20' : 'bg-slate-400/10 text-slate-400 ring-slate-400/20 hover:bg-slate-400/20' }}"
                            >
                                {{ $item->is_published ? 'Published' : 'Draft' }}
                            </button>
                            @else
                            <span class="inline-flex items-center rounded-md px-2 py-1 text-xs font-medium ring-1 ring-inset {{ $item->is_published ? 'bg-emerald-400/10 text-emerald-400 ring-emerald-400/20' : 'bg-slate-400/10 text-slate-400 ring-slate-400/20' }}">
                                {{ $item->is_published ? 'Published' : 'Draft' }}
                            </span>
                            @endcan
                        </td>
                        <td class="whitespace-nowrap px-6 py-4 text-right text-sm font-medium">
                            <div class="flex items-center justify-end gap-3">
                                @can('edit news')
                                <button wire:click="edit({{ $item->id }})" class="text-slate-400 transition-colors hover:text-teal-400">
                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </button>
                                @endcan
                                @can('delete news')
                                <button wire:click="confirmDelete({{ $item->id }})" class="text-slate-400 transition-colors hover:text-rose-400">
                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                                @endcan
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center">
                            <div class="inline-flex h-12 w-12 items-center justify-center rounded-full bg-slate-800/50 text-slate-500 mb-4">
                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                                </svg>
                            </div>
                            <h3 class="text-sm font-semibold text-white">No items found</h3>
                            <p class="mt-1 text-sm text-slate-500">Try adjusting your search criteria or add a new item.</p>
                        </td>
                    </tr>
                @endforelse
            </x-slot>
        </x-admin.data-table>

        <div class="mt-6">
            {{ $newsEvents->links(data: ['scrollTo' => false]) }}
        </div>
    </div>

    <!-- Add/Edit Modal -->
    <x-admin.modal model="isModalOpen" maxWidth="3xl" :showFooter="false" :plain="true">
        <div class="border-b border-slate-700/60 bg-slate-900/50 px-6 py-4">
            <h3 class="text-lg font-bold text-white">
                {{ $editId ? 'Edit Item' : 'Add New Item' }}
            </h3>
        </div>

        <div class="p-6">
            <form wire:submit="save" class="space-y-6">
                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                    <x-admin.form-group label="Title" name="title" required>
                        <input type="text" wire:model="title" id="title" class="block w-full rounded-xl border border-slate-700/50 bg-slate-950/50 py-2.5 px-4 text-sm text-white placeholder-slate-500 focus:border-teal-500 focus:outline-none focus:ring-1 focus:ring-teal-500" placeholder="Enter title" />
                    </x-admin.form-group>

                    <x-admin.form-group label="Type" name="type" required>
                        <select wire:model.live="type" id="type" class="block w-full rounded-xl border border-slate-700/50 bg-slate-950/50 py-2.5 px-4 text-sm text-white focus:border-teal-500 focus:outline-none focus:ring-1 focus:ring-teal-500">
                            <option value="news">News</option>
                            <option value="event">Event</option>
                        </select>
                    </x-admin.form-group>

                    @if($type === 'event')
                    <x-admin.form-group label="Event Date" name="event_date">
                        <input type="date" wire:model="event_date" id="event_date" class="block w-full rounded-xl border border-slate-700/50 bg-slate-950/50 py-2.5 px-4 text-sm text-white placeholder-slate-500 focus:border-teal-500 focus:outline-none focus:ring-1 focus:ring-teal-500 [color-scheme:dark]" />
                    </x-admin.form-group>
                    @endif
                    
                    <x-admin.form-group label="Status" name="is_published">
                        <label class="relative inline-flex items-center cursor-pointer mt-2">
                            <input type="checkbox" wire:model="is_published" class="sr-only peer">
                            <div class="w-11 h-6 bg-slate-700 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-teal-500"></div>
                            <span class="ml-3 text-sm font-medium text-slate-300">Published</span>
                        </label>
                    </x-admin.form-group>
                </div>
                
                <x-admin.form-group label="Excerpt" name="excerpt">
                    <textarea wire:model="excerpt" id="excerpt" rows="2" class="block w-full rounded-xl border border-slate-700/50 bg-slate-950/50 py-2.5 px-4 text-sm text-white placeholder-slate-500 focus:border-teal-500 focus:outline-none focus:ring-1 focus:ring-teal-500" placeholder="Brief summary..."></textarea>
                </x-admin.form-group>

                <x-admin.form-group label="Content" name="body" required>
                    <textarea wire:model="body" id="body" rows="6" class="block w-full rounded-xl border border-slate-700/50 bg-slate-950/50 py-2.5 px-4 text-sm text-white placeholder-slate-500 focus:border-teal-500 focus:outline-none focus:ring-1 focus:ring-teal-500" placeholder="Full content here..."></textarea>
                </x-admin.form-group>
                
                <x-admin.form-group label="Featured Image" name="newImage">
                    <div class="flex items-start gap-4">
                        @if ($newImage)
                            <img src="{{ $newImage->temporaryUrl() }}" class="h-20 w-20 rounded-lg object-cover border border-slate-700" alt="New Image Preview">
                        @elseif ($image)
                            <img src="{{ Storage::url($image) }}" class="h-20 w-20 rounded-lg object-cover border border-slate-700" alt="Current Image">
                        @endif
                        
                        <div class="flex-1">
                            <input type="file" wire:model="newImage" id="newImage-{{ $editId ?? 'new' }}" class="block w-full text-sm text-slate-400 file:mr-4 file:rounded-full file:border-0 file:bg-teal-500/10 file:py-2 file:px-4 file:text-sm file:font-semibold file:text-teal-400 hover:file:bg-teal-500/20" accept="image/*" />
                            <p class="mt-1 text-xs text-slate-500">Max size: 2MB. Recommended format: JPG, PNG.</p>
                        </div>
                    </div>
                </x-admin.form-group>

                <div class="mt-8 flex items-center justify-end gap-3 border-t border-slate-700/60 pt-6">
                    <button type="button" wire:click="closeModal" class="rounded-xl border border-slate-600 bg-transparent px-5 py-2.5 text-sm font-semibold text-slate-300 hover:bg-slate-800 focus:outline-none focus:ring-2 focus:ring-slate-500 focus:ring-offset-2 focus:ring-offset-slate-900 transition-all">
                        Cancel
                    </button>
                    <button type="submit" class="inline-flex items-center justify-center gap-2 rounded-xl bg-gradient-to-r from-teal-500 to-cyan-500 px-5 py-2.5 text-sm font-bold text-white shadow-lg shadow-teal-500/20 transition hover:-translate-y-0.5 hover:shadow-xl hover:shadow-teal-500/25 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:ring-offset-2 focus:ring-offset-slate-900">
                        <svg wire:loading wire:target="save" class="mr-2 h-4 w-4 animate-spin" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        {{ $editId ? 'Save Changes' : 'Create Item' }}
                    </button>
                </div>
            </form>
        </div>
    </x-admin.modal>
</div>
