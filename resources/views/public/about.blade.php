@extends('layouts.public')

@section('title', 'About - Zehanat')
@section('meta_description', 'About Zehanat - Our story, leadership, and the vision driving AI education in Khyber Pakhtunkhwa.')

@section('content')
    <!-- Section 1: Page Banner -->
    <x-public.page-banner title="About Zehanat" :breadcrumbs="[['label' => 'Home', 'url' => '/'], ['label' => 'About Zehanat']]">
        Our story, leadership, and the academic vision driving AI education in Khyber Pakhtunkhwa.
    </x-public.page-banner>

    <!-- Section 2: Our Story -->
    <section id="our-story" class="py-20 lg:py-28 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <x-public.section-heading tag="OUR STORY" title="How We Started & Where We Are Heading" align="center" />
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 mt-14 items-center">
                <div class="animate-fade-up stagger-1 text-[#5e6278] text-sm sm:text-base leading-relaxed space-y-4">
                    <p>Zehanat — meaning 'intelligence' (ذہانت) in Urdu — was founded with a clear conviction: that Artificial Intelligence should not remain the privilege of elite institutions or distant countries. Every school in Swat, every college in Peshawar, every university across Khyber Pakhtunkhwa deserves to understand, engage with, and benefit from this transformative technology.</p>
                    <p>Hosted by Abdul Wali Khan University Mardan (AWKUM), one of the province's leading public universities, Zehanat brings together educators, researchers, students, administrators, and industry partners under one banner. Together, we are building a future where AI literacy is as fundamental as reading and writing.</p>
                    <p>Our name was chosen with care. 'Zehanat' carries warmth and cultural familiarity, avoiding intimidating jargon while pointing clearly to our mission. The English subtitle — The Khyber Pakhtunkhwa Society for AI in Education — explains our scope for formal and international audiences.</p>
                </div>
                
                <div class="animate-fade-up stagger-2 relative">
                    <!-- Timeline Visual -->
                    <div class="absolute left-[27px] top-4 bottom-4 w-[2px] bg-slate-200 rounded-full"></div>
                    
                    <div class="space-y-8">
                        <div class="relative pl-16">
                            <div class="absolute left-0 top-1 w-14 h-14 rounded-2xl bg-white border-2 border-[#43baff] flex items-center justify-center z-10 shadow-md">
                                <span class="text-xs font-heading font-extrabold text-[#43baff]">2026</span>
                            </div>
                            <div class="engitech-icon-box p-6 bg-white border border-slate-100">
                                <h4 class="text-lg font-heading font-bold text-[#1b1d21] mb-1">Society Founded</h4>
                                <p class="text-slate-400 text-xs">The vision takes shape with the establishment of Zehanat.</p>
                            </div>
                        </div>
                        
                        <div class="relative pl-16">
                            <div class="absolute left-0 top-1 w-14 h-14 rounded-2xl bg-white border-2 border-[#43baff] flex items-center justify-center z-10 shadow-md">
                                <span class="text-xs font-heading font-extrabold text-[#1b1d21]">AWKUM</span>
                            </div>
                            <div class="engitech-icon-box p-6 bg-white border border-slate-100">
                                <h4 class="text-lg font-heading font-bold text-[#1b1d21] mb-1">Hosted by AWKUM</h4>
                                <p class="text-slate-400 text-xs">Academic leadership and operational foundation established at Mardan.</p>
                            </div>
                        </div>
                        
                        <div class="relative pl-16">
                            <div class="absolute left-0 top-1 w-14 h-14 rounded-2xl bg-white border-2 border-[#ff4b2b] flex items-center justify-center z-10 shadow-md">
                                <span class="text-xs font-heading font-extrabold text-[#ff4b2b]">GOAL</span>
                            </div>
                            <div class="engitech-icon-box p-6 bg-white border border-slate-100">
                                <h4 class="text-lg font-heading font-bold text-[#1b1d21] mb-1">Provincial Rollout</h4>
                                <p class="text-slate-400 text-xs">Expanding workshops, curriculum integration, and research across KP.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section 3: Patron's Message -->
    <section id="patron" class="py-20 lg:py-28 bg-[#f4f6f9] border-t border-slate-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                <div class="lg:col-span-5 animate-fade-up">
                    <div class="engitech-icon-box bg-white p-8 border border-slate-100 shadow-xl">
                        <div class="mb-6">
                            <img src="{{ asset('images/vc.jpg') }}" alt="Prof. Dr. Jamil Ahmad" class="w-24 h-24 rounded-full object-cover border-4 border-primary/20 shadow-lg">
                        </div>
                        <h3 class="text-xl font-heading font-bold text-[#1b1d21] mb-1">Prof. Dr. Jamil Ahmad</h3>
                        <p class="text-[#43baff] text-xs font-semibold uppercase tracking-wider mb-4">Patron & Founder, Vice Chancellor AWKUM</p>
                        <p class="text-[#5e6278] text-xs leading-relaxed">
                            Leading the institutional vision to position Abdul Wali Khan University Mardan as a pioneer in AI-enabled higher education and research.
                        </p>
                    </div>
                </div>

                <div class="lg:col-span-7 animate-fade-up stagger-1 space-y-4 text-[#5e6278] text-sm sm:text-base leading-relaxed">
                    <x-public.section-heading tag="LEADERSHIP MESSAGE" title="Message from the Patron" align="left" />
                    <p class="pt-2">
                        "Welcome to Zehanat. As Vice Chancellor of Abdul Wali Khan University Mardan, I am proud to patronise this timely initiative. AI is re-defining human potential. If our students and teachers are to thrive, we must equip them with both technical understanding and ethical discernment."
                    </p>
                    <p>
                        "Zehanat is designed as an open platform. We welcome every school teacher, college lecturer, university professor, student, and tech professional in KP to join us."
                    </p>
                </div>
            </div>
        </div>
    </section>
@endsection
