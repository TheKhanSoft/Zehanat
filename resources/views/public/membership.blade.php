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
                <x-public.btn variant="outline" size="md" href="#join" data-category-select="individual" class="w-full justify-center">Join as Individual</x-public.btn>
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
                <x-public.btn variant="primary" size="md" href="#join" data-category-select="institution" class="w-full justify-center">Register Institution</x-public.btn>
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
                <x-public.btn variant="outline" size="md" href="#join" data-category-select="industry" class="w-full justify-center">Become a Partner</x-public.btn>
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
                <x-public.btn variant="outline" size="md" href="#join" data-category-select="student" class="w-full justify-center">Join as Student</x-public.btn>
            </div>
        </div>
    </div>
</section>

<section id="join" class="py-20 md:py-28 bg-slate-900/50">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="animate-fade-up">
            <x-public.section-heading title="Join Now" subtitle="Fill out the form below to register your interest in joining Zehanat." align="center" />
        </div>

        @if(session('success'))
            <div class="mb-6 p-4 rounded-xl bg-teal-500/10 border border-teal-500/20 text-teal-400">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('membership.store') }}" class="glass-card p-8 md:p-10 rounded-2xl border border-slate-700 bg-slate-800/40 animate-fade-up stagger-2">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label for="name" class="block text-sm font-medium text-slate-300 mb-1">Full Name</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" placeholder="John Doe" autocomplete="name" required class="w-full bg-slate-800/50 border border-slate-700 rounded-xl px-4 py-3 text-white placeholder-slate-500 focus:border-teal-500 focus:ring-1 focus:ring-teal-500 outline-none transition-colors">
                    @error('name')<span class="text-red-400 text-xs mt-1 block">{{ $message }}</span>@enderror
                </div>
                <div>
                    <label for="email" class="block text-sm font-medium text-slate-300 mb-1">Email Address</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" placeholder="john@example.com" autocomplete="email" required class="w-full bg-slate-800/50 border border-slate-700 rounded-xl px-4 py-3 text-white placeholder-slate-500 focus:border-teal-500 focus:ring-1 focus:ring-teal-500 outline-none transition-colors">
                    @error('email')<span class="text-red-400 text-xs mt-1 block">{{ $message }}</span>@enderror
                </div>
            </div>

            <div class="mb-7">
                <div class="flex items-center justify-between gap-3">
                    <label for="phone" class="block text-sm font-semibold text-slate-200">Phone Number</label>
                    <span class="text-[11px] font-medium text-slate-500">Optional</span>
                </div>
                <div class="relative mt-2 max-w-xl">
                    <span class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 text-slate-500">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.362-.271.527-.734.417-1.173L6.963 3.102A1.125 1.125 0 0 0 5.872 2.25H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z" /></svg>
                    </span>
                    <input
                        type="tel"
                        name="phone"
                        id="phone"
                        value="{{ old('phone') }}"
                        placeholder="+923001234567"
                        inputmode="tel"
                        autocomplete="tel"
                        minlength="7"
                        maxlength="16"
                        pattern="\+?[0-9]{7,15}"
                        data-phone-input
                        aria-describedby="phone-help @error('phone') phone-error @enderror"
                        @error('phone') aria-invalid="true" @enderror
                        class="w-full rounded-xl border bg-slate-800/50 py-3 pl-12 pr-4 text-white outline-none transition placeholder:text-slate-600 focus:ring-2 {{ $errors->has('phone') ? 'border-rose-400/70 focus:border-rose-400 focus:ring-rose-400/15' : 'border-slate-700 focus:border-teal-500 focus:ring-teal-500/15' }}"
                    >
                </div>
                <p id="phone-help" class="mt-2 flex items-center gap-1.5 text-xs text-slate-500">
                    <svg class="h-3.5 w-3.5 flex-none" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M11.25 11.25 11.291 11.23a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" /></svg>
                    Enter 7 to 15 digits. A leading + is allowed; pasted spaces and dashes are cleaned automatically.
                </p>
                @error('phone')<p id="phone-error" class="mt-1.5 text-xs font-semibold text-rose-400">{{ $message }}</p>@enderror
            </div>

            @php
                $membershipCategories = [
                    'individual' => ['title' => 'Individual', 'description' => 'Educators, researchers and professionals'],
                    'institution' => ['title' => 'Institution', 'description' => 'Schools, colleges and universities'],
                    'industry' => ['title' => 'Industry', 'description' => 'Businesses and technology partners'],
                    'student' => ['title' => 'Student', 'description' => 'Learners at any education level'],
                ];
            @endphp
            <fieldset class="mb-7" aria-describedby="category-help @error('category') category-error @enderror">
                <div class="flex flex-col gap-1 sm:flex-row sm:items-end sm:justify-between">
                    <div>
                        <legend class="text-sm font-semibold text-slate-200">Membership Category</legend>
                        <p id="category-help" class="mt-1 text-xs text-slate-500">Choose the option that best describes how you are joining Zehanat.</p>
                    </div>
                    <span class="mt-1 text-[11px] font-bold uppercase tracking-[0.14em] text-teal-400 sm:mt-0">Required</span>
                </div>

                <div class="mt-4 grid gap-3 sm:grid-cols-2">
                    @foreach($membershipCategories as $value => $option)
                        <label class="relative block cursor-pointer">
                            <input
                                type="radio"
                                name="category"
                                value="{{ $value }}"
                                class="peer sr-only"
                                required
                                {{ old('category') === $value ? 'checked' : '' }}
                            >
                            <span class="flex min-h-28 items-start gap-4 rounded-2xl border p-4 transition duration-200 hover:-translate-y-0.5 hover:border-slate-500 hover:bg-slate-800/70 peer-focus-visible:ring-2 peer-focus-visible:ring-teal-400 peer-focus-visible:ring-offset-2 peer-focus-visible:ring-offset-slate-900 peer-checked:border-teal-400 peer-checked:bg-teal-400/10 peer-checked:shadow-lg peer-checked:shadow-teal-950/20 {{ $errors->has('category') ? 'border-rose-400/40 bg-rose-400/5' : 'border-slate-700 bg-slate-900/45' }}">
                                <span class="flex h-11 w-11 flex-none items-center justify-center rounded-xl border border-slate-700 bg-slate-800 text-slate-400 transition peer-checked:border-teal-400/30">
                                    @if($value === 'individual')
                                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.5 20.1a7.5 7.5 0 0 1 15 0" /></svg>
                                    @elseif($value === 'institution')
                                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3.75 21h16.5M4.5 3h15v18h-15V3Zm3.75 4.5h.008v.008H8.25V7.5Zm0 4.5h.008v.008H8.25V12Zm0 4.5h.008v.008H8.25V16.5Zm4.5-9h.008v.008h-.008V7.5Zm0 4.5h.008v.008h-.008V12Zm0 4.5h.008v.008h-.008V16.5Zm4.5-9h.008v.008h-.008V7.5Zm0 4.5h.008v.008h-.008V12Zm0 4.5h.008v.008h-.008V16.5Z" /></svg>
                                    @elseif($value === 'industry')
                                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M20.25 14.15v4.073a2.25 2.25 0 0 1-2.25 2.25H6a2.25 2.25 0 0 1-2.25-2.25V14.15M16.5 6.75V5.625A2.625 2.625 0 0 0 13.875 3h-3.75A2.625 2.625 0 0 0 7.5 5.625V6.75m13.5 0H3v5.625c0 .621.504 1.125 1.125 1.125h15.75c.621 0 1.125-.504 1.125-1.125V6.75Z" /></svg>
                                    @else
                                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="m4.26 10.147 7.369-4.027a.75.75 0 0 1 .742 0l7.369 4.027a.75.75 0 0 1 0 1.306l-7.369 4.027a.75.75 0 0 1-.742 0L4.26 11.453a.75.75 0 0 1 0-1.306ZM6.75 12.818v4.125c0 .621.504 1.125 1.125 1.125h8.25c.621 0 1.125-.504 1.125-1.125v-4.125" /></svg>
                                    @endif
                                </span>
                                <span class="min-w-0 pr-8">
                                    <span class="flex flex-wrap items-center gap-2">
                                        <span class="block text-sm font-black text-white">{{ $option['title'] }}</span>
                                        @if($value === 'institution')
                                            <span class="rounded-full bg-amber-400/10 px-2 py-0.5 text-[9px] font-black uppercase tracking-wider text-amber-300">Recommended</span>
                                        @endif
                                    </span>
                                    <span class="mt-1.5 block text-xs leading-5 text-slate-500">{{ $option['description'] }}</span>
                                </span>
                            </span>
                            <span class="pointer-events-none absolute right-3.5 top-3.5 flex h-6 w-6 items-center justify-center rounded-full border border-slate-600 bg-slate-900 text-transparent opacity-0 transition peer-checked:border-teal-400 peer-checked:bg-teal-400 peer-checked:text-slate-950 peer-checked:opacity-100">
                                <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="m4.5 12.75 6 6 9-13.5" /></svg>
                            </span>
                        </label>
                    @endforeach
                </div>
                @error('category')<p id="category-error" class="mt-2 text-xs font-semibold text-rose-400">{{ $message }}</p>@enderror
            </fieldset>

            @php($organizationRequired = in_array(old('category'), ['institution', 'industry', 'student'], true))
            <div class="mb-6 rounded-2xl border p-4 transition-colors {{ $errors->has('institution') ? 'border-rose-400/40 bg-rose-400/5' : 'border-slate-700/70 bg-slate-900/30' }}" data-organization-field>
                <div class="mb-2 flex items-center justify-between gap-3">
                    <label for="institution" class="block text-sm font-semibold text-slate-200">Institution/Organization Name</label>
                    <span class="rounded-full px-2.5 py-1 text-[10px] font-black uppercase tracking-wider {{ $organizationRequired ? 'bg-amber-400/10 text-amber-300' : 'bg-slate-800 text-slate-500' }}" data-organization-requirement>
                        {{ $organizationRequired ? 'Required' : 'Optional' }}
                    </span>
                </div>
                <input
                    type="text"
                    name="institution"
                    id="institution"
                    value="{{ old('institution') }}"
                    placeholder="University, school, college, or company name"
                    autocomplete="organization"
                    data-organization-input
                    aria-describedby="institution-help @error('institution') institution-error @enderror"
                    {{ $organizationRequired ? 'required aria-required=true' : 'aria-required=false' }}
                    @error('institution') aria-invalid="true" @enderror
                    class="w-full rounded-xl border bg-slate-800/50 px-4 py-3 text-white outline-none transition-colors placeholder:text-slate-600 {{ $errors->has('institution') ? 'border-rose-400/70 focus:border-rose-400 focus:ring-2 focus:ring-rose-400/15' : 'border-slate-700 focus:border-teal-500 focus:ring-2 focus:ring-teal-500/15' }}"
                >
                <p id="institution-help" class="mt-2 text-xs leading-5 text-slate-500" data-organization-help>
                    {{ $organizationRequired ? 'Required for the selected membership category.' : 'Optional for individual memberships.' }}
                </p>
                @error('institution')<p id="institution-error" class="mt-1.5 text-xs font-semibold text-rose-400">{{ $message }}</p>@enderror
            </div>

            <div class="mb-8">
                <label for="message" class="block text-sm font-medium text-slate-300 mb-1">Message/Reason for Joining</label>
                <textarea name="message" id="message" rows="4" placeholder="Tell us a little bit about why you're joining..." class="w-full bg-slate-800/50 border border-slate-700 rounded-xl px-4 py-3 text-white placeholder-slate-500 focus:border-teal-500 focus:ring-1 focus:ring-teal-500 outline-none transition-colors">{{ old('message') }}</textarea>
                @error('message')<span class="text-red-400 text-xs mt-1 block">{{ $message }}</span>@enderror
            </div>

            <div class="text-right">
                <button type="submit" class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-xl text-slate-950 bg-teal-500 hover:bg-teal-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500 focus:ring-offset-slate-950 transition-colors shadow-[0_0_20px_-5px_rgba(20,184,166,0.4)] hover:shadow-[0_0_25px_-5px_rgba(20,184,166,0.6)]">
                    Submit Application
                </button>
            </div>
        </form>
    </div>
</section>
@endsection
