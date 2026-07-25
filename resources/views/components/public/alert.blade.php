@props([
    'type' => 'info',
    'dismissible' => false,
])

@php
$baseClasses = 'border rounded-xl p-4 flex items-start gap-3 transition-opacity duration-300';

$typeStyles = match($type) {
    'info' => [
        'class' => 'bg-teal-500/10 border-teal-500/30 text-teal-300',
        'icon' => '<svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>',
    ],
    'success' => [
        'class' => 'bg-emerald-500/10 border-emerald-500/30 text-emerald-300',
        'icon' => '<svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>',
    ],
    'warning' => [
        'class' => 'bg-amber-500/10 border-amber-500/30 text-amber-300',
        'icon' => '<svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>',
    ],
    'danger' => [
        'class' => 'bg-red-500/10 border-red-500/30 text-red-300',
        'icon' => '<svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>',
    ],
    default => [
        'class' => 'bg-teal-500/10 border-teal-500/30 text-teal-300',
        'icon' => '<svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>',
    ],
};

$classes = $baseClasses . ' ' . $typeStyles['class'];
@endphp

<div {{ $attributes->merge(['class' => $classes]) }}>
    {!! $typeStyles['icon'] !!}
    <div class="flex-1">
        {{ $slot }}
    </div>
    @if($dismissible)
        <button type="button" class="flex-shrink-0 hover:opacity-75 transition-opacity" onclick="this.parentElement.style.display='none'">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
        </button>
    @endif
</div>
