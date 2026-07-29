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
        <div class="flex items-center justify-between mb-4 pb-4 border-b border-slate-800">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-[#0c5adb]/10 border border-[#0c5adb]/30 text-xs font-bold font-heading text-[#43baff]">
                <span>{{ $date }}</span>
                <span>{{ $month }}</span>
            </div>
            <span class="text-[11px] font-bold uppercase tracking-wider text-slate-400">EVENT</span>
        </div>
        
        <!-- Title -->
        <a href="{{ $link }}" class="block group-hover:text-[#43baff] transition-colors">
            <h3 class="text-lg font-heading font-bold text-white leading-snug mb-3">
                {{ $title }}
            </h3>
        </a>
        
        @if($description)
            <p class="text-slate-400 text-sm leading-relaxed mb-4">
                {{ $description }}
            </p>
        @endif
    </div>

    <!-- Arrow Action Link -->
    <div class="pt-4 border-t border-slate-800/80">
        <a href="{{ $link }}" class="inline-flex items-center gap-2 text-xs font-bold font-heading text-[#43baff] hover:text-white transition-colors">
            VIEW DETAILS
            <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
            </svg>
        </a>
    </div>
</div>
