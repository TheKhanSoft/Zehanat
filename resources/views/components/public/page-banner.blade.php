@props([
    'title',
    'breadcrumbs' => [],
])

<section class="relative pt-24 pb-16 bg-[#f4f6f9] border-b border-slate-200 overflow-hidden">
    <div class="absolute top-0 right-0 w-96 h-96 bg-[#0c5adb]/10 rounded-full blur-3xl pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        @if(count($breadcrumbs) > 0)
            <nav class="flex items-center gap-2 text-xs font-heading font-extrabold uppercase tracking-wider text-slate-400 mb-4" aria-label="Breadcrumb">
                @foreach($breadcrumbs as $index => $crumb)
                    @if($index > 0)
                        <span class="text-[#0c5adb]">&rsaquo;</span>
                    @endif
                    
                    @if(isset($crumb['url']) && $index < count($breadcrumbs) - 1)
                        <a href="{{ $crumb['url'] }}" class="hover:text-[#0c5adb] transition-colors">{{ $crumb['label'] }}</a>
                    @else
                        <span class="text-[#0c5adb]">{{ $crumb['label'] }}</span>
                    @endif
                @endforeach
            </nav>
        @endif

        <h1 class="text-3xl sm:text-4xl lg:text-5xl font-heading font-extrabold text-[#182433] tracking-tight leading-tight">
            {{ html_entity_decode($title) }}
        </h1>

        @if(isset($slot) && $slot->isNotEmpty())
            <div class="text-base text-[#5e6278] mt-3 max-w-3xl leading-relaxed">
                {{ $slot }}
            </div>
        @endif
    </div>
</section>
