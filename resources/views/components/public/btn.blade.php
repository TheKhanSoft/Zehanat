@props([
    'variant' => 'primary',
    'size' => 'md',
    'href' => null,
    'type' => 'button',
])

@php
$baseClasses = 'font-heading font-extrabold uppercase tracking-wider transition-all duration-300 inline-flex items-center justify-center gap-2.5 rounded-xl text-xs';

$variantClasses = match($variant) {
    'primary' => 'bg-[#0c5adb] hover:bg-[#43baff] text-white shadow-lg shadow-blue-600/20 hover:scale-[1.02]',
    'primary2' => 'bg-[#182433] hover:bg-[#0c5adb] text-white shadow-md',
    'secondary' => 'bg-[#ff4b2b] hover:bg-[#ff6045] text-white shadow-lg shadow-red-600/20 hover:scale-[1.02]',
    'outline' => 'border-2 border-[#0c5adb] text-[#0c5adb] hover:bg-[#0c5adb] hover:text-white',
    'outline2' => 'border-2 border-slate-300 text-[#182433] hover:border-[#0c5adb] hover:text-[#0c5adb] hover:bg-slate-50',
    'ghost' => 'text-[#0c5adb] hover:bg-blue-50',
    default => 'bg-[#0c5adb] hover:bg-[#43baff] text-white shadow-lg shadow-blue-600/20 hover:scale-[1.02]',
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
