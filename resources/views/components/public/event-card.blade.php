@props([
    'date',
    'month',
    'title',
    'description' => '',
    'link' => '#',
])

<div class="glass-card rounded-2xl p-6 flex flex-col sm:flex-row gap-5 items-start hover:border-teal-500/30 transition-colors">
    <!-- Date badge -->
    <div class="flex-shrink-0 w-16 h-16 rounded-xl bg-teal-500/10 border border-teal-500/20 flex flex-col items-center justify-center">
        <span class="text-xl font-bold text-teal-400 leading-none mb-1">{{ $date }}</span>
        <span class="text-xs uppercase text-slate-400 font-semibold">{{ $month }}</span>
    </div>
    
    <!-- Content -->
    <div class="flex-1">
        <a href="{{ $link }}" class="block group">
            <h3 class="text-lg font-semibold text-white group-hover:text-teal-400 transition-colors leading-tight mb-2">
                {{ $title }}
            </h3>
        </a>
        @if($description)
            <p class="text-slate-400 text-sm leading-relaxed">
                {{ $description }}
            </p>
        @endif
        
        <div class="mt-4">
            <a href="{{ $link }}" class="inline-flex items-center gap-1 text-sm text-teal-400 font-medium hover:text-teal-300 transition-colors">
                View Details
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
            </a>
        </div>
    </div>
</div>
