<!-- Light Top Strip Bar (Engitech Header Top) -->
<div class="bg-[#f4f5f9] border-b border-[#e9ecef] text-[#606e7b] text-xs py-2.5 hidden lg:block relative z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex items-center justify-between">
        <!-- Left: Contact Details -->
        <div class="flex items-center space-x-6 font-medium">
            <div class="flex items-center space-x-2">
                <svg class="w-3.5 h-3.5 text-[#0c5adb]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                <span>AWKUM Campus, Mardan, KP</span>
            </div>
            <div class="h-3.5 w-px bg-slate-300"></div>
            <a href="mailto:zehanat@awkum.edu.pk" class="flex items-center space-x-2 hover:text-[#0c5adb] transition-colors">
                <svg class="w-3.5 h-3.5 text-[#0c5adb]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                </svg>
                <span>zehanat@awkum.edu.pk</span>
            </a>
            <div class="h-3.5 w-px bg-slate-300"></div>
            <div class="flex items-center space-x-2 text-slate-500">
                <svg class="w-3.5 h-3.5 text-[#0c5adb]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <span>Mon - Fri: 8:00 AM - 4:00 PM</span>
            </div>
        </div>

        <!-- Right: Social Links & Portal Login -->
        <div class="flex items-center space-x-5 font-medium">
            <div class="flex items-center space-x-3 text-slate-500">
                <a href="#" class="hover:text-[#0c5adb] transition-colors p-1" aria-label="Facebook">
                    <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                </a>
                <a href="#" class="hover:text-[#0c5adb] transition-colors p-1" aria-label="X/Twitter">
                    <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                </a>
                <a href="#" class="hover:text-[#0c5adb] transition-colors p-1" aria-label="LinkedIn">
                    <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 24 24"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg>
                </a>
            </div>

            <div class="h-3.5 w-px bg-slate-300"></div>

            @auth
                <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center gap-1.5 text-xs font-semibold text-[#0c5adb] hover:text-[#43baff] transition-colors">
                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    Dashboard
                </a>
            @else
                <a href="/login" class="inline-flex items-center gap-1.5 text-xs font-semibold text-[#101928] hover:text-[#0c5adb] transition-colors">
                    <svg class="w-3.5 h-3.5 text-[#0c5adb]" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/></svg>
                    Member Portal
                </a>
            @endauth
        </div>
    </div>
</div>

<!-- Main Clean White Sticky Navbar -->
<nav id="navbar" class="sticky top-0 z-50 bg-white border-b border-slate-100 shadow-sm transition-all duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-20">
            <!-- Brand Logo -->
            <div class="flex-shrink-0 flex items-center gap-3">
                <a href="/" class="flex items-center gap-3 group">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-[#0c5adb] to-[#43baff] flex items-center justify-center text-white font-black text-xl shadow-lg shadow-blue-600/20 group-hover:scale-105 transition-transform">
                        Z
                    </div>
                    <div class="flex flex-col">
                        <div class="flex items-center gap-2">
                            <span class="font-heading font-black text-2xl text-[#101928] tracking-tight">Zehanat</span>
                            <span class="text-[#0c5adb] text-lg font-normal" dir="rtl">ذہانت</span>
                        </div>
                        <span class="text-[10px] uppercase font-bold tracking-widest text-slate-400">KP AI Society</span>
                    </div>
                </a>
            </div>

            <!-- Desktop Nav Links -->
            <div class="hidden xl:flex items-center space-x-1 font-heading text-xs font-bold uppercase tracking-wider text-[#101928]">
                <a href="/" class="nav-link {{ request()->is('/') ? 'nav-link-active' : '' }} hover:text-[#0c5adb] transition-colors px-3.5 py-2.5 rounded-lg hover:bg-slate-50">Home</a>
                
                <div class="nav-item relative group">
                    <button class="nav-link {{ request()->is('about*') ? 'nav-link-active' : '' }} hover:text-[#0c5adb] transition-colors px-3.5 py-2.5 flex items-center gap-1 rounded-lg hover:bg-slate-50">
                        About
                        <svg class="w-3.5 h-3.5 text-slate-400 group-hover:text-[#0c5adb]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </button>
                    <div class="nav-dropdown absolute top-full left-0 mt-1 bg-white border border-slate-100 rounded-xl py-2 min-w-48 shadow-xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200">
                        <a href="/about#story" class="block px-4 py-2.5 text-xs text-[#101928] hover:text-[#0c5adb] hover:bg-slate-50 transition-colors border-l-2 border-transparent hover:border-[#0c5adb]">Our Story</a>
                        <a href="/about#patron" class="block px-4 py-2.5 text-xs text-[#101928] hover:text-[#0c5adb] hover:bg-slate-50 transition-colors border-l-2 border-transparent hover:border-[#0c5adb]">Patron's Message</a>
                        <a href="/about#governance" class="block px-4 py-2.5 text-xs text-[#101928] hover:text-[#0c5adb] hover:bg-slate-50 transition-colors border-l-2 border-transparent hover:border-[#0c5adb]">Governance</a>
                    </div>
                </div>

                <a href="/pillars" class="nav-link {{ request()->is('pillars*') ? 'nav-link-active' : '' }} hover:text-[#0c5adb] transition-colors px-3.5 py-2.5 rounded-lg hover:bg-slate-50">Our Six Pillars</a>

                <div class="nav-item relative group">
                    <button class="nav-link {{ request()->is('programs*') ? 'nav-link-active' : '' }} hover:text-[#0c5adb] transition-colors px-3.5 py-2.5 flex items-center gap-1 rounded-lg hover:bg-slate-50">
                        Programs
                        <svg class="w-3.5 h-3.5 text-slate-400 group-hover:text-[#0c5adb]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </button>
                    <div class="nav-dropdown absolute top-full left-0 mt-1 bg-white border border-slate-100 rounded-xl py-2 min-w-48 shadow-xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200">
                        <a href="/programs#schools" class="block px-4 py-2.5 text-xs text-[#101928] hover:text-[#0c5adb] hover:bg-slate-50 transition-colors border-l-2 border-transparent hover:border-[#0c5adb]">Schools</a>
                        <a href="/programs#colleges" class="block px-4 py-2.5 text-xs text-[#101928] hover:text-[#0c5adb] hover:bg-slate-50 transition-colors border-l-2 border-transparent hover:border-[#0c5adb]">Colleges</a>
                        <a href="/programs#universities" class="block px-4 py-2.5 text-xs text-[#101928] hover:text-[#0c5adb] hover:bg-slate-50 transition-colors border-l-2 border-transparent hover:border-[#0c5adb]">Universities</a>
                        <a href="/programs#industry" class="block px-4 py-2.5 text-xs text-[#101928] hover:text-[#0c5adb] hover:bg-slate-50 transition-colors border-l-2 border-transparent hover:border-[#0c5adb]">Industry</a>
                        <a href="/programs#public" class="block px-4 py-2.5 text-xs text-[#101928] hover:text-[#0c5adb] hover:bg-slate-50 transition-colors border-l-2 border-transparent hover:border-[#0c5adb]">Public</a>
                    </div>
                </div>

                <div class="nav-item relative group">
                    <button class="nav-link {{ request()->is('membership*') ? 'nav-link-active' : '' }} hover:text-[#0c5adb] transition-colors px-3.5 py-2.5 flex items-center gap-1 rounded-lg hover:bg-slate-50">
                        Membership
                        <svg class="w-3.5 h-3.5 text-slate-400 group-hover:text-[#0c5adb]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </button>
                    <div class="nav-dropdown absolute top-full left-0 mt-1 bg-white border border-slate-100 rounded-xl py-2 min-w-48 shadow-xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200">
                        <a href="/membership#categories" class="block px-4 py-2.5 text-xs text-[#101928] hover:text-[#0c5adb] hover:bg-slate-50 transition-colors border-l-2 border-transparent hover:border-[#0c5adb]">Categories</a>
                        <a href="/membership#join" class="block px-4 py-2.5 text-xs text-[#101928] hover:text-[#0c5adb] hover:bg-slate-50 transition-colors border-l-2 border-transparent hover:border-[#0c5adb]">Join Now</a>
                    </div>
                </div>

                <a href="/news-events" class="nav-link {{ request()->is('news-events*') ? 'nav-link-active' : '' }} hover:text-[#0c5adb] transition-colors px-3.5 py-2.5 rounded-lg hover:bg-slate-50">News & Events</a>
                <a href="/resources" class="nav-link {{ request()->is('resources*') ? 'nav-link-active' : '' }} hover:text-[#0c5adb] transition-colors px-3.5 py-2.5 rounded-lg hover:bg-slate-50">Resources</a>
                <a href="/faq" class="nav-link {{ request()->is('faq*') ? 'nav-link-active' : '' }} hover:text-[#0c5adb] transition-colors px-3.5 py-2.5 rounded-lg hover:bg-slate-50">FAQ</a>
                <a href="/contact" class="nav-link {{ request()->is('contact*') ? 'nav-link-active' : '' }} hover:text-[#0c5adb] transition-colors px-3.5 py-2.5 rounded-lg hover:bg-slate-50">Contact</a>
            </div>

            <!-- Right Action Area: Hotline Box + CTA Button + Off-Canvas Sidebar Trigger -->
            <div class="hidden sm:flex items-center gap-5">
                <!-- Call Hotline Box -->
                <div class="hidden lg:flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-blue-50 border border-blue-100 flex items-center justify-center text-[#0c5adb]">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                    </div>
                    <div class="flex flex-col">
                        <span class="text-[10px] uppercase font-bold text-slate-400">Call Us Today</span>
                        <a href="tel:+929379230640" class="text-xs font-heading font-extrabold text-[#101928] hover:text-[#0c5adb] transition-colors tracking-tight">
                            +92 937 9230640
                        </a>
                    </div>
                </div>

                <!-- Join Society CTA Button -->
                <a href="/membership" class="inline-flex items-center justify-center gap-2 rounded-xl bg-[#0c5adb] hover:bg-[#43baff] px-5 py-2.5 text-xs font-heading font-extrabold uppercase tracking-wider text-white shadow-lg shadow-blue-600/20 transition-all hover:scale-[1.02]">
                    Join Society
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                    </svg>
                </a>

                <!-- Engitech Off-Canvas Sidebar Trigger (9-Dot Grid Icon) -->
                <button id="side-panel-btn" class="w-10 h-10 rounded-xl bg-slate-50 border border-slate-200 hover:bg-[#0c5adb] hover:text-white text-[#101928] flex items-center justify-center transition-all p-2" aria-label="Open Side Panel">
                    <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                        <rect x="3" y="3" width="4" height="4" rx="1"/>
                        <rect x="10" y="3" width="4" height="4" rx="1"/>
                        <rect x="17" y="3" width="4" height="4" rx="1"/>
                        <rect x="3" y="10" width="4" height="4" rx="1"/>
                        <rect x="10" y="10" width="4" height="4" rx="1"/>
                        <rect x="17" y="10" width="4" height="4" rx="1"/>
                        <rect x="3" y="17" width="4" height="4" rx="1"/>
                        <rect x="10" y="17" width="4" height="4" rx="1"/>
                        <rect x="17" y="17" width="4" height="4" rx="1"/>
                    </svg>
                </button>
            </div>

            <!-- Mobile Menu Toggle Button -->
            <div class="xl:hidden flex items-center gap-3">
                <button id="mobile-menu-btn" class="text-[#101928] hover:text-[#0c5adb] focus:outline-none p-2 rounded-lg bg-slate-50 border border-slate-200">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>
</nav>

<!-- Engitech Right Off-Canvas Sidebar Panel Drawer -->
<div id="side-panel-overlay" class="engitech-side-panel-overlay"></div>
<aside id="side-panel" class="engitech-side-panel p-8 flex flex-col justify-between">
    <div>
        <!-- Side Panel Header with Logo & Close Button -->
        <div class="flex items-center justify-between pb-6 mb-8 border-b border-slate-100">
            <a href="/" class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-[#0c5adb] to-[#43baff] flex items-center justify-center text-white font-black text-lg shadow-md">
                    Z
                </div>
                <span class="font-heading font-black text-xl text-[#101928]">Zehanat</span>
            </a>
            <button id="side-panel-close" class="w-9 h-9 rounded-xl bg-slate-100 hover:bg-[#0c5adb] hover:text-white text-[#101928] flex items-center justify-center transition-colors">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        <!-- Overview Section -->
        <div class="space-y-4 mb-8">
            <span class="engitech-tag">// ABOUT SOCIETY</span>
            <h3 class="text-xl font-heading font-bold text-[#101928]">AI Education in KP</h3>
            <p class="text-xs text-[#606e7b] leading-relaxed">
                The Khyber Pakhtunkhwa Society for AI in Education — bridging research, classroom pedagogy, and institution capacity under Abdul Wali Khan University Mardan.
            </p>
        </div>

        <!-- Contact Cards Section -->
        <div class="space-y-4 mb-8">
            <h4 class="font-heading font-bold text-xs uppercase tracking-wider text-[#101928]">Contact Details</h4>
            
            <div class="p-4 rounded-xl bg-[#f4f6f9] border border-slate-100 flex items-start gap-3">
                <div class="w-8 h-8 rounded-lg bg-blue-100 text-[#0c5adb] flex items-center justify-center shrink-0">📍</div>
                <div>
                    <span class="text-[10px] font-bold uppercase text-slate-400 block">Address</span>
                    <span class="text-xs font-semibold text-[#101928]">AWKUM Campus, Mardan, KP, Pakistan</span>
                </div>
            </div>

            <div class="p-4 rounded-xl bg-[#f4f6f9] border border-slate-100 flex items-start gap-3">
                <div class="w-8 h-8 rounded-lg bg-cyan-100 text-[#0c5adb] flex items-center justify-center shrink-0">✉️</div>
                <div>
                    <span class="text-[10px] font-bold uppercase text-slate-400 block">Email</span>
                    <a href="mailto:zehanat@awkum.edu.pk" class="text-xs font-semibold text-[#101928] hover:text-[#0c5adb]">zehanat@awkum.edu.pk</a>
                </div>
            </div>

            <div class="p-4 rounded-xl bg-[#f4f6f9] border border-slate-100 flex items-start gap-3">
                <div class="w-8 h-8 rounded-lg bg-red-100 text-[#ff4b2b] flex items-center justify-center shrink-0">📞</div>
                <div>
                    <span class="text-[10px] font-bold uppercase text-slate-400 block">Direct Helpline</span>
                    <a href="tel:+929379230640" class="text-xs font-semibold text-[#101928] hover:text-[#0c5adb]">+92 937 9230640</a>
                </div>
            </div>
        </div>

        <!-- Quick Pillars Links -->
        <div class="space-y-3 mb-8">
            <h4 class="font-heading font-bold text-xs uppercase tracking-wider text-[#101928]">Our Pillars</h4>
            <div class="flex flex-wrap gap-2 text-xs font-semibold">
                <a href="/pillars#literacy" class="px-3 py-1.5 rounded-lg bg-slate-100 hover:bg-[#0c5adb] hover:text-white transition-colors">AI Literacy</a>
                <a href="/pillars#curriculum" class="px-3 py-1.5 rounded-lg bg-slate-100 hover:bg-[#0c5adb] hover:text-white transition-colors">Curriculum</a>
                <a href="/pillars#training" class="px-3 py-1.5 rounded-lg bg-slate-100 hover:bg-[#0c5adb] hover:text-white transition-colors">Faculty Training</a>
                <a href="/pillars#ethics" class="px-3 py-1.5 rounded-lg bg-slate-100 hover:bg-[#0c5adb] hover:text-white transition-colors">AI Ethics</a>
            </div>
        </div>
    </div>

    <!-- Bottom Social & CTA -->
    <div class="pt-6 border-t border-slate-100 space-y-4">
        <a href="/membership" class="w-full inline-flex items-center justify-center gap-2 rounded-xl bg-[#0c5adb] hover:bg-[#43baff] px-6 py-3 text-xs font-heading font-extrabold uppercase tracking-wider text-white shadow-lg shadow-blue-600/20">
            Join Society Now
        </a>
        <p class="text-center text-[11px] text-slate-400">&copy; {{ date('Y') }} Zehanat AWKUM. All rights reserved.</p>
    </div>
</aside>

<!-- Mobile Menu Overlay -->
<div id="mobile-menu" class="mobile-menu fixed inset-0 z-50 bg-white hidden flex-col overflow-y-auto">
    <div class="flex items-center justify-between h-20 px-6 border-b border-slate-100">
        <a href="/" class="flex items-center gap-3">
            <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-[#0c5adb] to-[#43baff] flex items-center justify-center text-white font-black text-lg">
                Z
            </div>
            <span class="font-heading font-black text-xl text-[#101928]">Zehanat</span>
        </a>
        <button id="mobile-menu-close" class="text-slate-500 hover:text-[#101928] p-2 rounded-lg bg-slate-100">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
    </div>
    <div class="p-6 space-y-4 font-heading text-sm font-bold uppercase tracking-wider text-[#101928]">
        <a href="/" class="block hover:text-[#0c5adb] py-2">Home</a>
        <a href="/about" class="block hover:text-[#0c5adb] py-2">About Us</a>
        <a href="/pillars" class="block hover:text-[#0c5adb] py-2">Our Six Pillars</a>
        <a href="/programs" class="block hover:text-[#0c5adb] py-2">Programs</a>
        <a href="/membership" class="block hover:text-[#0c5adb] py-2">Membership</a>
        <a href="/news-events" class="block hover:text-[#0c5adb] py-2">News & Events</a>
        <a href="/resources" class="block hover:text-[#0c5adb] py-2">Resources</a>
        <a href="/faq" class="block hover:text-[#0c5adb] py-2">FAQ</a>
        <a href="/contact" class="block hover:text-[#0c5adb] py-2">Contact Us</a>

        <div class="pt-6 border-t border-slate-100 space-y-4">
            <div class="flex flex-col gap-1">
                <span class="text-[10px] uppercase font-bold text-slate-400">Direct Helpline</span>
                <a href="tel:+929379230640" class="text-sm font-black text-[#0c5adb]">+92 937 9230640</a>
            </div>
            <a href="/membership" class="w-full inline-flex items-center justify-center gap-2 rounded-xl bg-[#0c5adb] px-6 py-3.5 text-xs font-extrabold uppercase tracking-wider text-white shadow-lg">
                Join Society Now
            </a>
        </div>
    </div>
</div>
