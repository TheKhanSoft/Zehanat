@props([
    'title',
    'breadcrumbs' => [],
])

<section class="relative pt-32 pb-20 bg-gradient-to-r from-slate-900 via-slate-800 to-slate-900 overflow-hidden">
    <!-- Decorative orb -->
    <div class="absolute top-0 right-0 w-96 h-96 bg-teal-500/10 rounded-full blur-3xl -translate-y-1/2 translate-x-1/2 pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        @if(count($breadcrumbs) > 0)
            <nav class="flex items-center gap-2 text-sm text-slate-400 mb-4" aria-label="Breadcrumb">
                @foreach($breadcrumbs as $index => $crumb)
                    @if($index > 0)
                        <svg class="w-4 h-4 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    @endif
                    
                    @if(isset($crumb['url']) && $index < count($breadcrumbs) - 1)
                        <a href="{{ $crumb['url'] }}" class="hover:text-teal-400 transition-colors">{{ $crumb['label'] }}</a>
                    @else
                        <span class="text-teal-400">{{ $crumb['label'] }}</span>
                    @endif
                @endforeach
            </nav>
        @endif

        <h1 class="text-4xl md:text-5xl font-bold text-white tracking-tight">
            {{ $title }}
        </h1>

        @if(isset($slot) && $slot->isNotEmpty())
            <div class="text-lg text-slate-300 mt-4 max-w-3xl">
                {{ $slot }}
            </div>
        @endif
    </div>

    <!-- Bottom border line -->
    <div class="absolute bottom-0 left-0 right-0 h-px bg-gradient-to-r from-transparent via-teal-500/50 to-transparent"></div>
</section>
