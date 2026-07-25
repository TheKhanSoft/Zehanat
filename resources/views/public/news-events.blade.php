@extends('layouts.public')

@section('title', 'News & Events - Zehanat')
@section('meta_description', 'Stay updated with the latest from Zehanat.')

@section('content')
<x-public.page-banner title="News & Events" :breadcrumbs="[['label' => 'Home', 'url' => '/'], ['label' => 'News & Events']]">
    Stay updated with the latest from Zehanat.
</x-public.page-banner>

<section id="launch" class="py-20 md:py-28 bg-slate-950 relative overflow-hidden">
    <!-- Background effects -->
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[800px] h-[800px] bg-teal-500/20 rounded-full blur-[120px] pointer-events-none"></div>
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="glass-card rounded-3xl p-8 md:p-14 border border-teal-500/50 bg-slate-900/60 shadow-[0_0_50px_-12px_rgba(20,184,166,0.25)] relative overflow-hidden group animate-fade-up">
            <!-- Animated glowing border effect could go here -->
            <div class="absolute inset-0 bg-gradient-to-r from-teal-500/10 via-transparent to-amber-500/10 opacity-0 group-hover:opacity-100 transition-opacity duration-700"></div>
            
            <div class="relative z-10 flex flex-col md:flex-row gap-10 items-center">
                <div class="md:w-2/3">
                    <span class="inline-block px-4 py-1 rounded-full bg-amber-500/20 text-amber-500 text-sm font-bold uppercase tracking-widest mb-6">Highlight Event</span>
                    <h2 class="text-4xl md:text-5xl font-extrabold text-white mb-6">Zehanat Launch Event</h2>
                    <p class="text-lg text-slate-300 leading-relaxed mb-8">
                        The official inauguration of Zehanat — The Khyber Pakhtunkhwa Society for AI in Education — will be held at Abdul Wali Khan University Mardan. This landmark event will bring together educators, researchers, policymakers, and industry leaders to mark the beginning of a new era in AI education for our province.
                    </p>
                    <div class="flex flex-wrap gap-4 items-center mb-8 text-slate-300">
                        <div class="flex items-center gap-2 bg-slate-950/50 px-4 py-2 rounded-lg border border-slate-700">
                            <svg class="w-5 h-5 text-teal-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            <span class="font-medium">Coming Soon</span>
                        </div>
                        <div class="flex items-center gap-2 bg-slate-950/50 px-4 py-2 rounded-lg border border-slate-700">
                            <svg class="w-5 h-5 text-teal-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            <span class="font-medium">Abdul Wali Khan University Mardan</span>
                        </div>
                    </div>
                    <div class="flex flex-wrap gap-4">
                        <x-public.btn variant="primary" size="lg" href="#upcoming">Register Interest</x-public.btn>
                        <x-public.btn variant="outline" size="lg" href="#">Learn More</x-public.btn>
                    </div>
                </div>
                <div class="md:w-1/3 w-full flex justify-center">
                    <!-- Decorative element replacing image -->
                    <div class="w-64 h-64 rounded-full border-4 border-dashed border-teal-500/30 flex items-center justify-center relative animate-[spin_30s_linear_infinite]">
                        <div class="absolute inset-2 bg-gradient-to-tr from-teal-500/20 to-amber-500/20 rounded-full flex items-center justify-center animate-[spin_20s_linear_infinite_reverse]">
                            <div class="text-6xl animate-pulse">🚀</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="upcoming" class="py-20 md:py-28 bg-slate-900/50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="animate-fade-up">
            <x-public.section-heading title="Upcoming Events" subtitle="Join us at our upcoming seminars, workshops, and meetups." align="center" />
        </div>
        
        <div class="max-w-3xl mx-auto mb-12 animate-fade-up stagger-1">
            <x-public.alert type="info">Event dates will be announced soon. Register your interest to receive updates.</x-public.alert>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 animate-fade-up stagger-2">
            <x-public.event-card date="TBA" month="" title="Launch Ceremony" description="Grand launch with keynote speakers and panel discussions." link="#" />
            <x-public.event-card date="TBA" month="" title="AI in Education Workshop" description="Hands-on workshop for educators on AI tools and techniques." link="#" />
            <x-public.event-card date="TBA" month="" title="Member Orientation" description="Welcome session for new individual and institutional members." link="#" />
            <x-public.event-card date="TBA" month="" title="First AI Literacy Seminar" description="Open seminar on understanding AI for the general public." link="#" />
        </div>
    </div>
</section>

<section id="gallery" class="py-20 md:py-28 bg-slate-950">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="animate-fade-up">
            <x-public.section-heading title="Gallery" subtitle="Highlights from our past events and initiatives." align="center" />
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-12 animate-fade-up stagger-1">
            @for ($i = 0; $i < 6; $i++)
            <div class="bg-slate-800 rounded-xl aspect-video flex flex-col items-center justify-center text-slate-500 border border-slate-700/50 hover:border-slate-600 transition-colors group">
                <svg class="w-12 h-12 mb-3 text-slate-600 group-hover:text-slate-500 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                <span class="font-medium">Coming Soon</span>
            </div>
            @endfor
        </div>
    </div>
</section>
@endsection
