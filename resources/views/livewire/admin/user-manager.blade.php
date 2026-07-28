<div class="space-y-6">
    @section('title', 'User Management - Admin Panel')
    @section('page_title', 'User Management')

    <x-admin.page-header
        title="User Management"
        description="Create administrator accounts, control access roles, and manage account security."
        module="Administration"
        actionText="Add User"
        actionMethod="create"
        actionPermission="create users"
    />

    <section class="grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
        <x-admin.stat-card
            title="Total Users"
            value="{{ number_format($totalUsers) }}"
            meta="{{ $newUsers }} added this month"
            color="cyan"
            icon='<svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M18 18.72a9.094 9.094 0 0 0 3.74-.479 3 3 0 0 0-4.682-2.72m.94 3.198.002.031c0 .225-.012.447-.037.666A11.945 11.945 0 0 1 12 21c-2.17 0-4.205-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.942-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.941 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" /></svg>'
        />
        <x-admin.stat-card
            title="Verified"
            value="{{ number_format($verifiedUsers) }}"
            meta="{{ $totalUsers ? round(($verifiedUsers / $totalUsers) * 100) : 0 }}% of visible users"
            color="emerald"
            icon='<svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="m4.5 12.75 6 6 9-13.5" /></svg>'
        />
        <x-admin.stat-card
            title="Using 2FA"
            value="{{ number_format($twoFactorUsers) }}"
            meta="Security protected"
            color="indigo"
            icon='<svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M16.5 10.5V6.75a4.5 4.5 0 0 0-9 0v3.75m-.75 0h10.5A2.25 2.25 0 0 1 19.5 12.75v6A2.25 2.25 0 0 1 17.25 21H6.75a2.25 2.25 0 0 1-2.25-2.25v-6a2.25 2.25 0 0 1 2.25-2.25Z" /></svg>'
        />
        <x-admin.stat-card
            title="New This Month"
            value="{{ number_format($newUsers) }}"
            meta="Recently provisioned"
            color="amber"
            icon='<svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 6v6l4 2.25m5-2.25a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" /></svg>'
        />
    </section>

    <section class="admin-panel overflow-hidden">
        <div class="border-b border-slate-700/60 p-4 sm:p-5">
            <div class="flex flex-col gap-4 xl:flex-row xl:items-center xl:justify-between">
                <div>
                    <h2 class="text-lg font-black text-white">Administrative accounts</h2>
                    <p class="mt-1 text-sm text-slate-500">{{ number_format($users->total()) }} accounts match this view.</p>
                </div>
                <div class="flex flex-col gap-3 sm:flex-row sm:flex-wrap">
                    <div class="relative sm:w-72">
                        <svg class="pointer-events-none absolute left-3.5 top-1/2 h-4.5 w-4.5 -translate-y-1/2 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m21 21-4.35-4.35m2.1-5.4a7.5 7.5 0 1 1-15 0 7.5 7.5 0 0 1 15 0Z" /></svg>
                        <input wire:model.live.debounce.250ms="search" type="search" placeholder="Search name or email" class="h-11 w-full rounded-xl border border-slate-700 bg-slate-950/70 pl-10 pr-4 text-sm text-white placeholder:text-slate-600 outline-none focus:border-teal-500 focus:ring-4 focus:ring-teal-500/10">
                    </div>
                    <select wire:model.live="roleFilter" class="h-11 rounded-xl border border-slate-700 bg-slate-950/70 px-3.5 text-sm text-slate-300 outline-none focus:border-teal-500 focus:ring-4 focus:ring-teal-500/10">
                        <option value="all">All roles</option>
                        @foreach($filterRoles as $role)
                            <option value="{{ $role->name }}">{{ str($role->name)->replace('-', ' ')->title() }}</option>
                        @endforeach
                    </select>
                    <select wire:model.live="verificationFilter" class="h-11 rounded-xl border border-slate-700 bg-slate-950/70 px-3.5 text-sm text-slate-300 outline-none focus:border-teal-500 focus:ring-4 focus:ring-teal-500/10">
                        <option value="all">All security states</option>
                        <option value="verified">Verified email</option>
                        <option value="unverified">Unverified email</option>
                        <option value="2fa">Two-factor enabled</option>
                    </select>
                </div>
            </div>
            <div class="mt-4 flex items-center justify-between border-t border-slate-800 pt-4">
                <p class="text-xs text-slate-600">Protected admin and super-admin accounts are hidden from non-super-admin operators.</p>
                <label class="flex items-center gap-2 text-xs text-slate-500">
                    Rows
                    <select wire:model.live="perPage" class="rounded-lg border border-slate-700 bg-slate-950 px-2 py-1.5 text-xs font-bold text-slate-300 outline-none">
                        @foreach([10, 15, 25, 50] as $size)
                            <option value="{{ $size }}">{{ $size }}</option>
                        @endforeach
                    </select>
                </label>
            </div>
        </div>

        @if(count($selectedUsers) > 0)
            <div class="flex flex-col gap-3 border-b border-teal-400/20 bg-teal-400/10 px-5 py-3 sm:flex-row sm:items-center sm:justify-between">
                <div class="flex items-center gap-3">
                    <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-teal-400 text-xs font-black text-slate-950">{{ count($selectedUsers) }}</span>
                    <p class="text-sm font-bold text-teal-100">{{ str('account')->plural(count($selectedUsers)) }} selected</p>
                </div>
                <div class="flex items-center gap-2">
                    @can(\App\Support\AdminPermissions::USER_VERIFY)
                        <button wire:click="bulkVerify" type="button" class="rounded-lg bg-emerald-400/15 px-3 py-2 text-xs font-black text-emerald-300 hover:bg-emerald-400/25">Verify emails</button>
                    @endcan
                    <button wire:click="clearSelection" type="button" class="rounded-lg px-3 py-2 text-xs font-black text-slate-400 hover:bg-slate-800 hover:text-white">Clear</button>
                </div>
            </div>
        @endif

        <div class="relative min-h-80">
            <div wire:loading wire:target="search, roleFilter, verificationFilter, perPage, sortBy, previousPage, nextPage, gotoPage" class="absolute inset-0 z-10 flex items-center justify-center bg-slate-950/55 backdrop-blur-sm">
                <div class="flex items-center gap-3 rounded-2xl border border-slate-700 bg-slate-900 px-5 py-3 text-sm font-bold text-white shadow-2xl">
                    <span class="h-4 w-4 animate-spin rounded-full border-2 border-teal-400 border-t-transparent"></span>
                    Updating users
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead class="bg-slate-950/40">
                        <tr>
                            <th class="w-12 px-5 py-4">
                                <button wire:click="selectVisible(@js($users->pluck('id')->all()))" type="button" class="flex h-5 w-5 items-center justify-center rounded-md border border-slate-600 text-slate-500 hover:border-teal-400 hover:text-teal-300" title="Select visible users">
                                    <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="m4.5 12.75 6 6 9-13.5" /></svg>
                                </button>
                            </th>
                            @foreach(['name' => 'User', 'email' => 'Email', 'email_verified_at' => 'Security', 'created_at' => 'Created'] as $field => $label)
                                <th wire:click="sortBy('{{ $field }}')" class="cursor-pointer whitespace-nowrap px-5 py-4 text-left text-[11px] font-black uppercase tracking-[0.14em] text-slate-500 hover:text-teal-300">
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
                        @forelse($users as $user)
                            @php
                                $role = $user->getRoleNames()->first() ?? 'No role';
                                $isSelf = $user->is(auth()->user());
                                $selected = in_array((string) $user->id, array_map('strval', $selectedUsers), true);
                            @endphp
                            <tr wire:key="user-{{ $user->id }}" class="group transition {{ $selected ? 'bg-teal-400/5' : 'hover:bg-slate-800/30' }}">
                                <td class="px-5 py-4">
                                    @if(!$isSelf)
                                        <input wire:model.live="selectedUsers" value="{{ $user->id }}" type="checkbox" class="h-4 w-4 rounded border-slate-600 bg-slate-900 text-teal-500 focus:ring-teal-500/30 focus:ring-offset-slate-900">
                                    @endif
                                </td>
                                <td class="min-w-56 px-5 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="flex h-10 w-10 flex-none items-center justify-center rounded-xl border border-slate-700 bg-gradient-to-br from-slate-800 to-slate-900 text-xs font-black text-slate-300 group-hover:border-teal-400/20 group-hover:text-teal-300">{{ $user->initials() }}</div>
                                        <div class="min-w-0">
                                            <div class="flex items-center gap-2">
                                                <p class="truncate text-sm font-black text-white">{{ $user->name }}</p>
                                                @if($isSelf)<span class="rounded bg-teal-400/10 px-1.5 py-0.5 text-[9px] font-black uppercase text-teal-300">You</span>@endif
                                            </div>
                                            <span class="mt-1 inline-flex rounded-md border border-slate-700 bg-slate-800/70 px-2 py-0.5 text-[10px] font-black capitalize text-slate-400">{{ str($role)->replace('-', ' ') }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="min-w-56 px-5 py-4">
                                    <a href="mailto:{{ $user->email }}" class="text-sm font-semibold text-slate-300 hover:text-teal-300">{{ $user->email }}</a>
                                </td>
                                <td class="min-w-48 px-5 py-4">
                                    <div class="flex flex-wrap gap-1.5">
                                        <span class="inline-flex items-center gap-1 rounded-full px-2 py-1 text-[10px] font-black {{ $user->email_verified_at ? 'bg-emerald-400/10 text-emerald-300' : 'bg-amber-400/10 text-amber-300' }}">
                                            <span class="h-1.5 w-1.5 rounded-full {{ $user->email_verified_at ? 'bg-emerald-400' : 'bg-amber-400' }}"></span>
                                            {{ $user->email_verified_at ? 'Verified' : 'Unverified' }}
                                        </span>
                                        <span class="rounded-full px-2 py-1 text-[10px] font-black {{ $user->two_factor_confirmed_at ? 'bg-violet-400/10 text-violet-300' : 'bg-slate-800 text-slate-500' }}">
                                            2FA {{ $user->two_factor_confirmed_at ? 'On' : 'Off' }}
                                        </span>
                                    </div>
                                </td>
                                <td class="whitespace-nowrap px-5 py-4">
                                    <p class="text-sm font-semibold text-slate-300">{{ $user->created_at->format('M d, Y') }}</p>
                                    <p class="mt-0.5 text-xs text-slate-600">{{ $user->created_at->diffForHumans() }}</p>
                                </td>
                                <td class="px-5 py-4">
                                    <div class="flex items-center justify-end gap-1">
                                        @role('super-admin')
                                            @can(\App\Support\SensitivePermissions::USER_IMPERSONATE)
                                                @if(!$isSelf && !$user->hasRole('super-admin') && $user->can('view dashboard'))
                                                    <button wire:click="confirmImpersonation({{ $user->id }})" type="button" class="inline-flex h-9 items-center gap-2 rounded-xl border border-violet-400/20 bg-violet-400/10 px-3 text-xs font-black text-violet-300 transition hover:bg-violet-400/20" title="Login as {{ $user->name }}">
                                                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM18 21a6 6 0 0 0-12 0m12.75-9.75 1.5 1.5-1.5 1.5m1.5-1.5H15" /></svg>
                                                        Login as
                                                    </button>
                                                @endif
                                            @endcan
                                        @endrole
                                        <button wire:click="viewUser({{ $user->id }})" type="button" class="inline-flex h-9 w-9 items-center justify-center rounded-xl text-slate-500 hover:bg-slate-700 hover:text-white" title="View user">
                                            <svg class="h-4.5 w-4.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M2.46 12C3.73 7.94 7.52 5 12 5s8.27 2.94 9.54 7c-1.27 4.06-5.06 7-9.54 7s-8.27-2.94-9.54-7Z" /></svg>
                                        </button>
                                        @if(!$isSelf)
                                            @can('edit users')
                                                <button wire:click="editUser({{ $user->id }})" type="button" class="inline-flex h-9 w-9 items-center justify-center rounded-xl text-slate-500 hover:bg-teal-400/10 hover:text-teal-300" title="Edit user">
                                                    <svg class="h-4.5 w-4.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="m16.86 4.49 2.65 2.65M5.25 18.75l3.31-.66L19.5 7.14a1.875 1.875 0 0 0-2.65-2.65L5.9 15.44l-.65 3.31Z" /></svg>
                                                </button>
                                            @endcan
                                            @can(\App\Support\AdminPermissions::USER_VERIFY)
                                                @if(!$user->email_verified_at)
                                                    <button wire:click="verifyUser({{ $user->id }})" type="button" class="inline-flex h-9 w-9 items-center justify-center rounded-xl text-slate-500 hover:bg-emerald-400/10 hover:text-emerald-300" title="Verify email">
                                                        <svg class="h-4.5 w-4.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="m4.5 12.75 6 6 9-13.5" /></svg>
                                                    </button>
                                                @endif
                                            @endcan
                                            @can(\App\Support\AdminPermissions::USER_SEND_PASSWORD_RESET)
                                                <button wire:click="sendPasswordReset({{ $user->id }})" wire:confirm="Send a password reset email to this user?" type="button" class="inline-flex h-9 w-9 items-center justify-center rounded-xl text-slate-500 hover:bg-cyan-400/10 hover:text-cyan-300" title="Send password reset">
                                                    <svg class="h-4.5 w-4.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M16.5 10.5V6.75a4.5 4.5 0 0 0-9 0v3.75m-.75 0h10.5A2.25 2.25 0 0 1 19.5 12.75v6A2.25 2.25 0 0 1 17.25 21H6.75a2.25 2.25 0 0 1-2.25-2.25v-6a2.25 2.25 0 0 1 2.25-2.25Z" /></svg>
                                                </button>
                                            @endcan
                                            @can(\App\Support\AdminPermissions::USER_RESET_TWO_FACTOR)
                                                @if($user->two_factor_confirmed_at)
                                                    <button wire:click="resetTwoFactor({{ $user->id }})" wire:confirm="Reset two-factor authentication for this user?" type="button" class="inline-flex h-9 w-9 items-center justify-center rounded-xl text-slate-500 hover:bg-violet-400/10 hover:text-violet-300" title="Reset 2FA">
                                                        <svg class="h-4.5 w-4.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M16.023 9.348h4.992V4.356m-1.291 4.125A8.25 8.25 0 1 0 20.25 12" /></svg>
                                                    </button>
                                                @endif
                                            @endcan
                                            @can('delete users')
                                                <button wire:click="confirmDelete({{ $user->id }})" type="button" class="inline-flex h-9 w-9 items-center justify-center rounded-xl text-slate-500 hover:bg-rose-400/10 hover:text-rose-300" title="Delete user">
                                                    <svg class="h-4.5 w-4.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="m14.74 9-.35 9m-4.78 0L9.26 9m9.97-3.21L18.16 19.67A2.25 2.25 0 0 1 15.92 21H8.08a2.25 2.25 0 0 1-2.24-2.08L4.77 5.79m14.46 0A48.11 48.11 0 0 0 15.38 5m-10.61.79A48.11 48.11 0 0 1 9.62 5m5.76 0V4.08c0-1.18-.91-2.17-2.09-2.2a52 52 0 0 0-2.58 0c-1.18.03-2.09 1.02-2.09 2.2V5" /></svg>
                                                </button>
                                            @endcan
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-16 text-center">
                                    <span class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-slate-800 text-slate-500">
                                        <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7" d="M18 18.72a9.094 9.094 0 0 0 3.74-.479 3 3 0 0 0-4.682-2.72M12 12.75a5.995 5.995 0 0 0-5.058 2.772A3 3 0 0 0 2.26 18.24a8.986 8.986 0 0 0 3.74.477M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" /></svg>
                                    </span>
                                    <p class="mt-4 text-base font-black text-white">No matching users</p>
                                    <p class="mt-1 text-sm text-slate-500">Adjust the account filters or create a new user.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($users->hasPages())
                <div class="border-t border-slate-700/60 bg-slate-950/20 p-4">{{ $users->links(data: ['scrollTo' => false]) }}</div>
            @endif
        </div>
    </section>

    @if($showFormModal)
        <div class="fixed inset-0 z-[110] overflow-x-hidden overflow-y-auto" role="dialog" aria-modal="true">
            <div class="fixed inset-0 bg-slate-950/85 backdrop-blur-sm" wire:click="closeModals"></div>
            <div class="relative flex min-h-full items-center justify-center p-4 sm:p-6">
                <form wire:submit.prevent="save" class="w-full max-w-2xl overflow-hidden rounded-3xl border border-slate-700/70 bg-slate-900 shadow-2xl shadow-black/60">
                    <div class="flex items-center justify-between border-b border-slate-700/60 px-6 py-5">
                        <div>
                            <h2 class="text-xl font-black text-white">{{ $userId ? 'Edit user' : 'Create user' }}</h2>
                            <p class="mt-1 text-sm text-slate-500">{{ $userId ? 'Update identity, access, and account security.' : 'Provision a new administrative account.' }}</p>
                        </div>
                        <button wire:click="closeModals" type="button" class="flex h-9 w-9 items-center justify-center rounded-xl text-slate-500 hover:bg-slate-800 hover:text-white">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18 18 6M6 6l12 12" /></svg>
                        </button>
                    </div>
                    <div class="grid gap-5 p-6 sm:grid-cols-2">
                        <x-admin.form-group label="Full name" name="name" required>
                            <input wire:model="name" type="text" class="w-full rounded-xl border border-slate-700 bg-slate-950 px-4 py-2.5 text-white outline-none focus:border-teal-500 focus:ring-2 focus:ring-teal-500/20">
                        </x-admin.form-group>
                        <x-admin.form-group label="Email address" name="email" required>
                            <input wire:model="email" type="email" class="w-full rounded-xl border border-slate-700 bg-slate-950 px-4 py-2.5 text-white outline-none focus:border-teal-500 focus:ring-2 focus:ring-teal-500/20">
                        </x-admin.form-group>
                        <x-admin.form-group :label="$userId ? 'New password (optional)' : 'Password'" name="password" :required="!$userId">
                            <input wire:model="password" type="password" autocomplete="new-password" class="w-full rounded-xl border border-slate-700 bg-slate-950 px-4 py-2.5 text-white outline-none focus:border-teal-500 focus:ring-2 focus:ring-teal-500/20">
                        </x-admin.form-group>
                        <x-admin.form-group label="Confirm password" name="password_confirmation" :required="!$userId">
                            <input wire:model="password_confirmation" type="password" autocomplete="new-password" class="w-full rounded-xl border border-slate-700 bg-slate-950 px-4 py-2.5 text-white outline-none focus:border-teal-500 focus:ring-2 focus:ring-teal-500/20">
                        </x-admin.form-group>
                        <x-admin.form-group label="Access role" name="selectedRole" required>
                            <select wire:model="selectedRole" class="w-full rounded-xl border border-slate-700 bg-slate-950 px-4 py-2.5 text-white outline-none focus:border-teal-500 focus:ring-2 focus:ring-teal-500/20">
                                @foreach($roles as $role)
                                    <option value="{{ $role->name }}">{{ str($role->name)->replace('-', ' ')->title() }}</option>
                                @endforeach
                            </select>
                        </x-admin.form-group>
                        <div>
                            <label class="mb-2 block text-sm font-medium text-slate-300">Email status</label>
                            @if($userId)
                                <div class="rounded-xl border border-slate-700 bg-slate-950/70 px-4 py-3">
                                    <span class="block text-sm font-bold {{ $emailVerified ? 'text-emerald-300' : 'text-amber-300' }}">{{ $emailVerified ? 'Verified' : 'Awaiting verification' }}</span>
                                    <span class="mt-0.5 block text-xs text-slate-600">Changing the email address requires verification again.</span>
                                </div>
                            @else
                                @can(\App\Support\AdminPermissions::USER_VERIFY)
                                    <label class="flex cursor-pointer items-center justify-between rounded-xl border border-slate-700 bg-slate-950/70 px-4 py-3">
                                        <span>
                                            <span class="block text-sm font-bold text-slate-200">Mark email verified</span>
                                            <span class="mt-0.5 block text-xs text-slate-600">Use only when ownership is already confirmed.</span>
                                        </span>
                                        <input wire:model="emailVerified" type="checkbox" class="h-5 w-5 rounded border-slate-600 bg-slate-900 text-teal-500 focus:ring-teal-500/30">
                                    </label>
                                @else
                                    <div class="rounded-xl border border-slate-700 bg-slate-950/70 px-4 py-3">
                                        <span class="block text-sm font-bold text-amber-300">Created as unverified</span>
                                        <span class="mt-0.5 block text-xs text-slate-600">Verification requires the verify users permission.</span>
                                    </div>
                                @endcan
                            @endif
                        </div>
                    </div>
                    <div class="flex flex-col-reverse gap-3 border-t border-slate-700/60 bg-slate-950/30 px-6 py-4 sm:flex-row sm:justify-end">
                        <button wire:click="closeModals" type="button" class="rounded-xl border border-slate-700 bg-slate-800 px-4 py-2.5 text-sm font-bold text-white hover:bg-slate-700">Cancel</button>
                        <button type="submit" class="inline-flex items-center justify-center gap-2 rounded-xl bg-teal-500 px-5 py-2.5 text-sm font-black text-white hover:bg-teal-400">
                            <span wire:loading.remove wire:target="save">{{ $userId ? 'Save changes' : 'Create account' }}</span>
                            <span wire:loading wire:target="save">Saving...</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif

    @if($showViewModal)
        <div class="fixed inset-0 z-[110] overflow-x-hidden overflow-y-auto" role="dialog" aria-modal="true">
            <div class="fixed inset-0 bg-slate-950/85 backdrop-blur-sm" wire:click="closeModals"></div>
            <div class="relative flex min-h-full items-center justify-center p-4 sm:p-6">
                <div class="w-full max-w-xl overflow-hidden rounded-3xl border border-slate-700/70 bg-slate-900 shadow-2xl shadow-black/60">
                    <div class="relative overflow-hidden border-b border-slate-700/60 p-6">
                        <div class="absolute right-0 top-0 h-40 w-40 rounded-full bg-teal-400/10 blur-3xl"></div>
                        <button wire:click="closeModals" type="button" class="absolute right-5 top-5 z-10 flex h-9 w-9 items-center justify-center rounded-xl text-slate-500 hover:bg-slate-800 hover:text-white">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18 18 6M6 6l12 12" /></svg>
                        </button>
                        <div class="relative flex items-center gap-4">
                            <div class="flex h-16 w-16 items-center justify-center rounded-2xl bg-gradient-to-br from-teal-400 to-cyan-600 text-lg font-black text-white">{{ \Illuminate\Support\Str::initials($name) }}</div>
                            <div class="min-w-0">
                                <h2 class="truncate text-xl font-black text-white">{{ $name }}</h2>
                                <p class="mt-1 truncate text-sm text-slate-500">{{ $email }}</p>
                                <span class="mt-2 inline-flex rounded-lg bg-slate-800 px-2.5 py-1 text-xs font-black capitalize text-slate-300">{{ str($selectedRole)->replace('-', ' ') }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="grid gap-4 p-6 sm:grid-cols-3">
                        <div class="rounded-2xl bg-slate-950/50 p-4">
                            <p class="text-[10px] font-black uppercase tracking-wider text-slate-600">Email</p>
                            <p class="mt-2 text-sm font-black {{ $emailVerified ? 'text-emerald-300' : 'text-amber-300' }}">{{ $emailVerified ? 'Verified' : 'Unverified' }}</p>
                        </div>
                        <div class="rounded-2xl bg-slate-950/50 p-4">
                            <p class="text-[10px] font-black uppercase tracking-wider text-slate-600">Two-factor</p>
                            <p class="mt-2 text-sm font-black {{ $twoFactorEnabled ? 'text-violet-300' : 'text-slate-500' }}">{{ $twoFactorEnabled ? 'Enabled' : 'Not enabled' }}</p>
                        </div>
                        <div class="rounded-2xl bg-slate-950/50 p-4">
                            <p class="text-[10px] font-black uppercase tracking-wider text-slate-600">Created</p>
                            <p class="mt-2 text-sm font-black text-slate-300">{{ $createdAt ? \Illuminate\Support\Carbon::parse($createdAt)->format('M Y') : 'Unknown' }}</p>
                        </div>
                    </div>
                    <div class="flex items-center justify-between gap-3 border-t border-slate-700/60 px-6 py-4">
                        @role('super-admin')
                            @can(\App\Support\SensitivePermissions::USER_IMPERSONATE)
                                @if($userId && $userId !== auth()->id() && $selectedRole !== 'super-admin' && $canViewDashboard)
                                    <button wire:click="confirmImpersonation({{ $userId }})" type="button" class="rounded-xl bg-violet-500 px-4 py-2.5 text-sm font-black text-white hover:bg-violet-400">Login as this user</button>
                                @endif
                            @endcan
                        @endrole
                        <button wire:click="closeModals" type="button" class="ml-auto rounded-xl bg-slate-700 px-4 py-2.5 text-sm font-bold text-white hover:bg-slate-600">Close</button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if($showImpersonateModal && $impersonateUserId)
        <div
            class="fixed inset-0 z-[130] overflow-x-hidden overflow-y-auto"
            role="dialog"
            aria-modal="true"
            aria-labelledby="impersonation-modal-title"
            x-data="{ submitting: false }"
            x-init="$nextTick(() => $refs.cancel.focus())"
            x-on:submit="submitting = true"
            x-on:keydown.escape.window="if (!submitting) $wire.closeImpersonationModal()"
        >
            <div class="fixed inset-0 bg-slate-950/90 backdrop-blur-md" wire:click="closeImpersonationModal"></div>

            <div class="relative flex min-h-full items-center justify-center p-4 sm:p-6">
                <form method="POST" action="{{ route('admin.users.impersonate', $impersonateUserId) }}" class="w-full max-w-xl overflow-hidden rounded-3xl border border-violet-400/20 bg-slate-900 shadow-2xl shadow-violet-950/40">
                    @csrf

                    <div class="relative overflow-hidden border-b border-slate-700/60 px-6 py-6 sm:px-7">
                        <div class="pointer-events-none absolute -right-12 -top-16 h-52 w-52 rounded-full bg-violet-500/20 blur-3xl"></div>
                        <div class="pointer-events-none absolute -bottom-20 left-16 h-40 w-40 rounded-full bg-cyan-500/10 blur-3xl"></div>

                        <div class="relative flex items-start gap-4">
                            <span class="flex h-12 w-12 flex-none items-center justify-center rounded-2xl border border-violet-400/25 bg-violet-400/10 text-violet-300 shadow-inner">
                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM18 21a6 6 0 0 0-12 0m12.75-9.75 1.5 1.5-1.5 1.5m1.5-1.5H15" />
                                </svg>
                            </span>
                            <div class="min-w-0 pr-9">
                                <p class="text-[10px] font-black uppercase tracking-[0.18em] text-violet-300">Secure session switch</p>
                                <h2 id="impersonation-modal-title" class="mt-1 text-xl font-black tracking-tight text-white sm:text-2xl">Confirm user impersonation</h2>
                                <p class="mt-2 text-sm leading-6 text-slate-400">Review the account before continuing. You will enter the admin panel with this user's exact permissions.</p>
                            </div>
                            <button wire:click="closeImpersonationModal" type="button" class="absolute right-0 top-0 flex h-9 w-9 items-center justify-center rounded-xl text-slate-500 transition hover:bg-slate-800 hover:text-white" aria-label="Close confirmation">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18 18 6M6 6l12 12" /></svg>
                            </button>
                        </div>
                    </div>

                    <div class="space-y-5 p-6 sm:p-7">
                        <div class="flex items-center gap-4 rounded-2xl border border-slate-700/70 bg-slate-950/55 p-4">
                            <div class="flex h-14 w-14 flex-none items-center justify-center rounded-2xl bg-gradient-to-br from-violet-500 to-indigo-600 text-base font-black text-white shadow-lg shadow-violet-950/40">
                                {{ \Illuminate\Support\Str::initials($impersonateUserName) }}
                            </div>
                            <div class="min-w-0 flex-1">
                                <p class="truncate text-base font-black text-white">{{ $impersonateUserName }}</p>
                                <p class="mt-1 truncate text-sm text-slate-500">{{ $impersonateUserEmail }}</p>
                            </div>
                            <span class="rounded-lg border border-violet-400/20 bg-violet-400/10 px-2.5 py-1 text-xs font-black capitalize text-violet-300">
                                {{ str($impersonateUserRole)->replace('-', ' ') }}
                            </span>
                        </div>

                        <div class="grid gap-3 sm:grid-cols-2">
                            <div class="rounded-2xl border border-slate-800 bg-slate-950/35 p-4">
                                <div class="flex items-center gap-2 text-cyan-300">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M13.5 6H5.25A2.25 2.25 0 0 0 3 8.25v10.5A2.25 2.25 0 0 0 5.25 21h10.5A2.25 2.25 0 0 0 18 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" /></svg>
                                    <span class="text-[10px] font-black uppercase tracking-wider">Destination</span>
                                </div>
                                <p class="mt-2 text-sm font-bold text-white">Admin dashboard</p>
                                <p class="mt-1 text-xs text-slate-600">You'll continue at /admin.</p>
                            </div>
                            <div class="rounded-2xl border border-slate-800 bg-slate-950/35 p-4">
                                <div class="flex items-center gap-2 text-emerald-300">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" /></svg>
                                    <span class="text-[10px] font-black uppercase tracking-wider">Protected</span>
                                </div>
                                <p class="mt-2 text-sm font-bold text-white">Audited session</p>
                                <p class="mt-1 text-xs text-slate-600">Start and return events are logged.</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-3 rounded-2xl border border-amber-400/20 bg-amber-400/10 p-4">
                            <svg class="mt-0.5 h-5 w-5 flex-none text-amber-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 9v3.75m9-1.5a9 9 0 1 1-18 0 9 9 0 0 1 18 0ZM12 16.5h.008v.008H12V16.5Z" /></svg>
                            <p class="text-sm leading-6 text-amber-100/80">Actions performed during impersonation use this account's permissions. A persistent banner lets you return safely to your super-admin session.</p>
                        </div>
                    </div>

                    <div class="flex flex-col-reverse gap-3 border-t border-slate-700/60 bg-slate-950/30 px-6 py-4 sm:flex-row sm:items-center sm:justify-end sm:px-7">
                        <button x-ref="cancel" wire:click="closeImpersonationModal" type="button" class="rounded-xl border border-slate-700 bg-slate-800 px-4 py-2.5 text-sm font-bold text-slate-300 transition hover:bg-slate-700 hover:text-white">Cancel</button>
                        <button type="submit" x-bind:disabled="submitting" class="inline-flex items-center justify-center gap-2 rounded-xl bg-violet-500 px-5 py-2.5 text-sm font-black text-white shadow-lg shadow-violet-950/30 transition hover:bg-violet-400 focus:outline-none focus:ring-4 focus:ring-violet-500/20 disabled:cursor-wait disabled:opacity-70">
                            <svg x-show="!submitting" class="h-4.5 w-4.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m9 18 6-6-6-6" /></svg>
                            <span x-cloak x-show="submitting" class="h-4 w-4 animate-spin rounded-full border-2 border-white/40 border-t-white"></span>
                            <span x-show="!submitting">Continue as {{ str($impersonateUserName)->before(' ') }}</span>
                            <span x-cloak x-show="submitting">Switching session...</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>
