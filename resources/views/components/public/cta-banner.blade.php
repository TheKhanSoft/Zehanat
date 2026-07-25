@props([
    'title',
    'subtitle' => null,
])

<section class="relative py-20 overflow-hidden bg-gradient-to-r from-teal-600 via-teal-500 to-emerald-500 rounded-3xl mx-4 sm:mx-6 lg:mx-8 my-20">
    <!-- Pattern overlay -->
    <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(circle at 2px 2px, white 1px, transparent 0); background-size: 24px 24px;"></div>
    
    <div class="relative z-10 max-w-4xl mx-auto px-4 sm:px-6 text-center">
        <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-white tracking-tight">
            {{ $title }}
        </h2>
        
        @if($subtitle)
            <p class="text-lg md:text-xl text-teal-100 mt-4 max-w-2xl mx-auto font-medium">
                {{ $subtitle }}
            </p>
        @endif
        
        @if(isset($slot) && $slot->isNotEmpty())
            <div class="flex flex-wrap items-center justify-center gap-4 mt-8 md:mt-10">
                {{ $slot }}
            </div>
        @endif
    </div>
</section>
