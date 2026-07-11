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

    const transitionTimeline = gsap.timeline({
        scrollTrigger: {
            trigger: '.hero-services-wrapper',
            start: 'top top',
            end: '+=100%', // Pin for one full viewport height of scrolling
            pin: true,
            scrub: true,
        }
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
