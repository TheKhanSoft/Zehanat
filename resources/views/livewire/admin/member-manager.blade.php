<div>
    @section('title', 'Members Directory - Admin Panel')
    @section('page_title', 'Members Directory')

    <div
        class="space-y-6"
        x-data="{
            init() {
                window.addEventListener('open-modal', event => window.openModal?.(event.detail.id));
                window.addEventListener('close-modal', event => window.closeModal?.(event.detail.id));
            }
        }"
    >
        <x-admin.page-header
            title="Members Directory"
            description="Review applications, maintain member records, and manage the full membership lifecycle."
            module="People & Community"
        />

        <section class="grid gap-4 sm:grid-cols-2 xl:grid-cols-5">
            <x-admin.stat-card
                title="All Members"
                value="{{ number_format($totalMembers) }}"
                meta="{{ $newThisMonth }} joined this month"
                color="cyan"
                icon='<svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Z" /></svg>'
            />
            <x-admin.stat-card
                title="Approved"
                value="{{ number_format($approvedMembers) }}"
                meta="{{ $totalMembers ? round(($approvedMembers / $totalMembers) * 100) : 0 }}% approval rate"
                color="emerald"
                icon='<svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="m4.5 12.75 6 6 9-13.5" /></svg>'
            />
            <x-admin.stat-card
                title="Pending Review"
                value="{{ number_format($pendingMembers) }}"
                meta="Requires a decision"
                color="amber"
                icon='<svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 6v6l4 2.25m5-2.25a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" /></svg>'
            />
            <x-admin.stat-card
                title="Rejected"
                value="{{ number_format($rejectedMembers) }}"
                meta="Archived applications"
                color="rose"
                icon='<svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M6 18 18 6M6 6l12 12" /></svg>'
            />
            <x-admin.stat-card
                title="Banned"
                value="{{ number_format($bannedMembers) }}"
                meta="Access restricted"
                color="purple"
                icon='<svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M18.364 18.364A9 9 0 1 0 5.636 5.636m12.728 12.728L5.636 5.636" /></svg>'
            />
        </section>

        <section class="admin-panel overflow-hidden">
            <div class="border-b border-slate-700/60 p-4 sm:p-5">
                <div class="flex flex-col gap-4 xl:flex-row xl:items-center xl:justify-between">
                    <div>
                        <h2 class="text-lg font-black text-white">Member records</h2>
                        <p class="mt-1 text-sm text-slate-500">{{ number_format($members->total()) }} records match the current view.</p>
                    </div>

                    <div class="flex flex-col gap-3 sm:flex-row sm:flex-wrap sm:items-center">
                        <div class="relative min-w-0 sm:w-72">
                            <svg class="pointer-events-none absolute left-3.5 top-1/2 h-4.5 w-4.5 -translate-y-1/2 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m21 21-4.35-4.35m2.1-5.4a7.5 7.5 0 1 1-15 0 7.5 7.5 0 0 1 15 0Z" /></svg>
                            <input
                                wire:model.live.debounce.250ms="search"
                                type="search"
                                placeholder="Name, email, phone or institution"
                                class="h-11 w-full rounded-xl border border-slate-700 bg-slate-950/70 pl-10 pr-4 text-sm text-white placeholder:text-slate-600 outline-none transition focus:border-teal-500 focus:ring-4 focus:ring-teal-500/10"
                            >
                        </div>
                        <select wire:model.live="categoryFilter" class="h-11 rounded-xl border border-slate-700 bg-slate-950/70 px-3.5 text-sm text-slate-300 outline-none transition focus:border-teal-500 focus:ring-4 focus:ring-teal-500/10">
                            <option value="all">All categories</option>
                            <option value="individual">Individuals</option>
                            <option value="student">Students</option>
                            <option value="institution">Institutions</option>
                            <option value="industry">Industry</option>
                        </select>
                        @can('import members')
                            <button wire:click="openImportModal" type="button" class="inline-flex h-11 items-center justify-center gap-2 rounded-xl border border-cyan-400/20 bg-cyan-400/10 px-4 text-sm font-black text-cyan-300 transition hover:border-cyan-400/35 hover:bg-cyan-400/15">
                                <svg class="h-4.5 w-4.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 10.5 12 6m0 0-4.5 4.5M12 6v9" /></svg>
                                Import CSV
                            </button>
                        @endcan
                        @can('export members')
                            <button wire:click="exportMembers" type="button" class="inline-flex h-11 items-center justify-center gap-2 rounded-xl border border-slate-700 bg-slate-800/70 px-4 text-sm font-bold text-slate-300 transition hover:border-teal-400/30 hover:bg-slate-800 hover:text-white">
                                <svg class="h-4.5 w-4.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M7.5 10.5 12 15m0 0 4.5-4.5M12 15V3" /></svg>
                                Export CSV
                            </button>
                        @endcan
                    </div>
                </div>

                <div class="mt-4 flex flex-col gap-3 border-t border-slate-800 pt-4 sm:flex-row sm:items-center sm:justify-between">
                    <div class="flex gap-2 overflow-x-auto pb-1 sm:pb-0">
                        @foreach([
                            'all' => ['All', $totalMembers],
                            'pending' => ['Pending', $pendingMembers],
                            'approved' => ['Approved', $approvedMembers],
                            'rejected' => ['Rejected', $rejectedMembers],
                            'banned' => ['Banned', $bannedMembers],
                        ] as $statusKey => [$statusLabel, $statusCount])
                            <button
                                type="button"
                                wire:click="$set('status', '{{ $statusKey }}')"
                                class="inline-flex flex-none items-center gap-2 rounded-xl border px-3 py-2 text-xs font-bold transition {{ $status === $statusKey ? 'border-teal-400/25 bg-teal-400/10 text-teal-300' : 'border-slate-800 bg-slate-950/35 text-slate-500 hover:bg-slate-800 hover:text-slate-300' }}"
                            >
                                {{ $statusLabel }}
                                <span class="rounded-md bg-slate-950/60 px-1.5 py-0.5 text-[10px]">{{ $statusCount }}</span>
                            </button>
                        @endforeach
                    </div>
                    <div class="flex items-center gap-2 text-xs text-slate-500">
                        <span>Rows</span>
                        <select wire:model.live="perPage" class="rounded-lg border border-slate-700 bg-slate-950 px-2 py-1.5 text-xs font-bold text-slate-300 outline-none">
                            @foreach([10, 15, 25, 50] as $size)
                                <option value="{{ $size }}">{{ $size }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            @if(count($selectedMembers) > 0)
                <div class="flex flex-col gap-3 border-b border-teal-400/20 bg-teal-400/10 px-4 py-3 sm:flex-row sm:items-center sm:justify-between sm:px-5">
                    <div class="flex items-center gap-3">
                        <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-teal-400 text-xs font-black text-slate-950">{{ count($selectedMembers) }}</span>
                        <p class="text-sm font-bold text-teal-100">{{ str('member')->plural(count($selectedMembers)) }} selected</p>
                    </div>
                    <div class="flex flex-wrap items-center gap-2">
                        @can(\App\Support\AdminPermissions::MEMBER_APPROVE)
                            <button wire:click="bulkUpdateStatus('approved')" type="button" class="rounded-lg bg-emerald-400/15 px-3 py-2 text-xs font-black text-emerald-300 transition hover:bg-emerald-400/25">Approve</button>
                        @endcan
                        @can('edit members')
                            <button wire:click="bulkUpdateStatus('pending')" type="button" class="rounded-lg bg-amber-400/15 px-3 py-2 text-xs font-black text-amber-300 transition hover:bg-amber-400/25">Mark pending</button>
                        @endcan
                        @can(\App\Support\AdminPermissions::MEMBER_REJECT)
                            <button wire:click="bulkUpdateStatus('rejected')" type="button" class="rounded-lg bg-rose-400/15 px-3 py-2 text-xs font-black text-rose-300 transition hover:bg-rose-400/25">Reject</button>
                        @endcan
                        <button wire:click="clearSelection" type="button" class="rounded-lg px-3 py-2 text-xs font-black text-slate-400 transition hover:bg-slate-800 hover:text-white">Clear</button>
                    </div>
                </div>
            @endif

            <div class="relative min-h-80">
                <div wire:loading wire:target="search, status, categoryFilter, perPage, sortBy, previousPage, nextPage, gotoPage" class="absolute inset-0 z-10 flex items-center justify-center bg-slate-950/55 backdrop-blur-sm">
                    <div class="flex items-center gap-3 rounded-2xl border border-slate-700 bg-slate-900/95 px-5 py-3.5 text-sm font-bold text-white shadow-2xl">
                        <span class="h-4 w-4 animate-spin rounded-full border-2 border-teal-400 border-t-transparent"></span>
                        Updating directory
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full">
                        <thead class="bg-slate-950/40">
                            <tr>
                                <th class="w-12 px-5 py-4 text-left">
                                    <button wire:click="selectVisible(@js($members->pluck('id')->all()))" type="button" class="flex h-5 w-5 items-center justify-center rounded-md border border-slate-600 text-slate-500 transition hover:border-teal-400 hover:text-teal-300" title="Select visible members">
                                        <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="m4.5 12.75 6 6 9-13.5" /></svg>
                                    </button>
                                </th>
                                @foreach([
                                    'name' => 'Member',
                                    'category' => 'Membership',
                                    'status' => 'Status',
                                    'created_at' => 'Joined',
                                ] as $field => $label)
                                    <th wire:click="sortBy('{{ $field }}')" class="cursor-pointer whitespace-nowrap px-5 py-4 text-left text-[11px] font-black uppercase tracking-[0.14em] text-slate-500 transition hover:text-teal-300">
                                        <span class="inline-flex items-center gap-1.5">
                                            {{ $label }}
                                            @if($sortField === $field)
                                                <svg class="h-3.5 w-3.5 {{ $sortDirection === 'desc' ? 'rotate-180' : '' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m5 15 7-7 7 7" /></svg>
                                            @endif
                                        </span>
                                    </th>
                                @endforeach
                                <th class="px-5 py-4 text-right text-[11px] font-black uppercase tracking-[0.14em] text-slate-500">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-800/80">
                            @forelse($members as $member)
                                @php
                                    $initials = collect(explode(' ', $member->name))->filter()->take(2)->map(fn ($part) => strtoupper(substr($part, 0, 1)))->implode('');
                                    $isSelected = in_array((string) $member->id, array_map('strval', $selectedMembers), true);
                                @endphp
                                <tr wire:key="member-{{ $member->id }}" class="group transition {{ $isSelected ? 'bg-teal-400/5' : 'hover:bg-slate-800/30' }}">
                                    <td class="px-5 py-4">
                                        <input wire:model.live="selectedMembers" value="{{ $member->id }}" type="checkbox" class="h-4 w-4 rounded border-slate-600 bg-slate-900 text-teal-500 focus:ring-teal-500/30 focus:ring-offset-slate-900">
                                    </td>
                                    <td class="min-w-64 px-5 py-4">
                                        <div class="flex items-center gap-3">
                                            <div class="flex h-10 w-10 flex-none items-center justify-center rounded-xl border border-slate-700 bg-gradient-to-br from-slate-800 to-slate-900 text-xs font-black text-slate-300 shadow-inner transition group-hover:border-teal-400/20 group-hover:text-teal-300">{{ $initials }}</div>
                                            <div class="min-w-0">
                                                <p class="truncate text-sm font-black text-slate-100">{{ $member->name }}</p>
                                                <a href="mailto:{{ $member->email }}" class="mt-0.5 block truncate text-xs text-slate-500 transition hover:text-teal-300">{{ $member->email }}</a>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="min-w-48 px-5 py-4">
                                        <span class="inline-flex rounded-lg border border-slate-700 bg-slate-800/70 px-2.5 py-1 text-xs font-bold capitalize text-slate-300">{{ $member->category }}</span>
                                        <p class="mt-1.5 max-w-52 truncate text-xs text-slate-600">{{ $member->institution ?: 'Independent member' }}</p>
                                    </td>
                                    <td class="whitespace-nowrap px-5 py-4">
                                        <span class="inline-flex items-center gap-1.5 rounded-full border px-2.5 py-1 text-xs font-black
                                            {{ $member->isBanned() ? 'border-violet-400/20 bg-violet-400/10 text-violet-300' : ($member->status === 'approved' ? 'border-emerald-400/20 bg-emerald-400/10 text-emerald-300' : ($member->status === 'pending' ? 'border-amber-400/20 bg-amber-400/10 text-amber-300' : 'border-rose-400/20 bg-rose-400/10 text-rose-300')) }}">
                                            <span class="h-1.5 w-1.5 rounded-full {{ $member->isBanned() ? 'bg-violet-400' : ($member->status === 'approved' ? 'bg-emerald-400' : ($member->status === 'pending' ? 'bg-amber-400' : 'bg-rose-400')) }}"></span>
                                            {{ $member->isBanned() ? 'Banned' : ucfirst($member->status) }}
                                        </span>
                                        @if($member->isBanned())
                                            <p class="mt-1 max-w-36 truncate text-[10px] text-slate-600" title="{{ $member->ban_reason }}">{{ $member->ban_reason }}</p>
                                        @endif
                                    </td>
                                    <td class="whitespace-nowrap px-5 py-4">
                                        <p class="text-sm font-semibold text-slate-300">{{ $member->created_at->format('M d, Y') }}</p>
                                        <p class="mt-0.5 text-xs text-slate-600">{{ $member->created_at->diffForHumans() }}</p>
                                    </td>
                                    <td class="px-5 py-4 text-right">
                                        <div class="flex items-center justify-end gap-1">
                                            @can(\App\Support\AdminPermissions::MEMBER_APPROVE)
                                                @if($member->status !== 'approved')
                                                    <button wire:click="updateStatus({{ $member->id }}, 'approved')" type="button" class="inline-flex h-9 items-center gap-1.5 rounded-xl border border-emerald-400/20 bg-emerald-400/10 px-3 text-xs font-black text-emerald-300 transition hover:bg-emerald-400/20" title="Accept member">
                                                        <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="m4.5 12.75 6 6 9-13.5" /></svg>
                                                        Accept
                                                    </button>
                                                @endif
                                            @endcan
                                            @can(\App\Support\AdminPermissions::MEMBER_REJECT)
                                                @if($member->status !== 'rejected')
                                                    <button wire:click="updateStatus({{ $member->id }}, 'rejected')" wire:confirm="Reject this membership?" type="button" class="inline-flex h-9 items-center gap-1.5 rounded-xl border border-rose-400/20 bg-rose-400/10 px-3 text-xs font-black text-rose-300 transition hover:bg-rose-400/20" title="Reject member">
                                                        <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18 18 6M6 6l12 12" /></svg>
                                                        Reject
                                                    </button>
                                                @endif
                                            @endcan
                                            @if($member->status === 'approved' && !$member->isBanned())
                                                @can(\App\Support\AdminPermissions::MEMBER_BAN)
                                                    <button wire:click="confirmBan({{ $member->id }})" type="button" class="inline-flex h-9 items-center gap-1.5 rounded-xl border border-violet-400/20 bg-violet-400/10 px-3 text-xs font-black text-violet-300 transition hover:bg-violet-400/20" title="Ban member">
                                                        <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M18.364 18.364A9 9 0 1 0 5.636 5.636m12.728 12.728L5.636 5.636" /></svg>
                                                        Ban
                                                    </button>
                                                @endcan
                                            @elseif($member->isBanned())
                                                @can(\App\Support\AdminPermissions::MEMBER_UNBAN)
                                                    <button wire:click="unbanMember({{ $member->id }})" wire:confirm="Restore this member's access?" type="button" class="inline-flex h-9 items-center gap-1.5 rounded-xl border border-cyan-400/20 bg-cyan-400/10 px-3 text-xs font-black text-cyan-300 transition hover:bg-cyan-400/20" title="Unban member">
                                                        Unban
                                                    </button>
                                                @endcan
                                            @endif
                                            @role('super-admin')
                                                @can('impersonate members')
                                                    @if($member->status === 'approved' && !$member->isBanned())
                                                        <button wire:click="confirmImpersonation({{ $member->id }})" type="button" class="inline-flex h-9 items-center gap-2 rounded-xl border border-violet-400/20 bg-violet-400/10 px-3 text-xs font-black text-violet-300 transition hover:border-violet-400/35 hover:bg-violet-400/20" title="Login as {{ $member->name }}">
                                                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM18 21a6 6 0 0 0-12 0m12.75-9.75 1.5 1.5-1.5 1.5m1.5-1.5H15" /></svg>
                                                            Login as
                                                        </button>
                                                    @endif
                                                @endcan
                                            @endrole
                                            <button wire:click="viewMember({{ $member->id }})" type="button" class="inline-flex h-9 w-9 items-center justify-center rounded-xl text-slate-500 transition hover:bg-slate-700/70 hover:text-white" title="View profile">
                                                <svg class="h-4.5 w-4.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M2.46 12C3.73 7.94 7.52 5 12 5s8.27 2.94 9.54 7c-1.27 4.06-5.06 7-9.54 7s-8.27-2.94-9.54-7Z" /></svg>
                                            </button>
                                            @can('edit members')
                                                <button wire:click="editMember({{ $member->id }})" type="button" class="inline-flex h-9 w-9 items-center justify-center rounded-xl text-slate-500 transition hover:bg-teal-400/10 hover:text-teal-300" title="Edit member">
                                                    <svg class="h-4.5 w-4.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="m16.86 4.49 2.65 2.65M5.25 18.75l3.31-.66L19.5 7.14a1.875 1.875 0 0 0-2.65-2.65L5.9 15.44l-.65 3.31Z" /></svg>
                                                </button>
                                            @endcan
                                            @can('delete members')
                                                <button wire:click="confirmDelete({{ $member->id }})" type="button" class="inline-flex h-9 w-9 items-center justify-center rounded-xl text-slate-500 transition hover:bg-rose-400/10 hover:text-rose-300" title="Delete member">
                                                    <svg class="h-4.5 w-4.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="m14.74 9-.35 9m-4.78 0L9.26 9m9.97-3.21c.35.05.7.1 1.02.16m-1.02-.16L18.16 19.67A2.25 2.25 0 0 1 15.92 21H8.08a2.25 2.25 0 0 1-2.24-2.08L4.77 5.79m14.46 0A48.11 48.11 0 0 0 15.38 5m-10.61.79c.35-.06.69-.11 1.03-.16m0 0A48.11 48.11 0 0 1 9.62 5m5.76 0V4.08c0-1.18-.91-2.17-2.09-2.2a52 52 0 0 0-2.58 0c-1.18.03-2.09 1.02-2.09 2.2V5" /></svg>
                                                </button>
                                            @endcan
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-16 text-center">
                                        <span class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-slate-800 text-slate-500">
                                            <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" d="m21 21-4.35-4.35m2.1-5.4a7.5 7.5 0 1 1-15 0 7.5 7.5 0 0 1 15 0Z" /></svg>
                                        </span>
                                        <p class="mt-4 text-base font-black text-white">No matching members</p>
                                        <p class="mt-1 text-sm text-slate-500">Adjust the search, category, or status filters.</p>
                                        <button wire:click="clearFilters" type="button" class="mt-4 text-sm font-bold text-teal-400 hover:text-teal-300">Clear all filters</button>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($members->hasPages())
                    <div class="border-t border-slate-700/60 bg-slate-950/20 p-4">
                        {{ $members->links(data: ['scrollTo' => false]) }}
                    </div>
                @endif
            </div>
        </section>

        <x-admin.modal id="viewMemberModal" title="Member profile" maxWidth="4xl" :showFooter="false">
            @php
                $profileInitials = collect(explode(' ', $name))->filter()->take(2)->map(fn ($part) => strtoupper(substr($part, 0, 1)))->implode('');
                $joinedDate = $createdAt ? \Illuminate\Support\Carbon::parse($createdAt) : null;
                $updatedDate = $updatedAt ? \Illuminate\Support\Carbon::parse($updatedAt) : null;
                $statusClasses = $bannedAt
                    ? 'border-violet-400/20 bg-violet-400/10 text-violet-300'
                    : ($memberStatus === 'approved'
                        ? 'border-emerald-400/20 bg-emerald-400/10 text-emerald-300'
                        : ($memberStatus === 'pending'
                            ? 'border-amber-400/20 bg-amber-400/10 text-amber-300'
                            : 'border-rose-400/20 bg-rose-400/10 text-rose-300'));
                $statusDot = $bannedAt ? 'bg-violet-400' : ($memberStatus === 'approved' ? 'bg-emerald-400' : ($memberStatus === 'pending' ? 'bg-amber-400' : 'bg-rose-400'));
            @endphp

            <div class="mt-1 overflow-hidden rounded-2xl border border-slate-700/60">
                <div class="relative overflow-hidden border-b border-slate-700/60 bg-gradient-to-br from-slate-950 via-slate-900 to-teal-950/40 px-5 py-6 sm:px-7">
                    <div class="pointer-events-none absolute -right-10 -top-20 h-64 w-64 rounded-full bg-teal-400/10 blur-3xl"></div>
                    <div class="relative flex flex-col gap-5 sm:flex-row sm:items-center">
                        <div class="flex h-20 w-20 flex-none items-center justify-center rounded-3xl border border-teal-300/20 bg-gradient-to-br from-teal-400 to-cyan-600 text-xl font-black text-white shadow-xl shadow-teal-950/50">
                            {{ $profileInitials ?: '?' }}
                        </div>
                        <div class="min-w-0 flex-1">
                            <div class="flex flex-wrap items-center gap-2">
                                <p class="text-[10px] font-black uppercase tracking-[0.18em] text-teal-300">Member #{{ $memberId }}</p>
                                <span class="inline-flex items-center gap-1.5 rounded-full border px-2.5 py-1 text-[11px] font-black capitalize {{ $statusClasses }}">
                                    <span class="h-1.5 w-1.5 rounded-full {{ $statusDot }}"></span>
                                    {{ $bannedAt ? 'Banned' : $memberStatus }}
                                </span>
                            </div>
                            <h3 class="mt-2 truncate text-2xl font-black tracking-tight text-white">{{ $name }}</h3>
                            <p class="mt-1 text-sm capitalize text-slate-400">{{ $category ?: 'Uncategorized' }} member · {{ $institution ?: 'Independent' }}</p>
                        </div>
                        <div class="flex flex-wrap gap-2">
                            <a href="mailto:{{ $email }}" class="inline-flex items-center gap-2 rounded-xl border border-slate-700 bg-slate-900/70 px-3.5 py-2.5 text-xs font-bold text-slate-300 transition hover:border-teal-400/30 hover:text-teal-300">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M21.75 6.75v10.5A2.25 2.25 0 0 1 19.5 19.5h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0-8.659 5.684a2 2 0 0 1-2.182 0L2.25 6.75" /></svg>
                                Email
                            </a>
                            @if($phone)
                                <a href="tel:{{ $phone }}" class="inline-flex items-center gap-2 rounded-xl border border-slate-700 bg-slate-900/70 px-3.5 py-2.5 text-xs font-bold text-slate-300 transition hover:border-cyan-400/30 hover:text-cyan-300">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25A2.25 2.25 0 0 0 21.75 19.5v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106a1.125 1.125 0 0 0-1.173.417l-.97 1.293a1.125 1.125 0 0 1-1.21.38 12.035 12.035 0 0 1-7.143-7.143 1.125 1.125 0 0 1 .38-1.21l1.293-.97c.362-.271.527-.734.417-1.173L6.963 3.102A1.125 1.125 0 0 0 5.872 2.25H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z" /></svg>
                                    Call
                                </a>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="space-y-6 px-5 py-6 sm:px-7">
                    @if($bannedAt)
                        <div class="flex items-start gap-3 rounded-2xl border border-violet-400/20 bg-violet-400/10 p-4">
                            <span class="flex h-9 w-9 flex-none items-center justify-center rounded-xl bg-violet-400/10 text-violet-300">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M18.364 18.364A9 9 0 1 0 5.636 5.636m12.728 12.728L5.636 5.636" /></svg>
                            </span>
                            <div>
                                <p class="text-sm font-black text-violet-100">Member access is restricted</p>
                                <p class="mt-1 text-sm leading-6 text-violet-100/70">{{ $banReason }}</p>
                            </div>
                        </div>
                    @endif

                    <div class="grid gap-6 lg:grid-cols-[1.45fr_1fr]">
                        <div class="space-y-5">
                            <section>
                                <div class="mb-3 flex items-center justify-between gap-3">
                                    <div class="flex items-center gap-2">
                                        <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-cyan-400/10 text-cyan-300">
                                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M21.75 6.75v10.5A2.25 2.25 0 0 1 19.5 19.5h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0-8.659 5.684a2 2 0 0 1-2.182 0L2.25 6.75" /></svg>
                                        </span>
                                        <h4 class="text-sm font-black text-white">Contact information</h4>
                                    </div>
                                </div>
                                <div class="grid gap-3 sm:grid-cols-2">
                                    <div class="rounded-2xl border border-slate-800 bg-slate-950/40 p-4">
                                        <p class="text-[10px] font-black uppercase tracking-wider text-slate-600">Email address</p>
                                        <a href="mailto:{{ $email }}" class="mt-2 block break-all text-sm font-bold text-slate-200 transition hover:text-teal-300">{{ $email }}</a>
                                    </div>
                                    <div class="rounded-2xl border border-slate-800 bg-slate-950/40 p-4">
                                        <p class="text-[10px] font-black uppercase tracking-wider text-slate-600">Phone number</p>
                                        @if($phone)
                                            <a href="tel:{{ $phone }}" class="mt-2 block text-sm font-bold text-slate-200 transition hover:text-cyan-300">{{ $phone }}</a>
                                        @else
                                            <p class="mt-2 text-sm font-semibold text-slate-600">Not provided</p>
                                        @endif
                                    </div>
                                </div>
                            </section>

                            <section>
                                <div class="mb-3 flex items-center gap-2">
                                    <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-amber-400/10 text-amber-300">
                                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M7.5 8.25h9m-9 3H12m-8.25-6A2.25 2.25 0 0 1 6 3h12a2.25 2.25 0 0 1 2.25 2.25v9A2.25 2.25 0 0 1 18 16.5h-5.379a2.25 2.25 0 0 0-1.591.659L8.25 19.94v-1.19A2.25 2.25 0 0 0 6 16.5A2.25 2.25 0 0 1 3.75 14.25v-9Z" /></svg>
                                    </span>
                                    <h4 class="text-sm font-black text-white">Application message</h4>
                                </div>
                                <div class="min-h-28 whitespace-pre-wrap rounded-2xl border border-slate-800 bg-slate-950/40 p-4 text-sm leading-7 text-slate-300">{{ $message ?: 'No application message was provided.' }}</div>
                            </section>
                        </div>

                        <aside class="rounded-2xl border border-slate-800 bg-slate-950/35 p-5">
                            <h4 class="text-sm font-black text-white">Membership overview</h4>
                            <p class="mt-1 text-xs text-slate-600">Application and record details</p>
                            <dl class="mt-5 divide-y divide-slate-800">
                                <div class="flex items-start justify-between gap-4 py-3 first:pt-0">
                                    <dt class="text-xs font-semibold text-slate-500">Category</dt>
                                    <dd class="text-right text-sm font-black capitalize text-slate-200">{{ $category ?: 'Not provided' }}</dd>
                                </div>
                                <div class="flex items-start justify-between gap-4 py-3">
                                    <dt class="text-xs font-semibold text-slate-500">Institution</dt>
                                    <dd class="max-w-48 text-right text-sm font-bold text-slate-200">{{ $institution ?: 'Independent member' }}</dd>
                                </div>
                                <div class="flex items-start justify-between gap-4 py-3">
                                    <dt class="text-xs font-semibold text-slate-500">Joined</dt>
                                    <dd class="text-right">
                                        <p class="text-sm font-bold text-slate-200">{{ $joinedDate?->format('M d, Y') ?: 'Unknown' }}</p>
                                        @if($joinedDate)<p class="mt-0.5 text-[10px] text-slate-600">{{ $joinedDate->diffForHumans() }}</p>@endif
                                    </dd>
                                </div>
                                <div class="flex items-start justify-between gap-4 py-3 last:pb-0">
                                    <dt class="text-xs font-semibold text-slate-500">Last updated</dt>
                                    <dd class="text-right">
                                        <p class="text-sm font-bold text-slate-200">{{ $updatedDate?->format('M d, Y') ?: 'Unknown' }}</p>
                                        @if($updatedDate)<p class="mt-0.5 text-[10px] text-slate-600">{{ $updatedDate->diffForHumans() }}</p>@endif
                                    </dd>
                                </div>
                            </dl>
                        </aside>
                    </div>
                </div>

                <div class="flex flex-col gap-3 border-t border-slate-700/60 bg-slate-950/30 px-5 py-4 sm:flex-row sm:items-center sm:justify-between sm:px-7">
                    <button onclick="window.closeModal('viewMemberModal')" type="button" class="rounded-xl border border-slate-700 bg-slate-800 px-4 py-2.5 text-sm font-bold text-slate-300 transition hover:bg-slate-700 hover:text-white">Close</button>
                    <div class="flex flex-wrap items-center gap-2">
                        @role('super-admin')
                            @can('impersonate members')
                                @if($memberStatus === 'approved' && !$bannedAt)
                                    <button wire:click="confirmImpersonation({{ $memberId }})" onclick="window.closeModal('viewMemberModal')" type="button" class="inline-flex items-center gap-2 rounded-xl border border-violet-400/20 bg-violet-400/10 px-4 py-2.5 text-sm font-black text-violet-300 transition hover:bg-violet-400/20">
                                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM18 21a6 6 0 0 0-12 0m12.75-9.75 1.5 1.5-1.5 1.5m1.5-1.5H15" /></svg>
                                        Login as
                                    </button>
                                @endif
                            @endcan
                        @endrole
                        @can('edit members')
                            <button wire:click="editMember({{ $memberId }})" onclick="window.closeModal('viewMemberModal')" type="button" class="inline-flex items-center gap-2 rounded-xl bg-teal-500 px-4 py-2.5 text-sm font-black text-white transition hover:bg-teal-400">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="m16.86 4.49 2.65 2.65M5.25 18.75l3.31-.66L19.5 7.14a1.875 1.875 0 0 0-2.65-2.65L5.9 15.44l-.65 3.31Z" /></svg>
                                Edit profile
                            </button>
                        @endcan
                    </div>
                </div>
            </div>
        </x-admin.modal>

        <x-admin.modal id="memberModal" title="Edit member" maxWidth="4xl">
            <div class="space-y-6">
                <div class="relative overflow-hidden rounded-2xl border border-slate-700/60 bg-gradient-to-r from-slate-950 to-teal-950/25 p-5">
                    <div class="pointer-events-none absolute -right-10 -top-16 h-40 w-40 rounded-full bg-teal-400/10 blur-3xl"></div>
                    <div class="relative flex items-center gap-4">
                        <div class="flex h-14 w-14 flex-none items-center justify-center rounded-2xl bg-gradient-to-br from-teal-400 to-cyan-600 text-sm font-black text-white shadow-lg shadow-teal-950/40">
                            {{ collect(explode(' ', $name))->filter()->take(2)->map(fn ($part) => strtoupper(substr($part, 0, 1)))->implode('') ?: '?' }}
                        </div>
                        <div class="min-w-0 flex-1">
                            <p class="text-[10px] font-black uppercase tracking-[0.18em] text-teal-300">Editing member #{{ $memberId }}</p>
                            <h3 class="mt-1 truncate text-lg font-black text-white">{{ $name ?: 'Member profile' }}</h3>
                            <p class="mt-0.5 truncate text-xs text-slate-500">{{ $email }}</p>
                        </div>
                        <span class="hidden rounded-full border px-3 py-1.5 text-xs font-black capitalize sm:inline-flex {{ $bannedAt ? 'border-violet-400/20 bg-violet-400/10 text-violet-300' : ($memberStatus === 'approved' ? 'border-emerald-400/20 bg-emerald-400/10 text-emerald-300' : ($memberStatus === 'pending' ? 'border-amber-400/20 bg-amber-400/10 text-amber-300' : 'border-rose-400/20 bg-rose-400/10 text-rose-300')) }}">
                            {{ $bannedAt ? 'Banned' : $memberStatus }}
                        </span>
                    </div>
                </div>

                @if($bannedAt)
                    <div class="flex items-start gap-3 rounded-2xl border border-violet-400/20 bg-violet-400/10 px-4 py-3.5 text-sm text-violet-100/80">
                        <svg class="mt-0.5 h-5 w-5 flex-none text-violet-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M18.364 18.364A9 9 0 1 0 5.636 5.636m12.728 12.728L5.636 5.636" /></svg>
                        <p><strong class="font-black text-violet-100">Access is currently restricted.</strong> Update profile information here, then use the Unban action from the directory to restore access.</p>
                    </div>
                @endif

                <section>
                    <div class="mb-4 flex items-center gap-3">
                        <span class="flex h-9 w-9 items-center justify-center rounded-xl bg-cyan-400/10 text-cyan-300">
                            <svg class="h-4.5 w-4.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.5 20.1a7.5 7.5 0 0 1 15 0" /></svg>
                        </span>
                        <div>
                            <h3 class="text-sm font-black text-white">Identity and contact</h3>
                            <p class="mt-0.5 text-xs text-slate-500">Update the member’s primary contact information.</p>
                        </div>
                    </div>
                    <div class="grid gap-x-4 sm:grid-cols-2">
                        <x-admin.form-group label="Full name" name="name" required>
                            <input wire:model="name" id="name" type="text" autocomplete="name" class="w-full rounded-xl border border-slate-700 bg-slate-950 px-4 py-3 text-white placeholder:text-slate-600 outline-none transition focus:border-teal-500 focus:ring-2 focus:ring-teal-500/20">
                        </x-admin.form-group>
                        <x-admin.form-group label="Email address" name="email" required>
                            <input wire:model="email" id="email" type="email" autocomplete="email" class="w-full rounded-xl border border-slate-700 bg-slate-950 px-4 py-3 text-white placeholder:text-slate-600 outline-none transition focus:border-teal-500 focus:ring-2 focus:ring-teal-500/20">
                        </x-admin.form-group>
                        <x-admin.form-group label="Phone number" name="phone">
                            <input wire:model="phone" id="phone" type="tel" inputmode="tel" autocomplete="tel" minlength="7" maxlength="16" pattern="\+?[0-9]{7,15}" placeholder="+923001234567" class="w-full rounded-xl border border-slate-700 bg-slate-950 px-4 py-3 text-white placeholder:text-slate-600 outline-none transition focus:border-teal-500 focus:ring-2 focus:ring-teal-500/20">
                            <p class="mt-2 text-xs text-slate-600">7–15 digits with an optional leading +.</p>
                        </x-admin.form-group>
                        <x-admin.form-group label="Institution or organization" name="institution">
                            <input wire:model="institution" id="institution" type="text" autocomplete="organization" placeholder="Independent member" class="w-full rounded-xl border border-slate-700 bg-slate-950 px-4 py-3 text-white placeholder:text-slate-600 outline-none transition focus:border-teal-500 focus:ring-2 focus:ring-teal-500/20">
                        </x-admin.form-group>
                    </div>
                </section>

                <fieldset>
                    <div class="mb-4">
                        <legend class="text-sm font-black text-white">Membership category</legend>
                        <p class="mt-1 text-xs text-slate-500">Choose the category that best represents this member.</p>
                    </div>
                    <div class="grid gap-3 sm:grid-cols-2 lg:grid-cols-4">
                        @foreach([
                            'individual' => ['Individual', 'Professional or educator'],
                            'institution' => ['Institution', 'School or university'],
                            'industry' => ['Industry', 'Business or partner'],
                            'student' => ['Student', 'Active learner'],
                        ] as $categoryValue => [$categoryLabel, $categoryDescription])
                            <label class="relative cursor-pointer">
                                <input wire:model="category" type="radio" value="{{ $categoryValue }}" class="peer sr-only">
                                <span class="block min-h-24 rounded-2xl border border-slate-700 bg-slate-950/55 p-4 transition hover:border-slate-500 peer-focus-visible:ring-2 peer-focus-visible:ring-teal-400 peer-checked:border-teal-400 peer-checked:bg-teal-400/10">
                                    <span class="block text-sm font-black text-slate-200 peer-checked:text-teal-200">{{ $categoryLabel }}</span>
                                    <span class="mt-1.5 block text-xs leading-5 text-slate-600">{{ $categoryDescription }}</span>
                                </span>
                                <span class="pointer-events-none absolute right-3 top-3 flex h-5 w-5 items-center justify-center rounded-full bg-teal-400 text-slate-950 opacity-0 transition peer-checked:opacity-100">
                                    <svg class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="m4.5 12.75 6 6 9-13.5" /></svg>
                                </span>
                            </label>
                        @endforeach
                    </div>
                    @error('category')<p class="mt-2 text-sm font-semibold text-rose-400">{{ $message }}</p>@enderror
                </fieldset>

                <section>
                    <div class="mb-3 flex items-center justify-between gap-3">
                        <div>
                            <h3 class="text-sm font-black text-white">Application message</h3>
                            <p class="mt-1 text-xs text-slate-500">Preserve the applicant’s original context or add relevant details.</p>
                        </div>
                        <span class="text-[10px] font-black uppercase tracking-wider text-slate-600">Optional</span>
                    </div>
                    <textarea wire:model="message" id="message" rows="5" maxlength="2000" placeholder="No message provided." class="w-full resize-y rounded-2xl border border-slate-700 bg-slate-950 px-4 py-3 text-sm leading-6 text-white placeholder:text-slate-600 outline-none transition focus:border-teal-500 focus:ring-2 focus:ring-teal-500/20"></textarea>
                    @error('message')<p class="mt-2 text-sm font-semibold text-rose-400">{{ $message }}</p>@enderror
                </section>

                <fieldset class="rounded-2xl border border-slate-700/60 bg-slate-950/35 p-5">
                    <div class="mb-4">
                        <legend class="text-sm font-black text-white">Application decision</legend>
                        <p class="mt-1 text-xs text-slate-500">Status changes are separate from member access restrictions.</p>
                    </div>
                    <div class="grid gap-3 sm:grid-cols-3">
                        @foreach([
                            'pending' => ['Pending', 'Awaiting review', 'amber'],
                            'approved' => ['Approved', 'Membership accepted', 'emerald'],
                            'rejected' => ['Rejected', 'Application declined', 'rose'],
                        ] as $statusValue => [$statusLabel, $statusDescription, $statusColor])
                            @php
                                $statusPermission = match($statusValue) {
                                    'approved' => \App\Support\AdminPermissions::MEMBER_APPROVE,
                                    'rejected' => \App\Support\AdminPermissions::MEMBER_REJECT,
                                    default => 'edit members',
                                };
                                $canChooseStatus = auth()->user()->can($statusPermission);
                                $selectedStatusClasses = match($statusColor) {
                                    'emerald' => 'peer-checked:border-emerald-400 peer-checked:bg-emerald-400/10',
                                    'rose' => 'peer-checked:border-rose-400 peer-checked:bg-rose-400/10',
                                    default => 'peer-checked:border-amber-400 peer-checked:bg-amber-400/10',
                                };
                                $statusColorClasses = match($statusColor) {
                                    'emerald' => 'bg-emerald-400',
                                    'rose' => 'bg-rose-400',
                                    default => 'bg-amber-400',
                                };
                            @endphp
                            @if($canChooseStatus || $memberStatus === $statusValue)
                            <label class="{{ $canChooseStatus ? 'cursor-pointer' : 'cursor-not-allowed opacity-60' }}">
                                <input wire:model="memberStatus" type="radio" value="{{ $statusValue }}" class="peer sr-only" @disabled(!$canChooseStatus)>
                                <span class="flex items-start gap-3 rounded-xl border border-slate-700 bg-slate-900/50 p-3.5 transition hover:border-slate-500 peer-focus-visible:ring-2 peer-focus-visible:ring-teal-400 {{ $selectedStatusClasses }}">
                                    <span class="mt-1 h-2 w-2 flex-none rounded-full {{ $statusColorClasses }}"></span>
                                    <span>
                                        <span class="block text-sm font-black text-slate-200">{{ $statusLabel }}</span>
                                        <span class="mt-1 block text-xs text-slate-600">{{ $statusDescription }}</span>
                                    </span>
                                </span>
                            </label>
                            @endif
                        @endforeach
                    </div>
                    @error('memberStatus')<p class="mt-2 text-sm font-semibold text-rose-400">{{ $message }}</p>@enderror
                </fieldset>
            </div>
            <x-slot:footer>
                <button onclick="window.closeModal('memberModal')" type="button" class="rounded-xl border border-slate-700 bg-slate-800 px-4 py-2.5 text-sm font-bold text-slate-300 transition hover:bg-slate-700 hover:text-white">Cancel</button>
                <button wire:click="save" wire:loading.attr="disabled" wire:target="save" type="button" class="inline-flex items-center justify-center gap-2 rounded-xl bg-teal-500 px-5 py-2.5 text-sm font-black text-white shadow-lg shadow-teal-950/30 transition hover:bg-teal-400 disabled:cursor-wait disabled:opacity-70">
                    <svg wire:loading.remove wire:target="save" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m4.5 12.75 6 6 9-13.5" /></svg>
                    <span wire:loading.remove wire:target="save">Save changes</span>
                    <span wire:loading wire:target="save">Saving…</span>
                </button>
            </x-slot:footer>
        </x-admin.modal>

        <x-admin.modal id="banMemberModal" title="Ban member access" maxWidth="lg" :showFooter="false">
            <div class="space-y-5">
                <div class="flex items-start gap-4 rounded-2xl border border-violet-400/20 bg-violet-400/10 p-4">
                    <span class="flex h-11 w-11 flex-none items-center justify-center rounded-xl bg-violet-400/15 text-violet-300">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M18.364 18.364A9 9 0 1 0 5.636 5.636m12.728 12.728L5.636 5.636" /></svg>
                    </span>
                    <div>
                        <h3 class="font-black text-white">Restrict {{ $name }}'s access?</h3>
                        <p class="mt-1 text-sm leading-6 text-slate-400">The member remains approved, but cannot be impersonated or access member-only experiences until unbanned.</p>
                    </div>
                </div>
                <x-admin.form-group label="Reason for ban" name="banReason" required>
                    <textarea wire:model="banReason" rows="4" maxlength="500" placeholder="Explain why access is being restricted..." class="w-full rounded-xl border border-slate-700 bg-slate-950 px-4 py-3 text-white placeholder:text-slate-600 outline-none focus:border-violet-500 focus:ring-2 focus:ring-violet-500/20"></textarea>
                </x-admin.form-group>
                <div class="flex flex-col-reverse gap-3 border-t border-slate-800 pt-5 sm:flex-row sm:justify-end">
                    <button onclick="window.closeModal('banMemberModal')" type="button" class="rounded-xl border border-slate-700 bg-slate-800 px-4 py-2.5 text-sm font-bold text-white hover:bg-slate-700">Cancel</button>
                    <button wire:click="banMember" type="button" class="rounded-xl bg-violet-500 px-5 py-2.5 text-sm font-black text-white hover:bg-violet-400">Confirm ban</button>
                </div>
            </div>
        </x-admin.modal>

        @can('import members')
            <x-admin.modal id="importMemberModal" title="Import members" maxWidth="3xl" model="showImportModal" :showFooter="false">
                <div class="space-y-6">
                    <div class="relative overflow-hidden rounded-2xl border border-cyan-400/15 bg-gradient-to-br from-cyan-400/10 via-slate-950/20 to-teal-400/5 p-5">
                        <div class="pointer-events-none absolute -right-12 -top-16 h-48 w-48 rounded-full bg-cyan-400/10 blur-3xl"></div>
                        <div class="relative flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">
                            <div class="flex items-start gap-3">
                                <span class="flex h-11 w-11 flex-none items-center justify-center rounded-xl border border-cyan-400/20 bg-cyan-400/10 text-cyan-300">
                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M19.5 14.25v-2.625A3.375 3.375 0 0 0 16.125 8.25h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5A3.375 3.375 0 0 0 10.125 2.25H8.25m3.75 12-3-3m0 0-3 3m3-3v6.75m2.25-15.75H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.625a9 9 0 0 0-9-9Z" /></svg>
                                </span>
                                <div>
                                    <h3 class="text-sm font-black text-white">Bulk member import</h3>
                                    <p class="mt-1 max-w-xl text-sm leading-6 text-slate-400">Add up to {{ number_format(\App\Services\MemberCsvImporter::MAX_ROWS) }} members from CSV. Existing email addresses are safely skipped and never overwritten.</p>
                                </div>
                            </div>
                            <button wire:click="downloadImportTemplate" type="button" class="inline-flex flex-none items-center justify-center gap-2 rounded-xl border border-slate-700 bg-slate-900/70 px-3.5 py-2.5 text-xs font-black text-slate-300 transition hover:border-cyan-400/30 hover:text-cyan-300">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M7.5 10.5 12 15m0 0 4.5-4.5M12 15V3" /></svg>
                                Download template
                            </button>
                        </div>
                    </div>

                    @if($importSummary)
                        <div class="space-y-5">
                            <div class="grid gap-3 sm:grid-cols-3">
                                <div class="rounded-2xl border border-emerald-400/20 bg-emerald-400/10 p-4">
                                    <p class="text-[10px] font-black uppercase tracking-wider text-emerald-300">Imported</p>
                                    <p class="mt-2 text-2xl font-black text-white">{{ number_format($importSummary['imported']) }}</p>
                                </div>
                                <div class="rounded-2xl border border-rose-400/20 bg-rose-400/10 p-4">
                                    <p class="text-[10px] font-black uppercase tracking-wider text-rose-300">Skipped</p>
                                    <p class="mt-2 text-2xl font-black text-white">{{ number_format($importSummary['skipped']) }}</p>
                                </div>
                                <div class="rounded-2xl border border-slate-700 bg-slate-950/50 p-4">
                                    <p class="text-[10px] font-black uppercase tracking-wider text-slate-500">Rows processed</p>
                                    <p class="mt-2 text-2xl font-black text-white">{{ number_format($importSummary['total']) }}</p>
                                </div>
                            </div>

                            @if($importErrors)
                                <div class="overflow-hidden rounded-2xl border border-rose-400/20">
                                    <div class="flex items-center justify-between gap-3 border-b border-rose-400/15 bg-rose-400/10 px-4 py-3">
                                        <div>
                                            <p class="text-sm font-black text-rose-200">Rows needing attention</p>
                                            <p class="mt-0.5 text-xs text-rose-200/60">Correct these rows and import them again.</p>
                                        </div>
                                        @if($importSummary['skipped'] > count($importErrors))
                                            <span class="text-[10px] font-bold text-rose-300">First {{ count($importErrors) }} shown</span>
                                        @endif
                                    </div>
                                    <div class="max-h-60 divide-y divide-slate-800 overflow-y-auto bg-slate-950/60">
                                        @foreach($importErrors as $rowError)
                                            <div class="flex items-start gap-3 px-4 py-3">
                                                <span class="inline-flex h-7 min-w-14 items-center justify-center rounded-lg bg-rose-400/10 px-2 text-[10px] font-black text-rose-300">Row {{ $rowError['row'] }}</span>
                                                <ul class="space-y-1 text-xs leading-5 text-slate-400">
                                                    @foreach($rowError['messages'] as $errorMessage)
                                                        <li>{{ $errorMessage }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @elseif($importSummary['imported'] > 0)
                                <div class="flex items-start gap-3 rounded-2xl border border-emerald-400/20 bg-emerald-400/10 p-4">
                                    <svg class="mt-0.5 h-5 w-5 flex-none text-emerald-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" /></svg>
                                    <p class="text-sm leading-6 text-emerald-100/80">Every row passed validation and was imported successfully.</p>
                                </div>
                            @endif
                        </div>
                    @else
                        <div
                            x-data="{ uploading: false, progress: 0 }"
                            x-on:livewire-upload-start="uploading = true"
                            x-on:livewire-upload-finish="uploading = false"
                            x-on:livewire-upload-error="uploading = false"
                            x-on:livewire-upload-progress="progress = $event.detail.progress"
                        >
                            <label class="group flex min-h-44 cursor-pointer flex-col items-center justify-center rounded-2xl border-2 border-dashed border-slate-700 bg-slate-950/40 px-6 py-8 text-center transition hover:border-cyan-400/40 hover:bg-cyan-400/5">
                                <input wire:model="importFile" type="file" accept=".csv,text/csv" class="sr-only">
                                <span class="flex h-12 w-12 items-center justify-center rounded-2xl bg-slate-800 text-slate-400 transition group-hover:bg-cyan-400/10 group-hover:text-cyan-300">
                                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 16.5V9.75m0 0 3 3m-3-3-3 3M6.75 19.5A4.5 4.5 0 0 1 5.7 10.622 5.25 5.25 0 0 1 15.9 8.25h.6a4.5 4.5 0 0 1 .75 8.938" /></svg>
                                </span>
                                <template x-if="!uploading">
                                    <span class="mt-4">
                                        @if($importFile)
                                            <span class="block text-sm font-black text-cyan-200">{{ $importFile->getClientOriginalName() }}</span>
                                            <span class="mt-1 block text-xs text-slate-500">{{ number_format($importFile->getSize() / 1024, 1) }} KB · Click to replace</span>
                                        @else
                                            <span class="block text-sm font-black text-white">Choose a CSV file</span>
                                            <span class="mt-1 block text-xs text-slate-500">CSV format · Maximum 5 MB</span>
                                        @endif
                                    </span>
                                </template>
                                <div x-cloak x-show="uploading" class="mt-4 w-full max-w-xs">
                                    <div class="flex items-center justify-between text-xs font-bold text-cyan-300">
                                        <span>Uploading file</span>
                                        <span x-text="`${progress}%`"></span>
                                    </div>
                                    <div class="mt-2 h-1.5 overflow-hidden rounded-full bg-slate-800">
                                        <div class="h-full rounded-full bg-cyan-400 transition-all" x-bind:style="`width: ${progress}%`"></div>
                                    </div>
                                </div>
                            </label>
                            @error('importFile')
                                <p class="mt-2 flex items-center gap-2 text-sm font-semibold text-rose-400">
                                    <svg class="h-4 w-4 flex-none" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3.75m9-1.5a9 9 0 1 1-18 0 9 9 0 0 1 18 0ZM12 16.5h.008v.008H12V16.5Z" /></svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div>
                            <p class="text-[10px] font-black uppercase tracking-[0.16em] text-slate-600">Required headers</p>
                            <div class="mt-3 flex flex-wrap gap-2">
                                @foreach(['Name', 'Email', 'Phone', 'Category', 'Institution', 'Status', 'Access', 'Ban Reason', 'Joined'] as $header)
                                    <span class="rounded-lg border border-slate-800 bg-slate-950/50 px-2.5 py-1.5 text-[11px] font-bold text-slate-400">{{ $header }}</span>
                                @endforeach
                            </div>
                        </div>

                        <div class="grid gap-3 sm:grid-cols-2">
                            @foreach([
                                ['Defaults', 'Blank Status becomes Pending. Blank Access becomes Active.'],
                                ['Allowed values', 'Category: individual, institution, industry, student.'],
                                ['Banned access', 'Requires Approved status and a Ban Reason of at least 5 characters.'],
                                ['Joined date', 'Leave blank for today, or use the YYYY-MM-DD format.'],
                            ] as [$ruleTitle, $ruleDescription])
                                <div class="rounded-xl border border-slate-800 bg-slate-950/35 p-3.5">
                                    <p class="text-xs font-black text-slate-300">{{ $ruleTitle }}</p>
                                    <p class="mt-1 text-xs leading-5 text-slate-600">{{ $ruleDescription }}</p>
                                </div>
                            @endforeach
                        </div>
                    @endif

                    <div class="flex flex-col-reverse gap-3 border-t border-slate-800 pt-5 sm:flex-row sm:items-center sm:justify-end">
                        <button wire:click="closeImportModal" type="button" class="rounded-xl border border-slate-700 bg-slate-800 px-4 py-2.5 text-sm font-bold text-slate-300 transition hover:bg-slate-700 hover:text-white">
                            {{ $importSummary ? 'Done' : 'Cancel' }}
                        </button>
                        @if($importSummary)
                            <button wire:click="openImportModal" type="button" class="inline-flex items-center justify-center gap-2 rounded-xl bg-cyan-500 px-5 py-2.5 text-sm font-black text-white transition hover:bg-cyan-400">
                                Import another file
                            </button>
                        @else
                            <button wire:click="importMembers" wire:loading.attr="disabled" wire:target="importMembers,importFile" type="button" class="inline-flex items-center justify-center gap-2 rounded-xl bg-cyan-500 px-5 py-2.5 text-sm font-black text-white shadow-lg shadow-cyan-950/30 transition hover:bg-cyan-400 disabled:cursor-wait disabled:opacity-60">
                                <svg wire:loading.remove wire:target="importMembers" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m4.5 12.75 6 6 9-13.5" /></svg>
                                <span wire:loading.remove wire:target="importMembers">Import members</span>
                                <span wire:loading wire:target="importMembers">Validating and importing...</span>
                            </button>
                        @endif
                    </div>
                </div>
            </x-admin.modal>
        @endcan

        @if($showImpersonateModal && $impersonateMemberId)
            <div
                class="fixed inset-0 z-[130] overflow-x-hidden overflow-y-auto"
                role="dialog"
                aria-modal="true"
                aria-labelledby="member-impersonation-modal-title"
                x-data="{ submitting: false }"
                x-init="$nextTick(() => $refs.cancel.focus())"
                x-on:submit="submitting = true"
                x-on:keydown.escape.window="if (!submitting) $wire.closeImpersonationModal()"
            >
                <div class="fixed inset-0 bg-slate-950/90 backdrop-blur-md" wire:click="closeImpersonationModal"></div>

                <div class="relative flex min-h-full items-center justify-center p-4 sm:p-6">
                    <form method="POST" action="{{ route('admin.members.impersonate', $impersonateMemberId) }}" class="w-full max-w-xl overflow-hidden rounded-3xl border border-violet-400/20 bg-slate-900 shadow-2xl shadow-violet-950/40">
                        @csrf

                        <div class="relative overflow-hidden border-b border-slate-700/60 px-6 py-6 sm:px-7">
                            <div class="pointer-events-none absolute -right-12 -top-16 h-52 w-52 rounded-full bg-violet-500/20 blur-3xl"></div>
                            <div class="pointer-events-none absolute -bottom-20 left-16 h-40 w-40 rounded-full bg-cyan-500/10 blur-3xl"></div>

                            <div class="relative flex items-start gap-4">
                                <span class="flex h-12 w-12 flex-none items-center justify-center rounded-2xl border border-violet-400/25 bg-violet-400/10 text-violet-300 shadow-inner">
                                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM18 21a6 6 0 0 0-12 0m12.75-9.75 1.5 1.5-1.5 1.5m1.5-1.5H15" /></svg>
                                </span>
                                <div class="min-w-0 pr-9">
                                    <p class="text-[10px] font-black uppercase tracking-[0.18em] text-violet-300">Secure member preview</p>
                                    <h2 id="member-impersonation-modal-title" class="mt-1 text-xl font-black tracking-tight text-white sm:text-2xl">Confirm member impersonation</h2>
                                    <p class="mt-2 text-sm leading-6 text-slate-400">Review the member before continuing. You will preview the member experience using this profile.</p>
                                </div>
                                <button wire:click="closeImpersonationModal" type="button" class="absolute right-0 top-0 flex h-9 w-9 items-center justify-center rounded-xl text-slate-500 transition hover:bg-slate-800 hover:text-white" aria-label="Close confirmation">
                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18 18 6M6 6l12 12" /></svg>
                                </button>
                            </div>
                        </div>

                        <div class="space-y-5 p-6 sm:p-7">
                            <div class="flex items-center gap-4 rounded-2xl border border-slate-700/70 bg-slate-950/55 p-4">
                                <div class="flex h-14 w-14 flex-none items-center justify-center rounded-2xl bg-gradient-to-br from-violet-500 to-indigo-600 text-base font-black text-white shadow-lg shadow-violet-950/40">
                                    {{ \Illuminate\Support\Str::initials($impersonateMemberName) }}
                                </div>
                                <div class="min-w-0 flex-1">
                                    <p class="truncate text-base font-black text-white">{{ $impersonateMemberName }}</p>
                                    <p class="mt-1 truncate text-sm text-slate-500">{{ $impersonateMemberEmail }}</p>
                                    <p class="mt-1 truncate text-xs text-slate-600">{{ $impersonateMemberInstitution }}</p>
                                </div>
                                <span class="rounded-lg border border-violet-400/20 bg-violet-400/10 px-2.5 py-1 text-xs font-black capitalize text-violet-300">
                                    {{ $impersonateMemberCategory }}
                                </span>
                            </div>

                            <div class="grid gap-3 sm:grid-cols-2">
                                <div class="rounded-2xl border border-slate-800 bg-slate-950/35 p-4">
                                    <div class="flex items-center gap-2 text-cyan-300">
                                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M13.5 6H5.25A2.25 2.25 0 0 0 3 8.25v10.5A2.25 2.25 0 0 0 5.25 21h10.5A2.25 2.25 0 0 0 18 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" /></svg>
                                        <span class="text-[10px] font-black uppercase tracking-wider">Destination</span>
                                    </div>
                                    <p class="mt-2 text-sm font-bold text-white">Member portal</p>
                                    <p class="mt-1 text-xs text-slate-600">You'll continue at /member/portal.</p>
                                </div>
                                <div class="rounded-2xl border border-slate-800 bg-slate-950/35 p-4">
                                    <div class="flex items-center gap-2 text-emerald-300">
                                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" /></svg>
                                        <span class="text-[10px] font-black uppercase tracking-wider">Protected</span>
                                    </div>
                                    <p class="mt-2 text-sm font-bold text-white">Audited preview</p>
                                    <p class="mt-1 text-xs text-slate-600">Start and return events are logged.</p>
                                </div>
                            </div>

                            <div class="flex items-start gap-3 rounded-2xl border border-amber-400/20 bg-amber-400/10 p-4">
                                <svg class="mt-0.5 h-5 w-5 flex-none text-amber-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 9v3.75m9-1.5a9 9 0 1 1-18 0 9 9 0 0 1 18 0ZM12 16.5h.008v.008H12V16.5Z" /></svg>
                                <p class="text-sm leading-6 text-amber-100/80">You are entering an active member-only preview. A persistent banner lets you return safely to the admin panel at any time.</p>
                            </div>
                        </div>

                        <div class="flex flex-col-reverse gap-3 border-t border-slate-700/60 bg-slate-950/30 px-6 py-4 sm:flex-row sm:items-center sm:justify-end sm:px-7">
                            <button x-ref="cancel" wire:click="closeImpersonationModal" type="button" class="rounded-xl border border-slate-700 bg-slate-800 px-4 py-2.5 text-sm font-bold text-slate-300 transition hover:bg-slate-700 hover:text-white">Cancel</button>
                            <button type="submit" x-bind:disabled="submitting" class="inline-flex items-center justify-center gap-2 rounded-xl bg-violet-500 px-5 py-2.5 text-sm font-black text-white shadow-lg shadow-violet-950/30 transition hover:bg-violet-400 focus:outline-none focus:ring-4 focus:ring-violet-500/20 disabled:cursor-wait disabled:opacity-70">
                                <svg x-show="!submitting" class="h-4.5 w-4.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m9 18 6-6-6-6" /></svg>
                                <span x-cloak x-show="submitting" class="h-4 w-4 animate-spin rounded-full border-2 border-white/40 border-t-white"></span>
                                <span x-show="!submitting">Continue as {{ str($impersonateMemberName)->before(' ') }}</span>
                                <span x-cloak x-show="submitting">Opening member portal...</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        @endif
    </div>
</div>
