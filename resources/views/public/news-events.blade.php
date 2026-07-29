@extends('layouts.public')

@section('title', 'News & Events - Zehanat')
@section('meta_description', 'Stay updated with the latest news, launches, and events from Zehanat.')

@section('content')
<x-public.page-banner title="News & Events" :breadcrumbs="[['label' => 'Home', 'url' => '/'], ['label' => 'News & Events']]">
    Stay updated with the latest news, inaugural events, and workshops from Zehanat.
</x-public.page-banner>

<section id="launch" class="py-20 lg:py-28 bg-[#f4f6f9] relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="engitech-icon-box p-8 sm:p-12 bg-white border border-slate-100 shadow-xl relative overflow-hidden">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
                <div class="lg:col-span-8 space-y-4">
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-red-50 text-[#ff4b2b] font-heading font-extrabold text-xs">
                        FEATURED INAUGURAL EVENT
                    </div>
                    <h2 class="text-3xl sm:text-4xl font-heading font-extrabold text-[#182433]">Zehanat Grand Launch Event</h2>
                    <p class="text-[#5e6278] text-sm sm:text-base leading-relaxed">
                        The official inauguration of Zehanat — The Khyber Pakhtunkhwa Society for AI in Education — will be held at Abdul Wali Khan University Mardan. This landmark event will bring together educators, researchers, policymakers, and industry leaders to mark the beginning of a new era in AI education for our province.
                    </p>
                    <div class="flex flex-wrap gap-4 pt-2 text-xs font-heading font-bold text-[#182433]">
                        <div class="flex items-center gap-2 bg-[#f4f6f9] px-4 py-2 rounded-xl border border-slate-200">
                            <span class="text-[#0c5adb]">📅 Date:</span> Coming Soon (2026)
                        </div>
                        <div class="flex items-center gap-2 bg-[#f4f6f9] px-4 py-2 rounded-xl border border-slate-200">
                            <span class="text-[#0c5adb]">📍 Location:</span> AWKUM Mardan
                        </div>
                    </div>
                    <div class="pt-4 flex flex-wrap gap-4">
                        <x-public.btn variant="primary" size="md" href="/contact">Register Interest</x-public.btn>
                    </div>
                </div>

                <div class="lg:col-span-4 flex justify-center">
                    <div class="w-48 h-48 rounded-3xl bg-gradient-to-br from-[#0c5adb] to-[#43baff] p-1 flex items-center justify-center shadow-xl">
                        <div class="w-full h-full bg-white rounded-[22px] flex items-center justify-center text-5xl">
                            🚀
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
