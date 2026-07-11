import './bootstrap';
import { gsap } from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';

gsap.registerPlugin(ScrollTrigger);

// =====================================================
// NAVBAR: Add scrolled class on scroll
// =====================================================
const navbar = document.getElementById('navbar');
if (navbar) {
    window.addEventListener('scroll', () => {
        navbar.classList.toggle('scrolled', window.scrollY > 40);
    }, { passive: true });
}

// =====================================================
// HERO ANIMATIONS
// =====================================================
const heroTl = gsap.timeline({ defaults: { ease: 'power3.out' } });
heroTl
    .to('#hero-title',   { opacity: 1, y: 0, duration: 1,    delay: 0.2 })
    .to('#hero-subtitle',{ opacity: 1, y: 0, duration: 0.9 }, '-=0.6')
    .to('#hero-actions', { opacity: 1, y: 0, duration: 0.8 }, '-=0.6')
    .to('#hero-scroll',  { opacity: 1, duration: 0.6 },        '-=0.3');

// =====================================================
// SCROLL-TRIGGERED FADE UP (generic)
// =====================================================
gsap.utils.toArray('.gsap-fade-up:not(#hero-title):not(#hero-subtitle):not(#hero-actions)').forEach((el) => {
    gsap.to(el, {
        opacity: 1,
        y: 0,
        duration: 0.85,
        ease: 'power3.out',
        scrollTrigger: {
            trigger: el,
            start: 'top 88%',
            toggleActions: 'play none none none',
        },
    });
});

// =====================================================
// SCROLL-TRIGGERED SCALE IN (cards)
// =====================================================
gsap.utils.toArray('.gsap-scale-in').forEach((el, i) => {
    gsap.to(el, {
        opacity: 1,
        scale: 1,
        duration: 0.7,
        ease: 'back.out(1.4)',
        delay: (i % 3) * 0.1,
        scrollTrigger: {
            trigger: el,
            start: 'top 90%',
            toggleActions: 'play none none none',
        },
    });
});

// =====================================================
// ANIMATED COUNTERS (Works stats)
// =====================================================
document.querySelectorAll('[data-count]').forEach((el) => {
    const target = parseInt(el.getAttribute('data-count'), 10);
    const suffix = el.getAttribute('data-suffix') || '';
    ScrollTrigger.create({
        trigger: el,
        start: 'top 85%',
        onEnter: () => {
            gsap.fromTo(
                { val: 0 },
                { val: target, duration: 1.8, ease: 'power2.out',
                  onUpdate: function () {
                      el.textContent = Math.round(this.targets()[0].val) + suffix;
                  }
                }
            );
        },
        once: true,
    });
});

// =====================================================
// DRAGGABLE TESTIMONIALS TRACK
// =====================================================
const track = document.getElementById('testi-track');
if (track) {
    let isDown = false;
    let startX;
    let scrollLeft;

    track.addEventListener('mousedown', (e) => {
        isDown = true;
        track.classList.add('grabbing');
        startX = e.pageX - track.offsetLeft;
        scrollLeft = track.scrollLeft;
    });

    track.addEventListener('mouseleave', () => {
        isDown = false;
        track.classList.remove('grabbing');
    });

    track.addEventListener('mouseup', () => {
        isDown = false;
        track.classList.remove('grabbing');
    });

    track.addEventListener('mousemove', (e) => {
        if (!isDown) return;
        e.preventDefault();
        const x = e.pageX - track.offsetLeft;
        const walk = (x - startX) * 1.5;
        track.scrollLeft = scrollLeft - walk;
    });
}

// =====================================================
// SERVICES GRID STAGGER
// =====================================================
const servicesGrid = document.getElementById('services-grid');
if (servicesGrid) {
    gsap.from(servicesGrid.querySelectorAll('.service-card'), {
        opacity: 0,
        y: 20,
        duration: 0.6,
        stagger: 0.08,
        ease: 'power2.out',
        scrollTrigger: {
            trigger: servicesGrid,
            start: 'top 85%',
        },
    });
}
