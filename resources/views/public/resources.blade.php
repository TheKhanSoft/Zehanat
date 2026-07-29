@extends('layouts.public')

@section('title', 'Resources - Zehanat')
@section('meta_description', 'Guides, policies, and educational materials for AI in education.')

@section('content')
<x-public.page-banner title="Resources" :breadcrumbs="[['label' => 'Home', 'url' => '/'], ['label' => 'Resources']]">
    Guides, policies, and educational materials for AI in education across Khyber Pakhtunkhwa.
</x-public.page-banner>

<section class="py-20 lg:py-28 bg-[#f4f6f9]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <x-public.section-heading tag="PUBLICATIONS & ASSETS" title="Educational Resource Library" align="center" />
        
        <p class="text-[#5e6278] text-sm sm:text-base text-center max-w-2xl mx-auto mt-4 leading-relaxed">
            Zehanat is building a comprehensive library of resources to support educators, researchers, and students across Khyber Pakhtunkhwa.
        </p>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-14">
            <div class="engitech-icon-box p-8 bg-white border border-slate-100 flex flex-col justify-between">
                <div>
                    <div class="text-4xl mb-4">📖</div>
                    <h3 class="text-lg font-heading font-bold text-[#1b1d21] mb-2">Introduction to AI for Educators</h3>
                    <p class="text-xs text-slate-400 leading-relaxed mb-6">A beginner-friendly guide to understanding core AI concepts and classroom integration.</p>
                </div>
                <span class="inline-block px-3 py-1 bg-blue-50 text-[#43baff] text-[11px] font-heading font-extrabold uppercase rounded-full border border-blue-100 w-max">Coming Soon</span>
            </div>

            <div class="engitech-icon-box p-8 bg-white border border-slate-100 flex flex-col justify-between">
                <div>
                    <div class="text-4xl mb-4">📖</div>
                    <h3 class="text-lg font-heading font-bold text-[#1b1d21] mb-2">AI in the Classroom: Practical Guide</h3>
                    <p class="text-xs text-slate-400 leading-relaxed mb-6">Step-by-step instructions for incorporating AI tools into everyday lesson planning.</p>
                </div>
                <span class="inline-block px-3 py-1 bg-blue-50 text-[#43baff] text-[11px] font-heading font-extrabold uppercase rounded-full border border-blue-100 w-max">Coming Soon</span>
            </div>

            <div class="engitech-icon-box p-8 bg-white border border-slate-100 flex flex-col justify-between">
                <div>
                    <div class="text-4xl mb-4">📖</div>
                    <h3 class="text-lg font-heading font-bold text-[#1b1d21] mb-2">AI Glossary for Education</h3>
                    <p class="text-xs text-slate-400 leading-relaxed mb-6">Common AI terms and technical terminology explained in simple, clear language.</p>
                </div>
                <span class="inline-block px-3 py-1 bg-blue-50 text-[#43baff] text-[11px] font-heading font-extrabold uppercase rounded-full border border-blue-100 w-max">Coming Soon</span>
            </div>
        </div>
    </div>
</section>
@endsection
