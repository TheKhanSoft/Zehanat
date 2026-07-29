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
                    <h3 class="text-xl font-heading font-extrabold text-[#1b1d21] mb-2">Individual Member</h3>
                    <div class="text-3xl font-heading font-black text-[#43baff] mb-2">Free</div>
                    <p class="text-xs text-slate-400 mb-6">For educators, researchers, and students</p>
                    
                    <ul class="space-y-3 text-xs text-[#5e6278] mb-6">
                        <li class="flex items-center gap-2"><span>&check;</span> Access to AI learning resources</li>
                        <li class="flex items-center gap-2"><span>&check;</span> Society newsletter & updates</li>
                        <li class="flex items-center gap-2"><span>&check;</span> Event & workshop invitations</li>
                    </ul>
                </div>
                <x-public.btn variant="outline" size="sm" href="#join" class="w-full justify-center" data-select-category="individual">Join As Individual</x-public.btn>
            </div>

            <!-- Institutional Member -->
            <div class="engitech-icon-box p-8 bg-white border-2 border-[#43baff] flex flex-col justify-between h-full shadow-2xl relative">
                <div class="absolute top-0 right-0 bg-[#43baff] text-white px-3 py-1 text-[10px] font-heading font-extrabold uppercase rounded-bl-xl">
                    POPULAR
                </div>
                <div>
                    <h3 class="text-xl font-heading font-extrabold text-[#1b1d21] mb-2">Institution Partner</h3>
                    <div class="text-3xl font-heading font-black text-[#1b1d21] mb-2">Institutional</div>
                    <p class="text-xs text-slate-400 mb-6">For schools, colleges, and universities</p>

                    <ul class="space-y-3 text-xs text-[#5e6278] mb-6">
                        <li class="flex items-center gap-2"><span>&check;</span> On-site faculty training</li>
                        <li class="flex items-center gap-2"><span>&check;</span> Curriculum integration support</li>
                        <li class="flex items-center gap-2"><span>&check;</span> Official Zehanat network badge</li>
                    </ul>
                </div>
                <x-public.btn variant="primary" size="sm" href="#join" class="w-full justify-center" data-select-category="institution">Register Institution</x-public.btn>
            </div>

            <!-- Industry Partner -->
            <div class="engitech-icon-box p-8 bg-white border border-slate-100 flex flex-col justify-between h-full">
                <div>
                    <h3 class="text-xl font-heading font-extrabold text-[#1b1d21] mb-2">Industry Partner</h3>
                    <div class="text-3xl font-heading font-black text-[#1b1d21] mb-2">Corporate</div>
                    <p class="text-xs text-slate-400 mb-6">For tech companies & industry leaders</p>

                    <ul class="space-y-3 text-xs text-[#5e6278] mb-6">
                        <li class="flex items-center gap-2"><span>&check;</span> Talent pipeline access</li>
                        <li class="flex items-center gap-2"><span>&check;</span> Joint research projects</li>
                        <li class="flex items-center gap-2"><span>&check;</span> Brand visibility at events</li>
                    </ul>
                </div>
                <x-public.btn variant="outline" size="sm" href="#join" class="w-full justify-center" data-select-category="industry">Partner With Us</x-public.btn>
            </div>

            <!-- Student Chapter -->
            <div class="engitech-icon-box p-8 bg-white border border-slate-100 flex flex-col justify-between h-full">
                <div>
                    <h3 class="text-xl font-heading font-extrabold text-[#1b1d21] mb-2">Student Chapter</h3>
                    <div class="text-3xl font-heading font-black text-[#1b1d21] mb-2">Campus</div>
                    <p class="text-xs text-slate-400 mb-6">For student-led campus AI clubs</p>

                    <ul class="space-y-3 text-xs text-[#5e6278] mb-6">
                        <li class="flex items-center gap-2"><span>&check;</span> Campus event sponsorship</li>
                        <li class="flex items-center gap-2"><span>&check;</span> Mentorship program</li>
                        <li class="flex items-center gap-2"><span>&check;</span> Hackathon support</li>
                    </ul>
                </div>
                <x-public.btn variant="outline" size="sm" href="#join" class="w-full justify-center" data-select-category="student">Start A Chapter</x-public.btn>
            </div>
        </div>
    </div>
</section>

<!-- RESTORED ADVANCED MEMBERSHIP FORM -->
<!-- RESTORED ADVANCED MEMBERSHIP FORM -->
<section id="join" class="py-20 md:py-28 bg-white border-t border-slate-100">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="animate-fade-up mb-12">
            <x-public.section-heading title="Join Now" subtitle="Fill out the form below to register your interest in joining Zehanat." align="center" />
        </div>

        @if(session('success'))
            <div class="mb-6 p-4 rounded-xl bg-green-50 border border-green-200 text-green-700">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('membership.store') }}" class="p-8 md:p-10 rounded-2xl border border-slate-100 bg-white animate-fade-up stagger-2 shadow-[0_8px_30px_rgb(0,0,0,0.08)]">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label for="name" class="block text-sm font-semibold text-[#1b1d21] mb-1">Full Name</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" placeholder="John Doe" autocomplete="name" required class="w-full bg-[#f4f6f9] border border-slate-200 rounded-xl px-4 py-3 text-[#1b1d21] placeholder-slate-400 focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-colors">
                    @error('name')<span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>@enderror
                </div>
                <div>
                    <label for="email" class="block text-sm font-semibold text-[#1b1d21] mb-1">Email Address</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" placeholder="john@example.com" autocomplete="email" required class="w-full bg-[#f4f6f9] border border-slate-200 rounded-xl px-4 py-3 text-[#1b1d21] placeholder-slate-400 focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-colors">
                    @error('email')<span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>@enderror
                </div>
            </div>

            <div class="mb-7">
                <div class="flex items-center justify-between gap-3">
                    <label for="phone" class="block text-sm font-semibold text-[#1b1d21]">Phone Number</label>
                    <span class="text-[11px] font-medium text-slate-500">Optional</span>
                </div>
                <div class="relative mt-2 max-w-xl">
                    <span class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400">
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
                        class="w-full rounded-xl border bg-[#f4f6f9] py-3 pl-12 pr-4 text-[#1b1d21] outline-none transition placeholder:text-slate-400 focus:ring-2 {{ $errors->has('phone') ? 'border-red-400 focus:border-red-500 focus:ring-red-200' : 'border-slate-200 focus:border-primary focus:ring-primary/20' }}"
                    >
                </div>
                <p id="phone-help" class="mt-2 flex items-center gap-1.5 text-xs text-slate-500">
                    <svg class="h-3.5 w-3.5 flex-none" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M11.25 11.25 11.291 11.23a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" /></svg>
                    Enter 7 to 15 digits. A leading + is allowed.
                </p>
                @error('phone')<p id="phone-error" class="mt-1.5 text-xs font-semibold text-red-500">{{ $message }}</p>@enderror
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
                        <legend class="text-sm font-semibold text-[#1b1d21]">Membership Category</legend>
                        <p id="category-help" class="mt-1 text-xs text-slate-500">Choose the option that best describes how you are joining Zehanat.</p>
                    </div>
                    <span class="mt-1 text-[11px] font-bold uppercase tracking-[0.14em] text-primary sm:mt-0">Required</span>
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
                            <span class="flex min-h-28 items-start gap-4 rounded-2xl border p-4 transition duration-200 hover:-translate-y-0.5 hover:border-slate-300 hover:bg-[#f4f6f9] peer-focus-visible:ring-2 peer-focus-visible:ring-primary peer-focus-visible:ring-offset-2 peer-focus-visible:ring-offset-white peer-checked:border-primary peer-checked:bg-blue-50 peer-checked:shadow-md {{ $errors->has('category') ? 'border-red-300 bg-red-50' : 'border-slate-200 bg-white' }}">
                                <span class="flex h-11 w-11 flex-none items-center justify-center rounded-xl border border-slate-200 bg-white text-slate-400 transition peer-checked:border-primary/30 peer-checked:text-primary">
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
                                        <span class="block text-sm font-black text-[#1b1d21]">{{ $option['title'] }}</span>
                                        @if($value === 'institution')
                                            <span class="rounded-full bg-amber-100 px-2 py-0.5 text-[9px] font-black uppercase tracking-wider text-amber-600">Recommended</span>
                                        @endif
                                    </span>
                                    <span class="mt-1.5 block text-xs leading-5 text-slate-500">{{ $option['description'] }}</span>
                                </span>
                             </span>
                            <span class="pointer-events-none absolute right-4 top-4 flex h-8 w-8 items-center justify-center rounded-full border-2 border-slate-300 bg-white opacity-0 transition-all duration-300 scale-75 peer-checked:scale-100 peer-checked:border-primary peer-checked:bg-primary peer-checked:opacity-100 shadow-md">
                                <svg class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m5 13 4 4L19 7" />
                                </svg>
                            </span>
                        </label>
                    @endforeach
                </div>
                @error('category')<p id="category-error" class="mt-2 text-xs font-semibold text-red-500">{{ $message }}</p>@enderror
            </fieldset>

            @php($organizationRequired = in_array(old('category'), ['institution', 'industry', 'student'], true))
            <div class="mb-6 rounded-2xl border p-4 transition-colors {{ $errors->has('institution') ? 'border-red-300 bg-red-50' : 'border-slate-200 bg-[#f4f6f9]' }}" data-organization-field>
                <div class="mb-2 flex items-center justify-between gap-3">
                    <label for="institution" class="block text-sm font-semibold text-[#1b1d21]">Institution/Organization Name</label>
                    <span class="rounded-full px-2.5 py-1 text-[10px] font-black uppercase tracking-wider {{ $organizationRequired ? 'bg-amber-100 text-amber-600' : 'bg-slate-200 text-slate-500' }}" data-organization-requirement>
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
                    class="w-full rounded-xl border bg-white px-4 py-3 text-[#1b1d21] outline-none transition-colors placeholder:text-slate-400 {{ $errors->has('institution') ? 'border-red-400 focus:border-red-500 focus:ring-2 focus:ring-red-200' : 'border-slate-200 focus:border-primary focus:ring-2 focus:ring-primary/20' }}"
                >
                <p id="institution-help" class="mt-2 text-xs leading-5 text-slate-500" data-organization-help>
                    {{ $organizationRequired ? 'Required for the selected membership category.' : 'Optional for individual memberships.' }}
                </p>
                @error('institution')<p id="institution-error" class="mt-1.5 text-xs font-semibold text-red-500">{{ $message }}</p>@enderror
            </div>

            <div class="mb-8">
                <label for="message" class="block text-sm font-semibold text-[#1b1d21] mb-1">Message/Reason for Joining</label>
                <textarea name="message" id="message" rows="4" placeholder="Tell us a little bit about why you're joining..." class="w-full bg-[#f4f6f9] border border-slate-200 rounded-xl px-4 py-3 text-[#1b1d21] placeholder-slate-400 focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-colors">{{ old('message') }}</textarea>
                @error('message')<span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>@enderror
            </div>

            <div class="text-right">
                <x-public.btn variant="primary" size="lg" type="submit">Submit Application</x-public.btn>
            </div>
        </form>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const selectButtons = document.querySelectorAll('[data-select-category]');
        selectButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                const category = this.getAttribute('data-select-category');
                const radio = document.querySelector(`input[name="category"][value="${category}"]`);
                if(radio) {
                    radio.checked = true;
                    // Trigger change event for any other listeners
                    radio.dispatchEvent(new Event('change', { bubbles: true }));
                }
            });
        });
    });
</script>
@endsection
