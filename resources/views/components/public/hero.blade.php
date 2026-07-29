@props([
    'showParticles' => false,
])

<section id="hero-slider-wrapper" class="hero-slider-container h-[600px] lg:h-[650px] w-full flex items-center bg-[#111]">

    <!-- SLIDE 1: WE ARE ENGITECH -->
    <div data-hero-slide="0" class="hero-slide active absolute inset-0 w-full h-full flex items-center">
        <div class="hero-bg-layer" style="background-image: url('{{ asset('images/slider/slider1.jpg') }}');"></div>
        <div class="hero-content-wrapper relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full text-center lg:text-left">
            <div class="max-w-3xl">
                <div class="layer-tag engitech-tag mb-4 bg-black/40 px-4 py-1.5 rounded-sm backdrop-blur-sm inline-block shadow-lg">
                    <span class="text-white tracking-widest text-sm drop-shadow-md" style="color: #ffffff !important;">WE ARE ENGITECH</span>
                </div>
                <h1 class="layer-title text-5xl sm:text-6xl lg:text-7xl font-heading font-extrabold text-white tracking-tight leading-[1.1] mb-6 drop-shadow-[0_4px_8px_rgba(0,0,0,0.8)]" style="color: #ffffff !important;">
                    IT Solutions & <br><span class="text-primary drop-shadow-[0_4px_8px_rgba(0,0,0,0.8)]">Technology</span>
                </h1>
                <p class="layer-subtext text-lg sm:text-xl text-slate-100 mb-10 max-w-2xl font-light drop-shadow-[0_2px_4px_rgba(0,0,0,0.8)]" style="color: #f8fafc !important;">
                    We are the architects of the digital age, bringing innovative IT solutions and services to empower your business.
                </p>
                <div class="layer-actions flex flex-wrap items-center justify-center lg:justify-start gap-4">
                    <a href="/services" class="engitech-btn shadow-lg">Our Services</a>
                    <a href="/contact" class="engitech-btn engitech-btn-transparent shadow-lg bg-black/30 backdrop-blur-sm border-white/50 text-white">Learn More</a>
                </div>
            </div>
        </div>
    </div>

    <!-- SLIDE 2: CYBERSECURITY -->
    <div data-hero-slide="1" class="hero-slide absolute inset-0 w-full h-full flex items-center">
        <div class="hero-bg-layer" style="background-image: url('{{ asset('images/slider/slider2.jpg') }}');"></div>
        <div class="hero-content-wrapper relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full text-center lg:text-left">
            <div class="max-w-3xl">
                <div class="layer-tag engitech-tag mb-4 bg-black/40 px-4 py-1.5 rounded-sm backdrop-blur-sm inline-block shadow-lg">
                    <span class="text-white tracking-widest text-sm drop-shadow-md" style="color: #ffffff !important;">CYBERSECURITY</span>
                </div>
                <h1 class="layer-title text-5xl sm:text-6xl lg:text-7xl font-heading font-extrabold text-white tracking-tight leading-[1.1] mb-6 drop-shadow-[0_4px_8px_rgba(0,0,0,0.8)]" style="color: #ffffff !important;">
                    Protect & Innovate Your <br><span class="text-primary drop-shadow-[0_4px_8px_rgba(0,0,0,0.8)]">Digital Future</span>
                </h1>
                <p class="layer-subtext text-lg sm:text-xl text-slate-100 mb-10 max-w-2xl font-light drop-shadow-[0_2px_4px_rgba(0,0,0,0.8)]" style="color: #f8fafc !important;">
                    Advanced security frameworks to protect your data, ensuring trust and reliability in an interconnected world.
                </p>
                <div class="layer-actions flex flex-wrap items-center justify-center lg:justify-start gap-4">
                    <a href="/security" class="engitech-btn shadow-lg">Discover More</a>
                </div>
            </div>
        </div>
    </div>

    <!-- SLIDE 3: CLOUD COMPUTING -->
    <div data-hero-slide="2" class="hero-slide absolute inset-0 w-full h-full flex items-center">
        <div class="hero-bg-layer" style="background-image: url('{{ asset('images/slider/slider3.jpg') }}');"></div>
        <div class="hero-content-wrapper relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full text-center lg:text-left">
            <div class="max-w-3xl">
                <div class="layer-tag engitech-tag mb-4 bg-black/40 px-4 py-1.5 rounded-sm backdrop-blur-sm inline-block shadow-lg">
                    <span class="text-white tracking-widest text-sm drop-shadow-md" style="color: #ffffff !important;">CLOUD COMPUTING</span>
                </div>
                <h1 class="layer-title text-5xl sm:text-6xl lg:text-7xl font-heading font-extrabold text-white tracking-tight leading-[1.1] mb-6 drop-shadow-[0_4px_8px_rgba(0,0,0,0.8)]" style="color: #ffffff !important;">
                    Design & Tech Driven <br><span class="text-primary drop-shadow-[0_4px_8px_rgba(0,0,0,0.8)]">Transformation</span>
                </h1>
                <p class="layer-subtext text-lg sm:text-xl text-slate-100 mb-10 max-w-2xl font-light drop-shadow-[0_2px_4px_rgba(0,0,0,0.8)]" style="color: #f8fafc !important;">
                    Scalable cloud infrastructure connecting systems and empowering businesses with actionable insights and performance.
                </p>
                <div class="layer-actions flex flex-wrap items-center justify-center lg:justify-start gap-4">
                    <a href="/cloud" class="engitech-btn shadow-lg">Cloud Solutions</a>
                    <a href="/contact" class="engitech-btn engitech-btn-transparent shadow-lg bg-black/30 backdrop-blur-sm border-white/50 text-white">Get Quote</a>
                </div>
            </div>
        </div>
    </div>

    <!-- SLIDE 4: WE ARE ZEHANAT -->
    <div data-hero-slide="3" class="hero-slide absolute inset-0 w-full h-full flex items-center">
        <div class="hero-bg-layer" style="background-image: url('{{ asset('images/slider/slider4.jpg') }}');"></div>
        <div class="hero-content-wrapper relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full text-center lg:text-left">
            <div class="max-w-3xl">
                <div class="layer-tag engitech-tag mb-4 bg-black/40 px-4 py-1.5 rounded-sm backdrop-blur-sm inline-block shadow-lg">
                    <span class="text-white tracking-widest text-sm drop-shadow-md" style="color: #ffffff !important;">WE ARE ZEHANAT</span>
                </div>
                <h1 class="layer-title text-5xl sm:text-6xl lg:text-7xl font-heading font-extrabold text-white tracking-tight leading-[1.1] mb-6 drop-shadow-[0_4px_8px_rgba(0,0,0,0.8)]" style="color: #ffffff !important;">
                    Software & AI Solutions For <br><span class="text-primary drop-shadow-[0_4px_8px_rgba(0,0,0,0.8)]">Education</span>
                </h1>
                <p class="layer-subtext text-lg sm:text-xl text-slate-100 mb-10 max-w-2xl font-light drop-shadow-[0_2px_4px_rgba(0,0,0,0.8)]" style="color: #f8fafc !important;">
                    Empowering educators, students, researchers, and institutions across Khyber Pakhtunkhwa under AWKUM.
                </p>
                <div class="layer-actions flex flex-wrap items-center justify-center lg:justify-start gap-4">
                    <a href="/membership" class="engitech-btn shadow-lg">Become A Member</a>
                    <a href="/programs" class="engitech-btn engitech-btn-transparent shadow-lg bg-black/30 backdrop-blur-sm border-white/50 text-white">Explore Programs</a>
                </div>
            </div>
        </div>
    </div>

    <!-- SLIDE 5: FACULTY TRAINING -->
    <div data-hero-slide="4" class="hero-slide absolute inset-0 w-full h-full flex items-center">
        <div class="hero-bg-layer" style="background-image: url('{{ asset('images/slider/slider5.jpg') }}');"></div>
        <div class="hero-content-wrapper relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full text-center lg:text-left">
            <div class="max-w-3xl">
                <div class="layer-tag engitech-tag mb-4 bg-black/40 px-4 py-1.5 rounded-sm backdrop-blur-sm inline-block shadow-lg">
                    <span class="text-white tracking-widest text-sm drop-shadow-md" style="color: #ffffff !important;">FACULTY TRAINING</span>
                </div>
                <h1 class="layer-title text-5xl sm:text-6xl lg:text-7xl font-heading font-extrabold text-white tracking-tight leading-[1.1] mb-6 drop-shadow-[0_4px_8px_rgba(0,0,0,0.8)]" style="color: #ffffff !important;">
                    Empowering Educators With <br><span class="text-primary drop-shadow-[0_4px_8px_rgba(0,0,0,0.8)]">Next-Gen AI Skills</span>
                </h1>
                <p class="layer-subtext text-lg sm:text-xl text-slate-100 mb-10 max-w-2xl font-light drop-shadow-[0_2px_4px_rgba(0,0,0,0.8)]" style="color: #f8fafc !important;">
                    Comprehensive workshops, lesson-planning assistants, and classroom integration modules for teachers.
                </p>
                <div class="layer-actions flex flex-wrap items-center justify-center lg:justify-start gap-4">
                    <a href="/programs#schools" class="engitech-btn shadow-lg">Teacher Modules</a>
                </div>
            </div>
        </div>
    </div>

    <!-- SLIDE 6: ETHICAL AI -->
    <div data-hero-slide="5" class="hero-slide absolute inset-0 w-full h-full flex items-center">
        <div class="hero-bg-layer" style="background-image: url('{{ asset('images/slider/slider6.jpg') }}');"></div>
        <div class="hero-content-wrapper relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full text-center lg:text-left">
            <div class="max-w-3xl">
                <div class="layer-tag engitech-tag mb-4 bg-black/40 px-4 py-1.5 rounded-sm backdrop-blur-sm inline-block shadow-lg">
                    <span class="text-white tracking-widest text-sm drop-shadow-md" style="color: #ffffff !important;">ETHICAL & RESPONSIBLE AI</span>
                </div>
                <h1 class="layer-title text-5xl sm:text-6xl lg:text-7xl font-heading font-extrabold text-white tracking-tight leading-[1.1] mb-6 drop-shadow-[0_4px_8px_rgba(0,0,0,0.8)]" style="color: #ffffff !important;">
                    Building Trust & Standards in <br><span class="text-primary drop-shadow-[0_4px_8px_rgba(0,0,0,0.8)]">Educational Tech</span>
                </h1>
                <p class="layer-subtext text-lg sm:text-xl text-slate-100 mb-10 max-w-2xl font-light drop-shadow-[0_2px_4px_rgba(0,0,0,0.8)]" style="color: #f8fafc !important;">
                    Promoting AI ethics, data privacy, student fairness, and academic integrity standards across educational institutions.
                </p>
                <div class="layer-actions flex flex-wrap items-center justify-center lg:justify-start gap-4">
                    <a href="/pillars#ethics" class="engitech-btn shadow-lg">Read Guidelines</a>
                    <a href="/faq" class="engitech-btn engitech-btn-transparent shadow-lg bg-black/30 backdrop-blur-sm border-white/50 text-white">FAQ & Support</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Revolution Slider Controls (Positioned Bottom Left & Center) -->
    <div class="absolute bottom-10 left-0 w-full z-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full flex items-center justify-between">
            <!-- Left: Arrow Prev / Next Buttons -->
            <div class="flex items-center space-x-2">
                <button id="hero-prev-btn" class="w-12 h-12 rounded-sm bg-white/10 hover:bg-primary border border-white/20 text-white flex items-center justify-center transition-colors shadow-lg" aria-label="Previous Slide">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                </button>
                <button id="hero-next-btn" class="w-12 h-12 rounded-sm bg-white/10 hover:bg-primary border border-white/20 text-white flex items-center justify-center transition-colors shadow-lg" aria-label="Next Slide">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </button>
            </div>

            <!-- Center: 6 Pagination Dots -->
            <div class="flex items-center space-x-3 slick-dots">
                <button data-hero-dot="0" class="h-3 w-3 rounded-full bg-white transition-all transform scale-150 shadow-[0_0_10px_rgba(67,186,255,0.8)]" aria-label="Slide 1"></button>
                <button data-hero-dot="1" class="h-3 w-3 rounded-full bg-white/30 transition-all hover:bg-white" aria-label="Slide 2"></button>
                <button data-hero-dot="2" class="h-3 w-3 rounded-full bg-white/30 transition-all hover:bg-white" aria-label="Slide 3"></button>
                <button data-hero-dot="3" class="h-3 w-3 rounded-full bg-white/30 transition-all hover:bg-white" aria-label="Slide 4"></button>
                <button data-hero-dot="4" class="h-3 w-3 rounded-full bg-white/30 transition-all hover:bg-white" aria-label="Slide 5"></button>
                <button data-hero-dot="5" class="h-3 w-3 rounded-full bg-white/30 transition-all hover:bg-white" aria-label="Slide 6"></button>
            </div>
        </div>
    </div>
</section>
