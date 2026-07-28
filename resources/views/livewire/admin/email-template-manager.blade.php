{{-- cspell:ignore linecap linejoin --}}
<div class="space-y-6">
    @section('title', 'Email Templates - Admin Panel')
    @section('page_title', 'Email Templates')

    <x-admin.page-header title="Email Templates"
        description="Control transactional email content, preview every message, and safely test delivery before it reaches users."
        module="Communication" actionText="New custom template" actionMethod="create"
        actionPermission="create email templates" icon="mail" />

    <div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
        <x-admin.stat-card title="Templates" :value="$stats['total']" icon="mail" color="indigo" />
        <x-admin.stat-card title="Active" :value="$stats['active']" icon="check" color="emerald" />
        <x-admin.stat-card title="System" :value="$stats['system']" icon="shield" color="cyan" />
        <x-admin.stat-card title="Custom" :value="$stats['custom']" icon="sparkles" color="violet" />
    </div>

    <section
        class="overflow-hidden rounded-3xl border border-slate-700/60 bg-slate-900/45 shadow-2xl shadow-slate-950/20 backdrop-blur-sm">
        <div class="border-b border-slate-700/60 p-4 sm:p-5">
            <div class="flex flex-col gap-4 xl:flex-row xl:items-center xl:justify-between">
                <div>
                    <h2 class="text-lg font-black text-white">Transactional message library</h2>
                    <p class="mt-1 text-sm text-slate-500">System keys are immutable; labels and message content remain
                        editable.</p>
                </div>
                <div class="grid w-full gap-2 sm:grid-cols-2 xl:w-auto xl:grid-cols-[minmax(18rem,24rem)_12rem_11rem]">
                    <div class="relative min-w-0 sm:col-span-2 xl:col-span-1">
                        <svg class="pointer-events-none absolute left-3.5 top-1/2 h-4 w-4 -translate-y-1/2 text-slate-600"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m21 21-4.35-4.35m2.1-5.4a7.5 7.5 0 1 1-15 0 7.5 7.5 0 0 1 15 0Z" />
                        </svg>
                        <input wire:model.live.debounce.300ms="search" type="search"
                            class="h-11 w-full min-w-0 rounded-xl border border-slate-700 bg-slate-950/70 pl-10 pr-4 text-sm text-slate-200 outline-none focus:border-teal-500 focus:ring-4 focus:ring-teal-500/10"
                            placeholder="Search templates">
                    </div>
                    <select wire:model.live="categoryFilter"
                        class="h-11 w-full min-w-0 rounded-xl border border-slate-700 bg-slate-950/70 px-3.5 text-sm text-slate-300 outline-none focus:border-teal-500">
                        <option value="all">All categories</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category }}">{{ $category }}</option>
                        @endforeach
                    </select>
                    <select wire:model.live="statusFilter"
                        class="h-11 w-full min-w-0 rounded-xl border border-slate-700 bg-slate-950/70 px-3.5 text-sm text-slate-300 outline-none focus:border-teal-500">
                        <option value="all">Any status</option>
                        <option value="active">Active</option>
                        <option value="paused">Paused</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="grid gap-4 p-4 md:grid-cols-2 2xl:grid-cols-3 sm:p-5">
            @forelse($templates as $template)
                <article wire:key="email-template-{{ $template->id }}"
                    class="group relative flex min-h-72 flex-col overflow-hidden rounded-2xl border border-slate-700/60 bg-slate-950/40 p-5 transition hover:-translate-y-0.5 hover:border-teal-400/25 hover:bg-slate-900/80 hover:shadow-xl">
                    <div
                        class="absolute inset-x-8 top-0 h-px bg-gradient-to-r from-transparent via-teal-400/60 to-transparent opacity-0 transition group-hover:opacity-100">
                    </div>
                    <div class="flex items-start justify-between gap-3">
                        <div class="flex min-w-0 items-center gap-3">
                            <span
                                class="flex h-11 w-11 flex-none items-center justify-center rounded-xl border {{ $template->is_active ? 'border-teal-400/20 bg-teal-400/10 text-teal-300' : 'border-slate-700 bg-slate-800 text-slate-500' }}">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                        d="M21.75 6.75v10.5A2.25 2.25 0 0 1 19.5 19.5h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0-8.57 5.27a2.25 2.25 0 0 1-2.36 0L2.25 6.75" />
                                </svg>
                            </span>
                            <div class="min-w-0">
                                <p class="truncate text-[10px] font-black uppercase tracking-[0.15em] text-teal-400">
                                    {{ $template->category }}</p>
                                <h3 class="mt-1 truncate text-base font-black text-white">{{ $template->name }}</h3>
                            </div>
                        </div>
                        <span
                            class="rounded-full border px-2.5 py-1 text-[9px] font-black uppercase tracking-wider {{ $template->is_active ? 'border-emerald-400/20 bg-emerald-400/10 text-emerald-300' : 'border-slate-700 bg-slate-800 text-slate-500' }}">
                            {{ $template->is_active ? 'Active' : 'Paused' }}
                        </span>
                    </div>

                    <p class="mt-4 line-clamp-2 text-sm leading-6 text-slate-500">
                        {{ $template->description ?: 'Custom transactional email template.' }}</p>
                    <div class="mt-4 rounded-xl border border-slate-800 bg-slate-950/70 p-3">
                        <p class="text-[9px] font-black uppercase tracking-wider text-slate-700">Subject</p>
                        <p class="mt-1.5 line-clamp-2 text-sm font-bold leading-5 text-slate-300">
                            {{ $template->subject }}</p>
                    </div>
                    <div class="mt-3 flex flex-wrap gap-1.5">
                        <span
                            class="rounded-lg border border-slate-700 bg-slate-800/60 px-2 py-1 font-mono text-[10px] text-slate-500">{{ $template->key }}</span>
                        <span
                            class="rounded-lg border px-2 py-1 text-[9px] font-black uppercase tracking-wider {{ $template->is_system ? 'border-cyan-400/20 bg-cyan-400/10 text-cyan-300' : 'border-violet-400/20 bg-violet-400/10 text-violet-300' }}">{{ $template->is_system ? 'System' : 'Custom' }}</span>
                    </div>

                    <div class="mt-auto flex items-center justify-between gap-3 border-t border-slate-800 pt-4">
                        <div class="min-w-0 text-[10px] text-slate-600">
                            @if ($template->updatedBy)
                                Edited by <span class="text-slate-400">{{ $template->updatedBy->name }}</span>
                            @else
                                Migration default
                            @endif
                        </div>
                        <div class="flex flex-none items-center gap-1">
                            @can(\App\Support\AdminPermissions::EMAIL_TEMPLATE_SEND_TEST)
                                <button wire:click="openTestModal({{ $template->id }})" type="button"
                                    class="flex h-9 w-9 items-center justify-center rounded-xl text-slate-500 transition hover:bg-cyan-400/10 hover:text-cyan-300 focus:outline-none focus:ring-2 focus:ring-cyan-400/40"
                                    title="Send test email" aria-label="Send a test of {{ $template->name }}">
                                    <svg class="h-4.5 w-4.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                        aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                            d="m6 12-3.27-8.51A59.77 59.77 0 0 1 21.49 12 59.77 59.77 0 0 1 2.73 20.51L6 12Zm0 0h7.5" />
                                    </svg>
                                </button>
                            @endcan
                            <button wire:click="preview({{ $template->id }})" type="button"
                                class="flex h-9 w-9 items-center justify-center rounded-xl text-slate-500 transition hover:bg-teal-400/10 hover:text-teal-300"
                                title="Preview">
                                <svg class="h-4.5 w-4.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                        d="M2.04 12.32a1.01 1.01 0 0 1 0-.64C3.42 7.51 7.36 4.5 12 4.5s8.58 3.01 9.96 7.18c.07.21.07.43 0 .64C20.58 16.49 16.64 19.5 12 19.5s-8.58-3.01-9.96-7.18Z M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                </svg>
                            </button>
                            @can('edit email templates')
                                <button wire:click="edit({{ $template->id }})" type="button"
                                    class="flex h-9 w-9 items-center justify-center rounded-xl text-slate-500 transition hover:bg-indigo-400/10 hover:text-indigo-300"
                                    title="Edit">
                                    <svg class="h-4.5 w-4.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                            d="m16.86 4.49 2.65 2.65M5.25 18.75l3.31-.66L19.5 7.14a1.875 1.875 0 0 0-2.65-2.65L5.9 15.44l-.65 3.31Z" />
                                    </svg>
                                </button>
                                <button wire:click="toggleActive({{ $template->id }})" type="button"
                                    class="flex h-9 w-9 items-center justify-center rounded-xl text-slate-500 transition hover:bg-amber-400/10 hover:text-amber-300"
                                    title="{{ $template->is_active ? 'Pause' : 'Activate' }}">
                                    <svg class="h-4.5 w-4.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                            d="M15.75 5.25v13.5m-7.5-13.5v13.5" />
                                    </svg>
                                </button>
                                @if ($template->is_system)
                                    <button wire:click="confirmReset({{ $template->id }})" type="button"
                                        class="flex h-9 w-9 items-center justify-center rounded-xl text-slate-500 transition hover:bg-cyan-400/10 hover:text-cyan-300"
                                        title="Restore defaults">
                                        <svg class="h-4.5 w-4.5" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                                d="M16.02 9.35h4.24V5.11M19.5 9a7.5 7.5 0 1 0 1.1 5.2" />
                                        </svg>
                                    </button>
                                @else
                                    @can('delete email templates')
                                        <button wire:click="confirmDelete({{ $template->id }})" type="button"
                                            class="flex h-9 w-9 items-center justify-center rounded-xl text-slate-500 transition hover:bg-rose-400/10 hover:text-rose-300"
                                            title="Delete">
                                            <svg class="h-4.5 w-4.5" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                                    d="m14.74 9-.35 9m-4.78 0L9.26 9m9.97-3.21-1.07 13.88A2.25 2.25 0 0 1 15.92 21H8.08a2.25 2.25 0 0 1-2.24-2.08L4.77 5.79M9.62 5V4.08c0-1.18.91-2.17 2.09-2.2h.58c1.18.03 2.09 1.02 2.09 2.2V5" />
                                            </svg>
                                        </button>
                                    @endcan
                                @endif
                            @endcan
                        </div>
                    </div>
                </article>
            @empty
                <div class="col-span-full py-20 text-center">
                    <p class="text-base font-black text-white">No email templates found</p>
                    <p class="mt-1 text-sm text-slate-500">Adjust the search or filters.</p>
                </div>
            @endforelse
        </div>

        @if ($templates->hasPages())
            <div class="border-t border-slate-700/60 px-5 py-4">{{ $templates->links(data: ['scrollTo' => false]) }}
            </div>
        @endif
    </section>

    @if ($showEditor)
        <div class="fixed inset-0 z-[100]" role="dialog" aria-modal="true"
            aria-labelledby="email-template-editor-title">
            <div class="fixed inset-0 bg-slate-950/85 backdrop-blur-sm" wire:click="closeEditor"></div>
            <div class="absolute inset-0 overflow-x-hidden overflow-y-auto">
                <div class="flex min-h-full items-start justify-center p-3 sm:p-6">
                    <form wire:submit="save"
                        class="relative my-3 w-full max-w-5xl overflow-hidden rounded-3xl border border-slate-700/60 bg-slate-900 shadow-2xl shadow-black/60">
                        <div
                            class="flex items-start justify-between gap-4 border-b border-slate-700/60 px-5 py-5 sm:px-7">
                            <div>
                                <p class="text-[10px] font-black uppercase tracking-[0.16em] text-teal-400">Template
                                    editor</p>
                                <h2 id="email-template-editor-title" class="mt-1 text-xl font-black text-white">
                                    {{ $templateId ? 'Edit email template' : 'Create custom template' }}</h2>
                                <p class="mt-1 text-sm text-slate-500">Variables are escaped before rendering; system
                                    keys cannot be changed.</p>
                            </div>
                            <button wire:click="closeEditor" type="button"
                                class="flex h-10 w-10 flex-none items-center justify-center rounded-xl text-slate-500 hover:bg-slate-800 hover:text-white"
                                aria-label="Close"><svg class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-width="2" d="M6 18 18 6M6 6l12 12" />
                                </svg></button>
                        </div>

                        <div class="grid gap-6 p-5 sm:p-7 lg:grid-cols-2">
                            <div class="space-y-5">
                                <x-admin.form-group label="Machine key" name="key" required>
                                    <input wire:model="key" id="key" type="text"
                                        {{ $templateId ? 'disabled' : '' }}
                                        class="w-full rounded-xl border border-slate-700 bg-slate-950 px-4 py-3 font-mono text-sm text-slate-200 outline-none focus:border-teal-500 disabled:cursor-not-allowed disabled:opacity-60">
                                </x-admin.form-group>
                                <div class="grid gap-4 sm:grid-cols-2">
                                    <x-admin.form-group label="Display name" name="name" required>
                                        <input wire:model="name" id="name" type="text"
                                            class="w-full rounded-xl border border-slate-700 bg-slate-950 px-4 py-3 text-sm text-white outline-none focus:border-teal-500">
                                    </x-admin.form-group>
                                    <x-admin.form-group label="Category" name="category" required>
                                        <input wire:model="category" id="category" type="text"
                                            class="w-full rounded-xl border border-slate-700 bg-slate-950 px-4 py-3 text-sm text-white outline-none focus:border-teal-500">
                                    </x-admin.form-group>
                                </div>
                                <x-admin.form-group label="Description" name="description">
                                    <textarea wire:model="description" id="description" rows="3"
                                        class="w-full rounded-xl border border-slate-700 bg-slate-950 px-4 py-3 text-sm text-white outline-none focus:border-teal-500"></textarea>
                                </x-admin.form-group>
                                <div class="grid gap-4 sm:grid-cols-2">
                                    <label
                                        class="flex items-center justify-between rounded-xl border border-slate-700 bg-slate-950 p-4">
                                        <span><span class="block text-sm font-bold text-white">Active
                                                delivery</span><span class="mt-1 block text-xs text-slate-600">Allow
                                                this email to send.</span></span>
                                        <input wire:model="isActive" type="checkbox"
                                            class="h-5 w-5 rounded border-slate-600 bg-slate-800 text-teal-500 focus:ring-teal-500">
                                    </label>
                                    <x-admin.form-group label="Display order" name="sortOrder">
                                        <input wire:model="sortOrder" id="sortOrder" type="number" min="0"
                                            max="65535"
                                            class="w-full rounded-xl border border-slate-700 bg-slate-950 px-4 py-3 text-sm text-white outline-none focus:border-teal-500">
                                    </x-admin.form-group>
                                </div>
                            </div>

                            <div class="space-y-5">
                                <x-admin.form-group label="Email subject" name="subject" required>
                                    <input wire:model="subject" id="subject" type="text"
                                        class="w-full rounded-xl border border-slate-700 bg-slate-950 px-4 py-3 text-sm text-white outline-none focus:border-teal-500">
                                </x-admin.form-group>
                                <x-admin.form-group label="Inbox preheader" name="preheader">
                                    <input wire:model="preheader" id="preheader" type="text"
                                        class="w-full rounded-xl border border-slate-700 bg-slate-950 px-4 py-3 text-sm text-white outline-none focus:border-teal-500">
                                </x-admin.form-group>
                                @if ($availableVariables)
                                    <div class="rounded-xl border border-cyan-400/15 bg-cyan-400/5 p-4">
                                        <p class="text-[10px] font-black uppercase tracking-wider text-cyan-300">
                                            Available variables</p>
                                        <div class="mt-2 flex flex-wrap gap-1.5">
                                            @foreach ($availableVariables as $variable)
                                                <code
                                                    class="rounded-lg bg-slate-950 px-2 py-1 text-[10px] text-cyan-200">{{ '{' . '{ ' . $variable . ' }' . '}' }}</code>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            </div>

                            <div class="lg:col-span-2">
                                <x-admin.form-group label="HTML message body" name="bodyHtml" required>
                                    <textarea wire:model="bodyHtml" id="bodyHtml" rows="13" spellcheck="false"
                                        class="w-full rounded-xl border border-slate-700 bg-slate-950 px-4 py-3 font-mono text-xs leading-6 text-slate-200 outline-none focus:border-teal-500"></textarea>
                                </x-admin.form-group>
                                <x-admin.form-group label="Plain-text alternative (optional)" name="bodyText">
                                    <textarea wire:model="bodyText" id="bodyText" rows="6"
                                        class="w-full rounded-xl border border-slate-700 bg-slate-950 px-4 py-3 font-mono text-xs leading-6 text-slate-200 outline-none focus:border-teal-500"
                                        placeholder="Automatically generated from HTML when blank."></textarea>
                                </x-admin.form-group>
                            </div>
                        </div>

                        <div
                            class="flex flex-col-reverse gap-3 border-t border-slate-700/60 bg-slate-950/30 px-5 py-4 sm:flex-row sm:justify-end sm:px-7">
                            <button wire:click="closeEditor" type="button"
                                class="rounded-xl border border-slate-700 bg-slate-800 px-5 py-2.5 text-sm font-bold text-slate-300 hover:bg-slate-700">Cancel</button>
                            <button type="submit"
                                class="rounded-xl bg-gradient-to-r from-teal-500 to-cyan-500 px-6 py-2.5 text-sm font-black text-white shadow-lg shadow-teal-950/30 hover:from-teal-400 hover:to-cyan-400">Save
                                template</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif

    @if ($showPreview)
        <div class="fixed inset-0 z-[100]" role="dialog" aria-modal="true" aria-labelledby="email-preview-title">
            <div class="fixed inset-0 bg-slate-950/85 backdrop-blur-sm" wire:click="closePreview"></div>
            <div class="absolute inset-0 overflow-x-hidden overflow-y-auto">
                <div class="flex min-h-full items-start justify-center p-3 sm:p-6">
                    <div
                        class="relative my-3 w-full max-w-5xl overflow-hidden rounded-3xl border border-slate-700/60 bg-slate-900 shadow-2xl">
                        <div
                            class="flex flex-col gap-4 border-b border-slate-700/60 px-5 py-5 sm:flex-row sm:items-center sm:justify-between sm:px-7">
                            <div>
                                <p class="text-[10px] font-black uppercase tracking-[0.16em] text-teal-400">Rendered
                                    with safe sample data</p>
                                <h2 id="email-preview-title" class="mt-1 text-xl font-black text-white">
                                    {{ $previewName }}</h2>
                            </div>
                            <div class="flex items-center gap-2">
                                @can(\App\Support\AdminPermissions::EMAIL_TEMPLATE_SEND_TEST)
                                    <button wire:click="openTestModal({{ $templateId }})" type="button"
                                        class="inline-flex h-10 flex-none items-center gap-2 rounded-xl border border-cyan-400/20 bg-cyan-400/10 px-4 text-xs font-black text-cyan-200 transition hover:border-cyan-400/40 hover:bg-cyan-400/20">
                                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                            aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                                d="m6 12-3.27-8.51A59.77 59.77 0 0 1 21.49 12 59.77 59.77 0 0 1 2.73 20.51L6 12Zm0 0h7.5" />
                                        </svg>
                                        Send test
                                    </button>
                                @endcan
                                <button wire:click="closePreview" type="button"
                                    class="flex h-10 w-10 flex-none items-center justify-center rounded-xl text-slate-500 hover:bg-slate-800 hover:text-white"
                                    aria-label="Close"><svg class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-width="2" d="M6 18 18 6M6 6l12 12" />
                                    </svg></button>
                            </div>
                        </div>
                        <div class="bg-slate-950 p-3 sm:p-5">
                            <iframe sandbox title="Email template preview"
                                class="h-[70vh] w-full rounded-2xl border border-slate-700 bg-white"
                                srcdoc="{{ $previewHtml }}"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if ($showTestModal)
        <div class="fixed inset-0 z-[110]" role="dialog" aria-modal="true" aria-labelledby="email-test-title">
            <div class="fixed inset-0 bg-slate-950/90 backdrop-blur-md" wire:click="closeTestModal"></div>
            <div class="absolute inset-0 overflow-x-hidden overflow-y-auto">
                <div class="flex min-h-full items-start justify-center p-3 sm:items-center sm:p-6">
                    <form wire:submit="sendTestEmails"
                        class="relative my-3 w-full max-w-3xl overflow-hidden rounded-3xl border border-slate-700/70 bg-slate-900 shadow-2xl shadow-black/70">
                        <div class="relative overflow-hidden border-b border-slate-700/60 px-5 py-5 sm:px-7 sm:py-6">
                            <div
                                class="pointer-events-none absolute -right-12 -top-16 h-40 w-40 rounded-full bg-cyan-400/10 blur-3xl">
                            </div>
                            <div class="relative flex items-start justify-between gap-4">
                                <div class="flex min-w-0 items-start gap-3.5">
                                    <span
                                        class="flex h-11 w-11 flex-none items-center justify-center rounded-2xl border border-cyan-400/20 bg-cyan-400/10 text-cyan-300">
                                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                                d="m6 12-3.27-8.51A59.77 59.77 0 0 1 21.49 12 59.77 59.77 0 0 1 2.73 20.51L6 12Zm0 0h7.5" />
                                        </svg>
                                    </span>
                                    <div class="min-w-0">
                                        <p class="text-[10px] font-black uppercase tracking-[0.16em] text-cyan-400">
                                            Safe delivery test</p>
                                        <h2 id="email-test-title" class="mt-1 truncate text-xl font-black text-white">
                                            Send “{{ $testTemplateName }}”</h2>
                                        <p class="mt-1 text-sm text-slate-500">Names personalize the preview data and
                                            are optional. Emails are required.</p>
                                    </div>
                                </div>
                                <button wire:click="closeTestModal" type="button"
                                    class="flex h-10 w-10 flex-none items-center justify-center rounded-xl text-slate-500 transition hover:bg-slate-800 hover:text-white"
                                    aria-label="Close test email dialog">
                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-width="2" d="M6 18 18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <div class="max-h-[58vh] space-y-3 overflow-y-auto px-5 py-5 sm:px-7">
                            <div class="flex items-center justify-between gap-3">
                                <div>
                                    <h3 class="text-sm font-black text-white">Test recipients</h3>
                                    <p class="mt-0.5 text-xs text-slate-600">Up to 10 unique email addresses.</p>
                                </div>
                                @if (count($testRecipients) < 10)
                                    <button wire:click="addTestRecipient" type="button"
                                        class="inline-flex items-center gap-1.5 rounded-xl border border-slate-700 bg-slate-800/70 px-3 py-2 text-xs font-bold text-slate-300 transition hover:border-cyan-400/30 hover:text-cyan-300">
                                        <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-width="2" d="M12 5v14M5 12h14" />
                                        </svg>
                                        Add recipient
                                    </button>
                                @endif
                            </div>

                            @foreach ($testRecipients as $index => $recipient)
                                <div wire:key="test-recipient-{{ $index }}"
                                    class="rounded-2xl border border-slate-700/60 bg-slate-950/45 p-4">
                                    <div class="mb-3 flex items-center justify-between">
                                        <span
                                            class="flex h-6 w-6 items-center justify-center rounded-lg bg-cyan-400/10 text-[10px] font-black text-cyan-300">{{ $index + 1 }}</span>
                                        @if (count($testRecipients) > 1)
                                            <button wire:click="removeTestRecipient({{ $index }})"
                                                type="button"
                                                class="inline-flex items-center gap-1 text-[10px] font-black uppercase tracking-wider text-slate-600 transition hover:text-rose-400"
                                                aria-label="Remove recipient {{ $index + 1 }}">
                                                <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24"
                                                    stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-width="2"
                                                        d="M6 18 18 6M6 6l12 12" />
                                                </svg>
                                                Remove
                                            </button>
                                        @endif
                                    </div>
                                    <div class="grid gap-3 sm:grid-cols-2">
                                        <div>
                                            <label for="test-recipient-name-{{ $index }}"
                                                class="mb-1.5 block text-[10px] font-black uppercase tracking-wider text-slate-500">Name
                                                <span
                                                    class="font-medium normal-case tracking-normal text-slate-700">(optional)</span></label>
                                            <input wire:model="testRecipients.{{ $index }}.name"
                                                id="test-recipient-name-{{ $index }}" type="text"
                                                maxlength="120" autocomplete="name"
                                                class="h-11 w-full rounded-xl border border-slate-700 bg-slate-950 px-3.5 text-sm text-white outline-none transition placeholder:text-slate-700 focus:border-cyan-500 focus:ring-4 focus:ring-cyan-500/10"
                                                placeholder="e.g. Ayesha Khan">
                                            @error("testRecipients.$index.name")
                                                <p class="mt-1.5 text-xs font-bold text-rose-400">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div>
                                            <label for="test-recipient-email-{{ $index }}"
                                                class="mb-1.5 block text-[10px] font-black uppercase tracking-wider text-slate-500">Email
                                                <span class="text-rose-400">*</span></label>
                                            <input wire:model="testRecipients.{{ $index }}.email"
                                                id="test-recipient-email-{{ $index }}" type="email"
                                                maxlength="255" autocomplete="email"
                                                class="h-11 w-full rounded-xl border border-slate-700 bg-slate-950 px-3.5 text-sm text-white outline-none transition placeholder:text-slate-700 focus:border-cyan-500 focus:ring-4 focus:ring-cyan-500/10"
                                                placeholder="name@example.com">
                                            @error("testRecipients.$index.email")
                                                <p class="mt-1.5 text-xs font-bold text-rose-400">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                            @error('testRecipients')
                                <p class="text-xs font-bold text-rose-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div
                            class="flex flex-col-reverse gap-3 border-t border-slate-700/60 bg-slate-950/30 px-5 py-4 sm:flex-row sm:items-center sm:justify-between sm:px-7">
                            <p class="text-xs text-slate-600">Uses sample variables. No account status is changed.</p>
                            <div class="flex items-center justify-end gap-2">
                                <button wire:click="closeTestModal" type="button"
                                    class="h-10 rounded-xl border border-slate-700 bg-slate-800 px-4 text-xs font-bold text-slate-300 transition hover:bg-slate-700">Cancel</button>
                                <button type="button" wire:click="sendTestEmails" wire:loading.attr="disabled"
                                    wire:target="sendTestEmails"
                                    class="inline-flex h-10 items-center gap-2 rounded-xl bg-gradient-to-r from-cyan-500 to-teal-500 px-5 text-xs font-black text-slate-950 shadow-lg shadow-cyan-950/30 transition hover:from-cyan-400 hover:to-teal-400 disabled:cursor-wait disabled:opacity-60">
                                    <svg wire:loading.remove wire:target="sendTestEmails"
                                        class="pointer-events-none h-4 w-4" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                            d="m6 12-3.27-8.51A59.77 59.77 0 0 1 21.49 12 59.77 59.77 0 0 1 2.73 20.51L6 12Zm0 0h7.5" />
                                    </svg>
                                    <svg wire:loading wire:target="sendTestEmails"
                                        class="pointer-events-none h-4 w-4 animate-spin" fill="none"
                                        viewBox="0 0 24 24" aria-hidden="true">
                                        <circle class="opacity-25" cx="12" cy="12" r="9"
                                            stroke="currentColor" stroke-width="3" />
                                        <path class="opacity-75" fill="currentColor"
                                            d="M21 12a9 9 0 0 0-9-9v3a6 6 0 0 1 6 6h3Z" />
                                    </svg>
                                    Send
                                    {{ count($testRecipients) === 1 ? 'test email' : count($testRecipients) . ' test emails' }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
</div>
