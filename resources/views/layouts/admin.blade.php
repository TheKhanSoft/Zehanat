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
    @stack('head')
</head>
<body class="bg-slate-950 text-slate-200 font-['Inter'] antialiased min-h-screen selection:bg-teal-500/30 selection:text-teal-200">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <x-admin.sidebar />
        
        <!-- Overlay for mobile -->
        <div class="sidebar-overlay transition-opacity duration-300" id="sidebar-overlay" onclick="document.getElementById('admin-sidebar').classList.remove('mobile-open')"></div>
        
        <!-- Main Area -->
        <div class="admin-content flex-1 flex flex-col min-h-screen relative">
            <!-- Topbar -->
            <x-admin.topbar />
            
            <!-- Page Content -->
            <main class="flex-1 p-6 lg:p-8">
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
            </main>
            
            <!-- Footer -->
            <footer class="border-t border-slate-800/60 px-6 lg:px-8 py-4 bg-slate-900/20">
                <p class="text-xs text-slate-500 text-center font-medium">© {{ date('Y') }} Zehanat Admin Panel. Developed by Kashif Ahmad Khan & Dr. Muhammad Ilyas Khalil, Directorate of IT</p>
            </footer>
        </div>
    </div>
    
    <script>
        // Mobile sidebar toggle
        document.addEventListener('DOMContentLoaded', () => {
            const sidebar = document.getElementById('admin-sidebar');
            const toggleBtn = document.getElementById('mobile-sidebar-toggle');
            if (toggleBtn && sidebar) {
                toggleBtn.addEventListener('click', () => {
                    sidebar.classList.toggle('mobile-open');
                });
            }
        });
    </script>
    @stack('scripts')
</body>
</html>
