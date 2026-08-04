@props([
    'bgImage' => '',
    'overlayColor' => null,
    'overlayOpacity' => '90',
    'tag' => 'WHY CHOOSE US',
    'title' => 'Design the Concept of Your Business Idea Now',
    'features' => [],
    'stats' => [],
    'headingClass' => '!text-white',
    'headingSubtitleClass' => '!text-slate-500'
])

<section class="py-20 lg:py-28 relative overflow-hidden" style="{{ $overlayColor ? 'background-color: '.$overlayColor.';' : 'background-color: #171822;' }}">
    @if($bgImage)
        <div class="absolute inset-0 bg-cover bg-center bg-no-repeat pointer-events-none" style="background-image: url('{{ $bgImage }}'); opacity: {{ (100 - (int)$overlayOpacity) / 100 }}; z-index: 0;"></div>
    @endif
    <div class="absolute inset-0 bg-gradient-to-t from-[#1b1d21]/80 to-transparent pointer-events-none z-[1]"></div>
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Section Header -->
        <div class="text-center mb-16 max-w-3xl mx-auto">
            <div class="inline-flex items-center gap-2 text-[10px] font-heading font-extrabold {{ $headingSubtitleClass }} uppercase tracking-widest mb-4">
                <span class="text-primary">//</span> {{ $tag }}
            </div>
            <h2 class="text-3xl sm:text-4xl font-heading font-extrabold {{ $headingClass }} tracking-tight leading-tight">
                {!! nl2br(e($title)) !!}
            </h2>
        </div>

        <!-- 4-Column Features Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 rounded-xl overflow-hidden mt-12 mb-6">
            @foreach($features as $index => $feature)
                <div class="group relative p-8 bg-[#24223d] rounded-xl hover:bg-blue-50/50 hover:shadow-2xl hover:-translate-y-1 transition-all duration-300">
                    <!-- Watermark Number -->
                    <div class="absolute top-2 left-6 text-7xl font-heading font-black text-white/5 group-hover:!text-slate-100 select-none transition-colors duration-300">
                        {{ sprintf('%02d', $index + 1) }}
                    </div>
                    
                    <div class="relative z-10 mt-10">
                        <h3 class="text-xl font-heading font-extrabold !text-white group-hover:!text-[#1b1d21] mb-3 transition-colors duration-300">{{ $feature['title'] }}</h3>
                        <p class="text-[13px] !text-slate-300 group-hover:!text-black group-hover:font-semibold leading-relaxed mb-12 transition-colors duration-300">{{ $feature['description'] }}</p>
                        
                        <div class="flex items-center justify-between">
                            <a href="{{ $feature['link'] ?? '#' }}" class="inline-flex items-center gap-1.5 text-[11px] font-heading font-extrabold !text-primary uppercase tracking-widest group-hover:!text-[#0c5adb] hover:!text-[#43baff] transition-colors">
                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                                Learn More
                            </a>
                        </div>
                    </div>
                    
                    <!-- Bottom Right Icon Shape -->
                    <div class="absolute bottom-0 right-0 w-16 h-16 bg-white/5 group-hover:bg-primary rounded-tl-[40px] rounded-br-xl flex items-end justify-end p-4 !text-white transition-all duration-300">
                        <div class="w-7 h-7">
                            {!! $feature['icon'] !!}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- 2-Column Stats Grid (Images) -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-0 border-x border-b border-slate-800 rounded-b-xl overflow-hidden">
            @foreach($stats as $index => $stat)
                <div class="relative h-64 overflow-hidden group border-b md:border-b-0 border-r-0 md:border-r border-slate-800 last:border-0">
                    <!-- Background Image -->
                    <div class="absolute inset-0 bg-slate-800">
                        <img src="{{ $stat['image'] }}" alt="Stat background" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110 opacity-40 mix-blend-luminosity">
                    </div>
                    
                    <!-- Duotone Overlay -->
                    @if($index === 0)
                        <div class="absolute inset-0 bg-gradient-to-r from-[#171822]/90 to-primary/60 mix-blend-multiply"></div>
                    @else
                        <div class="absolute inset-0 bg-gradient-to-r from-[#171822]/90 to-second/60 mix-blend-multiply"></div>
                    @endif
                    
                    <!-- Content -->
                    <div class="relative z-10 p-10 h-full flex flex-col justify-center">
                        <div class="text-4xl sm:text-5xl font-heading font-black text-white mb-2 tracking-tighter">
                            {{ $stat['number'] }}<span class="text-primary">{{ $stat['suffix'] ?? '' }}</span>
                        </div>
                        <h4 class="text-lg font-heading font-extrabold text-white mb-2">{{ $stat['title'] }}</h4>
                        <p class="text-xs text-slate-300 max-w-xs">{{ $stat['description'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
