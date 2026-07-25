@extends('layouts.public')

@section('title', 'Contact Us - Zehanat')
@section('meta_description', 'Get in touch with the Zehanat team.')

@section('content')
<x-public.page-banner title="Contact Us" :breadcrumbs="[['label' => 'Home', 'url' => '/'], ['label' => 'Contact Us']]">
    Get in touch with the Zehanat team.
</x-public.page-banner>

<section class="py-20 md:py-28 bg-slate-950">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-20">
            <!-- Left Column - Contact Form -->
            <div class="animate-fade-up">
                <div class="glass-card p-8 md:p-10 rounded-3xl border border-slate-700 bg-slate-900/60 shadow-xl">
                    <h2 class="text-3xl font-bold text-white mb-2">Send us a message</h2>
                    <p class="text-slate-400 mb-8">Fill out the form below and our team will get back to you as soon as possible.</p>
                    
                    <form class="space-y-6">
                        <div>
                            <label for="name" class="block text-sm font-medium text-slate-300 mb-2">Full Name</label>
                            <input type="text" id="name" placeholder="John Doe" class="w-full bg-slate-800/50 border border-slate-700 rounded-xl px-4 py-3 text-white placeholder-slate-500 focus:border-teal-500 focus:ring-1 focus:ring-teal-500 outline-none transition-colors">
                        </div>
                        
                        <div>
                            <label for="email" class="block text-sm font-medium text-slate-300 mb-2">Email Address</label>
                            <input type="email" id="email" placeholder="john@example.com" class="w-full bg-slate-800/50 border border-slate-700 rounded-xl px-4 py-3 text-white placeholder-slate-500 focus:border-teal-500 focus:ring-1 focus:ring-teal-500 outline-none transition-colors">
                        </div>
                        
                        <div>
                            <label for="subject" class="block text-sm font-medium text-slate-300 mb-2">Subject</label>
                            <input type="text" id="subject" placeholder="How can we help you?" class="w-full bg-slate-800/50 border border-slate-700 rounded-xl px-4 py-3 text-white placeholder-slate-500 focus:border-teal-500 focus:ring-1 focus:ring-teal-500 outline-none transition-colors">
                        </div>
                        
                        <div>
                            <label for="message" class="block text-sm font-medium text-slate-300 mb-2">Message</label>
                            <textarea id="message" rows="5" placeholder="Your message here..." class="w-full bg-slate-800/50 border border-slate-700 rounded-xl px-4 py-3 text-white placeholder-slate-500 focus:border-teal-500 focus:ring-1 focus:ring-teal-500 outline-none transition-colors resize-none"></textarea>
                        </div>
                        
                        <button type="button" class="w-full inline-flex items-center justify-center px-6 py-4 border border-transparent text-base font-bold rounded-xl text-slate-950 bg-teal-500 hover:bg-teal-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500 focus:ring-offset-slate-950 transition-colors shadow-[0_0_20px_-5px_rgba(20,184,166,0.4)]">
                            Send Message
                        </button>
                    </form>
                </div>
            </div>

            <!-- Right Column - Contact Info -->
            <div class="animate-fade-up stagger-1 space-y-6">
                <!-- Info Cards -->
                <div class="glass-card p-6 rounded-2xl border border-slate-700 bg-slate-800/40 flex items-start gap-4">
                    <div class="w-12 h-12 rounded-full bg-teal-500/10 flex items-center justify-center text-teal-500 shrink-0 text-2xl">
                        📍
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-white mb-1">Address</h3>
                        <p class="text-slate-400 text-sm leading-relaxed">
                            Abdul Wali Khan University Mardan<br>
                            Garden Campus, Mardan<br>
                            Khyber Pakhtunkhwa, Pakistan
                        </p>
                    </div>
                </div>

                <div class="glass-card p-6 rounded-2xl border border-slate-700 bg-slate-800/40 flex items-start gap-4">
                    <div class="w-12 h-12 rounded-full bg-amber-500/10 flex items-center justify-center text-amber-500 shrink-0 text-2xl">
                        ✉️
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-white mb-1">Email</h3>
                        <p class="text-slate-400 text-sm mb-1">info@zehanat.org</p>
                        <p class="text-slate-500 text-xs">General inquiries and membership</p>
                    </div>
                </div>

                <div class="glass-card p-6 rounded-2xl border border-slate-700 bg-slate-800/40 flex items-start gap-4">
                    <div class="w-12 h-12 rounded-full bg-teal-500/10 flex items-center justify-center text-teal-500 shrink-0 text-2xl">
                        📞
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-white mb-1">Phone</h3>
                        <p class="text-slate-400 text-sm mb-1">+92-XXX-XXXXXXX</p>
                        <p class="text-slate-500 text-xs">Office hours: Mon-Fri, 9am-5pm</p>
                    </div>
                </div>

                <!-- Map Placeholder -->
                <div class="bg-slate-800/80 rounded-2xl aspect-video flex flex-col items-center justify-center border border-slate-700 relative overflow-hidden mt-8">
                    <div class="absolute inset-0 opacity-10 bg-[url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI0MCIgaGVpZ2h0PSI0MCI+CgkJPGc+CgkJCTxwb2x5Z29uIGZpbGw9IiNmZmZmZmYiIHBvaW50cz0iMjAgMCAyMCAwIDIwIDAgMjAgMCAwIDIwIDAgMjAgMCAyMCAwIDIwICIvPgoJCQk8cG9seWdvbiBmaWxsPSIjZmZmZmZmIiBwb2ludHM9IjQwIDIwIDQwIDIwIDQwIDIwIDQwIDIwIDIwIDQwIDIwIDQwIDIwIDQwIDIwIDQwICIvPgoJCTwvZz4KCTwvc3ZnPg==')] bg-[length:40px_40px]"></div>
                    <svg class="w-10 h-10 text-teal-500 mb-3 relative z-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    <span class="text-sm font-medium text-slate-400 relative z-10">Map — Abdul Wali Khan University Mardan</span>
                </div>

                <div class="text-center mt-6">
                    <p class="text-slate-400 text-sm">You can also reach us through our social media channels or visit us at AWKUM.</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
