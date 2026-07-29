@props([
    'title' => 'Zehanat',
    'subtitle' => 'The Khyber Pakhtunkhwa Society for AI in Education',
    'tagline' => 'Bringing Artificial Intelligence to Every Classroom in Khyber Pakhtunkhwa.',
    'showParticles' => true,
])

<section class="relative min-h-[85vh] lg:min-h-[90vh] flex items-center justify-center overflow-hidden bg-[#f4f6f9] pt-20 pb-16">
    <!-- Neural network canvas -->
    @if($showParticles)
    <canvas id="neural-canvas" class="absolute inset-0 z-0 opacity-15"></canvas>
    @endif
    
    <!-- Engitech Background Decorative Shapes -->
    <div class="absolute top-1/4 -left-32 w-96 h-96 bg-[#0c5adb]/10 rounded-full blur-[100px] pointer-events-none"></div>
    <div class="absolute bottom-1/4 -right-32 w-96 h-96 bg-[#43baff]/15 rounded-full blur-[100px] pointer-events-none"></div>
    
    <!-- Container -->
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
            
            <!-- Left Column: Hero Text & Actions -->
            <div class="lg:col-span-7 text-left space-y-6">
                <!-- Tagline Badge -->
                <div class="inline-flex items-center gap-2 bg-white border border-slate-200 rounded-full px-4 py-1.5 text-xs text-[#5e6278] shadow-sm">
                    <span class="w-2 h-2 bg-[#0c5adb] rounded-full animate-ping"></span>
                    <span class="font-heading font-extrabold uppercase text-[#0c5adb] tracking-wider text-[11px]">KP AI Society</span>
                    <span class="text-slate-300">|</span>
                    <span>AWKUM Leadership</span>
                </div>
                
                <!-- Main Title -->
                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-heading font-extrabold text-[#182433] tracking-tight leading-[1.15]">
                    {!! str_replace('Artificial Intelligence', '<span class="text-gradient">Artificial Intelligence</span>', $title) !!}
                </h1>
                
                <!-- Urdu Script Sub-Badge -->
                <div class="flex items-center gap-3">
                    <span class="text-2xl text-[#0c5adb] font-normal" dir="rtl">ذہانت</span>
                    <span class="text-[#5e6278] text-sm font-medium">{{ $subtitle }}</span>
                </div>
                
                <!-- Description -->
                <p class="text-base sm:text-lg text-[#5e6278] max-w-2xl leading-relaxed">
                    {{ $tagline }}
                </p>
                
                <!-- CTA Buttons -->
                <div class="pt-4 flex flex-wrap items-center gap-4">
                    {{ $slot }}
                </div>
            </div>

            <!-- Right Column: Engitech Impact Card Box -->
            <div class="lg:col-span-5 relative">
                <div class="bg-white rounded-3xl p-8 border border-slate-100 shadow-2xl relative z-10">
                    <div class="space-y-6">
                        <div class="flex items-center justify-between border-b border-slate-100 pb-4">
                            <span class="font-heading font-extrabold text-xs text-[#0c5adb] uppercase tracking-wider">// Quick Impact</span>
                            <span class="text-xs text-slate-400 font-semibold">2026 Roadmap</span>
                        </div>

                        <!-- Stat Row 1 -->
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-2xl bg-blue-50 border border-blue-100 flex items-center justify-center text-blue-600 text-xl font-bold">
                                🏫
                            </div>
                            <div>
                                <h4 class="font-heading font-bold text-[#182433] text-base">50+ Institutions</h4>
                                <p class="text-slate-400 text-xs">Schools, Colleges & Universities</p>
                            </div>
                        </div>

                        <!-- Stat Row 2 -->
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-2xl bg-cyan-50 border border-cyan-100 flex items-center justify-center text-cyan-600 text-xl font-bold">
                                🧑‍🎓
                            </div>
                            <div>
                                <h4 class="font-heading font-bold text-[#182433] text-base">500+ Active Members</h4>
                                <p class="text-slate-400 text-xs">Educators, Researchers & Students</p>
                            </div>
                        </div>

                        <!-- Stat Row 3 -->
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-2xl bg-red-50 border border-red-100 flex items-center justify-center text-red-600 text-xl font-bold">
                                ⚡
                            </div>
                            <div>
                                <h4 class="font-heading font-bold text-[#182433] text-base">6 Core AI Pillars</h4>
                                <p class="text-slate-400 text-xs">From AI Literacy to Ethics & Research</p>
                            </div>
                        </div>

                        <!-- Quote Badge -->
                        <div class="pt-4 border-t border-slate-100">
                            <p class="text-[#5e6278] text-xs italic leading-relaxed">
                                "Closing the AI knowledge gap in classrooms across Khyber Pakhtunkhwa."
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Floating Decor Badge -->
                <div class="absolute -bottom-6 -left-6 bg-[#0c5adb] text-white p-4 rounded-2xl shadow-xl z-20 hidden sm:block animate-float">
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
