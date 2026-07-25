@props([
    'title',
    'subtitle' => null,
    'align' => 'center',
])

<div class="animate-fade-up {{ $align === 'center' ? 'text-center' : 'text-left' }}">
    <div class="w-12 h-1 bg-teal-500 rounded-full mb-6 {{ $align === 'center' ? 'mx-auto' : '' }}"></div>
    <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-white">
        {{ $title }}
    </h2>
    @if($subtitle)
        <p class="text-lg md:text-xl text-slate-400 mt-4 {{ $align === 'center' ? 'mx-auto max-w-2xl' : 'max-w-2xl' }}">
            {{ $subtitle }}
        </p>
    @endif
</div>
