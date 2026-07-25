@props([
    'icon' => null,
    'title' => null,
])

<div {{ $attributes->merge(['class' => 'glass-card rounded-2xl p-6 md:p-8']) }}>
    @if($icon)
        <div class="w-12 h-12 rounded-xl bg-teal-500/10 flex items-center justify-center mb-4 text-teal-400 text-2xl">
            {!! $icon !!}
        </div>
    @endif
    @if($title)
        <h3 class="text-xl font-semibold text-white mb-3">{{ $title }}</h3>
    @endif
    <div class="text-slate-300">
        {{ $slot }}
    </div>
</div>
