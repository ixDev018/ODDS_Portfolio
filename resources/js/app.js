import './bootstrap';
import { gsap } from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';

gsap.registerPlugin(ScrollTrigger);

// ─── Navbar scroll ────────────────────────────────────
const navbar = document.getElementById('navbar');
if (navbar) {
    window.addEventListener('scroll', () => {
        navbar.classList.toggle('scrolled', window.scrollY > 30);
    }, { passive: true });
}

// ─── Hero entrance ───────────────────────────────────
gsap.timeline({ defaults: { ease: 'power3.out', duration: 0.9 } })
    .to('#hero-h1',  { opacity: 1, y: 0, delay: 0.2 })
    .to('#hero-p',   { opacity: 1, y: 0 }, '-=0.55')
    .to('#hero-btn', { opacity: 1, y: 0 }, '-=0.5');

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
