@extends('layouts.public')

@section('title', 'Membership - Zehanat')
@section('meta_description', 'Join the growing community of AI education advocates in Khyber Pakhtunkhwa.')

@section('content')
<x-public.page-banner title="Membership" :breadcrumbs="[['label' => 'Home', 'url' => '/'], ['label' => 'Membership']]">
    Join the growing community of educators, researchers, students, and institutions shaping AI education.
</x-public.page-banner>

<section id="categories" class="py-20 lg:py-28 bg-[#f4f6f9]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <x-public.section-heading tag="JOIN US" title="Membership Categories" subtitle="Choose the right tier for you or your institution." align="center" />

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mt-14">
            <!-- Individual Member -->
            <div class="engitech-icon-box p-8 bg-white border border-slate-100 flex flex-col justify-between h-full">
                <div>
                    <h3 class="text-xl font-heading font-extrabold text-[#182433] mb-2">Individual Member</h3>
                    <div class="text-3xl font-heading font-black text-[#0c5adb] mb-2">Free</div>
                    <p class="text-xs text-slate-400 mb-6">For educators, researchers, and students</p>
                    
                    <ul class="space-y-3 text-xs text-[#5e6278] mb-6">
                        <li class="flex items-center gap-2"><span>&check;</span> Access to AI learning resources</li>
                        <li class="flex items-center gap-2"><span>&check;</span> Society newsletter & updates</li>
                        <li class="flex items-center gap-2"><span>&check;</span> Event & workshop invitations</li>
                    </ul>
                </div>
                <x-public.btn variant="outline" size="sm" href="#join" class="w-full justify-center">Join As Individual</x-public.btn>
            </div>

            <!-- Institutional Member -->
            <div class="engitech-icon-box p-8 bg-white border-2 border-[#0c5adb] flex flex-col justify-between h-full shadow-2xl relative">
                <div class="absolute top-0 right-0 bg-[#0c5adb] text-white px-3 py-1 text-[10px] font-heading font-extrabold uppercase rounded-bl-xl">
                    POPULAR
                </div>
                <div>
                    <h3 class="text-xl font-heading font-extrabold text-[#182433] mb-2">Institution Partner</h3>
                    <div class="text-3xl font-heading font-black text-[#182433] mb-2">Institutional</div>
                    <p class="text-xs text-slate-400 mb-6">For schools, colleges, and universities</p>

                    <ul class="space-y-3 text-xs text-[#5e6278] mb-6">
                        <li class="flex items-center gap-2"><span>&check;</span> On-site faculty training</li>
                        <li class="flex items-center gap-2"><span>&check;</span> Curriculum integration support</li>
                        <li class="flex items-center gap-2"><span>&check;</span> Official Zehanat network badge</li>
                    </ul>
                </div>
                <x-public.btn variant="primary" size="sm" href="#join" class="w-full justify-center">Register Institution</x-public.btn>
            </div>

            <!-- Industry Partner -->
            <div class="engitech-icon-box p-8 bg-white border border-slate-100 flex flex-col justify-between h-full">
                <div>
                    <h3 class="text-xl font-heading font-extrabold text-[#182433] mb-2">Industry Partner</h3>
                    <div class="text-3xl font-heading font-black text-[#182433] mb-2">Corporate</div>
                    <p class="text-xs text-slate-400 mb-6">For tech companies & industry leaders</p>

                    <ul class="space-y-3 text-xs text-[#5e6278] mb-6">
                        <li class="flex items-center gap-2"><span>&check;</span> Talent pipeline access</li>
                        <li class="flex items-center gap-2"><span>&check;</span> Joint research projects</li>
                        <li class="flex items-center gap-2"><span>&check;</span> Brand visibility at events</li>
                    </ul>
                </div>
                <x-public.btn variant="outline" size="sm" href="#join" class="w-full justify-center">Partner With Us</x-public.btn>
            </div>

            <!-- Student Chapter -->
            <div class="engitech-icon-box p-8 bg-white border border-slate-100 flex flex-col justify-between h-full">
                <div>
                    <h3 class="text-xl font-heading font-extrabold text-[#182433] mb-2">Student Chapter</h3>
                    <div class="text-3xl font-heading font-black text-[#182433] mb-2">Campus</div>
                    <p class="text-xs text-slate-400 mb-6">For student-led campus AI clubs</p>

                    <ul class="space-y-3 text-xs text-[#5e6278] mb-6">
                        <li class="flex items-center gap-2"><span>&check;</span> Campus event sponsorship</li>
                        <li class="flex items-center gap-2"><span>&check;</span> Mentorship program</li>
                        <li class="flex items-center gap-2"><span>&check;</span> Hackathon support</li>
                    </ul>
                </div>
                <x-public.btn variant="outline" size="sm" href="#join" class="w-full justify-center">Start A Chapter</x-public.btn>
            </div>
        </div>
    </div>
</section>
@endsection
