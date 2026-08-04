@props([
    'tag' => 'LATEST PROJECTS',
    'title' => 'Introduce Our Projects',
    'items' => [],
    'headingClass' => '!text-[#1b1d21]',
    'headingSubtitleClass' => '!text-slate-500',
])

<section class="py-20 lg:py-28 bg-[#f4f6f9]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-12 flex flex-col sm:flex-row sm:items-end justify-between gap-6">
            <x-public.section-heading :tag="$tag" :title="$title" align="left" :titleClass="$headingClass" :subtitleClass="$headingSubtitleClass" />
            
            <!-- Navigation Arrows -->
            <div class="flex items-center gap-3">
                <button class="image-carousel-prev w-12 h-12 rounded-full bg-white border border-slate-200 shadow-sm flex items-center justify-center text-slate-400 hover:text-white hover:bg-primary hover:border-primary transition-all duration-300 focus:outline-none">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
                </button>
                <button class="image-carousel-next w-12 h-12 rounded-full bg-white border border-slate-200 shadow-sm flex items-center justify-center text-slate-400 hover:text-white hover:bg-primary hover:border-primary transition-all duration-300 focus:outline-none">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                </button>
            </div>
        </div>
        
        <!-- Swiper Carousel -->
        <div class="swiper image-card-carousel pb-4">
            <div class="swiper-wrapper">
                @foreach($items as $item)
                    <div class="swiper-slide h-auto">
                        <a href="{{ html_entity_decode($item['link'] ?? '#') }}" class="group block h-full overflow-hidden transition-transform duration-300 rounded-xl shadow-lg border border-slate-100 hover:shadow-2xl">
                            <!-- Image Container -->
                            <div class="relative h-64 overflow-hidden bg-slate-200">
                                <img src="{{ html_entity_decode($item['image'] ?? '') }}" alt="{{ html_entity_decode($item['title'] ?? '') }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                            </div>
                            
                            <!-- Content Box -->
                            <div class="bg-white p-8 flex items-center justify-between transition-colors duration-300 group-hover:bg-primary">
                                <div>
                                    <p class="text-[11px] font-heading font-bold text-primary mb-2 uppercase tracking-wider transition-colors duration-300 group-hover:text-white/90">{{ html_entity_decode($item['category'] ?? '') }}</p>
                                    <h3 class="text-[22px] font-heading font-extrabold text-[#1b1d21] transition-colors duration-300 group-hover:text-white">{{ html_entity_decode($item['title'] ?? '') }}</h3>
                                </div>
                                <div class="w-12 h-12 rounded-full bg-slate-50 flex items-center justify-center text-slate-400 transition-all duration-300 group-hover:bg-white/20 group-hover:text-white group-hover:-rotate-45">
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
            
            <!-- Pagination -->
            <div class="swiper-pagination !relative !mt-12"></div>
        </div>
    </div>
</section>

@push('head')
<style>
    .image-card-carousel .swiper-pagination-bullet {
        width: 8px;
        height: 8px;
        background-color: #d1d5db;
        opacity: 1;
        transition: all 0.3s ease;
    }
    .image-card-carousel .swiper-pagination-bullet-active {
        background-color: var(--color-second, #7141b1);
    }
</style>
@endpush

<script>
    document.addEventListener('DOMContentLoaded', function () {
        if (typeof Swiper !== 'undefined') {
            new Swiper('.image-card-carousel', {
                slidesPerView: 1,
                spaceBetween: 30,
                loop: false,
                navigation: {
                    nextEl: '.image-carousel-next',
                    prevEl: '.image-carousel-prev',
                },
                pagination: {
                    el: '.image-card-carousel .swiper-pagination',
                    clickable: true,
                },
                breakpoints: {
                    640: {
                        slidesPerView: 2,
                    },
                    1024: {
                        slidesPerView: 3,
                    },
                }
            });
        }
    });
</script>
