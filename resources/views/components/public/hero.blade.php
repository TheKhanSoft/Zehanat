@props([
    'title' => 'Zehanat',
    'subtitle' => 'The Khyber Pakhtunkhwa Society for AI in Education',
    'tagline' => 'Bringing Artificial Intelligence to Every Classroom in Khyber Pakhtunkhwa.',
    'showParticles' => true,
])

<section class="relative min-h-[85vh] lg:min-h-screen flex items-center justify-center overflow-hidden bg-[#0b0f19] pt-24 pb-16">
    <!-- Neural network canvas -->
    @if($showParticles)
    <canvas id="neural-canvas" class="absolute inset-0 z-0 opacity-20"></canvas>
    @endif
    
    <!-- Engitech Decorative Background Gradients -->
    <div class="absolute top-1/4 -left-32 w-96 h-96 bg-[#0c5adb]/20 rounded-full blur-[120px] animate-float pointer-events-none"></div>
    <div class="absolute bottom-1/4 -right-32 w-96 h-96 bg-[#43baff]/15 rounded-full blur-[120px] animate-float pointer-events-none" style="animation-delay: 2s;"></div>
    
    <!-- Container -->
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
            
            <!-- Left Column: Hero Text & Actions -->
            <div class="lg:col-span-7 text-left space-y-6">
                <!-- Tagline Badge -->
                <div class="inline-flex items-center gap-2 bg-[#141a29] border border-slate-700/60 rounded-full px-4 py-1.5 text-xs text-slate-300 shadow-md">
                    <span class="w-2 h-2 bg-[#43baff] rounded-full animate-ping"></span>
                    <span class="font-heading font-extrabold uppercase text-[#43baff] tracking-wider text-[11px]">KP AI Society</span>
                    <span class="text-slate-600">|</span>
                    <span>AWKUM Leadership</span>
                </div>
                
                <!-- Main Title -->
                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-heading font-extrabold text-white tracking-tight leading-[1.15]">
                    {!! str_replace('Artificial Intelligence', '<span class="text-gradient">Artificial Intelligence</span>', $title) !!}
                </h1>
                
                <!-- Urdu Script Sub-Badge -->
                <div class="flex items-center gap-3">
                    <span class="text-2xl text-[#43baff] font-light" dir="rtl">ذہانت</span>
                    <span class="text-slate-400 text-sm font-medium">{{ $subtitle }}</span>
                </div>
                
                <!-- Description -->
                <p class="text-base sm:text-lg text-slate-300 max-w-2xl leading-relaxed">
                    {{ $tagline }}
                </p>
                
                <!-- CTA Buttons -->
                <div class="pt-4 flex flex-wrap items-center gap-4">
                    {{ $slot }}
                </div>
            </div>

            <!-- Right Column: Engitech Tech Mockup Card & Badges -->
            <div class="lg:col-span-5 relative">
                <div class="glass-card rounded-3xl p-8 border border-slate-700/50 bg-[#141a29]/80 shadow-2xl relative z-10 overflow-hidden">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-[#0c5adb]/20 rounded-full blur-2xl"></div>
                    
                    <div class="space-y-6 relative z-10">
                        <div class="flex items-center justify-between border-b border-slate-800 pb-4">
                            <span class="font-heading font-extrabold text-xs text-[#43baff] uppercase tracking-wider">// Quick Impact</span>
                            <span class="text-xs text-slate-400 font-semibold">2026 Roadmap</span>
                        </div>

                        <!-- Stat Row 1 -->
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-xl bg-blue-600/10 border border-blue-500/20 flex items-center justify-center text-blue-400 text-xl font-bold">
                                🏫
                            </div>
                            <div>
                                <h4 class="font-heading font-bold text-white text-base">50+ Institutions</h4>
                                <p class="text-slate-400 text-xs">Schools, Colleges & Universities</p>
                            </div>
                        </div>

                        <!-- Stat Row 2 -->
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-xl bg-cyan-600/10 border border-cyan-500/20 flex items-center justify-center text-cyan-400 text-xl font-bold">
                                🧑‍🎓
                            </div>
                            <div>
                                <h4 class="font-heading font-bold text-white text-base">500+ Active Members</h4>
                                <p class="text-slate-400 text-xs">Educators, Researchers & Students</p>
                            </div>
                        </div>

                        <!-- Stat Row 3 -->
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-xl bg-red-600/10 border border-red-500/20 flex items-center justify-center text-red-400 text-xl font-bold">
                                ⚡
                            </div>
                            <div>
                                <h4 class="font-heading font-bold text-white text-base">6 Core AI Pillars</h4>
                                <p class="text-slate-400 text-xs">From AI Literacy to Ethics & Research</p>
                            </div>
                        </div>

                        <!-- Quote Badge -->
                        <div class="pt-4 border-t border-slate-800/80">
                            <p class="text-slate-300 text-xs italic leading-relaxed">
                                "Closing the AI knowledge gap in classrooms across Khyber Pakhtunkhwa."
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Floating Decor Badge -->
                <div class="absolute -bottom-6 -left-6 bg-gradient-to-br from-[#0c5adb] to-[#43baff] text-white p-4 rounded-2xl shadow-xl z-20 hidden sm:block animate-float">
                    <div class="flex items-center gap-3">
                        <span class="text-2xl font-black font-heading">#1</span>
                        <div class="text-[11px] leading-tight font-bold uppercase tracking-wider">
                            AI Society in KP<br><span class="opacity-80 font-normal">Established at AWKUM</span>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
