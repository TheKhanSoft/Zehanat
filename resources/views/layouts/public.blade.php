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
    
    <!-- Google Fonts: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/css/public.css', 'resources/js/public.js'])
    
    @stack('head')
</head>
<body class="bg-slate-950 text-slate-200 font-['Inter'] antialiased min-h-screen flex flex-col">
    
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
