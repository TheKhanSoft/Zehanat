<!-- Light Top Strip Bar (Enhanced UX) -->
<div class="bg-slate-50 border-b border-slate-200 text-slate-600 py-1.5 hidden lg:block relative z-50 font-body text-[12px] font-medium">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex items-center justify-between h-[30px]">
        <!-- Left: Contact Details -->
        <div class="flex items-center gap-6">
            <div class="flex items-center gap-2 group cursor-pointer">
                <svg class="w-3.5 h-3.5 text-primary group-hover:scale-110 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                <span class="group-hover:text-primary transition-colors duration-200">{{ setting('contact_address_short', 'AWKUM Campus, Mardan, KP') }}</span>
            </div>
            
            <a href="mailto:{{ setting('contact_email', 'zehanat@awkum.edu.pk') }}" class="flex items-center gap-2 group cursor-pointer">
                <svg class="w-3.5 h-3.5 text-primary group-hover:scale-110 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                </svg>
                <span class="group-hover:text-primary transition-colors duration-200">{{ setting('contact_email', 'zehanat@awkum.edu.pk') }}</span>
            </a>
            
            <div class="flex items-center gap-2 group cursor-pointer">
                <svg class="w-3.5 h-3.5 text-primary group-hover:scale-110 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <span class="group-hover:text-primary transition-colors duration-200">{{ setting('contact_hours', 'Mon - Fri: 8:00 AM - 4:00 PM') }}</span>
            </div>
        </div>

        <!-- Right: Social Links & Portal Login -->
        <div class="flex items-center gap-5">
            <div class="flex items-center gap-4">
                @php
                    $socials = setting('social_networks');
                    if (is_string($socials)) $socials = json_decode($socials, true);
                    if (!is_array($socials)) $socials = [];
                @endphp
                @foreach($socials as $index => $social)
                    <a href="{{ $social['url'] }}" class="text-slate-400 hover:text-primary hover:-translate-y-0.5 hover:scale-110 transition-all duration-200" aria-label="{{ ucfirst($social['platform']) }}" target="_blank" rel="noopener noreferrer">
                        <x-public.social-icon platform="{{ $social['platform'] }}" class="w-3.5 h-3.5 fill-current" />
                    </a>
                    @if(!$loop->last)
                        <span class="text-slate-300">|</span>
                    @endif
                @endforeach
            </div>

            <span class="text-slate-300">|</span>

            @auth
                <a href="{{ route('admin.dashboard') }}" class="group flex items-center gap-1.5 text-primary font-semibold hover:text-dark transition-colors duration-200">
                    <svg class="w-3.5 h-3.5 group-hover:scale-110 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    Dashboard
                </a>
            @else
                <a href="/login" class="group flex items-center gap-1.5 text-dark font-semibold hover:text-primary transition-colors duration-200">
                    <svg class="w-3.5 h-3.5 text-primary group-hover:scale-110 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/></svg>
                    Member Portal
                </a>
            @endauth
        </div>
    </div>
</div>
