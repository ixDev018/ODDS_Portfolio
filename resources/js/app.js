import './bootstrap';
import { gsap } from 'gsap';

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
//// ─── Hero entrance ───────────────────────────────────
gsap.timeline({ defaults: { ease: 'power3.out', duration: 0.9 } })
    .to('#hero-h1', { opacity: 1, y: 0, delay: 0.2 })
    .to('#hero-p', { opacity: 1, y: 0 }, '-=0.55')
    .to('#hero-btn', { opacity: 1, y: 0 }, '-=0.5');

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
        services: { bg: 'rgba(143,60,111,0.65)', border: 'rgba(255,255,255,0.08)', light: false },
        works: { bg: 'rgba(227,227,227,0.65)', border: 'rgba(0,0,0,0.06)', light: true },
        testimonials: { bg: 'rgba(243,89,176,0.65)', border: 'rgba(255,255,255,0.08)', light: false },
        why: { bg: 'rgba(239,239,239,0.65)', border: 'rgba(0,0,0,0.06)', light: true },
        cta: { bg: 'rgba(0,0,0,0.65)', border: 'rgba(255,255,255,0.08)', light: false },
    };

    let currentMode = 'hero'; // 'hero' | 'services'
    let isTransitioning = false;

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
            '.cta-terminal', '.cta-title', '.cta-desc', '.cta-btn', '.cta-visual'
        ];
        const els = sec.querySelectorAll(selectors.join(', '));
        if (els.length > 0) return Array.from(els);
        const inner = sec.querySelector('.sec-inner, .hero-content, .works-content-wrap, .cta-outer') || sec;
        return Array.from(inner.children);
    }

    // Initialize: Hero is active at top
    document.body.classList.add('hero-active');
    gsap.set(secHero, {
        position: 'absolute',
        top: 0,
        left: 0,
        width: '100%',
        zIndex: 10,
        visibility: 'visible',
        opacity: 1,
        pointerEvents: 'auto'
    });
    gsap.set(secServices, {
        position: 'relative',
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
        const fromSec = secHero;
        const toSec = secServices;
        const fromEls = getSectionElements(fromSec);
        const toEls = getSectionElements(toSec);

        blades.forEach(blade => {
            const surf = blade.querySelector('.cyber-blade-surface');
            if (surf) surf.style.background = 'rgba(14, 14, 14, 0.85)';
        });
        if (overlay) gsap.set(overlay, { visibility: 'visible', opacity: 1, zIndex: 99 });

        gsap.set(fromSec, { visibility: 'visible', opacity: 1, scale: 1, zIndex: 10, pointerEvents: 'none' });
        gsap.set(toSec, { visibility: 'visible', opacity: 0, scale: 1.03, y: 0, zIndex: 20, pointerEvents: 'none' });
        gsap.set(toEls, { opacity: 0, y: 35, skewX: -5 });
        gsap.set(blades, { x: '0%', opacity: 1, skewX: 0 });
        if (rgbCyan) gsap.set(rgbCyan, { opacity: 0, x: -18 });
        if (rgbPink) gsap.set(rgbPink, { opacity: 0, x: 18 });
        if (scanlines) gsap.set(scanlines, { opacity: 0 });

        const tl = gsap.timeline({
            onComplete() {
                currentMode = 'services';
                document.body.classList.remove('hero-active');

                gsap.set(fromSec, { visibility: 'hidden', opacity: 0, zIndex: 0, scale: 1, pointerEvents: 'none' });
                gsap.set(fromEls, { clearProps: 'transform,opacity,scale,skewX,x,y' });

                if (overlay) gsap.set(overlay, { visibility: 'hidden', opacity: 0, zIndex: 0 });
                gsap.set(blades, { clearProps: 'transform,opacity,skewX,x,y' });
                if (rgbCyan) gsap.set(rgbCyan, { opacity: 0 });
                if (rgbPink) gsap.set(rgbPink, { opacity: 0 });
                if (scanlines) gsap.set(scanlines, { opacity: 0 });

                gsap.set(toSec, { zIndex: 5, opacity: 1, scale: 1, pointerEvents: 'auto' });
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
    function transitionToHero() {
        if (isTransitioning || currentMode === 'hero') return;
        const scrollY = window.scrollY || window.pageYOffset || 0;
        if (scrollY > 10) {
            window.scrollTo({ top: 0, behavior: 'smooth' });
            return;
        }

        isTransitioning = true;
        const fromSec = secServices;
        const toSec = secHero;
        const fromEls = getSectionElements(fromSec);
        const toEls = getSectionElements(toSec);

        blades.forEach(blade => {
            const surf = blade.querySelector('.cyber-blade-surface');
            if (surf) surf.style.background = 'rgba(143, 60, 111, 0.88)';
        });
        if (overlay) gsap.set(overlay, { visibility: 'visible', opacity: 1, zIndex: 99 });

        gsap.set(fromSec, { visibility: 'visible', opacity: 1, scale: 1, zIndex: 10, pointerEvents: 'none' });
        gsap.set(toSec, { visibility: 'visible', opacity: 0, scale: 1.03, y: 0, zIndex: 20, pointerEvents: 'none' });
        gsap.set(toEls, { opacity: 0, y: -35, skewX: 5 });
        gsap.set(blades, { x: '0%', opacity: 1, skewX: 0 });
        if (rgbCyan) gsap.set(rgbCyan, { opacity: 0, x: 18 });
        if (rgbPink) gsap.set(rgbPink, { opacity: 0, x: -18 });
        if (scanlines) gsap.set(scanlines, { opacity: 0 });

        const tl = gsap.timeline({
            onComplete() {
                currentMode = 'hero';
                document.body.classList.add('hero-active');

                gsap.set(fromSec, { visibility: 'hidden', opacity: 0, zIndex: 0, scale: 1, pointerEvents: 'none' });
                gsap.set(fromEls, { clearProps: 'transform,opacity,scale,skewX,x,y' });

                if (overlay) gsap.set(overlay, { visibility: 'hidden', opacity: 0, zIndex: 0 });
                gsap.set(blades, { clearProps: 'transform,opacity,skewX,x,y' });
                if (rgbCyan) gsap.set(rgbCyan, { opacity: 0 });
                if (rgbPink) gsap.set(rgbPink, { opacity: 0 });
                if (scanlines) gsap.set(scanlines, { opacity: 0 });

                gsap.set(toSec, { zIndex: 10, opacity: 1, scale: 1, pointerEvents: 'auto' });
                gsap.set(toEls, { clearProps: 'transform,opacity,scale,skewX,x,y' });

                applyNavTheme('hero');
                setTimeout(() => { isTransitioning = false; }, 80);
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
        if (document.body.classList.contains('modal-open') || isTransitioning) return;

        if (currentMode === 'hero') {
            if (e.deltaY > 12) {
                e.preventDefault();
                transitionToServices();
            } else if (e.deltaY < 0) {
                e.preventDefault();
            }
            return;
        }

        if (currentMode === 'services') {
            const scrollY = window.scrollY || window.pageYOffset || 0;
            if (scrollY <= 5 && e.deltaY < -20) {
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
            if (scrollY <= 5 && dy < -35) {
                transitionToHero();
            }
        }
    }, { passive: true });

    // ── Keyboard Navigation ────────────────────────────
    window.addEventListener('keydown', e => {
        if (document.body.classList.contains('modal-open') || isTransitioning) {
            if (e.key === 'Escape' && window.closeProjectModal) window.closeProjectModal();
            return;
        }

        if (currentMode === 'hero') {
            if (e.key === 'ArrowDown' || e.key === 'PageDown' || (e.key === ' ' && !e.shiftKey)) {
                e.preventDefault();
                transitionToServices();
            }
            return;
        }

        if (currentMode === 'services') {
            const scrollY = window.scrollY || window.pageYOffset || 0;
            if (scrollY <= 5 && (e.key === 'ArrowUp' || e.key === 'PageUp')) {
                e.preventDefault();
                transitionToHero();
            }
        }
    });

    // ── Anchor Link Smooth Navigation ──────────────────
    document.querySelectorAll('a[href^="#"]').forEach(link => {
        link.addEventListener('click', e => {
            const hash = link.getAttribute('href').replace('#', '');
            if (!hash) return;

            e.preventDefault();

            if (hash === 'hero') {
                if (currentMode === 'services') {
                    window.scrollTo({ top: 0, behavior: 'smooth' });
                    setTimeout(() => transitionToHero(), 300);
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
                        }, 50);
                    });
                } else {
                    targetEl.scrollIntoView({ behavior: 'smooth' });
                }
            }
        });
    });

    // ── Stats Row Observer for Works Section ───────────
    const statsRow = document.getElementById('stats-row');
    if (statsRow && secWorks) {
        let statsFired = false;
        const statsObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting && !statsFired) {
                    statsFired = true;
                    secWorks.querySelectorAll('[data-target]').forEach(el => {
                        const rawTarget = el.dataset.target ?? '0';
                        const targetVal = parseFloat(rawTarget) || 0;
                        const isFloat = rawTarget.includes('.');
                        const suffix = el.dataset.suffix ?? '';
                        const obj = { val: 0 };
                        gsap.to(obj, {
                            val: targetVal, duration: 1.4, ease: 'power2.out', delay: 0.15,
                            onUpdate() { el.textContent = (isFloat ? obj.val.toFixed(1) : Math.round(obj.val)) + suffix; }
                        });
                    });
                }
            });
        }, { threshold: 0.2 });
        statsObserver.observe(statsRow);
    }

    // ── Navbar Dynamic Theme on Scroll ─────────────────
    const observedSections = [
        { id: 'services', key: 'services' },
        { id: 'works', key: 'works' },
        { id: 'testimonials', key: 'testimonials' },
        { id: 'why', key: 'why' },
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
        } catch(e) {
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
            } catch(e) {
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


// ─── Why Bet on ODDS: Interactive 3D Card Deck ─────────────────
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
    let startX = 0;
    let startY = 0;
    let currentX = 0;
    let currentY = 0;
    let deltaX = 0;
    let deltaY = 0;

    function isDeckMode() {
        return window.innerWidth <= 768;
    }

    function updateStack(animate = true) {
        if (!isDeckMode()) {
            // Reset to pure CSS grid on desktop
            cards.forEach(card => {
                gsap.killTweensOf(card);
                gsap.set(card, {
                    clearProps: 'transform,opacity,zIndex,pointerEvents,visibility',
                });
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

    // Clicking peeking card brings it to front
    cards.forEach((card) => {
        card.addEventListener('click', () => {
            if (!isDeckMode()) return;
            if (card.classList.contains('is-next')) {
                goNext();
            }
        });
    });

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


