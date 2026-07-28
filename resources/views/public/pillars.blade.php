@extends('layouts.public')

@section('title', 'Our Six Pillars - Zehanat')
@section('meta_description', 'The foundational principles that guide everything we do at Zehanat for AI education.')

@section('content')
    <!-- Section 1: Page Banner -->
    <x-public.page-banner title="Our Six Pillars" :breadcrumbs="[['label' => 'Home', 'url' => '/'], ['label' => 'Our Six Pillars']]">
        The foundational principles that guide everything we do at Zehanat.
    </x-public.page-banner>

    <!-- Section 2: Introduction -->
    <section class="py-16 bg-slate-950 border-b border-white/5">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <p class="text-xl md:text-2xl text-slate-300 leading-relaxed font-light animate-fade-up">
                Zehanat's work is built upon six interconnected pillars. Together, they form a comprehensive framework for bringing AI education to every corner of Khyber Pakhtunkhwa.
            </p>
        </div>
    </section>

    <!-- Section 3: Detailed Pillars -->
    
    <!-- Pillar 1 -->
    <section class="py-20 md:py-28 bg-slate-900/50 overflow-hidden relative">
        <div class="absolute top-0 right-0 w-1/2 h-full bg-gradient-to-l from-teal-900/10 to-transparent opacity-50"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <div class="animate-fade-up order-2 lg:order-1">
                    <div class="glass-card aspect-square max-w-sm mx-auto rounded-3xl p-8 flex flex-col items-center justify-center bg-slate-800/50 border border-white/10 shadow-[0_0_50px_rgba(20,184,166,0.1)] relative">
                        <div class="absolute inset-0 bg-gradient-to-br from-teal-500/20 to-transparent rounded-3xl opacity-50"></div>
                        <span class="text-8xl mb-6 relative z-10">🎓</span>
                        <h3 class="text-2xl font-bold text-white text-center relative z-10">Foundations First</h3>
                    </div>
                </div>
                <div class="animate-fade-up stagger-1 order-1 lg:order-2">
                    <div class="inline-flex items-center gap-3 px-4 py-2 rounded-full bg-teal-500/10 text-teal-400 font-semibold mb-6 border border-teal-500/20">
                        <span>Pillar 01</span>
                    </div>
                    <h2 class="text-3xl md:text-4xl font-bold text-white mb-6">AI Literacy & Awareness</h2>
                    <p class="text-lg text-slate-300 mb-8 leading-relaxed">
                        Before we can teach with AI, we must understand it. Zehanat is committed to building foundational AI literacy across all levels of education — from primary school students learning what a computer can and cannot do, to university faculty understanding machine learning principles.
                    </p>
                    <div class="space-y-4">
                        <h4 class="text-xl font-semibold text-white">Key Activities:</h4>
                        <ul class="space-y-3">
                            <li class="flex items-start gap-3">
                                <svg class="w-6 h-6 text-teal-500 flex-shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                <span class="text-slate-300">Public lectures and demystification seminars</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <svg class="w-6 h-6 text-teal-500 flex-shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                <span class="text-slate-300">School-wide awareness campaigns</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <svg class="w-6 h-6 text-teal-500 flex-shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                <span class="text-slate-300">Introductory crash courses for non-technical audiences</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <svg class="w-6 h-6 text-teal-500 flex-shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                <span class="text-slate-300">Media outreach and local language content creation</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Pillar 2 -->
    <section class="py-20 md:py-28 bg-slate-950 overflow-hidden relative">
        <div class="absolute top-0 left-0 w-1/2 h-full bg-gradient-to-r from-amber-900/10 to-transparent opacity-50"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <div class="animate-fade-up">
                    <div class="inline-flex items-center gap-3 px-4 py-2 rounded-full bg-amber-500/10 text-amber-400 font-semibold mb-6 border border-amber-500/20">
                        <span>Pillar 02</span>
                    </div>
                    <h2 class="text-3xl md:text-4xl font-bold text-white mb-6">Curriculum Integration</h2>
                    <p class="text-lg text-slate-300 mb-8 leading-relaxed">
                        AI should not be confined to computer science departments. Zehanat works to weave AI concepts into existing curricula — mathematics, science, social studies, and beyond — making it a natural part of learning at every level.
                    </p>
                    <div class="space-y-4">
                        <h4 class="text-xl font-semibold text-white">Key Activities:</h4>
                        <ul class="space-y-3">
                            <li class="flex items-start gap-3">
                                <svg class="w-6 h-6 text-amber-500 flex-shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                <span class="text-slate-300">Establishing curriculum review committees</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <svg class="w-6 h-6 text-amber-500 flex-shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                <span class="text-slate-300">Developing age-appropriate model lesson plans</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <svg class="w-6 h-6 text-amber-500 flex-shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                <span class="text-slate-300">Creating cross-disciplinary AI modules</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <svg class="w-6 h-6 text-amber-500 flex-shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                <span class="text-slate-300">Reviewing and recommending modern textbook updates</span>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="animate-fade-up stagger-1">
                    <div class="glass-card aspect-square max-w-sm mx-auto rounded-3xl p-8 flex flex-col items-center justify-center bg-slate-800/50 border border-white/10 shadow-[0_0_50px_rgba(245,158,11,0.1)] relative">
                        <div class="absolute inset-0 bg-gradient-to-br from-amber-500/20 to-transparent rounded-3xl opacity-50"></div>
                        <span class="text-8xl mb-6 relative z-10">📚</span>
                        <h3 class="text-2xl font-bold text-white text-center relative z-10">Beyond Computer Science</h3>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Pillar 3 -->
    <section class="py-20 md:py-28 bg-slate-900/50 overflow-hidden relative">
        <div class="absolute top-0 right-0 w-1/2 h-full bg-gradient-to-l from-purple-900/10 to-transparent opacity-50"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <div class="animate-fade-up order-2 lg:order-1">
                    <div class="glass-card aspect-square max-w-sm mx-auto rounded-3xl p-8 flex flex-col items-center justify-center bg-slate-800/50 border border-white/10 shadow-[0_0_50px_rgba(168,85,247,0.1)] relative">
                        <div class="absolute inset-0 bg-gradient-to-br from-purple-500/20 to-transparent rounded-3xl opacity-50"></div>
                        <span class="text-8xl mb-6 relative z-10">👩‍🏫</span>
                        <h3 class="text-2xl font-bold text-white text-center relative z-10">Empowering Educators</h3>
                    </div>
                </div>
                <div class="animate-fade-up stagger-1 order-1 lg:order-2">
                    <div class="inline-flex items-center gap-3 px-4 py-2 rounded-full bg-purple-500/10 text-purple-400 font-semibold mb-6 border border-purple-500/20">
                        <span>Pillar 03</span>
                    </div>
                    <h2 class="text-3xl md:text-4xl font-bold text-white mb-6">Teacher & Faculty Training</h2>
                    <p class="text-lg text-slate-300 mb-8 leading-relaxed">
                        No educational reform succeeds without teachers. Zehanat provides comprehensive training programs to equip educators with the confidence and competence to incorporate AI into their teaching, assessment, and professional development.
                    </p>
                    <div class="space-y-4">
                        <h4 class="text-xl font-semibold text-white">Key Activities:</h4>
                        <ul class="space-y-3">
                            <li class="flex items-start gap-3">
                                <svg class="w-6 h-6 text-purple-500 flex-shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                <span class="text-slate-300">Hands-on AI tool workshops for classrooms</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <svg class="w-6 h-6 text-purple-500 flex-shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                <span class="text-slate-300">Tiered certification programs for educators</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <svg class="w-6 h-6 text-purple-500 flex-shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                <span class="text-slate-300">Peer mentoring and community-of-practice networks</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <svg class="w-6 h-6 text-purple-500 flex-shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                <span class="text-slate-300">Curating accessible online learning resources</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Pillar 4 -->
    <section class="py-20 md:py-28 bg-slate-950 overflow-hidden relative">
        <div class="absolute top-0 left-0 w-1/2 h-full bg-gradient-to-r from-blue-900/10 to-transparent opacity-50"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <div class="animate-fade-up">
                    <div class="inline-flex items-center gap-3 px-4 py-2 rounded-full bg-blue-500/10 text-blue-400 font-semibold mb-6 border border-blue-500/20">
                        <span>Pillar 04</span>
                    </div>
                    <h2 class="text-3xl md:text-4xl font-bold text-white mb-6">Research & Innovation</h2>
                    <p class="text-lg text-slate-300 mb-8 leading-relaxed">
                        Khyber Pakhtunkhwa faces unique challenges and opportunities. Zehanat fosters research that addresses local needs — from AI-powered solutions for rural education to innovative assessment methods — ensuring the province contributes to, not just consumes, the global AI conversation.
                    </p>
                    <div class="space-y-4">
                        <h4 class="text-xl font-semibold text-white">Key Activities:</h4>
                        <ul class="space-y-3">
                            <li class="flex items-start gap-3">
                                <svg class="w-6 h-6 text-blue-500 flex-shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                <span class="text-slate-300">Providing small research grants for educational AI</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <svg class="w-6 h-6 text-blue-500 flex-shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                <span class="text-slate-300">Hosting student hackathons and competitions</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <svg class="w-6 h-6 text-blue-500 flex-shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                <span class="text-slate-300">Establishing university-based innovation labs</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <svg class="w-6 h-6 text-blue-500 flex-shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                <span class="text-slate-300">Partnering for academic conferences and symposiums</span>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="animate-fade-up stagger-1">
                    <div class="glass-card aspect-square max-w-sm mx-auto rounded-3xl p-8 flex flex-col items-center justify-center bg-slate-800/50 border border-white/10 shadow-[0_0_50px_rgba(59,130,246,0.1)] relative">
                        <div class="absolute inset-0 bg-gradient-to-br from-blue-500/20 to-transparent rounded-3xl opacity-50"></div>
                        <span class="text-8xl mb-6 relative z-10">🔬</span>
                        <h3 class="text-2xl font-bold text-white text-center relative z-10">Local Solutions</h3>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Pillar 5 -->
    <section class="py-20 md:py-28 bg-slate-900/50 overflow-hidden relative">
        <div class="absolute top-0 right-0 w-1/2 h-full bg-gradient-to-l from-rose-900/10 to-transparent opacity-50"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <div class="animate-fade-up order-2 lg:order-1">
                    <div class="glass-card aspect-square max-w-sm mx-auto rounded-3xl p-8 flex flex-col items-center justify-center bg-slate-800/50 border border-white/10 shadow-[0_0_50px_rgba(244,63,94,0.1)] relative">
                        <div class="absolute inset-0 bg-gradient-to-br from-rose-500/20 to-transparent rounded-3xl opacity-50"></div>
                        <span class="text-8xl mb-6 relative z-10">⚖️</span>
                        <h3 class="text-2xl font-bold text-white text-center relative z-10">Integrity & Fairness</h3>
                    </div>
                </div>
                <div class="animate-fade-up stagger-1 order-1 lg:order-2">
                    <div class="inline-flex items-center gap-3 px-4 py-2 rounded-full bg-rose-500/10 text-rose-400 font-semibold mb-6 border border-rose-500/20">
                        <span>Pillar 05</span>
                    </div>
                    <h2 class="text-3xl md:text-4xl font-bold text-white mb-6">Ethical & Responsible AI</h2>
                    <p class="text-lg text-slate-300 mb-8 leading-relaxed">
                        With great power comes great responsibility. Zehanat champions the ethical use of AI in education, addressing bias, privacy, academic integrity, and the digital divide. We ensure that AI serves all students equitably.
                    </p>
                    <div class="space-y-4">
                        <h4 class="text-xl font-semibold text-white">Key Activities:</h4>
                        <ul class="space-y-3">
                            <li class="flex items-start gap-3">
                                <svg class="w-6 h-6 text-rose-500 flex-shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                <span class="text-slate-300">Drafting institutional ethics guidelines</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <svg class="w-6 h-6 text-rose-500 flex-shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                <span class="text-slate-300">Formulating policy recommendations for fair access</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <svg class="w-6 h-6 text-rose-500 flex-shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                <span class="text-slate-300">Conducting bias awareness workshops</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <svg class="w-6 h-6 text-rose-500 flex-shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                <span class="text-slate-300">Developing frameworks for responsible deployment</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Pillar 6 -->
    <section class="py-20 md:py-28 bg-slate-950 overflow-hidden relative">
        <div class="absolute top-0 left-0 w-1/2 h-full bg-gradient-to-r from-emerald-900/10 to-transparent opacity-50"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <div class="animate-fade-up">
                    <div class="inline-flex items-center gap-3 px-4 py-2 rounded-full bg-emerald-500/10 text-emerald-400 font-semibold mb-6 border border-emerald-500/20">
                        <span>Pillar 06</span>
                    </div>
                    <h2 class="text-3xl md:text-4xl font-bold text-white mb-6">Industry–Academia Partnership</h2>
                    <p class="text-lg text-slate-300 mb-8 leading-relaxed">
                        Education must connect to the real world. Zehanat bridges the gap between academic institutions and industry, facilitating internships, guest lectures, joint projects, and ensuring curricula prepare students for AI-driven workplaces.
                    </p>
                    <div class="space-y-4">
                        <h4 class="text-xl font-semibold text-white">Key Activities:</h4>
                        <ul class="space-y-3">
                            <li class="flex items-start gap-3">
                                <svg class="w-6 h-6 text-emerald-500 flex-shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                <span class="text-slate-300">Forming an active industry advisory board</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <svg class="w-6 h-6 text-emerald-500 flex-shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                <span class="text-slate-300">Facilitating student internship placements</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <svg class="w-6 h-6 text-emerald-500 flex-shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                <span class="text-slate-300">Organizing guest speaker series with professionals</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <svg class="w-6 h-6 text-emerald-500 flex-shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                <span class="text-slate-300">Collaborating on joint research projects</span>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="animate-fade-up stagger-1">
                    <div class="glass-card aspect-square max-w-sm mx-auto rounded-3xl p-8 flex flex-col items-center justify-center bg-slate-800/50 border border-white/10 shadow-[0_0_50px_rgba(16,185,129,0.1)] relative">
                        <div class="absolute inset-0 bg-gradient-to-br from-emerald-500/20 to-transparent rounded-3xl opacity-50"></div>
                        <span class="text-8xl mb-6 relative z-10">🤝</span>
                        <h3 class="text-2xl font-bold text-white text-center relative z-10">Real-World Readiness</h3>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section 4: CTA Banner -->
    <x-public.cta-banner title="Support Our Pillars" subtitle="Your involvement helps us translate these principles into province-wide action.">
        <x-public.btn variant="secondary" size="lg" href="/membership">Become a Member</x-public.btn>
        <x-public.btn variant="outline2" size="lg" href="/contact">Partner With Us</x-public.btn>
    </x-public.cta-banner>

@endsection
