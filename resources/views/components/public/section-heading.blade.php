@props([
    'title',
    'subtitle' => null,
    'align' => 'center',
    'tag' => null,
    'titleClass' => '!text-[#1b1d21]',
    'subtitleClass' => '!text-slate-500',
    'tagClass' => '',
])

<div class="animate-fade-up {{ $align === 'center' ? 'text-center' : 'text-left' }}">
    <!-- Engitech Tag Header -->
    <div class="engitech-tag mb-3 {{ $align === 'center' ? 'justify-center' : '' }} {{ $tagClass }}">
        {!! html_entity_decode($tag ?? ($subtitle ? strtoupper($subtitle) : 'ZEHANAT SOCIETY')) !!}
    </div>

    <!-- Main Section Title -->
    <h2 class="text-3xl sm:text-4xl lg:text-5xl font-heading font-extrabold tracking-tight leading-tight {{ $titleClass }}">
        {!! nl2br(e(html_entity_decode($title))) !!}
    </h2>

    @if($subtitle && !$tag)
        <p class="text-base sm:text-lg mt-4 leading-relaxed {{ $align === 'center' ? 'mx-auto max-w-2xl' : 'max-w-2xl' }} {{ $subtitleClass }}">
            {!! nl2br(e(html_entity_decode($subtitle))) !!}
        </p>
    @endif
</div>
