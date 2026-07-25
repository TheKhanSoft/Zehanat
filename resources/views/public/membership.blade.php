@extends('layouts.public')

@section('title', 'Membership - Zehanat')
@section('meta_description', 'Join the growing community of AI education advocates.')

@section('content')
<x-public.page-banner title="Membership" :breadcrumbs="[['label' => 'Home', 'url' => '/'], ['label' => 'Membership']]">
    Join the growing community of AI education advocates.
</x-public.page-banner>

<section id="categories" class="py-20 md:py-28 bg-slate-950">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="animate-fade-up">
            <x-public.section-heading title="Membership Categories" subtitle="Choose the right membership tier for you or your institution." align="center" />
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mt-12 animate-fade-up stagger-1">
            <!-- Individual Member -->
            <div class="glass-card rounded-2xl p-8 border border-teal-500/50 relative flex flex-col h-full bg-slate-900/40 hover:bg-slate-800/60 transition-colors">
                <div class="mb-6">
                    <h3 class="text-xl font-bold text-white mb-2">Individual Member</h3>
                    <div class="flex items-baseline gap-2">
                        <span class="text-4xl font-extrabold text-white">Free</span>
                    </div>
                    <p class="text-sm text-slate-400 mt-2">For educators, researchers, and students</p>
                </div>
                <ul class="space-y-4 flex-grow mb-8 text-sm text-slate-300">
                    <li class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-teal-500 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        <span>Access to resources</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-teal-500 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        <span>Newsletter</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-teal-500 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        <span>Event invitations</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-teal-500 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        <span>Online community access</span>
                    </li>
                </ul>
                <x-public.btn variant="outline" size="md" href="#join" class="w-full justify-center">Join as Individual</x-public.btn>
            </div>

            <!-- Institutional Member -->
            <div class="glass-card rounded-2xl p-8 border-2 border-amber-500 relative flex flex-col h-full bg-slate-800/60 transform lg:-translate-y-4 shadow-[0_0_30px_-5px_rgba(245,158,11,0.2)]">
                <div class="absolute top-0 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
                    <span class="bg-amber-500 text-slate-950 text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wider">Recommended</span>
                </div>
                <div class="mb-6">
                    <h3 class="text-xl font-bold text-white mb-2">Institutional Member</h3>
                    <div class="flex items-baseline gap-2">
                        <span class="text-4xl font-extrabold text-white">Free</span>
                    </div>
                    <p class="text-sm text-slate-400 mt-2">Registration Required. For schools, colleges, and universities</p>
                </div>
                <ul class="space-y-4 flex-grow mb-8 text-sm text-slate-300">
                    <li class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-teal-500 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        <span>All individual benefits</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-teal-500 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        <span>Institutional recognition</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-teal-500 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        <span>Priority training slots</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-teal-500 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        <span>Bulk workshop access & review support</span>
                    </li>
                </ul>
                <x-public.btn variant="primary" size="md" href="#join" class="w-full justify-center">Register Institution</x-public.btn>
            </div>

            <!-- Industry Partner -->
            <div class="glass-card rounded-2xl p-8 border border-slate-700 relative flex flex-col h-full bg-slate-900/40 hover:bg-slate-800/60 transition-colors">
                <div class="mb-6">
                    <h3 class="text-xl font-bold text-white mb-2">Industry Partner</h3>
                    <div class="flex items-baseline gap-2">
                        <span class="text-3xl font-bold text-white">By Arrangement</span>
                    </div>
                    <p class="text-sm text-slate-400 mt-2">For businesses and technology companies</p>
                </div>
                <ul class="space-y-4 flex-grow mb-8 text-sm text-slate-300">
                    <li class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-teal-500 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        <span>All institutional benefits</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-teal-500 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        <span>Industry advisory board seat</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-teal-500 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        <span>Branding opportunities</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-teal-500 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        <span>Talent pipeline access</span>
                    </li>
                </ul>
                <x-public.btn variant="outline" size="md" href="#join" class="w-full justify-center">Become a Partner</x-public.btn>
            </div>

            <!-- Student Member -->
            <div class="glass-card rounded-2xl p-8 border border-slate-700 relative flex flex-col h-full bg-slate-900/40 hover:bg-slate-800/60 transition-colors">
                <div class="mb-6">
                    <h3 class="text-xl font-bold text-white mb-2">Student Member</h3>
                    <div class="flex items-baseline gap-2">
                        <span class="text-4xl font-extrabold text-white">Free</span>
                    </div>
                    <p class="text-sm text-slate-400 mt-2">For students at any educational level</p>
                </div>
                <ul class="space-y-4 flex-grow mb-8 text-sm text-slate-300">
                    <li class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-teal-500 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        <span>Learning resources</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-teal-500 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        <span>Mentorship programs</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-teal-500 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        <span>Competition access</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-teal-500 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        <span>Certificate programs</span>
                    </li>
                </ul>
                <x-public.btn variant="outline" size="md" href="#join" class="w-full justify-center">Join as Student</x-public.btn>
            </div>
        </div>
    </div>
</section>

<section id="join" class="py-20 md:py-28 bg-slate-900/50">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="animate-fade-up">
            <x-public.section-heading title="Join Now" subtitle="Fill out the form below to register your interest in joining Zehanat." align="center" />
        </div>

        <div class="mb-10 animate-fade-up stagger-1">
            <x-public.alert type="info">Registration will be fully functional once the membership portal launches. For now, please contact us directly.</x-public.alert>
        </div>

        <form class="glass-card p-8 md:p-10 rounded-2xl border border-slate-700 bg-slate-800/40 animate-fade-up stagger-2">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label for="name" class="block text-sm font-medium text-slate-300 mb-1">Full Name</label>
                    <input type="text" id="name" placeholder="John Doe" class="w-full bg-slate-800/50 border border-slate-700 rounded-xl px-4 py-3 text-white placeholder-slate-500 focus:border-teal-500 focus:ring-1 focus:ring-teal-500 outline-none transition-colors">
                </div>
                <div>
                    <label for="email" class="block text-sm font-medium text-slate-300 mb-1">Email Address</label>
                    <input type="email" id="email" placeholder="john@example.com" class="w-full bg-slate-800/50 border border-slate-700 rounded-xl px-4 py-3 text-white placeholder-slate-500 focus:border-teal-500 focus:ring-1 focus:ring-teal-500 outline-none transition-colors">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label for="phone" class="block text-sm font-medium text-slate-300 mb-1">Phone Number</label>
                    <input type="tel" id="phone" placeholder="+92 300 1234567" class="w-full bg-slate-800/50 border border-slate-700 rounded-xl px-4 py-3 text-white placeholder-slate-500 focus:border-teal-500 focus:ring-1 focus:ring-teal-500 outline-none transition-colors">
                </div>
                <div>
                    <label for="category" class="block text-sm font-medium text-slate-300 mb-1">Category</label>
                    <select id="category" class="w-full bg-slate-800/50 border border-slate-700 rounded-xl px-4 py-3 text-white focus:border-teal-500 focus:ring-1 focus:ring-teal-500 outline-none transition-colors appearance-none">
                        <option value="" disabled selected>Select Category</option>
                        <option value="individual">Individual</option>
                        <option value="institution">Institution</option>
                        <option value="industry">Industry</option>
                        <option value="student">Student</option>
                    </select>
                </div>
            </div>

            <div class="mb-6">
                <label for="institution" class="block text-sm font-medium text-slate-300 mb-1">Institution/Organization Name</label>
                <input type="text" id="institution" placeholder="University Name / Company Name" class="w-full bg-slate-800/50 border border-slate-700 rounded-xl px-4 py-3 text-white placeholder-slate-500 focus:border-teal-500 focus:ring-1 focus:ring-teal-500 outline-none transition-colors">
            </div>

            <div class="mb-8">
                <label for="message" class="block text-sm font-medium text-slate-300 mb-1">Message/Reason for Joining</label>
                <textarea id="message" rows="4" placeholder="Tell us a little bit about why you're joining..." class="w-full bg-slate-800/50 border border-slate-700 rounded-xl px-4 py-3 text-white placeholder-slate-500 focus:border-teal-500 focus:ring-1 focus:ring-teal-500 outline-none transition-colors"></textarea>
            </div>

            <div class="text-right">
                <button type="button" class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-xl text-slate-950 bg-teal-500 hover:bg-teal-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500 focus:ring-offset-slate-950 transition-colors shadow-[0_0_20px_-5px_rgba(20,184,166,0.4)] hover:shadow-[0_0_25px_-5px_rgba(20,184,166,0.6)]">
                    Submit Application
                </button>
            </div>
        </form>
    </div>
</section>
@endsection
