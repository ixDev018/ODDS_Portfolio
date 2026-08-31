import './bootstrap';
import { gsap } from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';
import { SplitText } from 'gsap/SplitText';
import { ScrambleTextPlugin } from 'gsap/ScrambleTextPlugin';
import { DrawSVGPlugin } from 'gsap/DrawSVGPlugin';

gsap.registerPlugin(ScrollTrigger, SplitText, ScrambleTextPlugin, DrawSVGPlugin);

window.gsap = gsap;
window.ScrollTrigger = ScrollTrigger;
window.SplitText = SplitText;
window.ScrambleTextPlugin = ScrambleTextPlugin;
window.DrawSVGPlugin = DrawSVGPlugin;

// ─── Navbar & Mobile Drawer setup ──────────────────────
const navbar = document.getElementById('navbar');
if (navbar) navbar.classList.add('scrolled');

const mobileToggle = document.getElementById('mobile-toggle');
const mobileDrawer = document.getElementById('mobile-drawer');
const mobileNavLinks = document.querySelectorAll('.mobile-nav-link');

if (mobileToggle && mobileDrawer) {
    mobileToggle.addEventListener('click', () => {
        const isOpen = mobileDrawer.classList.contains('active');
        if (isOpen) {
            mobileDrawer.classList.remove('active');
            mobileToggle.classList.remove('active');
            mobileToggle.setAttribute('aria-expanded', 'false');
            mobileDrawer.setAttribute('aria-hidden', 'true');
            document.body.style.overflow = '';
        } else {
            mobileDrawer.classList.add('active');
            mobileToggle.classList.add('active');
            mobileToggle.setAttribute('aria-expanded', 'true');
            mobileDrawer.setAttribute('aria-hidden', 'false');
            document.body.style.overflow = 'hidden';
        }
    });

    mobileNavLinks.forEach(link => {
        link.addEventListener('click', () => {
            mobileDrawer.classList.remove('active');
            mobileToggle.classList.remove('active');
            mobileToggle.setAttribute('aria-expanded', 'false');
            mobileDrawer.setAttribute('aria-hidden', 'true');
            document.body.style.overflow = '';
        });
    });
}


// ═══════════════════════════════════════════════════════
//  FULL-PAGE ENGINE — mirrors GSAP branch trans-col logic
// ─── Hero entrance ───────────────────────────────────
const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

if (prefersReducedMotion) {
    gsap.set(['#hero-h1', '#hero-p', '#hero-btn'], { opacity: 1, y: 0 });
} else {
    gsap.timeline({ defaults: { ease: 'power3.out', duration: 0.85 } })
        .to('#hero-p', { opacity: 1, y: 0, delay: 0.28 })
        .to('#hero-btn', { opacity: 1, y: 0 }, '-=0.45');
}

// ═══════════════════════════════════════════════════════
//  HERO <-> SERVICES SIGNATURE SCROLL TRANSITION ENGINE
//  • Hero <-> Services: Signature Cyber Blade transition
//  • Services downwards (Works -> Testimonials -> Why -> CTA):
//    100% natural, smooth native scrolling experience!
// ═══════════════════════════════════════════════════════
(function pageEngine() {
    const secHero = document.getElementById('hero');
    const secServices = document.getElementById('services');
    if (!secHero || !secServices) return;

    const overlay = document.getElementById('fp-overlay');
    const blades = overlay ? Array.from(overlay.querySelectorAll('.cyber-blade')) : [];
    const rgbCyan = overlay ? overlay.querySelector('.rgb-cyan') : null;
    const rgbPink = overlay ? overlay.querySelector('.rgb-pink') : null;
    const scanlines = overlay ? overlay.querySelector('.cyber-scanlines') : null;

    const secWorks = document.getElementById('works');

    const NAV = {
        hero: { bg: 'rgba(14,14,14,0.65)', border: 'rgba(255,255,255,0.08)', light: false },
        services: { bg: 'rgba(248,250,252,0.85)', border: 'rgba(0,0,0,0.06)', light: true },
        works: { bg: 'rgba(227,227,227,0.65)', border: 'rgba(0,0,0,0.06)', light: true },
        testimonials: { bg: 'rgba(243,89,176,0.65)', border: 'rgba(255,255,255,0.08)', light: false },
        why: { bg: 'rgba(239,239,239,0.65)', border: 'rgba(0,0,0,0.06)', light: true },
        process: { bg: 'rgba(240,240,245,0.65)', border: 'rgba(0,0,0,0.06)', light: true },
        faq: { bg: 'rgba(255,255,255,0.65)', border: 'rgba(0,0,0,0.06)', light: true },
        cta: { bg: 'rgba(0,0,0,0.65)', border: 'rgba(255,255,255,0.08)', light: false },
    };

    let currentMode = 'hero'; // 'hero' | 'services'
    let isTransitioning = false;

    function forceScrollToTop() {
        window.scrollTo({ top: 0, left: 0, behavior: 'instant' });
        document.documentElement.scrollTop = 0;
        document.body.scrollTop = 0;
    }

    function applyNavTheme(key) {
        if (!navbar) return;
        const t = NAV[key] ?? NAV.hero;
        gsap.to(navbar, { '--nav-bg': t.bg, '--nav-border': t.border, duration: 0.3, ease: 'none' });
        navbar.classList.toggle('light-theme', t.light);
    }

    function getSectionElements(sec) {
        if (!sec) return [];
        const selectors = [
            '.hero-title', '.hero-subtitle', '.btn-hero',
            '.sec-label', '.services-title', '.services-subline', '.services-cards', '.btn-dark',
            '.works-section-label', '.works-heading', '#stats-row', '.works-description', '.works-card-grid > .group', '.works-see-more',
            '.testi-label', '.testi-title', '.testi-right-desc', '.testi-card',
            '.why-title', '.why-desc', '.why-deck-wrap', '.why-card',
            '.process-label', '.process-title', '.process-desc', '.process-phase-block', '.process-footer',
            '.faq-label', '.faq-title', '.faq-desc', '.faq-item',
            '.cta-terminal', '.cta-title', '.cta-desc', '.cta-btn', '.cta-visual'
        ];
        const els = sec.querySelectorAll(selectors.join(', '));
        if (els.length > 0) return Array.from(els);
        const inner = sec.querySelector('.sec-inner, .hero-content, .works-content-wrap, .process-content-wrap, .cta-outer') || sec;
        return Array.from(inner.children);
    }

    // Initialize: Hero is active at top
    document.body.classList.add('hero-active');
    forceScrollToTop();
    gsap.set(secHero, {
        position: 'relative',
        top: 'auto',
        left: 'auto',
        width: '100%',
        zIndex: 10,
        visibility: 'visible',
        opacity: 1,
        pointerEvents: 'auto'
    });
    gsap.set(secServices, {
        position: 'absolute',
        top: 0,
        left: 0,
        width: '100%',
        height: '100%',
        zIndex: 0,
        visibility: 'hidden',
        opacity: 0,
        pointerEvents: 'none'
    });
    if (overlay) gsap.set(overlay, { visibility: 'hidden', opacity: 0, zIndex: 0, pointerEvents: 'none' });
    applyNavTheme('hero');

    // ── Transition: Hero -> Services ───────────────────
    function transitionToServices(callback) {
        if (isTransitioning || currentMode === 'services') {
            if (callback) callback();
            return;
        }

        isTransitioning = true;
        forceScrollToTop();
        const fromSec = secHero;
        const toSec = secServices;
        const fromEls = getSectionElements(fromSec);
        const toEls = getSectionElements(toSec);

        blades.forEach(blade => {
            const surf = blade.querySelector('.cyber-blade-surface');
            if (surf) surf.style.background = 'rgba(14, 14, 14, 0.9)';
        });
        if (overlay) gsap.set(overlay, { visibility: 'visible', opacity: 1, zIndex: 99 });

        gsap.set(fromSec, { position: 'absolute', top: 0, left: 0, width: '100%', height: '100%', visibility: 'visible', opacity: 1, scale: 1, zIndex: 10, pointerEvents: 'none' });
        gsap.set(toSec, { position: 'absolute', top: 0, left: 0, width: '100%', minHeight: '100vh', visibility: 'visible', opacity: 0, scale: 1.03, y: 0, zIndex: 20, pointerEvents: 'none' });
        gsap.set(toEls, { opacity: 0, y: 35, skewX: -5 });
        gsap.set(blades, { x: '0%', opacity: 1, skewX: 0 });
        if (rgbCyan) gsap.set(rgbCyan, { opacity: 0, x: -18 });
        if (rgbPink) gsap.set(rgbPink, { opacity: 0, x: 18 });
        if (scanlines) gsap.set(scanlines, { opacity: 0 });

        const tl = gsap.timeline({
            onComplete() {
                currentMode = 'services';
                document.body.classList.remove('hero-active');
                forceScrollToTop();

                gsap.set(fromSec, { position: 'absolute', top: 0, left: 0, width: '100%', height: '100%', visibility: 'hidden', opacity: 0, zIndex: 0, scale: 1, pointerEvents: 'none' });
                gsap.set(fromEls, { clearProps: 'transform,opacity,scale,skewX,x,y' });

                if (overlay) gsap.set(overlay, { visibility: 'hidden', opacity: 0, zIndex: 0 });
                gsap.set(blades, { clearProps: 'transform,opacity,skewX,x,y' });
                if (rgbCyan) gsap.set(rgbCyan, { opacity: 0 });
                if (rgbPink) gsap.set(rgbPink, { opacity: 0 });
                if (scanlines) gsap.set(scanlines, { opacity: 0 });

                gsap.set(toSec, { position: 'relative', top: 'auto', left: 'auto', width: '100%', height: 'auto', zIndex: 5, opacity: 1, scale: 1, pointerEvents: 'auto' });
                gsap.set(toEls, { clearProps: 'transform,opacity,scale,skewX,x,y' });

                applyNavTheme('services');
                setTimeout(() => {
                    isTransitioning = false;
                    if (callback) callback();
                }, 80);
            }
        });

        tl.to(fromEls, {
            opacity: 0, x: -30, skewX: -4,
            duration: 0.45, ease: 'power2.in', stagger: 0.018
        }, 0);

        tl.to(fromSec, { scale: 0.94, opacity: 0.25, duration: 0.6, ease: 'power2.inOut' }, 0);

        if (rgbCyan && rgbPink && scanlines) {
            tl.to([rgbCyan, rgbPink, scanlines], { opacity: 0.7, duration: 0.3, ease: 'power1.inOut' }, 0.06);
            tl.to([rgbCyan, rgbPink, scanlines], { opacity: 0, duration: 0.38, ease: 'power2.out' }, 0.36);
        }

        tl.to(toSec, { opacity: 1, scale: 1, duration: 0.85, ease: 'power3.out' }, 0.08);

        blades.forEach((blade, i) => {
            const isEven = (i % 2 === 0);
            const shearDir = isEven ? -1 : 1;
            const delay = (i % 4) * 0.035;

            tl.to(blade, {
                x: (shearDir * 140) + '%',
                skewX: shearDir * 14,
                opacity: 0,
                duration: 0.88,
                ease: 'power3.inOut'
            }, 0.06 + delay);
        });

        tl.to(toEls, { opacity: 1, y: 0, skewX: 0, duration: 0.7, ease: 'power3.out', stagger: 0.035 }, 0.22);
        if (navbar) {
            tl.to(navbar, { '--nav-bg': NAV.services.bg, '--nav-border': NAV.services.border, duration: 0.5, ease: 'power2.inOut' }, 0.06);
            navbar.classList.toggle('light-theme', NAV.services.light);
        }
    }

    // ── Transition: Services -> Hero ───────────────────
    function transitionToHero(callback) {
        if (isTransitioning || currentMode === 'hero') {
            if (callback) callback();
            return;
        }

        const scrollY = window.scrollY || window.pageYOffset || 0;
        if (scrollY > 5) {
            forceScrollToTop();
        }

        isTransitioning = true;
        forceScrollToTop();
        const fromSec = secServices;
        const toSec = secHero;
        const fromEls = getSectionElements(fromSec);
        const toEls = getSectionElements(toSec);

        blades.forEach(blade => {
            const surf = blade.querySelector('.cyber-blade-surface');
            if (surf) surf.style.background = '#0e0e0e';
        });
        if (overlay) gsap.set(overlay, { visibility: 'visible', opacity: 1, zIndex: 99 });

        gsap.set(fromSec, { position: 'absolute', top: 0, left: 0, width: '100%', height: '100%', visibility: 'visible', opacity: 1, scale: 1, zIndex: 10, pointerEvents: 'none' });
        gsap.set(toSec, { position: 'absolute', top: 0, left: 0, width: '100%', minHeight: '100vh', visibility: 'visible', opacity: 0, scale: 1.03, y: 0, zIndex: 20, pointerEvents: 'none' });
        gsap.set(toEls, { opacity: 0, y: -35, skewX: 5 });
        gsap.set(blades, { x: '0%', opacity: 1, skewX: 0 });
        if (rgbCyan) gsap.set(rgbCyan, { opacity: 0, x: 18 });
        if (rgbPink) gsap.set(rgbPink, { opacity: 0, x: -18 });
        if (scanlines) gsap.set(scanlines, { opacity: 0 });

        const tl = gsap.timeline({
            onComplete() {
                currentMode = 'hero';
                forceScrollToTop();
                document.body.classList.add('hero-active');

                gsap.set(fromSec, { position: 'absolute', top: 0, left: 0, width: '100%', height: '100%', visibility: 'hidden', opacity: 0, zIndex: 0, scale: 1, pointerEvents: 'none' });
                gsap.set(fromEls, { clearProps: 'transform,opacity,scale,skewX,x,y' });

                if (overlay) gsap.set(overlay, { visibility: 'hidden', opacity: 0, zIndex: 0 });
                gsap.set(blades, { clearProps: 'transform,opacity,skewX,x,y' });
                if (rgbCyan) gsap.set(rgbCyan, { opacity: 0 });
                if (rgbPink) gsap.set(rgbPink, { opacity: 0 });
                if (scanlines) gsap.set(scanlines, { opacity: 0 });

                gsap.set(toSec, { position: 'relative', top: 'auto', left: 'auto', width: '100%', height: 'auto', zIndex: 10, opacity: 1, scale: 1, pointerEvents: 'auto' });
                gsap.set(toEls, { clearProps: 'transform,opacity,scale,skewX,x,y' });

                applyNavTheme('hero');
                setTimeout(() => {
                    isTransitioning = false;
                    if (callback) callback();
                }, 80);
            }
        });

        tl.to(fromEls, {
            opacity: 0, x: 30, skewX: 4,
            duration: 0.45, ease: 'power2.in', stagger: 0.018
        }, 0);

        tl.to(fromSec, { scale: 0.94, opacity: 0.25, duration: 0.6, ease: 'power2.inOut' }, 0);

        if (rgbCyan && rgbPink && scanlines) {
            tl.to([rgbCyan, rgbPink, scanlines], { opacity: 0.7, duration: 0.3, ease: 'power1.inOut' }, 0.06);
            tl.to([rgbCyan, rgbPink, scanlines], { opacity: 0, duration: 0.38, ease: 'power2.out' }, 0.36);
        }

        tl.to(toSec, { opacity: 1, scale: 1, duration: 0.85, ease: 'power3.out' }, 0.08);

        blades.forEach((blade, i) => {
            const isEven = (i % 2 === 0);
            const shearDir = isEven ? 1 : -1;
            const delay = (i % 4) * 0.035;

            tl.to(blade, {
                x: (shearDir * 140) + '%',
                skewX: shearDir * 14,
                opacity: 0,
                duration: 0.88,
                ease: 'power3.inOut'
            }, 0.06 + delay);
        });

        tl.to(toEls, { opacity: 1, y: 0, skewX: 0, duration: 0.7, ease: 'power3.out', stagger: 0.035 }, 0.22);
        if (navbar) {
            tl.to(navbar, { '--nav-bg': NAV.hero.bg, '--nav-border': NAV.hero.border, duration: 0.5, ease: 'power2.inOut' }, 0.06);
            navbar.classList.toggle('light-theme', NAV.hero.light);
        }
    }

    // ── Mouse Wheel Input ──────────────────────────────
    window.addEventListener('wheel', e => {
        if (document.body.classList.contains('modal-open')) return;
        if (isTransitioning) {
            e.preventDefault();
            return;
        }

        if (currentMode === 'hero') {
            if (e.deltaY > 10) {
                e.preventDefault();
                transitionToServices();
            } else {
                e.preventDefault();
            }
            return;
        }

        if (currentMode === 'services') {
            const scrollY = window.scrollY || window.pageYOffset || 0;
            if (scrollY <= 2 && e.deltaY < -15) {
                e.preventDefault();
                transitionToHero();
                return;
            }
            // All other scrolling is 100% normal browser scrolling!
        }
    }, { passive: false });

    // ── Touch Swipe Handling ───────────────────────────
    let touchY0 = 0;
    window.addEventListener('touchstart', e => {
        touchY0 = e.touches[0].clientY;
    }, { passive: true });

    window.addEventListener('touchmove', e => {
        if (isTransitioning) {
            e.preventDefault();
        }
    }, { passive: false });

    window.addEventListener('touchend', e => {
        if (document.body.classList.contains('modal-open') || isTransitioning) return;

        const touchEndY = e.changedTouches[0].clientY;
        const dy = touchY0 - touchEndY; // dy > 0: swiped up (scrolling down)

        if (currentMode === 'hero') {
            if (dy > 30) {
                transitionToServices();
            }
            return;
        }

        if (currentMode === 'services') {
            const scrollY = window.scrollY || window.pageYOffset || 0;
            if (scrollY <= 5 && dy < -30) {
                transitionToHero();
            }
        }
    }, { passive: true });

    // ── Keyboard Navigation ────────────────────────────
    window.addEventListener('keydown', e => {
        if (document.body.classList.contains('modal-open')) return;
        if (isTransitioning) {
            if (['ArrowDown', 'ArrowUp', 'PageDown', 'PageUp', ' ', 'Home', 'End'].includes(e.key)) {
                e.preventDefault();
            }
            return;
        }

        if (currentMode === 'hero') {
            if (e.key === 'ArrowDown' || e.key === 'PageDown' || (e.key === ' ' && !e.shiftKey)) {
                e.preventDefault();
                transitionToServices();
            } else if (e.key === 'ArrowUp' || e.key === 'PageUp') {
                e.preventDefault();
            }
            return;
        }

        if (currentMode === 'services') {
            const scrollY = window.scrollY || window.pageYOffset || 0;
            if (scrollY <= 2 && (e.key === 'ArrowUp' || e.key === 'PageUp')) {
                e.preventDefault();
                transitionToHero();
            }
        }
    });

    // ── Anchor Link & Logo Navigation ──────────────────
    const logoLink = document.getElementById('logo');
    if (logoLink) {
        logoLink.addEventListener('click', (e) => {
            if (window.location.pathname === '/' || window.location.pathname === '') {
                e.preventDefault();
                if (currentMode === 'services') {
                    forceScrollToTop();
                    transitionToHero();
                }
            }
        });
    }

    document.querySelectorAll('a[href^="#"], a[href^="/#"]').forEach(link => {
        link.addEventListener('click', e => {
            const rawHref = link.getAttribute('href');
            const hash = rawHref.includes('#') ? rawHref.substring(rawHref.indexOf('#') + 1) : '';
            if (!hash) return;

            e.preventDefault();

            if (hash === 'hero') {
                if (currentMode === 'services') {
                    forceScrollToTop();
                    transitionToHero();
                }
                return;
            }

            if (hash === 'services') {
                if (currentMode === 'hero') {
                    transitionToServices();
                } else {
                    window.scrollTo({ top: 0, behavior: 'smooth' });
                }
                return;
            }

            const targetEl = document.getElementById(hash);
            if (targetEl) {
                if (currentMode === 'hero') {
                    transitionToServices(() => {
                        setTimeout(() => {
                            targetEl.scrollIntoView({ behavior: 'smooth' });
                        }, 60);
                    });
                } else {
                    targetEl.scrollIntoView({ behavior: 'smooth' });
                }
            }
        });
    });

    // ── Navbar Dynamic Theme on Scroll ─────────────────
    const observedSections = [
        { id: 'services', key: 'services' },
        { id: 'works', key: 'works' },
        { id: 'testimonials', key: 'testimonials' },
        { id: 'why', key: 'why' },
        { id: 'process', key: 'process' },
        { id: 'faq', key: 'faq' },
        { id: 'cta', key: 'cta' },
    ];

    function updateNavOnScroll() {
        if (currentMode === 'hero') {
            applyNavTheme('hero');
            return;
        }

        const scrollY = window.scrollY || window.pageYOffset || 0;
        const vh = window.innerHeight;
        const probe = scrollY + vh * 0.35;

        let activeKey = 'services';
        for (const item of observedSections) {
            const el = document.getElementById(item.id);
            if (el) {
                const top = el.offsetTop;
                if (probe >= top) {
                    activeKey = item.key;
                }
            }
        }
        applyNavTheme(activeKey);
    }

    window.addEventListener('scroll', updateNavOnScroll, { passive: true });

    window.fp = {
        transitionToServices,
        transitionToHero,
        current: () => (currentMode === 'hero' ? 0 : 1)
    };
})();


// ─── Service card selection ─────────────────────────────
// Cards now open a modal instead of pausing the marquee.
// Clear any lingering selection state so the track always resumes.
function clearCarouselSelection() {
    document.querySelectorAll('.svc-card').forEach(c => c.classList.remove('selected'));
    document.querySelectorAll('.services-track').forEach(t => t.classList.remove('has-selected'));
}

// ─── CTA ASCII Video Canvas ─────────────────────────────
const ctaVideo = document.getElementById('cta-video-source');
const ctaCanvas = document.getElementById('cta-video-canvas');
if (ctaVideo && ctaCanvas) {
    const ctx = ctaCanvas.getContext('2d');
    const upd = () => { if (ctaVideo.videoWidth) { ctaCanvas.width = ctaVideo.videoWidth; ctaCanvas.height = ctaVideo.videoHeight; } };
    ctaVideo.addEventListener('loadedmetadata', upd);
    const render = () => { if (!ctaVideo.paused && !ctaVideo.ended) { ctx.clearRect(0, 0, ctaCanvas.width, ctaCanvas.height); ctx.drawImage(ctaVideo, 0, 0, ctaCanvas.width, ctaCanvas.height); } requestAnimationFrame(render); };
    ctaVideo.addEventListener('play', () => { upd(); render(); });
    if (!ctaVideo.paused) { upd(); render(); } else { ctaVideo.play().then(() => { upd(); render(); }).catch(() => { }); }
}

// ─── Project Detail Modal Controller ────────────────────
(function projectModalController() {
    const modal = document.getElementById('project-modal');
    if (!modal) return;

    const closeBtn = document.getElementById('project-modal-close-btn');
    const pathEl = document.getElementById('project-modal-path');
    const titleEl = document.getElementById('project-modal-title');
    const categoryEl = document.getElementById('project-modal-category');
    const yearEl = document.getElementById('project-modal-year');
    const clientWrapEl = document.getElementById('project-modal-client-wrap');
    const clientEl = document.getElementById('project-modal-client');
    const roleWrapEl = document.getElementById('project-modal-role-wrap');
    const roleEl = document.getElementById('project-modal-role');
    const descEl = document.getElementById('project-modal-desc');
    const primaryMediaEl = document.getElementById('project-modal-primary-media');
    const blocksContainer = document.getElementById('project-modal-blocks');
    const linksContainer = document.getElementById('project-modal-links');
    const modalCard = modal.querySelector('.project-modal-card');

    // Parse pre-rendered JSON payload
    let projectsData = [];
    const projectsDataScript = document.getElementById('odds-projects-data');
    if (projectsDataScript) {
        try {
            projectsData = JSON.parse(projectsDataScript.textContent);
        } catch (e) {
            console.error('Failed to parse odds-projects-data:', e);
        }
    }

    function renderNotionBlocks(blocksData, fallbackStory) {
        if (!blocksContainer) return;
        blocksContainer.innerHTML = '';

        let blocks = [];
        if (Array.isArray(blocksData)) {
            blocks = blocksData;
        } else if (typeof blocksData === 'string' && blocksData.trim() !== '') {
            try {
                let parsed = blocksData;
                if (parsed.includes('&quot;') || parsed.includes('&#039;')) {
                    const txt = document.createElement('textarea');
                    txt.innerHTML = parsed;
                    parsed = txt.value;
                }
                blocks = JSON.parse(parsed);
            } catch (e) {
                blocks = [];
            }
        }

        if (Array.isArray(blocks) && blocks.length > 0) {
            let currentList = null;
            let currentListType = null;

            blocks.forEach(b => {
                const type = b.type || 'paragraph';
                const content = b.content !== undefined ? b.content : '';

                // Close list container if current block is of different type
                if (currentList && currentListType !== type) {
                    currentList = null;
                    currentListType = null;
                }

                if (type === 'heading2') {
                    const h2 = document.createElement('h2');
                    h2.className = 'frame46-block-h2';
                    h2.innerHTML = content;
                    blocksContainer.appendChild(h2);
                } else if (type === 'heading3') {
                    const h3 = document.createElement('h3');
                    h3.className = 'frame46-block-h3';
                    h3.innerHTML = content;
                    blocksContainer.appendChild(h3);
                } else if (type === 'bullet') {
                    if (!currentList || currentListType !== 'bullet') {
                        currentList = document.createElement('ul');
                        currentList.className = 'frame46-block-bullet-list';
                        blocksContainer.appendChild(currentList);
                        currentListType = 'bullet';
                    }
                    const li = document.createElement('li');
                    li.className = 'frame46-block-bullet-item';
                    li.innerHTML = `<span class="frame46-block-bullet-dot">•</span><div class="flex-1">${content}</div>`;
                    currentList.appendChild(li);
                } else if (type === 'numbered') {
                    if (!currentList || currentListType !== 'numbered') {
                        currentList = document.createElement('ol');
                        currentList.className = 'frame46-block-num-list';
                        blocksContainer.appendChild(currentList);
                        currentListType = 'numbered';
                    }
                    const count = currentList.children.length + 1;
                    const li = document.createElement('li');
                    li.className = 'frame46-block-num-item';
                    li.innerHTML = `<span class="frame46-block-num-badge">${count}.</span><div class="flex-1">${content}</div>`;
                    currentList.appendChild(li);
                } else if (type === 'quote') {
                    const blockquote = document.createElement('blockquote');
                    blockquote.className = 'frame46-block-quote';
                    blockquote.innerHTML = content;
                    blocksContainer.appendChild(blockquote);
                } else if (type === 'callout') {
                    const callout = document.createElement('div');
                    callout.className = 'frame46-block-callout';
                    callout.innerHTML = `
                        <div class="frame46-block-callout-icon"><i class="fa-solid fa-lightbulb"></i></div>
                        <div class="flex-1">${content}</div>
                    `;
                    blocksContainer.appendChild(callout);
                } else if (type === 'code') {
                    const pre = document.createElement('pre');
                    pre.className = 'frame46-block-code';
                    pre.textContent = content;
                    blocksContainer.appendChild(pre);
                } else if (type === 'divider') {
                    const hr = document.createElement('hr');
                    hr.className = 'frame46-block-divider';
                    blocksContainer.appendChild(hr);
                } else if (type === 'image' && b.src) {
                    const card = document.createElement('div');
                    card.className = 'frame46-block-image-card';
                    card.innerHTML = `
                        <div class="frame46-block-image-inner">
                            <img src="${b.src}" alt="${b.caption || 'Project visual'}" loading="lazy">
                        </div>
                        ${b.caption ? `<div class="frame46-block-image-caption">${b.caption}</div>` : ''}
                    `;
                    blocksContainer.appendChild(card);
                } else {
                    if (content.toString().trim() !== '') {
                        const p = document.createElement('p');
                        p.className = 'frame46-block-p';
                        p.innerHTML = content;
                        blocksContainer.appendChild(p);
                    }
                }
            });
        } else if (fallbackStory && fallbackStory.trim() !== '') {
            const p = document.createElement('p');
            p.className = 'frame46-block-p';
            p.innerHTML = fallbackStory;
            blocksContainer.appendChild(p);
        } else {
            blocksContainer.innerHTML = '';
        }
    }

    function openProjectModal(meta) {
        if (titleEl) titleEl.textContent = meta.title || 'PROJECT';
        if (pathEl) pathEl.textContent = meta.pathStr || `ODDS_Project/${meta.title}/Project_Story`;
        if (categoryEl) categoryEl.textContent = meta.category || 'Architecture';
        if (yearEl) yearEl.textContent = meta.year || '2024';
        if (descEl) descEl.textContent = meta.desc || 'Comprehensive project overview, technical architecture, and implementation details.';

        if (clientEl && clientWrapEl) {
            if (meta.client) {
                clientEl.textContent = `Client: ${meta.client}`;
                clientWrapEl.classList.remove('hidden');
            } else {
                clientWrapEl.classList.add('hidden');
            }
        }

        if (roleEl && roleWrapEl) {
            if (meta.role) {
                roleEl.textContent = `Role: ${meta.role}`;
                roleWrapEl.classList.remove('hidden');
            } else {
                roleWrapEl.classList.add('hidden');
            }
        }

        if (primaryMediaEl) {
            if (meta.cover) {
                primaryMediaEl.innerHTML = `<img src="${meta.cover}" alt="${meta.title}" class="w-full h-full object-cover">`;
            } else {
                primaryMediaEl.innerHTML = `
                    <div class="flex flex-col items-center justify-center text-white/40 space-y-3">
                        <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                            <rect width="18" height="18" x="3" y="3" rx="2" ry="2"/>
                            <circle cx="9" cy="9" r="2"/>
                            <path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21"/>
                        </svg>
                        <span class="font-mono text-xs tracking-wider uppercase">${meta.title} Visual Overview</span>
                    </div>
                `;
            }
        }

        if (linksContainer) {
            linksContainer.innerHTML = '';
            if (meta.demoUrl) {
                linksContainer.innerHTML += `<a href="${meta.demoUrl}" target="_blank" class="frame46-action-btn"><i class="fa-solid fa-arrow-up-right-from-square text-[10px]"></i>Live Demo</a>`;
            }
            if (meta.githubUrl) {
                linksContainer.innerHTML += `<a href="${meta.githubUrl}" target="_blank" class="frame46-action-btn"><i class="fa-brands fa-github text-[11px]"></i>Repository</a>`;
            }
        }

        renderNotionBlocks(meta.blocks, meta.story);

        modal.scrollTop = 0;
        modal.classList.remove('hidden');
        void modal.offsetWidth;
        modal.classList.add('is-active');
        modal.setAttribute('aria-hidden', 'false');

        document.body.classList.add('modal-open');
    }

    function closeProjectModal() {
        modal.classList.remove('is-active');
        modal.setAttribute('aria-hidden', 'true');
        document.body.classList.remove('modal-open');

        setTimeout(() => {
            if (!modal.classList.contains('is-active')) {
                modal.classList.add('hidden');
            }
        }, 250);
    }

    // Attach trigger to every project card in works grid
    document.querySelectorAll('.project-card-trigger').forEach(trigger => {
        trigger.addEventListener('click', e => {
            e.stopPropagation();
            const index = trigger.getAttribute('data-project-index');
            let meta = null;

            if (index !== null && projectsData && projectsData[index]) {
                const item = projectsData[index];
                meta = {
                    title: item.title,
                    category: item.category,
                    year: item.year,
                    client: item.client,
                    role: item.role,
                    desc: item.description,
                    blocks: item.body_content,
                    story: item.story_content,
                    cover: item.cover_image,
                    demoUrl: item.demo_url,
                    githubUrl: item.github_url,
                    pathStr: item.path_str
                };
            } else {
                meta = {
                    title: trigger.getAttribute('data-project-title') || 'PROJECT',
                    category: trigger.getAttribute('data-project-category'),
                    year: trigger.getAttribute('data-project-year'),
                    client: trigger.getAttribute('data-project-client') || '',
                    role: trigger.getAttribute('data-project-role') || '',
                    desc: trigger.getAttribute('data-project-desc'),
                    blocks: trigger.getAttribute('data-project-blocks'),
                    story: trigger.getAttribute('data-project-story'),
                    cover: trigger.getAttribute('data-project-cover'),
                    demoUrl: trigger.getAttribute('data-project-demo'),
                    githubUrl: trigger.getAttribute('data-project-github'),
                    pathStr: trigger.getAttribute('data-project-path')
                };
            }

            openProjectModal(meta);
        });
    });

    if (closeBtn) {
        closeBtn.addEventListener('click', e => {
            e.stopPropagation();
            closeProjectModal();
        });
    }

    modal.addEventListener('click', e => {
        if (modalCard && !modalCard.contains(e.target)) {
            closeProjectModal();
        }
    });

    window.addEventListener('keydown', e => {
        if (e.key === 'Escape' && modal.classList.contains('is-active')) {
            closeProjectModal();
        }
    });

    window.openProjectModal = openProjectModal;
    window.closeProjectModal = closeProjectModal;
})();

// ─── Service Detail Modal Controller ────────────────────
(function serviceModalController() {
    const modal = document.getElementById('service-modal');
    if (!modal) return;

    const closeBtn = document.getElementById('service-modal-close-btn');
    const pathEl = document.getElementById('service-modal-path');
    const titleEl = document.getElementById('service-modal-title');
    const taglineEl = document.getElementById('service-modal-tagline');
    const iconWrapEl = document.getElementById('service-modal-icon-wrap');
    const featuresWrapEl = document.getElementById('service-modal-features-wrap');
    const descEl = document.getElementById('service-modal-desc');
    const primaryMediaEl = document.getElementById('service-modal-primary-media');
    const blocksContainer = document.getElementById('service-modal-blocks');
    const linksContainer = document.getElementById('service-modal-links');
    const ctaActionBtn = document.getElementById('service-modal-cta-action');
    const ctaLabelEl = document.getElementById('service-modal-cta-label');
    const modalCard = modal.querySelector('.service-modal-card');

    // Parse pre-rendered JSON payload for services
    let servicesData = [];
    const servicesDataScript = document.getElementById('odds-services-data');
    if (servicesDataScript) {
        try {
            servicesData = JSON.parse(servicesDataScript.textContent);
        } catch (e) {
            console.error('Failed to parse odds-services-data:', e);
        }
    }

    function renderNotionBlocks(blocksData, fallbackDesc) {
        if (!blocksContainer) return;
        blocksContainer.innerHTML = '';

        let blocks = [];
        if (Array.isArray(blocksData)) {
            blocks = blocksData;
        } else if (typeof blocksData === 'string' && blocksData.trim() !== '') {
            try {
                let parsed = blocksData;
                if (parsed.includes('&quot;') || parsed.includes('&#039;')) {
                    const txt = document.createElement('textarea');
                    txt.innerHTML = parsed;
                    parsed = txt.value;
                }
                blocks = JSON.parse(parsed);
            } catch (e) {
                blocks = [];
            }
        }

        if (Array.isArray(blocks) && blocks.length > 0) {
            let currentList = null;
            let currentListType = null;

            blocks.forEach(b => {
                const type = b.type || 'paragraph';
                const content = b.content !== undefined ? b.content : '';

                if (currentList && currentListType !== type) {
                    currentList = null;
                    currentListType = null;
                }

                if (type === 'heading2') {
                    const h2 = document.createElement('h2');
                    h2.className = 'frame46-block-h2';
                    h2.innerHTML = content;
                    blocksContainer.appendChild(h2);
                } else if (type === 'heading3') {
                    const h3 = document.createElement('h3');
                    h3.className = 'frame46-block-h3';
                    h3.innerHTML = content;
                    blocksContainer.appendChild(h3);
                } else if (type === 'bullet') {
                    if (!currentList || currentListType !== 'bullet') {
                        currentList = document.createElement('ul');
                        currentList.className = 'frame46-block-bullet-list';
                        blocksContainer.appendChild(currentList);
                        currentListType = 'bullet';
                    }
                    const li = document.createElement('li');
                    li.className = 'frame46-block-bullet-item';
                    li.innerHTML = `<span class="frame46-block-bullet-dot">•</span><div class="flex-1">${content}</div>`;
                    currentList.appendChild(li);
                } else if (type === 'numbered') {
                    if (!currentList || currentListType !== 'numbered') {
                        currentList = document.createElement('ol');
                        currentList.className = 'frame46-block-num-list';
                        blocksContainer.appendChild(currentList);
                        currentListType = 'numbered';
                    }
                    const count = currentList.children.length + 1;
                    const li = document.createElement('li');
                    li.className = 'frame46-block-num-item';
                    li.innerHTML = `<span class="frame46-block-num-badge">${count}.</span><div class="flex-1">${content}</div>`;
                    currentList.appendChild(li);
                } else if (type === 'quote') {
                    const blockquote = document.createElement('blockquote');
                    blockquote.className = 'frame46-block-quote';
                    blockquote.innerHTML = content;
                    blocksContainer.appendChild(blockquote);
                } else if (type === 'callout') {
                    const callout = document.createElement('div');
                    callout.className = 'frame46-block-callout';
                    callout.innerHTML = `
                        <div class="frame46-block-callout-icon"><i class="fa-solid fa-lightbulb"></i></div>
                        <div class="flex-1">${content}</div>
                    `;
                    blocksContainer.appendChild(callout);
                } else if (type === 'code') {
                    const pre = document.createElement('pre');
                    pre.className = 'frame46-block-code';
                    pre.textContent = content;
                    blocksContainer.appendChild(pre);
                } else if (type === 'divider') {
                    const hr = document.createElement('hr');
                    hr.className = 'frame46-block-divider';
                    blocksContainer.appendChild(hr);
                } else if (type === 'image' && b.src) {
                    const card = document.createElement('div');
                    card.className = 'frame46-block-image-card';
                    card.innerHTML = `
                        <div class="frame46-block-image-inner">
                            <img src="${b.src}" alt="${b.caption || 'Service visual'}" loading="lazy">
                        </div>
                        ${b.caption ? `<div class="frame46-block-image-caption">${b.caption}</div>` : ''}
                    `;
                    blocksContainer.appendChild(card);
                } else {
                    if (content.toString().trim() !== '') {
                        const p = document.createElement('p');
                        p.className = 'frame46-block-p';
                        p.innerHTML = content;
                        blocksContainer.appendChild(p);
                    }
                }
            });
        } else if (fallbackDesc && fallbackDesc.trim() !== '') {
            const p = document.createElement('p');
            p.className = 'frame46-block-p';
            p.innerHTML = fallbackDesc;
            blocksContainer.appendChild(p);
        } else {
            blocksContainer.innerHTML = '';
        }
    }

    function openServiceModal(meta) {
        // Immediately clear carousel selection so the marquee keeps flowing
        clearCarouselSelection();

        if (titleEl) titleEl.textContent = (meta.name || 'SERVICE').replace(/\n/g, ' ');
        if (pathEl) pathEl.textContent = meta.pathStr || `ODDS_Studio/Services/${meta.name}/Overview`;
        if (taglineEl) taglineEl.textContent = meta.tagline || 'Engineering Capability';
        if (descEl) descEl.textContent = meta.desc || 'High-performance engineering and custom software architecture.';

        if (iconWrapEl) {
            if (meta.iconSvg && meta.iconSvg.trim() !== '') {
                iconWrapEl.innerHTML = meta.iconSvg;
                const svgEl = iconWrapEl.querySelector('svg');
                if (svgEl) {
                    svgEl.style.width = '28px';
                    svgEl.style.height = '28px';
                    svgEl.style.stroke = '#875af5';
                }
            } else {
                iconWrapEl.innerHTML = '<i class="fa-solid fa-cube" style="font-size:20px;color:#875af5;"></i>';
            }
        }

        if (featuresWrapEl) {
            featuresWrapEl.innerHTML = '';
            if (Array.isArray(meta.features) && meta.features.length > 0) {
                meta.features.forEach(f => {
                    if (f && f.trim() !== '') {
                        const chip = document.createElement('span');
                        chip.className = 'svc-modal-feature-chip';
                        chip.innerHTML = `<i class="fa-solid fa-check" style="font-size:8px;"></i>${f.trim()}`;
                        featuresWrapEl.appendChild(chip);
                    }
                });
                featuresWrapEl.style.display = 'flex';
            } else {
                featuresWrapEl.style.display = 'none';
            }
        }

        if (primaryMediaEl) {
            if (meta.cover) {
                primaryMediaEl.innerHTML = `<img src="${meta.cover}" alt="${meta.name}" style="width:100%;height:100%;object-fit:cover;">`;
                primaryMediaEl.style.display = 'flex';
            } else {
                primaryMediaEl.innerHTML = '';
                primaryMediaEl.style.display = 'none';
            }
        }

        const actionText = meta.actionBtnText || "Let's Build";
        const actionUrl = meta.actionBtnUrl || '#cta';

        if (ctaActionBtn) {
            ctaActionBtn.setAttribute('href', actionUrl);
        }
        if (ctaLabelEl) {
            ctaLabelEl.textContent = actionText;
        }

        if (linksContainer) {
            linksContainer.innerHTML = `<a href="${actionUrl}" class="frame46-action-btn service-modal-header-cta"><i class="fa-solid fa-arrow-right text-[10px]"></i><span>${actionText}</span></a>`;
            const headerCta = linksContainer.querySelector('.service-modal-header-cta');
            if (headerCta) {
                headerCta.addEventListener('click', (e) => {
                    if (actionUrl === '#cta') {
                        e.preventDefault();
                        closeServiceModal();
                        const ctaSec = document.getElementById('cta');
                        if (ctaSec) {
                            ctaSec.scrollIntoView({ behavior: 'smooth' });
                        }
                    }
                });
            }
        }

        renderNotionBlocks(meta.blocks, meta.desc);

        modal.scrollTop = 0;
        modal.classList.remove('hidden');
        void modal.offsetWidth;
        modal.classList.add('is-active');
        modal.setAttribute('aria-hidden', 'false');

        document.body.classList.add('modal-open');
    }

    function closeServiceModal() {
        modal.classList.remove('is-active');
        modal.setAttribute('aria-hidden', 'true');
        document.body.classList.remove('modal-open');

        // Always clear selection state so the marquee animation resumes
        clearCarouselSelection();

        setTimeout(() => {
            if (!modal.classList.contains('is-active')) {
                modal.classList.add('hidden');
            }
        }, 250);
    }

    // Attach trigger to every service card in marquee
    document.querySelectorAll('.service-card-trigger').forEach(trigger => {
        trigger.addEventListener('click', e => {
            e.stopPropagation();
            const index = trigger.getAttribute('data-service-index');
            let meta = null;

            if (index !== null && servicesData && servicesData[index]) {
                const item = servicesData[index];
                meta = {
                    name: item.name,
                    tagline: item.tagline,
                    desc: item.description,
                    iconSvg: item.icon_svg,
                    cover: item.cover_image,
                    features: item.features,
                    blocks: item.body_content,
                    actionBtnText: item.action_btn_text,
                    actionBtnUrl: item.action_btn_url,
                    pathStr: item.path_str
                };
            } else {
                const iconEl = trigger.querySelector('.svc-icon');
                meta = {
                    name: trigger.getAttribute('data-service-name') || trigger.querySelector('.svc-card-name')?.textContent || 'SERVICE',
                    tagline: trigger.getAttribute('data-service-tagline') || 'Engineering Service',
                    desc: trigger.getAttribute('data-service-desc') || '',
                    iconSvg: iconEl ? iconEl.innerHTML : '',
                    cover: trigger.getAttribute('data-service-cover') || '',
                    features: [],
                    blocks: [],
                    actionBtnText: "Let's Build",
                    actionBtnUrl: '#cta',
                    pathStr: trigger.getAttribute('data-service-path') || 'ODDS_Studio/Services/Overview'
                };
            }

            openServiceModal(meta);
        });
    });

    if (closeBtn) {
        closeBtn.addEventListener('click', e => {
            e.stopPropagation();
            closeServiceModal();
        });
    }

    if (ctaActionBtn) {
        ctaActionBtn.addEventListener('click', (e) => {
            const href = ctaActionBtn.getAttribute('href');
            if (href === '#cta') {
                e.preventDefault();
                closeServiceModal();
                const ctaSec = document.getElementById('cta');
                if (ctaSec) {
                    ctaSec.scrollIntoView({ behavior: 'smooth' });
                }
            }
        });
    }

    modal.addEventListener('click', e => {
        if (modalCard && !modalCard.contains(e.target)) {
            closeServiceModal();
        }
    });

    window.addEventListener('keydown', e => {
        if (e.key === 'Escape' && modal.classList.contains('is-active')) {
            closeServiceModal();
        }
    });

    window.openServiceModal = openServiceModal;
    window.closeServiceModal = closeServiceModal;
})();

// ─── Why Bet on ODDS: Interactive 3D Playing Card Deck & Flip ───
(function initWhyDeckController() {
    const deckWrap = document.getElementById('why-deck-wrap');
    const deck = document.getElementById('why-deck');
    if (!deck) return;

    const cards = Array.from(deck.querySelectorAll('.why-card'));
    const segments = Array.from(document.querySelectorAll('.why-bar-segment'));
    const currentIdxEl = document.getElementById('why-current-idx');
    const prevBtn = document.getElementById('why-nav-prev');
    const nextBtn = document.getElementById('why-nav-next');
    const total = cards.length;

    if (total === 0) return;

    let activeIndex = 0;
    let isMobile = window.innerWidth <= 768;
    let isSwiping = false;
    let hasDragged = false;
    let startX = 0;
    let startY = 0;
    let currentX = 0;
    let currentY = 0;
    let deltaX = 0;
    let deltaY = 0;

    function isDeckMode() {
        return window.innerWidth <= 768;
    }

    // ── 3D Playing Card Flip Animation with GSAP ──
    function flipCard(card, targetState = null) {
        const inner = card.querySelector('.why-card-inner');
        if (!inner) return;

        const isCurrentlyFlipped = card.classList.contains('is-flipped');
        const willBeFlipped = targetState !== null ? targetState : !isCurrentlyFlipped;

        if (targetState !== null && willBeFlipped === isCurrentlyFlipped) return;

        if (willBeFlipped) {
            card.classList.add('is-flipped');
            card.setAttribute('aria-expanded', 'true');
        } else {
            card.classList.remove('is-flipped');
            card.setAttribute('aria-expanded', 'false');
        }

        gsap.killTweensOf(inner);

        // Realistic playing card flip: lifts towards user, spins 180deg, lands softly
        const tl = gsap.timeline();
        tl.to(inner, {
            z: 48,
            scale: 1.03,
            duration: 0.22,
            ease: 'power1.out'
        })
        .to(inner, {
            rotationY: willBeFlipped ? 180 : 0,
            duration: 0.58,
            ease: 'power2.inOut'
        }, '<')
        .to(inner, {
            z: 0,
            scale: 1,
            duration: 0.26,
            ease: 'power2.out'
        }, '-=0.18');
    }

    // ── Interactive Hover & Click Behaviors ──
    cards.forEach((card) => {
        const inner = card.querySelector('.why-card-inner');
        if (!inner) return;

        // Subtle 3D tilt following mouse on desktop
        card.addEventListener('mousemove', (e) => {
            if (isDeckMode()) return;
            const rect = card.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;
            const centerX = rect.width / 2;
            const centerY = rect.height / 2;

            const rotateX = ((y - centerY) / centerY) * -5;
            const rotateY = ((x - centerX) / centerX) * 5;

            gsap.to(card, {
                rotationX: rotateX,
                rotationY: rotateY,
                duration: 0.3,
                ease: 'power1.out',
                transformPerspective: 1000
            });
        });

        card.addEventListener('mouseleave', () => {
            if (isDeckMode()) return;
            gsap.to(card, {
                rotationX: 0,
                rotationY: 0,
                duration: 0.5,
                ease: 'power2.out'
            });
        });

        // Click to flip card
        card.addEventListener('click', (e) => {
            if (isDeckMode()) {
                if (hasDragged) return;
                if (card.classList.contains('is-active')) {
                    flipCard(card);
                } else if (card.classList.contains('is-next')) {
                    goNext();
                }
                return;
            }
            flipCard(card);
        });

        // Keyboard accessibility
        card.addEventListener('keydown', (e) => {
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                flipCard(card);
            }
        });
    });

    // ─── ScrollTrigger 4-Frame Playing Card Deal & Horizontal Transition to Process ───
    let dealScrollTrigger = null;
    let pathLength = 3600;
    let horizLen = 1200;
    let yToLengthTable = [];
    const SAMPLES_COUNT = 300;

    const PATH_TAIL_D = "L 380 24 C 450 24 472 42 467.332 65.742 C 454.431 127.953 404.689 176.83 342.376 182.085 L 114.38 201.314 C 89.7562 203.391 66.5806 213.818 48.6935 230.868 C -13.312 289.973 14.502 394.256 97.7059 414.631 L 505.918 514.595 C 512.476 516.201 518.697 518.955 524.295 522.729 C 573.667 556.018 545.675 633.188 486.442 627.082 L 127.407 590.071 C 108.352 588.107 89.2368 593.184 73.668 604.345 C 11.7091 648.76 43.1302 746.523 119.364 746.523 H 150.72 C 201.364 746.523 241.681 788.937 239.117 839.515 L 234.832 924.023";

    function calibratePathStartX() {
        const path = document.getElementById('process-line-path');
        const wrapEl = document.querySelector('.process-linepath-wrap');
        const card2 = cards[2] || cards[cards.length - 1];
        if (!path) return { startX: -1200, horizLen: 1580, pathLength: 4000 };

        const winWidth = window.innerWidth;
        const isMobile = window.innerWidth <= 768;

        if (isMobile) {
            path.setAttribute('d', `M 467.332 1.52271 ${PATH_TAIL_D}`);
            try {
                pathLength = path.getTotalLength() || 2800;
            } catch (e) {
                pathLength = 2800;
            }
            horizLen = 0;
            path.style.strokeDasharray = `${pathLength} ${pathLength}`;
            return { startX: 467, horizLen: 0, pathLength };
        }

        const wrapWidth = wrapEl ? wrapEl.offsetWidth : Math.min(1100, winWidth);
        let startX = -300;

        const gapVw = 0.6; // 60vw transition space between Why and Process
        const gapPx = winWidth * gapVw;

        if (card2 && wrapEl) {
            // Calculate Card 2 right edge relative to wrapEl left edge in track space:
            // Deck is centered in Why (100vw). 3 cards with width 385px and gap 20px span 1195px.
            // Half-deck width = 597.5px.
            // Card 2 right edge is at: 50vw + 597.5px in Why space.
            // wrapEl is centered in Process (which is at (100vw + gapPx) .. (200vw + gapPx)):
            // wrapEl left edge is at: 100vw + gapPx + (100vw - wrapWidth) / 2 = 150vw + gapPx - (wrapWidth / 2).
            // Distance from wrapEl left to Card 2 right edge:
            // deltaPx = (50vw + 597.5) - (150vw + gapPx - wrapWidth / 2) = 597.5 + (wrapWidth / 2) - winWidth - gapPx
            const deckHalf = 597.5;
            const deltaPx = deckHalf + (wrapWidth / 2) - winWidth - gapPx + 16; // 16px right of Card 2
            startX = Math.round((deltaPx / wrapWidth) * 565);
        } else {
            const distancePx = winWidth + gapPx + Math.max(0, (winWidth - wrapWidth) / 2);
            startX = Math.round((-distancePx / wrapWidth) * 565 + 24);
        }

        path.setAttribute('d', `M ${startX} 24 ${PATH_TAIL_D}`);

        try {
            pathLength = path.getTotalLength() || 4000;
        } catch (e) {
            pathLength = 4000;
        }

        horizLen = Math.max(10, 380 - startX);
        path.style.strokeDasharray = `${pathLength} ${pathLength}`;

        return { startX, horizLen, pathLength };
    }

    function buildSampleTable() {
        const path = document.getElementById('process-line-path');
        if (!path) return;

        yToLengthTable = [];
        let maxY = -Infinity;
        const verticalLength = Math.max(10, pathLength - horizLen);

        for (let i = 0; i <= SAMPLES_COUNT; i++) {
            const len = horizLen + (i / SAMPLES_COUNT) * verticalLength;
            try {
                const pt = path.getPointAtLength(len);
                if (pt.y > maxY) maxY = pt.y;
                yToLengthTable.push({ len, y: pt.y, maxSoFar: maxY });
            } catch (e) {}
        }
    }

    function getVerticalLengthForY(targetSvgY) {
        const verticalLen = pathLength - horizLen;
        if (!yToLengthTable.length) return 0;
        if (targetSvgY <= 24) return 0;
        if (targetSvgY >= 925) return verticalLen;

        let bestLen = 0;
        for (let i = 0; i < yToLengthTable.length; i++) {
            if (yToLengthTable[i].y <= targetSvgY) {
                bestLen = yToLengthTable[i].len - horizLen;
            }
        }
        return Math.max(0, Math.min(verticalLen, bestLen));
    }

    function initCardDealScrollTrigger() {
        if (dealScrollTrigger) {
            dealScrollTrigger.kill();
            dealScrollTrigger = null;
        }

        const wrapper = document.getElementById('why-process-wrapper') || document.getElementById('why');
        const track = document.getElementById('why-process-track');
        const whyMain = document.getElementById('why-main-stage');
        const path = document.getElementById('process-line-path');

        if (isDeckMode() || cards.length < 3) {
            cards.forEach(card => {
                gsap.set(card, { clearProps: 'x,rotation' });
            });
            if (track) gsap.set(track, { clearProps: 'x,transform' });
            if (whyMain) gsap.set(whyMain, { clearProps: 'all' });
            calibratePathStartX();
            buildSampleTable();
            return;
        }

        if (!wrapper) return;

        const card0 = cards[0];
        const card1 = cards[1];
        const card2 = cards[2];

        const dist = card1.offsetLeft - card0.offsetLeft || 405;
        const card0Rect = card0.getBoundingClientRect();
        const entryOffset = -(card0Rect.right + 250);

        // Frame 1: All 3 cards start stacked off-screen left
        gsap.set(card0, { x: entryOffset, rotation: -6 });
        gsap.set(card1, { x: entryOffset - dist, rotation: -4 });
        gsap.set(card2, { x: entryOffset - (dist * 2), rotation: -2 });

        if (track) gsap.set(track, { x: 0 });
        if (whyMain) gsap.set(whyMain, { x: 0, y: 0, opacity: 1, scale: 1 });

        const res = calibratePathStartX();
        buildSampleTable();

        if (path) {
            gsap.set(path, { opacity: 0 });
            path.style.strokeDashoffset = res.pathLength;
        }

        const dealTL = gsap.timeline({
            scrollTrigger: {
                trigger: wrapper,
                start: 'top top',
                end: '+=2800',
                pin: true,
                scrub: 0.8,
                anticipatePin: 1,
                invalidateOnRefresh: true,
                onRefresh: () => {
                    calibratePathStartX();
                    buildSampleTable();
                }
            }
        });

        dealScrollTrigger = dealTL.scrollTrigger;

        // ── STAGE 1 (0% to 25% progress): Slide entire stacked deck in from left to Column 0 ──
        dealTL
            .to(card0, { x: 0, rotation: -4, ease: 'power1.inOut', duration: 1 })
            .to(card1, { x: -dist, rotation: -2, ease: 'power1.inOut', duration: 1 }, '<')
            .to(card2, { x: -(dist * 2), rotation: 0, ease: 'power1.inOut', duration: 1 }, '<');

        // Short pause while stacked at Column 0
        dealTL.to({}, { duration: 0.2 });

        // ── STAGE 2 (25% to 45% progress): Deal cards across into Columns 1 & 2 ──
        dealTL
            .to(card0, { rotation: 0, ease: 'power2.out', duration: 0.8 })
            .to(card1, { x: 0, rotation: 0, ease: 'power2.out', duration: 1.1 }, '<')
            .to(card2, { x: 0, rotation: 0, ease: 'power2.out', duration: 1.4 }, '<+=0.12');

        // ── STAGE 3 (45% to 55% progress): Rest Window for cards exploration ──
        dealTL.to({}, { duration: 0.5 });

        // ── STAGE 4 (55% to 95% progress): Why section slides smoothly to the left, through the 60vw space into Process ──
        if (track) {
            dealTL.to(track, {
                x: '-160vw',
                ease: 'power1.inOut',
                duration: 2.2
            });
        }

        if (path) {
            // Path illuminates right next to Card 2 at the start of the slide and draws across into Process
            dealTL.to(path, {
                opacity: 1,
                duration: 0.08,
                ease: 'none'
            }, '<')
            .to(path, {
                strokeDashoffset: () => pathLength - horizLen,
                ease: 'power1.inOut',
                duration: 2.2
            }, '<');
        }

        // Short buffer before unpinning cleanly into Process section
        dealTL.to({}, { duration: 0.2 });
    }

    initCardDealScrollTrigger();

    window.__getDealScrollTrigger = () => dealScrollTrigger;
    window.__getPathMetrics = () => ({ pathLength, horizLen, getVerticalLengthForY });

    function updateStack(animate = true) {
        if (!isDeckMode()) {
            // Reset deck state on desktop (preserves ScrollTrigger)
            cards.forEach(card => {
                card.classList.remove('is-active', 'is-next', 'is-back', 'is-hidden');
            });
            return;
        }

        cards.forEach((card, i) => {
            const offset = (i - activeIndex + total) % total;

            card.classList.remove('is-active', 'is-next', 'is-back', 'is-hidden');

            let targetX = 0;
            let targetY = 0;
            let targetScale = 1;
            let targetRot = 0;
            let targetOpacity = 1;
            let zIndex = 10;
            let pointerEvents = 'auto';

            if (offset === 0) {
                // Front Active Card
                targetX = 0;
                targetY = 0;
                targetScale = 1;
                targetRot = 0;
                targetOpacity = 1;
                zIndex = 10;
                pointerEvents = 'auto';
                card.classList.add('is-active');
            } else if (offset === 1) {
                // Second Card - Peek behind
                targetX = 0;
                targetY = 12;
                targetScale = 0.94;
                targetRot = 0;
                targetOpacity = 0.72;
                zIndex = 8;
                pointerEvents = 'auto';
                card.classList.add('is-next');
            } else if (offset === 2) {
                // Third Card - Deeper back
                targetX = 0;
                targetY = 24;
                targetScale = 0.88;
                targetRot = 0;
                targetOpacity = 0.38;
                zIndex = 6;
                pointerEvents = 'none';
                card.classList.add('is-back');
            } else {
                // Any extra cards (if > 3)
                targetX = 0;
                targetY = 32;
                targetScale = 0.82;
                targetRot = 0;
                targetOpacity = 0;
                zIndex = 1;
                pointerEvents = 'none';
                card.classList.add('is-hidden');
            }

            card.style.zIndex = zIndex;
            card.style.pointerEvents = pointerEvents;

            if (animate) {
                gsap.to(card, {
                    x: targetX,
                    y: targetY,
                    scale: targetScale,
                    rotation: targetRot,
                    opacity: targetOpacity,
                    duration: 0.42,
                    ease: 'power2.out',
                    overwrite: 'auto'
                });
            } else {
                gsap.set(card, {
                    x: targetX,
                    y: targetY,
                    scale: targetScale,
                    rotation: targetRot,
                    opacity: targetOpacity
                });
            }
        });

        // Update Progress Segments
        segments.forEach((seg, idx) => {
            seg.classList.toggle('active', idx === activeIndex);
        });

        // Update Index Counter
        if (currentIdxEl) {
            currentIdxEl.textContent = String(activeIndex + 1).padStart(2, '0');
        }
    }

    function goToIndex(idx) {
        if (idx === activeIndex || idx < 0 || idx >= total) return;
        activeIndex = idx;
        updateStack(true);
    }

    function goNext() {
        activeIndex = (activeIndex + 1) % total;
        updateStack(true);
    }

    function goPrev() {
        activeIndex = (activeIndex - 1 + total) % total;
        updateStack(true);
    }

    // Arrow controls
    if (prevBtn) prevBtn.addEventListener('click', goPrev);
    if (nextBtn) nextBtn.addEventListener('click', goNext);

    // Touch and Gesture Drag Physics
    deck.addEventListener('touchstart', (e) => {
        if (!isDeckMode() || e.touches.length > 1) return;
        const touch = e.touches[0];
        startX = touch.clientX;
        startY = touch.clientY;
        currentX = startX;
        currentY = startY;
        deltaX = 0;
        deltaY = 0;
        isSwiping = false;
        hasDragged = false;
    }, { passive: true });

    deck.addEventListener('touchmove', (e) => {
        if (!isDeckMode() || e.touches.length > 1) return;
        const touch = e.touches[0];
        currentX = touch.clientX;
        currentY = touch.clientY;
        deltaX = currentX - startX;
        deltaY = currentY - startY;

        const absX = Math.abs(deltaX);
        const absY = Math.abs(deltaY);

        if (!isSwiping && absX > 8 && absX > absY) {
            isSwiping = true;
            hasDragged = true;
            window.whyIsDragging = true;
        }

        if (isSwiping) {
            const activeCard = cards[activeIndex];
            const nextIdx = (activeIndex + 1) % total;
            const nextCard = cards[nextIdx];

            if (activeCard) {
                const rot = (deltaX / 220) * 12;
                gsap.set(activeCard, {
                    x: deltaX,
                    y: Math.abs(deltaX) * 0.05,
                    rotation: rot,
                    scale: 1,
                    opacity: Math.max(0.65, 1 - absX / 500)
                });
            }

            if (nextCard) {
                const peekRatio = Math.min(1, absX / 160);
                gsap.set(nextCard, {
                    y: 12 - (peekRatio * 12),
                    scale: 0.94 + (peekRatio * 0.06),
                    opacity: 0.72 + (peekRatio * 0.28)
                });
            }
        }
    }, { passive: true });

    deck.addEventListener('touchend', () => {
        if (!isDeckMode()) return;
        window.whyIsDragging = false;

        if (isSwiping) {
            const absX = Math.abs(deltaX);
            const activeCard = cards[activeIndex];

            if (absX > 65) {
                // Significant swipe: fling active card away and advance
                const isForward = deltaX < 0;
                const flingX = isForward ? -320 : 320;
                const flingRot = isForward ? -16 : 16;

                if (activeCard) {
                    gsap.to(activeCard, {
                        x: flingX,
                        rotation: flingRot,
                        opacity: 0,
                        duration: 0.24,
                        ease: 'power2.in',
                        onComplete() {
                            if (isForward) {
                                activeIndex = (activeIndex + 1) % total;
                            } else {
                                activeIndex = (activeIndex - 1 + total) % total;
                            }
                            updateStack(true);
                        }
                    });
                } else {
                    if (isForward) goNext(); else goPrev();
                }
            } else {
                // Snap back to neutral
                updateStack(true);
            }
        }
        isSwiping = false;
        setTimeout(() => { hasDragged = false; }, 60);
        deltaX = 0;
        deltaY = 0;
    }, { passive: true });

    // Handle viewport resize smoothly
    let resizeTimer = null;
    window.addEventListener('resize', () => {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(() => {
            const nowMobile = isDeckMode();
            if (nowMobile !== isMobile) {
                isMobile = nowMobile;
            }
            updateStack(false);
            initCardDealScrollTrigger();
        }, 150);
    });

    // Keyboard navigation when Why section is in view
    window.addEventListener('keydown', (e) => {
        if (document.body.classList.contains('modal-open')) return;
        const whySec = document.getElementById('why');
        if (whySec) {
            const rect = whySec.getBoundingClientRect();
            const isInView = rect.top < window.innerHeight * 0.75 && rect.bottom > window.innerHeight * 0.25;
            if (isInView) {
                if (e.key === 'ArrowLeft') {
                    goPrev();
                } else if (e.key === 'ArrowRight') {
                    goNext();
                }
            }
        }
    });

    // Initialize initial view
    updateStack(false);
})();


// ─── FAQ Accordion Controller ───────────────────────────
(function initFaqAccordion() {
    const accordion = document.getElementById('faq-accordion');
    if (!accordion) return;

    const items = Array.from(accordion.querySelectorAll('.faq-item'));

    function closeItem(item) {
        item.classList.remove('is-open');
        const btn = item.querySelector('.faq-question-btn');
        const collapse = item.querySelector('.faq-answer-collapse');
        if (btn) btn.setAttribute('aria-expanded', 'false');
        if (collapse) collapse.style.maxHeight = null;
    }

    function openItem(item) {
        item.classList.add('is-open');
        const btn = item.querySelector('.faq-question-btn');
        const collapse = item.querySelector('.faq-answer-collapse');
        if (btn) btn.setAttribute('aria-expanded', 'true');
        if (collapse) {
            collapse.style.maxHeight = collapse.scrollHeight + 'px';
        }
    }

    items.forEach((item) => {
        const btn = item.querySelector('.faq-question-btn');
        if (!btn) return;

        btn.addEventListener('click', (e) => {
            e.preventDefault();
            const isOpen = item.classList.contains('is-open');

            // Close all other items for a clean single-open accordion feel
            items.forEach((other) => {
                if (other !== item) closeItem(other);
            });

            // Toggle current item
            if (isOpen) {
                closeItem(item);
            } else {
                openItem(item);
            }
        });
    });

    window.addEventListener('resize', () => {
        const openItemEl = accordion.querySelector('.faq-item.is-open');
        if (openItemEl) {
            const collapse = openItemEl.querySelector('.faq-answer-collapse');
            if (collapse) collapse.style.maxHeight = collapse.scrollHeight + 'px';
        }
    });
})();


// ─── Process Section Line Path Scroll Trail ─────────────
(function initProcessLineTrail() {
    const path = document.getElementById('process-line-path');
    const svgWrap = document.querySelector('.process-linepath-wrap');
    if (!path || !svgWrap) return;

    let targetLengthToDraw = 0;
    let currentLengthToDraw = 0;

    function calcTargetProgress() {
        const feed = document.querySelector('.process-editorial-feed') || svgWrap;
        const processSec = document.getElementById('process') || svgWrap;
        const feedRect = feed.getBoundingClientRect();
        const processRect = processSec.getBoundingClientRect();
        const winHeight = window.innerHeight;

        // The user's active focal viewing eye line in the viewport
        const eyeLineY = winHeight * 0.5;

        // The process section starts at processRect.top and finishes when Phase 03 is in view
        const processStart = processRect.top + (winHeight * 0.2);
        const feedEnd = feedRect.bottom - (winHeight * 0.35);
        const totalDist = Math.max(1, feedEnd - processStart);

        // Progress from 0.0 (entering Process) to 1.0 (Phase 3)
        const scrollProgress = Math.max(0, Math.min(1, (eyeLineY - processStart) / totalDist));
        const targetSvgY = 24 + scrollProgress * (925 - 24);

        const dealST = window.__getDealScrollTrigger ? window.__getDealScrollTrigger() : null;
        const metrics = window.__getPathMetrics ? window.__getPathMetrics() : { pathLength: 3600, horizLen: 1200, getVerticalLengthForY: () => 0 };
        const { pathLength, horizLen, getVerticalLengthForY } = metrics;

        if (dealST && dealST.isActive) {
            // GSAP dealTL is actively scrubbing during Why pin
            const curOffset = parseFloat(path.style.strokeDashoffset);
            if (!isNaN(curOffset)) {
                currentLengthToDraw = pathLength - curOffset;
            }
            return;
        }

        if (dealST && dealST.progress >= 1) {
            // Pinned transition completed -> user scrolling down through Process
            path.style.opacity = '1';
            const extra = getVerticalLengthForY(targetSvgY);
            targetLengthToDraw = horizLen + extra;
        } else if (dealST && dealST.progress <= 0) {
            // Above Why section
            path.style.opacity = '0';
            targetLengthToDraw = 0;
        } else if (!dealST) {
            // Mobile or deck mode fallback
            path.style.opacity = '1';
            targetLengthToDraw = horizLen + getVerticalLengthForY(targetSvgY);
        }
    }

    function loop() {
        calcTargetProgress();

        const dealST = window.__getDealScrollTrigger ? window.__getDealScrollTrigger() : null;
        const metrics = window.__getPathMetrics ? window.__getPathMetrics() : { pathLength: 3600 };
        const pathLen = metrics.pathLength || 3600;

        if (!dealST || !dealST.isActive) {
            currentLengthToDraw += (targetLengthToDraw - currentLengthToDraw) * 0.15;
            if (Math.abs(targetLengthToDraw - currentLengthToDraw) < 0.5) {
                currentLengthToDraw = targetLengthToDraw;
            }
            const offset = Math.max(0, Math.min(pathLen, pathLen - currentLengthToDraw));
            path.style.strokeDashoffset = offset;
        }

        requestAnimationFrame(loop);
    }

    window.addEventListener('scroll', calcTargetProgress, { passive: true });
    window.addEventListener('resize', calcTargetProgress);

    if (typeof ScrollTrigger !== 'undefined') {
        ScrollTrigger.addEventListener('refresh', calcTargetProgress);
    }

    requestAnimationFrame(loop);
})();


// ═══════════════════════════════════════════════════════
//  SITE-WIDE TEXT ANIMATION SYSTEM (OFFICIAL GSAP PLUGINS)
//  Rule 1: Heading Reveal (SplitText, word-level stagger)
//  Rule 2: Reserved Scramble Effect (ScrambleTextPlugin)
//  Rule 3: Single Draw-In Highlight Per Page (DrawSVGPlugin)
// ═══════════════════════════════════════════════════════

// ─── Rule 1: Site-Wide Heading Reveal ──────────────────
function initHeadingReveals() {
    // 1. Hero Headline (Special Case: Plays on load rather than scroll)
    const heroH1 = document.getElementById('hero-h1');
    if (heroH1) {
        if (prefersReducedMotion) {
            gsap.set(heroH1, { opacity: 1, y: 0 });
        } else {
            const heroSplit = new SplitText(heroH1, { type: 'words', wordsClass: 'split-word' });
            gsap.fromTo(heroSplit.words,
                { opacity: 0, y: 18 },
                {
                    opacity: 1,
                    y: 0,
                    duration: 0.52,
                    ease: 'power3.out',
                    stagger: 0.05,
                    delay: 0.1
                }
            );
        }
    }

    // 2. All Major Section Headings Across The Site
    const headingSelectors = [
        '.services-title',
        '.why-title',
        '.works-heading',
        '.testi-title',
        '.process-title',
        '.faq-title',
        '.cta-title',
        '.about-massive-headline',
        '.our-work-closing-title'
    ];

    const headings = document.querySelectorAll(headingSelectors.join(', '));
    headings.forEach(heading => {
        // Skip hero headline if selected
        if (heading.id === 'hero-h1' || heading.classList.contains('hero-title')) return;

        if (prefersReducedMotion) {
            gsap.set(heading, { opacity: 1, y: 0 });
            return;
        }

        const split = new SplitText(heading, { type: 'words', wordsClass: 'split-word' });

        gsap.fromTo(split.words,
            { opacity: 0, y: 20 },
            {
                opacity: 1,
                y: 0,
                duration: 0.52,
                ease: 'power3.out',
                stagger: 0.045,
                scrollTrigger: {
                    trigger: heading,
                    start: 'top 85%',
                    once: true
                }
            }
        );
    });
}

// ─── Rule 2: Reserved Scramble Effect for Metrics ONLY ───
function initScrambleCounters() {
    const statsRows = document.querySelectorAll('#stats-row, .works-stats-row');
    statsRows.forEach(row => {
        let statsFired = false;
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting && !statsFired) {
                    statsFired = true;
                    const statEls = row.querySelectorAll('[data-target]');
                    statEls.forEach((el, i) => {
                        const rawTarget = el.dataset.target ?? '0';
                        const suffix = el.dataset.suffix ?? '';
                        const isFloat = rawTarget.includes('.');
                        const targetFormatted = (isFloat ? parseFloat(rawTarget).toFixed(1) : rawTarget) + suffix;

                        if (prefersReducedMotion) {
                            el.textContent = targetFormatted;
                            return;
                        }

                        gsap.to(el, {
                            duration: 1.15,
                            scrambleText: {
                                text: targetFormatted,
                                chars: '0123456789!#$*+-~',
                                speed: 0.45,
                                revealDelay: 0.12 + (i * 0.08)
                            },
                            ease: 'power2.out'
                        });
                    });
                }
            });
        }, { threshold: 0.2 });
        observer.observe(row);
    });
}

// ─── Rule 3: Single Draw-In Highlight Per Page ─────────
function initDrawHighlights() {
    const paths = document.querySelectorAll('.draw-highlight-svg path');
    paths.forEach(path => {
        if (prefersReducedMotion) {
            gsap.set(path, { drawSVG: '100%' });
            return;
        }

        gsap.set(path, { drawSVG: '0%' });
        gsap.to(path, {
            drawSVG: '100%',
            duration: 0.95,
            ease: 'power2.out',
            scrollTrigger: {
                trigger: path.closest('.draw-highlight-wrap') || path,
                start: 'top 85%',
                once: true
            }
        });
    });
}

// ─── Initialize Site-Wide Animations ───────────────────
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', () => {
        initHeadingReveals();
        initScrambleCounters();
        initDrawHighlights();
    });
} else {
    initHeadingReveals();
    initScrambleCounters();
    initDrawHighlights();
}





