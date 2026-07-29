@props([
    'date',
    'month',
    'title',
    'description' => '',
    'link' => '#',
])

<div class="engitech-icon-box flex flex-col justify-between h-full group">
    <div>
        <!-- Date & Tag row -->
        <div class="flex items-center justify-between mb-4 pb-4 border-b border-slate-100">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-blue-50/50 border border-blue-100 text-[11px] font-bold font-heading text-primary">
                <span class="text-lg leading-none">{{ $date }}</span>
                <span class="uppercase">{{ $month }}</span>
            </div>
            <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400 bg-slate-50 px-2 py-1 rounded">EVENT</span>
        </div>
        
        <!-- Title -->
        <a href="{{ $link }}" class="block group-hover:text-primary transition-colors">
            <h3 class="text-xl font-heading font-extrabold text-[#1b1d21] leading-tight mb-3">
                {{ $title }}
            </h3>
        </a>
        
        @if($description)
            <p class="text-slate-500 text-sm leading-relaxed mb-4">
                {{ $description }}
            </p>
        @endif
    </div>

    <!-- Arrow Action Link -->
    <div class="pt-5 mt-auto border-t border-slate-100">
        <a href="{{ $link }}" class="inline-flex items-center gap-2 text-xs font-bold font-heading text-[#1b1d21] hover:text-primary transition-colors uppercase tracking-wider">
            View Details
            <svg class="w-4 h-4 text-primary transform group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
            </svg>
        </a>
    </div>
</div>
