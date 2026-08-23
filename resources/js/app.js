import './bootstrap';
import { gsap } from 'gsap';

// ─── Navbar setup ──────────────────────────────────────
const navbar = document.getElementById('navbar');
if (navbar) navbar.classList.add('scrolled');

// ═══════════════════════════════════════════════════════
//  FULL-PAGE ENGINE — mirrors GSAP branch trans-col logic
//
//  KEY INSIGHT from git diff:
//  trans-col bars have `background: #0e0e0e` = EXACT same
//  color as the Hero section. At scaleY:1 the bars are
//  invisible (indistinguishable from the section behind them).
//  They only reveal themselves as they collapse staggered,
//  briefly showing the new section through the gaps.
//  NO GRID because there are never visible bar edges against
//  a contrasting background.
//
//  Sequence per transition:
//  1. Paint cols with FROM section's solid color
//  2. gsap.set cols scaleY:1  → instantly cover everything
//     with from-section color → visually identical to current page
//  3. Immediately hide fromSec (cols cover it, no visual change)
//  4. Show toSec below (z:10)
//  5. Animate cols scaleY→0 staggered (comb collapse)
//     → toSec revealed through the gaps as bars collapse
// ═══════════════════════════════════════════════════════
(function fullPageEngine() {
    const container = document.getElementById('fp-container');
    if (!container) return;

    const overlay  = document.getElementById('fp-overlay');
    const cols     = overlay ? Array.from(overlay.querySelectorAll('.fp-col')) : [];
    const sections = Array.from(container.querySelectorAll('.fp-section'));
    const n        = sections.length;
    if (!n || !cols.length) return;

    const secWorks = document.getElementById('works');

    // Translucent RGBA tint for each section — enables see-through glass bleed
    const SECTION_BG_RGBA = [
        'rgba(14, 14, 14, 0.85)',    // 0: Hero
        'rgba(110, 60, 230, 0.82)',  // 1: Services
        'rgba(255, 255, 255, 0.85)', // 2: Works
        'rgba(243, 89, 176, 0.85)',  // 3: Testimonials
        'rgba(240, 240, 245, 0.85)', // 4: Why
        'rgba(14, 14, 14, 0.85)',    // 5: CTA
    ];

    const NAV = [
        { bg: 'rgba(14,14,14,0.65)',    border: 'rgba(255,255,255,0.08)', light: false },
        { bg: 'rgba(135,90,245,0.65)',  border: 'rgba(255,255,255,0.08)', light: false },
        { bg: 'rgba(227,227,227,0.65)', border: 'rgba(0,0,0,0.06)',       light: true  },
        { bg: 'rgba(243,89,176,0.65)',  border: 'rgba(255,255,255,0.08)', light: false },
        { bg: 'rgba(239,239,239,0.65)', border: 'rgba(0,0,0,0.06)',       light: true  },
        { bg: 'rgba(0,0,0,0.65)',       border: 'rgba(255,255,255,0.08)', light: false },
    ];

    let current = 0;
    let isTransitioning = false;

    // Helper to query key visual content elements in a section for element-level transitions
    function getSectionElements(sec) {
        if (!sec) return [];
        const selectors = [
            '.hero-title', '.hero-subtitle', '.btn-hero',
            '.sec-label', '.services-title', '.svc-card', '.services-desc', '.btn-dark',
            '.works-section-label', '.works-heading', '#stats-row', '.works-description', '.works-card-grid > .group', '.works-see-more',
            '.testi-label', '.testi-title', '.testi-right-desc', '.testi-card',
            '.why-title', '.why-desc', '.why-card',
            '.cta-terminal', '.cta-title', '.cta-desc', '.cta-btn', '.cta-visual'
        ];
        const els = sec.querySelectorAll(selectors.join(', '));
        if (els.length > 0) return Array.from(els);
        const inner = sec.querySelector('.sec-inner, .hero-content, .works-content-wrap, .cta-outer') || sec;
        return Array.from(inner.children);
    }

    // Initialize — only hero visible
    sections.forEach((sec, i) => {
        gsap.set(sec, {
            zIndex:        i === 0 ? 10 : 0,
            visibility:    i === 0 ? 'visible' : 'hidden',
            opacity:       i === 0 ? 1 : 0,
            pointerEvents: i === 0 ? 'auto' : 'none'
        });
    });
    // Overlay starts inactive
    if (overlay) gsap.set(overlay, { zIndex: 0, pointerEvents: 'none' });

    function applyNav(idx) {
        if (!navbar) return;
        const t = NAV[idx] ?? NAV[0];
        gsap.to(navbar, { '--nav-bg': t.bg, '--nav-border': t.border, duration: 0.35, ease: 'none' });
        navbar.classList.toggle('light-theme', t.light);
    }
    applyNav(0);

    let statsFired = false;
    function checkStatsTrigger(idx) {
        if (idx !== 2 || statsFired || !secWorks) return;
        statsFired = true;
        secWorks.querySelectorAll('[data-target]').forEach(el => {
            const target = parseInt(el.dataset.target, 10);
            const suffix = el.dataset.suffix ?? '';
            const obj = { val: 0 };
            gsap.to(obj, {
                val: target, duration: 1.6, ease: 'power2.out', delay: 0.2,
                onUpdate() { el.textContent = Math.round(obj.val) + suffix; }
            });
        });
    }

    // Hero entrance
    gsap.timeline({ defaults: { ease: 'power3.out', duration: 0.9 } })
        .to('#hero-h1',  { opacity: 1, y: 0, delay: 0.2 })
        .to('#hero-p',   { opacity: 1, y: 0 }, '-=0.55')
        .to('#hero-btn', { opacity: 1, y: 0 }, '-=0.5');

    // ── See-Through Bleeding Section Transition ──
    function goTo(target) {
        if (isTransitioning) return;
        if (target < 0 || target >= n || target === current) return;

        isTransitioning = true;
        const fromSec   = sections[current];
        const toSec     = sections[target];
        const isForward = target > current;

        if (target === 2 && secWorks) secWorks.scrollTop = 0;

        const fromEls = getSectionElements(fromSec);
        const toEls   = getSectionElements(toSec);

        // 1. Paint translucent glass cols with FROM section RGBA
        cols.forEach(col => { col.style.background = SECTION_BG_RGBA[current]; });

        // 2. Stacking & Initial state:
        //    fromSec stays visible (zIndex 10) bleeding behind.
        //    toSec starts invisible at zIndex 20, fading in over fromSec.
        //    overlay sits at zIndex 30.
        gsap.set(fromSec, { visibility: 'visible', opacity: 1, zIndex: 10, pointerEvents: 'none' });
        gsap.set(toSec,   { visibility: 'visible', opacity: 0, zIndex: 20, pointerEvents: 'none' });
        if (overlay) gsap.set(overlay, { zIndex: 30 });

        // Preset incoming section elements (faded out + offset)
        gsap.set(toEls, { opacity: 0, y: isForward ? 35 : -35, scale: 0.96 });

        // Snap overlay columns to scaleY: 1
        gsap.set(cols, { scaleY: 1 });

        const tl = gsap.timeline({
            onComplete() {
                current = target;
                isTransitioning = false;

                // Hide fromSec and reset element styles cleanly
                gsap.set(fromSec, { visibility: 'hidden', opacity: 0, zIndex: 0, pointerEvents: 'none' });
                gsap.set(fromEls, { clearProps: 'transform,opacity,scale' });

                // Settle toSec as active
                gsap.set(overlay, { zIndex: 0 });
                gsap.set(cols, { scaleY: 0 });
                gsap.set(toSec, { zIndex: 10, opacity: 1, pointerEvents: 'auto' });
                gsap.set(toEls, { clearProps: 'transform,opacity,scale' });

                applyNav(target);
                checkStatsTrigger(target);
            }
        });

        // Step A: Outgoing section elements fade out & dissolve upward/downward
        tl.to(fromEls, {
            opacity: 0,
            y: isForward ? -30 : 30,
            scale: 0.95,
            duration: 0.45,
            ease: 'power2.in',
            stagger: { each: 0.02, from: isForward ? 'start' : 'end' }
        }, 0);

        // Step B: toSec background opacity crossfades in
        tl.to(toSec, {
            opacity: 1,
            duration: 0.5,
            ease: 'power2.inOut'
        }, 0.05);

        // Step C: Translucent overlay columns collapse staggered (glass wipe reveal)
        tl.to(cols, {
            scaleY: 0,
            duration: 0.55,
            ease: 'power2.inOut',
            stagger: { each: 0.025, from: isForward ? 'start' : 'end' }
        }, 0.1);

        // Step D: Incoming section elements fade in and slide into position
        tl.to(toEls, {
            opacity: 1,
            y: 0,
            scale: 1,
            duration: 0.55,
            ease: 'power3.out',
            stagger: { each: 0.03, from: 'start' }
        }, 0.15);

        // Step E: Navbar morphs smoothly
        tl.to(navbar, {
            '--nav-bg':     NAV[target].bg,
            '--nav-border': NAV[target].border,
            duration: 0.42,
            ease: 'power2.inOut',
            onStart: () => { if (navbar) navbar.classList.toggle('light-theme', NAV[target].light); }
        }, 0.06);
    }

    // ── Scroll / Wheel / Touch / Key lock ─────────────
    let wheelAcc = 0, wheelTmr = null;
    const THRESH = 50;

    window.addEventListener('wheel', e => {
        if (isTransitioning) { e.preventDefault(); return; }

        // Works: allow internal scroll, transition only at top/bottom boundary
        if (current === 2 && secWorks) {
            const atTop    = secWorks.scrollTop <= 5;
            const atBottom = secWorks.scrollTop + secWorks.clientHeight >= secWorks.scrollHeight - 10;
            if (e.deltaY > 0 && !atBottom) return; // still scrolling inside Works
            if (e.deltaY < 0 && !atTop)    return;
            e.preventDefault();
            wheelAcc += e.deltaY;
            clearTimeout(wheelTmr);
            wheelTmr = setTimeout(() => { wheelAcc = 0; }, 150);
            if (Math.abs(wheelAcc) >= THRESH) { wheelAcc = 0; goTo(current + (e.deltaY > 0 ? 1 : -1)); }
            return;
        }

        e.preventDefault();
        wheelAcc += e.deltaY;
        clearTimeout(wheelTmr);
        wheelTmr = setTimeout(() => { wheelAcc = 0; }, 150);
        if (Math.abs(wheelAcc) >= THRESH) { wheelAcc = 0; goTo(current + (e.deltaY > 0 ? 1 : -1)); }
    }, { passive: false });

    let touchY0 = 0;
    window.addEventListener('touchstart', e => { touchY0 = e.touches[0].clientY; }, { passive: true });
    window.addEventListener('touchend',   e => {
        if (isTransitioning) return;
        const dy = touchY0 - e.changedTouches[0].clientY;
        if (Math.abs(dy) < 40) return;
        if (current === 2 && secWorks) {
            const atTop    = secWorks.scrollTop <= 5;
            const atBottom = secWorks.scrollTop + secWorks.clientHeight >= secWorks.scrollHeight - 10;
            if (dy > 0 && atBottom)  goTo(3);
            else if (dy < 0 && atTop) goTo(1);
            return;
        }
        goTo(current + (dy > 0 ? 1 : -1));
    }, { passive: true });

    window.addEventListener('keydown', e => {
        if (isTransitioning) return;
        if (e.key === 'ArrowDown' || e.key === 'PageDown' || e.key === ' ') {
            if (current === 2 && secWorks && secWorks.scrollTop + secWorks.clientHeight < secWorks.scrollHeight - 10) return;
            e.preventDefault(); goTo(current + 1);
        } else if (e.key === 'ArrowUp' || e.key === 'PageUp') {
            if (current === 2 && secWorks && secWorks.scrollTop > 5) return;
            e.preventDefault(); goTo(current - 1);
        }
    });

    const ids = ['hero','services','works','testimonials','why','cta'];
    document.querySelectorAll('a[href^="#"]').forEach(link => {
        link.addEventListener('click', e => {
            const hash = link.getAttribute('href').replace('#','');
            const idx  = (hash === 'hero' || hash === '') ? 0 : ids.indexOf(hash);
            if (idx !== -1) { e.preventDefault(); goTo(idx); }
        });
    });

    window.fp = { goTo, current: () => current };
})();

// ─── Draggable testimonials ─────────────────────────────
const track = document.getElementById('testi-track');
if (track) {
    let down = false, startX, scrollLeft;
    track.addEventListener('mousedown', e => { down = true; track.classList.add('active'); startX = e.pageX - track.offsetLeft; scrollLeft = track.scrollLeft; });
    ['mouseleave','mouseup'].forEach(ev => track.addEventListener(ev, () => { down = false; track.classList.remove('active'); }));
    track.addEventListener('mousemove', e => { if (!down) return; e.preventDefault(); track.scrollLeft = scrollLeft - (e.pageX - track.offsetLeft - startX) * 1.5; });
}

// ─── Service card selection ─────────────────────────────
document.querySelectorAll('.svc-card').forEach(card => {
    card.addEventListener('click', () => {
        const trackEl = card.closest('.services-track');
        if (!trackEl) return;
        const isSelected = card.classList.contains('selected');
        document.querySelectorAll('.svc-card').forEach(c => c.classList.remove('selected'));
        if (isSelected) { trackEl.classList.remove('has-selected'); return; }
        const nameEl = card.querySelector('.svc-card-name');
        if (nameEl) {
            const name = nameEl.textContent.trim();
            document.querySelectorAll('.svc-card').forEach(c => { const cn = c.querySelector('.svc-card-name'); if (cn?.textContent.trim() === name) c.classList.add('selected'); });
        } else { card.classList.add('selected'); }
        trackEl.classList.add('has-selected');
    });
});

// ─── CTA ASCII Video Canvas ─────────────────────────────
const ctaVideo  = document.getElementById('cta-video-source');
const ctaCanvas = document.getElementById('cta-video-canvas');
if (ctaVideo && ctaCanvas) {
    const ctx = ctaCanvas.getContext('2d');
    const upd = () => { if (ctaVideo.videoWidth) { ctaCanvas.width = ctaVideo.videoWidth; ctaCanvas.height = ctaVideo.videoHeight; } };
    ctaVideo.addEventListener('loadedmetadata', upd);
    const render = () => { if (!ctaVideo.paused && !ctaVideo.ended) { ctx.clearRect(0,0,ctaCanvas.width,ctaCanvas.height); ctx.drawImage(ctaVideo,0,0,ctaCanvas.width,ctaCanvas.height); } requestAnimationFrame(render); };
    ctaVideo.addEventListener('play', () => { upd(); render(); });
    if (!ctaVideo.paused) { upd(); render(); } else { ctaVideo.play().then(() => { upd(); render(); }).catch(()=>{}); }
}
