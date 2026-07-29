@props([
    'showParticles' => true,
])

<section id="hero-slider-wrapper" class="relative min-h-[88vh] lg:min-h-[90vh] flex items-center justify-center overflow-hidden bg-[#f4f6f9] pt-16 pb-20">
    <!-- Canvas overlay -->
    @if($showParticles)
    <canvas id="neural-canvas" class="absolute inset-0 z-0 opacity-15"></canvas>
    @endif

    <!-- Engitech Background Decorative Soft Glows -->
    <div class="absolute top-1/4 -left-32 w-96 h-96 bg-[#0c5adb]/10 rounded-full blur-[100px] pointer-events-none"></div>
    <div class="absolute bottom-1/4 -right-32 w-96 h-96 bg-[#43baff]/15 rounded-full blur-[100px] pointer-events-none"></div>

    <!-- Main Carousel Slides Container -->
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
        <div class="hero-slider-container">

            <!-- SLIDE 1: WE ARE ZEHANAT -->
            <div data-hero-slide="0" class="hero-slide active">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                    <div class="lg:col-span-7 text-left space-y-6">
                        <div class="layer-tag inline-flex items-center gap-2 bg-white border border-slate-200 rounded-full px-4 py-1.5 text-xs text-[#606e7b] shadow-sm">
                            <span class="w-2 h-2 bg-[#0c5adb] rounded-full animate-ping"></span>
                            <span class="font-heading font-extrabold uppercase text-[#0c5adb] tracking-wider text-[11px]">// WE ARE ZEHANAT</span>
                            <span class="text-slate-300">|</span>
                            <span>AWKUM Leadership</span>
                        </div>

                        <h1 class="layer-title text-4xl sm:text-5xl lg:text-6xl font-heading font-extrabold text-[#101928] tracking-tight leading-[1.15]">
                            Software & AI Solutions For <span class="text-gradient">Education Transformation</span>
                        </h1>

                        <div class="flex items-center gap-3">
                            <span class="text-2xl text-[#0c5adb] font-normal" dir="rtl">ذہانت</span>
                            <span class="text-[#606e7b] text-sm font-medium">The Khyber Pakhtunkhwa Society for AI in Education</span>
                        </div>

                        <p class="layer-subtext text-base sm:text-lg text-[#606e7b] max-w-2xl leading-relaxed">
                            Empowering educators, students, researchers and institutions across KP under Abdul Wali Khan University Mardan.
                        </p>

                        <div class="layer-actions pt-4 flex flex-wrap items-center gap-4">
                            <x-public.btn variant="primary" size="lg" href="/membership">Become a Member</x-public.btn>
                            <x-public.btn variant="outline2" size="lg" href="/programs">Explore Programs</x-public.btn>
                        </div>
                    </div>

                    <!-- Slide 1 Graphic Card -->
                    <div class="lg:col-span-5 relative">
                        <div class="layer-card bg-white rounded-3xl p-8 border border-slate-100 shadow-2xl relative z-10">
                            <div class="space-y-6">
                                <div class="flex items-center justify-between border-b border-slate-100 pb-4">
                                    <span class="font-heading font-extrabold text-xs text-[#0c5adb] uppercase tracking-wider">// Quick Impact</span>
                                    <span class="text-xs text-slate-400 font-semibold">2026 Roadmap</span>
                                </div>

                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 rounded-2xl bg-blue-50 border border-blue-100 flex items-center justify-center text-blue-600 text-xl font-bold">🏫</div>
                                    <div>
                                        <h4 class="font-heading font-bold text-[#101928] text-base">50+ Partner Institutions</h4>
                                        <p class="text-[#606e7b] text-xs">Schools, Colleges & Universities</p>
                                    </div>
                                </div>

                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 rounded-2xl bg-cyan-50 border border-cyan-100 flex items-center justify-center text-cyan-600 text-xl font-bold">🧑‍🎓</div>
                                    <div>
                                        <h4 class="font-heading font-bold text-[#101928] text-base">500+ Active Members</h4>
                                        <p class="text-[#606e7b] text-xs">Educators, Researchers & Students</p>
                                    </div>
                                </div>

                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 rounded-2xl bg-red-50 border border-red-100 flex items-center justify-center text-red-600 text-xl font-bold">⚡</div>
                                    <div>
                                        <h4 class="font-heading font-bold text-[#101928] text-base">6 Core AI Pillars</h4>
                                        <p class="text-[#606e7b] text-xs">From AI Literacy to Ethics & Research</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- SLIDE 2: CYBERSECURITY & AI LITERACY -->
            <div data-hero-slide="1" class="hero-slide">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                    <div class="lg:col-span-7 text-left space-y-6">
                        <div class="layer-tag inline-flex items-center gap-2 bg-white border border-slate-200 rounded-full px-4 py-1.5 text-xs text-[#606e7b] shadow-sm">
                            <span class="w-2 h-2 bg-[#43baff] rounded-full animate-ping"></span>
                            <span class="font-heading font-extrabold uppercase text-[#0c5adb] tracking-wider text-[11px]">// CYBERSECURITY & AI LITERACY</span>
                        </div>

                        <h1 class="layer-title text-4xl sm:text-5xl lg:text-6xl font-heading font-extrabold text-[#101928] tracking-tight leading-[1.15]">
                            Protect & Innovate Your <span class="text-gradient">Digital Future</span>
                        </h1>

                        <p class="layer-subtext text-base sm:text-lg text-[#606e7b] max-w-2xl leading-relaxed">
                            Building foundational AI literacy and cyber safety across primary, secondary, and higher education in Khyber Pakhtunkhwa.
                        </p>

                        <div class="layer-actions pt-4 flex flex-wrap items-center gap-4">
                            <x-public.btn variant="primary" size="lg" href="/pillars">Explore Pillars</x-public.btn>
                            <x-public.btn variant="outline2" size="lg" href="/about">Read Our Story</x-public.btn>
                        </div>
                    </div>

                    <!-- Slide 2 Graphic Card -->
                    <div class="lg:col-span-5 relative">
                        <div class="layer-card bg-white rounded-3xl p-8 border border-slate-100 shadow-2xl relative z-10">
                            <div class="space-y-6">
                                <div class="flex items-center justify-between border-b border-slate-100 pb-4">
                                    <span class="font-heading font-extrabold text-xs text-[#0c5adb] uppercase tracking-wider">// Classroom Safety</span>
                                    <span class="text-xs text-slate-400 font-semibold">Security Standards</span>
                                </div>

                                <div class="p-4 rounded-2xl bg-blue-50 border border-blue-100">
                                    <h4 class="font-heading font-bold text-[#101928] text-sm">Teacher AI Training</h4>
                                    <p class="text-xs text-[#606e7b] mt-1">Practical lesson planning with Generative AI tools.</p>
                                </div>

                                <div class="p-4 rounded-2xl bg-cyan-50 border border-cyan-100">
                                    <h4 class="font-heading font-bold text-[#101928] text-sm">Curriculum Integration</h4>
                                    <p class="text-xs text-[#606e7b] mt-1">Aligning AI skills with provincial educational boards.</p>
                                </div>

                                <div class="p-4 rounded-2xl bg-red-50 border border-red-100">
                                    <h4 class="font-heading font-bold text-[#101928] text-sm">Student Data Protection</h4>
                                    <p class="text-xs text-[#606e7b] mt-1">Ethical AI deployment and academic integrity standards.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- SLIDE 3: CLOUD & AI RESEARCH -->
            <div data-hero-slide="2" class="hero-slide">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                    <div class="lg:col-span-7 text-left space-y-6">
                        <div class="layer-tag inline-flex items-center gap-2 bg-white border border-slate-200 rounded-full px-4 py-1.5 text-xs text-[#606e7b] shadow-sm">
                            <span class="w-2 h-2 bg-[#ff4b2b] rounded-full animate-ping"></span>
                            <span class="font-heading font-extrabold uppercase text-[#ff4b2b] tracking-wider text-[11px]">// CLOUD & AI RESEARCH</span>
                        </div>

                        <h1 class="layer-title text-4xl sm:text-5xl lg:text-6xl font-heading font-extrabold text-[#101928] tracking-tight leading-[1.15]">
                            Design & Tech Driven <span class="text-gradient">Digital Transformation</span>
                        </h1>

                        <p class="layer-subtext text-base sm:text-lg text-[#606e7b] max-w-2xl leading-relaxed">
                            Connecting academic research at AWKUM with regional industry demands to foster KP's next generation of AI innovators.
                        </p>

                        <div class="layer-actions pt-4 flex flex-wrap items-center gap-4">
                            <x-public.btn variant="primary" size="lg" href="/programs">View Programs</x-public.btn>
                            <x-public.btn variant="outline2" size="lg" href="/contact">Contact Team</x-public.btn>
                        </div>
                    </div>

                    <!-- Slide 3 Graphic Card -->
                    <div class="lg:col-span-5 relative">
                        <div class="layer-card bg-white rounded-3xl p-8 border border-slate-100 shadow-2xl relative z-10">
                            <div class="space-y-6">
                                <div class="flex items-center justify-between border-b border-slate-100 pb-4">
                                    <span class="font-heading font-extrabold text-xs text-[#0c5adb] uppercase tracking-wider">// Research Hub</span>
                                    <span class="text-xs text-slate-400 font-semibold">AWKUM Ecosystem</span>
                                </div>

                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 rounded-2xl bg-emerald-50 border border-emerald-100 flex items-center justify-center text-emerald-600 text-xl font-bold">🔬</div>
                                    <div>
                                        <h4 class="font-heading font-bold text-[#101928] text-base">Regional AI Research</h4>
                                        <p class="text-[#606e7b] text-xs">Agriculture, Healthcare & Pashto NLP</p>
                                    </div>
                                </div>

                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 rounded-2xl bg-amber-50 border border-amber-100 flex items-center justify-center text-amber-600 text-xl font-bold">🤝</div>
                                    <div>
                                        <h4 class="font-heading font-bold text-[#101928] text-base">Industry Partnerships</h4>
                                        <p class="text-[#606e7b] text-xs">Joint projects & student internships</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- SLIDE 4: DATA SCIENCE & ANALYTICS -->
            <div data-hero-slide="3" class="hero-slide">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                    <div class="lg:col-span-7 text-left space-y-6">
                        <div class="layer-tag inline-flex items-center gap-2 bg-white border border-slate-200 rounded-full px-4 py-1.5 text-xs text-[#606e7b] shadow-sm">
                            <span class="w-2 h-2 bg-[#0c5adb] rounded-full animate-ping"></span>
                            <span class="font-heading font-extrabold uppercase text-[#0c5adb] tracking-wider text-[11px]">// DATA SCIENCE & ANALYTICS</span>
                        </div>

                        <h1 class="layer-title text-4xl sm:text-5xl lg:text-6xl font-heading font-extrabold text-[#101928] tracking-tight leading-[1.15]">
                            Turning Complex Data Into <span class="text-gradient">Educational Intelligence</span>
                        </h1>

                        <p class="layer-subtext text-base sm:text-lg text-[#606e7b] max-w-2xl leading-relaxed">
                            Empowering educational boards, researchers, and academic institutions with actionable data-driven AI analytics.
                        </p>

                        <div class="layer-actions pt-4 flex flex-wrap items-center gap-4">
                            <x-public.btn variant="primary" size="lg" href="/membership">Become A Member</x-public.btn>
                            <x-public.btn variant="outline2" size="lg" href="/contact">Get In Touch</x-public.btn>
                        </div>
                    </div>

                    <!-- Slide 4 Graphic Card -->
                    <div class="lg:col-span-5 relative">
                        <div class="layer-card bg-white rounded-3xl p-8 border border-slate-100 shadow-2xl relative z-10">
                            <div class="space-y-6">
                                <div class="flex items-center justify-between border-b border-slate-100 pb-4">
                                    <span class="font-heading font-extrabold text-xs text-[#0c5adb] uppercase tracking-wider">// Analytics Suite</span>
                                    <span class="text-xs text-slate-400 font-semibold">Institutional AI</span>
                                </div>

                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 rounded-2xl bg-purple-50 border border-purple-100 flex items-center justify-center text-purple-600 text-xl font-bold">📊</div>
                                    <div>
                                        <h4 class="font-heading font-bold text-[#101928] text-base">Student Performance AI</h4>
                                        <p class="text-[#606e7b] text-xs">Predictive insights for learning outcomes</p>
                                    </div>
                                </div>

                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 rounded-2xl bg-blue-50 border border-blue-100 flex items-center justify-center text-blue-600 text-xl font-bold">📈</div>
                                    <div>
                                        <h4 class="font-heading font-bold text-[#101928] text-base">Institutional Metrics</h4>
                                        <p class="text-[#606e7b] text-xs">Provincial educational dashboards</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- SLIDE 5: FACULTY & TEACHER TRAINING -->
            <div data-hero-slide="4" class="hero-slide">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                    <div class="lg:col-span-7 text-left space-y-6">
                        <div class="layer-tag inline-flex items-center gap-2 bg-white border border-slate-200 rounded-full px-4 py-1.5 text-xs text-[#606e7b] shadow-sm">
                            <span class="w-2 h-2 bg-[#43baff] rounded-full animate-ping"></span>
                            <span class="font-heading font-extrabold uppercase text-[#0c5adb] tracking-wider text-[11px]">// FACULTY & TEACHER TRAINING</span>
                        </div>

                        <h1 class="layer-title text-4xl sm:text-5xl lg:text-6xl font-heading font-extrabold text-[#101928] tracking-tight leading-[1.15]">
                            Empowering Educators With <span class="text-gradient">Next-Gen AI Skills</span>
                        </h1>

                        <p class="layer-subtext text-base sm:text-lg text-[#606e7b] max-w-2xl leading-relaxed">
                            Comprehensive workshops, lesson-planning assistants, and classroom integration modules for teachers across KP.
                        </p>

                        <div class="layer-actions pt-4 flex flex-wrap items-center gap-4">
                            <x-public.btn variant="primary" size="lg" href="/programs#schools">Teacher Modules</x-public.btn>
                            <x-public.btn variant="outline2" size="lg" href="/contact">Register School</x-public.btn>
                        </div>
                    </div>

                    <!-- Slide 5 Graphic Card -->
                    <div class="lg:col-span-5 relative">
                        <div class="layer-card bg-white rounded-3xl p-8 border border-slate-100 shadow-2xl relative z-10">
                            <div class="space-y-6">
                                <div class="flex items-center justify-between border-b border-slate-100 pb-4">
                                    <span class="font-heading font-extrabold text-xs text-[#0c5adb] uppercase tracking-wider">// Teacher Enablement</span>
                                    <span class="text-xs text-slate-400 font-semibold">Hands-on Labs</span>
                                </div>

                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 rounded-2xl bg-indigo-50 border border-indigo-100 flex items-center justify-center text-indigo-600 text-xl font-bold">👩‍🏫</div>
                                    <div>
                                        <h4 class="font-heading font-bold text-[#101928] text-base">Interactive Workshops</h4>
                                        <p class="text-[#606e7b] text-xs">Generative AI for curriculum development</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- SLIDE 6: ETHICAL & RESPONSIBLE AI -->
            <div data-hero-slide="5" class="hero-slide">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                    <div class="lg:col-span-7 text-left space-y-6">
                        <div class="layer-tag inline-flex items-center gap-2 bg-white border border-slate-200 rounded-full px-4 py-1.5 text-xs text-[#606e7b] shadow-sm">
                            <span class="w-2 h-2 bg-[#ff4b2b] rounded-full animate-ping"></span>
                            <span class="font-heading font-extrabold uppercase text-[#ff4b2b] tracking-wider text-[11px]">// ETHICAL & RESPONSIBLE AI</span>
                        </div>

                        <h1 class="layer-title text-4xl sm:text-5xl lg:text-6xl font-heading font-extrabold text-[#101928] tracking-tight leading-[1.15]">
                            Building Trust & Standards in <span class="text-gradient">Educational Tech</span>
                        </h1>

                        <p class="layer-subtext text-base sm:text-lg text-[#606e7b] max-w-2xl leading-relaxed">
                            Promoting AI ethics, data privacy, student fairness, and academic integrity standards across educational institutions.
                        </p>

                        <div class="layer-actions pt-4 flex flex-wrap items-center gap-4">
                            <x-public.btn variant="primary" size="lg" href="/pillars#ethics">Read Guidelines</x-public.btn>
                            <x-public.btn variant="outline2" size="lg" href="/faq">FAQ & Support</x-public.btn>
                        </div>
                    </div>

                    <!-- Slide 6 Graphic Card -->
                    <div class="lg:col-span-5 relative">
                        <div class="layer-card bg-white rounded-3xl p-8 border border-slate-100 shadow-2xl relative z-10">
                            <div class="space-y-6">
                                <div class="flex items-center justify-between border-b border-slate-100 pb-4">
                                    <span class="font-heading font-extrabold text-xs text-[#0c5adb] uppercase tracking-wider">// Governance Framework</span>
                                    <span class="text-xs text-slate-400 font-semibold">Academic Integrity</span>
                                </div>

                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 rounded-2xl bg-amber-50 border border-amber-100 flex items-center justify-center text-amber-600 text-xl font-bold">⚖️</div>
                                    <div>
                                        <h4 class="font-heading font-bold text-[#101928] text-base">Responsible AI Policy</h4>
                                        <p class="text-[#606e7b] text-xs">Frameworks for fair assessment & privacy</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- Slider Controls: Prev/Next & Dots & Counter -->
        <div class="mt-12 flex items-center justify-between pt-6 border-t border-slate-200/80">
            <!-- Left: Slide Numbers (01 / 06) -->
            <div class="flex items-center gap-3 font-heading font-extrabold text-sm text-[#101928]">
                <span id="hero-slide-current" class="text-lg text-[#0c5adb]">01</span>
                <span class="text-slate-300">/</span>
                <span id="hero-slide-total" class="text-slate-400">06</span>
            </div>

            <!-- Center: 6 Pagination Dots -->
            <div class="flex items-center space-x-2">
                <button data-hero-dot="0" class="h-3 w-8 rounded-full bg-[#0c5adb] transition-all" aria-label="Slide 1"></button>
                <button data-hero-dot="1" class="h-3 w-3 rounded-full bg-slate-300 transition-all hover:bg-[#0c5adb]" aria-label="Slide 2"></button>
                <button data-hero-dot="2" class="h-3 w-3 rounded-full bg-slate-300 transition-all hover:bg-[#0c5adb]" aria-label="Slide 3"></button>
                <button data-hero-dot="3" class="h-3 w-3 rounded-full bg-slate-300 transition-all hover:bg-[#0c5adb]" aria-label="Slide 4"></button>
                <button data-hero-dot="4" class="h-3 w-3 rounded-full bg-slate-300 transition-all hover:bg-[#0c5adb]" aria-label="Slide 5"></button>
                <button data-hero-dot="5" class="h-3 w-3 rounded-full bg-slate-300 transition-all hover:bg-[#0c5adb]" aria-label="Slide 6"></button>
            </div>

            <!-- Right: Arrow Prev / Next Buttons -->
            <div class="flex items-center space-x-3">
                <button id="hero-prev-btn" class="w-10 h-10 rounded-xl bg-white border border-slate-200 hover:bg-[#0c5adb] hover:text-white text-[#101928] flex items-center justify-center transition-colors shadow-sm" aria-label="Previous Slide">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                </button>
                <button id="hero-next-btn" class="w-10 h-10 rounded-xl bg-white border border-slate-200 hover:bg-[#0c5adb] hover:text-white text-[#101928] flex items-center justify-center transition-colors shadow-sm" aria-label="Next Slide">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </button>
            </div>
        </div>

    </div>
</section>
