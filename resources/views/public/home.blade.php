@extends('layouts.public')

@section('title', 'Home - Zehanat')
@section('meta_description', 'Zehanat - The Khyber Pakhtunkhwa Society for AI in Education')

@section('content')
    <!-- Section 1: Hero -->
    <x-public.hero 
        title="Transforming Education with Artificial Intelligence" 
        subtitle="The Khyber Pakhtunkhwa Society for AI in Education" 
        tagline="Empowering educators and students across the province.">
        <x-public.btn variant="primary" size="lg" href="/membership">Become a Member</x-public.btn>
        <x-public.btn variant="outline" size="lg" href="/programs">Explore Programs</x-public.btn>
    </x-public.hero>

    <!-- Section 2: Welcome Note -->
    <section class="py-20 md:py-28 bg-slate-950">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div class="animate-fade-up stagger-1">
                    <x-public.section-heading title="Welcome to Zehanat" subtitle="Closing the AI Knowledge Gap in Khyber Pakhtunkhwa" align="left" />
                    <div class="prose prose-invert prose-lg text-slate-300 mt-6">
                        <p class="mb-4">Artificial Intelligence is no longer a distant idea. It is already shaping how the world learns, works, farms, heals and governs. Across Pakistan, and here in Khyber Pakhtunkhwa, institutions are eager to take the lead — but enthusiasm alone is not enough. What most of our schools, colleges and even universities lack is not ambition; it is education about AI itself: what it is, what it can genuinely do, where its limits lie, and how to adopt it responsibly.</p>
                        <p class="mb-4">Zehanat exists to close that gap. We are a community of educators, researchers, students, administrators and industry partners, working under the academic leadership of Abdul Wali Khan University Mardan, to make AI understandable, practical and beneficial for every level of education in our province — from the primary classroom in a village school to the research laboratory of a university.</p>
                        <p>Whether you are a headteacher wondering what AI means for your school, a college principal planning new courses, a university officer looking to modernise administration, or an industrialist exploring automation — Zehanat is your forum. Join us.</p>
                    </div>
                </div>
                <div class="animate-fade-up stagger-2">
                    <div class="glass-card p-8 rounded-2xl border border-white/10 bg-slate-900/40 backdrop-blur-md relative overflow-hidden shadow-2xl">
                        <div class="absolute top-0 right-0 -mr-16 -mt-16 w-64 h-64 bg-teal-500/20 rounded-full blur-3xl"></div>
                        <div class="absolute bottom-0 left-0 -ml-16 -mb-16 w-64 h-64 bg-amber-500/20 rounded-full blur-3xl"></div>
                        <div class="relative z-10 flex flex-col gap-6">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 rounded-full bg-teal-500/20 flex items-center justify-center text-teal-400 text-2xl">🏫</div>
                                <div><h4 class="text-xl font-semibold text-white">Schools & Colleges</h4><p class="text-slate-400 text-sm">Empowering the next generation</p></div>
                            </div>
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 rounded-full bg-amber-500/20 flex items-center justify-center text-amber-400 text-2xl">🎓</div>
                                <div><h4 class="text-xl font-semibold text-white">Universities</h4><p class="text-slate-400 text-sm">Leading research and innovation</p></div>
                            </div>
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 rounded-full bg-blue-500/20 flex items-center justify-center text-blue-400 text-2xl">🤝</div>
                                <div><h4 class="text-xl font-semibold text-white">Industry Partners</h4><p class="text-slate-400 text-sm">Bridging theory and practice</p></div>
                            </div>
                            <div class="mt-4 pt-4 border-t border-slate-700/50">
                                <p class="text-slate-300 italic">"Making AI understandable, practical and beneficial for every level of education."</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section 3: Our Six Pillars Preview -->
    <section class="py-20 md:py-28 bg-slate-900/50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="animate-fade-up">
                <x-public.section-heading title="Our Six Pillars" subtitle="The foundation of our mission" align="center" />
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mt-12">
                <div class="animate-fade-up stagger-1">
                    <x-public.pillar-card number="1" icon="🎓" title="AI Literacy & Awareness" description="Building foundational understanding of AI concepts, capabilities, and limitations across all educational levels." />
                </div>
                <div class="animate-fade-up stagger-2">
                    <x-public.pillar-card number="2" icon="📚" title="Curriculum Integration" description="Embedding AI knowledge and skills into existing curricula from primary school through university." />
                </div>
                <div class="animate-fade-up stagger-3">
                    <x-public.pillar-card number="3" icon="👩‍🏫" title="Teacher & Faculty Training" description="Empowering educators with the knowledge and tools to teach AI effectively and use it in their practice." />
                </div>
                <div class="animate-fade-up stagger-4">
                    <x-public.pillar-card number="4" icon="🔬" title="Research & Innovation" description="Fostering AI research tailored to local needs and encouraging innovative educational applications." />
                </div>
                <div class="animate-fade-up stagger-5">
                    <x-public.pillar-card number="5" icon="⚖️" title="Ethical & Responsible AI" description="Promoting awareness of AI ethics, bias, privacy, and responsible deployment in educational settings." />
                </div>
                <div class="animate-fade-up stagger-6">
                    <x-public.pillar-card number="6" icon="🤝" title="Industry–Academia Partnership" description="Bridging the gap between academic learning and industry needs through collaboration and practical exposure." />
                </div>
            </div>
            <div class="mt-12 text-center animate-fade-up stagger-7">
                <x-public.btn variant="outline" size="md" href="/pillars">Learn More About Our Pillars</x-public.btn>
            </div>
        </div>
    </section>

    <!-- Section 4: Calls for Membership -->
    <section class="py-20 md:py-28 bg-slate-950 relative overflow-hidden">
        <!-- Background accents -->
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full max-w-4xl h-full opacity-30 pointer-events-none">
            <div class="absolute top-1/4 left-1/4 w-96 h-96 bg-teal-600/20 rounded-full blur-[100px]"></div>
            <div class="absolute bottom-1/4 right-1/4 w-96 h-96 bg-amber-600/20 rounded-full blur-[100px]"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="animate-fade-up">
                <x-public.section-heading title="Join the Movement" subtitle="Be part of Khyber Pakhtunkhwa's AI in Education revolution" align="center" />
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-6 mt-12">
                <!-- Card 1 -->
                <div class="glass-card p-6 rounded-2xl border border-white/10 bg-slate-900/60 hover:bg-slate-800/80 transition-all duration-300 flex flex-col h-full animate-fade-up stagger-1 group">
                    <div class="w-16 h-16 rounded-xl bg-teal-500/20 flex items-center justify-center text-4xl mb-6 group-hover:scale-110 transition-transform duration-300">🧑‍🤝‍🧑</div>
                    <h3 class="text-xl font-bold text-white mb-3">Become a Member</h3>
                    <p class="text-slate-400 text-sm flex-grow mb-6">Join as an individual educator, researcher, student, or professional. Shape the future of AI in education.</p>
                    <a href="/membership" class="inline-flex items-center justify-center px-4 py-2 bg-teal-500 hover:bg-teal-600 text-white font-medium rounded-lg transition-colors w-full">Join Now</a>
                </div>

                <!-- Card 2 -->
                <div class="glass-card p-6 rounded-2xl border border-white/10 bg-slate-900/60 hover:bg-slate-800/80 transition-all duration-300 flex flex-col h-full animate-fade-up stagger-2 group">
                    <div class="w-16 h-16 rounded-xl bg-amber-500/20 flex items-center justify-center text-4xl mb-6 group-hover:scale-110 transition-transform duration-300">🏫</div>
                    <h3 class="text-xl font-bold text-white mb-3">Register Your Institution</h3>
                    <p class="text-slate-400 text-sm flex-grow mb-6">Bring your school, college, or university into the Zehanat network. Access resources and training.</p>
                    <a href="/membership#institutions" class="inline-flex items-center justify-center px-4 py-2 bg-slate-700 hover:bg-slate-600 text-white font-medium rounded-lg transition-colors w-full border border-slate-600">Register</a>
                </div>

                <!-- Card 3 -->
                <div class="glass-card p-6 rounded-2xl border border-white/10 bg-slate-900/60 hover:bg-slate-800/80 transition-all duration-300 flex flex-col h-full animate-fade-up stagger-3 group">
                    <div class="w-16 h-16 rounded-xl bg-purple-500/20 flex items-center justify-center text-4xl mb-6 group-hover:scale-110 transition-transform duration-300">🎉</div>
                    <h3 class="text-xl font-bold text-white mb-3">Attend Our Launch Event</h3>
                    <p class="text-slate-400 text-sm flex-grow mb-6">Be part of our inaugural event. Connect with pioneers, learn from experts, and celebrate the beginning.</p>
                    <a href="/news-events" class="inline-flex items-center justify-center px-4 py-2 bg-slate-700 hover:bg-slate-600 text-white font-medium rounded-lg transition-colors w-full border border-slate-600">Learn More</a>
                </div>

                <!-- Card 4 -->
                <div class="glass-card p-6 rounded-2xl border border-white/10 bg-slate-900/60 hover:bg-slate-800/80 transition-all duration-300 flex flex-col h-full animate-fade-up stagger-4 group">
                    <div class="w-16 h-16 rounded-xl bg-blue-500/20 flex items-center justify-center text-4xl mb-6 group-hover:scale-110 transition-transform duration-300">📋</div>
                    <h3 class="text-xl font-bold text-white mb-3">Explore Our Programs</h3>
                    <p class="text-slate-400 text-sm flex-grow mb-6">Discover tailored programs for schools, colleges, universities, industry, and the public.</p>
                    <a href="/programs" class="inline-flex items-center justify-center px-4 py-2 bg-slate-700 hover:bg-slate-600 text-white font-medium rounded-lg transition-colors w-full border border-slate-600">View Programs</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Section 5: Stats Counter Bar -->
    <section class="py-12 bg-gradient-to-r from-slate-900 via-teal-950 to-slate-900 border-y border-teal-900/50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 divide-x divide-teal-800/50">
                <div class="animate-fade-up stagger-1 text-center px-4">
                    <x-public.stat-counter number="50" label="Partner Institutions" suffix="+" />
                </div>
                <div class="animate-fade-up stagger-2 text-center px-4">
                    <x-public.stat-counter number="500" label="Members" suffix="+" />
                </div>
                <div class="animate-fade-up stagger-3 text-center px-4">
                    <x-public.stat-counter number="30" label="Programs Planned" suffix="+" />
                </div>
                <div class="animate-fade-up stagger-4 text-center px-4">
                    <x-public.stat-counter number="5" label="Regions Covered" suffix="" />
                </div>
            </div>
        </div>
    </section>

    <!-- Section 6: Latest News & Events -->
    <section class="py-20 md:py-28 bg-slate-900/50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-end mb-12 animate-fade-up">
                <x-public.section-heading title="News & Events" subtitle="Stay updated with the latest happenings" align="left" />
                <div class="hidden md:block">
                    <x-public.btn variant="ghost" size="md" href="/news-events">View All Events &rarr;</x-public.btn>
                </div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="animate-fade-up stagger-1">
                    <x-public.event-card date="TBD" month="2025" title="Zehanat Launch Event" description="The official launch of the Khyber Pakhtunkhwa Society for AI in Education at AWKUM." link="/news-events" />
                </div>
                <div class="animate-fade-up stagger-2">
                    <x-public.event-card date="TBD" month="2025" title="AI in Education Workshop" description="Introductory workshop for educators on understanding and using AI tools." link="/news-events" />
                </div>
                <div class="animate-fade-up stagger-3">
                    <x-public.event-card date="TBD" month="2025" title="Member Registration Opens" description="Open registration for individual members and institutional partners." link="/news-events" />
                </div>
            </div>
            
            <div class="mt-8 text-center md:hidden animate-fade-up stagger-4">
                <x-public.btn variant="outline" size="md" href="/news-events">View All Events</x-public.btn>
            </div>
        </div>
    </section>

    <!-- Section 7: CTA Banner -->
    <x-public.cta-banner title="Ready to Shape the Future of Education?" subtitle="Join Zehanat today and be part of the AI revolution in Khyber Pakhtunkhwa's classrooms.">
        <x-public.btn variant="secondary" size="lg" href="/membership">Become a Member</x-public.btn>
        <a href="/contact" class="inline-flex items-center justify-center px-7 py-3 bg-white/20 hover:bg-white/30 text-white border border-white/30 rounded-full font-semibold transition-all duration-300 backdrop-blur-sm">Contact Us</a>
    </x-public.cta-banner>

@endsection
