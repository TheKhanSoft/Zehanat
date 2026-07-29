@extends('layouts.public')

@section('title', 'Our Six Pillars - Zehanat')
@section('meta_description', 'The foundational principles guiding Zehanat for AI in Education across Khyber Pakhtunkhwa.')

@section('content')
    <!-- Section 1: Page Banner -->
    <x-public.page-banner title="Our Six Pillars" :breadcrumbs="[['label' => 'Home', 'url' => '/'], ['label' => 'Our Six Pillars']]">
        The six foundational principles guiding everything we do at Zehanat under AWKUM leadership.
    </x-public.page-banner>

    <!-- Section 2: Introduction -->
    <section class="py-16 bg-[#0b0f19] border-b border-slate-800">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div class="engitech-tag mb-3 justify-center">CORE FRAMEWORK</div>
            <p class="text-xl md:text-2xl text-slate-300 leading-relaxed font-heading font-semibold animate-fade-up">
                Zehanat's work is built upon six interconnected pillars. Together, they form a comprehensive framework for bringing AI education to every classroom and institution in Khyber Pakhtunkhwa.
            </p>
        </div>
    </section>

    <!-- Section 3: Detailed Pillars Grid -->
    <section class="py-20 lg:py-28 bg-[#0e1424]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-16">
            
            <!-- Pillar 1 -->
            <div id="literacy" class="engitech-icon-box bg-[#141a29] p-8 sm:p-12 border border-slate-800 scroll-mt-28">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
                    <div class="lg:col-span-4 flex items-center justify-center">
                        <div class="w-24 h-24 rounded-3xl bg-gradient-to-br from-[#0c5adb]/20 to-[#43baff]/10 border border-[#0c5adb]/30 flex items-center justify-center text-5xl text-[#43baff]">
                            🎓
                        </div>
                    </div>
                    <div class="lg:col-span-8 space-y-4">
                        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-[#0c5adb]/20 text-[#43baff] font-heading font-extrabold text-xs">
                            PILLAR 01
                        </div>
                        <h2 class="text-2xl sm:text-3xl font-heading font-extrabold text-white">AI Literacy & Awareness</h2>
                        <p class="text-slate-300 text-sm sm:text-base leading-relaxed">
                            Before we can teach with AI, we must understand it. Zehanat is committed to building foundational AI literacy across all levels of education — from primary school students learning what computers can do, to university faculty understanding machine learning principles.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Pillar 2 -->
            <div id="curriculum" class="engitech-icon-box bg-[#141a29] p-8 sm:p-12 border border-slate-800 scroll-mt-28">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
                    <div class="lg:col-span-4 flex items-center justify-center">
                        <div class="w-24 h-24 rounded-3xl bg-gradient-to-br from-cyan-600/20 to-blue-600/10 border border-cyan-500/30 flex items-center justify-center text-5xl text-cyan-400">
                            📚
                        </div>
                    </div>
                    <div class="lg:col-span-8 space-y-4">
                        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-cyan-600/20 text-cyan-400 font-heading font-extrabold text-xs">
                            PILLAR 02
                        </div>
                        <h2 class="text-2xl sm:text-3xl font-heading font-extrabold text-white">Curriculum Integration</h2>
                        <p class="text-slate-300 text-sm sm:text-base leading-relaxed">
                            AI education should not be an isolated subject for computer scientists alone. We work to integrate AI concepts into humanities, natural sciences, social sciences, and vocational training across Khyber Pakhtunkhwa.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Pillar 3 -->
            <div id="training" class="engitech-icon-box bg-[#141a29] p-8 sm:p-12 border border-slate-800 scroll-mt-28">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
                    <div class="lg:col-span-4 flex items-center justify-center">
                        <div class="w-24 h-24 rounded-3xl bg-gradient-to-br from-amber-600/20 to-red-600/10 border border-amber-500/30 flex items-center justify-center text-5xl text-amber-400">
                            👩‍🏫
                        </div>
                    </div>
                    <div class="lg:col-span-8 space-y-4">
                        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-amber-600/20 text-amber-400 font-heading font-extrabold text-xs">
                            PILLAR 03
                        </div>
                        <h2 class="text-2xl sm:text-3xl font-heading font-extrabold text-white">Teacher & Faculty Training</h2>
                        <p class="text-slate-300 text-sm sm:text-base leading-relaxed">
                            Empowering educators with practical AI tools, modern teaching methods, lesson planning assistants, and classroom integration strategies tailored to regional educational infrastructure.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Pillar 4 -->
            <div id="research" class="engitech-icon-box bg-[#141a29] p-8 sm:p-12 border border-slate-800 scroll-mt-28">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
                    <div class="lg:col-span-4 flex items-center justify-center">
                        <div class="w-24 h-24 rounded-3xl bg-gradient-to-br from-purple-600/20 to-blue-600/10 border border-purple-500/30 flex items-center justify-center text-5xl text-purple-400">
                            🔬
                        </div>
                    </div>
                    <div class="lg:col-span-8 space-y-4">
                        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-purple-600/20 text-purple-400 font-heading font-extrabold text-xs">
                            PILLAR 04
                        </div>
                        <h2 class="text-2xl sm:text-3xl font-heading font-extrabold text-white">Research & Innovation</h2>
                        <p class="text-slate-300 text-sm sm:text-base leading-relaxed">
                            Fostering applied AI research tailored to local needs in agriculture, healthcare, Pashto natural language processing, and regional educational challenges.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Pillar 5 -->
            <div id="ethics" class="engitech-icon-box bg-[#141a29] p-8 sm:p-12 border border-slate-800 scroll-mt-28">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
                    <div class="lg:col-span-4 flex items-center justify-center">
                        <div class="w-24 h-24 rounded-3xl bg-gradient-to-br from-red-600/20 to-amber-600/10 border border-red-500/30 flex items-center justify-center text-5xl text-[#ff4b2b]">
                            ⚖️
                        </div>
                    </div>
                    <div class="lg:col-span-8 space-y-4">
                        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-red-600/20 text-[#ff4b2b] font-heading font-extrabold text-xs">
                            PILLAR 05
                        </div>
                        <h2 class="text-2xl sm:text-3xl font-heading font-extrabold text-white">Ethical & Responsible AI</h2>
                        <p class="text-slate-300 text-sm sm:text-base leading-relaxed">
                            Promoting deep awareness of AI ethics, algorithmic bias, student data privacy, academic integrity, and responsible deployment in educational institutions.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Pillar 6 -->
            <div id="industry" class="engitech-icon-box bg-[#141a29] p-8 sm:p-12 border border-slate-800 scroll-mt-28">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
                    <div class="lg:col-span-4 flex items-center justify-center">
                        <div class="w-24 h-24 rounded-3xl bg-gradient-to-br from-emerald-600/20 to-teal-600/10 border border-emerald-500/30 flex items-center justify-center text-5xl text-emerald-400">
                            🤝
                        </div>
                    </div>
                    <div class="lg:col-span-8 space-y-4">
                        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-emerald-600/20 text-emerald-400 font-heading font-extrabold text-xs">
                            PILLAR 06
                        </div>
                        <h2 class="text-2xl sm:text-3xl font-heading font-extrabold text-white">Industry–Academia Partnership</h2>
                        <p class="text-slate-300 text-sm sm:text-base leading-relaxed">
                            Bridging academic learning and industrial needs through joint internships, tech incubators, guest lectures, and practical project exposure.
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection
