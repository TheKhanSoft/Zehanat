@props([
    'bgImage' => '',
    'overlayColor' => null,
    'overlayOpacity' => '90',
    'title',
    'subtitle' => null,
    'bgClass' => 'bg-[#1b1d21]',
    'titleClass' => '!text-white',
    'subtitleClass' => '!text-slate-400',
    'badgeText' => 'JOIN KHYBER PAKHTUNKHWA AI MOVEMENT',
])

<section class="relative py-20 overflow-hidden rounded-3xl mx-4 sm:mx-6 lg:mx-8 my-16 shadow-2xl" style="{{ $overlayColor ? 'background-color: '.$overlayColor.';' : 'background-color: #1b1d21;' }}">
    @if($bgImage)
        <div class="absolute inset-0 bg-cover bg-center bg-no-repeat pointer-events-none" style="background-image: url('{{ $bgImage }}'); opacity: {{ (100 - (int)$overlayOpacity) / 100 }}; z-index: 0;"></div>
    @endif
    <!-- Grid Pattern Background -->
    <div class="absolute inset-0 opacity-[0.03] z-[1]" style="background-image: linear-gradient(#ffffff 1px, transparent 1px), linear-gradient(90deg, #ffffff 1px, transparent 1px); background-size: 30px 30px;"></div>
    
    <!-- Accent Gradient Orbs -->
    <div class="absolute -top-40 -right-40 w-96 h-96 bg-primary rounded-full mix-blend-multiply filter blur-3xl opacity-20 z-[1]"></div>
    <div class="absolute -bottom-40 -left-40 w-96 h-96 bg-primary rounded-full mix-blend-multiply filter blur-3xl opacity-20 z-[1]"></div>
    
    <div class="relative z-10 max-w-4xl mx-auto px-6 text-center">
        @if($badgeText)
        <div class="inline-flex items-center gap-2 bg-slate-800/80 backdrop-blur-md px-4 py-1.5 rounded-full text-[11px] font-heading font-bold text-primary uppercase tracking-[0.15em] mb-6 border border-slate-700/50 shadow-sm">
            // {{ $badgeText }}
        </div>
        @endif

        <h2 class="text-3xl sm:text-4xl lg:text-5xl font-heading font-extrabold {{ $titleClass }} tracking-tight leading-tight">
            {{ $title }}
        </h2>
        
        @if($subtitle)
            <p class="text-base sm:text-lg {{ $subtitleClass }} mt-5 max-w-2xl mx-auto font-medium leading-relaxed">
                {{ $subtitle }}
            </p>
        @endif
        
        @if(isset($slot) && $slot->isNotEmpty())
            <div class="flex flex-wrap items-center justify-center gap-4 mt-10">
                {{ $slot }}
            </div>
        @endif
    </div>
</section>
