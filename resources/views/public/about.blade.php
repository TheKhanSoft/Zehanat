@extends('layouts.public')

@section('title', 'About - Zehanat')
@section('meta_description', 'About Zehanat - Our story, leadership, and the vision driving AI education in Khyber Pakhtunkhwa.')

@section('content')
    <!-- Section 1: Page Banner -->
    <x-public.page-banner title="About Zehanat" :breadcrumbs="[['label' => 'Home', 'url' => '/'], ['label' => 'About Zehanat']]">
        Our story, leadership, and the vision driving AI education in Khyber Pakhtunkhwa.
    </x-public.page-banner>

    <!-- Section 2: Our Story -->
    <section id="our-story" class="py-20 md:py-28 bg-slate-950">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <x-public.section-heading title="Our Story" subtitle="How we started and where we are heading" align="center" />
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 mt-16 items-center">
                <div class="animate-fade-up stagger-1 prose prose-invert prose-lg text-slate-300">
                    <p class="mb-6">Zehanat — meaning 'intelligence' (ذہانت) in Urdu — was founded with a clear conviction: that Artificial Intelligence should not remain the privilege of elite institutions or distant countries. Every school in Swat, every college in Peshawar, every university across Khyber Pakhtunkhwa deserves to understand, engage with, and benefit from this transformative technology.</p>
                    <p class="mb-6">Hosted by Abdul Wali Khan University Mardan (AWKUM), one of the province's leading public universities, Zehanat brings together educators, researchers, students, administrators, and industry partners under one banner. Together, we are building a future where AI literacy is as fundamental as reading and writing.</p>
                    <p>Our name was chosen with care. 'Zehanat' carries warmth and cultural familiarity, avoiding intimidating jargon while pointing clearly to our mission. The English subtitle — The Khyber Pakhtunkhwa Society for AI in Education — explains our scope for formal and international audiences.</p>
                </div>
                
                <div class="animate-fade-up stagger-2 relative">
                    <!-- Timeline Visual -->
                    <div class="absolute left-[27px] top-4 bottom-4 w-[2px] bg-teal-900 rounded-full"></div>
                    
                    <div class="space-y-12">
                        <div class="relative pl-16">
                            <div class="absolute left-0 top-1 w-14 h-14 rounded-full bg-slate-900 border-4 border-teal-500 flex items-center justify-center z-10 shadow-[0_0_15px_rgba(20,184,166,0.5)]">
                                <span class="text-xs font-bold text-white">2025</span>
                            </div>
                            <div class="glass-card p-6 rounded-xl border border-teal-500/20 bg-slate-900/80">
                                <h4 class="text-xl font-bold text-white mb-2">Society Founded</h4>
                                <p class="text-slate-400">The vision takes shape with the establishment of Zehanat.</p>
                            </div>
                        </div>
                        
                        <div class="relative pl-16">
                            <div class="absolute left-0 top-1 w-14 h-14 rounded-full bg-slate-900 border-4 border-teal-500 flex items-center justify-center z-10">
                                <span class="text-xs font-bold text-white">2025</span>
                            </div>
                            <div class="glass-card p-6 rounded-xl border border-white/5 bg-slate-900/50">
                                <h4 class="text-xl font-bold text-white mb-2">Hosted by AWKUM</h4>
                                <p class="text-slate-400">Academic partnership forged with Abdul Wali Khan University Mardan.</p>
                            </div>
                        </div>
                        
                        <div class="relative pl-16">
                            <div class="absolute left-0 top-1 w-14 h-14 rounded-full bg-slate-900 border-4 border-teal-500 flex items-center justify-center z-10">
                                <span class="text-xs font-bold text-white">2025</span>
                            </div>
                            <div class="glass-card p-6 rounded-xl border border-white/5 bg-slate-900/50">
                                <h4 class="text-xl font-bold text-white mb-2">First Programs Launched</h4>
                                <p class="text-slate-400">Initial workshops, training modules, and awareness campaigns roll out.</p>
                            </div>
                        </div>
                        
                        <div class="relative pl-16 opacity-70">
                            <div class="absolute left-0 top-1 w-14 h-14 rounded-full bg-slate-900 border-4 border-amber-500 border-dashed flex items-center justify-center z-10">
                                <span class="text-xs font-bold text-white text-center leading-tight">Future</span>
                            </div>
                            <div class="glass-card p-6 rounded-xl border border-white/5 bg-slate-900/30">
                                <h4 class="text-xl font-bold text-white mb-2">Province-wide Impact</h4>
                                <p class="text-slate-400">AI curriculum integrated across all educational tiers in KP.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section 3: Patron's Message -->
    <section id="patrons-message" class="py-20 md:py-28 bg-slate-900/50">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <x-public.section-heading title="Patron's Message" subtitle="Guidance from our leadership" align="center" />
            
            <div class="mt-12 animate-fade-up">
                <x-public.testimonial-card name="Patron in Chief" role="Abdul Wali Khan University Mardan">
                    "The Patron's message is coming soon. We look forward to sharing the vision and guidance of our esteemed patron as we embark on this transformative journey for education in Khyber Pakhtunkhwa."
                </x-public.testimonial-card>
            </div>
            
            <div class="mt-8 max-w-2xl mx-auto animate-fade-up stagger-1">
                <x-public.alert type="info">The Patron's message will be updated soon. Please check back later for the full statement.</x-public.alert>
            </div>
        </div>
    </section>

    <!-- Section 4: Governance -->
    <section id="governance" class="py-20 md:py-28 bg-slate-950">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <x-public.section-heading title="Governance Structure" subtitle="The team driving our mission forward" align="center" />
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 mt-16">
                @php
                    $roles = [
                        ['title' => 'Patron in Chief', 'icon' => '🏛️'],
                        ['title' => 'President', 'icon' => '⭐'],
                        ['title' => 'Vice President', 'icon' => '🌟'],
                        ['title' => 'Secretary General', 'icon' => '📝'],
                        ['title' => 'Treasurer', 'icon' => '💼'],
                        ['title' => 'Advisory Board', 'icon' => '🧭']
                    ];
                @endphp

                @foreach($roles as $index => $role)
                <div class="glass-card p-8 rounded-2xl border border-white/5 bg-slate-900/60 text-center animate-fade-up group hover:border-teal-500/30 transition-all duration-300" style="animation-delay: {{ $index * 100 }}ms;">
                    <div class="w-24 h-24 mx-auto rounded-full bg-slate-800 border-2 border-slate-700 flex items-center justify-center text-4xl mb-6 shadow-inner group-hover:border-teal-500 transition-colors duration-300">
                        {{ $role['icon'] }}
                    </div>
                    <h4 class="text-xl font-bold text-white mb-2">{{ $role['title'] }}</h4>
                    <span class="inline-block px-3 py-1 bg-slate-800 text-slate-400 text-sm rounded-full">To be announced</span>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Section 5: CTA Banner -->
    <x-public.cta-banner title="Want to Be Part of Our Story?" subtitle="Join Zehanat today as a member or partner institution.">
        <x-public.btn variant="primary" size="lg" href="/membership">Join Zehanat</x-public.btn>
    </x-public.cta-banner>

@endsection
