@props([
    'title' => 'Zehanat',
    'subtitle' => 'The Khyber Pakhtunkhwa Society for AI in Education',
    'tagline' => 'Bringing Artificial Intelligence to Every Classroom in Khyber Pakhtunkhwa',
    'showParticles' => true,
])

<section class="relative min-h-screen flex items-center justify-center overflow-hidden bg-gradient-to-br from-slate-950 via-slate-900 to-teal-950">
    <!-- Neural network canvas (if showParticles) -->
    @if($showParticles)
    <canvas id="neural-canvas" class="absolute inset-0 z-0"></canvas>
    @endif
    
    <!-- Gradient overlay orbs (decorative) -->
    <div class="absolute top-1/4 -left-32 w-96 h-96 bg-teal-500/10 rounded-full blur-3xl animate-float"></div>
    <div class="absolute bottom-1/4 -right-32 w-96 h-96 bg-amber-500/10 rounded-full blur-3xl animate-float" style="animation-delay: 1.5s;"></div>
    
    <!-- Content -->
    <div class="relative z-10 text-center max-w-5xl mx-auto px-4 sm:px-6">
        <!-- Hosted by badge -->
        <div class="inline-flex items-center gap-2 bg-white/5 backdrop-blur-sm border border-white/10 rounded-full px-5 py-2 mb-8 text-sm text-slate-300">
            <span class="w-2 h-2 bg-teal-400 rounded-full animate-pulse"></span>
            Abdul Wali Khan University Mardan
        </div>
        
        <!-- Main title -->
        <h1 class="text-5xl sm:text-6xl md:text-7xl lg:text-8xl font-black text-white mb-4 tracking-tight">
            {{ $title }}
        </h1>
        
        <!-- Urdu script -->
        <p class="text-2xl md:text-3xl text-teal-400/80 font-light mb-4" dir="rtl">ذہانت</p>
        
        <!-- Subtitle -->
        <p class="text-xl md:text-2xl text-teal-400 font-medium mb-6">{{ $subtitle }}</p>
        
        <!-- Tagline -->
        <p class="text-lg md:text-xl text-slate-300 max-w-3xl mx-auto mb-10">{{ $tagline }}</p>
        
        <!-- CTA Buttons (slot) -->
        <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
            {{ $slot }}
        </div>
    </div>
    
    <!-- Scroll indicator -->
    <div class="absolute bottom-8 left-1/2 -translate-x-1/2 animate-bounce">
        <svg class="w-6 h-6 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/></svg>
    </div>
</section>
