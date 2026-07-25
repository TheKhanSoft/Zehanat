@extends('layouts.public')

@section('title', 'FAQ - Zehanat')
@section('meta_description', 'Find answers to common questions about Zehanat and AI in education.')

@section('content')
<x-public.page-banner title="Frequently Asked Questions" :breadcrumbs="[['label' => 'Home', 'url' => '/'], ['label' => 'FAQ']]">
    Find answers to common questions about Zehanat and AI in education.
</x-public.page-banner>

<section class="py-20 md:py-28 bg-slate-950">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="space-y-4 animate-fade-up">
            @foreach($faqs as $faq)
                <x-public.accordion :title="$faq->question">
                    <p class="text-slate-300 leading-relaxed">
                        {{ $faq->answer }}
                    </p>
                </x-public.accordion>
            @endforeach
        </div>

        <div class="mt-16 animate-fade-up stagger-1">
            <div class="glass-card p-10 rounded-2xl text-center border border-slate-700 bg-slate-900/60 shadow-lg">
                <h3 class="text-2xl font-bold text-white mb-4">Still have questions? We'd love to hear from you.</h3>
                <p class="text-slate-400 mb-8 max-w-2xl mx-auto">Our team is ready to provide you with all the information you need about our programs, membership, and events.</p>
                <x-public.btn variant="primary" size="lg" href="/contact">Contact Us</x-public.btn>
            </div>
        </div>
    </div>
</section>
@endsection
