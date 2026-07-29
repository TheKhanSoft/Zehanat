@props([
    'title',
    'subtitle' => null,
    'align' => 'center',
    'tag' => null,
])

<div class="animate-fade-up {{ $align === 'center' ? 'text-center' : 'text-left' }}">
    <!-- Engitech Tag Header -->
    <div class="engitech-tag mb-3 {{ $align === 'center' ? 'justify-center' : '' }}">
        {{ $tag ?? ($subtitle ? strtoupper($subtitle) : 'ZEHANAT SOCIETY') }}
    </div>

    <!-- Main Section Title -->
    <h2 class="text-3xl sm:text-4xl lg:text-5xl font-heading font-extrabold text-[#182433] tracking-tight leading-tight">
        {{ $title }}
    </h2>

    @if($subtitle && !$tag)
        <p class="text-base sm:text-lg text-[#5e6278] mt-4 leading-relaxed {{ $align === 'center' ? 'mx-auto max-w-2xl' : 'max-w-2xl' }}">
            {{ $subtitle }}
        </p>
    @endif
</div>
