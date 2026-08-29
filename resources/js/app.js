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

    const overlay = document.getElementById('fp-overlay');
    const cols = overlay ? Array.from(overlay.querySelectorAll('.fp-col')) : [];
    const sections = Array.from(container.querySelectorAll('.fp-section'));
    const n = sections.length;
    if (!n || !cols.length) return;

    const secWorks = document.getElementById('works');
    const secWhy = document.getElementById('why');

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
        { bg: 'rgba(14,14,14,0.65)', border: 'rgba(255,255,255,0.08)', light: false },
        { bg: 'rgba(135,90,245,0.65)', border: 'rgba(255,255,255,0.08)', light: false },
        { bg: 'rgba(227,227,227,0.65)', border: 'rgba(0,0,0,0.06)', light: true },
        { bg: 'rgba(243,89,176,0.65)', border: 'rgba(255,255,255,0.08)', light: false },
        { bg: 'rgba(239,239,239,0.65)', border: 'rgba(0,0,0,0.06)', light: true },
        { bg: 'rgba(0,0,0,0.65)', border: 'rgba(255,255,255,0.08)', light: false },
    ];

    let current = 0;
    let target = null;

    // Active scrubbing state
    let activeTimeline = null;
    let fromElsCache = [];
    let toElsCache = [];
    let stateObj = { progress: 0 };
    let targetProgress = 0;
    let snapTimer = null;
    let isSnapping = false;
    let isNavJumping = false;
    let lastScrollDir = 1; // 1 for down/next, -1 for up/prev

    // Helper to query key visual content elements in a section for element-level transitions
    function getSectionElements(sec) {
        if (!sec) return [];
        const selectors = [
            '.hero-title', '.hero-subtitle', '.btn-hero',
            '.sec-label', '.services-title', '.svc-card', '.services-desc', '.btn-dark',
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

    // Initialize — only hero visible
    sections.forEach((sec, i) => {
        gsap.set(sec, {
            zIndex: i === 0 ? 10 : 0,
            visibility: i === 0 ? 'visible' : 'hidden',
            opacity: i === 0 ? 1 : 0,
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

    function updateNavTheme(fromIdx, toIdx, prog) {
        if (!navbar) return;
        const fromNav = NAV[fromIdx] ?? NAV[0];
        const toNav = NAV[toIdx] ?? NAV[0];

        navbar.classList.toggle('light-theme', prog >= 0.5 ? toNav.light : fromNav.light);
    }

    let statsFired = false;
    function checkStatsTrigger(idx) {
        if (idx !== 2 || statsFired || !secWorks) return;
        statsFired = true;
        secWorks.querySelectorAll('[data-target]').forEach(el => {
            const rawTarget = el.dataset.target ?? '0';
            const targetVal = parseFloat(rawTarget) || 0;
            const isFloat = rawTarget.includes('.');
            const suffix = el.dataset.suffix ?? '';
            const obj = { val: 0 };
            gsap.to(obj, {
                val: targetVal, duration: 1.6, ease: 'power2.out', delay: 0.2,
                onUpdate() { el.textContent = (isFloat ? obj.val.toFixed(1) : Math.round(obj.val)) + suffix; }
            });
        });
    }

    // Hero entrance
    gsap.timeline({ defaults: { ease: 'power3.out', duration: 0.9 } })
        .to('#hero-h1', { opacity: 1, y: 0, delay: 0.2 })
        .to('#hero-p', { opacity: 1, y: 0 }, '-=0.55')
        .to('#hero-btn', { opacity: 1, y: 0 }, '-=0.5');

    // ── Build Scrubbable Timeline ─────────────────────────────
    function prepareTransition(targetIdx) {
        if (targetIdx < 0 || targetIdx >= n || targetIdx === current) return false;

        const fromSec = sections[current];
        const toSec = sections[targetIdx];
        const isForward = targetIdx > current;

        if (targetIdx === 2 && secWorks) secWorks.scrollTop = 0;

        fromElsCache = getSectionElements(fromSec);
        toElsCache = getSectionElements(toSec);

        // Paint translucent glass cols with FROM section RGBA
        cols.forEach(col => { col.style.background = SECTION_BG_RGBA[current]; });

        gsap.set(fromSec, { visibility: 'visible', opacity: 1, zIndex: 10, pointerEvents: 'none' });
        gsap.set(toSec, { visibility: 'visible', opacity: 0, zIndex: 20, pointerEvents: 'none' });
        if (overlay) gsap.set(overlay, { zIndex: 30 });

        gsap.set(toElsCache, { opacity: 0, y: isForward ? 35 : -35, scale: 0.96 });
        gsap.set(cols, { scaleY: 1 });

        activeTimeline = gsap.timeline({ paused: true });

        // Step A: Outgoing section elements fade out
        activeTimeline.to(fromElsCache, {
            opacity: 0,
            y: isForward ? -30 : 30,
            scale: 0.95,
            duration: 0.45,
            ease: 'power2.in',
            stagger: { each: 0.02, from: isForward ? 'start' : 'end' }
        }, 0);

        // Step B: toSec background opacity crossfades in
        activeTimeline.to(toSec, {
            opacity: 1,
            duration: 0.5,
            ease: 'power2.inOut'
        }, 0.05);

        // Step C: Translucent overlay columns collapse staggered
        activeTimeline.to(cols, {
            scaleY: 0,
            duration: 0.55,
            ease: 'power2.inOut',
            stagger: { each: 0.025, from: isForward ? 'start' : 'end' }
        }, 0.1);

        // Step D: Incoming section elements fade in and slide into position
        activeTimeline.to(toElsCache, {
            opacity: 1,
            y: 0,
            scale: 1,
            duration: 0.55,
            ease: 'power3.out',
            stagger: { each: 0.03, from: 'start' }
        }, 0.15);

        // Step E: Navbar morphs smoothly
        activeTimeline.to(navbar, {
            '--nav-bg': NAV[targetIdx].bg,
            '--nav-border': NAV[targetIdx].border,
            duration: 0.42,
            ease: 'power2.inOut'
        }, 0.06);

        target = targetIdx;
        stateObj.progress = 0;
        targetProgress = 0;
        activeTimeline.progress(0);
        return true;
    }

    function clearActiveTransition(completedTarget) {
        if (!activeTimeline) return;

        const fromSec = sections[current];
        const toSec = target !== null ? sections[target] : null;

        if (completedTarget) {
            // Settled at target section
            current = target;
            gsap.set(fromSec, { visibility: 'hidden', opacity: 0, zIndex: 0, pointerEvents: 'none' });
            gsap.set(fromElsCache, { clearProps: 'transform,opacity,scale' });

            gsap.set(overlay, { zIndex: 0 });
            gsap.set(cols, { scaleY: 0 });
            if (toSec) {
                gsap.set(toSec, { zIndex: 10, opacity: 1, pointerEvents: 'auto' });
                gsap.set(toElsCache, { clearProps: 'transform,opacity,scale' });
            }

            applyNav(current);
            checkStatsTrigger(current);
        } else {
            // Reverted back to current section
            if (toSec) {
                gsap.set(toSec, { visibility: 'hidden', opacity: 0, zIndex: 0, pointerEvents: 'none' });
                gsap.set(toElsCache, { clearProps: 'transform,opacity,scale' });
            }
            gsap.set(fromSec, { zIndex: 10, opacity: 1, pointerEvents: 'auto' });
            gsap.set(fromElsCache, { clearProps: 'transform,opacity,scale' });

            gsap.set(overlay, { zIndex: 0 });
            gsap.set(cols, { scaleY: 0 });

            applyNav(current);
        }

        activeTimeline.kill();
        activeTimeline = null;
        target = null;
        stateObj.progress = 0;
        targetProgress = 0;
        isSnapping = false;
        isNavJumping = false;
    }

    function snapTo(endProgress) {
        if (!activeTimeline) return;
        isSnapping = true;
        clearTimeout(snapTimer);

        const currentProg = stateObj.progress;
        const dist = Math.abs(endProgress - currentProg);
        const duration = Math.max(0.35, dist * 0.75);

        gsap.to(stateObj, {
            progress: endProgress,
            duration: duration,
            ease: 'power2.out',
            overwrite: true,
            onUpdate() {
                if (activeTimeline) {
                    activeTimeline.progress(stateObj.progress);
                    if (target !== null) updateNavTheme(current, target, stateObj.progress);
                }
            },
            onComplete() {
                clearActiveTransition(endProgress === 1);
            }
        });
    }

    // Direct section jump (e.g. navbar click)
    function goTo(targetIdx) {
        if (targetIdx < 0 || targetIdx >= n || targetIdx === current) return;

        if (activeTimeline) {
            gsap.killTweensOf(stateObj);
            clearActiveTransition(false);
        }

        isNavJumping = true;
        if (!prepareTransition(targetIdx)) return;
        snapTo(1);
    }

    // ── Reactive Scroll / Wheel Input Handling ──────────────────────
    const WHEEL_SENSITIVITY = 1000; // wheel pixels required for a complete section transition

    window.addEventListener('wheel', e => {
        if (document.body.classList.contains('modal-open')) return;

        // Works: allow internal scroll, transition only at top/bottom boundary
        if (current === 2 && secWorks && !activeTimeline) {
            const atTop = secWorks.scrollTop <= 5;
            const atBottom = secWorks.scrollTop + secWorks.clientHeight >= secWorks.scrollHeight - 10;
            if (e.deltaY > 0 && !atBottom) return; // scroll inside Works
            if (e.deltaY < 0 && !atTop) return;
        }

        e.preventDefault();

        if (isNavJumping) return;

        const delta = e.deltaY;
        if (Math.abs(delta) < 1) return;

        const dir = delta > 0 ? 1 : -1;
        lastScrollDir = dir;

        if (!activeTimeline) {
            // Start scrub towards next/prev section
            const nextIdx = current + dir;
            if (nextIdx < 0 || nextIdx >= n) return;
            prepareTransition(nextIdx);
        }

        if (!activeTimeline) return;

        // Calculate progress delta relative to current target direction:
        // Going down (target > current): +delta advances progress
        // Going up (target < current): -delta advances progress
        const deltaProgress = (target > current) ? (delta / WHEEL_SENSITIVITY) : (-delta / WHEEL_SENSITIVITY);
        targetProgress += deltaProgress;

        // Clamp targetProgress between 0.0 and 1.0 — freezes midway whenever wheel stops!
        targetProgress = Math.max(0, Math.min(1, targetProgress));

        // Smooth reactive update
        gsap.to(stateObj, {
            progress: targetProgress,
            duration: 0.25,
            ease: 'power2.out',
            overwrite: 'auto',
            onUpdate() {
                if (activeTimeline) {
                    activeTimeline.progress(stateObj.progress);
                    if (target !== null) updateNavTheme(current, target, stateObj.progress);
                }
            },
            onComplete() {
                if (stateObj.progress >= 1.0) {
                    clearActiveTransition(true);
                } else if (stateObj.progress <= 0.0) {
                    clearActiveTransition(false);
                }
            }
        });
    }, { passive: false });

    // Touch swipe handling with step response
    let touchX0 = 0;
    let touchY0 = 0;
    window.addEventListener('touchstart', e => { 
        touchX0 = e.touches[0].clientX;
        touchY0 = e.touches[0].clientY; 
    }, { passive: true });
    window.addEventListener('touchmove', e => {
        if (document.body.classList.contains('modal-open')) return;

        if (!touchY0) return;
        const dx = touchX0 - e.touches[0].clientX;
        const dy = touchY0 - e.touches[0].clientY;

        // If touching inside Why section 3D deck or dragging card horizontally, do not trigger fullpage section transition
        if (current === 4 && e.target && e.target.closest('#why-deck-wrap')) {
            if (Math.abs(dx) > Math.abs(dy) || window.whyIsDragging) {
                return;
            }
        }

        if (current === 2 && secWorks && !activeTimeline) {
            const atTop = secWorks.scrollTop <= 5;
            const atBottom = secWorks.scrollTop + secWorks.clientHeight >= secWorks.scrollHeight - 10;
            if (dy > 0 && !atBottom) return;
            if (dy < 0 && !atTop) return;
        }

        if (Math.abs(dy) > 10) {
            const dir = dy > 0 ? 1 : -1;
            lastScrollDir = dir;
            if (!activeTimeline) {
                const nextIdx = current + dir;
                if (nextIdx >= 0 && nextIdx < n) prepareTransition(nextIdx);
            }
            if (activeTimeline) {
                targetProgress = Math.max(0, Math.min(1, Math.abs(dy) / 300));
                gsap.to(stateObj, {
                    progress: targetProgress,
                    duration: 0.2,
                    overwrite: 'auto',
                    onUpdate() {
                        if (activeTimeline) {
                            activeTimeline.progress(stateObj.progress);
                            if (target !== null) updateNavTheme(current, target, stateObj.progress);
                        }
                    },
                    onComplete() {
                        if (stateObj.progress >= 1.0) clearActiveTransition(true);
                        else if (stateObj.progress <= 0.0) clearActiveTransition(false);
                    }
                });
            }
        }
    }, { passive: true });

    window.addEventListener('touchend', e => {
        touchX0 = 0;
        touchY0 = 0;
    }, { passive: true });

    window.addEventListener('keydown', e => {
        if (document.body.classList.contains('modal-open')) {
            if (e.key === 'Escape') {
                if (window.closeProjectModal) window.closeProjectModal();
            }
            return;
        }

        if (activeTimeline || isNavJumping) return;
        if (e.key === 'ArrowDown' || e.key === 'PageDown' || e.key === ' ') {
            if (current === 2 && secWorks && secWorks.scrollTop + secWorks.clientHeight < secWorks.scrollHeight - 10) return;
            e.preventDefault(); goTo(current + 1);
        } else if (e.key === 'ArrowUp' || e.key === 'PageUp') {
            if (current === 2 && secWorks && secWorks.scrollTop > 5) return;
            e.preventDefault(); goTo(current - 1);
        }
    });

    const ids = ['hero', 'services', 'works', 'testimonials', 'why', 'cta'];
    document.querySelectorAll('a[href^="#"]').forEach(link => {
        link.addEventListener('click', e => {
            const hash = link.getAttribute('href').replace('#', '');
            const idx = (hash === 'hero' || hash === '') ? 0 : ids.indexOf(hash);
            if (idx !== -1) { e.preventDefault(); goTo(idx); }
        });
    });

    window.fp = { goTo, current: () => current };
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
        if (window.fp && window.fp.current && window.fp.current() === 4) {
            if (e.key === 'ArrowLeft') {
                goPrev();
            } else if (e.key === 'ArrowRight') {
                goNext();
            }
        }
    });

    // Initialize initial view
    updateStack(false);
})();


