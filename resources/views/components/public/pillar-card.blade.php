@props([
    'number',
    'icon',
    'title',
    'description',
    'link' => '/pillars',
])

<div class="engitech-icon-box group h-full flex flex-col justify-between">
    <div>
        <div class="flex items-center justify-between mb-6">
            <!-- Icon -->
            <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-[#0c5adb]/20 to-[#43baff]/10 border border-[#0c5adb]/30 flex items-center justify-center text-3xl text-[#43baff] group-hover:scale-110 transition-transform">
                {!! $icon !!}
            </div>

            <!-- Number badge -->
            <div class="font-heading font-black text-2xl text-slate-700 group-hover:text-[#43baff] transition-colors">
                {{ str_pad($number, 2, '0', STR_PAD_LEFT) }}
            </div>
        </div>

        <!-- Title & Description -->
        <h3 class="text-xl font-heading font-bold text-white mb-3 group-hover:text-[#43baff] transition-colors">
            {{ $title }}
        </h3>
        <p class="text-slate-400 leading-relaxed text-sm">
            {{ $description }}
        </p>
    </div>

    <!-- Arrow Link -->
    <div class="mt-6 pt-4 border-t border-slate-800/80 flex items-center justify-between text-xs font-bold font-heading text-slate-400 group-hover:text-[#43baff]">
        <span>LEARN MORE</span>
        <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
        </svg>
    </div>
</div>
