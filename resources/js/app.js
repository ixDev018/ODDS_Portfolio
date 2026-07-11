import './bootstrap';
import { gsap } from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';

gsap.registerPlugin(ScrollTrigger);

// ─── Navbar scroll ────────────────────────────────────
const navbar = document.getElementById('navbar');
if (navbar) {
    const checkScroll = () => {
        navbar.classList.toggle('scrolled', window.scrollY > 30);
    };
    window.addEventListener('scroll', checkScroll, { passive: true });
    checkScroll();
}

// ─── Hero entrance ───────────────────────────────────
gsap.timeline({ defaults: { ease: 'power3.out', duration: 0.9 } })
    .to('#hero-h1',  { opacity: 1, y: 0, delay: 0.2 })
    .to('#hero-p',   { opacity: 1, y: 0 }, '-=0.55')
    .to('#hero-btn', { opacity: 1, y: 0 }, '-=0.5');

// ─── Hero-to-Services Pinned Transition ──────────
if (document.querySelector('.hero-services-wrapper') && document.querySelector('.trans-col')) {
    // Hide services content initially so it doesn't overlap the Hero section
    gsap.set(['.services .sec-inner', '.services .services-cards'], {
        opacity: 0,
        y: 40
    });

    let currentState = 0; // 0 = Hero, 1 = Services
    let isTransitioning = false;
    let isReady = false;
    const transitionDuration = 1.6; // Hard-locked transition duration in seconds (slower)

    // Fixed-duration transition timeline (total duration maps to 1.0s)
    const transitionTimeline = gsap.timeline({
        paused: true
    });

    // 1. Fade out Hero content first (from 0 to 0.25)
    transitionTimeline.to('.hero-content', {
        opacity: 0,
        y: -40,
        duration: 0.25,
        ease: 'power2.inOut'
    }, 0);

    // 2. Collapse the transition overlay columns (vertical strips wipe, sweeping horizontally)
    transitionTimeline.to('.trans-col', {
        scaleY: 0,
        duration: 0.45,
        ease: 'power2.inOut',
        stagger: {
            each: 0.02,
            from: 'start'
        }
    }, 0.2);

    // 3. Morph glow colors in sync (from 0.2 to 0.6)
    transitionTimeline.to(':root', {
        '--glow-color-inner': '#0d0d0d',
        '--glow-color-mid': '#060606',
        '--glow-color-outer': '#000000',
        duration: 0.4,
        ease: 'power2.inOut'
    }, 0.2);

    // 3b. Transition navbar background from Hero glass to Services purple glass (from 0.2 to 0.6)
    if (navbar) {
        transitionTimeline.fromTo(navbar, 
            { 
                '--nav-bg': 'rgba(14, 14, 14, 0.65)',
                '--nav-border': 'rgba(255, 255, 255, 0.08)'
            },
            {
                '--nav-bg': 'rgba(135, 90, 245, 0.65)',
                '--nav-border': 'rgba(255, 255, 255, 0.08)',
                duration: 0.4,
                ease: 'power2.inOut'
            }, 
            0.2
        );
    }

    // 4. Fade in and slide up Services content as the wipe clears (from 0.65 to 1.0)
    transitionTimeline.to(['.services .sec-inner', '.services .services-cards'], {
        opacity: 1,
        y: 0,
        duration: 0.35,
        ease: 'power2.out',
        stagger: 0.08
    }, 0.65);

    // Scroll prevention helper functions
    function preventScroll(e) {
        e.preventDefault();
    }

    const scrollKeys = { 32: 1, 33: 1, 34: 1, 35: 1, 36: 1, 37: 1, 38: 1, 39: 1, 40: 1 };
    function preventDefaultScrollKeys(e) {
        if (scrollKeys[e.keyCode]) {
            e.preventDefault();
            return false;
        }
    }

    function disableScroll() {
        window.addEventListener('wheel', preventScroll, { passive: false });
        window.addEventListener('touchmove', preventScroll, { passive: false });
        window.addEventListener('keydown', preventDefaultScrollKeys, { passive: false });
    }

    function enableScroll() {
        window.removeEventListener('wheel', preventScroll);
        window.removeEventListener('touchmove', preventScroll);
        window.removeEventListener('keydown', preventDefaultScrollKeys);
    }

    // Main event-driven transition trigger
    function triggerTransition(targetState) {
        if (isTransitioning || !isReady) return;
        isTransitioning = true;
        disableScroll();

        const targetScroll = targetState === 1 ? mainPin.end : mainPin.start;

        // Animate the scroll position programmatically
        const scrollObj = { y: window.scrollY };
        gsap.to(scrollObj, {
            y: targetScroll,
            duration: transitionDuration,
            ease: 'power2.inOut',
            onUpdate: () => {
                window.scrollTo(0, scrollObj.y);
            }
        });

        // Play/reverse the transition timeline smoothly at the fixed duration
        gsap.to(transitionTimeline, {
            progress: targetState,
            duration: transitionDuration,
            ease: 'power2.inOut',
            onComplete: () => {
                currentState = targetState;
                isTransitioning = false;
                enableScroll();
            }
        });
    }

    // ScrollTrigger to pin the section and capture scroll direction/progress
    const mainPin = ScrollTrigger.create({
        trigger: '.hero-services-wrapper',
        start: 'top top',
        end: '+=100%',
        pin: true,
        pinSpacing: true,
        onRefresh: (self) => {
            // Correctly set initial state on load/refresh (handles scroll restoration)
            currentState = self.progress >= 0.5 ? 1 : 0;
            transitionTimeline.progress(currentState);
            // Allow transitions after initial layout calculations
            setTimeout(() => {
                isReady = true;
            }, 100);
        },
        onUpdate: (self) => {
            if (isTransitioning || !isReady) return;

            // Trigger transitions based on scroll direction and progress
            if (self.direction === 1 && self.progress > 0.01 && currentState === 0) {
                triggerTransition(1);
            } else if (self.direction === -1 && self.progress < 0.99 && currentState === 1) {
                triggerTransition(0);
            }
        }
    });

    // Anchor links smooth navigation and transition synchronization
    document.querySelectorAll('a[href^="#"]').forEach(link => {
        link.addEventListener('click', (e) => {
            const targetId = link.getAttribute('href');
            if (!targetId) return;

            // Handle return to home/hero
            if (targetId === '#' || targetId === '#hero') {
                e.preventDefault();
                isReady = false;
                disableScroll();

                const scrollObj = { y: window.scrollY };
                gsap.to(transitionTimeline, {
                    progress: 0,
                    duration: transitionDuration,
                    ease: 'power2.inOut',
                    onComplete: () => {
                        currentState = 0;
                    }
                });

                gsap.to(scrollObj, {
                    y: 0,
                    duration: transitionDuration,
                    ease: 'power2.inOut',
                    onUpdate: () => window.scrollTo(0, scrollObj.y),
                    onComplete: () => {
                        isReady = true;
                        enableScroll();
                    }
                });
                return;
            }

            const targetEl = document.querySelector(targetId);
            if (!targetEl) return;

            e.preventDefault();
            isReady = false;
            disableScroll();

            let targetScroll = 0;
            if (targetId === '#services') {
                // Services is pinned; target the fully-revealed state
                targetScroll = mainPin.end;
            } else {
                const rect = targetEl.getBoundingClientRect();
                targetScroll = rect.top + window.scrollY;
            }

            const scrollObj = { y: window.scrollY };
            const targetProgress = (targetId === '#services' || targetScroll >= mainPin.end) ? 1 : 0;

            gsap.to(transitionTimeline, {
                progress: targetProgress,
                duration: transitionDuration,
                ease: 'power2.inOut',
                onComplete: () => {
                    currentState = targetProgress;
                }
            });

            gsap.to(scrollObj, {
                y: targetScroll,
                duration: transitionDuration,
                ease: 'power2.inOut',
                onUpdate: () => {
                    window.scrollTo(0, scrollObj.y);
                },
                onComplete: () => {
                    isReady = true;
                    enableScroll();
                }
            });
        });
    });
}

// ─── Navbar Dynamic Background and Theme ScrollTriggers ───
if (navbar) {
    const boundaries = [
        {
            trigger: '#works',
            colorFrom: 'rgba(135, 90, 245, 0.65)',
            colorTo: 'rgba(227, 227, 227, 0.65)',
            borderFrom: 'rgba(255, 255, 255, 0.08)',
            borderTo: 'rgba(0, 0, 0, 0.06)',
            themeFrom: 'dark',
            themeTo: 'light'
        },
        {
            trigger: '#testimonials',
            colorFrom: 'rgba(227, 227, 227, 0.65)',
            colorTo: 'rgba(243, 89, 176, 0.65)',
            borderFrom: 'rgba(0, 0, 0, 0.06)',
            borderTo: 'rgba(255, 255, 255, 0.08)',
            themeFrom: 'light',
            themeTo: 'dark'
        },
        {
            trigger: '#why',
            colorFrom: 'rgba(243, 89, 176, 0.65)',
            colorTo: 'rgba(239, 239, 239, 0.65)',
            borderFrom: 'rgba(255, 255, 255, 0.08)',
            borderTo: 'rgba(0, 0, 0, 0.06)',
            themeFrom: 'dark',
            themeTo: 'light'
        },
        {
            trigger: '#cta',
            colorFrom: 'rgba(239, 239, 239, 0.65)',
            colorTo: 'rgba(26, 26, 26, 0.65)',
            borderFrom: 'rgba(0, 0, 0, 0.06)',
            borderTo: 'rgba(255, 255, 255, 0.08)',
            themeFrom: 'light',
            themeTo: 'dark'
        }
    ];

    boundaries.forEach(b => {
        const el = document.querySelector(b.trigger);
        if (!el) return;

        // Scrub background color transition
        gsap.fromTo(navbar,
            { 
                '--nav-bg': b.colorFrom,
                '--nav-border': b.borderFrom
            },
            {
                '--nav-bg': b.colorTo,
                '--nav-border': b.borderTo,
                ease: 'none',
                scrollTrigger: {
                    trigger: el,
                    start: 'top 84px',
                    end: 'top top',
                    scrub: true,
                }
            }
        );

        // Toggle light/dark theme class midway (at 42px scrolled navbar center)
        ScrollTrigger.create({
            trigger: el,
            start: 'top 42px',
            onEnter: () => {
                navbar.classList.toggle('light-theme', b.themeTo === 'light');
            },
            onLeaveBack: () => {
                navbar.classList.toggle('light-theme', b.themeFrom === 'light');
            }
        });
    });
}

// ─── Generic fade-up on scroll ───────────────────────
gsap.utils.toArray('.fade-up:not(#hero-h1):not(#hero-p):not(#hero-btn)').forEach((el) => {
    gsap.to(el, {
        opacity: 1, y: 0, duration: 0.75, ease: 'power3.out',
        scrollTrigger: { trigger: el, start: 'top 88%', once: true },
    });
});

// ─── Scale-in cards ──────────────────────────────────
gsap.utils.toArray('.scale-in').forEach((el, i) => {
    gsap.to(el, {
        opacity: 1, scale: 1, duration: 0.65, ease: 'back.out(1.5)',
        delay: (i % 3) * 0.08,
        scrollTrigger: { trigger: el, start: 'top 90%', once: true },
    });
});

// ─── Animated stat counters ──────────────────────────
document.querySelectorAll('[data-target]').forEach((el) => {
    const target = parseInt(el.dataset.target, 10);
    const suffix = el.dataset.suffix ?? '';
    ScrollTrigger.create({
        trigger: el,
        start: 'top 85%',
        once: true,
        onEnter: () => {
            const obj = { val: 0 };
            gsap.to(obj, {
                val: target, duration: 1.8, ease: 'power2.out',
                onUpdate() { el.textContent = Math.round(obj.val) + suffix; },
            });
        },
    });
});

// ─── Draggable testimonials ──────────────────────────
const track = document.getElementById('testi-track');
if (track) {
    let down = false, startX, scrollLeft;
    track.addEventListener('mousedown', (e) => {
        down = true; track.classList.add('active');
        startX = e.pageX - track.offsetLeft;
        scrollLeft = track.scrollLeft;
    });
    ['mouseleave', 'mouseup'].forEach(ev =>
        track.addEventListener(ev, () => { down = false; track.classList.remove('active'); })
    );
    track.addEventListener('mousemove', (e) => {
        if (!down) return;
        e.preventDefault();
        const x = e.pageX - track.offsetLeft;
        track.scrollLeft = scrollLeft - (x - startX) * 1.5;
    });
}

// ─── Auto-hide custom scrollbar ───────────────────────
let scrollTimeout;
window.addEventListener('scroll', () => {
    document.documentElement.classList.add('is-scrolling');
    clearTimeout(scrollTimeout);
    scrollTimeout = setTimeout(() => {
        document.documentElement.classList.remove('is-scrolling');
    }, 800);
}, { passive: true });
