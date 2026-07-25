<aside id="admin-sidebar" class="admin-sidebar bg-slate-900 border-r border-slate-800 flex flex-col min-h-screen fixed md:relative z-50">
    <!-- Logo Section -->
    <div class="h-16 flex items-center px-6 border-b border-slate-800">
        <a href="{{ route('admin.dashboard') ?? '/admin' }}" class="flex items-center gap-3 w-full group">
            <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-teal-400 to-teal-600 flex items-center justify-center text-white font-bold shadow-lg shadow-teal-500/20 group-hover:shadow-teal-500/40 transition-shadow">
                Z
            </div>
            <div class="flex flex-col sidebar-label">
                <span class="text-white font-bold tracking-wide text-sm">Zehanat ذہانت</span>
                <span class="text-teal-400 text-[10px] font-medium uppercase tracking-wider">Admin Panel</span>
            </div>
        </a>
    </div>

    <!-- Navigation -->
    <nav class="flex-1 overflow-y-auto py-6 px-3 flex flex-col gap-1 custom-scrollbar">
        @php
            $navGroups = [
                'Main' => [
                    ['route' => 'admin.dashboard', 'path' => 'admin', 'label' => 'Dashboard', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 0 1 6 3.75h2.25A2.25 2.25 0 0 1 10.5 6v2.25a2.25 2.25 0 0 1-2.25 2.25H6a2.25 2.25 0 0 1-2.25-2.25V6ZM3.75 15.75A2.25 2.25 0 0 1 6 13.5h2.25a2.25 2.25 0 0 1 2.25 2.25V18a2.25 2.25 0 0 1-2.25 2.25H6A2.25 2.25 0 0 1 3.75 18v-2.25ZM13.5 6a2.25 2.25 0 0 1 2.25-2.25H18A2.25 2.25 0 0 1 20.25 6v2.25A2.25 2.25 0 0 1 18 10.5h-2.25a2.25 2.25 0 0 1-2.25-2.25V6ZM13.5 15.75a2.25 2.25 0 0 1 2.25-2.25H18a2.25 2.25 0 0 1 2.25 2.25V18A2.25 2.25 0 0 1 18 20.25h-2.25A2.25 2.25 0 0 1 13.5 18v-2.25Z" />'],
                    ['route' => 'admin.members.index', 'path' => 'admin/members*', 'label' => 'Members', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />'],
                    ['route' => 'admin.faqs.index', 'path' => 'admin/faqs*', 'label' => 'FAQs', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 5.25h.008v.008H12v-.008Z" />'],
                    ['route' => 'admin.news.index', 'path' => 'admin/news*', 'label' => 'News & Events', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 0 1-2.25 2.25M16.5 7.5V18a2.25 2.25 0 0 0 2.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 0 0 2.25 2.25h13.5M6 7.5h3v3H6v-3Z" />'],
                    ['route' => 'admin.contacts.index', 'path' => 'admin/contacts*', 'label' => 'Contact Messages', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />'],
                ],
                'Access Control' => [
                    ['route' => 'admin.roles.index', 'path' => 'admin/roles*', 'label' => 'Roles', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M15.75 5.25a3 3 0 0 1 3 3m3 0a6 6 0 0 1-7.029 5.912c-.563-.097-1.159.026-1.563.43L10.5 17.25H8.25v2.25H6v2.25H2.25v-2.818c0-.597.237-1.17.659-1.591l6.499-6.499c.404-.404.527-1 .43-1.563A6 6 0 1 1 21.75 8.25Z" />'],
                    ['route' => 'admin.permissions.index', 'path' => 'admin/permissions*', 'label' => 'Permissions', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />'],
                ]
            ];
        @endphp

        @foreach($navGroups as $groupName => $items)
            @if($groupName !== 'Main')
                <div class="px-3 pt-4 pb-2">
                    <span class="text-xs font-semibold text-slate-500 uppercase tracking-wider sidebar-label">{{ $groupName }}</span>
                </div>
            @endif
            @foreach($items as $item)
                @php
                    $isActive = request()->is($item['path']);
                @endphp
                <a href="{{ Route::has($item['route']) ? route($item['route']) : url('/' . str_replace('*', '', $item['path'])) }}" 
                   class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-all duration-200 {{ $isActive ? 'bg-teal-500/10 text-teal-400 border-l-2 border-teal-500 shadow-[inset_0_0_12px_rgba(20,184,166,0.05)]' : 'text-slate-400 hover:text-white hover:bg-slate-800/50 border-l-2 border-transparent' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 flex-shrink-0">
                        {!! $item['icon'] !!}
                    </svg>
                    <span class="sidebar-label font-medium text-sm">{{ $item['label'] }}</span>
                </a>
            @endforeach
        @endforeach
    </nav>

    <!-- Bottom Actions -->
    <div class="p-4 border-t border-slate-800/60 mt-auto bg-slate-900/50">
        <div class="flex flex-col gap-2">
            <a href="{{ url('/') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-slate-400 hover:text-white hover:bg-slate-800/50 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 0 0 3 8.25v10.5A2.25 2.25 0 0 0 5.25 21h10.5A2.25 2.25 0 0 0 18 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" />
                </svg>
                <span class="sidebar-label font-medium text-sm">Back to Website</span>
            </a>
            
            <form method="POST" action="{{ route('logout') ?? url('/logout') }}">
                @csrf
                <button type="submit" class="w-full flex items-center gap-3 px-3 py-2 rounded-lg text-rose-400 hover:text-rose-300 hover:bg-rose-500/10 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15M12 9l-3 3m0 0 3 3m-3-3h12.75" />
                    </svg>
                    <span class="sidebar-label font-medium text-sm">Logout</span>
                </button>
            </form>
        </div>
    </div>
</aside>
