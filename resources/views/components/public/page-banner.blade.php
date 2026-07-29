@props([
    'title',
    'breadcrumbs' => [],
])

<section class="relative pt-24 pb-16 bg-[#141a29] border-b border-slate-800 overflow-hidden">
    <!-- Engitech Decorative Glow Overlay -->
    <div class="absolute top-0 right-0 w-96 h-96 bg-[#0c5adb]/15 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute bottom-0 left-0 w-96 h-96 bg-[#43baff]/10 rounded-full blur-3xl pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        @if(count($breadcrumbs) > 0)
            <nav class="flex items-center gap-2 text-xs font-heading font-extrabold uppercase tracking-wider text-slate-400 mb-4" aria-label="Breadcrumb">
                @foreach($breadcrumbs as $index => $crumb)
                    @if($index > 0)
                        <span class="text-[#43baff]">&rsaquo;</span>
                    @endif
                    
                    @if(isset($crumb['url']) && $index < count($breadcrumbs) - 1)
                        <a href="{{ $crumb['url'] }}" class="hover:text-[#43baff] transition-colors">{{ $crumb['label'] }}</a>
                    @else
                        <span class="text-[#43baff]">{{ $crumb['label'] }}</span>
                    @endif
                @endforeach
            </nav>
        @endif

        <h1 class="text-3xl sm:text-4xl lg:text-5xl font-heading font-extrabold text-white tracking-tight leading-tight">
            {{ $title }}
        </h1>

        @if(isset($slot) && $slot->isNotEmpty())
            <div class="text-base text-slate-300 mt-3 max-w-3xl leading-relaxed">
                {{ $slot }}
            </div>
        @endif
    </div>
</section>
