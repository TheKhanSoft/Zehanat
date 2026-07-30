<aside id="admin-sidebar" class="admin-sidebar fixed z-50 flex min-h-screen flex-shrink-0 flex-col border-r border-slate-800/80 bg-slate-950/92 shadow-2xl shadow-slate-950/30 backdrop-blur-xl md:relative">
    <!-- Logo Section -->
    <div class="sidebar-logo-section flex h-16 items-center border-b border-slate-800/80 px-5">
        <a href="{{ route('admin.dashboard') ?? '/admin' }}" class="flex items-center gap-3 w-full group">
            <div class="flex h-10 w-10 flex-none items-center justify-center overflow-hidden transition-transform group-hover:scale-105">
                <img src="{{ asset('images/brand/zehanat_symbol_glow.svg') }}" alt="Zehanat" class="w-full h-full object-contain">
            </div>
            <div class="flex flex-col sidebar-label">
                <span class="text-sm font-black tracking-wide text-white">Zehanat ذہانت</span>
                <span class="text-[9px] font-bold uppercase tracking-[0.2em] text-teal-400">Control Center</span>
            </div>
        </a>
    </div>

    <!-- Navigation -->
    <nav class="flex-1 overflow-y-auto py-6 px-3 flex flex-col gap-1 custom-scrollbar">
        @php
            $navGroups = [
                'Main' => [
                    ['route' => 'admin.dashboard', 'path' => 'admin', 'label' => 'Dashboard', 'module' => 'dashboard', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 0 1 6 3.75h2.25A2.25 2.25 0 0 1 10.5 6v2.25a2.25 2.25 0 0 1-2.25 2.25H6a2.25 2.25 0 0 1-2.25-2.25V6ZM3.75 15.75A2.25 2.25 0 0 1 6 13.5h2.25a2.25 2.25 0 0 1 2.25 2.25V18a2.25 2.25 0 0 1-2.25 2.25H6A2.25 2.25 0 0 1 3.75 18v-2.25ZM13.5 6a2.25 2.25 0 0 1 2.25-2.25H18A2.25 2.25 0 0 1 20.25 6v2.25A2.25 2.25 0 0 1 18 10.5h-2.25a2.25 2.25 0 0 1-2.25-2.25V6ZM13.5 15.75a2.25 2.25 0 0 1 2.25-2.25H18a2.25 2.25 0 0 1 2.25 2.25V18A2.25 2.25 0 0 1 18 20.25h-2.25A2.25 2.25 0 0 1 13.5 18v-2.25Z" />'],
                    ['route' => 'admin.members.index', 'path' => 'admin/members*', 'label' => 'Members', 'module' => 'members', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />'],
                    ['route' => 'admin.faqs.index', 'path' => 'admin/faqs*', 'label' => 'FAQs', 'module' => 'faqs', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 5.25h.008v.008H12v-.008Z" />'],
                    ['route' => 'admin.news.index', 'path' => 'admin/news*', 'label' => 'News & Events', 'module' => 'news', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 0 1-2.25 2.25M16.5 7.5V18a2.25 2.25 0 0 0 2.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 0 0 2.25 2.25h13.5M6 7.5h3v3H6v-3Z" />'],
                    ['route' => 'admin.contacts.index', 'path' => 'admin/contacts*', 'label' => 'Contact Messages', 'module' => 'contacts', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />'],
                ],
                'Access Control' => [
                    ['route' => 'admin.users.index', 'path' => 'admin/users*', 'label' => 'Users', 'module' => 'users', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.74-.479 3 3 0 0 0-4.682-2.72M12 12.75a5.995 5.995 0 0 0-5.058 2.772A3 3 0 0 0 2.26 18.24a8.986 8.986 0 0 0 3.74.477M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />'],
                    ['route' => 'admin.roles.index', 'path' => 'admin/roles*', 'label' => 'Roles', 'module' => 'roles', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M15.75 5.25a3 3 0 0 1 3 3m3 0a6 6 0 0 1-7.029 5.912c-.563-.097-1.159.026-1.563.43L10.5 17.25H8.25v2.25H6v2.25H2.25v-2.818c0-.597.237-1.17.659-1.591l6.499-6.499c.404-.404.527-1 .43-1.563A6 6 0 1 1 21.75 8.25Z" />'],
                    ['route' => 'admin.permissions.index', 'path' => 'admin/permissions*', 'label' => 'Permissions', 'module' => 'permissions', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />'],
                ],
                'Communication' => [
                    ['route' => 'admin.email-templates.index', 'path' => 'admin/email-templates*', 'label' => 'Email Templates', 'module' => 'email templates', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5A2.25 2.25 0 0 1 19.5 19.5h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0-8.57 5.27a2.25 2.25 0 0 1-2.36 0L2.25 6.75" />'],
                ]
            ];
        @endphp

        @foreach($navGroups as $groupName => $items)
            @php
                $visibleItems = array_filter($items, function($item) {
                    return auth()->user()->can('view ' . $item['module']);
                });
            @endphp
            @if(count($visibleItems) > 0)
                @if($groupName !== 'Main')
                    <div class="sidebar-group-label px-3 pb-2 pt-5">
                        <span class="text-xs font-semibold text-slate-500 uppercase tracking-wider sidebar-label">{{ $groupName }}</span>
                    </div>
                @endif
                @foreach($visibleItems as $item)
                    @php
                        $isActive = request()->is($item['path']);
                    @endphp
                    <a href="{{ Route::has($item['route']) ? route($item['route']) : url('/' . str_replace('*', '', $item['path'])) }}"
                       title="{{ $item['label'] }}"
                       class="sidebar-link flex items-center gap-3 rounded-xl border px-3 py-2.5 transition-all duration-200 {{ $isActive ? 'border-teal-400/15 bg-teal-400/10 text-teal-300 shadow-lg shadow-teal-950/20' : 'border-transparent text-slate-500 hover:border-slate-800 hover:bg-slate-900 hover:text-slate-200' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 flex-shrink-0">
                            {!! $item['icon'] !!}
                        </svg>
                        <span class="sidebar-label font-medium text-sm">{{ $item['label'] }}</span>
                    </a>
                @endforeach
            @endif
        @endforeach
    </nav>

    <!-- Bottom Actions -->
    <div class="mt-auto border-t border-slate-800/70 bg-slate-950/40 p-3">
        <div class="flex flex-col gap-2">
            <a href="{{ url('/') }}" title="Back to Website" class="sidebar-link flex items-center gap-3 rounded-xl border border-transparent px-3 py-2.5 text-slate-500 transition-colors hover:border-slate-800 hover:bg-slate-900 hover:text-white">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 0 0 3 8.25v10.5A2.25 2.25 0 0 0 5.25 21h10.5A2.25 2.25 0 0 0 18 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" />
                </svg>
                <span class="sidebar-label font-medium text-sm">Back to Website</span>
            </a>
            
            <form method="POST" action="{{ route('logout') ?? url('/logout') }}">
                @csrf
                <button type="submit" title="Logout" class="sidebar-link flex w-full items-center gap-3 rounded-xl border border-transparent px-3 py-2.5 text-rose-400 transition-colors hover:border-rose-500/10 hover:bg-rose-500/10 hover:text-rose-300">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15M12 9l-3 3m0 0 3 3m-3-3h12.75" />
                    </svg>
                    <span class="sidebar-label font-medium text-sm">Logout</span>
                </button>
            </form>
        </div>
    </div>
</aside>
