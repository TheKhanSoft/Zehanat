<div>
    @section('title', 'Homepage Builder - Admin Panel')
    @section('page_title', 'Homepage Builder')

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>
    @endpush

    <div class="space-y-6"
        x-data="{
            init() {
                window.addEventListener('open-modal', event => {
                    if(window.openModal) window.openModal(event.detail.id);
                });
                window.addEventListener('close-modal', event => {
                    if(window.closeModal) window.closeModal(event.detail.id);
                });
                document.addEventListener('modal:confirm', event => {
                    if (event.detail.modalId === 'sectionEditorModal') {
                        @this.saveSection();
                    } else if (event.detail.modalId === 'slideModal') {
                        @this.saveSlide();
                    } else if (event.detail.modalId === 'testimonialModal') {
                        @this.saveTestimonial();
                    } else if (event.detail.modalId === 'createSectionModal') {
                        @this.storeSection();
                    }
                });
            },
            initSortable(el, method) {
                if(typeof Sortable === 'undefined') return;
                new Sortable(el, {
                    animation: 150,
                    handle: '.drag-handle',
                    ghostClass: 'bg-slate-800/50',
                    onEnd: (evt) => {
                        let orderedIds = Array.from(el.children).map(row => row.dataset.id);
                        @this.call(method, orderedIds);
                    }
                });
            }
        }">
        
        {{-- Page Header --}}
        <div class="mb-6">
            <x-admin.page-header 
                title="Homepage Builder" 
                description="Manage landing page sections, hero slides, and testimonials"
                module="homepage"
            />
        </div>

        <!-- Stat Cards Row -->
        <section class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
            <x-admin.stat-card 
                title="Total Sections" 
                value="{{ number_format($totalSections) }}" 
                color="cyan" 
                icon='<svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" /></svg>' 
            />
            <x-admin.stat-card 
                title="Enabled Sections" 
                value="{{ number_format($enabledSections) }}" 
                color="emerald" 
                icon='<svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12.75l2.25 2.25L15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>' 
            />
            <x-admin.stat-card 
                title="Hero Slides" 
                value="{{ number_format($totalSlides) }}" 
                color="indigo" 
                icon='<svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>' 
            />
            <x-admin.stat-card 
                title="Testimonials" 
                value="{{ number_format($totalTestimonials) }}" 
                color="amber" 
                icon='<svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" /></svg>' 
            />
        </section>

        <!-- Sub-Navigation Tabs -->
        <div class="flex flex-wrap gap-2 rounded-2xl bg-slate-900/50 p-1.5 backdrop-blur-xl border border-slate-700/60 shadow-xl shadow-slate-950/20">
            <button wire:click="switchView('sections')" class="flex flex-1 items-center justify-center gap-2 rounded-xl px-4 py-2.5 text-sm font-semibold transition {{ $activeView === 'sections' ? 'bg-teal-500/10 text-teal-300 border border-teal-400/30' : 'text-slate-400 hover:text-white border border-transparent' }}">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" /></svg>
                Homepage Sections
                <span class="ml-1.5 rounded-md bg-slate-800 px-2 py-0.5 text-xs text-slate-300">{{ $totalSections }}</span>
            </button>
            <button wire:click="switchView('hero-slides')" class="flex flex-1 items-center justify-center gap-2 rounded-xl px-4 py-2.5 text-sm font-semibold transition {{ $activeView === 'hero-slides' ? 'bg-teal-500/10 text-teal-300 border border-teal-400/30' : 'text-slate-400 hover:text-white border border-transparent' }}">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                Hero Slides
                <span class="ml-1.5 rounded-md bg-slate-800 px-2 py-0.5 text-xs text-slate-300">{{ $totalSlides }}</span>
            </button>
            <button wire:click="switchView('testimonials')" class="flex flex-1 items-center justify-center gap-2 rounded-xl px-4 py-2.5 text-sm font-semibold transition {{ $activeView === 'testimonials' ? 'bg-teal-500/10 text-teal-300 border border-teal-400/30' : 'text-slate-400 hover:text-white border border-transparent' }}">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" /></svg>
                Testimonials
                <span class="ml-1.5 rounded-md bg-slate-800 px-2 py-0.5 text-xs text-slate-300">{{ $totalTestimonials }}</span>
            </button>
        </div>

        <div class="relative">
            <!-- Loading overlay -->
            <div wire:loading wire:target="switchView, toggleSection, moveSectionUp, moveSectionDown, saveSection, createSlide, editSlide, saveSlide, toggleSlide, confirmDeleteSlide, createTestimonial, editTestimonial, saveTestimonial, toggleTestimonial, confirmDeleteTestimonial" class="absolute inset-0 z-10 flex items-center justify-center bg-slate-950/40 backdrop-blur-sm rounded-3xl">
                <div class="flex items-center gap-3 rounded-2xl bg-slate-900/90 px-5 py-3.5 text-sm font-semibold text-white shadow-2xl shadow-black/50 border border-slate-800">
                    <svg class="h-5 w-5 animate-spin text-teal-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                    Loading...
                </div>
            </div>

            <!-- VIEW 1: Sections List -->
            @if($activeView === 'sections')
            <section class="overflow-hidden rounded-3xl border border-slate-700/60 bg-slate-900/65 shadow-2xl shadow-slate-950/20 backdrop-blur-xl">
                <div class="border-b border-slate-700/60 p-4 sm:p-5 flex justify-between items-center">
                    <div>
                        <h2 class="text-lg font-bold text-white">Homepage Sections</h2>
                        <p class="mt-1 text-sm text-slate-500">Manage the sections on the homepage.</p>
                    </div>
                    @can('create homepage sections')
                    <button wire:click="openCreateSection" class="inline-flex items-center gap-2 rounded-xl border border-teal-400/20 bg-teal-400/10 px-4 py-2 text-sm font-semibold text-teal-300 transition hover:bg-teal-400/15 hover:text-teal-200">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.5v15m7.5-7.5h-15" /></svg>
                        Add New Block
                    </button>
                    @endcan
                </div>    

                <div class="divide-y divide-slate-700/40" x-init="initSortable($el, 'updateSectionOrder')">
                    @forelse($sections as $section)
                        <div data-id="{{ $section->id }}" class="flex items-center gap-4 px-6 py-4 transition hover:bg-slate-800/40 {{ !$section->is_enabled ? 'opacity-60' : '' }}">
                            <div class="drag-handle cursor-grab text-slate-500 hover:text-white transition active:cursor-grabbing" title="Drag to reorder">
                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8h16M4 16h16" /></svg>
                            </div>
                            <div class="flex flex-col items-center justify-center min-w-10">
                                <span class="text-[9px] uppercase font-bold text-slate-500 tracking-wider">POS</span>
                                <span class="text-sm font-bold text-teal-400 bg-slate-800/50 rounded-md px-2 py-0.5 border border-slate-700">{{ $section->sort_order }}</span>
                            </div>
                            <div class="flex h-10 w-10 flex-none items-center justify-center rounded-xl border border-slate-700 bg-slate-800 text-lg shadow-inner">
                                {{ $section->icon ?? '📄' }}
                            </div>
                            <div class="flex-1 min-w-0">
                                <h3 class="truncate text-base font-semibold text-white">{{ $section->title }}</h3>
                                <p class="mt-0.5 flex items-center gap-2 text-xs text-slate-500">
                                    <span class="rounded bg-slate-800 px-1.5 py-0.5 font-mono text-[10px] text-slate-400">{{ $section->block_id }}</span>
                                </p>
                            </div>
                            <div class="flex items-center justify-end gap-3">
                                @can('edit homepage')
                                <button type="button" wire:click="toggleSection({{ $section->id }})" class="relative inline-flex h-8 w-14 items-center rounded-full border border-transparent p-1 transition focus:outline-none focus:ring-4 focus:ring-teal-500/15 {{ $section->is_enabled ? 'bg-teal-500' : 'bg-slate-700' }}" title="{{ $section->is_enabled ? 'Disable Section' : 'Enable Section' }}">
                                    <span class="inline-flex h-6 w-6 transform items-center justify-center rounded-full bg-white shadow-md transition {{ $section->is_enabled ? 'translate-x-6' : 'translate-x-0' }}">
                                        <span class="h-1.5 w-1.5 rounded-full {{ $section->is_enabled ? 'bg-teal-500' : 'bg-slate-500' }}"></span>
                                    </span>
                                </button>
                                
                                <button wire:click="editSection({{ $section->id }})" class="ml-1 inline-flex h-9 w-9 items-center justify-center rounded-xl border border-transparent text-slate-400 transition hover:border-teal-400/20 hover:bg-teal-400/10 hover:text-teal-300 focus:outline-none focus:ring-4 focus:ring-teal-500/10" title="Edit Section Content">
                                    <svg class="h-4.5 w-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16.862 3.487a2.25 2.25 0 013.182 3.182L8.25 18.463 3.75 19.5l1.037-4.5L16.862 3.487z" /></svg>
                                </button>
                                @endcan
                                @can('delete homepage sections')
                                <button wire:click="confirmDeleteSection({{ $section->id }})" class="ml-1 inline-flex h-9 w-9 items-center justify-center rounded-xl border border-transparent text-slate-400 transition hover:border-rose-400/20 hover:bg-rose-400/10 hover:text-rose-400 focus:outline-none focus:ring-4 focus:ring-rose-500/10" title="Delete Block">
                                    <svg class="h-4.5 w-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                </button>
                                @endcan
                            </div>
                        </div>
                    @empty
                        <div class="px-6 py-20 text-center text-slate-500">No sections found.</div>
                    @endforelse
                </div>
            </section>
            @endif

            <!-- VIEW 2: Hero Slides -->
            @if($activeView === 'hero-slides')
            <section class="overflow-hidden rounded-3xl border border-slate-700/60 bg-slate-900/65 shadow-2xl shadow-slate-950/20 backdrop-blur-xl">
                <div class="border-b border-slate-700/60 p-4 sm:p-5 flex justify-between items-center">
                    <div>
                        <h2 class="text-lg font-bold text-white">Hero Slides</h2>
                        <p class="mt-1 text-sm text-slate-500">Manage the hero carousel on the homepage.</p>
                    </div>
                    @can('edit homepage')
                    <button wire:click="createSlide" class="inline-flex items-center gap-2 rounded-xl border border-teal-400/20 bg-teal-400/10 px-4 py-2 text-sm font-semibold text-teal-300 transition hover:bg-teal-400/15 hover:text-teal-200">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.5v15m7.5-7.5h-15" /></svg>
                        Add Slide
                    </button>
                    @endcan
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-700/60">
                        <thead class="bg-slate-950/35">
                            <tr>
                                <th scope="col" class="px-5 py-4 text-left text-[11px] font-bold uppercase tracking-[0.14em] text-slate-500">Slide</th>
                                <th scope="col" class="px-5 py-4 text-center text-[11px] font-bold uppercase tracking-[0.14em] text-slate-500">Order</th>
                                <th scope="col" class="px-5 py-4 text-left text-[11px] font-bold uppercase tracking-[0.14em] text-slate-500">Status</th>
                                <th scope="col" class="px-5 py-4 text-right text-[11px] font-bold uppercase tracking-[0.14em] text-slate-500">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-800/80" x-init="initSortable($el, 'updateSlideOrder')">
                            @forelse($heroSlides as $slide)
                            <tr data-id="{{ $slide->id }}" class="group bg-transparent transition hover:bg-slate-800/35">
                                <td class="px-5 py-4">
                                    <div class="flex items-center gap-4">
                                        <div class="drag-handle cursor-grab text-slate-500 hover:text-white transition active:cursor-grabbing" title="Drag to reorder">
                                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8h16M4 16h16" /></svg>
                                        </div>
                                        <div class="h-14 w-24 flex-none overflow-hidden rounded-lg bg-slate-800 border border-slate-700 relative">
                                            @if($slide->bg_image)
                                                <img src="{{ Storage::url($slide->bg_image) }}" alt="Background" class="h-full w-full object-cover">
                                            @else
                                                <div class="flex h-full w-full items-center justify-center text-slate-500 text-xs">No img</div>
                                            @endif
                                        </div>
                                        <div>
                                            <div class="text-xs font-semibold text-teal-400 mb-0.5">{{ $slide->tag }}</div>
                                            <div class="text-sm font-semibold text-white line-clamp-1">{!! strip_tags($slide->title) !!}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-5 py-4 text-center">
                                    <span class="inline-flex min-w-9 items-center justify-center rounded-lg border border-slate-700 bg-slate-800/70 px-2.5 py-1.5 text-xs font-bold tabular-nums text-slate-300">{{ $slide->sort_order }}</span>
                                </td>
                                <td class="px-5 py-4 whitespace-nowrap">
                                    @if($slide->is_enabled)
                                        <span class="inline-flex items-center gap-1.5 rounded-full border border-emerald-400/20 bg-emerald-400/10 px-2.5 py-1 text-xs font-semibold text-emerald-300"><span class="h-1.5 w-1.5 rounded-full bg-emerald-400 shadow-[0_0_8px_rgba(52,211,153,.75)]"></span>Enabled</span>
                                    @else
                                        <span class="inline-flex items-center gap-1.5 rounded-full border border-amber-400/20 bg-amber-400/10 px-2.5 py-1 text-xs font-semibold text-amber-300"><span class="h-1.5 w-1.5 rounded-full bg-amber-400"></span>Disabled</span>
                                    @endif
                                </td>
                                <td class="px-5 py-4 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        @can('edit homepage')
                                        <button wire:click="toggleSlide({{ $slide->id }})" class="relative inline-flex h-8 w-14 items-center rounded-full border border-transparent p-1 transition {{ $slide->is_enabled ? 'bg-teal-500' : 'bg-slate-700' }}">
                                            <span class="inline-flex h-6 w-6 transform items-center justify-center rounded-full bg-white shadow-md transition {{ $slide->is_enabled ? 'translate-x-6' : 'translate-x-0' }}">
                                                <span class="h-1.5 w-1.5 rounded-full {{ $slide->is_enabled ? 'bg-teal-500' : 'bg-slate-500' }}"></span>
                                            </span>
                                        </button>
                                        <button wire:click="editSlide({{ $slide->id }})" class="inline-flex h-9 w-9 items-center justify-center rounded-xl border border-transparent text-slate-400 transition hover:border-teal-400/20 hover:bg-teal-400/10 hover:text-teal-300">
                                            <svg class="h-4.5 w-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16.862 3.487a2.25 2.25 0 013.182 3.182L8.25 18.463 3.75 19.5l1.037-4.5L16.862 3.487z" /></svg>
                                        </button>
                                        <button wire:click="confirmDeleteSlide({{ $slide->id }})" class="inline-flex h-9 w-9 items-center justify-center rounded-xl border border-transparent text-slate-400 transition hover:border-rose-400/20 hover:bg-rose-400/10 hover:text-rose-300">
                                            <svg class="h-4.5 w-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166M19.228 5.79L18.16 19.673A2.25 2.25 0 0115.916 21.75H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0V4.477c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" /></svg>
                                        </button>
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="px-6 py-12 text-center text-slate-500">No slides created yet.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </section>
            @endif

            <!-- VIEW 3: Testimonials -->
            @if($activeView === 'testimonials')
            <section class="overflow-hidden rounded-3xl border border-slate-700/60 bg-slate-900/65 shadow-2xl shadow-slate-950/20 backdrop-blur-xl">
                <div class="border-b border-slate-700/60 p-4 sm:p-5 flex justify-between items-center">
                    <div>
                        <h2 class="text-lg font-bold text-white">Testimonials</h2>
                        <p class="mt-1 text-sm text-slate-500">Manage client reviews displayed on the homepage.</p>
                    </div>
                    @can('edit homepage')
                    <button wire:click="createTestimonial" class="inline-flex items-center gap-2 rounded-xl border border-teal-400/20 bg-teal-400/10 px-4 py-2 text-sm font-semibold text-teal-300 transition hover:bg-teal-400/15 hover:text-teal-200">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.5v15m7.5-7.5h-15" /></svg>
                        Add Testimonial
                    </button>
                    @endcan
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-700/60">
                        <thead class="bg-slate-950/35">
                            <tr>
                                <th scope="col" class="px-5 py-4 text-left text-[11px] font-bold uppercase tracking-[0.14em] text-slate-500">Author</th>
                                <th scope="col" class="px-5 py-4 text-left text-[11px] font-bold uppercase tracking-[0.14em] text-slate-500">Quote Preview</th>
                                <th scope="col" class="px-5 py-4 text-center text-[11px] font-bold uppercase tracking-[0.14em] text-slate-500">Order</th>
                                <th scope="col" class="px-5 py-4 text-left text-[11px] font-bold uppercase tracking-[0.14em] text-slate-500">Status</th>
                                <th scope="col" class="px-5 py-4 text-right text-[11px] font-bold uppercase tracking-[0.14em] text-slate-500">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-800/80" x-init="initSortable($el, 'updateTestimonialOrder')">
                            @forelse($testimonials as $testimonial)
                            <tr data-id="{{ $testimonial->id }}" class="group bg-transparent transition hover:bg-slate-800/35">
                                <td class="px-5 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="drag-handle cursor-grab text-slate-500 hover:text-white transition active:cursor-grabbing" title="Drag to reorder">
                                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8h16M4 16h16" /></svg>
                                        </div>
                                        <div class="h-10 w-10 flex-none overflow-hidden rounded-full bg-slate-800 border border-slate-700">
                                            @if($testimonial->avatar)
                                                <img src="{{ Storage::url($testimonial->avatar) }}" alt="{{ $testimonial->name }}" class="h-full w-full object-cover">
                                            @else
                                                <div class="flex h-full w-full items-center justify-center text-slate-500 text-xs font-bold">{{ substr($testimonial->name, 0, 1) }}</div>
                                            @endif
                                        </div>
                                        <div>
                                            <div class="text-sm font-semibold text-white">{{ $testimonial->name }}</div>
                                            <div class="text-xs text-slate-500">{{ $testimonial->designation }} @if($testimonial->organization) - {{ $testimonial->organization }} @endif</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-5 py-4">
                                    <div class="text-sm text-slate-300 line-clamp-2 max-w-xs md:max-w-md italic">"{{ $testimonial->quote }}"</div>
                                </td>
                                <td class="px-5 py-4 text-center">
                                    <span class="inline-flex min-w-9 items-center justify-center rounded-lg border border-slate-700 bg-slate-800/70 px-2.5 py-1.5 text-xs font-bold tabular-nums text-slate-300">{{ $testimonial->sort_order }}</span>
                                </td>
                                <td class="px-5 py-4 whitespace-nowrap">
                                    @if($testimonial->is_enabled)
                                        <span class="inline-flex items-center gap-1.5 rounded-full border border-emerald-400/20 bg-emerald-400/10 px-2.5 py-1 text-xs font-semibold text-emerald-300"><span class="h-1.5 w-1.5 rounded-full bg-emerald-400 shadow-[0_0_8px_rgba(52,211,153,.75)]"></span>Enabled</span>
                                    @else
                                        <span class="inline-flex items-center gap-1.5 rounded-full border border-amber-400/20 bg-amber-400/10 px-2.5 py-1 text-xs font-semibold text-amber-300"><span class="h-1.5 w-1.5 rounded-full bg-amber-400"></span>Disabled</span>
                                    @endif
                                </td>
                                <td class="px-5 py-4 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        @can('edit homepage')
                                        <button wire:click="toggleTestimonial({{ $testimonial->id }})" class="relative inline-flex h-8 w-14 items-center rounded-full border border-transparent p-1 transition {{ $testimonial->is_enabled ? 'bg-teal-500' : 'bg-slate-700' }}">
                                            <span class="inline-flex h-6 w-6 transform items-center justify-center rounded-full bg-white shadow-md transition {{ $testimonial->is_enabled ? 'translate-x-6' : 'translate-x-0' }}">
                                                <span class="h-1.5 w-1.5 rounded-full {{ $testimonial->is_enabled ? 'bg-teal-500' : 'bg-slate-500' }}"></span>
                                            </span>
                                        </button>
                                        <button wire:click="editTestimonial({{ $testimonial->id }})" class="inline-flex h-9 w-9 items-center justify-center rounded-xl border border-transparent text-slate-400 transition hover:border-teal-400/20 hover:bg-teal-400/10 hover:text-teal-300">
                                            <svg class="h-4.5 w-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16.862 3.487a2.25 2.25 0 013.182 3.182L8.25 18.463 3.75 19.5l1.037-4.5L16.862 3.487z" /></svg>
                                        </button>
                                        <button wire:click="confirmDeleteTestimonial({{ $testimonial->id }})" class="inline-flex h-9 w-9 items-center justify-center rounded-xl border border-transparent text-slate-400 transition hover:border-rose-400/20 hover:bg-rose-400/10 hover:text-rose-300">
                                            <svg class="h-4.5 w-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166M19.228 5.79L18.16 19.673A2.25 2.25 0 0115.916 21.75H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0V4.477c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" /></svg>
                                        </button>
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center text-slate-500">No testimonials created yet.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </section>
            @endif
        </div>

        <!-- CREATE SECTION MODAL -->
        <x-admin.modal id="createSectionModal" title="Create New Block" maxWidth="md" confirmText="Create Block" confirmColor="teal" wire:ignore.self>
            <form id="createSectionForm" wire:submit.prevent="saveNewSection">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5 p-6">
                    <div class="md:col-span-2">
                        <label for="createTitle" class="block text-sm font-semibold text-slate-200">Block Title / Name <span class="text-rose-400">*</span></label>
                        <input type="text" id="createTitle" wire:model="createTitle" class="mt-2 block w-full rounded-xl border border-slate-700 bg-slate-950/80 px-4 py-2.5 text-sm text-white placeholder:text-slate-600 outline-none transition focus:border-teal-500 focus:ring-4 focus:ring-teal-500/10" placeholder="e.g. Our Core Services">
                        @error('createTitle') <p class="mt-1.5 text-xs text-rose-400">{{ $message }}</p> @enderror
                    </div>
                    <div class="md:col-span-2">
                        <label for="createTemplate" class="block text-sm font-semibold text-slate-200">Layout Template <span class="text-rose-400">*</span></label>
                        <select id="createTemplate" wire:model="createTemplate" class="mt-2 block w-full rounded-xl border border-slate-700 bg-slate-950/80 px-4 py-2.5 text-sm text-white outline-none transition focus:border-teal-500 focus:ring-4 focus:ring-teal-500/10">
                            <option value="welcome">Welcome Note & Leadership</option>
                            <option value="pillars">Icon Grid (Pillars)</option>
                            <option value="join_movement">Action Cards (Target Sectors)</option>
                            <option value="stats">Stats Counter Bar</option>
                            <option value="news_events">Latest News & Events Feed</option>
                            <option value="initiatives">Image Card Carousel (Initiatives)</option>
                            <option value="focus_areas">Icon Overlay Grid (Focus Areas)</option>
                            <option value="testimonials">Testimonial Slider</option>
                            <option value="features_stats">Feature Stat Grid</option>
                            <option value="cta_banner">CTA Banner</option>
                            <option value="faq_accordion">FAQ Accordion</option>
                            <option value="team_grid">Team / Advisory Board Grid</option>
                            <option value="contact_map">Contact Info & Map</option>
                            <option value="pricing_table">Pricing / Membership Plans</option>
                            <option value="video_showcase">Video Showcase Embed</option>
                            <option value="timeline_history">Timeline / History Roadmap</option>
                            <option value="gallery_masonry">Image Gallery (Masonry)</option>
                            <option value="custom_html">Custom HTML / Raw Block</option>
                        </select>
                        @error('createTemplate') <p class="mt-1.5 text-xs text-rose-400">{{ $message }}</p> @enderror
                        <p class="mt-2 text-xs text-slate-500">Choosing a template will auto-generate the required data fields for you.</p>
                    </div>
                    <div class="md:col-span-2 relative z-50">
                        <label for="createIcon" class="block text-sm font-semibold text-slate-200 mb-2">Icon / Emoji</label>
                        <x-admin.icon-picker model="createIcon" />
                        @error('createIcon') <p class="mt-1.5 text-xs text-rose-400">{{ $message }}</p> @enderror
                    </div>
                    <div class="md:col-span-2 flex items-center mt-2 p-4 rounded-xl border border-slate-700/50 bg-slate-900/50">
                        <label class="flex w-full cursor-pointer items-center justify-between gap-4">
                            <div>
                                <span class="block text-sm font-semibold text-slate-200">Enable Immediately</span>
                                <span class="mt-0.5 block text-xs text-slate-500">The block will be visible on the public page right away.</span>
                            </div>
                            <span class="relative inline-flex flex-none">
                                <input type="checkbox" wire:model="createEnabled" class="peer sr-only">
                                <span class="h-7 w-12 rounded-full bg-slate-700 transition peer-checked:bg-teal-500 peer-focus:ring-4 peer-focus:ring-teal-500/15"></span>
                                <span class="absolute left-1 top-1 h-5 w-5 rounded-full bg-white shadow transition peer-checked:translate-x-5"></span>
                            </span>
                        </label>
                    </div>
                </div>
            </form>
            <x-slot name="footer">
                <button type="button" onclick="closeModal('createSectionModal')" class="rounded-xl border border-slate-700 bg-slate-800 px-5 py-2.5 text-sm font-bold text-slate-300 transition hover:bg-slate-700 focus:outline-none focus:ring-4 focus:ring-slate-500/30">Cancel</button>
                <button type="submit" form="createSectionForm" class="ml-3 rounded-xl bg-teal-500 px-5 py-2.5 text-sm font-bold text-white shadow-lg shadow-teal-500/20 transition hover:-translate-y-0.5 hover:bg-teal-400 hover:shadow-teal-500/30 focus:outline-none focus:ring-4 focus:ring-teal-500/20">Create Block</button>
            </x-slot>
        </x-admin.modal>

        <!-- MODAL: Section Content Editor -->
        <x-admin.modal id="sectionEditorModal" title="Edit Section Content" maxWidth="3xl" confirmText="Save Section" confirmColor="teal" wire:ignore.self>
            @if($editingSection)
            <div class="space-y-5">
                <div class="rounded-xl bg-slate-800/50 p-4 border border-slate-700/50 mb-4">
                    <h4 class="text-sm font-semibold text-white mb-1">Editing: {{ $editingSection->title }}</h4>
                    <p class="text-xs text-slate-400">Update the textual and content structure for this section. Complex nested array items may require code-level edits for now.</p>
                </div>
                
                <div class="space-y-4">
                    @if(is_array($sectionContent) && count($sectionContent) > 0)
                        @foreach($sectionContent as $key => $value)
                            @if(in_array($key, ['bg_overlay_color', 'bg_overlay_opacity']))
                                {{-- Skipped, handled by bg_image component --}}
                            @elseif(is_string($value) || is_numeric($value))
                                <div>
                                    @if($key !== 'bg_image')
                                        <label class="mb-2 block text-sm font-semibold text-slate-200 capitalize">
                                            {{ str_replace('_', ' ', $key) }}
                                        </label>
                                    @endif
                                    
                                    @if($key === 'bg_image')
                                        <x-admin.bg-image-picker modelPrefix="sectionContent" />
                                    @elseif(str_contains(strtolower($key), 'image') || str_contains(strtolower($key), 'photo') || str_contains(strtolower($key), 'logo'))
                                        <div class="flex gap-2">
                                            <input
                                                type="text"
                                                wire:model.lazy="sectionContent.{{ $key }}"
                                                class="flex-1 rounded-xl border border-slate-700 bg-slate-950/80 px-4 py-3 text-sm text-white placeholder:text-slate-600 outline-none transition focus:border-teal-500 focus:ring-4 focus:ring-teal-500/10"
                                            >
                                            <button type="button" wire:click="$dispatch('open-media-picker', { targetEvent: 'media-selected-homepage-flat', params: '{{ $key }}' })" class="px-5 py-3 bg-slate-800 border border-slate-700 hover:border-teal-500 text-white font-semibold text-sm rounded-xl transition shadow-sm whitespace-nowrap">
                                                Browse
                                            </button>
                                            <button type="button" wire:click="$set('sectionContent.{{ $key }}', '')" class="px-4 py-3 bg-rose-500/10 hover:bg-rose-500/20 text-rose-400 hover:text-rose-300 font-semibold text-sm rounded-xl transition shadow-sm whitespace-nowrap" title="Remove Image">
                                                Remove
                                            </button>
                                        </div>
                                    @elseif(strlen($value) > 100 || in_array($key, ['description', 'content', 'summary', 'text', 'raw_html']))
                                        <textarea
                                            wire:model="sectionContent.{{ $key }}"
                                            rows="{{ $key === 'raw_html' ? '8' : '4' }}"
                                            class="w-full resize-y rounded-xl border border-slate-700 bg-slate-950/80 px-4 py-3 text-sm leading-6 text-white placeholder:text-slate-600 outline-none transition focus:border-teal-500 focus:ring-4 focus:ring-teal-500/10 font-mono"
                                        ></textarea>
                                    @elseif(str_contains(strtolower($key), 'opacity'))
                                        <div class="flex items-center gap-4">
                                            <input type="range" min="0" max="100" step="5" wire:model.live="sectionContent.{{ $key }}" class="w-full accent-teal-500">
                                            <span class="text-xs font-bold text-teal-400 w-12">{{ $value }}%</span>
                                        </div>
                                    @elseif(str_contains(strtolower($key), 'color'))
                                        <div class="flex items-center gap-2">
                                            <input type="color" wire:model.live="sectionContent.{{ $key }}" class="w-10 h-10 rounded cursor-pointer bg-slate-900 border border-slate-700">
                                            <input type="text" wire:model="sectionContent.{{ $key }}" class="flex-1 rounded-xl border border-slate-700 bg-slate-950/80 px-4 py-2.5 text-sm text-white placeholder:text-slate-600 outline-none transition focus:border-teal-500">
                                        </div>
                                    @else
                                        <input
                                            type="text"
                                            wire:model="sectionContent.{{ $key }}"
                                            class="w-full rounded-xl border border-slate-700 bg-slate-950/80 px-4 py-3 text-sm text-white placeholder:text-slate-600 outline-none transition focus:border-teal-500 focus:ring-4 focus:ring-teal-500/10"
                                        >
                                    @endif
                                </div>
                            @elseif(is_bool($value))
                                <div class="rounded-xl border border-slate-700 bg-slate-950/50 p-3.5 mt-2">
                                    <label class="flex cursor-pointer items-center justify-between gap-4">
                                        <span>
                                            <span class="block text-sm font-semibold text-slate-200 capitalize">{{ str_replace('_', ' ', $key) }}</span>
                                        </span>
                                        <span class="relative inline-flex flex-none">
                                            <input type="checkbox" wire:model="sectionContent.{{ $key }}" class="peer sr-only">
                                            <span class="h-7 w-12 rounded-full bg-slate-700 transition peer-checked:bg-teal-500 peer-focus:ring-4 peer-focus:ring-teal-500/15"></span>
                                            <span class="absolute left-1 top-1 h-5 w-5 rounded-full bg-white shadow transition peer-checked:translate-x-5"></span>
                                        </span>
                                    </label>
                                </div>
                            @elseif(is_array($value))
                                <div class="rounded-xl border border-slate-700 bg-slate-900/60 p-4 mt-2">
                                    <label class="mb-2 block text-sm font-semibold text-slate-200 capitalize">{{ str_replace('_', ' ', $key) }} (List/Array)</label>
                                    <p class="text-xs text-slate-400 mb-3">You can edit the values of this list below.</p>
                                    <div class="space-y-4 max-h-[400px] overflow-y-auto pr-2 custom-scrollbar">
                                    @foreach($value as $index => $item)
                                        <div wire:key="array-item-{{ $key }}-{{ $index }}" class="border border-slate-700/50 bg-slate-950/80 p-5 rounded-xl relative group hover:border-teal-500/30 transition-colors shadow-inner">
                                            <button type="button" wire:click="removeArrayItem('{{ $key }}', {{ $index }})" class="absolute top-3 right-3 p-1.5 rounded-lg bg-slate-800 text-slate-400 opacity-0 group-hover:opacity-100 transition-all hover:bg-rose-500 hover:text-white shadow-sm" title="Remove Item">
                                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                                            </button>
                                            @if(is_array($item))
                                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-2">
                                                    @foreach($item as $itemKey => $itemVal)
                                                        <div class="@if(strlen($itemVal) > 60) sm:col-span-2 @endif">
                                                            @if($itemKey === 'icon')
                                                                <label class="text-[10px] uppercase font-bold text-slate-500 mb-1.5 block">{{ str_replace('_', ' ', $itemKey) }}</label>
                                                                <x-admin.icon-picker model="sectionContent.{{ $key }}.{{ $index }}.{{ $itemKey }}" />
                                                            @elseif(str_contains(strtolower($itemKey), 'image') || str_contains(strtolower($itemKey), 'photo') || str_contains(strtolower($itemKey), 'logo') || str_contains(strtolower($itemKey), 'bg_'))
                                                                <label class="text-[10px] uppercase font-bold text-slate-500 mb-1.5 block">{{ str_replace('_', ' ', $itemKey) }}</label>
                                                                <div class="flex gap-2">
                                                                    <input type="text" wire:model.lazy="sectionContent.{{ $key }}.{{ $index }}.{{ $itemKey }}" class="flex-1 rounded-lg border border-slate-700 bg-slate-900 px-3 py-2.5 text-xs text-white placeholder:text-slate-600 outline-none transition focus:border-teal-500">
                                                                    <button type="button" wire:click="$dispatch('open-media-picker', { targetEvent: 'media-selected-homepage', params: ['{{ $key }}', {{ $index }}, '{{ $itemKey }}'] })" class="px-3 py-2.5 bg-slate-800 border border-slate-700 hover:border-teal-500 text-white font-semibold text-xs rounded-lg transition shadow-sm whitespace-nowrap">
                                                                        Browse
                                                                    </button>
                                                                    <button type="button" wire:click="$set('sectionContent.{{ $key }}.{{ $index }}.{{ $itemKey }}', '')" class="px-3 py-2.5 bg-rose-500/10 hover:bg-rose-500/20 text-rose-400 hover:text-rose-300 font-semibold text-xs rounded-lg transition shadow-sm whitespace-nowrap" title="Remove Image">
                                                                        Remove
                                                                    </button>
                                                                </div>
                                                            @elseif(strlen($itemVal) > 100 || in_array($itemKey, ['description', 'content', 'summary', 'text', 'quote']))
                                                                <label class="text-[10px] uppercase font-bold text-slate-500 mb-1.5 block">{{ str_replace('_', ' ', $itemKey) }}</label>
                                                                <textarea rows="2" wire:model="sectionContent.{{ $key }}.{{ $index }}.{{ $itemKey }}" class="w-full resize-y rounded-lg border border-slate-700 bg-slate-900 px-3 py-2.5 text-xs text-white placeholder:text-slate-600 outline-none transition focus:border-teal-500"></textarea>
                                                            @else
                                                                <label class="text-[10px] uppercase font-bold text-slate-500 mb-1.5 block">{{ str_replace('_', ' ', $itemKey) }}</label>
                                                                <input type="text" wire:model="sectionContent.{{ $key }}.{{ $index }}.{{ $itemKey }}" class="w-full rounded-lg border border-slate-700 bg-slate-900 px-3 py-2.5 text-xs text-white placeholder:text-slate-600 outline-none transition focus:border-teal-500">
                                                            @endif
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @elseif(is_string($item) || is_numeric($item))
                                                <input type="text" wire:model="sectionContent.{{ $key }}.{{ $index }}" class="w-full rounded-lg border border-slate-700 bg-slate-900 px-3 py-2 text-sm text-white placeholder:text-slate-600 outline-none transition focus:border-teal-500 mt-2">
                                            @endif
                                        </div>
                                    @endforeach
                                    </div>
                                    <button type="button" wire:click="addArrayItem('{{ $key }}')" class="mt-4 flex items-center gap-2 text-xs font-bold text-teal-400 hover:text-teal-300 transition-colors uppercase tracking-wider">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                                        Add Item
                                    </button>
                                </div>
                            @endif
                        @endforeach
                    @else
                        <div class="text-sm text-slate-400">No configurable content for this section.</div>
                    @endif
                </div>
            </div>
            @endif
        </x-admin.modal>

        <!-- MODAL: Hero Slide Editor -->
        <x-admin.modal id="slideModal" title="{{ $slideId ? 'Edit Slide' : 'Add New Slide' }}" maxWidth="3xl" confirmText="Save Slide" confirmColor="teal">
            <div class="space-y-5">
                <div class="grid gap-4 sm:grid-cols-2">
                    <div>
                        <label class="mb-2 block text-sm font-semibold text-slate-200">Tag (Small top text)</label>
                        <input type="text" wire:model="slideTag" class="w-full rounded-xl border border-slate-700 bg-slate-950/80 px-4 py-3 text-sm text-white placeholder:text-slate-600 outline-none transition focus:border-teal-500 focus:ring-4 focus:ring-teal-500/10">
                        @error('slideTag')<p class="mt-1 text-xs text-rose-400">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="mb-2 block text-sm font-semibold text-slate-200">Sort Order</label>
                        <input type="number" wire:model="slideSortOrder" class="w-full rounded-xl border border-slate-700 bg-slate-950/80 px-4 py-3 text-sm text-white placeholder:text-slate-600 outline-none transition focus:border-teal-500 focus:ring-4 focus:ring-teal-500/10">
                    </div>
                </div>

                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-200">Main Title (HTML allowed)</label>
                    <textarea wire:model="slideTitle" rows="3" class="w-full resize-y rounded-xl border border-slate-700 bg-slate-950/80 px-4 py-3 text-sm text-white placeholder:text-slate-600 outline-none transition focus:border-teal-500 focus:ring-4 focus:ring-teal-500/10"></textarea>
                    @error('slideTitle')<p class="mt-1 text-xs text-rose-400">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-200">Subtitle</label>
                    <textarea wire:model="slideSubtitle" rows="2" class="w-full resize-y rounded-xl border border-slate-700 bg-slate-950/80 px-4 py-3 text-sm text-white placeholder:text-slate-600 outline-none transition focus:border-teal-500 focus:ring-4 focus:ring-teal-500/10"></textarea>
                </div>
                
                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-200">Background Image Path</label>
                    <div class="flex gap-2">
                        <input type="text" wire:model.lazy="slideBgImage" placeholder="images/hero/bg-1.jpg" class="flex-1 rounded-xl border border-slate-700 bg-slate-950/80 px-4 py-3 text-sm text-white placeholder:text-slate-600 outline-none transition focus:border-teal-500 focus:ring-4 focus:ring-teal-500/10">
                        <button type="button" wire:click="$dispatch('open-media-picker', { targetEvent: 'media-selected-slide', params: 'slideBgImage' })" class="px-5 py-3 bg-slate-800 border border-slate-700 hover:border-teal-500 text-white font-semibold text-sm rounded-xl transition shadow-sm whitespace-nowrap">
                            Browse
                        </button>
                        <button type="button" wire:click="$set('slideBgImage', '')" class="px-4 py-3 bg-rose-500/10 hover:bg-rose-500/20 text-rose-400 hover:text-rose-300 font-semibold text-sm rounded-xl transition shadow-sm whitespace-nowrap" title="Remove Image">
                            Remove
                        </button>
                    </div>
                </div>

                <div class="grid gap-4 sm:grid-cols-2 rounded-xl border border-slate-700 bg-slate-900/60 p-4">
                    <div class="col-span-full">
                        <h4 class="text-sm font-semibold text-white">Primary Button (Btn 1)</h4>
                    </div>
                    <div>
                        <label class="mb-1 block text-xs font-semibold text-slate-400">Text</label>
                        <input type="text" wire:model="slideBtn1Text" class="w-full rounded-xl border border-slate-700 bg-slate-950/80 px-3 py-2 text-sm text-white placeholder:text-slate-600 outline-none transition focus:border-teal-500 focus:ring-4 focus:ring-teal-500/10">
                    </div>
                    <div>
                        <label class="mb-1 block text-xs font-semibold text-slate-400">URL</label>
                        <input type="text" wire:model="slideBtn1Url" class="w-full rounded-xl border border-slate-700 bg-slate-950/80 px-3 py-2 text-sm text-white placeholder:text-slate-600 outline-none transition focus:border-teal-500 focus:ring-4 focus:ring-teal-500/10">
                    </div>
                    <div class="col-span-full">
                        <label class="mb-1 block text-xs font-semibold text-slate-400">Variant</label>
                        <select wire:model="slideBtn1Variant" class="w-full rounded-xl border border-slate-700 bg-slate-950/80 px-3 py-2 text-sm text-white outline-none transition focus:border-teal-500 focus:ring-4 focus:ring-teal-500/10">
                            <option value="primary">Primary (Solid)</option>
                            <option value="primary2">Secondary Solid</option>
                            <option value="outline">Outline</option>
                            <option value="ghost">Ghost (Text only)</option>
                        </select>
                    </div>
                </div>

                <div class="grid gap-4 sm:grid-cols-2 rounded-xl border border-slate-700 bg-slate-900/60 p-4">
                    <div class="col-span-full">
                        <h4 class="text-sm font-semibold text-white">Secondary Button (Btn 2)</h4>
                    </div>
                    <div>
                        <label class="mb-1 block text-xs font-semibold text-slate-400">Text</label>
                        <input type="text" wire:model="slideBtn2Text" class="w-full rounded-xl border border-slate-700 bg-slate-950/80 px-3 py-2 text-sm text-white placeholder:text-slate-600 outline-none transition focus:border-teal-500 focus:ring-4 focus:ring-teal-500/10">
                    </div>
                    <div>
                        <label class="mb-1 block text-xs font-semibold text-slate-400">URL</label>
                        <input type="text" wire:model="slideBtn2Url" class="w-full rounded-xl border border-slate-700 bg-slate-950/80 px-3 py-2 text-sm text-white placeholder:text-slate-600 outline-none transition focus:border-teal-500 focus:ring-4 focus:ring-teal-500/10">
                    </div>
                    <div class="col-span-full">
                        <label class="mb-1 block text-xs font-semibold text-slate-400">Variant</label>
                        <select wire:model="slideBtn2Variant" class="w-full rounded-xl border border-slate-700 bg-slate-950/80 px-3 py-2 text-sm text-white outline-none transition focus:border-teal-500 focus:ring-4 focus:ring-teal-500/10">
                            <option value="primary">Primary (Solid)</option>
                            <option value="primary2">Secondary Solid</option>
                            <option value="outline">Outline</option>
                            <option value="ghost">Ghost (Text only)</option>
                        </select>
                    </div>
                </div>

                <div class="rounded-xl border border-slate-700 bg-slate-950/50 p-3.5">
                    <label class="flex cursor-pointer items-center justify-between gap-4">
                        <span>
                            <span class="block text-sm font-semibold text-slate-200">Enabled</span>
                            <span class="mt-0.5 block text-xs text-slate-600">Show this slide in the hero section.</span>
                        </span>
                        <span class="relative inline-flex flex-none">
                            <input type="checkbox" wire:model="slideEnabled" class="peer sr-only">
                            <span class="h-7 w-12 rounded-full bg-slate-700 transition peer-checked:bg-teal-500 peer-focus:ring-4 peer-focus:ring-teal-500/15"></span>
                            <span class="absolute left-1 top-1 h-5 w-5 rounded-full bg-white shadow transition peer-checked:translate-x-5"></span>
                        </span>
                    </label>
                </div>
            </div>
        </x-admin.modal>

        <!-- MODAL: Testimonial Editor -->
        <x-admin.modal id="testimonialModal" title="{{ $testimonialId ? 'Edit Testimonial' : 'Add New Testimonial' }}" maxWidth="2xl" confirmText="Save Testimonial" confirmColor="teal">
            <div class="space-y-5">
                <div class="grid gap-4 sm:grid-cols-2">
                    <div>
                        <label class="mb-2 block text-sm font-semibold text-slate-200">Author Name</label>
                        <input type="text" wire:model="authorName" class="w-full rounded-xl border border-slate-700 bg-slate-950/80 px-4 py-3 text-sm text-white placeholder:text-slate-600 outline-none transition focus:border-teal-500 focus:ring-4 focus:ring-teal-500/10">
                        @error('authorName')<p class="mt-1 text-xs text-rose-400">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="mb-2 block text-sm font-semibold text-slate-200">Sort Order</label>
                        <input type="number" wire:model="testimonialSortOrder" class="w-full rounded-xl border border-slate-700 bg-slate-950/80 px-4 py-3 text-sm text-white placeholder:text-slate-600 outline-none transition focus:border-teal-500 focus:ring-4 focus:ring-teal-500/10">
                    </div>
                </div>

                <div class="grid gap-4 sm:grid-cols-2">
                    <div>
                        <label class="mb-2 block text-sm font-semibold text-slate-200">Designation (e.g. CEO)</label>
                        <input type="text" wire:model="authorDesignation" class="w-full rounded-xl border border-slate-700 bg-slate-950/80 px-4 py-3 text-sm text-white placeholder:text-slate-600 outline-none transition focus:border-teal-500 focus:ring-4 focus:ring-teal-500/10">
                    </div>
                    <div>
                        <label class="mb-2 block text-sm font-semibold text-slate-200">Organization (Optional)</label>
                        <input type="text" wire:model="authorOrganization" class="w-full rounded-xl border border-slate-700 bg-slate-950/80 px-4 py-3 text-sm text-white placeholder:text-slate-600 outline-none transition focus:border-teal-500 focus:ring-4 focus:ring-teal-500/10">
                    </div>
                </div>

                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-200">Avatar Image Path</label>
                    <div class="flex gap-2">
                        <input type="text" wire:model.lazy="authorAvatar" placeholder="images/testimonials/user-1.jpg" class="flex-1 rounded-xl border border-slate-700 bg-slate-950/80 px-4 py-3 text-sm text-white placeholder:text-slate-600 outline-none transition focus:border-teal-500 focus:ring-4 focus:ring-teal-500/10">
                        <button type="button" wire:click="$dispatch('open-media-picker', { targetEvent: 'media-selected-slide', params: 'authorAvatar' })" class="px-5 py-3 bg-slate-800 border border-slate-700 hover:border-teal-500 text-white font-semibold text-sm rounded-xl transition shadow-sm whitespace-nowrap">
                            Browse
                        </button>
                    </div>
                </div>

                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-200">Quote Content</label>
                    <textarea wire:model="testimonialQuote" rows="4" class="w-full resize-y rounded-xl border border-slate-700 bg-slate-950/80 px-4 py-3 text-sm text-white placeholder:text-slate-600 outline-none transition focus:border-teal-500 focus:ring-4 focus:ring-teal-500/10"></textarea>
                    @error('testimonialQuote')<p class="mt-1 text-xs text-rose-400">{{ $message }}</p>@enderror
                </div>

                <div class="rounded-xl border border-slate-700 bg-slate-950/50 p-3.5">
                    <label class="flex cursor-pointer items-center justify-between gap-4">
                        <span>
                            <span class="block text-sm font-semibold text-slate-200">Enabled</span>
                            <span class="mt-0.5 block text-xs text-slate-600">Show this testimonial on the homepage.</span>
                        </span>
                        <span class="relative inline-flex flex-none">
                            <input type="checkbox" wire:model="testimonialEnabled" class="peer sr-only">
                            <span class="h-7 w-12 rounded-full bg-slate-700 transition peer-checked:bg-teal-500 peer-focus:ring-4 peer-focus:ring-teal-500/15"></span>
                            <span class="absolute left-1 top-1 h-5 w-5 rounded-full bg-white shadow transition peer-checked:translate-x-5"></span>
                        </span>
                    </label>
                </div>
            </div>
        </x-admin.modal>
    </div>
</div>
