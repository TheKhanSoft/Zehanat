@props([
    'bgImage' => '',
    'overlayColor' => '#ffffff',
    'overlayOpacity' => '0',
    'sectionClass' => 'py-20 lg:py-28',
    'id' => null
])

@php
    $opacityValue = $bgImage ? ((100 - (int)$overlayOpacity) / 100) : 1;
@endphp

<section {{ $id ? 'id='.$id : '' }} class="relative overflow-hidden {{ $sectionClass }}" style="background-color: {{ $overlayColor }};">
    @if($bgImage)
        <div class="absolute inset-0 bg-cover bg-center bg-no-repeat" style="background-image: url('{{ $bgImage }}'); opacity: {{ $opacityValue }}; pointer-events: none;"></div>
    @endif
    
    <div class="relative z-10">
        {{ $slot }}
    </div>
</section>
