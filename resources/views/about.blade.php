<x-layout>
@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
@endpush

<style>
    /* ─── SCROLL & ROOT OVERRIDES FOR ABSOLUTE STICKY COMPATIBILITY ─── */
    html:has(.odds-about-universe),
    body:has(.odds-about-universe) {
        overflow: visible !important;
        overflow-x: visible !important;
        overflow-y: visible !important;
        height: auto !important;
        min-height: 100% !important;
        width: 100% !important;
        max-width: 100% !important;
        background-color: #f8fafc !important;
        color: #0f172a !important;
    }

    body:has(.odds-about-universe) main {
        overflow: visible !important;
        height: auto !important;
        min-height: 100% !important;
    }

    /* ─── NAVBAR OVERRIDES FOR ABOUT PAGE ─── */
    body:has(.odds-about-universe) .navbar {
        background: rgba(255, 255, 255, 0.94) !important;
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        border-bottom: 1px solid rgba(226, 232, 240, 0.85) !important;
        color: #0f172a !important;
        box-shadow: 0 4px 20px -2px rgba(15, 23, 42, 0.03);
    }
    body:has(.odds-about-universe) .navbar .nav-logo {
        color: #0f172a !important;
    }
    body:has(.odds-about-universe) .navbar .nav-links a {
        color: #475569 !important;
        font-weight: 600;
        font-size: 14px;
        transition: color 0.2s ease;
    }
    body:has(.odds-about-universe) .navbar .nav-links a:hover,
    body:has(.odds-about-universe) .navbar .nav-links a.active {
        color: #7039ec !important;
    }
    body:has(.odds-about-universe) .navbar .btn-nav {
        background: #0f172a !important;
        color: #ffffff !important;
        font-size: 14px;
        font-weight: 700;
        box-shadow: 0 4px 14px rgba(15, 23, 42, 0.12);
        transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1);
    }
    body:has(.odds-about-universe) .navbar .btn-nav:hover {
        background: #7039ec !important;
        color: #ffffff !important;
        transform: translateY(-1px);
        box-shadow: 0 6px 20px rgba(112, 57, 236, 0.25);
    }
    body:has(.odds-about-universe) .nav-toggle .hamburger-bar {
        background-color: #0f172a !important;
    }
    @media (max-width: 768px) {
        body:has(.odds-about-universe) .nav-inner {
            padding: 0 20px !important;
        }
    }

    /* ─── ABOUT PAGE WRAPPER ─── */
    .odds-about-universe {
        min-height: 100vh;
        background: #f8fafc;
        color: #334155;
        font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, sans-serif;
        position: relative;
        padding-top: 6.5rem;
        padding-bottom: 5rem;
        width: 100%;
        overflow: visible !important;
        box-sizing: border-box;
    }

    @media (max-width: 640px) {
        .odds-about-universe {
            padding-top: 5.5rem;
            padding-bottom: 3.5rem;
        }
    }

    /* Ambient Hero Glow & Tech Matrix in isolated overflow container */
    .about-ambient-container {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 500px;
        overflow: hidden;
        pointer-events: none;
        z-index: 0;
    }

    .about-ambient-glow {
        position: absolute;
        top: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 100%;
        max-width: 1000px;
        height: 480px;
        background: radial-gradient(circle at 50% 10%, rgba(112, 57, 236, 0.07) 0%, rgba(243, 89, 176, 0.03) 40%, transparent 70%);
    }

    .about-tech-matrix {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 500px;
        background-image: 
            linear-gradient(to right, rgba(15, 23, 42, 0.025) 1px, transparent 1px),
            linear-gradient(to bottom, rgba(15, 23, 42, 0.025) 1px, transparent 1px);
        background-size: 48px 48px;
        mask-image: radial-gradient(ellipse at 50% 20%, black 35%, transparent 75%);
        -webkit-mask-image: radial-gradient(ellipse at 50% 20%, black 35%, transparent 75%);
    }

    /* ─── TYPOGRAPHIC ONE-LINER HERO: AGAINST ALL ODDS ─── */
    .about-headline-hero {
        position: relative;
        z-index: 10;
        text-align: center;
        max-width: 1040px;
        margin: 0 auto 2.5rem auto;
        padding: 0 1.25rem;
        width: 100%;
        box-sizing: border-box;
    }

    .header-cont{
     margin:45px 0;   
    }

    .about-eyebrow-nav {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        font-family: 'JetBrains Mono', monospace;
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.12em;
        color: #64748b;
        margin-bottom: 1rem;
    }

    .about-eyebrow-nav .eyebrow-accent {
        color: #7039ec;
    }

    .about-eyebrow-nav .eyebrow-divider {
        color: #cbd5e1;
    }

    .about-massive-headline {
        font-size: clamp(2.5rem, 6.8vw, 5.2rem);
        font-weight: 900;
        line-height: 1.05;
        letter-spacing: -0.04em;
        text-transform: uppercase;
        color: #0f172a;
        margin-bottom: 1.15rem;
        word-break: break-word;
    }

    .headline-outline-text {
        -webkit-text-stroke: 2px #0f172a;
        color: transparent;
        transition: all 0.3s ease;
    }

    .headline-gradient-text {
        background: linear-gradient(135deg, #7039ec 0%, #a855f7 50%, #ec4899 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        display: inline-block;
    }

    .about-headline-subtext {
        font-size: clamp(0.95rem, 1.8vw, 1.125rem);
        line-height: 1.7;
        color: #475569;
        max-width: 680px;
        margin: 0 auto 1.85rem auto;
        font-weight: 400;
    }

    /* Meta Filter Ribbon */
    .about-editorial-meta-strip {
        display: inline-flex;
        flex-wrap: wrap;
        align-items: center;
        justify-content: center;
        gap: 1.25rem 2rem;
        padding: 0.65rem 1.6rem;
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 9999px;
        box-shadow: 0 4px 16px -2px rgba(15, 23, 42, 0.04);
        font-family: 'JetBrains Mono', monospace;
        font-size: 0.75rem;
        color: #64748b;
        max-width: 100%;
    }

    @media (max-width: 640px) {
        .about-editorial-meta-strip {
            border-radius: 1.15rem;
            padding: 0.75rem 1rem;
            gap: 0.65rem 1rem;
        }
    }

    .meta-strip-item {
        display: inline-flex;
        align-items: center;
        gap: 0.45rem;
    }

    .meta-strip-item strong {
        color: #0f172a;
        font-weight: 800;
    }

    .meta-strip-sep {
        color: #cbd5e1;
    }

    @media (max-width: 640px) {
        .meta-strip-sep {
            display: none;
        }
    }

    /* ─── MAIN CONTENT TWO-COLUMN LAYOUT ─── */
    .about-content-layout {
        display: flex;
        flex-direction: column;
        gap: 2.5rem;
        max-width: 1280px;
        margin: 2.5rem auto 0 auto;
        padding: 0 1.25rem;
        width: 100%;
        box-sizing: border-box;
    }

    @media (min-width: 1024px) {
        .about-content-layout {
            flex-direction: row;
            align-items: flex-start;
            gap: 3.5rem;
            padding: 0 2rem;
        }
    }

    /* ─── LEFT SIDEBAR (STICKY NAVIGATION) ─── */
    .about-sidebar-column {
        display: none;
    }

    @media (min-width: 1024px) {
        .about-sidebar-column {
            display: block;
            width: 340px;
            flex-shrink: 0;
            position: -webkit-sticky;
            position: sticky;
            top: 6rem;
            z-index: 20;
        }
    }

    .about-sidebar-sticky {
        display: flex;
        flex-direction: column;
        gap: 1.25rem;
        width: 100%;
    }

    .sidebar-toc-panel {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 1.35rem;
        padding: 1.35rem 1.5rem;
        box-shadow: 0 4px 24px -4px rgba(15, 23, 42, 0.04);
    }

    .sidebar-panel-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding-bottom: 0.85rem;
        margin-bottom: 0.85rem;
        border-bottom: 1px solid #f1f5f9;
    }

    .sidebar-label {
        font-family: 'JetBrains Mono', monospace;
        font-size: 0.725rem;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        color: #64748b;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .sidebar-label-dot {
        width: 7px;
        height: 7px;
        border-radius: 50%;
        background: #7039ec;
        box-shadow: 0 0 8px rgba(112, 57, 236, 0.6);
    }

    .sidebar-count-badge {
        font-family: 'JetBrains Mono', monospace;
        font-size: 0.7rem;
        font-weight: 700;
        background: #f5f3ff;
        color: #7039ec;
        padding: 0.15rem 0.55rem;
        border-radius: 9999px;
        border: 1px solid #ede9fe;
    }

    .toc-nav-list {
        display: flex;
        flex-direction: column;
        gap: 0.35rem;
    }

    .toc-link-item {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 0.65rem 0.85rem;
        border-radius: 0.75rem;
        font-size: 0.85rem;
        font-weight: 600;
        color: #475569;
        text-decoration: none;
        position: relative;
        transition: all 0.2s cubic-bezier(0.16, 1, 0.3, 1);
    }

    .toc-link-item:hover {
        color: #0f172a;
        background: #f8fafc;
        transform: translateX(3px);
    }

    .toc-link-item.active {
        color: #7039ec;
        background: #f5f3ff;
        font-weight: 700;
    }

    .toc-link-item.active::before {
        content: '';
        position: absolute;
        left: 0;
        top: 25%;
        bottom: 25%;
        width: 3.5px;
        background: #7039ec;
        border-radius: 0 4px 4px 0;
    }

    .toc-chapter-num {
        font-family: 'JetBrains Mono', monospace;
        font-size: 0.75rem;
        font-weight: 700;
        color: #94a3b8;
        transition: color 0.2s;
    }

    .toc-link-item.active .toc-chapter-num {
        color: #7039ec;
    }

    /* Sidebar Command / Deploy Card */
    .sidebar-deploy-card {
        background: linear-gradient(145deg, #090d16 0%, #131b2e 100%);
        border: 1px solid #1e293b;
        border-radius: 1.35rem;
        padding: 1.35rem;
        color: #ffffff;
        position: relative;
        overflow: hidden;
        box-shadow: 0 12px 30px -8px rgba(15, 23, 42, 0.25);
    }

    .sidebar-deploy-card::before {
        content: '';
        position: absolute;
        top: -30px;
        right: -30px;
        width: 100px;
        height: 100px;
        background: radial-gradient(circle, rgba(112, 57, 236, 0.4) 0%, transparent 70%);
        pointer-events: none;
    }

    .deploy-card-tag {
        font-family: 'JetBrains Mono', monospace;
        font-size: 0.68rem;
        font-weight: 700;
        color: #c084fc;
        display: flex;
        align-items: center;
        gap: 0.4rem;
        margin-bottom: 0.5rem;
    }

    .deploy-card-title {
        font-size: 0.9rem;
        font-weight: 800;
        color: #ffffff;
        margin-bottom: 0.35rem;
        letter-spacing: -0.01em;
    }

    .deploy-card-p {
        font-size: 0.775rem;
        line-height: 1.5;
        color: #94a3b8;
        margin-bottom: 1rem;
    }

    .deploy-card-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        width: 100%;
        padding: 0.65rem 1rem;
        background: #ffffff;
        color: #0f172a;
        border-radius: 0.75rem;
        font-size: 0.78rem;
        font-weight: 700;
        text-decoration: none;
        transition: all 0.2s ease;
        box-shadow: 0 4px 12px rgba(255, 255, 255, 0.1);
    }

    .deploy-card-btn:hover {
        background: #f5f3ff;
        color: #7039ec;
        transform: translateY(-1px);
    }

    /* ─── MOBILE CHAPTER SELECTOR ─── */
    .mobile-chapter-selector {
        margin-bottom: 2rem;
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 1.15rem;
        padding: 0.85rem 1rem;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.03);
        width: 100%;
        box-sizing: border-box;
    }

    .mobile-selector-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 0.6rem;
    }

    .mobile-selector-title {
        font-family: 'JetBrains Mono', monospace;
        font-size: 0.7rem;
        font-weight: 800;
        text-transform: uppercase;
        color: #64748b;
    }

    .mobile-chip-scroll {
        display: flex;
        gap: 0.5rem;
        overflow-x: auto;
        padding-bottom: 0.25rem;
        scrollbar-width: none;
        -webkit-overflow-scrolling: touch;
        width: 100%;
    }
    .mobile-chip-scroll::-webkit-scrollbar {
        display: none;
    }

    .mobile-chip {
        white-space: nowrap;
        padding: 0.5rem 0.9rem;
        border-radius: 0.65rem;
        font-size: 0.825rem;
        font-weight: 600;
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        color: #475569;
        text-decoration: none;
        transition: all 0.2s ease;
        flex-shrink: 0;
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
    }
    .mobile-chip.active,
    .mobile-chip:hover {
        background: #f5f3ff;
        border-color: #d8b4fe;
        color: #7039ec;
    }

    /* ─── RIGHT COLUMN: EDITORIAL CHAPTER CARDS ─── */
    .about-articles-feed {
        display: flex;
        flex-direction: column;
        gap: 3rem;
        width: 100%;
        flex: 1;
        min-width: 0;
    }

    .chapter-article-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 1.75rem;
        padding: 3rem 3.25rem;
        position: relative;
        box-shadow: 0 10px 35px -10px rgba(15, 23, 42, 0.04), 0 2px 6px -1px rgba(15, 23, 42, 0.02);
        transition: border-color 0.25s ease, box-shadow 0.25s ease;
        scroll-margin-top: 6.5rem;
        width: 100%;
        min-width: 0;
        box-sizing: border-box;
        overflow: hidden;
    }

    .chapter-article-card:hover {
        border-color: #cbd5e1;
        box-shadow: 0 18px 48px -12px rgba(15, 23, 42, 0.08);
    }

    @media (max-width: 768px) {
        .chapter-article-card {
            padding: 1.75rem 1.25rem;
            border-radius: 1.25rem;
        }
    }

    /* Chapter Top Meta Header */
    .chapter-card-topbar {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        justify-content: space-between;
        gap: 0.75rem;
        padding-bottom: 1.35rem;
        margin-bottom: 1.75rem;
        border-bottom: 1px solid #f1f5f9;
        width: 100%;
    }

    .chapter-badge-wrap {
        display: flex;
        align-items: center;
        gap: 0.6rem;
    }

    .chapter-index-pill {
        font-family: 'JetBrains Mono', monospace;
        font-size: 0.75rem;
        font-weight: 800;
        background: #0f172a;
        color: #ffffff;
        padding: 0.25rem 0.65rem;
        border-radius: 0.5rem;
        letter-spacing: 0.05em;
    }

    .chapter-category-pill {
        font-family: 'JetBrains Mono', monospace;
        font-size: 0.75rem;
        font-weight: 700;
        background: #f5f3ff;
        color: #7039ec;
        padding: 0.25rem 0.75rem;
        border-radius: 0.5rem;
        border: 1px solid #ede9fe;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }

    .chapter-meta-right {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        font-family: 'JetBrains Mono', monospace;
        font-size: 0.775rem;
        color: #64748b;
    }

    .chapter-author-tag {
        color: #1e293b;
        font-weight: 700;
    }

    /* Chapter Title & Subtitle */
    .chapter-main-title {
        font-size: clamp(1.6rem, 3vw, 2.4rem);
        font-weight: 900;
        color: #0f172a;
        line-height: 1.18;
        letter-spacing: -0.03em;
        margin-bottom: 0.85rem;
        word-break: break-word;
    }

    .chapter-deck-subtitle {
        font-size: 1.05rem;
        line-height: 1.75;
        color: #475569;
        font-weight: 400;
        margin-bottom: 2.25rem;
        padding-bottom: 1.75rem;
        border-bottom: 1px solid #f1f5f9;
        word-break: break-word;
    }

    /* 16:9 Cover Image */
    .chapter-cover-box {
        border-radius: 1.25rem;
        overflow: hidden;
        border: 1px solid #e2e8f0;
        background: #f8fafc;
        aspect-ratio: 16 / 9;
        width: 100%;
        margin-bottom: 2.5rem;
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.03);
    }
    .chapter-cover-box img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    /* ─── STRUCTURED NOTION BLOCKS (EDITORIAL GRADE) ─── */
    .blog-stream-body {
        font-size: 1.025rem;
        line-height: 1.85;
        color: #334155;
        width: 100%;
        min-width: 0;
        word-break: break-word;
    }

    /* H2 Header: Styled Subsection */
    .blog-block-h2 {
        font-size: clamp(1.35rem, 2.3vw, 1.7rem);
        font-weight: 800;
        color: #0f172a;
        letter-spacing: -0.025em;
        margin-top: 2.75rem;
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
        word-break: break-word;
    }
    .blog-block-h2::before {
        content: '';
        display: inline-block;
        width: 4px;
        height: 1.15em;
        background: linear-gradient(to bottom, #7039ec, #ec4899);
        border-radius: 3px;
        flex-shrink: 0;
    }

    /* H3 Header */
    .blog-block-h3 {
        font-size: 1.18rem;
        font-weight: 700;
        color: #1e293b;
        letter-spacing: -0.015em;
        margin-top: 2rem;
        margin-bottom: 0.75rem;
        word-break: break-word;
    }

    /* Paragraph */
    .blog-block-p {
        font-size: 1.015rem;
        line-height: 1.85;
        color: #334155;
        margin-bottom: 1.4rem;
        word-break: break-word;
    }

    /* Magazine Pullquote */
    .blog-block-quote {
        position: relative;
        border-left: 4px solid #7039ec;
        padding: 1.35rem 1.5rem 1.35rem 1.85rem;
        margin: 2rem 0;
        background: linear-gradient(135deg, rgba(112, 57, 236, 0.05) 0%, rgba(243, 89, 176, 0.03) 100%);
        border-radius: 0 1.25rem 1.25rem 0;
        color: #0f172a;
        font-style: italic;
        font-size: 1.05rem;
        line-height: 1.75;
        box-shadow: 0 2px 10px rgba(112, 57, 236, 0.03);
        word-break: break-word;
    }

    /* High-Tech Callout Box */
    .blog-block-callout {
        background: #fbf9ff;
        border: 1px solid #e9dcfc;
        border-radius: 1.15rem;
        padding: 1.25rem 1.4rem;
        margin: 1.75rem 0;
        display: flex;
        align-items: flex-start;
        gap: 1rem;
        color: #1e1b4b;
        font-size: 0.965rem;
        line-height: 1.7;
        box-shadow: 0 2px 12px rgba(112, 57, 236, 0.04);
        width: 100%;
        box-sizing: border-box;
        word-break: break-word;
    }

    .callout-icon-badge {
        width: 36px;
        height: 36px;
        border-radius: 0.65rem;
        background: #7039ec;
        color: #ffffff;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        font-size: 1rem;
        box-shadow: 0 4px 10px rgba(112, 57, 236, 0.3);
    }

    /* Developer Terminal Code Block */
    .blog-code-container {
        margin: 2rem 0;
        border-radius: 1.15rem;
        background: #090d16;
        border: 1px solid #1e293b;
        overflow: hidden;
        box-shadow: 0 12px 30px rgba(0, 0, 0, 0.25);
        width: 100%;
        max-width: 100%;
        box-sizing: border-box;
    }

    .blog-code-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0.75rem 1.25rem;
        background: #0f172a;
        border-bottom: 1px solid #1e293b;
    }

    .code-window-dots {
        display: flex;
        gap: 7px;
    }
    .code-window-dot {
        width: 11px;
        height: 11px;
        border-radius: 50%;
    }
    .dot-red { background: #ef4444; }
    .dot-yellow { background: #f59e0b; }
    .dot-green { background: #10b981; }

    .code-tab-label {
        font-family: 'JetBrains Mono', monospace;
        font-size: 0.725rem;
        color: #94a3b8;
        display: flex;
        align-items: center;
        gap: 0.4rem;
    }

    .code-copy-btn {
        background: rgba(255, 255, 255, 0.08);
        border: 1px solid rgba(255, 255, 255, 0.12);
        color: #94a3b8;
        font-size: 0.725rem;
        font-family: 'JetBrains Mono', monospace;
        padding: 0.3rem 0.75rem;
        border-radius: 0.45rem;
        cursor: pointer;
        transition: all 0.15s ease;
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
    }
    .code-copy-btn:hover {
        background: rgba(255, 255, 255, 0.16);
        color: #ffffff;
    }

    .blog-block-code {
        font-family: 'JetBrains Mono', monospace;
        font-size: 0.85rem;
        line-height: 1.7;
        padding: 1.25rem 1.4rem;
        margin: 0;
        white-space: pre-wrap;
        word-break: break-all;
        color: #38bdf8;
        overflow-x: auto;
        max-width: 100%;
    }

    /* List Items */
    .blog-block-bullet-item {
        display: flex;
        align-items: flex-start;
        gap: 0.85rem;
        font-size: 1rem;
        line-height: 1.75;
        color: #334155;
        margin-bottom: 0.75rem;
        word-break: break-word;
    }

    .blog-bullet-icon {
        color: #7039ec;
        font-size: 1.1rem;
        line-height: 1.4;
        flex-shrink: 0;
    }

    .blog-block-num-item {
        display: flex;
        align-items: flex-start;
        gap: 0.85rem;
        font-size: 1rem;
        line-height: 1.75;
        color: #334155;
        margin-bottom: 0.75rem;
        word-break: break-word;
    }

    .blog-num-badge {
        font-family: 'JetBrains Mono', monospace;
        font-size: 0.725rem;
        font-weight: 800;
        color: #6d28d9;
        background: #ede9fe;
        padding: 0.2rem 0.6rem;
        border-radius: 0.4rem;
        margin-top: 0.15rem;
        flex-shrink: 0;
    }

    .blog-block-divider {
        height: 1px;
        background: linear-gradient(to right, transparent, #e2e8f0 20%, #e2e8f0 80%, transparent);
        margin: 2.75rem 0;
        border: none;
    }

    .blog-block-img-card {
        margin: 2.25rem 0;
        border-radius: 1.25rem;
        overflow: hidden;
        border: 1px solid #e2e8f0;
        background: #f8fafc;
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.04);
        width: 100%;
    }
    .blog-block-img-card img {
        width: 100%;
        height: auto;
        max-height: 540px;
        object-fit: cover;
        display: block;
    }
    .blog-block-img-caption {
        padding: 0.85rem 1.25rem;
        font-size: 0.8rem;
        color: #64748b;
        text-align: center;
        border-top: 1px solid #f1f5f9;
        font-style: italic;
        background: #ffffff;
    }

</style>

<div class="odds-about-universe">
    {{-- Ambient Lighting & Technical Matrix Canvas in Isolated Container --}}
    <div class="about-ambient-container" aria-hidden="true">
        <div class="about-ambient-glow"></div>
        <div class="about-tech-matrix"></div>
    </div>
<div class="header-cont">
     {{-- TYPOGRAPHIC ONE-LINER HERO: AGAINST ALL ODDS --}}
    <header class="about-headline-hero">
        {{-- Eyebrow Breadcrumb --}}
        <div class="about-eyebrow-nav">
            <span class="eyebrow-accent">About Us</span>
            <span class="eyebrow-divider">/</span>
            <span>an oddly story</span>
        </div>

        {{-- Monumental Headline --}}
        <h1 class="about-massive-headline">
            AGAINST ALL <span class="headline-outline-text">ODDS</span><span class="headline-gradient-text">.</span>
        </h1>

        <!-- {{-- Punchy Subtitle --}}
        <p class="about-headline-subtext">
            We engineer high-velocity software systems and deliver production realities when conventional methods fall short.
        </p> -->

</div>
   
       
    </header>

    {{-- MAIN EDITORIAL CONTENT LAYOUT --}}
    <div class="about-content-layout">
        
        {{-- LEFT COLUMN: STICKY CHAPTER NAVIGATOR & COMMAND CONSOLE --}}
        <aside class="about-sidebar-column">
            <div class="about-sidebar-sticky">
                
                {{-- Table of Contents Card --}}
                <div class="sidebar-toc-panel">
                    <div class="sidebar-panel-header">
                        <div class="sidebar-label">
                            <span class="sidebar-label-dot"></span>
                            <span>Studio Chapters</span>
                        </div>
                        <span class="sidebar-count-badge">{{ $sections->count() }} Chapters</span>
                    </div>

                    <nav class="toc-nav-list" id="toc-nav">
                        @forelse($sections as $idx => $sec)
                            <a href="#section-{{ $sec->id }}" class="toc-link-item {{ $idx === 0 ? 'active' : '' }}">
                                <span class="toc-chapter-num">0{{ $idx + 1 }}.</span>
                                <span class="truncate">{{ $sec->title }}</span>
                            </a>
                        @empty
                            <a href="#philosophy" class="toc-link-item active">
                                <span class="toc-chapter-num">01.</span>
                                <span>The ODDS Philosophy</span>
                            </a>
                        @endforelse
                    </nav>
                </div>

                {{-- Deploy Studio Terminal Mini-Card --}}
                <div class="sidebar-deploy-card">
                    <div class="deploy-card-tag">
                        <i class="fa-solid fa-terminal text-xs"></i>
                        <span>ODDS // DEPLOY</span>
                    </div>
                    <h4 class="deploy-card-title">Need a Dedicated Sprint?</h4>
                    <p class="deploy-card-p">
                        Deploy our engineering core to build your complete system or eliminate architectural bottlenecks.
                    </p>
                    <a href="{{ url('/#cta') }}" class="deploy-card-btn">
                        <span>Start a Conversation</span>
                        <i class="fa-solid fa-arrow-right text-xs"></i>
                    </a>
                </div>

            </div>
        </aside>

        {{-- RIGHT COLUMN: ARTICLES / CHAPTER STREAM --}}
        <main class="about-articles-feed">

            {{-- Mobile Chapter Selector (Visible only on < lg screens) --}}
            <div class="lg:hidden mobile-chapter-selector">
                <div class="mobile-selector-header">
                    <span class="mobile-selector-title">Chapter Navigation</span>
                    <span class="text-xs font-mono text-purple-600 font-bold">{{ $sections->count() }} Chapters</span>
                </div>
                <div class="mobile-chip-scroll" id="mobile-toc-nav">
                    @forelse($sections as $idx => $sec)
                        <a href="#section-{{ $sec->id }}" class="mobile-chip {{ $idx === 0 ? 'active' : '' }}">
                            <span class="font-mono text-purple-600 font-bold">0{{ $idx + 1 }}.</span>
                            <span>{{ $sec->title }}</span>
                        </a>
                    @empty
                        <a href="#philosophy" class="mobile-chip active">
                            <span class="font-mono text-purple-600 font-bold">01.</span>
                            <span>The ODDS Philosophy</span>
                        </a>
                    @endforelse
                </div>
            </div>

            @if($sections->isEmpty())
                {{-- Default Fallback Section --}}
                <article class="chapter-article-card" id="philosophy">
                    <div class="chapter-card-topbar">
                        <div class="chapter-badge-wrap">
                            <span class="chapter-index-pill">CH.01</span>
                            <span class="chapter-category-pill">PHILOSOPHY</span>
                        </div>
                        <div class="chapter-meta-right">
                            <span>By <strong class="chapter-author-tag">ODDS Core Team</strong></span>
                            <span>•</span>
                            <span>3 MIN READ</span>
                        </div>
                    </div>

                    <h2 class="chapter-main-title">Why Speed and Stack-Agnostic Precision Matter</h2>
                    <p class="chapter-deck-subtitle">
                        Replacing slow corporate timelines and bloated frameworks with clean, flexible execution.
                    </p>

                    <div class="blog-stream-body">
                        <blockquote class="blog-block-quote">
                            "Choosing a development partner shouldn't feel like a gamble. We map precise sequences and execute aggressively to ship stable, production-ready systems."
                        </blockquote>

                        <h2 class="blog-block-h2">Velocity-Driven Delivery</h2>
                        <p class="blog-block-p">
                            At ODDS, we believe that software momentum is a competitive advantage. Rather than drowning in endless design loops or speculative architectures, our multidisciplinary team architects what fits your reality.
                        </p>

                        <div class="blog-block-callout">
                            <div class="callout-icon-badge">
                                <i class="fa-solid fa-bolt"></i>
                            </div>
                            <div>
                                <div class="font-bold text-xs uppercase font-mono tracking-wider text-purple-900 mb-0.5">Core Benchmark</div>
                                <div class="text-sm text-slate-700">From concept wireframe to production deployment in tight velocity sprints with zero fluff.</div>
                            </div>
                        </div>

                        <h3 class="blog-block-h3">Our Technical Versatility</h3>
                        <div class="space-y-2.5 mt-4">
                            <div class="blog-block-bullet-item">
                                <span class="blog-bullet-icon"><i class="fa-solid fa-circle-check"></i></span>
                                <div><strong class="text-slate-900">Enterprise Web & Cloud Systems:</strong> High-throughput applications with clean backend architectures.</div>
                            </div>
                            <div class="blog-block-bullet-item">
                                <span class="blog-bullet-icon"><i class="fa-solid fa-circle-check"></i></span>
                                <div><strong class="text-slate-900">Mobile & Multi-Platform:</strong> Native and hybrid mobile experiences built for velocity and responsiveness.</div>
                            </div>
                            <div class="blog-block-bullet-item">
                                <span class="blog-bullet-icon"><i class="fa-solid fa-circle-check"></i></span>
                                <div><strong class="text-slate-900">IoT, Hardware & Embedded:</strong> Real-time microcontroller firmware and live telemetry pipelines.</div>
                            </div>
                        </div>
                    </div>
                </article>
            @else
                @foreach($sections as $index => $section)
                    @php
                        $blocks = $section->body_content ?? [];
                        if (is_string($blocks)) {
                            $decoded = json_decode($blocks, true);
                            $blocks = is_array($decoded) ? $decoded : [];
                        }
                    @endphp
                    <article class="chapter-article-card" id="section-{{ $section->id }}">
                        
                        {{-- Top Meta Row --}}
                        <div class="chapter-card-topbar">
                            <div class="chapter-badge-wrap">
                                <span class="chapter-index-pill">CH.0{{ $index + 1 }}</span>
                                <span class="chapter-category-pill">{{ $section->category ?? 'ENGINEERING' }}</span>
                            </div>
                            <div class="chapter-meta-right">
                                <span>By <strong class="chapter-author-tag">{{ $section->author ?? 'ODDS Core' }}</strong></span>
                                <span>•</span>
                                <span>{{ strtoupper($section->read_time ?? '3 MIN READ') }}</span>
                            </div>
                        </div>

                        {{-- Main Chapter Title --}}
                        <h2 class="chapter-main-title">{{ $section->title }}</h2>

                        {{-- Subtitle Hook / Deck --}}
                        @if($section->subtitle)
                            <p class="chapter-deck-subtitle">{{ $section->subtitle }}</p>
                        @endif

                        {{-- 16:9 Cover Image --}}
                        @if(!empty($section->cover_image))
                            <div class="chapter-cover-box">
                                <img src="{{ $section->cover_image }}" alt="{{ $section->title }}" loading="lazy">
                            </div>
                        @endif

                        {{-- Stream of Structured Notion Blocks --}}
                        <div class="blog-stream-body">
                            @foreach($blocks as $b)
                                @php
                                    $type = $b['type'] ?? 'paragraph';
                                    $content = $b['content'] ?? '';
                                @endphp

                                @if($type === 'heading2')
                                    <h2 class="blog-block-h2">{!! $content !!}</h2>
                                @elseif($type === 'heading3')
                                    <h3 class="blog-block-h3">{!! $content !!}</h3>
                                @elseif($type === 'bullet')
                                    <div class="blog-block-bullet-item">
                                        <span class="blog-bullet-icon"><i class="fa-solid fa-circle-check"></i></span>
                                        <div class="flex-1 leading-relaxed">{!! $content !!}</div>
                                    </div>
                                @elseif($type === 'numbered')
                                    <div class="blog-block-num-item">
                                        <span class="blog-num-badge">STEP</span>
                                        <div class="flex-1 leading-relaxed">{!! $content !!}</div>
                                    </div>
                                @elseif($type === 'quote')
                                    <blockquote class="blog-block-quote">
                                        {!! $content !!}
                                    </blockquote>
                                @elseif($type === 'callout')
                                    <div class="blog-block-callout">
                                        <div class="callout-icon-badge">
                                            <i class="fa-solid fa-lightbulb"></i>
                                        </div>
                                        <div class="flex-1 font-medium leading-relaxed">{!! $content !!}</div>
                                    </div>
                                @elseif($type === 'code')
                                    <div class="blog-code-container">
                                        <div class="blog-code-header">
                                            <div class="code-window-dots">
                                                <span class="code-window-dot dot-red"></span>
                                                <span class="code-window-dot dot-yellow"></span>
                                                <span class="code-window-dot dot-green"></span>
                                            </div>
                                            <div class="code-tab-label">
                                                <i class="fa-solid fa-code text-[11px] text-purple-400"></i>
                                                <span>architecture.config</span>
                                            </div>
                                            <button type="button" class="code-copy-btn" onclick="copySnippet(this)" aria-label="Copy code">
                                                <i class="fa-regular fa-copy"></i>
                                                <span>Copy</span>
                                            </button>
                                        </div>
                                        <pre class="blog-block-code"><code>{{ $content }}</code></pre>
                                    </div>
                                @elseif($type === 'divider')
                                    <hr class="blog-block-divider">
                                @elseif($type === 'image' && !empty($b['src']))
                                    <div class="blog-block-img-card">
                                        <img src="{{ $b['src'] }}" alt="{{ $b['caption'] ?? 'Story visual' }}" loading="lazy">
                                        @if(!empty($b['caption']))
                                            <div class="blog-block-img-caption">{{ $b['caption'] }}</div>
                                        @endif
                                    </div>
                                @else
                                    @if(!empty(trim(strip_tags($content))))
                                        <p class="blog-block-p">{!! $content !!}</p>
                                    @endif
                                @endif
                            @endforeach
                        </div>

                    </article>
                @endforeach
            @endif

        </main>
    </div>

</div>

{{-- ODDS Studio Footer Component --}}
<x-footer :settings="$settings" />

{{-- Odds Lorenzo AI Chat Widget --}}
<x-odds-chat-widget />

<script>
// Code Snippet Copy Handler
function copySnippet(btn) {
    if (!btn) return;
    const container = btn.closest('.blog-code-container');
    if (!container) return;
    const codeEl = container.querySelector('code');
    if (!codeEl) return;
    const text = codeEl.innerText || codeEl.textContent;
    
    const span = btn.querySelector('span');
    const icon = btn.querySelector('i');
    if (span) span.innerText = 'Copied!';
    if (icon) icon.className = 'fa-solid fa-check text-emerald-400';

    try {
        if (navigator.clipboard) {
            navigator.clipboard.writeText(text).catch(() => execCopy(text));
        } else {
            execCopy(text);
        }
    } catch(e) {
        execCopy(text);
    }

    setTimeout(() => {
        if (span) span.innerText = 'Copy';
        if (icon) icon.className = 'fa-regular fa-copy';
    }, 2000);
}

function execCopy(text) {
    const ta = document.createElement('textarea');
    ta.value = text;
    ta.setAttribute('readonly', '');
    ta.style.position = 'fixed';
    ta.style.opacity = '0';
    document.body.appendChild(ta);
    ta.focus();
    ta.select();
    try {
        document.execCommand('copy');
    } catch (err) {}
    document.body.removeChild(ta);
}

// ScrollSpy Navigation Tracker
(function initAboutScrollSpy() {
    function setupSpy() {
        const desktopTocLinks = document.querySelectorAll('#toc-nav .toc-link-item');
        const mobileTocLinks = document.querySelectorAll('#mobile-toc-nav .mobile-chip');
        const mobileTocContainer = document.getElementById('mobile-toc-nav');
        const articles = document.querySelectorAll('.chapter-article-card');

        if (articles.length === 0) return;

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const id = entry.target.getAttribute('id');
                    if (!id) return;
                    
                    desktopTocLinks.forEach(link => {
                        link.classList.remove('active');
                        if (link.getAttribute('href') === `#${id}`) {
                            link.classList.add('active');
                        }
                    });

                    mobileTocLinks.forEach(pill => {
                        pill.classList.remove('active');
                        if (pill.getAttribute('href') === `#${id}`) {
                            pill.classList.add('active');
                            if (mobileTocContainer) {
                                const scrollTarget = pill.offsetLeft - (mobileTocContainer.offsetWidth / 2) + (pill.offsetWidth / 2);
                                mobileTocContainer.scrollTo({ left: scrollTarget, behavior: 'smooth' });
                            }
                        }
                    });
                }
            });
        }, {
            root: null,
            rootMargin: '-120px 0px -40% 0px',
            threshold: 0
        });

        articles.forEach(article => observer.observe(article));
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', setupSpy);
    } else {
        setupSpy();
    }
})();
</script>
</x-layout>
