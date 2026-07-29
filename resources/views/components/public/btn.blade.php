@props([
    'variant' => 'primary',
    'size' => 'md',
    'href' => null,
    'type' => 'button',
])

@php
$baseClasses = 'font-heading font-extrabold uppercase tracking-wider transition-all duration-300 inline-flex items-center justify-center gap-2.5 rounded-xl text-xs';

$variantClasses = match($variant) {
    'primary' => 'bg-gradient-to-r from-[#0c5adb] to-[#43baff] text-white shadow-lg shadow-blue-600/30 hover:scale-[1.02] hover:shadow-blue-600/50',
    'primary2' => 'bg-[#141a29] border border-slate-700/80 text-white hover:border-[#43baff] hover:text-[#43baff] shadow-lg',
    'secondary' => 'bg-[#ff4b2b] hover:bg-[#ff6045] text-white shadow-lg shadow-red-600/30 hover:scale-[1.02]',
    'outline' => 'border-2 border-[#0c5adb] text-[#43baff] hover:bg-[#0c5adb] hover:text-white hover:border-[#0c5adb]',
    'outline2' => 'border-2 border-slate-700 text-slate-300 hover:border-[#43baff] hover:text-[#43baff] hover:bg-[#141a29]',
    'ghost' => 'text-[#43baff] hover:bg-blue-600/10 hover:text-white',
    default => 'bg-gradient-to-r from-[#0c5adb] to-[#43baff] text-white shadow-lg shadow-blue-600/30 hover:scale-[1.02]',
};

$sizeClasses = match($size) {
    'sm' => 'px-4 py-2 text-[11px]',
    'md' => 'px-6 py-3 text-xs',
    'lg' => 'px-8 py-4 text-sm',
    default => 'px-6 py-3 text-xs',
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
