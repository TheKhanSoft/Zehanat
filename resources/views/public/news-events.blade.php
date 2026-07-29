@extends('layouts.public')

@section('title', 'News & Events - Zehanat')
@section('meta_description', 'Stay updated with the latest news, launches, and events from Zehanat.')

@section('content')
<x-public.page-banner title="News & Events" :breadcrumbs="[['label' => 'Home', 'url' => '/'], ['label' => 'News & Events']]">
    Stay updated with the latest news, inaugural events, and workshops from Zehanat.
</x-public.page-banner>

<section id="launch" class="py-20 lg:py-28 bg-[#f4f6f9] relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="engitech-icon-box p-8 sm:p-12 bg-white border border-slate-100 shadow-xl relative overflow-hidden mb-20">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
                <div class="lg:col-span-8 space-y-4">
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-red-50 text-[#ff4b2b] font-heading font-extrabold text-xs">
                        FEATURED INAUGURAL EVENT
                    </div>
                    <h2 class="text-3xl sm:text-4xl font-heading font-extrabold text-[#1b1d21]">Zehanat Grand Launch Event</h2>
                    <p class="text-[#5e6278] text-sm sm:text-base leading-relaxed">
                        The official inauguration of Zehanat — The Khyber Pakhtunkhwa Society for AI in Education — will be held at Abdul Wali Khan University Mardan. This landmark event will bring together educators, researchers, policymakers, and industry leaders to mark the beginning of a new era in AI education for our province.
                    </p>
                    <div class="flex flex-wrap gap-4 pt-2 text-xs font-heading font-bold text-[#1b1d21]">
                        <div class="flex items-center gap-2 bg-[#f4f6f9] px-4 py-2 rounded-xl border border-slate-200">
                            <span class="text-[#43baff]">📅 Date:</span> Coming Soon (2026)
                        </div>
                        <div class="flex items-center gap-2 bg-[#f4f6f9] px-4 py-2 rounded-xl border border-slate-200">
                            <span class="text-[#43baff]">📍 Location:</span> AWKUM Mardan
                        </div>
                    </div>
                    <div class="pt-4 flex flex-wrap gap-4">
                        <x-public.btn variant="primary" size="md" href="/contact">Register Interest</x-public.btn>
                    </div>
                </div>

                <div class="lg:col-span-4 flex justify-center">
                    <div class="w-48 h-48 rounded-3xl bg-gradient-to-br from-[#43baff] to-[#43baff] p-1 flex items-center justify-center shadow-xl">
                        <div class="w-full h-full bg-white rounded-[22px] flex items-center justify-center text-5xl">
                            🚀
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- More Events & News -->
        <div class="mb-12">
            <x-public.section-heading tag="HAPPENINGS" title="Upcoming & Recent Activities" align="left" />
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <div class="animate-fade-up stagger-1 h-full">
                <x-public.event-card date="15" month="AUG" title="AI Ethics in Curriculum Seminar" description="A comprehensive seminar on integrating ethical AI practices and guidelines into modern educational curriculums across KP schools." link="#" />
            </div>
            <div class="animate-fade-up stagger-2 h-full">
                <x-public.event-card date="28" month="AUG" title="Tech Innovators Meetup" description="Networking event for educators, researchers, and tech enthusiasts to share AI innovation ideas and collaborate on upcoming projects." link="#" />
            </div>
            <div class="animate-fade-up stagger-3 h-full">
                <x-public.event-card date="10" month="SEP" title="Student AI Hackathon 2026" description="An exciting inter-college AI hackathon aimed at solving local educational challenges using modern artificial intelligence tools." link="#" />
            </div>
            <div class="animate-fade-up stagger-4 h-full">
                <x-public.event-card date="22" month="SEP" title="Faculty Training: AI Tools" description="A hands-on workshop for university faculty members to master AI educational tools and modern pedagogical approaches." link="#" />
            </div>
            <div class="animate-fade-up stagger-5 h-full">
                <x-public.event-card date="05" month="OCT" title="Industry-Academia Liaison Forum" description="Bridging the gap between corporate technology needs and academic research capabilities through open dialogue." link="#" />
            </div>
            <div class="animate-fade-up stagger-6 h-full">
                <x-public.event-card date="18" month="OCT" title="Public AI Awareness Campaign" description="Community sessions focusing on digital literacy and safe engagement with AI technologies for parents and students." link="#" />
            </div>
        </div>
    </div>
</section>
@endsection
