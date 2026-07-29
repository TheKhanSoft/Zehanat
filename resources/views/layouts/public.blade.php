<!DOCTYPE html>
<html lang="en" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="@yield('meta_description', 'Zehanat — The Khyber Pakhtunkhwa Society for AI in Education. Bringing Artificial Intelligence to Every Classroom.')">
    <meta name="keywords" content="Zehanat, AI in Education, Khyber Pakhtunkhwa, AWKUM, Artificial Intelligence, Education, Pakistan">
    <meta name="author" content="Zehanat Society">
    
    <!-- Open Graph Tags -->
    <meta property="og:title" content="@yield('title', 'Zehanat — KP Society for AI in Education')" />
    <meta property="og:description" content="@yield('meta_description', 'Zehanat — The Khyber Pakhtunkhwa Society for AI in Education. Bringing Artificial Intelligence to Every Classroom.')" />
    <meta property="og:type" content="website" />
    
    <title>@yield('title', 'Zehanat — KP Society for AI in Education')</title>
    
    <!-- Google Fonts: Montserrat & Nunito Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800;900&family=Nunito+Sans:wght@300;400;600;700;800&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/css/public.css', 'resources/js/public.js'])
    
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="apple-touch-icon" href="{{ asset('apple-touch-icon.png') }}">
    @stack('head')
</head>
<body class="bg-white text-[#5e6278] font-['Nunito_Sans',sans-serif] antialiased min-h-screen flex flex-col selection:bg-[#0c5adb] selection:text-white">
    <x-user-impersonation-banner />
    @if(session()->has('member_impersonation') && auth()->check())
        <div class="sticky top-0 z-[100] border-b border-amber-300/20 bg-amber-400 px-4 py-2 text-slate-950 shadow-xl shadow-amber-950/20">
            <div class="mx-auto flex max-w-7xl flex-col items-center justify-between gap-2 sm:flex-row">
                <div class="flex items-center gap-2 text-center text-xs font-bold sm:text-left">
                    <svg class="h-4 w-4 flex-none" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12H9m3-3v6m9-3a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" /></svg>
                    Impersonation preview: you are viewing the site as {{ session('member_impersonation.member_name') }}.
                </div>
                <form method="POST" action="{{ route('member.impersonation.stop') }}">
                    @csrf
                    <button type="submit" class="inline-flex items-center gap-2 rounded-lg bg-slate-950 px-3 py-1.5 text-xs font-black text-white transition hover:bg-slate-800">
                        Return to admin
                        <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m9 18 6-6-6-6" /></svg>
                    </button>
                </form>
            </div>
        </div>
    @endif
    
    <!-- Navbar -->
    <x-public.navbar />
    
    <!-- Main Content -->
    <main class="flex-1">
        @yield('content')
    </main>
    
    <!-- Footer -->
    <x-public.footer />
    
    @stack('scripts')
</body>
</html>
