@extends('layouts.public')

@section('title', 'Contact Us - Zehanat')
@section('meta_description', 'Get in touch with the Zehanat team.')

@section('content')
<x-public.page-banner title="Contact Us" :breadcrumbs="[['label' => 'Home', 'url' => '/'], ['label' => 'Contact Us']]">
    Have a question, proposal, or institutional inquiry? Get in touch with our team.
</x-public.page-banner>

<section class="py-20 lg:py-28 bg-[#f4f6f9]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
            
            <!-- Left Column - Contact Form -->
            <div class="lg:col-span-7 animate-fade-up">
                <div class="engitech-icon-box p-8 sm:p-10 bg-white border border-slate-100 shadow-xl">
                    <x-public.section-heading tag="GET IN TOUCH" title="Send Us A Message" align="left" />
                    <p class="text-[#5e6278] text-xs sm:text-sm mt-2 mb-8">Fill out the form below and our administrative team will get back to you promptly.</p>
                    
                    @if(session('success'))
                        <div class="mb-6 p-4 rounded-xl bg-blue-50 border border-blue-100 text-[#43baff] text-sm font-semibold">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('contact.store') }}" class="space-y-6">
                        @csrf
                        <div>
                            <label for="name" class="block text-xs font-heading font-bold uppercase tracking-wider text-[#1b1d21] mb-2">Full Name</label>
                            <input type="text" name="name" id="name" value="{{ old('name') }}" placeholder="Your Name" class="w-full bg-[#f4f6f9] border border-slate-200 rounded-xl px-4 py-3 text-[#1b1d21] text-sm placeholder-slate-400 focus:border-[#43baff] focus:ring-1 focus:ring-[#43baff] outline-none transition-colors">
                            @error('name')<span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>@enderror
                        </div>
                        
                        <div>
                            <label for="email" class="block text-xs font-heading font-bold uppercase tracking-wider text-[#1b1d21] mb-2">Email Address</label>
                            <input type="email" name="email" id="email" value="{{ old('email') }}" placeholder="your.name@example.com" class="w-full bg-[#f4f6f9] border border-slate-200 rounded-xl px-4 py-3 text-[#1b1d21] text-sm placeholder-slate-400 focus:border-[#43baff] focus:ring-1 focus:ring-[#43baff] outline-none transition-colors">
                            @error('email')<span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>@enderror
                        </div>
                        
                        <div>
                            <label for="subject" class="block text-xs font-heading font-bold uppercase tracking-wider text-[#1b1d21] mb-2">Subject</label>
                            <input type="text" name="subject" id="subject" value="{{ old('subject') }}" placeholder="Subject / Inquiry Topic" class="w-full bg-[#f4f6f9] border border-slate-200 rounded-xl px-4 py-3 text-[#1b1d21] text-sm placeholder-slate-400 focus:border-[#43baff] focus:ring-1 focus:ring-[#43baff] outline-none transition-colors">
                            @error('subject')<span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>@enderror
                        </div>
                        
                        <div>
                            <label for="message" class="block text-xs font-heading font-bold uppercase tracking-wider text-[#1b1d21] mb-2">Message</label>
                            <textarea name="message" id="message" rows="5" placeholder="Write your message here..." class="w-full bg-[#f4f6f9] border border-slate-200 rounded-xl px-4 py-3 text-[#1b1d21] text-sm placeholder-slate-400 focus:border-[#43baff] focus:ring-1 focus:ring-[#43baff] outline-none transition-colors resize-none">{{ old('message') }}</textarea>
                            @error('message')<span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>@enderror
                        </div>
                        
                        <x-public.btn variant="primary" size="lg" type="submit" class="w-full">
                            Send Message
                        </x-public.btn>
                    </form>
                </div>
            </div>

            <!-- Right Column - Contact Cards -->
            <div class="lg:col-span-5 animate-fade-up stagger-1 space-y-6">
                <div class="engitech-icon-box p-6 bg-white border border-slate-100">
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 rounded-2xl bg-blue-50 border border-blue-100 flex items-center justify-center text-[#43baff] shrink-0 text-xl">
                            📍
                        </div>
                        <div>
                            <h4 class="font-heading font-bold text-[#1b1d21] text-base mb-1">Official Address</h4>
                            <p class="text-[#5e6278] text-xs leading-relaxed">
                                Abdul Wali Khan University Mardan, Khyber Pakhtunkhwa, Pakistan
                            </p>
                        </div>
                    </div>
                </div>

                <div class="engitech-icon-box p-6 bg-white border border-slate-100">
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 rounded-2xl bg-cyan-50 border border-cyan-100 flex items-center justify-center text-[#43baff] shrink-0 text-xl">
                            ✉️
                        </div>
                        <div>
                            <h4 class="font-heading font-bold text-[#1b1d21] text-base mb-1">Email Address</h4>
                            <a href="mailto:zehanat@awkum.edu.pk" class="text-[#5e6278] text-xs hover:text-[#43baff] transition-colors">
                                zehanat@awkum.edu.pk
                            </a>
                        </div>
                    </div>
                </div>

                <div class="engitech-icon-box p-6 bg-white border border-slate-100">
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 rounded-2xl bg-red-50 border border-red-100 flex items-center justify-center text-[#ff4b2b] shrink-0 text-xl">
                            📞
                        </div>
                        <div>
                            <h4 class="font-heading font-bold text-[#1b1d21] text-base mb-1">Phone Helpline</h4>
                            <a href="tel:+929379230640" class="text-[#5e6278] text-xs hover:text-[#43baff] transition-colors">
                                +92 937 9230640
                            </a>
                        </div>
                    </div>
                </div>

                <div class="engitech-icon-box p-6 bg-white border border-slate-100">
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 rounded-2xl bg-amber-50 border border-amber-100 flex items-center justify-center text-amber-600 shrink-0 text-xl">
                            🕒
                        </div>
                        <div>
                            <h4 class="font-heading font-bold text-[#1b1d21] text-base mb-1">Office Hours</h4>
                            <p class="text-[#5e6278] text-xs">Monday - Friday: 8:00 AM - 4:00 PM</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
@endsection
