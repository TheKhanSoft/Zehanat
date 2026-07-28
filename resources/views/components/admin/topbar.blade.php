@php
    $user = auth()->user();
    $canViewMembers = $user->can('view members');
    $canViewContacts = $user->can('view contacts');
    $pendingCount = $canViewMembers ? \App\Models\Member::pending()->count() : 0;
    $unreadCount = $canViewContacts ? \App\Models\ContactMessage::unread()->count() : 0;
    $notificationCount = $pendingCount + $unreadCount;
    $roleName = $user->getRoleNames()->first() ?? 'Administrator';
@endphp

<header
    class="sticky top-0 z-30 flex h-16 items-center justify-between border-b border-slate-800/80 bg-slate-950/80 px-3 shadow-xl shadow-slate-950/10 backdrop-blur-xl sm:px-4 lg:px-6"
    x-data="{ userMenuOpen: false, notificationsOpen: false }"
>
    <div class="flex min-w-0 items-center gap-2 sm:gap-3">
        <button id="mobile-sidebar-toggle" type="button" class="inline-flex h-10 w-10 items-center justify-center rounded-xl text-slate-400 transition hover:bg-slate-800 hover:text-white md:hidden" aria-label="Open navigation">
            <svg class="h-5.5 w-5.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
            </svg>
        </button>

        <button id="desktop-sidebar-toggle" type="button" class="hidden h-10 w-10 items-center justify-center rounded-xl text-slate-500 transition hover:bg-slate-800 hover:text-white md:inline-flex" aria-label="Collapse navigation" aria-pressed="false">
            <svg class="h-5 w-5 transition-transform" id="desktop-sidebar-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="m11.25 4.5-7.5 7.5 7.5 7.5M4.5 12h15.75" />
            </svg>
        </button>

        <div class="hidden h-6 w-px bg-slate-800 md:block"></div>
        <div class="min-w-0">
            <p class="hidden text-[10px] font-bold uppercase tracking-[0.18em] text-teal-500 sm:block">Zehanat Admin</p>
            <h1 class="truncate text-sm font-bold tracking-tight text-white sm:text-base">@yield('page_title', 'Dashboard')</h1>
        </div>
    </div>

    <div class="flex items-center gap-1.5 sm:gap-2">
        <button id="command-palette-open" type="button" class="group hidden h-10 items-center gap-2 rounded-xl border border-slate-800 bg-slate-900/70 px-3 text-sm text-slate-500 transition hover:border-slate-700 hover:bg-slate-800 hover:text-slate-300 sm:inline-flex lg:min-w-52">
            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="m21 21-4.35-4.35m2.1-5.4a7.5 7.5 0 1 1-15 0 7.5 7.5 0 0 1 15 0Z" /></svg>
            <span class="hidden lg:inline">Search or jump to...</span>
            <kbd class="ml-auto hidden rounded-md border border-slate-700 bg-slate-950 px-1.5 py-0.5 text-[10px] font-bold text-slate-600 lg:inline">Ctrl K</kbd>
        </button>

        <button id="command-palette-mobile-open" type="button" class="inline-flex h-10 w-10 items-center justify-center rounded-xl text-slate-400 transition hover:bg-slate-800 hover:text-white sm:hidden" aria-label="Search admin">
            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="m21 21-4.35-4.35m2.1-5.4a7.5 7.5 0 1 1-15 0 7.5 7.5 0 0 1 15 0Z" /></svg>
        </button>

        <div class="relative">
            <button
                type="button"
                class="relative inline-flex h-10 w-10 items-center justify-center rounded-xl text-slate-400 transition hover:bg-slate-800 hover:text-white"
                x-on:click="notificationsOpen = !notificationsOpen; userMenuOpen = false"
                aria-label="Notifications"
            >
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0" /></svg>
                @if($notificationCount > 0)
                    <span class="absolute right-1.5 top-1.5 flex h-4 min-w-4 items-center justify-center rounded-full border-2 border-slate-950 bg-rose-500 px-0.5 text-[8px] font-black text-white">{{ min($notificationCount, 99) }}</span>
                @endif
            </button>

            <div
                x-cloak
                x-show="notificationsOpen"
                x-transition.origin.top.right
                x-on:click.outside="notificationsOpen = false"
                class="absolute right-0 mt-2 w-[min(22rem,calc(100vw-1.5rem))] overflow-hidden rounded-2xl border border-slate-700/70 bg-slate-900/95 shadow-2xl shadow-black/50 backdrop-blur-xl"
            >
                <div class="flex items-center justify-between border-b border-slate-700/60 px-4 py-3.5">
                    <div>
                        <p class="text-sm font-bold text-white">Attention required</p>
                        <p class="mt-0.5 text-xs text-slate-500">{{ $notificationCount }} outstanding {{ str('item')->plural($notificationCount) }}</p>
                    </div>
                    <span class="rounded-full bg-teal-400/10 px-2.5 py-1 text-[10px] font-black uppercase tracking-wider text-teal-300">Live</span>
                </div>
                <div class="p-2">
                    @if($pendingCount > 0)
                        <a href="{{ route('admin.members.index', ['status' => 'pending']) }}" class="flex items-center gap-3 rounded-xl p-3 transition hover:bg-slate-800">
                            <span class="flex h-10 w-10 flex-none items-center justify-center rounded-xl bg-amber-400/10 text-amber-300">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 6v6l4 2.25m5-2.25a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" /></svg>
                            </span>
                            <span class="min-w-0 flex-1">
                                <span class="block text-sm font-bold text-slate-200">{{ $pendingCount }} pending applications</span>
                                <span class="mt-0.5 block text-xs text-slate-500">Review membership requests</span>
                            </span>
                            <svg class="h-4 w-4 text-slate-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m9 18 6-6-6-6" /></svg>
                        </a>
                    @endif
                    @if($unreadCount > 0)
                        <a href="{{ route('admin.contacts.index', ['status' => 'unread']) }}" class="flex items-center gap-3 rounded-xl p-3 transition hover:bg-slate-800">
                            <span class="flex h-10 w-10 flex-none items-center justify-center rounded-xl bg-violet-400/10 text-violet-300">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0L13.18 12.524a2.25 2.25 0 0 1-2.36 0L2.25 6.75" /></svg>
                            </span>
                            <span class="min-w-0 flex-1">
                                <span class="block text-sm font-bold text-slate-200">{{ $unreadCount }} unread messages</span>
                                <span class="mt-0.5 block text-xs text-slate-500">Open the contact inbox</span>
                            </span>
                            <svg class="h-4 w-4 text-slate-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m9 18 6-6-6-6" /></svg>
                        </a>
                    @endif
                    @if($notificationCount === 0)
                        <div class="px-4 py-8 text-center">
                            <span class="mx-auto flex h-12 w-12 items-center justify-center rounded-2xl bg-emerald-400/10 text-emerald-300">
                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="m4.5 12.75 6 6 9-13.5" /></svg>
                            </span>
                            <p class="mt-3 text-sm font-bold text-white">You are all caught up</p>
                            <p class="mt-1 text-xs text-slate-500">There are no outstanding items.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="relative">
            <button
                type="button"
                class="flex items-center gap-2 rounded-xl p-1.5 transition hover:bg-slate-800"
                x-on:click="userMenuOpen = !userMenuOpen; notificationsOpen = false"
                aria-label="Open user menu"
            >
                <span class="hidden flex-col items-end sm:flex">
                    <span class="max-w-32 truncate text-xs font-bold text-white">{{ $user->name }}</span>
                    <span class="max-w-32 truncate text-[10px] font-medium capitalize text-slate-500">{{ str($roleName)->replace('-', ' ') }}</span>
                </span>
                <span class="flex h-9 w-9 items-center justify-center rounded-xl border border-teal-400/20 bg-gradient-to-br from-teal-400 to-cyan-600 text-xs font-black text-white shadow-lg shadow-teal-500/15">
                    {{ $user->initials() }}
                </span>
                <svg class="hidden h-3.5 w-3.5 text-slate-500 transition-transform sm:block" :class="{ 'rotate-180': userMenuOpen }" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19.5 8.25-7.5 7.5-7.5-7.5" /></svg>
            </button>

            <div
                x-cloak
                x-show="userMenuOpen"
                x-transition.origin.top.right
                x-on:click.outside="userMenuOpen = false"
                class="absolute right-0 mt-2 w-60 overflow-hidden rounded-2xl border border-slate-700/70 bg-slate-900/95 p-2 shadow-2xl shadow-black/50 backdrop-blur-xl"
            >
                <div class="border-b border-slate-800 px-3 py-3">
                    <p class="truncate text-sm font-bold text-white">{{ $user->name }}</p>
                    <p class="mt-0.5 truncate text-xs text-slate-500">{{ $user->email }}</p>
                </div>
                <div class="py-2">
                    <a href="{{ route('admin.profile') }}" class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium text-slate-300 transition hover:bg-slate-800 hover:text-white">
                        <svg class="h-4.5 w-4.5 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0" /></svg>
                        Profile & security
                    </a>
                    <a href="{{ url('/') }}" target="_blank" class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium text-slate-300 transition hover:bg-slate-800 hover:text-white">
                        <svg class="h-4.5 w-4.5 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M13.5 6H5.25A2.25 2.25 0 0 0 3 8.25v10.5A2.25 2.25 0 0 0 5.25 21h10.5A2.25 2.25 0 0 0 18 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" /></svg>
                        Open website
                    </a>
                </div>
                <form method="POST" action="{{ route('logout') }}" class="border-t border-slate-800 pt-2">
                    @csrf
                    <button type="submit" class="flex w-full items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium text-rose-300 transition hover:bg-rose-400/10">
                        <svg class="h-4.5 w-4.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3-6 3 3m0 0-3 3m3-3H9" /></svg>
                        Sign out
                    </button>
                </form>
            </div>
        </div>
    </div>
</header>
