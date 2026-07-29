@extends('layouts.public')

@section('title', 'Home - Zehanat | KP Society for AI in Education')
@section('meta_description', 'Zehanat - The Khyber Pakhtunkhwa Society for AI in Education. Bringing Artificial Intelligence to Every Classroom.')

@section('content')
    <!-- Section 1: Light Hero -->
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
                            <strong class="text-[#1b1d21]">Zehanat</strong> exists to bridge that critical gap. Hosted by Abdul Wali Khan University Mardan (AWKUM), we bring together educators, researchers, students, and industry partners to make AI understandable, practical, and beneficial across all levels of education.
                        </p>
                    </div>

                    <div class="mt-8 flex flex-wrap items-center gap-4">
                        <x-public.btn variant="primary" size="md" href="/about">Read Our Story</x-public.btn>
                        <a href="tel:+929379230640" class="inline-flex items-center gap-3 px-5 py-3 rounded-xl bg-[#f4f6f9] border border-slate-200 text-xs font-heading font-extrabold uppercase text-[#1b1d21] hover:text-[#43baff] transition-colors">
                            <svg class="w-4 h-4 text-[#43baff]" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                            Direct Helpline: +92 937 9230640
                        </a>
                    </div>
                </div>

                <!-- Right Column: Leadership Card Box -->
                <div class="lg:col-span-5 animate-fade-up stagger-2">
                    <div class="engitech-icon-box bg-white p-8 border border-slate-100 shadow-xl relative">
                        <!-- Full Image -->
                        <div class="w-full h-64 mb-6 rounded-xl overflow-hidden border border-slate-100">
                            <img src="{{ asset('images/vc_face.png') }}" alt="Prof. Dr. Jamil Ahmad" class="w-full h-full object-cover object-center">
                        </div>

                        <div class="flex items-center gap-4 mb-6 pb-6 border-b border-slate-100">
                            <div>
                                <h4 class="font-heading font-bold text-[#1b1d21] text-lg">Prof. Dr. Jamil Ahmad</h4>
                                <p class="text-[#43baff] text-xs font-semibold uppercase tracking-wider">Patron & Founder, Vice Chancellor AWKUM</p>
                            </div>
                        </div>

                        <div class="space-y-4 text-[#5e6278] text-sm leading-relaxed italic">
                            <p>
                                "Whether you are a headteacher wondering what AI means for your school, a college principal planning modern curricula, or a university researcher — Zehanat is your collaborative forum."
                            </p>
                        </div>

                        <div class="mt-6 pt-4 border-t border-slate-100 flex items-center justify-between text-xs text-slate-400 font-heading font-bold">
                            <span>AWKUM ACADEMIC LEADERSHIP</span>
                            <span class="text-[#43baff]">Mardan, KP</span>
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
                        <div class="w-12 h-12 rounded-2xl bg-blue-50 text-[#43baff] flex items-center justify-center text-2xl mb-5">🧑‍🤝‍🧑</div>
                        <h3 class="text-lg font-heading font-bold text-[#1b1d21] mb-2">Individual Members</h3>
                        <p class="text-[#5e6278] text-xs leading-relaxed">Join as an educator, researcher, student, or professional to shape AI adoption.</p>
                    </div>
                    <div class="mt-6 pt-4 border-t border-slate-100">
                        <a href="/membership" class="w-full inline-flex items-center justify-center py-2.5 bg-[#43baff] hover:bg-[#43baff] text-white text-xs font-heading font-extrabold uppercase rounded-xl transition-colors">Join Now</a>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="engitech-icon-box flex flex-col justify-between group">
                    <div>
                        <div class="w-12 h-12 rounded-2xl bg-cyan-50 text-cyan-600 flex items-center justify-center text-2xl mb-5">🏫</div>
                        <h3 class="text-lg font-heading font-bold text-[#1b1d21] mb-2">Institutional Partners</h3>
                        <p class="text-[#5e6278] text-xs leading-relaxed">Bring your school, college, or university into the official Zehanat network.</p>
                    </div>
                    <div class="mt-6 pt-4 border-t border-slate-100">
                        <a href="/membership#institutions" class="w-full inline-flex items-center justify-center py-2.5 bg-slate-100 hover:bg-[#43baff] hover:text-white text-[#1b1d21] text-xs font-heading font-extrabold uppercase rounded-xl transition-colors">Register</a>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="engitech-icon-box flex flex-col justify-between group">
                    <div>
                        <div class="w-12 h-12 rounded-2xl bg-amber-50 text-amber-600 flex items-center justify-center text-2xl mb-5">🎉</div>
                        <h3 class="text-lg font-heading font-bold text-[#1b1d21] mb-2">Inaugural Launch</h3>
                        <p class="text-[#5e6278] text-xs leading-relaxed">Be part of our grand launch event at Abdul Wali Khan University Mardan.</p>
                    </div>
                    <div class="mt-6 pt-4 border-t border-slate-100">
                        <a href="/news-events" class="w-full inline-flex items-center justify-center py-2.5 bg-slate-100 hover:bg-[#43baff] hover:text-white text-[#1b1d21] text-xs font-heading font-extrabold uppercase rounded-xl transition-colors">Learn More</a>
                    </div>
                </div>

                <!-- Card 4 -->
                <div class="engitech-icon-box flex flex-col justify-between group">
                    <div>
                        <div class="w-12 h-12 rounded-2xl bg-red-50 text-red-600 flex items-center justify-center text-2xl mb-5">📋</div>
                        <h3 class="text-lg font-heading font-bold text-[#1b1d21] mb-2">Explore Programs</h3>
                        <p class="text-[#5e6278] text-xs leading-relaxed">Discover tailored AI programs for schools, colleges, universities, and industry.</p>
                    </div>
                    <div class="mt-6 pt-4 border-t border-slate-100">
                        <a href="/programs" class="w-full inline-flex items-center justify-center py-2.5 bg-slate-100 hover:bg-[#43baff] hover:text-white text-[#1b1d21] text-xs font-heading font-extrabold uppercase rounded-xl transition-colors">View Programs</a>
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
                <div class="animate-fade-up stagger-4">
                    <x-public.event-card date="15" month="AUG" title="AI Ethics in Curriculum" description="A seminar on integrating ethical AI practices into modern educational curriculums." link="/news-events" />
                </div>
                <div class="animate-fade-up stagger-5">
                    <x-public.event-card date="28" month="AUG" title="Tech Innovators Meetup" description="Networking event for educators and tech enthusiasts to share AI innovation ideas." link="/news-events" />
                </div>
                <div class="animate-fade-up stagger-6">
                    <x-public.event-card date="10" month="SEP" title="Student Hackathon 2026" description="An inter-college AI hackathon aimed at solving local educational challenges." link="/news-events" />
                </div>
            </div>
        </div>
    </section>

    <!-- Section 6.1: Image Card Carousel -->
    @php
        $carouselItems = [
            ['title' => 'AI Lab Setup', 'category' => 'Infrastructure', 'image' => asset('images/dummy/project_1.jpg'), 'link' => '#'],
            ['title' => 'Educator Workshop', 'category' => 'Training', 'image' => asset('images/dummy/project_2.jpg'), 'link' => '#'],
            ['title' => 'Student Outreach', 'category' => 'Community', 'image' => asset('images/dummy/project_3.jpg'), 'link' => '#'],
            ['title' => 'Curriculum Design', 'category' => 'Academics', 'image' => asset('images/dummy/stat_1.jpg'), 'link' => '#'],
        ];
    @endphp
    <x-public.image-card-carousel tag="OUR INITIATIVES" title="Recent Projects & Programs" :items="$carouselItems" />

    <!-- Section 6.2: Icon Overlay Grid -->
    @php
        $iconItems = [
            ['label' => 'Research', 'icon' => '<svg class="w-8 h-8 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/></svg>', 'link' => '#'],
            ['label' => 'Development', 'icon' => '<svg class="w-8 h-8 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/></svg>', 'link' => '#'],
            ['label' => 'Training', 'icon' => '<svg class="w-8 h-8 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>', 'link' => '#'],
            ['label' => 'Outreach', 'icon' => '<svg class="w-8 h-8 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>', 'link' => '#'],
            ['label' => 'Ethics', 'icon' => '<svg class="w-8 h-8 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"/></svg>', 'link' => '#'],
            ['label' => 'Community', 'icon' => '<svg class="w-8 h-8 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.514"/></svg>', 'link' => '#'],
        ];
    @endphp
    <x-public.icon-overlay-grid tag="CORE PILLARS" title="Our Core Focus Areas" bgImage="{{ asset('images/dummy/tech_bg.jpg') }}" :items="$iconItems" />

    <!-- Section 6.3: Testimonial Slider -->
    @php
        $testiItems = [
            ['name' => 'Prof. Dr. Jamil Ahmad', 'role' => 'Vice Chancellor, AWKUM', 'quote' => 'Very well thought out and articulate communication. Clear milestones, deadlines and fast work. Patience. Infinite patience. No shortcuts. Even if the client is being careless. The best part...always solving problems with great original ideas!.', 'image' => null],
            ['name' => 'Dr. Ali Muhammad', 'role' => 'Head of AI Department', 'quote' => 'Patience. Infinite patience. No shortcuts. Very well thought out and articulate communication. Clear milestones, deadlines and fast work. Even if the client is being careless. The best part...always solving problems with great original ideas!.', 'image' => null],
            ['name' => 'Sarah Khan', 'role' => 'High School Teacher', 'quote' => 'The resources provided by Zehanat have completely transformed how I approach teaching. The AI tools are intuitive and the community support is unmatched.', 'image' => null]
        ];
    @endphp
    <x-public.testimonial-slider tag="TESTIMONIALS" title="What Educators Are Saying" :items="$testiItems" />

    <!-- Section 6.4: Feature Stat Grid -->
    @php
        $gridFeatures = [
            ['title' => 'Curriculum Design', 'description' => 'Our curriculum design service lets you prototype, test and validate your ideas.', 'icon' => '<svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>', 'link' => '#'],
            ['title' => 'Skill Development', 'description' => 'Our product design service lets you prototype, test and validate your ideas.', 'icon' => '<svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>', 'link' => '#'],
            ['title' => 'Data Analytics', 'description' => 'Our product design service lets you prototype, test and validate your ideas.', 'icon' => '<svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>', 'link' => '#'],
            ['title' => 'Cyber Security', 'description' => 'Our product design service lets you prototype, test and validate your ideas.', 'icon' => '<svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>', 'link' => '#'],
        ];
        $gridStats = [
            ['number' => '15', 'suffix' => '+', 'title' => 'Districts Reached', 'description' => 'To succeed, every software solution must be deeply integrated into the existing tech environment.', 'image' => asset('images/dummy/stat_1.jpg')],
            ['number' => '23', 'suffix' => 'k', 'title' => 'Happy Educators', 'description' => 'To succeed, every software solution must be deeply integrated into the existing tech environment.', 'image' => asset('images/dummy/stat_2.jpg')],
        ];
    @endphp
    <x-public.feature-stat-grid tag="WHY CHOOSE US" title="Design the Concept of Your Business Idea Now" :features="$gridFeatures" :stats="$gridStats" />

    <!-- Section 7: CTA Banner -->
    <x-public.cta-banner 
        title="Ready to Shape the Future of AI in Education?" 
        subtitle="Join Zehanat today and lead the AI revolution in Khyber Pakhtunkhwa's classrooms.">
        <x-public.btn variant="primary" size="lg" href="/membership">Become a Member</x-public.btn>
        <a href="/contact" class="inline-flex items-center justify-center px-7 py-3 bg-white/10 hover:bg-white/20 text-white font-heading font-extrabold text-xs uppercase tracking-wider rounded-xl border border-white/20 transition-all">Contact Us</a>
    </x-public.cta-banner>

@endsection
