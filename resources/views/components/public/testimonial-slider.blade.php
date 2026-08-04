@props([
    'bgImage' => '',
    'overlayColor' => null,
    'overlayOpacity' => '90',
    'tag' => 'TESTIMONIALS',
    'title' => 'What Educators Are Saying',
    'items' => [],
    'bgClass' => 'bg-white',
    'titleClass' => '!text-[#1b1d21]',
    'roleClass' => '!text-slate-400',
    'quoteClass' => '!text-slate-500',
    'cardBgClass' => 'bg-white',
    'headingClass' => '!text-[#1b1d21]',
    'headingSubtitleClass' => '!text-slate-500',
])

<section class="relative py-20 lg:py-28 overflow-hidden" style="{{ $overlayColor ? 'background-color: '.$overlayColor.';' : '' }}">
    @if($bgImage)
        <div class="absolute inset-0 bg-cover bg-center bg-no-repeat pointer-events-none" style="background-image: url('{{ $bgImage }}'); opacity: {{ (100 - (int)$overlayOpacity) / 100 }}; z-index: 0;"></div>
    @endif
    <!-- World Map Background Pattern -->
    <div class="absolute inset-0 opacity-[0.03]" style="background-image: radial-gradient(circle at center, #1b1d21 2px, transparent 2px); background-size: 32px 32px;"></div>
    
    <!-- Floating Glowing Nodes (Decorative) -->
    <div class="absolute top-20 left-1/4 w-4 h-4 bg-primary rounded-full filter blur-[2px] opacity-40 animate-pulse"></div>
    <div class="absolute top-1/3 right-1/4 w-3 h-3 bg-primary rounded-full filter blur-[1px] opacity-60 animate-pulse delay-75"></div>
    <div class="absolute bottom-1/4 left-1/3 w-6 h-6 bg-primary rounded-full filter blur-[3px] opacity-30 animate-pulse delay-150"></div>
    <div class="absolute bottom-20 right-1/3 w-2 h-2 bg-primary rounded-full opacity-80 animate-pulse delay-300"></div>

    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Section Header -->
        <div class="text-center mb-16 max-w-3xl mx-auto">
            <x-public.section-heading :tag="$tag" :title="$title" align="center" :titleClass="$headingClass" :subtitleClass="$headingSubtitleClass" />
        </div>

        <!-- Testimonials Swiper -->
        <div class="swiper testimonial-slider px-4 pb-12 -mx-4">
            <div class="swiper-wrapper">
                @foreach($items as $item)
                    <div class="swiper-slide h-auto">
                        <div class="{{ $cardBgClass }} rounded-xl shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-slate-100 p-8 h-full flex flex-col transition-shadow duration-300 hover:shadow-[0_8px_30px_rgb(0,0,0,0.08)] relative overflow-hidden">
                            
                            <!-- Header: Avatar & Info -->
                            <div class="flex items-center gap-4 mb-6 relative z-10">
                                <div class="w-16 h-16 rounded-full bg-[#f4f6f9] flex items-center justify-center shrink-0 border border-slate-100 overflow-hidden text-primary">
                                    @if(isset($item['image']) && $item['image'])
                                        <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}" class="w-full h-full object-cover">
                                    @elseif(isset($item['icon']) && $item['icon'])
                                        {!! $item['icon'] !!}
                                    @else
                                        <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                    @endif
                                </div>
                                <div>
                                    <h4 class="text-lg font-heading font-extrabold {{ $titleClass }} leading-tight">{{ $item['name'] }}</h4>
                                    <span class="text-xs {{ $roleClass }} font-medium">{{ $item['role'] }}</span>
                                </div>
                            </div>
                            
                            <!-- Quote Body -->
                            <div class="flex-grow relative z-10">
                                <p class="text-sm {{ $quoteClass }} leading-relaxed">
                                    "{{ $item['quote'] }}"
                                </p>
                            </div>
                            
                            <!-- Decorative Quote Mark -->
                            <div class="absolute -bottom-4 -right-2 text-[120px] leading-none text-slate-100/50 font-serif font-black select-none z-0 pointer-events-none">
                                "
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            
            <!-- Navigation Arrows (Custom outside swiper container) -->
            <div class="flex justify-center gap-4 mt-8">
                <button class="testi-prev w-10 h-10 rounded-full border border-slate-200 flex items-center justify-center text-slate-400 hover:text-primary hover:border-primary hover:bg-primary/5 transition-all outline-none">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                </button>
                <button class="testi-next w-10 h-10 rounded-full border border-slate-200 flex items-center justify-center text-slate-400 hover:text-primary hover:border-primary hover:bg-primary/5 transition-all outline-none">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </button>
            </div>
        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        if (typeof Swiper !== 'undefined') {
            new Swiper('.testimonial-slider', {
                slidesPerView: 1,
                spaceBetween: 30,
                loop: true,
                autoHeight: false,
                navigation: {
                    nextEl: '.testi-next',
                    prevEl: '.testi-prev',
                },
                breakpoints: {
                    768: {
                        slidesPerView: 2,
                    },
                }
            });
        }
    });
</script>
