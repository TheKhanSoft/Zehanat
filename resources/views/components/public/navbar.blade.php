<x-public.top-strip />

<!-- Main Clean White Sticky Navbar -->
<nav id="navbar" class="sticky top-0 z-50 bg-white shadow-[0_5px_20px_rgba(0,0,0,0.05)] transition-all duration-300">
    <div class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-[100px]">
            <!-- Brand Logo -->
            <div class="flex-shrink-0">
                <a href="/" class="flex items-center gap-3 group">
                    <img src="{{ asset('images/logo.jpg') }}" alt="Zehanat" class="h-[50px] w-auto">
                    <span class="font-heading font-extrabold text-[28px] text-[#1b1d21] tracking-tight">Zehanat</span>
                </a>
            </div>

            <!-- Desktop Nav Links -->
            <div class="hidden xl:flex items-center gap-9 font-heading text-[15px] font-bold text-[#1b1d21] h-full">
                
                <div class="relative group h-full flex items-center">
                    <a href="/" class="flex items-center gap-1 {{ request()->is('/') ? 'text-primary' : '' }} hover:text-primary transition-colors duration-200">
                        Home
                    </a>
                </div>
                
                <div class="relative group h-full flex items-center">
                    <button class="flex items-center gap-1 {{ request()->is('about*') ? 'text-primary' : '' }} hover:text-primary transition-colors duration-200">
                        About <svg class="w-3.5 h-3.5 mt-0.5 text-slate-400 group-hover:text-primary transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <!-- Simple Dropdown -->
                    <div class="absolute left-0 top-[100px] w-[220px] bg-white shadow-[0_10px_30px_rgba(0,0,0,0.1)] border-t-[3px] border-primary flex flex-col py-3 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 transform translate-y-3 group-hover:translate-y-0 before:absolute before:-top-4 before:left-0 before:right-0 before:h-4">
                        <a href="/about#story" class="px-6 py-2.5 text-[14px] text-[#5e6278] font-body font-medium hover:text-primary hover:bg-slate-50 transition-colors">Our Story</a>
                        <a href="/about#patron" class="px-6 py-2.5 text-[14px] text-[#5e6278] font-body font-medium hover:text-primary hover:bg-slate-50 transition-colors">Patron's Message</a>
                        <a href="/about#governance" class="px-6 py-2.5 text-[14px] text-[#5e6278] font-body font-medium hover:text-primary hover:bg-slate-50 transition-colors">Governance</a>
                    </div>
                </div>

                <div class="relative group h-full flex items-center">
                    <a href="/pillars" class="flex items-center gap-1 {{ request()->is('pillars*') ? 'text-primary' : '' }} hover:text-primary transition-colors duration-200">
                        Our Six Pillars
                    </a>
                </div>

                <div class="relative group h-full flex items-center">
                    <button class="flex items-center gap-1 {{ request()->is('programs*') ? 'text-primary' : '' }} hover:text-primary transition-colors duration-200">
                        Programs <svg class="w-3.5 h-3.5 mt-0.5 text-slate-400 group-hover:text-primary transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <!-- Mega Menu -->
                    <div class="absolute left-1/2 -translate-x-1/2 top-[100px] w-[600px] bg-white shadow-[0_10px_30px_rgba(0,0,0,0.1)] border-t-[3px] border-primary p-8 flex gap-10 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 transform translate-y-3 group-hover:translate-y-0 before:absolute before:-top-4 before:left-0 before:right-0 before:h-4">
                        <div class="flex-1">
                            <h4 class="font-heading font-extrabold text-[#1b1d21] mb-5 text-[16px]">Academic Sector</h4>
                            <ul class="space-y-4">
                                <li><a href="/programs#schools" class="text-[14px] font-body font-medium text-[#5e6278] hover:text-primary transition-colors flex items-center gap-3"><div class="w-2 h-2 rounded-sm bg-primary/30"></div> For Schools</a></li>
                                <li><a href="/programs#colleges" class="text-[14px] font-body font-medium text-[#5e6278] hover:text-primary transition-colors flex items-center gap-3"><div class="w-2 h-2 rounded-sm bg-primary/30"></div> For Colleges</a></li>
                                <li><a href="/programs#universities" class="text-[14px] font-body font-medium text-[#5e6278] hover:text-primary transition-colors flex items-center gap-3"><div class="w-2 h-2 rounded-sm bg-primary/30"></div> For Universities</a></li>
                            </ul>
                        </div>
                        <div class="w-px bg-slate-100"></div>
                        <div class="flex-1">
                            <h4 class="font-heading font-extrabold text-[#1b1d21] mb-5 text-[16px]">Professional Sector</h4>
                            <ul class="space-y-4">
                                <li><a href="/programs#industry" class="text-[14px] font-body font-medium text-[#5e6278] hover:text-primary transition-colors flex items-center gap-3"><div class="w-2 h-2 rounded-sm bg-primary/30"></div> For Industry</a></li>
                                <li><a href="/programs#public" class="text-[14px] font-body font-medium text-[#5e6278] hover:text-primary transition-colors flex items-center gap-3"><div class="w-2 h-2 rounded-sm bg-primary/30"></div> For the Public</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="relative group h-full flex items-center">
                    <button class="flex items-center gap-1 {{ request()->is('membership*') ? 'text-primary' : '' }} hover:text-primary transition-colors duration-200">
                        Membership <svg class="w-3.5 h-3.5 mt-0.5 text-slate-400 group-hover:text-primary transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <!-- Simple Dropdown -->
                    <div class="absolute left-0 top-[100px] w-[220px] bg-white shadow-[0_10px_30px_rgba(0,0,0,0.1)] border-t-[3px] border-primary flex flex-col py-3 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 transform translate-y-3 group-hover:translate-y-0 before:absolute before:-top-4 before:left-0 before:right-0 before:h-4">
                        <a href="/membership#categories" class="px-6 py-2.5 text-[14px] text-[#5e6278] font-body font-medium hover:text-primary hover:bg-slate-50 transition-colors">Categories</a>
                        <a href="/membership#join" class="px-6 py-2.5 text-[14px] text-[#5e6278] font-body font-medium hover:text-primary hover:bg-slate-50 transition-colors">Join Now</a>
                    </div>
                </div>

                <div class="relative group h-full flex items-center">
                    <a href="/news-events" class="flex items-center gap-1 {{ request()->is('news-events*') ? 'text-primary' : '' }} hover:text-primary transition-colors duration-200">
                        News & Events
                    </a>
                </div>
                
                <div class="relative group h-full flex items-center">
                    <a href="/contact" class="flex items-center gap-1 {{ request()->is('contact*') ? 'text-primary' : '' }} hover:text-primary transition-colors duration-200">
                        Contact
                    </a>
                </div>
            </div>

            <!-- Right Action Area (Engitech Icons) -->
            <div class="hidden sm:flex items-center gap-6 ml-4">
                
                <!-- Search Icon -->
                <button class="text-[#1b1d21] hover:text-primary transition-colors">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </button>

                <!-- User/Dashboard (Instead of Cart) -->
                <a href="{{ route('admin.dashboard') }}" class="relative text-[#1b1d21] hover:text-primary transition-colors">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    @auth
                    <span class="absolute -top-2 -right-2 w-4 h-4 bg-primary text-white text-[9px] font-black rounded-full flex items-center justify-center">1</span>
                    @endauth
                </a>

                <!-- Off-Canvas Sidebar Trigger (Grid Icon) -->
                <button id="side-panel-btn" class="text-[#1b1d21] hover:text-primary transition-colors ml-2" aria-label="Open Side Panel">
                    <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24">
                        <rect x="3" y="3" width="4.5" height="4.5" rx="0"/>
                        <rect x="10.5" y="3" width="4.5" height="4.5" rx="0"/>
                        <rect x="18" y="3" width="4.5" height="4.5" rx="0"/>
                        <rect x="3" y="10.5" width="4.5" height="4.5" rx="0"/>
                        <rect x="10.5" y="10.5" width="4.5" height="4.5" rx="0"/>
                        <rect x="18" y="10.5" width="4.5" height="4.5" rx="0"/>
                        <rect x="3" y="18" width="4.5" height="4.5" rx="0"/>
                        <rect x="10.5" y="18" width="4.5" height="4.5" rx="0"/>
                        <rect x="18" y="18" width="4.5" height="4.5" rx="0"/>
                    </svg>
                </button>
            </div>

            <!-- Mobile Menu Toggle Button -->
            <div class="xl:hidden flex items-center gap-3">
                <button id="mobile-menu-btn" class="text-[#1b1d21] hover:text-primary focus:outline-none p-2">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>
</nav>

<!-- Engitech Right Off-Canvas Sidebar Panel Drawer -->
<div id="side-panel-overlay" class="engitech-side-panel-overlay"></div>
<aside id="side-panel" class="engitech-side-panel p-8 flex flex-col justify-between bg-white text-body">
    <div>
        <!-- Side Panel Header with Logo & Close Button -->
        <div class="flex items-center justify-between pb-6 mb-8 border-b border-slate-100">
            <a href="/" class="flex items-center gap-3">
                <img src="{{ asset('images/logo.jpg') }}" alt="Zehanat" class="h-10 w-auto rounded shadow-sm">
                <span class="font-heading font-black text-2xl text-dark">Zehanat</span>
            </a>
            <button id="side-panel-close" class="w-10 h-10 hover:text-primary text-dark flex items-center justify-center transition-colors">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        <div class="space-y-4 mb-8">
            <h3 class="text-2xl font-heading font-bold text-dark mb-4">AI Education in KP</h3>
            <p class="text-[15px] leading-relaxed text-body">
                The Khyber Pakhtunkhwa Society for AI in Education — bridging research, classroom pedagogy, and institution capacity under Abdul Wali Khan University Mardan.
            </p>
        </div>

        <!-- Contact Details Section -->
        <div class="space-y-4 mb-8">
            <h4 class="font-heading font-bold text-sm uppercase tracking-wider text-dark mb-4">Contact Details</h4>
            
            <div class="flex items-start gap-4 mb-4">
                <div class="text-primary mt-1">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path></svg>
                </div>
                <div>
                    <span class="font-bold text-dark block text-sm">Our Address:</span>
                    <span class="text-body text-sm">AWKUM Campus, Mardan, KP, Pakistan</span>
                </div>
            </div>

            <div class="flex items-start gap-4 mb-4">
                <div class="text-primary mt-1">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                </div>
                <div>
                    <span class="font-bold text-dark block text-sm">Our Mailbox:</span>
                    <a href="mailto:zehanat@awkum.edu.pk" class="text-body hover:text-primary text-sm transition-colors">zehanat@awkum.edu.pk</a>
                </div>
            </div>

            <div class="flex items-start gap-4 mb-4">
                <div class="text-primary mt-1">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                </div>
                <div>
                    <span class="font-bold text-dark block text-sm">Our Phone:</span>
                    <a href="tel:+929379230640" class="text-body hover:text-primary text-sm transition-colors">+92 937 9230640</a>
                </div>
            </div>
        </div>

    </div>

    <!-- Bottom Social & CTA -->
    <div class="pt-6 border-t border-slate-100">
        <a href="/membership" class="engitech-btn w-full">Join Society Now</a>
    </div>
</aside>

<!-- Mobile Menu Overlay -->
<div id="mobile-menu" class="mobile-menu fixed inset-0 z-[100] bg-white hidden flex-col overflow-y-auto">
    <div class="flex items-center justify-between h-[90px] px-6 border-b border-slate-100">
        <a href="/" class="flex items-center gap-3">
            <img src="{{ asset('images/logo.jpg') }}" alt="Zehanat" class="h-10 w-auto rounded shadow-sm">
            <span class="font-heading font-black text-2xl text-dark">Zehanat</span>
        </a>
        <button id="mobile-menu-close" class="text-dark hover:text-primary p-2">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
    </div>
    <div class="p-6 space-y-4 font-heading text-[15px] font-bold uppercase tracking-wider text-dark">
        <a href="/" class="block hover:text-primary py-2 border-b border-slate-100">Home</a>
        <a href="/about" class="block hover:text-primary py-2 border-b border-slate-100">About Us</a>
        <a href="/pillars" class="block hover:text-primary py-2 border-b border-slate-100">Our Six Pillars</a>
        <a href="/programs" class="block hover:text-primary py-2 border-b border-slate-100">Programs</a>
        <a href="/membership" class="block hover:text-primary py-2 border-b border-slate-100">Membership</a>
        <a href="/news-events" class="block hover:text-primary py-2 border-b border-slate-100">News & Events</a>
        <a href="/contact" class="block hover:text-primary py-2 border-b border-slate-100">Contact Us</a>

        <div class="pt-6">
            <a href="/membership" class="engitech-btn w-full">Join Society Now</a>
        </div>
    </div>
</div>
