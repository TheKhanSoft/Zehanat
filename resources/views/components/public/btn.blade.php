@props([
    'variant' => 'primary',
    'size' => 'md',
    'href' => null,
    'type' => 'button',
])

@php
$baseClasses = 'rounded-full font-semibold transition-all duration-300 inline-flex items-center justify-center gap-2';

$variantClasses = match($variant) {
    'primary' => 'bg-teal-500 hover:bg-teal-400 text-white shadow-lg shadow-teal-500/25 hover:shadow-teal-400/40',
    'primary2' => 'bg-slate-700 hover:bg-slate-600 text-white shadow-lg shadow-slate-700/25 hover:shadow-slate-600/40',
    'secondary' => 'bg-amber-500 hover:bg-amber-400 text-slate-900 shadow-lg shadow-amber-500/25',
    'outline' => 'border-2 border-teal-500 text-teal-400 hover:bg-teal-500/10',
    'outline2' => 'bg-transparent border-2 border-slate-200 text-slate-200 hover:border-amber-500 hover:bg-amber-500 hover:text-slate-950',
    'ghost' => 'text-teal-400 hover:bg-teal-500/10',
    default => 'bg-teal-500 hover:bg-teal-400 text-white shadow-lg shadow-teal-500/25 hover:shadow-teal-400/40',
};

$sizeClasses = match($size) {
    'sm' => 'px-5 py-2 text-sm',
    'md' => 'px-7 py-3 text-base',
    'lg' => 'px-9 py-4 text-lg',
    default => 'px-7 py-3 text-base',
};

$classes = $baseClasses . ' ' . $variantClasses . ' ' . $sizeClasses;
@endphp

@if($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </a>
@else
    <button type="{{ $type }}" {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </button>
@endif
