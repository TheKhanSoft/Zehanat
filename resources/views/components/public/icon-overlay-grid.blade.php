@props([
    'tag' => 'CORE PILLARS',
    'title' => 'Our Core Focus Areas',
    'bgImage' => '',
    'items' => [],
    'bgClass' => 'bg-[#1b1d21]',
    'headingClass' => '!text-white',
    'headingSubtitleClass' => '!text-slate-400',
])

<section class="relative py-20 lg:py-28 overflow-hidden {{ $bgClass }}">
    <!-- Background Image -->
    @if($bgImage)
        <div class="absolute inset-0 bg-cover bg-center bg-no-repeat" style="background-image: url('{{ $bgImage }}');"></div>
    @endif
    
    <!-- Gradient Overlay -->
    <div class="absolute inset-0 bg-gradient-to-r from-[#1b1d21]/95 via-[#1b1d21]/80 to-primary/60 mix-blend-multiply"></div>
    <div class="absolute inset-0 bg-gradient-to-t from-[#1b1d21]/80 to-transparent"></div>

    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Section Header -->
        <div class="text-center mb-16 max-w-3xl mx-auto">
            <x-public.section-heading :tag="$tag" :title="$title" align="center" :titleClass="$headingClass" :subtitleClass="$headingSubtitleClass" tagClass="!text-white" />
        </div>

        <!-- Icon Grid -->
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-px bg-white/20 border border-white/20 overflow-hidden backdrop-blur-sm">
            @foreach($items as $item)
                <a href="{{ $item['link'] ?? '#' }}" class="group relative flex flex-col items-center justify-center py-10 px-4 bg-transparent transition-all duration-300 hover:bg-primary hover:shadow-2xl z-0 hover:z-10">
                    <div class="text-white group-hover:text-white transition-colors duration-300 mb-4 transform group-hover:-translate-y-1">
                        {!! $item['icon'] !!}
                    </div>
                    <h3 class="text-sm font-heading font-extrabold text-white group-hover:text-white tracking-wider uppercase transition-colors duration-300 text-center">
                        {{ $item['label'] }}
                    </h3>
                </a>
            @endforeach
        </div>
    </div>
</section>
