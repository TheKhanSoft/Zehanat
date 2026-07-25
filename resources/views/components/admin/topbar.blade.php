<header class="h-16 bg-slate-900 border-b border-slate-800 flex items-center justify-between px-4 lg:px-8 sticky top-0 z-30 shadow-sm">
    <div class="flex items-center gap-4">
        <!-- Mobile Menu Toggle -->
        <button id="mobile-sidebar-toggle" class="md:hidden text-slate-400 hover:text-white focus:outline-none p-1 rounded-md hover:bg-slate-800 transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
              <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
            </svg>
        </button>

        <!-- Page Title -->
        <h1 class="text-lg font-semibold text-white tracking-tight flex items-center gap-2">
            @yield('page_title', 'Dashboard')
        </h1>
    </div>

    <!-- User Menu -->
    <div class="flex items-center gap-4">
        <div class="relative group">
            <button class="flex items-center gap-3 focus:outline-none py-1 px-2 rounded-lg hover:bg-slate-800/50 transition-colors">
                <div class="flex flex-col items-end hidden sm:flex">
                    <span class="text-sm font-medium text-white">{{ auth()->user()->name ?? 'Admin User' }}</span>
                    <span class="text-xs text-slate-400">{{ auth()->user()->role ?? 'Administrator' }}</span>
                </div>
                <div class="h-9 w-9 rounded-full bg-gradient-to-r from-teal-500 to-emerald-500 flex items-center justify-center text-white font-bold shadow-md shadow-teal-500/20 border-2 border-slate-800 group-hover:border-teal-500/50 transition-colors">
                    {{ auth()->check() && method_exists(auth()->user(), 'initials') ? auth()->user()->initials() : substr(auth()->user()->name ?? 'A', 0, 1) }}
                </div>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-slate-400 hidden sm:block">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                </svg>
            </button>
            
            <!-- Dropdown Menu -->
            <div class="absolute right-0 mt-1 w-48 bg-slate-800 rounded-xl shadow-xl border border-slate-700 py-2 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 transform origin-top-right group-hover:scale-100 scale-95 z-50">
                <div class="px-4 py-2 border-b border-slate-700/50 sm:hidden">
                    <p class="text-sm font-medium text-white">{{ auth()->user()->name ?? 'Admin User' }}</p>
                    <p class="text-xs text-slate-400">{{ auth()->user()->email ?? 'admin@example.com' }}</p>
                </div>
                <a href="#" class="block px-4 py-2 text-sm text-slate-300 hover:text-white hover:bg-slate-700/50 transition-colors">Profile Settings</a>
                <form method="POST" action="{{ route('logout') ?? url('/logout') }}" class="block">
                    @csrf
                    <button type="submit" class="w-full text-left px-4 py-2 text-sm text-rose-400 hover:text-rose-300 hover:bg-rose-500/10 transition-colors">
                        Sign Out
                    </button>
                </form>
            </div>
        </div>
    </div>
</header>
