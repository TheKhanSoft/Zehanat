@extends('layouts.public')

@section('title', 'FAQ - Zehanat')
@section('meta_description', 'Find answers to common questions about Zehanat and AI in education.')

@section('content')
<x-public.page-banner title="Frequently Asked Questions" :breadcrumbs="[['label' => 'Home', 'url' => '/'], ['label' => 'FAQ']]">
    Find answers to common questions about Zehanat, our mission, membership, and programs.
</x-public.page-banner>

<section class="py-20 lg:py-28 bg-[#f4f6f9]">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <x-public.section-heading tag="HELP & KNOWLEDGE BASE" title="Frequently Asked Questions" align="center" />

        <div class="space-y-4 mt-12">
            @foreach($faqs as $faq)
                <x-public.accordion :title="$faq->question">
                    <p class="text-[#5e6278] text-sm leading-relaxed">
                        {{ $faq->answer }}
                    </p>
                </x-public.accordion>
            @endforeach
        </div>

        <div class="mt-16">
            <div class="engitech-icon-box p-10 bg-white text-center border border-slate-100 shadow-xl">
                <h3 class="text-2xl font-heading font-extrabold text-[#1b1d21] mb-3">Still Have Questions?</h3>
                <p class="text-[#5e6278] text-xs sm:text-sm mb-6 max-w-xl mx-auto leading-relaxed">
                    Our team is ready to provide you with all the information you need regarding programs, membership, and events.
                </p>
                <x-public.btn variant="primary" size="md" href="/contact">Contact Our Team</x-public.btn>
            </div>
        </div>
    </div>
</section>
@endsection
