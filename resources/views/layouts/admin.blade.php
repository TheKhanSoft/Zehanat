<!DOCTYPE html>
<html lang="en" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin') — Zehanat Admin</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/css/admin.css'])
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('site.webmanifest') }}">
    <link rel="mask-icon" href="{{ asset('safari-pinned-tab.svg') }}" color="#43baff">
    <meta name="msapplication-TileColor" content="#43baff">
    <meta name="theme-color" content="#ffffff">
    @livewireStyles
    @stack('head')
</head>
<body class="admin-body min-h-screen bg-slate-950 font-['Inter'] text-slate-200 antialiased selection:bg-teal-500/30 selection:text-teal-200">
    <x-user-impersonation-banner />
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <x-admin.sidebar />
        
        <!-- Overlay for mobile -->
        <div class="sidebar-overlay transition-opacity duration-300" id="sidebar-overlay" onclick="document.getElementById('admin-sidebar').classList.remove('mobile-open')"></div>
        
        <!-- Main Area -->
        <div class="admin-content min-w-0 flex-1 flex flex-col min-h-screen relative">
            <!-- Topbar -->
            <x-admin.topbar />
            
            <!-- Page Content -->
            <main class="flex-1 p-4 sm:p-6 lg:p-8">
                <div class="mx-auto w-full max-w-[1600px]">
                <!-- Flash Messages -->
                @if(session('success'))
                    <div class="mb-6">
                        <x-public.alert type="success" :dismissible="true">{{ session('success') }}</x-public.alert>
                    </div>
                @endif
                @if(session('error'))
                    <div class="mb-6">
                        <x-public.alert type="danger" :dismissible="true">{{ session('error') }}</x-public.alert>
                    </div>
                @endif
                
                @yield('content')
                {{ $slot ?? '' }}
                </div>
            </main>
            
            <!-- Footer -->
            <footer class="border-t border-slate-800/60 px-6 lg:px-8 py-4 bg-slate-900/20">
                <p class="text-xs text-slate-500 text-center font-medium">© {{ date('Y') }} Zehanat Admin Panel. Developed by Kashif Ahmad Khan & Dr. Muhammad Ilyas Khalil, Directorate of IT</p>
            </footer>
        </div>
    </div>
    
    {{-- Global command palette --}}
    <div id="admin-command-palette" class="fixed inset-0 z-[120] hidden" role="dialog" aria-modal="true" aria-labelledby="command-palette-title">
        <div class="absolute inset-0 bg-slate-950/80 backdrop-blur-sm" data-command-close></div>
        <div class="relative mx-auto mt-[10vh] w-[min(40rem,calc(100%-1.5rem))] overflow-hidden rounded-3xl border border-slate-700/70 bg-slate-900/95 shadow-2xl shadow-black/60">
            <div class="flex items-center gap-3 border-b border-slate-700/70 px-5">
                <svg class="h-5 w-5 flex-none text-teal-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="m21 21-4.35-4.35m2.1-5.4a7.5 7.5 0 1 1-15 0 7.5 7.5 0 0 1 15 0Z" /></svg>
                <input id="admin-command-input" type="search" class="h-16 min-w-0 flex-1 border-0 bg-transparent text-base text-white outline-none placeholder:text-slate-600 focus:ring-0" placeholder="Search pages and actions..." autocomplete="off">
                <kbd class="rounded-lg border border-slate-700 bg-slate-950 px-2 py-1 text-[10px] font-bold text-slate-500">ESC</kbd>
            </div>
            <div class="max-h-[60vh] overflow-y-auto p-2" id="admin-command-list">
                <p class="px-3 pb-2 pt-3 text-[10px] font-black uppercase tracking-[0.18em] text-slate-600">Navigate</p>
                @php
                    $commandItems = [
                        ['permission' => 'view dashboard', 'route' => 'admin.dashboard', 'title' => 'Dashboard', 'description' => 'Overview, analytics and recent activity', 'keywords' => 'home command center analytics'],
                        ['permission' => 'view members', 'route' => 'admin.members.index', 'title' => 'Members', 'description' => 'Review and manage membership applications', 'keywords' => 'people applications approvals'],
                        ['permission' => 'view contacts', 'route' => 'admin.contacts.index', 'title' => 'Contact inbox', 'description' => 'Read and respond to website inquiries', 'keywords' => 'messages email communication'],
                        ['permission' => 'view news', 'route' => 'admin.news.index', 'title' => 'News & Events', 'description' => 'Create and publish website content', 'keywords' => 'content posts articles events'],
                        ['permission' => 'view faqs', 'route' => 'admin.faqs.index', 'title' => 'FAQs', 'description' => 'Maintain frequently asked questions', 'keywords' => 'help questions knowledge'],
                        ['permission' => 'view users', 'route' => 'admin.users.index', 'title' => 'User Management', 'description' => 'Create accounts and manage access security', 'keywords' => 'administrators accounts roles verification 2fa'],
                        ['permission' => 'view roles', 'route' => 'admin.roles.index', 'title' => 'Roles', 'description' => 'Manage administrative roles', 'keywords' => 'access security users'],
                        ['permission' => 'view permissions', 'route' => 'admin.permissions.index', 'title' => 'Permissions', 'description' => 'Configure access capabilities', 'keywords' => 'access control security'],
                        ['permission' => 'view email templates', 'route' => 'admin.email-templates.index', 'title' => 'Email Templates', 'description' => 'Edit, preview and test transactional emails', 'keywords' => 'mail communication notifications content'],
                        ['permission' => null, 'route' => 'admin.profile', 'title' => 'Profile & Security', 'description' => 'Account details, password and two-factor auth', 'keywords' => 'settings account password 2fa'],
                    ];
                @endphp
                @foreach($commandItems as $command)
                    @if(!$command['permission'] || auth()->user()->can($command['permission']))
                        <a
                            href="{{ route($command['route']) }}"
                            data-command-item
                            data-search="{{ strtolower($command['title'].' '.$command['description'].' '.$command['keywords']) }}"
                            class="flex items-center gap-3 rounded-2xl px-3 py-3 transition hover:bg-slate-800 focus:bg-slate-800"
                        >
                            <span class="flex h-10 w-10 flex-none items-center justify-center rounded-xl border border-slate-700 bg-slate-950/60 text-teal-400">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M8.25 4.5h7.5a3.75 3.75 0 0 1 3.75 3.75v7.5a3.75 3.75 0 0 1-3.75 3.75h-7.5a3.75 3.75 0 0 1-3.75-3.75v-7.5A3.75 3.75 0 0 1 8.25 4.5Z" /></svg>
                            </span>
                            <span class="min-w-0 flex-1">
                                <span class="block text-sm font-bold text-slate-200">{{ $command['title'] }}</span>
                                <span class="mt-0.5 block truncate text-xs text-slate-500">{{ $command['description'] }}</span>
                            </span>
                            <svg class="h-4 w-4 text-slate-700" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m9 18 6-6-6-6" /></svg>
                        </a>
                    @endif
                @endforeach
                <div id="admin-command-empty" class="hidden px-5 py-12 text-center">
                    <p class="text-sm font-bold text-slate-300">No matching destination</p>
                    <p class="mt-1 text-xs text-slate-600">Try a page name such as members, news, or profile.</p>
                </div>
            </div>
            <div class="flex items-center justify-between border-t border-slate-800 bg-slate-950/40 px-5 py-3 text-[10px] font-semibold text-slate-600">
                <span>Type to filter</span>
                <span>Press Enter to open the first result</span>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const sidebar = document.getElementById('admin-sidebar');
            const mobileToggle = document.getElementById('mobile-sidebar-toggle');
            const desktopToggle = document.getElementById('desktop-sidebar-toggle');
            const desktopIcon = document.getElementById('desktop-sidebar-icon');

            if (sidebar && localStorage.getItem('admin-sidebar-collapsed') === 'true' && window.innerWidth >= 768) {
                sidebar.classList.add('collapsed');
                desktopToggle?.setAttribute('aria-pressed', 'true');
                desktopIcon?.classList.add('rotate-180');
            }

            if (mobileToggle && sidebar) {
                mobileToggle.addEventListener('click', () => {
                    sidebar.classList.toggle('mobile-open');
                });
            }

            if (desktopToggle && sidebar) {
                desktopToggle.addEventListener('click', () => {
                    const collapsed = sidebar.classList.toggle('collapsed');
                    desktopToggle.setAttribute('aria-pressed', collapsed ? 'true' : 'false');
                    desktopIcon?.classList.toggle('rotate-180', collapsed);
                    localStorage.setItem('admin-sidebar-collapsed', collapsed ? 'true' : 'false');
                });
            }

            const palette = document.getElementById('admin-command-palette');
            const paletteInput = document.getElementById('admin-command-input');
            const paletteEmpty = document.getElementById('admin-command-empty');
            const paletteItems = [...document.querySelectorAll('[data-command-item]')];

            const openPalette = () => {
                if (!palette) return;
                palette.classList.remove('hidden');
                document.body.style.overflow = 'hidden';
                requestAnimationFrame(() => paletteInput?.focus());
            };

            const closePalette = () => {
                if (!palette) return;
                palette.classList.add('hidden');
                document.body.style.overflow = '';
                if (paletteInput) {
                    paletteInput.value = '';
                    paletteItems.forEach(item => item.classList.remove('hidden'));
                    paletteEmpty?.classList.add('hidden');
                }
            };

            document.getElementById('command-palette-open')?.addEventListener('click', openPalette);
            document.getElementById('command-palette-mobile-open')?.addEventListener('click', openPalette);
            document.querySelectorAll('[data-command-close]').forEach(item => item.addEventListener('click', closePalette));

            paletteInput?.addEventListener('input', event => {
                const term = event.target.value.trim().toLowerCase();
                let visibleCount = 0;
                paletteItems.forEach(item => {
                    const visible = item.dataset.search.includes(term);
                    item.classList.toggle('hidden', !visible);
                    if (visible) visibleCount++;
                });
                paletteEmpty?.classList.toggle('hidden', visibleCount > 0);
            });

            document.addEventListener('keydown', event => {
                if ((event.ctrlKey || event.metaKey) && event.key.toLowerCase() === 'k') {
                    event.preventDefault();
                    palette?.classList.contains('hidden') ? openPalette() : closePalette();
                } else if (event.key === 'Escape' && !palette?.classList.contains('hidden')) {
                    closePalette();
                } else if (event.key === 'Enter' && document.activeElement === paletteInput) {
                    const firstVisible = paletteItems.find(item => !item.classList.contains('hidden'));
                    if (firstVisible) window.location.href = firstVisible.href;
                }
            });
        });
    </script>

    <livewire:admin.ui.toast-notification />
    <livewire:admin.ui.confirmation-modal />

    @livewireScripts
    @stack('scripts')
</body>
</html>
