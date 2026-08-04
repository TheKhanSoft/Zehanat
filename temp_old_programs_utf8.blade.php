@extends('layouts.public')

@section('title', 'Our Programs - Zehanat')
@section('meta_description', 'Tailored AI education programs for schools, colleges, universities, industry, and the public.')

@section('content')
<x-public.page-banner title="Our Programs" :breadcrumbs="[['label' => 'Home', 'url' => '/'], ['label' => 'Programs']]">
    Tailored AI education programs for every level and sector.
</x-public.page-banner>

<section class="py-20 md:py-28 bg-slate-950">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-16 animate-fade-up">
            <p class="text-lg text-slate-300">
                Zehanat offers structured programs designed to meet the unique needs of different educational levels and sectors. Whether you're a primary school teacher or an industry leader, we have a program for you.
            </p>
        </div>

        <div class="flex flex-wrap justify-center gap-4 mb-20 animate-fade-up stagger-1">
            <a href="#schools" class="px-6 py-2 rounded-full border border-slate-700 bg-slate-800/50 hover:bg-teal-500/20 hover:border-teal-500 text-slate-200 transition-all text-sm font-medium">Schools</a>
            <a href="#colleges" class="px-6 py-2 rounded-full border border-slate-700 bg-slate-800/50 hover:bg-teal-500/20 hover:border-teal-500 text-slate-200 transition-all text-sm font-medium">Colleges</a>
            <a href="#universities" class="px-6 py-2 rounded-full border border-slate-700 bg-slate-800/50 hover:bg-teal-500/20 hover:border-teal-500 text-slate-200 transition-all text-sm font-medium">Universities</a>
            <a href="#industry" class="px-6 py-2 rounded-full border border-slate-700 bg-slate-800/50 hover:bg-teal-500/20 hover:border-teal-500 text-slate-200 transition-all text-sm font-medium">Industry</a>
            <a href="#public" class="px-6 py-2 rounded-full border border-slate-700 bg-slate-800/50 hover:bg-teal-500/20 hover:border-teal-500 text-slate-200 transition-all text-sm font-medium">Public</a>
        </div>
    </div>
</section>

<section id="schools" class="py-20 md:py-28 bg-slate-900/50 scroll-mt-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col lg:flex-row gap-12 items-center">
            <div class="lg:w-1/3 animate-fade-up">
                <div class="w-16 h-16 rounded-2xl bg-teal-500/10 flex items-center justify-center mb-6 text-teal-500 text-4xl">
                    ≡ƒÅ½
                </div>
                <h2 class="text-3xl font-bold text-white mb-4">For Schools</h2>
                <p class="text-slate-300 leading-relaxed mb-6">
                    Our schools program focuses on introducing AI concepts to young learners in age-appropriate ways, while equipping teachers with the tools and confidence to bring AI into their classrooms.
                </p>
                <x-public.btn variant="outline" size="sm" href="/contact">Enquire Now</x-public.btn>
            </div>
            <div class="lg:w-2/3 grid grid-cols-1 md:grid-cols-2 gap-6 animate-fade-up stagger-1">
                <div class="glass-card p-6 rounded-xl border border-slate-800 bg-slate-800/40">
                    <h3 class="text-lg font-semibold text-white mb-2">AI Awareness Workshops for Teachers</h3>
                    <p class="text-sm text-slate-400">Interactive sessions designed to demystify AI and showcase its practical applications in lesson planning.</p>
                </div>
                <div class="glass-card p-6 rounded-xl border border-slate-800 bg-slate-800/40">
                    <h3 class="text-lg font-semibold text-white mb-2">Student AI Discovery Days</h3>
                    <p class="text-sm text-slate-400">Fun, hands-on events where students interact with AI tools and understand the technology shaping their future.</p>
                </div>
                <div class="glass-card p-6 rounded-xl border border-slate-800 bg-slate-800/40">
                    <h3 class="text-lg font-semibold text-white mb-2">Model Lesson Plans & Resources</h3>
                    <p class="text-sm text-slate-400">Curated materials that teachers can directly integrate into their existing curriculum across various subjects.</p>
                </div>
                <div class="glass-card p-6 rounded-xl border border-slate-800 bg-slate-800/40">
                    <h3 class="text-lg font-semibold text-white mb-2">School AI Readiness Assessment</h3>
                    <p class="text-sm text-slate-400">Comprehensive evaluation to help schools understand their current infrastructure and readiness for AI integration.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="colleges" class="py-20 md:py-28 bg-slate-950 scroll-mt-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col lg:flex-row-reverse gap-12 items-center">
            <div class="lg:w-1/3 animate-fade-up">
                <div class="w-16 h-16 rounded-2xl bg-amber-500/10 flex items-center justify-center mb-6 text-amber-500 text-4xl">
                    ≡ƒÄô
                </div>
                <h2 class="text-3xl font-bold text-white mb-4">For Colleges</h2>
                <p class="text-slate-300 leading-relaxed mb-6">
                    College-level programs bridge the gap between basic AI awareness and deeper technical understanding, preparing students for university studies and early career paths.
                </p>
                <x-public.btn variant="outline" size="sm" href="/contact">Enquire Now</x-public.btn>
            </div>
            <div class="lg:w-2/3 grid grid-cols-1 md:grid-cols-2 gap-6 animate-fade-up stagger-1">
                <div class="glass-card p-6 rounded-xl border border-slate-800 bg-slate-800/40">
                    <h3 class="text-lg font-semibold text-white mb-2">AI Integration in Existing Courses</h3>
                    <p class="text-sm text-slate-400">Strategies for incorporating AI modules into diverse academic streams, not just computer science.</p>
                </div>
                <div class="glass-card p-6 rounded-xl border border-slate-800 bg-slate-800/40">
                    <h3 class="text-lg font-semibold text-white mb-2">Faculty Development Workshops</h3>
                    <p class="text-sm text-slate-400">In-depth training for college lecturers to master AI educational tools and pedagogical approaches.</p>
                </div>
                <div class="glass-card p-6 rounded-xl border border-slate-800 bg-slate-800/40">
                    <h3 class="text-lg font-semibold text-white mb-2">Student AI Project Competitions</h3>
                    <p class="text-sm text-slate-400">Encouraging innovation through guided AI projects and inter-college competitions.</p>
                </div>
                <div class="glass-card p-6 rounded-xl border border-slate-800 bg-slate-800/40">
                    <h3 class="text-lg font-semibold text-white mb-2">Career Guidance in AI Fields</h3>
                    <p class="text-sm text-slate-400">Seminars connecting students with industry professionals to explore emerging career opportunities in AI.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="universities" class="py-20 md:py-28 bg-slate-900/50 scroll-mt-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col lg:flex-row gap-12 items-center">
            <div class="lg:w-1/3 animate-fade-up">
                <div class="w-16 h-16 rounded-2xl bg-teal-500/10 flex items-center justify-center mb-6 text-teal-500 text-4xl">
                    ≡ƒÅ¢∩╕Å
                </div>
                <h2 class="text-3xl font-bold text-white mb-4">For Universities</h2>
                <p class="text-slate-300 leading-relaxed mb-6">
                    University programs support advanced AI education, research collaboration, and institutional modernisation through AI-powered tools and methodologies.
                </p>
                <x-public.btn variant="outline" size="sm" href="/contact">Enquire Now</x-public.btn>
            </div>
            <div class="lg:w-2/3 grid grid-cols-1 md:grid-cols-2 gap-6 animate-fade-up stagger-1">
                <div class="glass-card p-6 rounded-xl border border-slate-800 bg-slate-800/40">
                    <h3 class="text-lg font-semibold text-white mb-2">Curriculum Enhancement Consulting</h3>
                    <p class="text-sm text-slate-400">Expert guidance on modernising degree programs with cutting-edge AI technologies and ethics.</p>
                </div>
                <div class="glass-card p-6 rounded-xl border border-slate-800 bg-slate-800/40">
                    <h3 class="text-lg font-semibold text-white mb-2">Research Collaboration Programs</h3>
                    <p class="text-sm text-slate-400">Facilitating interdisciplinary AI research projects and connecting academic researchers with industry needs.</p>
                </div>
                <div class="glass-card p-6 rounded-xl border border-slate-800 bg-slate-800/40">
                    <h3 class="text-lg font-semibold text-white mb-2">AI in University Administration</h3>
                    <p class="text-sm text-slate-400">Exploring and implementing AI solutions to streamline admissions, student support, and operational efficiency.</p>
                </div>
                <div class="glass-card p-6 rounded-xl border border-slate-800 bg-slate-800/40">
                    <h3 class="text-lg font-semibold text-white mb-2">Graduate Student AI Fellowships</h3>
                    <p class="text-sm text-slate-400">Supporting exceptional graduate students conducting impactful research in AI education and applications.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="industry" class="py-20 md:py-28 bg-slate-950 scroll-mt-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col lg:flex-row-reverse gap-12 items-center">
            <div class="lg:w-1/3 animate-fade-up">
                <div class="w-16 h-16 rounded-2xl bg-amber-500/10 flex items-center justify-center mb-6 text-amber-500 text-4xl">
                    ≡ƒÅ¡
                </div>
                <h2 class="text-3xl font-bold text-white mb-4">For Industry</h2>
                <p class="text-slate-300 leading-relaxed mb-6">
                    Industry programs connect businesses with educational institutions, creating pathways for practical AI adoption and workforce development.
                </p>
                <x-public.btn variant="outline" size="sm" href="/contact">Enquire Now</x-public.btn>
            </div>
            <div class="lg:w-2/3 grid grid-cols-1 md:grid-cols-2 gap-6 animate-fade-up stagger-1">
                <div class="glass-card p-6 rounded-xl border border-slate-800 bg-slate-800/40">
                    <h3 class="text-lg font-semibold text-white mb-2">IndustryΓÇôAcademia Liaison Programs</h3>
                    <p class="text-sm text-slate-400">Bridging the gap between corporate technology needs and academic research capabilities.</p>
                </div>
                <div class="glass-card p-6 rounded-xl border border-slate-800 bg-slate-800/40">
                    <h3 class="text-lg font-semibold text-white mb-2">AI Workforce Training</h3>
                    <p class="text-sm text-slate-400">Tailored upskilling programs for corporate teams to leverage AI tools in their daily workflows.</p>
                </div>
                <div class="glass-card p-6 rounded-xl border border-slate-800 bg-slate-800/40">
                    <h3 class="text-lg font-semibold text-white mb-2">Technology Transfer Workshops</h3>
                    <p class="text-sm text-slate-400">Facilitating the transition of academic AI research into viable commercial products and services.</p>
                </div>
                <div class="glass-card p-6 rounded-xl border border-slate-800 bg-slate-800/40">
                    <h3 class="text-lg font-semibold text-white mb-2">Joint Research Initiatives</h3>
                    <p class="text-sm text-slate-400">Co-funded projects that address specific industry challenges using advanced AI methodologies.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="public" class="py-20 md:py-28 bg-slate-900/50 scroll-mt-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col lg:flex-row gap-12 items-center">
            <div class="lg:w-1/3 animate-fade-up">
                <div class="w-16 h-16 rounded-2xl bg-teal-500/10 flex items-center justify-center mb-6 text-teal-500 text-4xl">
                    ≡ƒîì
                </div>
                <h2 class="text-3xl font-bold text-white mb-4">For the Public</h2>
                <p class="text-slate-300 leading-relaxed mb-6">
                    Public programs ensure that AI knowledge extends beyond classrooms to benefit communities, parents, and citizens across Khyber Pakhtunkhwa.
                </p>
                <x-public.btn variant="outline" size="sm" href="/contact">Enquire Now</x-public.btn>
            </div>
            <div class="lg:w-2/3 grid grid-cols-1 md:grid-cols-2 gap-6 animate-fade-up stagger-1">
                <div class="glass-card p-6 rounded-xl border border-slate-800 bg-slate-800/40">
                    <h3 class="text-lg font-semibold text-white mb-2">Public AI Awareness Seminars</h3>
                    <p class="text-sm text-slate-400">Accessible talks and seminars aimed at demystifying AI and discussing its societal impacts.</p>
                </div>
                <div class="glass-card p-6 rounded-xl border border-slate-800 bg-slate-800/40">
                    <h3 class="text-lg font-semibold text-white mb-2">Community Workshops</h3>
                    <p class="text-sm text-slate-400">Hands-on community sessions focusing on digital literacy and safe engagement with AI technologies.</p>
                </div>
                <div class="glass-card p-6 rounded-xl border border-slate-800 bg-slate-800/40">
                    <h3 class="text-lg font-semibold text-white mb-2">Online Learning Resources</h3>
                    <p class="text-sm text-slate-400">A curated portal of free courses, videos, and articles available to everyone eager to learn about AI.</p>
                </div>
                <div class="glass-card p-6 rounded-xl border border-slate-800 bg-slate-800/40">
                    <h3 class="text-lg font-semibold text-white mb-2">AI Literacy for Parents</h3>
                    <p class="text-sm text-slate-400">Guiding parents on how to support their children's learning in an increasingly AI-driven educational landscape.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="animate-fade-up">
    <x-public.cta-banner title="Find the Right Program for You" subtitle="Join Zehanat today and take the first step towards AI excellence in education.">
        <x-public.btn variant="primary" size="lg" href="/contact">Contact Us</x-public.btn>
        <x-public.btn variant="outline" size="lg" href="/membership">Membership</x-public.btn>
    </x-public.cta-banner>
</div>
@endsection
