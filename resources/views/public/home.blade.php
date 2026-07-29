@extends('layouts.public')

@section('title', 'Home - Zehanat | KP Society for AI in Education')
@section('meta_description', 'Zehanat - The Khyber Pakhtunkhwa Society for AI in Education. Bringing Artificial Intelligence to Every Classroom.')

@section('content')
    <!-- Section 1: Engitech Light Hero -->
    <x-public.hero 
        title="Transforming Education Through Artificial Intelligence" 
        subtitle="The Khyber Pakhtunkhwa Society for AI in Education" 
        tagline="Empowering educators, students, researchers and institutions across KP under Abdul Wali Khan University Mardan.">
        <x-public.btn variant="primary" size="lg" href="/membership">Become a Member</x-public.btn>
        <x-public.btn variant="primary2" size="lg" href="/programs">Explore Programs</x-public.btn>
    </x-public.hero>

    <!-- Section 2: Welcome Note & Leadership Vision -->
    <section class="py-20 lg:py-28 bg-white relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                
                <!-- Text Column -->
                <div class="lg:col-span-7 animate-fade-up">
                    <x-public.section-heading 
                        tag="ABOUT ZEHANAT"
                        title="Closing the AI Knowledge Gap in Khyber Pakhtunkhwa" 
                        align="left" 
                    />
                    
                    <div class="text-[#5e6278] mt-6 space-y-4 text-sm sm:text-base leading-relaxed">
                        <p>
                            Artificial Intelligence is no longer a distant idea — it is already reshaping how the world learns, works, and innovates. Across Pakistan and here in Khyber Pakhtunkhwa, educational institutions are eager to lead, but enthusiasm alone is not enough. What our schools, colleges, and universities need is deep AI literacy.
                        </p>
                        <p>
                            <strong class="text-[#182433]">Zehanat</strong> exists to bridge that critical gap. Hosted by Abdul Wali Khan University Mardan (AWKUM), we bring together educators, researchers, students, and industry partners to make AI understandable, practical, and beneficial across all levels of education.
                        </p>
                    </div>

                    <div class="mt-8 flex flex-wrap items-center gap-4">
                        <x-public.btn variant="primary" size="md" href="/about">Read Our Story</x-public.btn>
                        <a href="tel:+929379230640" class="inline-flex items-center gap-3 px-5 py-3 rounded-xl bg-[#f4f6f9] border border-slate-200 text-xs font-heading font-extrabold uppercase text-[#182433] hover:text-[#0c5adb] transition-colors">
                            <svg class="w-4 h-4 text-[#0c5adb]" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                            Direct Helpline: +92 937 9230640
                        </a>
                    </div>
                </div>

                <!-- Right Column: Engitech Leadership Card Box -->
                <div class="lg:col-span-5 animate-fade-up stagger-2">
                    <div class="engitech-icon-box bg-white p-8 border border-slate-100 shadow-xl relative">
                        <div class="flex items-center gap-4 mb-6 pb-6 border-b border-slate-100">
                            <div class="w-14 h-14 rounded-2xl bg-[#0c5adb] flex items-center justify-center text-white text-2xl font-black shadow-lg shadow-blue-600/20">
                                VC
                            </div>
                            <div>
                                <h4 class="font-heading font-bold text-[#182433] text-lg">Patron & Founder</h4>
                                <p class="text-[#0c5adb] text-xs font-semibold">Vice Chancellor, AWKUM</p>
                            </div>
                        </div>

                        <div class="space-y-4 text-[#5e6278] text-sm leading-relaxed italic">
                            <p>
                                "Whether you are a headteacher wondering what AI means for your school, a college principal planning modern curricula, or a university researcher — Zehanat is your collaborative forum."
                            </p>
                        </div>

                        <div class="mt-6 pt-4 border-t border-slate-100 flex items-center justify-between text-xs text-slate-400 font-heading font-bold">
                            <span>AWKUM ACADEMIC LEADERSHIP</span>
                            <span class="text-[#0c5adb]">Mardan, KP</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Section 3: Our Six Pillars -->
    <section class="py-20 lg:py-28 bg-[#f4f6f9] border-y border-slate-200/60 relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <x-public.section-heading 
                tag="OUR FOUNDATION"
                title="The Six Pillars of Zehanat" 
                subtitle="Structuring our mission to empower education across Khyber Pakhtunkhwa." 
                align="center" 
            />

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mt-14">
                <div class="animate-fade-up stagger-1">
                    <x-public.pillar-card number="1" icon="🎓" title="AI Literacy & Awareness" description="Building foundational understanding of AI capabilities, tools, and limitations across schools, colleges, and universities." link="/pillars#literacy" />
                </div>
                <div class="animate-fade-up stagger-2">
                    <x-public.pillar-card number="2" icon="📚" title="Curriculum Integration" description="Embedding AI knowledge and skills into existing educational curricula from primary school through higher education." link="/pillars#curriculum" />
                </div>
                <div class="animate-fade-up stagger-3">
                    <x-public.pillar-card number="3" icon="👩‍🏫" title="Teacher & Faculty Training" description="Empowering educators with practical AI tools, modern teaching methods, and classroom integration strategies." link="/pillars#training" />
                </div>
                <div class="animate-fade-up stagger-4">
                    <x-public.pillar-card number="4" icon="🔬" title="Research & Innovation" description="Fostering applied AI research tailored to local regional needs and encouraging educational technology innovation." link="/pillars#research" />
                </div>
                <div class="animate-fade-up stagger-5">
                    <x-public.pillar-card number="5" icon="⚖️" title="Ethical & Responsible AI" description="Promoting awareness of AI ethics, data privacy, fairness, and responsible AI deployment in academic settings." link="/pillars#ethics" />
                </div>
                <div class="animate-fade-up stagger-6">
                    <x-public.pillar-card number="6" icon="🤝" title="Industry–Academia Partnership" description="Bridging the gap between academic learning and industry demand through practical exposure and joint projects." link="/pillars#industry" />
                </div>
            </div>

            <div class="mt-12 text-center">
                <x-public.btn variant="outline" size="md" href="/pillars">Explore All Pillars</x-public.btn>
            </div>
        </div>
    </section>

    <!-- Section 4: Target Sectors -->
    <section class="py-20 lg:py-28 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <x-public.section-heading 
                tag="JOIN THE MOVEMENT"
                title="Be Part of Khyber Pakhtunkhwa's AI Revolution" 
                align="center" 
            />

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mt-14">
                <!-- Card 1 -->
                <div class="engitech-icon-box flex flex-col justify-between group">
                    <div>
                        <div class="w-12 h-12 rounded-2xl bg-blue-50 text-[#0c5adb] flex items-center justify-center text-2xl mb-5">🧑‍🤝‍🧑</div>
                        <h3 class="text-lg font-heading font-bold text-[#182433] mb-2">Individual Members</h3>
                        <p class="text-[#5e6278] text-xs leading-relaxed">Join as an educator, researcher, student, or professional to shape AI adoption.</p>
                    </div>
                    <div class="mt-6 pt-4 border-t border-slate-100">
                        <a href="/membership" class="w-full inline-flex items-center justify-center py-2.5 bg-[#0c5adb] hover:bg-[#43baff] text-white text-xs font-heading font-extrabold uppercase rounded-xl transition-colors">Join Now</a>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="engitech-icon-box flex flex-col justify-between group">
                    <div>
                        <div class="w-12 h-12 rounded-2xl bg-cyan-50 text-cyan-600 flex items-center justify-center text-2xl mb-5">🏫</div>
                        <h3 class="text-lg font-heading font-bold text-[#182433] mb-2">Institutional Partners</h3>
                        <p class="text-[#5e6278] text-xs leading-relaxed">Bring your school, college, or university into the official Zehanat network.</p>
                    </div>
                    <div class="mt-6 pt-4 border-t border-slate-100">
                        <a href="/membership#institutions" class="w-full inline-flex items-center justify-center py-2.5 bg-slate-100 hover:bg-[#0c5adb] hover:text-white text-[#182433] text-xs font-heading font-extrabold uppercase rounded-xl transition-colors">Register</a>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="engitech-icon-box flex flex-col justify-between group">
                    <div>
                        <div class="w-12 h-12 rounded-2xl bg-amber-50 text-amber-600 flex items-center justify-center text-2xl mb-5">🎉</div>
                        <h3 class="text-lg font-heading font-bold text-[#182433] mb-2">Inaugural Launch</h3>
                        <p class="text-[#5e6278] text-xs leading-relaxed">Be part of our grand launch event at Abdul Wali Khan University Mardan.</p>
                    </div>
                    <div class="mt-6 pt-4 border-t border-slate-100">
                        <a href="/news-events" class="w-full inline-flex items-center justify-center py-2.5 bg-slate-100 hover:bg-[#0c5adb] hover:text-white text-[#182433] text-xs font-heading font-extrabold uppercase rounded-xl transition-colors">Learn More</a>
                    </div>
                </div>

                <!-- Card 4 -->
                <div class="engitech-icon-box flex flex-col justify-between group">
                    <div>
                        <div class="w-12 h-12 rounded-2xl bg-red-50 text-red-600 flex items-center justify-center text-2xl mb-5">📋</div>
                        <h3 class="text-lg font-heading font-bold text-[#182433] mb-2">Explore Programs</h3>
                        <p class="text-[#5e6278] text-xs leading-relaxed">Discover tailored AI programs for schools, colleges, universities, and industry.</p>
                    </div>
                    <div class="mt-6 pt-4 border-t border-slate-100">
                        <a href="/programs" class="w-full inline-flex items-center justify-center py-2.5 bg-slate-100 hover:bg-[#0c5adb] hover:text-white text-[#182433] text-xs font-heading font-extrabold uppercase rounded-xl transition-colors">View Programs</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section 5: Stats Counter Bar -->
    <section class="py-16 bg-[#f4f6f9] border-y border-slate-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                <x-public.stat-counter number="50" label="Partner Institutions" suffix="+" />
                <x-public.stat-counter number="500" label="Active Members" suffix="+" />
                <x-public.stat-counter number="30" label="Planned Workshops" suffix="+" />
                <x-public.stat-counter number="6" label="Core AI Pillars" suffix="" />
            </div>
        </div>
    </section>

    <!-- Section 6: Latest News & Events -->
    <section class="py-20 lg:py-28 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col sm:flex-row sm:items-end justify-between mb-12 gap-4">
                <x-public.section-heading 
                    tag="HAPPENINGS"
                    title="News & Events" 
                    align="left" 
                />
                <x-public.btn variant="ghost" size="md" href="/news-events">View All Events &rarr;</x-public.btn>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="animate-fade-up stagger-1">
                    <x-public.event-card date="TBD" month="2026" title="Zehanat Launch Event" description="The official launch of the Khyber Pakhtunkhwa Society for AI in Education at AWKUM." link="/news-events" />
                </div>
                <div class="animate-fade-up stagger-2">
                    <x-public.event-card date="TBD" month="2026" title="AI in Education Workshop" description="Introductory workshop for educators on understanding and using AI tools effectively." link="/news-events" />
                </div>
                <div class="animate-fade-up stagger-3">
                    <x-public.event-card date="TBD" month="2026" title="Member Registration Drive" description="Open registration for individual members and institutional partners across KP." link="/news-events" />
                </div>
            </div>
        </div>
    </section>

    <!-- Section 7: CTA Banner -->
    <x-public.cta-banner 
        title="Ready to Shape the Future of AI in Education?" 
        subtitle="Join Zehanat today and lead the AI revolution in Khyber Pakhtunkhwa's classrooms.">
        <x-public.btn variant="primary2" size="lg" href="/membership">Become a Member</x-public.btn>
        <a href="/contact" class="inline-flex items-center justify-center px-7 py-3 bg-white/10 hover:bg-white/20 text-white font-heading font-extrabold text-xs uppercase tracking-wider rounded-xl border border-white/20 transition-all">Contact Us</a>
    </x-public.cta-banner>

@endsection
