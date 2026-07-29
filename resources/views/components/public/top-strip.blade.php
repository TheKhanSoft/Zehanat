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
                <span class="group-hover:text-primary transition-colors duration-200">AWKUM Campus, Mardan, KP</span>
            </div>
            
            <a href="mailto:zehanat@awkum.edu.pk" class="flex items-center gap-2 group cursor-pointer">
                <svg class="w-3.5 h-3.5 text-primary group-hover:scale-110 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                </svg>
                <span class="group-hover:text-primary transition-colors duration-200">zehanat@awkum.edu.pk</span>
            </a>
            
            <div class="flex items-center gap-2 group cursor-pointer">
                <svg class="w-3.5 h-3.5 text-primary group-hover:scale-110 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <span class="group-hover:text-primary transition-colors duration-200">Mon - Fri: 8:00 AM - 4:00 PM</span>
            </div>
        </div>

        <!-- Right: Social Links & Portal Login -->
        <div class="flex items-center gap-5">
            <div class="flex items-center gap-4">
                <a href="#" class="text-slate-400 hover:text-[#1877f2] hover:-translate-y-0.5 hover:scale-110 transition-all duration-200" aria-label="Facebook">
                    <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                </a>
                <span class="text-slate-300">|</span>
                <a href="#" class="text-slate-400 hover:text-dark hover:-translate-y-0.5 hover:scale-110 transition-all duration-200" aria-label="X/Twitter">
                    <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                </a>
                <span class="text-slate-300">|</span>
                <a href="#" class="text-slate-400 hover:text-[#0a66c2] hover:-translate-y-0.5 hover:scale-110 transition-all duration-200" aria-label="LinkedIn">
                    <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 24 24"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg>
                </a>
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
