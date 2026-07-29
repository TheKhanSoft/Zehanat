@props([
    'number',
    'label',
    'suffix' => '',
])

<div class="text-center p-6 rounded-2xl bg-[#141a29] border border-slate-800/80 shadow-xl relative overflow-hidden group hover:border-[#43baff]/40 transition-colors">
    <div class="text-4xl md:text-5xl font-heading font-black text-white mb-2 flex items-center justify-center tracking-tight">
        <span class="counter counter-number text-gradient" data-target="{{ $number }}">0</span>
        <span class="text-[#43baff]">{{ $suffix }}</span>
    </div>
    <div class="text-slate-400 text-xs font-heading font-bold uppercase tracking-wider">
        {{ $label }}
    </div>
</div>
