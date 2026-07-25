@props([
    'number',
    'label',
    'suffix' => '',
])

<div class="text-center p-6 rounded-2xl bg-slate-800/20 border border-slate-700/30">
    <div class="text-4xl md:text-5xl font-bold text-white mb-2 flex items-center justify-center">
        <span class="counter counter-number" data-target="{{ $number }}">0</span>
        <span class="text-teal-400">{{ $suffix }}</span>
    </div>
    <div class="text-slate-400 text-sm uppercase tracking-wider font-semibold">
        {{ $label }}
    </div>
</div>
