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
            <x-public.accordion title="What is Zehanat?" :open="true">
                <p class="text-slate-300 leading-relaxed">
                    Zehanat (ذہانت) — meaning 'intelligence' in Urdu — is the Khyber Pakhtunkhwa Society for AI in Education. It is a provincial society hosted by Abdul Wali Khan University Mardan, dedicated to helping schools, colleges, universities, and institutions understand and responsibly use Artificial Intelligence.
                </p>
            </x-public.accordion>

            <x-public.accordion title="Who can become a member?" :open="false">
                <p class="text-slate-300 leading-relaxed">
                    Membership is open to educators, researchers, students, administrators, and industry professionals. Schools, colleges, universities, and organisations can also join as institutional members. There is no fee for individual or student membership.
                </p>
            </x-public.accordion>

            <x-public.accordion title="What does Zehanat do?" :open="false">
                <p class="text-slate-300 leading-relaxed">
                    Zehanat provides training, resources, research support, and a collaborative platform for AI education. We organise workshops, develop curriculum guides, promote ethical AI use, and connect educators with industry partners.
                </p>
            </x-public.accordion>

            <x-public.accordion title="Is membership free?" :open="false">
                <p class="text-slate-300 leading-relaxed">
                    Yes, individual and student memberships are free. Institutional memberships require registration. Industry partnerships are arranged based on mutual interest and scope of collaboration.
                </p>
            </x-public.accordion>

            <x-public.accordion title="Why is AWKUM hosting Zehanat?" :open="false">
                <p class="text-slate-300 leading-relaxed">
                    Abdul Wali Khan University Mardan (AWKUM) is one of Khyber Pakhtunkhwa's leading public universities with strong faculties in computing, education, and research. It provides the academic leadership, infrastructure, and credibility needed to drive a province-wide AI education initiative.
                </p>
            </x-public.accordion>

            <x-public.accordion title="Do I need technical knowledge to participate?" :open="false">
                <p class="text-slate-300 leading-relaxed">
                    Not at all. Zehanat is designed for everyone — from primary school teachers with no technical background to university researchers. Our programs are tailored to different levels of expertise.
                </p>
            </x-public.accordion>

            <x-public.accordion title="How can my school or institution get involved?" :open="false">
                <p class="text-slate-300 leading-relaxed">
                    Register as an institutional member through our membership page. Once registered, you'll gain access to training programs, resources, and the broader Zehanat network.
                </p>
            </x-public.accordion>

            <x-public.accordion title="When is the launch event?" :open="false">
                <p class="text-slate-300 leading-relaxed">
                    The official launch event date will be announced soon. Register your interest on our News & Events page to receive updates.
                </p>
            </x-public.accordion>

            <x-public.accordion title="How can I contribute to Zehanat?" :open="false">
                <p class="text-slate-300 leading-relaxed">
                    You can contribute by becoming a member, volunteering for programs, sharing resources, participating in research, or partnering with us as an industry member. Contact us to discuss how you can help.
                </p>
            </x-public.accordion>

            <x-public.accordion title="What are the Six Pillars of Zehanat?" :open="false">
                <p class="text-slate-300 leading-relaxed">
                    Zehanat's work is built on six pillars: AI Literacy & Awareness, Curriculum Integration, Teacher & Faculty Training, Research & Innovation, Ethical & Responsible AI, and Industry–Academia Partnership. Learn more on our Six Pillars page.
                </p>
            </x-public.accordion>
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
