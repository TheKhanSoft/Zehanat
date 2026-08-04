@php
    $footerStyle = setting('theme_footer_style', 'dark');
    $footerBg = $footerStyle === 'dark' ? 'bg-['.setting('theme_dark_color', '#1b1d21').']' : ($footerStyle === 'primary' ? 'bg-primary' : 'bg-slate-50');
    $footerText = $footerStyle === 'light' ? 'text-slate-600' : ($footerStyle === 'primary' ? 'text-white/80' : 'text-[#a0a0a0]');
    $footerHeading = $footerStyle === 'light' ? '!text-slate-900' : '!text-white';
    $footerBorder = $footerStyle === 'light' ? 'border-slate-200' : ($footerStyle === 'primary' ? 'border-white/20' : 'border-[#2d2f33]');
    $footerLogo = setting('footer_logo') ?: ($footerStyle === 'light' ? (setting('site_logo_dark') ?: asset('images/brand/zehanat_logo_horizontal.svg')) : (setting('site_logo_light') ?: asset('images/brand/zehanat_symbol_glow.svg')));
    $iconBg = $footerStyle === 'light' ? 'bg-slate-200 hover:bg-primary' : 'bg-white/5 hover:bg-primary';
    $iconColor = $footerStyle === 'light' ? 'text-slate-600 hover:text-white' : 'text-white';
    
    $bgStyle = '';
    $bgHtml = '';
    
    $bgImage = setting('footer_bg_image');
    if ($bgImage) {
        $overlayColor = setting('footer_bg_overlay_color') ?: '#000000';
        $opacity = setting('footer_bg_overlay_opacity') ?: '90';
        $opacityDec = $opacity / 100;
        
        $bgStyle = "background-image: url('{$bgImage}'); background-size: cover; background-position: center;";
        $bgHtml = "<div class=\"absolute inset-0 z-0\" style=\"background-color: {$overlayColor}; opacity: {$opacityDec};\"></div>";
    }
@endphp
<!-- Engitech Style Footer -->
<footer class="{{ $footerBg }} {{ $footerText }} relative overflow-hidden font-body" style="{{ $bgStyle }}">
    {!! $bgHtml !!}
    
    <!-- Top Accent Line -->
    <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-primary to-second z-10"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-20 pb-16 relative z-10">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-16">
            <!-- Col 1: Brand & Overview -->
            <div class="space-y-8">
                <div class="clearfix">
                    <a href="/" class="float-left mr-5 mb-2 mt-1 transition-transform hover:scale-105 duration-300 block">
                        <img src="{{ $footerLogo }}" alt="Zehanat" class="h-[60px] w-auto {{ $footerStyle === 'dark' ? 'drop-shadow-[0_0_15px_rgba(67,186,255,0.2)]' : '' }}">
                    </a>
                    <p class="text-[15px] leading-[1.8] {{ $footerText }} m-1 text-justify">
                        {{ setting('footer_description', 'The Khyber Pakhtunkhwa Society for AI in Education — bridging artificial intelligence research, classroom pedagogy, and academic excellence under Abdul Wali Khan University Mardan.') }}
                    </p>
                </div>
                <div class="flex items-center space-x-2">
                    @php
                        $socials = setting('social_networks');
                        if (is_string($socials)) $socials = json_decode($socials, true);
                        if (!is_array($socials)) $socials = [];
                    @endphp
                    @foreach($socials as $social)
                        <a href="{{ $social['url'] }}" class="w-[42px] h-[42px] rounded-lg {{ $iconBg }} {{ $iconColor }} border border-transparent flex items-center justify-center hover:-translate-y-1 hover:shadow-[0_8px_15px_rgba(67,186,255,0.25)] transition-all duration-300" aria-label="{{ ucfirst($social['platform']) }}" target="_blank" rel="noopener noreferrer">
                            <x-public.social-icon platform="{{ $social['platform'] }}" class="w-[18px] h-[18px] fill-current" />
                        </a>
                    @endforeach
                </div>
            </div>

            <!-- Col 2: Quick Links -->
            <div>
                <h4 class="font-heading font-extrabold text-[18px] {{ $footerHeading }} mb-8">
                    {{ setting('footer_col2_heading', 'Quick Links') }}
                </h4>
                <ul class="space-y-4 text-[15px]">
                    @php
                        $col2Links = setting('footer_col2_links');
                        if (is_string($col2Links)) $col2Links = json_decode($col2Links, true);
                        if (!is_array($col2Links)) $col2Links = [];
                    @endphp
                    @foreach($col2Links as $link)
                        <li><a href="{{ $link['url'] ?? '#' }}" class="hover:text-primary transition-colors flex items-center gap-2"><span class="text-primary text-lg leading-none">&rsaquo;</span> {{ $link['label'] ?? '' }}</a></li>
                    @endforeach
                </ul>
            </div>

            <!-- Col 3: Key Initiatives -->
            <div>
                <h4 class="font-heading font-extrabold text-[18px] {{ $footerHeading }} mb-8">
                    {{ setting('footer_col3_heading', 'Key Programs') }}
                </h4>
                <ul class="space-y-4 text-[15px]">
                    @php
                        $col3Links = setting('footer_col3_links');
                        if (is_string($col3Links)) $col3Links = json_decode($col3Links, true);
                        if (!is_array($col3Links)) $col3Links = [];
                    @endphp
                    @foreach($col3Links as $link)
                        <li><a href="{{ $link['url'] ?? '#' }}" class="hover:text-primary transition-colors flex items-center gap-2"><span class="text-primary text-lg leading-none">&rsaquo;</span> {{ $link['label'] ?? '' }}</a></li>
                    @endforeach
                </ul>
            </div>

            <!-- Col 4: Official Contact Info -->
            <div>
                <h4 class="font-heading font-extrabold text-[18px] {{ $footerHeading }} mb-8">
                    {{ setting('footer_col4_heading', 'Contact Us') }}
                </h4>
                <ul class="space-y-5 text-[15px]">
                    <li class="flex items-start gap-4">
                        <div class="mt-1 text-primary">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        </div>
                        <span class="leading-relaxed">{{ setting('contact_address', 'Abdul Wali Khan University Mardan, Khyber Pakhtunkhwa, Pakistan') }}</span>
                    </li>
                    <li class="flex items-center gap-4">
                        <div class="text-primary">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        </div>
                        <a href="mailto:{{ setting('contact_email', 'info@awkum.edu.pk') }}" class="hover:text-primary transition-colors">{{ setting('contact_email', 'info@awkum.edu.pk') }}</a>
                    </li>
                    <li class="flex items-center gap-4">
                        <div class="text-primary">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                        </div>
                        <a href="tel:{{ setting('contact_phone', '+92 937 9230618') }}" class="hover:text-primary transition-colors font-medium">{{ setting('contact_phone', '+92 937 9230618') }}</a>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Sub-Footer -->
        <div class="pt-8 border-t {{ $footerBorder }} flex flex-col md:flex-row items-center justify-between gap-4 text-[13px] text-[#a0a0a0] relative z-10">
            <p>{!! setting('footer_copyright_text', 'Copyright &copy; ' . date('Y') . ' Zehanat. All rights reserved.') !!}</p>
            <div class="flex items-center space-x-6">
                <a href="/privacy" class="hover:text-primary transition-colors">Privacy Policy</a>
                <a href="/terms" class="hover:text-primary transition-colors">Terms of Use</a>
            </div>
        </div>
    </div>
</footer>
