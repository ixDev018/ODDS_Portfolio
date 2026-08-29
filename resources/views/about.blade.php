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

    /* ─── PROPER STUDIO FOOTER ─── */
    .odds-studio-footer {
        background: #090d16;
        border-top: 1px solid #1e293b;
        color: #94a3b8;
        font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, sans-serif;
        position: relative;
        z-index: 10;
        width: 100%;
    }

    .footer-main-container {
        max-width: 1280px;
        margin: 0 auto;
        padding: 4.5rem 1.5rem 3rem 1.5rem;
    }

    @media (min-width: 1024px) {
        .footer-main-container {
            padding: 5rem 2rem 3.5rem 2rem;
        }
    }

    .footer-grid-layout {
        display: grid;
        grid-template-columns: 1fr;
        gap: 3rem;
        margin-bottom: 4rem;
    }

    @media (min-width: 640px) {
        .footer-grid-layout {
            grid-template-columns: repeat(2, 1fr);
            gap: 2.5rem;
        }
    }

    @media (min-width: 1024px) {
        .footer-grid-layout {
            grid-template-columns: 2fr 1fr 1.2fr 1.3fr;
            gap: 3.5rem;
        }
    }

    .footer-col-title {
        font-family: 'JetBrains Mono', monospace;
        font-size: 0.725rem;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        color: #ffffff;
        margin-bottom: 1.25rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .footer-links-list {
        list-style: none;
        padding: 0;
        margin: 0;
        display: flex;
        flex-direction: column;
        gap: 0.75rem;
    }

    .footer-link {
        font-size: 0.875rem;
        color: #94a3b8;
        text-decoration: none;
        transition: all 0.2s ease;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .footer-link:hover {
        color: #ffffff;
        transform: translateX(2px);
    }

    .footer-link-active {
        color: #c084fc;
        font-weight: 600;
    }

    .footer-status-pill {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.35rem 0.75rem;
        border-radius: 9999px;
        background: rgba(16, 185, 129, 0.1);
        border: 1px solid rgba(16, 185, 129, 0.25);
        color: #34d399;
        font-family: 'JetBrains Mono', monospace;
        font-size: 0.7rem;
        font-weight: 700;
        letter-spacing: 0.05em;
        margin-top: 1.5rem;
    }

    .footer-social-row {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        margin-top: 1.25rem;
    }

    .footer-social-btn {
        width: 36px;
        height: 36px;
        border-radius: 0.65rem;
        background: rgba(255, 255, 255, 0.06);
        border: 1px solid rgba(255, 255, 255, 0.12);
        color: #94a3b8;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.95rem;
        transition: all 0.2s ease;
        text-decoration: none;
    }

    .footer-social-btn:hover {
        background: #7039ec;
        border-color: #7039ec;
        color: #ffffff;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(112, 57, 236, 0.35);
    }

    .footer-cta-action-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        padding: 0.7rem 1.25rem;
        background: linear-gradient(to right, #7039ec, #9333ea);
        color: #ffffff;
        border-radius: 0.75rem;
        font-size: 0.825rem;
        font-weight: 700;
        text-decoration: none;
        transition: all 0.2s ease;
        margin-top: 1rem;
        box-shadow: 0 4px 14px rgba(112, 57, 236, 0.3);
    }

    .footer-cta-action-btn:hover {
        background: linear-gradient(to right, #5e2bc7, #7e22ce);
        transform: translateY(-1px);
        box-shadow: 0 6px 18px rgba(112, 57, 236, 0.45);
        color: #ffffff;
    }

    .footer-bottom-bar {
        padding-top: 2rem;
        border-top: 1px solid #1e293b;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: space-between;
        gap: 1rem;
        font-size: 0.8rem;
        color: #64748b;
    }

    @media (min-width: 768px) {
        .footer-bottom-bar {
            flex-direction: row;
        }
    }

    .footer-back-to-top {
        background: transparent;
        border: 1px solid #1e293b;
        color: #94a3b8;
        font-family: 'JetBrains Mono', monospace;
        font-size: 0.75rem;
        font-weight: 600;
        padding: 0.35rem 0.85rem;
        border-radius: 0.5rem;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        transition: all 0.2s ease;
    }

    .footer-back-to-top:hover {
        background: #1e293b;
        color: #ffffff;
        border-color: #334155;
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

{{-- PROPER STUDIO FOOTER --}}
<footer class="odds-studio-footer">
    <div class="footer-main-container">
        <div class="footer-grid-layout">
            
            {{-- Column 1: ODDS Brand & Mission --}}
            <div>
                <a href="{{ url('/') }}" class="inline-block mb-4 text-white hover:opacity-80 transition-opacity" aria-label="ODDS Home">
                    <svg width="88" height="28" viewBox="0 0 88 28" fill="none" xmlns="http://www.w3.org/2000/svg" style="height: 26px; width: auto;">
                        <path d="M11.3567 12.2224C11.376 12.4818 11.5355 12.7099 11.7726 12.817L19.6574 16.378C20.1484 16.5998 20.6978 16.2154 20.6579 15.6782L20.2762 10.5463C20.2569 10.287 20.0974 10.0589 19.8603 9.95181L11.9755 6.39075C11.4845 6.169 10.9351 6.55335 10.975 7.09063L11.3567 12.2224Z" fill="currentColor"/>
                        <path d="M10.8914 13.253C11.0988 13.096 11.3754 13.0649 11.6124 13.172L19.4972 16.733C19.9882 16.9548 20.0631 17.6211 19.6336 17.9463L15.5312 21.053C15.3239 21.21 15.0472 21.2411 14.8102 21.1341L6.92539 17.573C6.43438 17.3512 6.35946 16.6849 6.78897 16.3597L10.8914 13.253Z" fill="currentColor"/>
                        <path d="M27.9087 13.9543C27.9087 21.6611 21.6611 27.9087 13.9543 27.9087C6.24757 27.9087 0 21.6611 0 13.9543C0 6.24757 6.24757 0 13.9543 0C21.6611 0 27.9087 6.24757 27.9087 13.9543ZM2.99795 13.9543C2.99795 20.0054 7.90329 24.9107 13.9543 24.9107C20.0054 24.9107 24.9107 20.0054 24.9107 13.9543C24.9107 7.90329 20.0054 2.99795 13.9543 2.99795C7.90329 2.99795 2.99795 7.90329 2.99795 13.9543Z" fill="currentColor"/>
                        <path d="M24.9844 27.4219V0.559082H33.5805C36.4459 0.559082 38.9147 1.13471 40.987 2.28598C43.0848 3.43725 44.7094 5.02343 45.8606 7.04454C47.0119 9.06565 47.5875 11.381 47.5875 13.9905C47.5875 16.6 47.0119 18.9154 45.8606 20.9365C44.7094 22.9576 43.0848 24.5438 40.987 25.695C38.9147 26.8463 36.4459 27.4219 33.5805 27.4219H24.9844ZM28.6684 24.16H33.6189C35.6144 24.16 37.3797 23.7507 38.9147 22.932C40.4753 22.1133 41.7033 20.9493 42.5987 19.4398C43.4942 17.9048 43.9419 16.0884 43.9419 13.9905C43.9419 11.8671 43.4942 10.0506 42.5987 8.54119C41.7033 7.03175 40.4753 5.86769 38.9147 5.04902C37.3797 4.23034 35.6144 3.821 33.6189 3.821H28.6684V24.16Z" fill="currentColor"/>
                        <path d="M46.7445 27.4219V0.559082H55.3406C58.206 0.559082 60.6748 1.13471 62.7471 2.28598C64.8449 3.43725 66.4695 5.02343 67.6207 7.04454C68.772 9.06565 69.3476 11.381 69.3476 13.9905C69.3476 16.6 68.772 18.9154 67.6207 20.9365C66.4695 22.9576 64.8449 24.5438 62.7471 25.695C60.6748 26.8463 58.206 27.4219 55.3406 27.4219H46.7445ZM50.4285 24.16H55.379C57.3745 24.16 59.1398 23.7507 60.6748 22.932C62.2354 22.1133 63.4634 20.9493 64.3588 19.4398C65.2543 17.9048 65.702 16.0884 65.702 13.9905C65.702 11.8671 65.2543 10.0506 64.3588 8.54119C63.4634 7.03175 62.2354 5.86769 60.6748 5.04902C59.1398 4.23034 57.3745 3.821 55.379 3.821H50.4285V24.16Z" fill="currentColor"/>
                        <path d="M25.597 27.4219V24.16H80.0172C80.9127 24.16 81.6802 23.9553 82.3198 23.546C82.9594 23.1111 83.4582 22.561 83.8164 21.8959C84.1746 21.2307 84.3537 20.5271 84.3537 19.7852C84.3537 19.0177 84.1746 18.3141 83.8164 17.6746C83.4838 17.0094 82.9977 16.4849 82.3581 16.1012C81.7441 15.6918 80.9894 15.4872 80.094 15.4872H75.0284C73.519 15.4872 72.1886 15.1801 71.0374 14.5661C69.8861 13.9265 68.9779 13.0567 68.3127 11.9566C67.6731 10.8309 67.3533 9.56453 67.3533 8.15743C67.3533 6.72475 67.6603 5.43277 68.2743 4.28151C68.9139 3.13024 69.7966 2.22202 70.9222 1.55685C72.0735 0.89167 73.3911 0.559082 74.8749 0.559082H86.2724V3.821H75.2203C74.376 3.821 73.6341 4.02567 72.9945 4.43501C72.3549 4.81876 71.8688 5.33044 71.5362 5.97003C71.2037 6.58404 71.0374 7.24921 71.0374 7.96555C71.0374 8.65631 71.1909 9.32149 71.4979 9.96108C71.8305 10.5751 72.3038 11.074 72.9178 11.4577C73.5574 11.8415 74.2865 12.0334 75.1052 12.0334H80.2859C81.8976 12.0334 83.2791 12.3532 84.4304 12.9927C85.5817 13.6323 86.4643 14.5022 87.0783 15.6023C87.6923 16.7024 87.9993 17.956 87.9993 19.3631C87.9993 20.9237 87.6795 22.318 87.0399 23.546C86.4259 24.7484 85.5433 25.695 84.392 26.3858C83.2408 27.0766 81.9232 27.4219 80.4394 27.4219H25.597Z" fill="currentColor"/>
                    </svg>
                </a>
                <p class="text-xs leading-relaxed text-slate-400 max-w-sm mb-4">
                    We build what your business needs FAST. High-velocity systems, custom software architectures, and stack-agnostic precision.
                </p>
                <div class="footer-status-pill">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                    <span>ALL SYSTEMS OPERATIONAL // SHIP SPRINT ACTIVE</span>
                </div>
            </div>

            {{-- Column 2: Studio Navigation --}}
            <div>
                <div class="footer-col-title">
                    <span>Navigation</span>
                </div>
                <ul class="footer-links-list">
                    <li><a href="{{ url('/') }}" class="footer-link">Home</a></li>
                    <li><a href="{{ url('/#services') }}" class="footer-link">Services</a></li>
                    <li><a href="{{ url('/#works') }}" class="footer-link">Our Work</a></li>
                    <li><a href="{{ route('portfolio.about') }}" class="footer-link footer-link-active">Manifesto / About Us</a></li>
                    <li><a href="{{ url('/#cta') }}" class="footer-link">Let's Build</a></li>
                </ul>
            </div>

            {{-- Column 3: Capabilities --}}
            <div>
                <div class="footer-col-title">
                    <span>Capabilities</span>
                </div>
                <ul class="footer-links-list">
                    <li><a href="{{ url('/#services') }}" class="footer-link">Enterprise Cloud & Web</a></li>
                    <li><a href="{{ url('/#services') }}" class="footer-link">Mobile & Multi-Platform</a></li>
                    <li><a href="{{ url('/#services') }}" class="footer-link">IoT & Embedded Hardware</a></li>
                    <li><a href="{{ url('/#services') }}" class="footer-link">AI & Telemetry Pipelines</a></li>
                    <li><a href="{{ url('/#services') }}" class="footer-link">DevOps & CI/CD Pipelines</a></li>
                </ul>
            </div>

            {{-- Column 4: Direct Line & Connect --}}
            <div>
                <div class="footer-col-title">
                    <span>Direct Line</span>
                </div>
                <ul class="footer-links-list">
                    <li>
                        <a href="mailto:{{ $settings->cta_email ?? 'hello@odds.dev' }}" class="footer-link text-slate-300">
                            <i class="fa-regular fa-envelope text-xs text-purple-400"></i>
                            <span>{{ $settings->cta_email ?? 'hello@odds.dev' }}</span>
                        </a>
                    </li>
                    <li>
                        <a href="tel:{{ $settings->cta_phone ?? '+1 (555) 019-2834' }}" class="footer-link text-slate-300">
                            <i class="fa-solid fa-phone text-xs text-purple-400"></i>
                            <span>{{ $settings->cta_phone ?? '+1 (555) 019-2834' }}</span>
                        </a>
                    </li>
                </ul>

                <div class="footer-social-row">
                    <a href="{{ $settings->cta_facebook ? 'https://facebook.com/' . $settings->cta_facebook : 'https://facebook.com' }}" target="_blank" rel="noopener" class="footer-social-btn" aria-label="Facebook">
                        <i class="fa-brands fa-facebook-f"></i>
                    </a>
                    <a href="{{ $settings->cta_instagram ? 'https://instagram.com/' . $settings->cta_instagram : 'https://instagram.com' }}" target="_blank" rel="noopener" class="footer-social-btn" aria-label="Instagram">
                        <i class="fa-brands fa-instagram"></i>
                    </a>
                    <a href="{{ $settings->cta_youtube ? 'https://youtube.com/' . $settings->cta_youtube : 'https://youtube.com' }}" target="_blank" rel="noopener" class="footer-social-btn" aria-label="YouTube">
                        <i class="fa-brands fa-youtube"></i>
                    </a>
                    <a href="https://github.com" target="_blank" rel="noopener" class="footer-social-btn" aria-label="GitHub">
                        <i class="fa-brands fa-github"></i>
                    </a>
                </div>

                <a href="{{ url('/#cta') }}" class="footer-cta-action-btn">
                    <span>Start a Project</span>
                    <i class="fa-solid fa-arrow-right text-xs"></i>
                </a>
            </div>

        </div>

        {{-- Bottom Bar --}}
        <div class="footer-bottom-bar">
            <div>
                © {{ date('Y') }} <strong class="text-slate-300">ODDS Studio</strong>. All rights reserved.
            </div>
            <div class="font-mono text-xs text-slate-500">
                Stack-Agnostic Precision Standard // 2026
            </div>
            <button type="button" class="footer-back-to-top" onclick="window.scrollTo({top: 0, behavior: 'smooth'})">
                <span>Back to top</span>
                <i class="fa-solid fa-arrow-up text-xs"></i>
            </button>
        </div>
    </div>
</footer>

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
