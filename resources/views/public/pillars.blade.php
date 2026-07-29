@extends('layouts.public')

@section('title', 'Our Six Pillars - Zehanat')
@section('meta_description', 'The foundational principles guiding Zehanat for AI in Education across Khyber Pakhtunkhwa.')

@section('content')
    <!-- Section 1: Page Banner -->
    <x-public.page-banner title="Our Six Pillars" :breadcrumbs="[['label' => 'Home', 'url' => '/'], ['label' => 'Our Six Pillars']]">
        The six foundational principles guiding everything we do at Zehanat under AWKUM leadership.
    </x-public.page-banner>

    <!-- Section 2: Introduction -->
    <section class="py-16 bg-white border-b border-slate-200">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div class="engitech-tag mb-3 justify-center">CORE FRAMEWORK</div>
            <p class="text-xl md:text-2xl text-[#182433] leading-relaxed font-heading font-semibold animate-fade-up">
                Zehanat's work is built upon six interconnected pillars. Together, they form a comprehensive framework for bringing AI education to every classroom and institution in Khyber Pakhtunkhwa.
            </p>
        </div>
    </section>

    <!-- Section 3: Detailed Pillars Grid -->
    <section class="py-20 lg:py-28 bg-[#f4f6f9]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
            
            <!-- Pillar 1 -->
            <div id="literacy" class="engitech-icon-box bg-white p-8 sm:p-12 border border-slate-100 shadow-xl scroll-mt-28">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
                    <div class="lg:col-span-4 flex items-center justify-center">
                        <div class="w-24 h-24 rounded-3xl bg-blue-50 border border-blue-100 flex items-center justify-center text-5xl text-[#0c5adb]">
                            🎓
                        </div>
                    </div>
                    <div class="lg:col-span-8 space-y-4">
                        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-blue-50 text-[#0c5adb] font-heading font-extrabold text-xs">
                            PILLAR 01
                        </div>
                        <h2 class="text-2xl sm:text-3xl font-heading font-extrabold text-[#182433]">AI Literacy & Awareness</h2>
                        <p class="text-[#5e6278] text-sm sm:text-base leading-relaxed">
                            Before we can teach with AI, we must understand it. Zehanat is committed to building foundational AI literacy across all levels of education — from primary school students learning what computers can do, to university faculty understanding machine learning principles.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Pillar 2 -->
            <div id="curriculum" class="engitech-icon-box bg-white p-8 sm:p-12 border border-slate-100 shadow-xl scroll-mt-28">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
                    <div class="lg:col-span-4 flex items-center justify-center">
                        <div class="w-24 h-24 rounded-3xl bg-cyan-50 border border-cyan-100 flex items-center justify-center text-5xl text-cyan-600">
                            📚
                        </div>
                    </div>
                    <div class="lg:col-span-8 space-y-4">
                        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-cyan-50 text-cyan-600 font-heading font-extrabold text-xs">
                            PILLAR 02
                        </div>
                        <h2 class="text-2xl sm:text-3xl font-heading font-extrabold text-[#182433]">Curriculum Integration</h2>
                        <p class="text-[#5e6278] text-sm sm:text-base leading-relaxed">
                            AI education should not be an isolated subject for computer scientists alone. We work to integrate AI concepts into humanities, natural sciences, social sciences, and vocational training across Khyber Pakhtunkhwa.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Pillar 3 -->
            <div id="training" class="engitech-icon-box bg-white p-8 sm:p-12 border border-slate-100 shadow-xl scroll-mt-28">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
                    <div class="lg:col-span-4 flex items-center justify-center">
                        <div class="w-24 h-24 rounded-3xl bg-amber-50 border border-amber-100 flex items-center justify-center text-5xl text-amber-600">
                            👩‍🏫
                        </div>
                    </div>
                    <div class="lg:col-span-8 space-y-4">
                        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-amber-50 text-amber-600 font-heading font-extrabold text-xs">
                            PILLAR 03
                        </div>
                        <h2 class="text-2xl sm:text-3xl font-heading font-extrabold text-[#182433]">Teacher & Faculty Training</h2>
                        <p class="text-[#5e6278] text-sm sm:text-base leading-relaxed">
                            Empowering educators with practical AI tools, modern teaching methods, lesson planning assistants, and classroom integration strategies tailored to regional educational infrastructure.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Pillar 4 -->
            <div id="research" class="engitech-icon-box bg-white p-8 sm:p-12 border border-slate-100 shadow-xl scroll-mt-28">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
                    <div class="lg:col-span-4 flex items-center justify-center">
                        <div class="w-24 h-24 rounded-3xl bg-purple-50 border border-purple-100 flex items-center justify-center text-5xl text-purple-600">
                            🔬
                        </div>
                    </div>
                    <div class="lg:col-span-8 space-y-4">
                        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-purple-50 text-purple-600 font-heading font-extrabold text-xs">
                            PILLAR 04
                        </div>
                        <h2 class="text-2xl sm:text-3xl font-heading font-extrabold text-[#182433]">Research & Innovation</h2>
                        <p class="text-[#5e6278] text-sm sm:text-base leading-relaxed">
                            Fostering applied AI research tailored to local needs in agriculture, healthcare, Pashto natural language processing, and regional educational challenges.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Pillar 5 -->
            <div id="ethics" class="engitech-icon-box bg-white p-8 sm:p-12 border border-slate-100 shadow-xl scroll-mt-28">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
                    <div class="lg:col-span-4 flex items-center justify-center">
                        <div class="w-24 h-24 rounded-3xl bg-red-50 border border-red-100 flex items-center justify-center text-5xl text-[#ff4b2b]">
                            ⚖️
                        </div>
                    </div>
                    <div class="lg:col-span-8 space-y-4">
                        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-red-50 text-[#ff4b2b] font-heading font-extrabold text-xs">
                            PILLAR 05
                        </div>
                        <h2 class="text-2xl sm:text-3xl font-heading font-extrabold text-[#182433]">Ethical & Responsible AI</h2>
                        <p class="text-[#5e6278] text-sm sm:text-base leading-relaxed">
                            Promoting deep awareness of AI ethics, algorithmic bias, student data privacy, academic integrity, and responsible deployment in educational institutions.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Pillar 6 -->
            <div id="industry" class="engitech-icon-box bg-white p-8 sm:p-12 border border-slate-100 shadow-xl scroll-mt-28">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
                    <div class="lg:col-span-4 flex items-center justify-center">
                        <div class="w-24 h-24 rounded-3xl bg-emerald-50 border border-emerald-100 flex items-center justify-center text-5xl text-emerald-600">
                            🤝
                        </div>
                    </div>
                    <div class="lg:col-span-8 space-y-4">
                        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-emerald-50 text-emerald-600 font-heading font-extrabold text-xs">
                            PILLAR 06
                        </div>
                        <h2 class="text-2xl sm:text-3xl font-heading font-extrabold text-[#182433]">Industry–Academia Partnership</h2>
                        <p class="text-[#5e6278] text-sm sm:text-base leading-relaxed">
                            Bridging academic learning and industrial needs through joint internships, tech incubators, guest lectures, and practical project exposure.
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection
