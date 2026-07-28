<div>
    @section('title', 'FAQ Management - Admin Panel')
    @section('page_title', 'FAQ Management')

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
                    if (event.detail.modalId === 'faqModal') {
                        @this.save();
                    }
                });
            }
        }">
        
        {{-- Page header --}}
        <x-admin.page-header 
            title="Frequently Asked Questions" 
            description="Create, organize, publish, and maintain helpful answers for your website visitors from one place."
            module="Knowledge Base"
            actionText="Add New FAQ"
            actionMethod="create" 
            actionPermission="create faqs"
        />

        {{-- Statistics --}}
        <section class="grid gap-4 sm:grid-cols-3">
            <x-admin.stat-card 
                title="Total FAQs" 
                value="{{ number_format($totalFaqs) }}" 
                color="cyan" 
                icon='<svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M8.625 9.75a3.375 3.375 0 116.75 0c0 1.205-.633 2.263-1.584 2.86-.806.506-1.791 1.188-1.791 2.265v.375M12 18h.008v.008H12V18z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>' 
            />

            <x-admin.stat-card 
                title="Published" 
                value="{{ number_format($activeFaqs) }}" 
                color="emerald" 
                icon='<svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12.75l2.25 2.25L15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>' 
            />

            <x-admin.stat-card 
                title="Draft / Hidden" 
                value="{{ number_format($inactiveFaqs) }}" 
                color="amber" 
                icon='<svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 6v6l4 2.25M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>' 
            />
        </section>

        {{-- Main content card --}}
        <section class="overflow-hidden rounded-3xl border border-slate-700/60 bg-slate-900/65 shadow-2xl shadow-slate-950/20 backdrop-blur-xl">
            <div class="border-b border-slate-700/60 p-4 sm:p-5">
                <div class="flex flex-col gap-3 lg:flex-row lg:items-center lg:justify-between">
                    <div>
                        <h2 class="text-lg font-bold text-white">FAQ Directory</h2>
                        <p class="mt-1 text-sm text-slate-500">Search and filter your existing questions.</p>
                    </div>

                    <div class="flex flex-col gap-3 sm:flex-row sm:items-center">
                        <div class="relative min-w-0 sm:w-72">
                            <svg class="pointer-events-none absolute left-3.5 top-1/2 h-4.5 w-4.5 -translate-y-1/2 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m21 21-4.35-4.35m2.1-5.4a7.5 7.5 0 11-15 0 7.5 7.5 0 0115 0z" />
                            </svg>
                            <input
                                wire:model.live.debounce.250ms="search"
                                type="search"
                                placeholder="Search questions or answers..."
                                class="h-11 w-full rounded-xl border border-slate-700 bg-slate-950/70 pl-10 pr-9 text-sm text-white placeholder:text-slate-600 outline-none transition focus:border-teal-500 focus:ring-4 focus:ring-teal-500/10"
                                aria-label="Search FAQs"
                            >
                            @if($search)
                            <button
                                type="button"
                                wire:click="$set('search', '')"
                                class="absolute right-2.5 top-1/2 -translate-y-1/2 rounded-md p-1 text-slate-500 hover:bg-slate-800 hover:text-white"
                                aria-label="Clear search"
                            >
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                            @endif
                        </div>

                        <select
                            wire:model.live="status"
                            class="h-11 rounded-xl border border-slate-700 bg-slate-950/70 px-3.5 text-sm text-slate-300 outline-none transition focus:border-teal-500 focus:ring-4 focus:ring-teal-500/10"
                            aria-label="Filter FAQs by status"
                        >
                            <option value="all">All statuses</option>
                            <option value="active">Published</option>
                            <option value="inactive">Draft / Hidden</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="relative min-h-[300px]">
                {{-- Loading overlay --}}
                <div wire:loading wire:target="search, status, previousPage, nextPage, gotoPage" class="absolute inset-0 z-10 flex items-center justify-center bg-slate-950/40 backdrop-blur-sm">
                    <div class="flex items-center gap-3 rounded-2xl bg-slate-900/90 px-5 py-3.5 text-sm font-semibold text-white shadow-2xl shadow-black/50 border border-slate-800">
                        <svg class="h-5 w-5 animate-spin text-teal-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        Loading...
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-700/60">
                        <thead class="bg-slate-950/35">
                            <tr>
                                <th scope="col" class="px-5 py-4 text-left text-[11px] font-bold uppercase tracking-[0.14em] text-slate-500 sm:px-6">Question & Answer</th>
                                <th scope="col" class="px-5 py-4 text-center text-[11px] font-bold uppercase tracking-[0.14em] text-slate-500">Order</th>
                                <th scope="col" class="px-5 py-4 text-left text-[11px] font-bold uppercase tracking-[0.14em] text-slate-500">Status</th>
                                <th scope="col" class="px-5 py-4 text-right text-[11px] font-bold uppercase tracking-[0.14em] text-slate-500 sm:px-6">Actions</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-slate-800/80">
                            @forelse($faqs as $faq)
                                <tr class="group bg-transparent transition hover:bg-slate-800/35">
                                    <td class="min-w-[320px] px-5 py-5 sm:px-6">
                                        <div class="flex items-start gap-3.5">
                                            <div class="mt-0.5 flex h-10 w-10 flex-none items-center justify-center rounded-xl border border-slate-700 bg-slate-800/70 text-sm font-black text-teal-300 shadow-inner">
                                                {{ str_pad($loop->iteration + ($faqs->currentPage() - 1) * $faqs->perPage(), 2, '0', STR_PAD_LEFT) }}
                                            </div>
                                            <div class="min-w-0">
                                                <p class="font-semibold leading-6 text-slate-100 transition group-hover:text-white">
                                                    {{ $faq->question }}
                                                </p>
                                                <p class="mt-1.5 line-clamp-2 max-w-2xl text-sm leading-6 text-slate-500">
                                                    {{ Str::limit(strip_tags($faq->answer), 150) }}
                                                </p>
                                            </div>
                                        </div>
                                    </td>

                                    <td class="px-5 py-5 text-center">
                                        <span class="inline-flex min-w-9 items-center justify-center rounded-lg border border-slate-700 bg-slate-800/70 px-2.5 py-1.5 text-xs font-bold tabular-nums text-slate-300">
                                            {{ $faq->sort_order }}
                                        </span>
                                    </td>

                                    <td class="px-5 py-5 whitespace-nowrap">
                                        @if($faq->is_active)
                                            <span class="inline-flex items-center gap-1.5 rounded-full border border-emerald-400/20 bg-emerald-400/10 px-2.5 py-1 text-xs font-semibold text-emerald-300">
                                                <span class="h-1.5 w-1.5 rounded-full bg-emerald-400 shadow-[0_0_8px_rgba(52,211,153,.75)]"></span>
                                                Published
                                            </span>
                                        @else
                                            <span class="inline-flex items-center gap-1.5 rounded-full border border-amber-400/20 bg-amber-400/10 px-2.5 py-1 text-xs font-semibold text-amber-300">
                                                <span class="h-1.5 w-1.5 rounded-full bg-amber-400"></span>
                                                Hidden
                                            </span>
                                        @endif
                                    </td>

                                    <td class="px-5 py-5 text-right sm:px-6">
                                        <div class="flex items-center justify-end gap-1.5">
                                            @can('edit faqs')
                                            <button
                                                type="button"
                                                wire:click="toggleStatus({{ $faq->id }})"
                                                class="relative inline-flex h-8 w-14 items-center rounded-full border border-transparent p-1 transition focus:outline-none focus:ring-4 focus:ring-teal-500/15 {{ $faq->is_active ? 'bg-teal-500' : 'bg-slate-700' }}"
                                                title="{{ $faq->is_active ? 'Hide FAQ' : 'Publish FAQ' }}"
                                            >
                                                <span class="inline-flex h-6 w-6 transform items-center justify-center rounded-full bg-white shadow-md transition {{ $faq->is_active ? 'translate-x-6' : 'translate-x-0' }}">
                                                    <span class="h-1.5 w-1.5 rounded-full {{ $faq->is_active ? 'bg-teal-500' : 'bg-slate-500' }}"></span>
                                                </span>
                                            </button>
                                            @endcan

                                            @can('edit faqs')
                                            <button
                                                type="button"
                                                wire:click="edit({{ $faq->id }})"
                                                class="inline-flex h-9 w-9 items-center justify-center rounded-xl border border-transparent text-slate-400 transition hover:border-teal-400/20 hover:bg-teal-400/10 hover:text-teal-300 focus:outline-none focus:ring-4 focus:ring-teal-500/10"
                                                title="Edit FAQ"
                                            >
                                                <svg class="h-4.5 w-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16.862 3.487a2.25 2.25 0 013.182 3.182L8.25 18.463 3.75 19.5l1.037-4.5L16.862 3.487z" />
                                                </svg>
                                            </button>
                                            @endcan

                                            @can('delete faqs')
                                            <button
                                                type="button"
                                                wire:click="confirmDelete({{ $faq->id }})"
                                                class="inline-flex h-9 w-9 items-center justify-center rounded-xl border border-transparent text-slate-400 transition hover:border-rose-400/20 hover:bg-rose-400/10 hover:text-rose-300 focus:outline-none focus:ring-4 focus:ring-rose-500/10"
                                                title="Delete FAQ"
                                            >
                                                <svg class="h-4.5 w-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166M19.228 5.79L18.16 19.673A2.25 2.25 0 0115.916 21.75H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0V4.477c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                                </svg>
                                            </button>
                                            @endcan
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-20 text-center">
                                        <div class="mx-auto flex max-w-md flex-col items-center">
                                            @if($search || $status !== 'all')
                                                <div class="mb-4 flex h-14 w-14 items-center justify-center rounded-2xl bg-slate-800 text-slate-500">
                                                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="m21 21-4.35-4.35m2.1-5.4a7.5 7.5 0 11-15 0 7.5 7.5 0 0115 0z" />
                                                    </svg>
                                                </div>
                                                <h3 class="font-semibold text-white">No matching FAQs</h3>
                                                <p class="mt-1 text-sm text-slate-500">Try another keyword or reset the status filter.</p>
                                                <button type="button" wire:click="$set('search', ''); $set('status', 'all')" class="mt-4 text-sm font-semibold text-teal-300 hover:text-teal-200">Clear filters</button>
                                            @else
                                                <div class="relative mb-5 flex h-20 w-20 items-center justify-center rounded-3xl border border-slate-700 bg-slate-800/60 text-slate-400 shadow-xl shadow-slate-950/20">
                                                    <div class="absolute inset-0 rounded-3xl bg-gradient-to-br from-teal-500/10 to-transparent"></div>
                                                    <svg class="relative h-9 w-9" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8.625 9.75a3.375 3.375 0 116.75 0c0 1.205-.633 2.263-1.584 2.86-.806.506-1.791 1.188-1.791 2.265v.375M12 18h.008v.008H12V18z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                    </svg>
                                                </div>
                                                <h3 class="text-lg font-bold text-white">No FAQs created yet</h3>
                                                <p class="mt-2 text-sm leading-6 text-slate-500">Build a useful knowledge base by adding your first frequently asked question.</p>
                                                @can('create faqs')
                                                <button
                                                    type="button"
                                                    wire:click="create"
                                                    class="mt-5 inline-flex items-center gap-2 rounded-xl border border-teal-400/20 bg-teal-400/10 px-4 py-2.5 text-sm font-semibold text-teal-300 transition hover:bg-teal-400/15 hover:text-teal-200"
                                                >
                                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.5v15m7.5-7.5h-15" />
                                                    </svg>
                                                    Create first FAQ
                                                </button>
                                                @endcan
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($faqs->hasPages())
                    <div class="border-t border-slate-700/60 px-5 py-4 sm:px-6">
                        {{ $faqs->links() }}
                    </div>
                @endif
            </div>
        </section>

        {{-- FAQ Modal (Create/Edit) --}}
        <x-admin.modal id="faqModal" maxWidth="3xl" :title="$faqId ? 'Edit FAQ' : 'Create FAQ'" confirmText="Save FAQ" confirmColor="teal">
            <div class="space-y-5">
                <div>
                    <label for="question" class="mb-2 block text-sm font-semibold text-slate-200">
                        Question <span class="text-rose-400">*</span>
                    </label>
                    <input
                        type="text"
                        wire:model="question"
                        id="question"
                        maxlength="255"
                        placeholder="e.g. How can I reset my password?"
                        class="w-full rounded-xl border border-slate-700 bg-slate-950/80 px-4 py-3 text-sm text-white placeholder:text-slate-600 outline-none transition focus:border-teal-500 focus:ring-4 focus:ring-teal-500/10 @error('question') border-rose-500 @enderror"
                    >
                    @error('question')<p class="mt-1.5 text-xs text-rose-400">{{ $message }}</p>@enderror
                </div>

                <div>
                    <div class="mb-2 flex items-center justify-between gap-3">
                        <label for="answer" class="block text-sm font-semibold text-slate-200">
                            Answer <span class="text-rose-400">*</span>
                        </label>
                        <span class="text-xs text-slate-600">Clear and concise works best</span>
                    </div>
                    <textarea
                        wire:model="answer"
                        id="answer"
                        rows="7"
                        placeholder="Write a helpful answer for your visitors..."
                        class="w-full resize-y rounded-xl border border-slate-700 bg-slate-950/80 px-4 py-3 text-sm leading-6 text-white placeholder:text-slate-600 outline-none transition focus:border-teal-500 focus:ring-4 focus:ring-teal-500/10 @error('answer') border-rose-500 @enderror"
                    ></textarea>
                    @error('answer')<p class="mt-1.5 text-xs text-rose-400">{{ $message }}</p>@enderror
                </div>

                <div class="grid gap-4 sm:grid-cols-2">
                    <div>
                        <label for="sort_order" class="mb-2 block text-sm font-semibold text-slate-200">Sort Order</label>
                        <input
                            type="number"
                            wire:model="sort_order"
                            id="sort_order"
                            min="0"
                            step="1"
                            class="w-full rounded-xl border border-slate-700 bg-slate-950/80 px-4 py-3 text-sm text-white outline-none transition focus:border-teal-500 focus:ring-4 focus:ring-teal-500/10"
                        >
                        <p class="mt-1.5 text-xs text-slate-600">Lower numbers appear first.</p>
                        @error('sort_order')<p class="mt-1.5 text-xs text-rose-400">{{ $message }}</p>@enderror
                    </div>

                    <div class="rounded-xl border border-slate-700 bg-slate-950/50 p-3.5">
                        <label class="flex cursor-pointer items-center justify-between gap-4">
                            <span>
                                <span class="block text-sm font-semibold text-slate-200">Published</span>
                                <span class="mt-0.5 block text-xs text-slate-600">Show this FAQ publicly.</span>
                            </span>
                            <span class="relative inline-flex flex-none">
                                <input type="checkbox" wire:model="is_active" class="peer sr-only">
                                <span class="h-7 w-12 rounded-full bg-slate-700 transition peer-checked:bg-teal-500 peer-focus:ring-4 peer-focus:ring-teal-500/15"></span>
                                <span class="absolute left-1 top-1 h-5 w-5 rounded-full bg-white shadow transition peer-checked:translate-x-5"></span>
                            </span>
                        </label>
                    </div>
                </div>
            </div>
        </x-admin.modal>
    </div>
</div>
