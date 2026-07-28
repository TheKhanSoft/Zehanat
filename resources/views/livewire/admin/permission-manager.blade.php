<div class="space-y-6">
    @section('title', 'Permissions - Admin Panel')
    @section('page_title', 'Permissions')

    <x-admin.page-header
        title="Permissions"
        description="Browse system capabilities and review where they are assigned."
        module="Settings"
        actionText="Add Permission"
        actionMethod="create"
        actionPermission="create permissions"
        icon="key"
    />

    <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-4">
        <x-admin.stat-card title="Total Permissions" :value="$permissions->total()" icon="key" color="indigo" />
    </div>

    <section class="overflow-hidden rounded-2xl border border-slate-700/60 bg-slate-900/45 backdrop-blur-sm">
        <div class="flex flex-col gap-4 border-b border-slate-700/60 p-4 sm:flex-row sm:items-center sm:justify-between sm:p-5">
            <div>
                <h2 class="text-lg font-black text-white">Permission catalog</h2>
                <p class="mt-1 text-sm text-slate-500">Cards show the capability, protected state, and assigned role count.</p>
            </div>
            <div class="flex w-full flex-col gap-2 sm:w-auto sm:flex-row">
                <div class="relative w-full sm:w-72">
                    <svg class="pointer-events-none absolute left-3.5 top-1/2 h-4.5 w-4.5 -translate-y-1/2 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m21 21-4.35-4.35m2.1-5.4a7.5 7.5 0 1 1-15 0 7.5 7.5 0 0 1 15 0Z" /></svg>
                    <input wire:model.live.debounce.300ms="search" type="search" class="h-11 w-full rounded-xl border border-slate-700 bg-slate-950/70 pl-10 pr-4 text-sm text-slate-300 placeholder:text-slate-600 outline-none transition focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10" placeholder="Search permissions">
                </div>
                <button wire:click="sortBy('name')" type="button" class="inline-flex h-11 items-center justify-center gap-2 rounded-xl border border-slate-700 bg-slate-800/70 px-3.5 text-xs font-black text-slate-400 transition hover:border-indigo-400/30 hover:text-indigo-300" title="Toggle name sorting">
                    Name
                    <svg class="h-4 w-4 transition {{ $sortField === 'name' && $sortDirection === 'desc' ? 'rotate-180' : '' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m5 15 7-7 7 7" /></svg>
                </button>
            </div>
        </div>

        <div class="p-4 sm:p-5">
            <div data-permission-grid class="grid grid-cols-1 gap-3 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 2xl:grid-cols-6">
                @forelse($permissions as $permission)
                    @php
                        $isSensitive = \App\Support\SensitivePermissions::isSensitive($permission->name);
                        $nameParts = str($permission->name)->explode(' ');
                        $permissionAction = (string) ($nameParts->shift() ?: 'use');
                        $permissionArea = $nameParts->isNotEmpty() ? $nameParts->implode(' ') : 'system';
                        [$accentBorder, $accentBackground, $accentText] = match($permissionAction) {
                            'create', 'approve' => ['border-emerald-400/20', 'bg-emerald-400/10', 'text-emerald-300'],
                            'edit', 'update' => ['border-amber-400/20', 'bg-amber-400/10', 'text-amber-300'],
                            'delete', 'reject', 'ban' => ['border-rose-400/20', 'bg-rose-400/10', 'text-rose-300'],
                            'import' => ['border-cyan-400/20', 'bg-cyan-400/10', 'text-cyan-300'],
                            'export', 'impersonate' => ['border-violet-400/20', 'bg-violet-400/10', 'text-violet-300'],
                            default => ['border-indigo-400/20', 'bg-indigo-400/10', 'text-indigo-300'],
                        };
                    @endphp

                    <article wire:key="permission-card-{{ $permission->id }}" class="group relative flex min-h-48 flex-col overflow-hidden rounded-2xl border border-slate-700/60 bg-slate-950/35 p-4 transition duration-200 hover:-translate-y-0.5 hover:border-indigo-400/25 hover:bg-slate-900 hover:shadow-xl hover:shadow-slate-950/30">
                        <div class="pointer-events-none absolute inset-x-6 top-0 h-px bg-gradient-to-r from-transparent via-indigo-400/50 to-transparent opacity-0 transition group-hover:opacity-100"></div>

                        <div class="flex items-start justify-between gap-3">
                            <span class="flex h-10 w-10 flex-none items-center justify-center rounded-xl border {{ $accentBorder }} {{ $accentBackground }} {{ $accentText }}">
                                @if($isSensitive)
                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M16.5 10.5V6.75a4.5 4.5 0 0 0-9 0v3.75m-.75 0h10.5A2.25 2.25 0 0 1 19.5 12.75v6A2.25 2.25 0 0 1 17.25 21H6.75a2.25 2.25 0 0 1-2.25-2.25v-6a2.25 2.25 0 0 1 2.25-2.25Z" /></svg>
                                @else
                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15.75 5.25a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Zm-3 3.674V21m3.75-6.75h-7.5" /></svg>
                                @endif
                            </span>

                            @if($isSensitive)
                                <span class="rounded-full border border-amber-400/20 bg-amber-400/10 px-2 py-1 text-[9px] font-black uppercase tracking-wider text-amber-300">Protected</span>
                            @else
                                <span class="rounded-lg border px-2 py-1 text-[9px] font-black uppercase tracking-wider {{ $accentBorder }} {{ $accentBackground }} {{ $accentText }}">{{ $permissionAction }}</span>
                            @endif
                        </div>

                        <div class="mt-4 min-w-0 flex-1">
                            <h3 class="break-words text-sm font-black capitalize leading-5 text-white">{{ $permission->name }}</h3>
                            <p class="mt-1.5 text-xs capitalize text-slate-600">{{ $permissionArea }} capability</p>
                        </div>

                        <div class="mt-4 flex items-end justify-between gap-3 border-t border-slate-800 pt-3">
                            <div>
                                <p class="text-[9px] font-black uppercase tracking-wider text-slate-700">Assigned roles</p>
                                <p class="mt-1 text-xs font-bold text-slate-400">{{ number_format($permission->roles_count) }} {{ str('role')->plural($permission->roles_count) }}</p>
                            </div>

                            @if(!$isSensitive)
                                <div class="flex items-center gap-1">
                                    @can('edit permissions')
                                        <button wire:click="edit({{ $permission->id }})" type="button" class="flex h-8 w-8 items-center justify-center rounded-lg text-slate-500 transition hover:bg-indigo-400/10 hover:text-indigo-300" title="Edit {{ $permission->name }}">
                                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="m16.86 4.49 2.65 2.65M5.25 18.75l3.31-.66L19.5 7.14a1.875 1.875 0 0 0-2.65-2.65L5.9 15.44l-.65 3.31Z" /></svg>
                                        </button>
                                    @endcan
                                    @can('delete permissions')
                                        <button wire:click="confirmDelete({{ $permission->id }})" type="button" class="flex h-8 w-8 items-center justify-center rounded-lg text-slate-500 transition hover:bg-rose-400/10 hover:text-rose-300" title="Delete {{ $permission->name }}">
                                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="m14.74 9-.35 9m-4.78 0L9.26 9m9.97-3.21c.35.05.7.1 1.02.16m-1.02-.16L18.16 19.67A2.25 2.25 0 0 1 15.92 21H8.08a2.25 2.25 0 0 1-2.24-2.08L4.77 5.79m14.46 0A48.11 48.11 0 0 0 15.38 5m-10.61.79c.35-.06.69-.11 1.03-.16m0 0A48.11 48.11 0 0 1 9.62 5m5.76 0V4.08c0-1.18-.91-2.17-2.09-2.2a52 52 0 0 0-2.58 0c-1.18.03-2.09 1.02-2.09 2.2V5" /></svg>
                                        </button>
                                    @endcan
                                </div>
                            @else
                                <span class="text-[10px] font-bold text-amber-300/70">Super admin</span>
                            @endif
                        </div>
                    </article>
                @empty
                    <div class="col-span-full flex flex-col items-center justify-center py-16 text-center">
                        <span class="flex h-14 w-14 items-center justify-center rounded-2xl bg-slate-800 text-slate-500">
                            <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7" d="m21 21-4.35-4.35m2.1-5.4a7.5 7.5 0 1 1-15 0 7.5 7.5 0 0 1 15 0Z" /></svg>
                        </span>
                        <p class="mt-4 text-base font-black text-white">No matching permissions</p>
                        <p class="mt-1 text-sm text-slate-500">Try a different capability or area.</p>
                    </div>
                @endforelse
            </div>
        </div>

        @if($permissions->hasPages())
            <div class="border-t border-slate-700/60 bg-slate-950/20 px-4 py-4 sm:px-5">
                {{ $permissions->links(data: ['scrollTo' => false]) }}
            </div>
        @endif
    </section>

    @if($showModal)
        <div class="fixed inset-0 z-[100]" aria-labelledby="permission-modal-title" role="dialog" aria-modal="true">
            <div class="fixed inset-0 bg-slate-950/80 backdrop-blur-sm" wire:click="$set('showModal', false)"></div>
            <div class="absolute inset-0 z-10 overflow-x-hidden overflow-y-auto">
                <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-6">
                    <div class="relative w-full max-w-lg transform overflow-hidden rounded-2xl border border-slate-700/50 bg-slate-900/95 text-left shadow-2xl backdrop-blur-xl">
                        <form wire:submit.prevent="save">
                            <div class="px-5 pb-5 pt-5 sm:px-6">
                                <div class="mb-5 flex items-center justify-between gap-4">
                                    <div>
                                        <p class="text-[10px] font-black uppercase tracking-[0.16em] text-indigo-300">Capability catalog</p>
                                        <h3 class="mt-1 text-lg font-black text-white" id="permission-modal-title">{{ $isEditing ? 'Edit permission' : 'Add permission' }}</h3>
                                    </div>
                                    <button type="button" wire:click="$set('showModal', false)" class="flex h-9 w-9 items-center justify-center rounded-xl text-slate-500 transition hover:bg-slate-800 hover:text-white" aria-label="Close permission form">
                                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18 18 6M6 6l12 12" /></svg>
                                    </button>
                                </div>

                                <x-admin.form-group label="Permission name" name="name" required>
                                    <input type="text" wire:model="name" id="name" required placeholder="action area" class="w-full rounded-xl border border-slate-700/80 bg-slate-950 px-4 py-3 text-sm text-white shadow-inner outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/30">
                                    <p class="mt-2 text-xs leading-5 text-slate-600">Use a clear machine-style capability, such as “export members”.</p>
                                </x-admin.form-group>
                            </div>
                            <div class="flex flex-col-reverse gap-3 border-t border-slate-700/50 bg-slate-950/30 px-5 py-4 sm:flex-row sm:justify-end sm:px-6">
                                <button type="button" wire:click="$set('showModal', false)" class="rounded-xl border border-slate-700 bg-slate-800 px-4 py-2.5 text-sm font-bold text-slate-300 transition hover:bg-slate-700 hover:text-white">Cancel</button>
                                <button type="submit" class="rounded-xl bg-indigo-500 px-5 py-2.5 text-sm font-black text-white transition hover:bg-indigo-400">
                                    {{ $isEditing ? 'Update permission' : 'Save permission' }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
