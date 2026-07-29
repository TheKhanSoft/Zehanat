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
            <a href="#schools" class="px-5 py-2.5 rounded-xl border border-slate-200 bg-[#f4f6f9] text-[#182433] hover:border-[#0c5adb] hover:text-[#0c5adb] transition-all">Schools</a>
            <a href="#colleges" class="px-5 py-2.5 rounded-xl border border-slate-200 bg-[#f4f6f9] text-[#182433] hover:border-[#0c5adb] hover:text-[#0c5adb] transition-all">Colleges</a>
            <a href="#universities" class="px-5 py-2.5 rounded-xl border border-slate-200 bg-[#f4f6f9] text-[#182433] hover:border-[#0c5adb] hover:text-[#0c5adb] transition-all">Universities</a>
            <a href="#industry" class="px-5 py-2.5 rounded-xl border border-slate-200 bg-[#f4f6f9] text-[#182433] hover:border-[#0c5adb] hover:text-[#0c5adb] transition-all">Industry</a>
            <a href="#public" class="px-5 py-2.5 rounded-xl border border-slate-200 bg-[#f4f6f9] text-[#182433] hover:border-[#0c5adb] hover:text-[#0c5adb] transition-all">Public</a>
        </div>
    </div>
</section>

<!-- Schools Program -->
<section id="schools" class="py-20 lg:py-28 bg-[#f4f6f9] border-t border-slate-200 scroll-mt-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
            <div class="lg:col-span-4">
                <div class="w-16 h-16 rounded-2xl bg-blue-50 border border-blue-100 text-[#0c5adb] flex items-center justify-center mb-6 text-3xl">
                    🏫
                </div>
                <div class="engitech-tag mb-2">PRIMARY & SECONDARY</div>
                <h2 class="text-3xl font-heading font-extrabold text-[#182433] mb-4">For Schools</h2>
                <p class="text-[#5e6278] text-sm leading-relaxed mb-6">
                    Our schools program introduces foundational AI concepts to young learners in engaging, age-appropriate ways while equipping teachers with classroom integration tools.
                </p>
                <x-public.btn variant="outline" size="sm" href="/contact">Inquire For Schools</x-public.btn>
            </div>
            <div class="lg:col-span-8 grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="engitech-icon-box p-6 bg-white border border-slate-100">
                    <h3 class="text-base font-heading font-bold text-[#182433] mb-2">Teacher AI Workshops</h3>
                    <p class="text-xs text-[#5e6278] leading-relaxed">Interactive sessions to demystify AI tools for lesson planning and student engagement.</p>
                </div>
                <div class="engitech-icon-box p-6 bg-white border border-slate-100">
                    <h3 class="text-base font-heading font-bold text-[#182433] mb-2">Student AI Discovery Days</h3>
                    <p class="text-xs text-[#5e6278] leading-relaxed">Hands-on discovery events where students learn basic concepts behind computer vision and robotics.</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
