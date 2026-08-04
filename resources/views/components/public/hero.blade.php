@props([
    'showParticles' => false,
])

@php
    $slides = \App\Models\HeroSlide::enabled()->orderBy('sort_order')->get();
@endphp

<section id="hero-slider-wrapper" class="hero-slider-container h-[600px] lg:h-[650px] w-full flex items-center bg-[#111]">

    @foreach($slides as $index => $slide)
    <div data-hero-slide="{{ $index }}" class="hero-slide {{ $index === 0 ? 'active' : '' }} absolute inset-0 w-full h-full flex items-center">
        <div class="hero-bg-layer" style="background-image: url('{{ str_starts_with($slide->background_image, '/') || str_starts_with($slide->background_image, 'http') ? asset(ltrim($slide->background_image, '/')) : asset('storage/' . $slide->background_image) }}');"></div>
        <div class="hero-content-wrapper relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full text-center lg:text-left">
            <div class="max-w-3xl">
                @if($slide->tag)
                <div class="layer-tag engitech-tag mb-4 bg-black/40 px-4 py-1.5 rounded-sm backdrop-blur-sm inline-block shadow-lg">
                    <span class="text-white tracking-widest text-sm drop-shadow-md" style="color: #ffffff !important;">{{ html_entity_decode($slide->tag) }}</span>
                </div>
                @endif
                
                @if($slide->title)
                <h1 class="layer-title text-5xl sm:text-6xl lg:text-7xl font-heading font-extrabold text-white tracking-tight leading-[1.1] mb-6 drop-shadow-[0_4px_8px_rgba(0,0,0,0.8)]" style="color: #ffffff !important;">
                    {!! $slide->title !!}
                </h1>
                @endif
                
                @if($slide->subtitle)
                <p class="layer-subtext text-lg sm:text-xl text-slate-100 mb-10 max-w-2xl font-light drop-shadow-[0_2px_4px_rgba(0,0,0,0.8)]" style="color: #f8fafc !important;">
                    {{ html_entity_decode($slide->subtitle) }}
                </p>
                @endif
                
                <div class="layer-actions flex flex-wrap items-center justify-center lg:justify-start gap-4">
                    @if($slide->button1_text && $slide->button1_url)
                    <a href="{{ html_entity_decode($slide->button1_url) }}" class="engitech-btn shadow-lg">{{ html_entity_decode($slide->button1_text) }}</a>
                    @endif
                    @if($slide->button2_text && $slide->button2_url)
                    <a href="{{ html_entity_decode($slide->button2_url) }}" class="engitech-btn engitech-btn-transparent shadow-lg bg-black/30 backdrop-blur-sm border-white/50 text-white">{{ html_entity_decode($slide->button2_text) }}</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @endforeach

    <!-- Revolution Slider Controls (Positioned Bottom Left & Center) -->
    <div class="absolute bottom-10 left-0 w-full z-20 hidden md:block">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full flex items-center justify-between">
            <!-- Left: Arrow Prev / Next Buttons -->
            <div class="flex items-center space-x-2">
                <button id="hero-prev-btn" class="w-12 h-12 rounded-sm bg-white/10 hover:bg-primary border border-white/20 text-white flex items-center justify-center transition-colors shadow-lg" aria-label="Previous Slide">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                </button>
                <button id="hero-next-btn" class="w-12 h-12 rounded-sm bg-white/10 hover:bg-primary border border-white/20 text-white flex items-center justify-center transition-colors shadow-lg" aria-label="Next Slide">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </button>
            </div>

            <!-- Center: Pagination Dots -->
            <div class="flex items-center space-x-3 slick-dots">
                @foreach($slides as $index => $slide)
                <button data-hero-dot="{{ $index }}" class="h-3 w-3 rounded-full {{ $index === 0 ? 'bg-white transition-all transform scale-150 shadow-[0_0_10px_rgba(67,186,255,0.8)]' : 'bg-white/30 transition-all hover:bg-white' }}" aria-label="Slide {{ $index + 1 }}"></button>
                @endforeach
            </div>
        </div>
    </div>
</section>
