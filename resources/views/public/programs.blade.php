@extends('layouts.public')

@section('title', 'Our Programs - Zehanat')
@section('meta_description', 'Tailored AI education programs for schools, colleges, universities, industry, and the public.')

@section('content')
<x-public.page-banner title="Our Programs" :breadcrumbs="[['label' => 'Home', 'url' => '/'], ['label' => 'Programs']]">
    Structured AI education programs tailored for every level of learning in Khyber Pakhtunkhwa.
</x-public.page-banner>

<section class="py-20 lg:py-28 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-14">
            <x-public.section-heading tag="TAILORED INITIATIVES" title="Programs For Every Level" align="center" />
            <p class="text-[#5e6278] text-sm sm:text-base mt-4 leading-relaxed">
                Zehanat offers structured programs designed to meet the unique needs of different educational sectors across the province.
            </p>
        </div>

        <div class="flex flex-wrap justify-center gap-3 mb-16 font-heading text-xs font-bold uppercase tracking-wider">
            <a href="#schools" class="px-5 py-2.5 rounded-xl border border-slate-200 bg-[#f4f6f9] text-[#1b1d21] hover:border-[#43baff] hover:text-[#43baff] transition-all">Schools</a>
            <a href="#colleges" class="px-5 py-2.5 rounded-xl border border-slate-200 bg-[#f4f6f9] text-[#1b1d21] hover:border-[#43baff] hover:text-[#43baff] transition-all">Colleges</a>
            <a href="#universities" class="px-5 py-2.5 rounded-xl border border-slate-200 bg-[#f4f6f9] text-[#1b1d21] hover:border-[#43baff] hover:text-[#43baff] transition-all">Universities</a>
            <a href="#industry" class="px-5 py-2.5 rounded-xl border border-slate-200 bg-[#f4f6f9] text-[#1b1d21] hover:border-[#43baff] hover:text-[#43baff] transition-all">Industry</a>
            <a href="#public" class="px-5 py-2.5 rounded-xl border border-slate-200 bg-[#f4f6f9] text-[#1b1d21] hover:border-[#43baff] hover:text-[#43baff] transition-all">Public</a>
        </div>
    </div>
</section>

<!-- Schools Program -->
<section id="schools" class="py-20 lg:py-28 bg-[#f4f6f9] border-t border-slate-200 scroll-mt-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
            <div class="lg:col-span-4">
                <div class="w-16 h-16 rounded-2xl bg-blue-50 border border-blue-100 text-primary flex items-center justify-center mb-6 text-3xl">
                    🏫
                </div>
                <div class="engitech-tag mb-2">PRIMARY & SECONDARY</div>
                <h2 class="text-3xl font-heading font-extrabold text-[#1b1d21] mb-4">For Schools</h2>
                <p class="text-[#5e6278] text-sm leading-relaxed mb-6">
                    Our schools program focuses on introducing AI concepts to young learners in age-appropriate ways, while equipping teachers with the tools and confidence to bring AI into their classrooms.
                </p>
                <x-public.btn variant="outline" size="sm" href="/contact">Inquire For Schools</x-public.btn>
            </div>
            <div class="lg:col-span-8 grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="engitech-icon-box p-6 bg-white border border-slate-100 hover:shadow-xl transition-shadow rounded-xl">
                    <h3 class="text-base font-heading font-bold text-[#1b1d21] mb-2">Teacher AI Workshops</h3>
                    <p class="text-xs text-[#5e6278] leading-relaxed">Interactive sessions designed to demystify AI and showcase its practical applications in lesson planning.</p>
                </div>
                <div class="engitech-icon-box p-6 bg-white border border-slate-100 hover:shadow-xl transition-shadow rounded-xl">
                    <h3 class="text-base font-heading font-bold text-[#1b1d21] mb-2">Student AI Discovery Days</h3>
                    <p class="text-xs text-[#5e6278] leading-relaxed">Fun, hands-on events where students interact with AI tools and understand the technology shaping their future.</p>
                </div>
                <div class="engitech-icon-box p-6 bg-white border border-slate-100 hover:shadow-xl transition-shadow rounded-xl">
                    <h3 class="text-base font-heading font-bold text-[#1b1d21] mb-2">Model Lesson Plans</h3>
                    <p class="text-xs text-[#5e6278] leading-relaxed">Curated materials that teachers can directly integrate into their existing curriculum across various subjects.</p>
                </div>
                <div class="engitech-icon-box p-6 bg-white border border-slate-100 hover:shadow-xl transition-shadow rounded-xl">
                    <h3 class="text-base font-heading font-bold text-[#1b1d21] mb-2">Readiness Assessment</h3>
                    <p class="text-xs text-[#5e6278] leading-relaxed">Comprehensive evaluation to help schools understand their current infrastructure and readiness for AI integration.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Colleges Program -->
<section id="colleges" class="py-20 lg:py-28 bg-white border-t border-slate-100 scroll-mt-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
            <div class="lg:col-span-8 lg:order-2 grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="engitech-icon-box p-6 bg-[#f4f6f9] border border-slate-200 hover:shadow-xl transition-shadow rounded-xl">
                    <h3 class="text-base font-heading font-bold text-[#1b1d21] mb-2">AI Integration in Courses</h3>
                    <p class="text-xs text-[#5e6278] leading-relaxed">Strategies for incorporating AI modules into diverse academic streams, not just computer science.</p>
                </div>
                <div class="engitech-icon-box p-6 bg-[#f4f6f9] border border-slate-200 hover:shadow-xl transition-shadow rounded-xl">
                    <h3 class="text-base font-heading font-bold text-[#1b1d21] mb-2">Faculty Development</h3>
                    <p class="text-xs text-[#5e6278] leading-relaxed">In-depth training for college lecturers to master AI educational tools and pedagogical approaches.</p>
                </div>
                <div class="engitech-icon-box p-6 bg-[#f4f6f9] border border-slate-200 hover:shadow-xl transition-shadow rounded-xl">
                    <h3 class="text-base font-heading font-bold text-[#1b1d21] mb-2">Student AI Competitions</h3>
                    <p class="text-xs text-[#5e6278] leading-relaxed">Encouraging innovation through guided AI projects and inter-college technology competitions.</p>
                </div>
                <div class="engitech-icon-box p-6 bg-[#f4f6f9] border border-slate-200 hover:shadow-xl transition-shadow rounded-xl">
                    <h3 class="text-base font-heading font-bold text-[#1b1d21] mb-2">Career Guidance Seminars</h3>
                    <p class="text-xs text-[#5e6278] leading-relaxed">Seminars connecting students with industry professionals to explore emerging career opportunities in AI.</p>
                </div>
            </div>
            <div class="lg:col-span-4 lg:order-1">
                <div class="w-16 h-16 rounded-2xl bg-amber-50 border border-amber-100 text-amber-500 flex items-center justify-center mb-6 text-3xl">
                    🏛️
                </div>
                <div class="engitech-tag mb-2">HIGHER SECONDARY & DEGREE</div>
                <h2 class="text-3xl font-heading font-extrabold text-[#1b1d21] mb-4">For Colleges</h2>
                <p class="text-[#5e6278] text-sm leading-relaxed mb-6">
                    College-level programs bridge the gap between basic AI awareness and deeper technical understanding, preparing students for university studies and early career paths.
                </p>
                <x-public.btn variant="outline" size="sm" href="/contact">Inquire For Colleges</x-public.btn>
            </div>
        </div>
    </div>
</section>

<!-- Universities Program -->
<section id="universities" class="py-20 lg:py-28 bg-[#f4f6f9] border-t border-slate-200 scroll-mt-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
            <div class="lg:col-span-4">
                <div class="w-16 h-16 rounded-2xl bg-teal-50 border border-teal-100 text-teal-600 flex items-center justify-center mb-6 text-3xl">
                    🎓
                </div>
                <div class="engitech-tag mb-2">HIGHER EDUCATION & RESEARCH</div>
                <h2 class="text-3xl font-heading font-extrabold text-[#1b1d21] mb-4">For Universities</h2>
                <p class="text-[#5e6278] text-sm leading-relaxed mb-6">
                    University programs support advanced AI education, research collaboration, and institutional modernisation through AI-powered tools and methodologies.
                </p>
                <x-public.btn variant="outline" size="sm" href="/contact">Inquire For Universities</x-public.btn>
            </div>
            <div class="lg:col-span-8 grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="engitech-icon-box p-6 bg-white border border-slate-100 hover:shadow-xl transition-shadow rounded-xl">
                    <h3 class="text-base font-heading font-bold text-[#1b1d21] mb-2">Curriculum Consulting</h3>
                    <p class="text-xs text-[#5e6278] leading-relaxed">Expert guidance on modernising degree programs with cutting-edge AI technologies and ethics.</p>
                </div>
                <div class="engitech-icon-box p-6 bg-white border border-slate-100 hover:shadow-xl transition-shadow rounded-xl">
                    <h3 class="text-base font-heading font-bold text-[#1b1d21] mb-2">Research Collaboration</h3>
                    <p class="text-xs text-[#5e6278] leading-relaxed">Facilitating interdisciplinary AI research projects and connecting academic researchers with industry needs.</p>
                </div>
                <div class="engitech-icon-box p-6 bg-white border border-slate-100 hover:shadow-xl transition-shadow rounded-xl">
                    <h3 class="text-base font-heading font-bold text-[#1b1d21] mb-2">AI in Administration</h3>
                    <p class="text-xs text-[#5e6278] leading-relaxed">Exploring and implementing AI solutions to streamline admissions, student support, and efficiency.</p>
                </div>
                <div class="engitech-icon-box p-6 bg-white border border-slate-100 hover:shadow-xl transition-shadow rounded-xl">
                    <h3 class="text-base font-heading font-bold text-[#1b1d21] mb-2">Graduate Fellowships</h3>
                    <p class="text-xs text-[#5e6278] leading-relaxed">Supporting exceptional graduate students conducting impactful research in AI education and applications.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Industry Program -->
<section id="industry" class="py-20 lg:py-28 bg-white border-t border-slate-100 scroll-mt-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
            <div class="lg:col-span-8 lg:order-2 grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="engitech-icon-box p-6 bg-[#f4f6f9] border border-slate-200 hover:shadow-xl transition-shadow rounded-xl">
                    <h3 class="text-base font-heading font-bold text-[#1b1d21] mb-2">Industry-Academia Liaison</h3>
                    <p class="text-xs text-[#5e6278] leading-relaxed">Bridging the gap between corporate technology needs and academic research capabilities.</p>
                </div>
                <div class="engitech-icon-box p-6 bg-[#f4f6f9] border border-slate-200 hover:shadow-xl transition-shadow rounded-xl">
                    <h3 class="text-base font-heading font-bold text-[#1b1d21] mb-2">AI Workforce Training</h3>
                    <p class="text-xs text-[#5e6278] leading-relaxed">Tailored upskilling programs for corporate teams to leverage AI tools in their daily workflows.</p>
                </div>
                <div class="engitech-icon-box p-6 bg-[#f4f6f9] border border-slate-200 hover:shadow-xl transition-shadow rounded-xl">
                    <h3 class="text-base font-heading font-bold text-[#1b1d21] mb-2">Technology Transfer</h3>
                    <p class="text-xs text-[#5e6278] leading-relaxed">Facilitating the transition of academic AI research into viable commercial products and services.</p>
                </div>
                <div class="engitech-icon-box p-6 bg-[#f4f6f9] border border-slate-200 hover:shadow-xl transition-shadow rounded-xl">
                    <h3 class="text-base font-heading font-bold text-[#1b1d21] mb-2">Joint Research Initiatives</h3>
                    <p class="text-xs text-[#5e6278] leading-relaxed">Co-funded projects that address specific industry challenges using advanced AI methodologies.</p>
                </div>
            </div>
            <div class="lg:col-span-4 lg:order-1">
                <div class="w-16 h-16 rounded-2xl bg-purple-50 border border-purple-100 text-purple-600 flex items-center justify-center mb-6 text-3xl">
                    🏢
                </div>
                <div class="engitech-tag mb-2">CORPORATE & BUSINESS</div>
                <h2 class="text-3xl font-heading font-extrabold text-[#1b1d21] mb-4">For Industry</h2>
                <p class="text-[#5e6278] text-sm leading-relaxed mb-6">
                    Industry programs connect businesses with educational institutions, creating pathways for practical AI adoption and workforce development.
                </p>
                <x-public.btn variant="outline" size="sm" href="/contact">Inquire For Industry</x-public.btn>
            </div>
        </div>
    </div>
</section>

<!-- Public Program -->
<section id="public" class="py-20 lg:py-28 bg-[#f4f6f9] border-t border-slate-200 scroll-mt-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
            <div class="lg:col-span-4">
                <div class="w-16 h-16 rounded-2xl bg-rose-50 border border-rose-100 text-rose-500 flex items-center justify-center mb-6 text-3xl">
                    🌍
                </div>
                <div class="engitech-tag mb-2">COMMUNITY & SOCIETY</div>
                <h2 class="text-3xl font-heading font-extrabold text-[#1b1d21] mb-4">For the Public</h2>
                <p class="text-[#5e6278] text-sm leading-relaxed mb-6">
                    Public programs ensure that AI knowledge extends beyond classrooms to benefit communities, parents, and citizens across Khyber Pakhtunkhwa.
                </p>
                <x-public.btn variant="outline" size="sm" href="/contact">Inquire For Public</x-public.btn>
            </div>
            <div class="lg:col-span-8 grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="engitech-icon-box p-6 bg-white border border-slate-100 hover:shadow-xl transition-shadow rounded-xl">
                    <h3 class="text-base font-heading font-bold text-[#1b1d21] mb-2">AI Awareness Seminars</h3>
                    <p class="text-xs text-[#5e6278] leading-relaxed">Accessible talks and seminars aimed at demystifying AI and discussing its societal impacts.</p>
                </div>
                <div class="engitech-icon-box p-6 bg-white border border-slate-100 hover:shadow-xl transition-shadow rounded-xl">
                    <h3 class="text-base font-heading font-bold text-[#1b1d21] mb-2">Community Workshops</h3>
                    <p class="text-xs text-[#5e6278] leading-relaxed">Hands-on community sessions focusing on digital literacy and safe engagement with AI technologies.</p>
                </div>
                <div class="engitech-icon-box p-6 bg-white border border-slate-100 hover:shadow-xl transition-shadow rounded-xl">
                    <h3 class="text-base font-heading font-bold text-[#1b1d21] mb-2">Online Learning Resources</h3>
                    <p class="text-xs text-[#5e6278] leading-relaxed">A curated portal of free courses, videos, and articles available to everyone eager to learn about AI.</p>
                </div>
                <div class="engitech-icon-box p-6 bg-white border border-slate-100 hover:shadow-xl transition-shadow rounded-xl">
                    <h3 class="text-base font-heading font-bold text-[#1b1d21] mb-2">AI Literacy for Parents</h3>
                    <p class="text-xs text-[#5e6278] leading-relaxed">Guiding parents on how to support their children's learning in an increasingly AI-driven educational landscape.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Call to Action -->
<x-public.cta-banner title="Find the Right Program for You" subtitle="Join Zehanat today and take the first step towards AI excellence in education.">
    <x-public.btn variant="primary" size="lg" href="/membership">Become a Member</x-public.btn>
</x-public.cta-banner>

@endsection
