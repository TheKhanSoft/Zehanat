@extends('layouts.public')

@section('title', 'Resources - Zehanat')
@section('meta_description', 'Guides, policies, and educational materials for AI in education.')

@section('content')
<x-public.page-banner title="Resources" :breadcrumbs="[['label' => 'Home', 'url' => '/'], ['label' => 'Resources']]">
    Guides, policies, and educational materials for AI in education.
</x-public.page-banner>

<section class="py-20 md:py-28 bg-slate-950">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-16 animate-fade-up">
            <p class="text-lg text-slate-300">
                Zehanat is building a comprehensive library of resources to support AI education across Khyber Pakhtunkhwa. This section will grow over time as we develop guides, policy documents, and multimedia content.
            </p>
        </div>

        <div class="max-w-3xl mx-auto mb-16 animate-fade-up stagger-1">
            <x-public.alert type="info">Our resource library is being developed. New materials will be added regularly. Subscribe to stay updated.</x-public.alert>
        </div>
    </div>
</section>

<section id="guides" class="py-20 md:py-28 bg-slate-900/50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="animate-fade-up">
            <x-public.section-heading title="Guides & Publications" subtitle="Educational materials to help you understand and implement AI." align="left" />
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-12 animate-fade-up stagger-1">
            <div class="glass-card p-8 rounded-2xl border border-slate-700 bg-slate-800/40 relative overflow-hidden group">
                <div class="text-4xl mb-4">📖</div>
                <h3 class="text-xl font-bold text-white mb-3">Introduction to AI for Educators</h3>
                <p class="text-sm text-slate-400 mb-6">A beginner-friendly guide to understanding AI concepts.</p>
                <span class="inline-block px-3 py-1 bg-slate-800 text-slate-400 text-xs font-semibold rounded-full border border-slate-700">Coming Soon</span>
            </div>
            <div class="glass-card p-8 rounded-2xl border border-slate-700 bg-slate-800/40 relative overflow-hidden group">
                <div class="text-4xl mb-4">📖</div>
                <h3 class="text-xl font-bold text-white mb-3">AI in the Classroom: A Practical Guide</h3>
                <p class="text-sm text-slate-400 mb-6">Step-by-step instructions for incorporating AI tools.</p>
                <span class="inline-block px-3 py-1 bg-slate-800 text-slate-400 text-xs font-semibold rounded-full border border-slate-700">Coming Soon</span>
            </div>
            <div class="glass-card p-8 rounded-2xl border border-slate-700 bg-slate-800/40 relative overflow-hidden group">
                <div class="text-4xl mb-4">📖</div>
                <h3 class="text-xl font-bold text-white mb-3">AI Glossary for Education</h3>
                <p class="text-sm text-slate-400 mb-6">Common AI terms explained in simple language.</p>
                <span class="inline-block px-3 py-1 bg-slate-800 text-slate-400 text-xs font-semibold rounded-full border border-slate-700">Coming Soon</span>
            </div>
        </div>
    </div>
</section>

<section id="policies" class="py-20 md:py-28 bg-slate-950">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="animate-fade-up">
            <x-public.section-heading title="Policies & Frameworks" subtitle="Guidelines for responsible and ethical AI adoption." align="left" />
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-12 animate-fade-up stagger-1">
            <div class="glass-card p-8 rounded-2xl border border-slate-700 bg-slate-800/40">
                <div class="text-4xl mb-4">📋</div>
                <h3 class="text-xl font-bold text-white mb-3">AI Ethics in Education Policy</h3>
                <span class="inline-block px-3 py-1 bg-slate-800 text-slate-400 text-xs font-semibold rounded-full border border-slate-700">Coming Soon</span>
            </div>
            <div class="glass-card p-8 rounded-2xl border border-slate-700 bg-slate-800/40">
                <div class="text-4xl mb-4">📋</div>
                <h3 class="text-xl font-bold text-white mb-3">Responsible AI Use Guidelines</h3>
                <span class="inline-block px-3 py-1 bg-slate-800 text-slate-400 text-xs font-semibold rounded-full border border-slate-700">Coming Soon</span>
            </div>
            <div class="glass-card p-8 rounded-2xl border border-slate-700 bg-slate-800/40">
                <div class="text-4xl mb-4">📋</div>
                <h3 class="text-xl font-bold text-white mb-3">Data Privacy Framework for Schools</h3>
                <span class="inline-block px-3 py-1 bg-slate-800 text-slate-400 text-xs font-semibold rounded-full border border-slate-700">Coming Soon</span>
            </div>
        </div>
    </div>
</section>

<section id="videos" class="py-20 md:py-28 bg-slate-900/50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="animate-fade-up">
            <x-public.section-heading title="Videos & Tutorials" subtitle="Multimedia content to support your learning journey." align="left" />
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-12 animate-fade-up stagger-1">
            @for ($i = 0; $i < 3; $i++)
            <div class="bg-slate-800 rounded-xl aspect-video flex items-center justify-center border border-slate-700/50 hover:border-teal-500/50 transition-colors group cursor-pointer relative overflow-hidden">
                <div class="absolute inset-0 bg-slate-900/40 group-hover:bg-slate-900/20 transition-colors z-10"></div>
                <div class="w-16 h-16 bg-white/10 backdrop-blur-sm rounded-full flex items-center justify-center z-20 group-hover:scale-110 group-hover:bg-teal-500/80 transition-all">
                    <svg class="w-8 h-8 text-white ml-1" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M8 5v14l11-7z" />
                    </svg>
                </div>
            </div>
            @endfor
        </div>
    </div>
</section>
@endsection
