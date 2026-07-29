@props([
    'number',
    'label',
    'suffix' => '',
])

<div class="text-center p-6 rounded-2xl bg-white border border-slate-100 shadow-md hover:shadow-xl transition-shadow relative overflow-hidden group">
    <div class="text-4xl md:text-5xl font-heading font-black text-[#182433] mb-2 flex items-center justify-center tracking-tight">
        <span class="counter counter-number text-gradient" data-target="{{ $number }}">0</span>
        <span class="text-[#0c5adb]">{{ $suffix }}</span>
    </div>
    <div class="text-[#5e6278] text-xs font-heading font-bold uppercase tracking-wider">
        {{ $label }}
    </div>
</div>
