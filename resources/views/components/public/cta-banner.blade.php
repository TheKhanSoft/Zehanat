@props([
    'title',
    'subtitle' => null,
])

<section class="relative py-20 overflow-hidden bg-gradient-to-r from-[#0c5adb] via-blue-700 to-[#43baff] rounded-3xl mx-4 sm:mx-6 lg:mx-8 my-16 shadow-2xl shadow-blue-600/30">
    <div class="absolute inset-0 opacity-15" style="background-image: radial-gradient(circle at 2px 2px, white 1px, transparent 0); background-size: 28px 28px;"></div>
    
    <div class="relative z-10 max-w-4xl mx-auto px-6 text-center">
        <div class="inline-flex items-center gap-2 bg-white/10 backdrop-blur-md px-4 py-1.5 rounded-full text-xs font-heading font-extrabold text-white uppercase tracking-wider mb-4 border border-white/20">
            // JOIN KHYBER PAKHTUNKHWA AI MOVEMENT
        </div>

        <h2 class="text-3xl sm:text-4xl lg:text-5xl font-heading font-extrabold text-white tracking-tight leading-tight">
            {{ $title }}
        </h2>
        
        @if($subtitle)
            <p class="text-base sm:text-lg text-blue-100 mt-4 max-w-2xl mx-auto font-medium leading-relaxed">
                {{ $subtitle }}
            </p>
        @endif
        
        @if(isset($slot) && $slot->isNotEmpty())
            <div class="flex flex-wrap items-center justify-center gap-4 mt-8">
                {{ $slot }}
            </div>
        @endif
    </div>
</section>
