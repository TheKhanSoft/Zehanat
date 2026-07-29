document.addEventListener('DOMContentLoaded', () => {
    // a) Scroll animation observer
    const animateElements = document.querySelectorAll('.animate-fade-up, .animate-fade-in, .animate-scale-in');
    if ('IntersectionObserver' in window) {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                }
            });
        }, { threshold: 0.1 });
        animateElements.forEach(el => observer.observe(el));
    } else {
        animateElements.forEach(el => el.classList.add('is-visible'));
    }

    // b) Navbar scroll effect
    const navbar = document.getElementById('navbar');
    if (navbar) {
        window.addEventListener('scroll', () => {
            if (window.scrollY > 10) {
                navbar.classList.add('bg-slate-900/95', 'backdrop-blur-md', 'shadow-lg');
                navbar.classList.remove('bg-transparent');
            } else {
                navbar.classList.remove('bg-slate-900/95', 'backdrop-blur-md', 'shadow-lg');
                navbar.classList.add('bg-transparent');
            }
        });
    }

    // c) Mobile menu toggle
    const mobileMenuBtn = document.getElementById('mobile-menu-btn');
    const mobileMenuClose = document.getElementById('mobile-menu-close');
    const mobileMenu = document.getElementById('mobile-menu');
    if (mobileMenuBtn && mobileMenu) {
        mobileMenuBtn.addEventListener('click', () => {
            mobileMenu.classList.add('open');
        });
    }
    if (mobileMenuClose && mobileMenu) {
        mobileMenuClose.addEventListener('click', () => {
            mobileMenu.classList.remove('open');
        });
    }

    // d) Accordion toggle
    const accordionTriggers = document.querySelectorAll('.accordion-trigger');
    accordionTriggers.forEach(trigger => {
        trigger.addEventListener('click', function() {
            const content = this.nextElementSibling;
            if (content && content.classList.contains('accordion-content')) {
                content.classList.toggle('open');
            }
            const icon = this.querySelector('svg, i');
            if (icon) {
                icon.style.transform = content.classList.contains('open') ? 'rotate(180deg)' : 'rotate(0deg)';
                icon.style.transition = 'transform 0.3s ease';
            }
        });
    });

    // e) Animated counter
    const counters = document.querySelectorAll('.counter');
    if ('IntersectionObserver' in window) {
        const counterObserver = new IntersectionObserver((entries, obs) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const el = entry.target;
                    const target = parseInt(el.getAttribute('data-target') || 0, 10);
                    let start = 0;
                    const duration = 2000; // ms
                    const startTime = performance.now();
                    const animate = (currentTime) => {
                        const elapsed = currentTime - startTime;
                        const progress = Math.min(elapsed / duration, 1);
                        // Ease out cubic
                        const easeProgress = 1 - Math.pow(1 - progress, 3);
                        el.textContent = Math.floor(easeProgress * target);
                        if (progress < 1) {
                            requestAnimationFrame(animate);
                        } else {
                            el.textContent = target;
                        }
                    };
                    requestAnimationFrame(animate);
                    obs.unobserve(el);
                }
            });
        }, { threshold: 0.5 });
        counters.forEach(c => counterObserver.observe(c));
    }

    // f) Dropdown toggle for mobile
    const dropdownTriggers = document.querySelectorAll('.mobile-dropdown-trigger');
    dropdownTriggers.forEach(trigger => {
        trigger.addEventListener('click', function() {
            const dropdownContent = this.nextElementSibling;
            if (dropdownContent) {
                dropdownContent.classList.toggle('hidden');
            }
        });
    });

    // g) Membership form enhancements
    const phoneInputs = document.querySelectorAll('[data-phone-input]');
    phoneInputs.forEach(input => {
        input.addEventListener('input', () => {
            const startsWithPlus = input.value.trimStart().startsWith('+');
            const digits = input.value.replace(/\D/g, '').slice(0, 15);
            input.value = `${startsWithPlus ? '+' : ''}${digits}`;
        });
    });

    const categoryTriggers = document.querySelectorAll('[data-category-select]');
    categoryTriggers.forEach(trigger => {
        trigger.addEventListener('click', () => {
            const category = trigger.dataset.categorySelect;
            const radio = [...document.querySelectorAll('input[name="category"]')]
                .find(input => input.value === category);

            if (radio) {
                radio.checked = true;
                radio.dispatchEvent(new Event('change', { bubbles: true }));
                window.setTimeout(() => radio.focus({ preventScroll: true }), 350);
            }
        });
    });

    const categoryRadios = [...document.querySelectorAll('input[name="category"]')];
    const organizationInput = document.querySelector('[data-organization-input]');
    const organizationRequirement = document.querySelector('[data-organization-requirement]');
    const organizationHelp = document.querySelector('[data-organization-help]');
    const syncOrganizationRequirement = () => {
        if (!organizationInput) return;

        const selectedCategory = categoryRadios.find(input => input.checked)?.value;
        const isRequired = ['institution', 'industry', 'student'].includes(selectedCategory);

        organizationInput.required = isRequired;
        organizationInput.setAttribute('aria-required', isRequired ? 'true' : 'false');

        if (organizationRequirement) {
            organizationRequirement.textContent = isRequired ? 'Required' : 'Optional';
            organizationRequirement.classList.toggle('bg-amber-400/10', isRequired);
            organizationRequirement.classList.toggle('text-amber-300', isRequired);
            organizationRequirement.classList.toggle('bg-slate-800', !isRequired);
            organizationRequirement.classList.toggle('text-slate-500', !isRequired);
        }

        if (organizationHelp) {
            organizationHelp.textContent = isRequired
                ? 'Required for the selected membership category.'
                : 'Optional for individual memberships.';
        }
    };

    categoryRadios.forEach(radio => radio.addEventListener('change', syncOrganizationRequirement));
    syncOrganizationRequirement();

    // h) Neural network canvas animation
    const canvas = document.getElementById('neural-canvas');
    if (canvas) {
        const ctx = canvas.getContext('2d');
        let width, height;
        let particles = [];
        const particleCount = 60;
        const maxDistance = 150;

        const resize = () => {
            width = canvas.parentElement.offsetWidth;
            height = canvas.parentElement.offsetHeight;
            canvas.width = width;
            canvas.height = height;
        };

        window.addEventListener('resize', resize);
        resize();

        class Particle {
            constructor() {
                this.x = Math.random() * width;
                this.y = Math.random() * height;
                this.vx = (Math.random() - 0.5) * 1;
                this.vy = (Math.random() - 0.5) * 1;
                this.radius = Math.random() * 2 + 1;
            }
            update() {
                this.x += this.vx;
                this.y += this.vy;

                if (this.x < 0 || this.x > width) this.vx *= -1;
                if (this.y < 0 || this.y > height) this.vy *= -1;
            }
            draw() {
                ctx.beginPath();
                ctx.arc(this.x, this.y, this.radius, 0, Math.PI * 2);
                ctx.fillStyle = 'rgba(20, 184, 166, 0.5)';
                ctx.fill();
            }
        }

        for (let i = 0; i < particleCount; i++) {
            particles.push(new Particle());
        }

        const animateCanvas = () => {
            ctx.clearRect(0, 0, width, height);

            for (let i = 0; i < particles.length; i++) {
                particles[i].update();
                particles[i].draw();

                for (let j = i + 1; j < particles.length; j++) {
                    const dx = particles[i].x - particles[j].x;
                    const dy = particles[i].y - particles[j].y;
                    const distance = Math.sqrt(dx * dx + dy * dy);

                    if (distance < maxDistance) {
                        ctx.beginPath();
                        ctx.moveTo(particles[i].x, particles[i].y);
                        ctx.lineTo(particles[j].x, particles[j].y);
                        const opacity = 1 - (distance / maxDistance);
                        ctx.strokeStyle = `rgba(20, 184, 166, ${opacity * 0.2})`;
                        ctx.lineWidth = 1;
                        ctx.stroke();
                    }
                }
            }
            requestAnimationFrame(animateCanvas);
        };
        animateCanvas();
    }

    // i) Right Off-Canvas Sidebar Panel toggle
    const sidePanelBtn = document.getElementById('side-panel-btn');
    const sidePanelClose = document.getElementById('side-panel-close');
    const sidePanelOverlay = document.getElementById('side-panel-overlay');
    const sidePanel = document.getElementById('side-panel');

    const openSidePanel = () => {
        if (sidePanel) sidePanel.classList.add('active');
        if (sidePanelOverlay) sidePanelOverlay.classList.add('active');
        document.body.style.overflow = 'hidden';
    };

    const closeSidePanel = () => {
        if (sidePanel) sidePanel.classList.remove('active');
        if (sidePanelOverlay) sidePanelOverlay.classList.remove('active');
        document.body.style.overflow = '';
    };

    if (sidePanelBtn) sidePanelBtn.addEventListener('click', openSidePanel);
    if (sidePanelClose) sidePanelClose.addEventListener('click', closeSidePanel);
    if (sidePanelOverlay) sidePanelOverlay.addEventListener('click', closeSidePanel);
});

