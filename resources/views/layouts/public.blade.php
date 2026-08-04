<!DOCTYPE html>
<html lang="en" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{ setting('seo_description', 'Zehanat — The Khyber Pakhtunkhwa Society for AI in Education.') }}">
    <meta name="keywords" content="{{ setting('seo_keywords', 'Zehanat, AI in Education, Khyber Pakhtunkhwa, AWKUM') }}">
    <meta name="author" content="Zehanat Society">
    
    <!-- Open Graph Tags -->
    <meta property="og:title" content="@yield('title', 'Zehanat — KP Society for AI in Education')" />
    <meta property="og:description" content="@yield('meta_description', 'Zehanat — The Khyber Pakhtunkhwa Society for AI in Education. Bringing Artificial Intelligence to Every Classroom.')" />
    <meta property="og:type" content="website" />
    
    <title>@yield('title', setting('seo_title', 'Zehanat - KP Society for AI in Education'))</title>
    
    @php
        $headingFont = setting('theme_font_heading', 'Montserrat');
        $bodyFont = setting('theme_font_body', 'Nunito Sans');
        // Build Google Fonts URL
        $fonts = [];
        $fonts[] = str_replace(' ', '+', $headingFont) . ':wght@400;500;600;700;800;900';
        if ($headingFont !== $bodyFont) {
            $fonts[] = str_replace(' ', '+', $bodyFont) . ':wght@300;400;500;600;700;800';
        }
    @endphp
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family={{ implode('&family=', $fonts) }}&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/css/public.css', 'resources/js/public.js'])
    
    <!-- Swiper.js -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    
    @php
        $favicon = setting('site_favicon') ?: asset('favicon-32x32.png');
    @endphp
    <link rel="apple-touch-icon" sizes="180x180" href="{{ $favicon }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ $favicon }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ $favicon }}">
    <link rel="manifest" href="{{ asset('site.webmanifest') }}">
    <link rel="mask-icon" href="{{ asset('safari-pinned-tab.svg') }}" color="#43baff">
    <meta name="msapplication-TileColor" content="#43baff">
    <meta name="theme-color" content="#ffffff">
    
    <!-- Open Graph Default Image -->
    @if(setting('seo_og_image_upload'))
        <meta property="og:image" content="{{ asset(setting('seo_og_image_upload')) }}">
    @endif
    
    @stack('head')
    <style>
        :root {
            --color-primary: {{ setting('theme_primary_color', '#43baff') }};
            --color-second: {{ setting('theme_secondary_color', '#7141b1') }};
            --color-dark: {{ setting('theme_dark_color', '#1b1d21') }};
            --theme-radius: {{ setting('theme_border_radius', '0.5rem') }};
            --font-heading: '{{ $headingFont }}', sans-serif;
            --font-body: '{{ $bodyFont }}', sans-serif;
        }
        
        /* Apply dynamic border radius */
        .rounded-xl, .rounded-2xl, .rounded-3xl, .rounded-lg, .rounded-md {
            border-radius: var(--theme-radius) !important;
        }
        
        /* Apply global card shadow */
        @php
            $shadowLevel = setting('theme_card_shadow', 'shadow-md');
        @endphp
        @if($shadowLevel === 'none')
        .shadow-md, .shadow-lg, .shadow-xl, .shadow-2xl, .hover\:shadow-xl:hover {
            box-shadow: none !important;
        }
        @elseif($shadowLevel === 'shadow-sm')
        .shadow-md, .shadow-lg, .shadow-xl, .shadow-2xl, .hover\:shadow-xl:hover {
            box-shadow: 0 1px 2px 0 rgb(0 0 0 / 0.05) !important;
        }
        @elseif($shadowLevel === 'shadow-xl')
        .shadow-md, .shadow-lg, .shadow-xl, .shadow-2xl, .hover\:shadow-xl:hover {
            box-shadow: 0 20px 25px -5px rgb(0 0 0 / 0.1), 0 8px 10px -6px rgb(0 0 0 / 0.1) !important;
        }
        @endif
        
        @if(setting('theme_button_style') === 'gradient')
        .engitech-btn, .btn-primary {
            background: linear-gradient(135deg, var(--color-primary), var(--color-second)) !important;
            border: none !important;
            color: white !important;
        }
        @endif
        
        /* Global Heading Font */
        h1, h2, h3, h4, h5, h6, .font-heading {
            font-family: var(--font-heading) !important;
        }
        
        /* User Custom CSS */
        {!! setting('theme_custom_css') !!}
    </style>
</head>
<body class="bg-white text-[#5e6278] antialiased min-h-screen flex flex-col selection:bg-[#0c5adb] selection:text-white" style="font-family: var(--font-body)">
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
