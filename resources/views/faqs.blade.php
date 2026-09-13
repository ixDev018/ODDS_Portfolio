<x-layout>
@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<style>
    /* ─── STANDALONE FAQS PAGE THEME OVERRIDES ─── */
    body:has(.faqs-universe) {
        background-color: #fbfbfd !important;
        color: #111827 !important;
    }

    body:has(.faqs-universe) .navbar {
        background: rgba(255, 255, 255, 0.94) !important;
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        border-bottom: 1px solid rgba(0, 0, 0, 0.08) !important;
        color: #111827 !important;
        box-shadow: 0 4px 20px -2px rgba(15, 23, 42, 0.03);
    }
    body:has(.faqs-universe) .navbar .nav-logo {
        color: #111827 !important;
    }
    body:has(.faqs-universe) .navbar .nav-links a {
        color: rgba(17, 24, 39, 0.72) !important;
        font-weight: 600;
        font-size: 14px;
        transition: color 0.2s ease;
    }
    body:has(.faqs-universe) .navbar .nav-links a:hover,
    body:has(.faqs-universe) .navbar .nav-links a.active {
        color: #875af5 !important;
    }
    body:has(.faqs-universe) .navbar .btn-nav {
        background: #111827 !important;
        color: #ffffff !important;
        font-size: 14px;
        font-weight: 700;
        box-shadow: 0 4px 14px rgba(15, 23, 42, 0.12);
        transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1);
    }
    body:has(.faqs-universe) .navbar .btn-nav:hover {
        background: #875af5 !important;
        color: #ffffff !important;
        transform: translateY(-1px);
        box-shadow: 0 6px 20px rgba(135, 90, 245, 0.25);
    }
    body:has(.faqs-universe) .nav-toggle .hamburger-bar {
        background-color: #111827 !important;
    }

    /* ─── FAQS UNIVERSE WRAPPER ─── */
    .faqs-universe {
        min-height: 100vh;
        background: radial-gradient(ellipse 60% 50% at 50% 0%, rgba(135, 90, 245, 0.06) 0%, transparent 80%),
                    #fbfbfd;
        padding-top: calc(var(--nav-height, 72px) + 40px);
        padding-bottom: 100px;
        font-family: var(--font-primary), -apple-system, BlinkMacSystemFont, sans-serif;
        color: #1f2937;
    }

    .faqs-container {
        max-width: 1240px;
        margin: 0 auto;
        padding: 0 24px;
    }

    /* ─── MAIN TWO-COLUMN LAYOUT ─── */
    .faqs-grid {
        display: grid;
        grid-template-columns: 320px 1fr;
        gap: 56px;
        align-items: start;
    }

    @media (min-width: 1200px) {
        .faqs-grid {
            grid-template-columns: 340px 1fr;
            gap: 68px;
        }
    }

    /* ─── LEFT SIDEBAR (STICKY) ─── */
    .faqs-sidebar {
        position: sticky;
        top: calc(var(--nav-height, 72px) + 24px);
        display: flex;
        flex-direction: column;
        gap: 32px;
    }

    .faqs-page-title {
        font-size: clamp(32px, 3.2vw, 42px);
        font-weight: 850;
        color: #111827;
        letter-spacing: -0.03em;
        line-height: 1.15;
        margin: 0;
    }

    /* Search Bar */
    .faqs-search-box {
        position: relative;
        width: 100%;
    }

    .faqs-search-input {
        width: 100%;
        height: 48px;
        background: #ffffff;
        border: 1px solid #e5e7eb;
        border-radius: 12px;
        padding: 0 40px 0 42px;
        font-size: 14.5px;
        font-weight: 500;
        color: #111827;
        outline: none;
        transition: all 0.2s cubic-bezier(0.16, 1, 0.3, 1);
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.03);
        box-sizing: border-box;
    }

    .faqs-search-input::placeholder {
        color: #9ca3af;
    }

    .faqs-search-input:focus {
        border-color: #875af5;
        box-shadow: 0 0 0 3px rgba(135, 90, 245, 0.12), 0 2px 8px rgba(0, 0, 0, 0.04);
    }

    .faqs-search-icon {
        position: absolute;
        left: 14px;
        top: 50%;
        transform: translateY(-50%);
        color: #9ca3af;
        font-size: 14px;
        pointer-events: none;
        transition: color 0.2s ease;
    }

    .faqs-search-input:focus ~ .faqs-search-icon {
        color: #875af5;
    }

    .faqs-search-clear {
        position: absolute;
        right: 12px;
        top: 50%;
        transform: translateY(-50%);
        background: #f3f4f6;
        border: none;
        border-radius: 50%;
        width: 22px;
        height: 22px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #6b7280;
        font-size: 11px;
        cursor: pointer;
        opacity: 0;
        visibility: hidden;
        transition: all 0.2s ease;
    }

    .faqs-search-clear.is-visible {
        opacity: 1;
        visibility: visible;
    }

    .faqs-search-clear:hover {
        background: #e5e7eb;
        color: #111827;
    }

    /* Topic Menu List */
    .faqs-topics-menu {
        display: flex;
        flex-direction: column;
        gap: 4px;
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .faqs-topic-btn {
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 10px 14px 10px 16px;
        border: none;
        background: transparent;
        border-radius: 10px;
        color: #4b5563;
        font-size: 14.5px;
        font-weight: 550;
        text-align: left;
        cursor: pointer;
        position: relative;
        transition: all 0.2s cubic-bezier(0.16, 1, 0.3, 1);
    }

    .faqs-topic-btn:hover {
        background: #f3f4f6;
        color: #111827;
    }

    .faqs-topic-btn.is-active {
        background: #ffffff;
        color: #111827;
        font-weight: 700;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
    }

    .faqs-topic-btn.is-active::before {
        content: '';
        position: absolute;
        left: 0;
        top: 8px;
        bottom: 8px;
        width: 3.5px;
        background: #875af5;
        border-radius: 0 4px 4px 0;
    }

    .faqs-topic-count {
        font-family: var(--font-mono), monospace;
        font-size: 11px;
        font-weight: 700;
        padding: 2px 8px;
        border-radius: 9999px;
        background: #f3f4f6;
        color: #6b7280;
        transition: all 0.2s ease;
    }

    .faqs-topic-btn.is-active .faqs-topic-count {
        background: rgba(135, 90, 245, 0.12);
        color: #875af5;
    }

    /* Still Have Questions Support Card */
    .faqs-support-card {
        background: #ffffff;
        border: 1px solid #e5e7eb;
        border-radius: 18px;
        padding: 22px 20px;
        box-shadow: 0 4px 18px -4px rgba(0, 0, 0, 0.04);
        display: flex;
        flex-direction: column;
        gap: 14px;
    }

    .support-card-title {
        font-size: 15px;
        font-weight: 750;
        color: #111827;
        margin: 0;
    }

    .support-card-desc {
        font-size: 13px;
        line-height: 1.55;
        color: #6b7280;
        margin: 0;
    }

    .support-card-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        width: 100%;
        padding: 10px 16px;
        background: #f3f4f6;
        border: 1px solid #e5e7eb;
        border-radius: 10px;
        color: #111827;
        font-size: 13.5px;
        font-weight: 650;
        text-decoration: none;
        transition: all 0.2s cubic-bezier(0.16, 1, 0.3, 1);
        cursor: pointer;
    }

    .support-card-btn:hover {
        background: #111827;
        border-color: #111827;
        color: #ffffff;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.12);
    }

    /* ─── RIGHT CONTENT: ACCORDION LIST ─── */
    .faqs-content-col {
        display: flex;
        flex-direction: column;
        gap: 40px;
    }

    .faq-group-section {
        display: flex;
        flex-direction: column;
        gap: 14px;
        scroll-margin-top: calc(var(--nav-height, 72px) + 24px);
    }

    .faq-group-pill {
        display: inline-flex;
        align-items: center;
        align-self: flex-start;
        padding: 6px 14px;
        background: #ececf2;
        color: #4b5563;
        border-radius: 9999px;
        font-family: var(--font-mono), monospace;
        font-size: 11.5px;
        font-weight: 700;
        letter-spacing: 0.04em;
        text-transform: capitalize;
        margin-bottom: 2px;
    }

    .faq-cards-list {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    /* Individual Card-Based Accordion Item */
    .faq-card {
        background: #ffffff;
        border: 1px solid #e5e7eb;
        border-radius: 16px;
        overflow: hidden;
        transition: all 0.22s cubic-bezier(0.16, 1, 0.3, 1);
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.02);
    }

    .faq-card:hover {
        border-color: #d1d5db;
        box-shadow: 0 4px 14px rgba(0, 0, 0, 0.04);
    }

    .faq-card.is-expanded {
        border-color: #d8b4fe;
        box-shadow: 0 6px 20px -4px rgba(135, 90, 245, 0.08);
    }

    .faq-card-header {
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
        padding: 20px 24px;
        background: transparent;
        border: none;
        text-align: left;
        cursor: pointer;
        user-select: none;
    }

    .faq-card-question {
        font-size: clamp(15.5px, 1.3vw, 17px);
        font-weight: 700;
        color: #111827;
        line-height: 1.4;
        transition: color 0.2s ease;
    }

    .faq-card:hover .faq-card-question {
        color: #875af5;
    }

    .faq-card.is-expanded .faq-card-question {
        color: #111827;
    }

    /* Card Toggle Icon */
    .faq-card-icon {
        width: 28px;
        height: 28px;
        border-radius: 50%;
        background: #f3f4f6;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        color: #4b5563;
        transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1);
    }

    .faq-card:hover .faq-card-icon {
        background: #ede9fe;
        color: #875af5;
    }

    .faq-card.is-expanded .faq-card-icon {
        background: #875af5;
        color: #ffffff;
        transform: rotate(45deg);
    }

    /* Card Collapse Area */
    .faq-card-collapse {
        max-height: 0;
        overflow: hidden;
        opacity: 0;
        transition: max-height 0.32s cubic-bezier(0.16, 1, 0.3, 1), opacity 0.25s ease;
    }

    .faq-card.is-expanded .faq-card-collapse {
        opacity: 1;
    }

    .faq-card-body {
        padding: 0 24px 22px 24px;
        font-size: 14.5px;
        line-height: 1.7;
        color: #4b5563;
        font-weight: 400;
    }

    /* ─── EMPTY SEARCH STATE ─── */
    .faqs-empty-state {
        display: none;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-align: center;
        padding: 64px 24px;
        background: #ffffff;
        border: 1px dashed #d1d5db;
        border-radius: 20px;
        margin-top: 10px;
    }

    .faqs-empty-state.is-visible {
        display: flex;
    }

    .empty-icon-box {
        width: 54px;
        height: 54px;
        border-radius: 14px;
        background: #f3f4f6;
        color: #9ca3af;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        margin-bottom: 16px;
    }

    .empty-title {
        font-size: 18px;
        font-weight: 750;
        color: #111827;
        margin-bottom: 6px;
    }

    .empty-desc {
        font-size: 14px;
        color: #6b7280;
        max-width: 360px;
        margin-bottom: 20px;
    }

    .empty-reset-btn {
        padding: 9px 20px;
        background: #111827;
        color: #ffffff;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 600;
        border: none;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .empty-reset-btn:hover {
        background: #875af5;
    }

    /* ─── MOBILE FILTER PILLS BAR ─── */
    .mobile-topics-scroll {
        display: none;
        gap: 8px;
        overflow-x: auto;
        padding-bottom: 8px;
        margin-bottom: 24px;
        scrollbar-width: none;
        -webkit-overflow-scrolling: touch;
    }

    .mobile-topics-scroll::-webkit-scrollbar {
        display: none;
    }

    .mobile-topic-pill {
        white-space: nowrap;
        padding: 8px 16px;
        border-radius: 9999px;
        font-size: 13px;
        font-weight: 600;
        background: #ffffff;
        border: 1px solid #e5e7eb;
        color: #4b5563;
        cursor: pointer;
        transition: all 0.2s ease;
        flex-shrink: 0;
    }

    .mobile-topic-pill.is-active {
        background: #111827;
        border-color: #111827;
        color: #ffffff;
    }

    /* ─── RESPONSIVE BREAKPOINTS ─── */
    @media (max-width: 960px) {
        .faqs-grid {
            grid-template-columns: 1fr;
            gap: 32px;
        }

        .faqs-sidebar {
            position: static;
            gap: 20px;
        }

        .faqs-topics-menu {
            display: none;
        }

        .mobile-topics-scroll {
            display: flex;
        }

        .faqs-support-card {
            display: none;
        }
    }

    @media (max-width: 640px) {
        .faqs-universe {
            padding-top: calc(var(--nav-height, 72px) + 24px);
            padding-bottom: 60px;
        }

        .faqs-container {
            padding: 0 16px;
        }

        .faqs-card-header {
            padding: 16px 18px;
            gap: 14px;
        }

        .faqs-card-question {
            font-size: 15px;
        }

        .faqs-card-body {
            padding: 0 18px 18px 18px;
            font-size: 13.5px;
        }
    }
</style>
@endpush

@php
    // Group FAQs by category
    $faqItems = isset($faqs) && count($faqs) > 0 ? $faqs : collect([
        (object)[
            'id' => 1,
            'category' => 'Getting Started',
            'question' => "We don't have a technical spec yet — can you still help?",
            'answer'   => "Yes. Most of what we take on starts as a rough idea or an operational bottleneck, not a finished technical spec. We work directly with you during scoping to define the architecture, requirements, and roadmap before writing a line of code.",
        ],
        (object)[
            'id' => 2,
            'category' => 'Getting Started',
            'question' => "How fast can we kick off and ship the first milestone?",
            'answer'   => "Following an initial scoping discussion, we can typically kick off within 48 to 72 hours. Focused modules ship in days to a couple of weeks, while full platforms are delivered in rapid, testable sprint increments.",
        ],
        (object)[
            'id' => 3,
            'category' => 'Getting Started',
            'question' => "Do I need technical experience to work with ODDS?",
            'answer'   => "Not at all. We handle the complex engineering, cloud infrastructure, and technical architecture while translating everything into clear, actionable business milestones.",
        ],
        (object)[
            'id' => 4,
            'category' => 'Development & Stack',
            'question' => "Do I need to know what tech stack or framework I want?",
            'answer'   => "No. We are strictly stack-agnostic. We evaluate your scalability, performance, security, and budget requirements to select the exact language and architecture that fits your problem—never forcing you into rigid templates.",
        ],
        (object)[
            'id' => 5,
            'category' => 'Development & Stack',
            'question' => "Can I manage and update the site or application after it's built?",
            'answer'   => "Absolutely. We build clean, intuitive management workflows and dashboards tailored to your team. We also provide complete documentation, recorded handoffs, and ongoing support so you're never left in the dark.",
        ],
        (object)[
            'id' => 6,
            'category' => 'Scoping & Pricing',
            'question' => "How does pricing and project scoping work?",
            'answer'   => "We default to milestone-based quotes so you know the exact deliverables and timeline upfront with zero surprise billing. For evolving product builds or R&D, flexible sprint retainers are also available.",
        ],
        (object)[
            'id' => 7,
            'category' => 'Security & Ownership',
            'question' => "Who owns the source code and intellectual property (IP)?",
            'answer'   => "You do. 100% full ownership of all source code, design assets, database schemas, and intellectual property transfers to your company upon project completion.",
        ],
    ]);

    $groupedFaqs = $faqItems->groupBy(function($item) {
        return !empty($item->category) ? $item->category : 'General';
    });

    $totalFaqsCount = $faqItems->count();
@endphp

<div class="faqs-universe">
    <div class="faqs-container">
        <div class="faqs-grid">

            {{-- Left Column: Sidebar --}}
            <aside class="faqs-sidebar" aria-label="FAQ Navigation and Search">
                <div>
                    <h1 class="faqs-page-title">Frequently Asked Questions</h1>
                </div>

                {{-- Live Search Input --}}
                <div class="faqs-search-box">
                    <input type="text" 
                           id="faq-search-input" 
                           class="faqs-search-input" 
                           placeholder="Search questions..." 
                           autocomplete="off" 
                           aria-label="Search frequently asked questions">
                    <i class="fa-solid fa-magnifying-glass faqs-search-icon" aria-hidden="true"></i>
                    <button type="button" id="faq-search-clear" class="faqs-search-clear" aria-label="Clear search">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>

                {{-- Mobile Topic Pills --}}
                <div class="mobile-topics-scroll" id="mobile-topics-scroll">
                    <button type="button" class="mobile-topic-pill is-active" data-topic="all">
                        All ({{ $totalFaqsCount }})
                    </button>
                    @foreach($groupedFaqs as $category => $items)
                    <button type="button" class="mobile-topic-pill" data-topic="{{ \Illuminate\Support\Str::slug($category) }}">
                        {{ $category }} ({{ $items->count() }})
                    </button>
                    @endforeach
                </div>

                {{-- Desktop Topics List --}}
                <nav class="faqs-topics-nav" aria-label="FAQ Categories">
                    <ul class="faqs-topics-menu" id="faq-topics-menu">
                        <li>
                            <button type="button" class="faqs-topic-btn is-active" data-topic="all">
                                <span>All Topics</span>
                                <span class="faqs-topic-count">{{ $totalFaqsCount }}</span>
                            </button>
                        </li>
                        @foreach($groupedFaqs as $category => $items)
                        <li>
                            <button type="button" class="faqs-topic-btn" data-topic="{{ \Illuminate\Support\Str::slug($category) }}">
                                <span>{{ $category }}</span>
                                <span class="faqs-topic-count">{{ $items->count() }}</span>
                            </button>
                        </li>
                        @endforeach
                    </ul>
                </nav>

                {{-- Still Have Questions Card --}}
                <div class="faqs-support-card">
                    <h3 class="support-card-title">Still have questions?</h3>
                    <p class="support-card-desc">If you didn't find your answer, feel free to reach out to our engineering team.</p>
                    <a href="{{ url('/#cta') }}" class="support-card-btn">
                        <span>Get In Touch</span>
                        <i class="fa-solid fa-arrow-right text-xs"></i>
                    </a>
                </div>
            </aside>

            {{-- Right Column: Grouped FAQs Content --}}
            <main class="faqs-content-col" id="faqs-content-col">

                @foreach($groupedFaqs as $category => $items)
                <section class="faq-group-section" 
                         id="topic-section-{{ \Illuminate\Support\Str::slug($category) }}" 
                         data-category="{{ \Illuminate\Support\Str::slug($category) }}">
                    <div class="faq-group-pill">
                        {{ $category }}
                    </div>

                    <div class="faq-cards-list">
                        @foreach($items as $index => $item)
                        @php
                            $cardId = 'faq-card-' . ($item->id ?? ($category . '-' . $index));
                            $btnId  = 'faq-btn-' . ($item->id ?? ($category . '-' . $index));
                            $ansId  = 'faq-ans-' . ($item->id ?? ($category . '-' . $index));
                        @endphp
                        <div class="faq-card" id="{{ $cardId }}" data-faq-card>
                            <button type="button" 
                                    class="faq-card-header" 
                                    id="{{ $btnId }}"
                                    aria-expanded="false" 
                                    aria-controls="{{ $ansId }}">
                                <span class="faq-card-question">{{ $item->question }}</span>
                                <div class="faq-card-icon" aria-hidden="true">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                        <line x1="12" y1="5" x2="12" y2="19"></line>
                                        <line x1="5" y1="12" x2="19" y2="12"></line>
                                    </svg>
                                </div>
                            </button>

                            <div class="faq-card-collapse" 
                                 id="{{ $ansId }}" 
                                 role="region" 
                                 aria-labelledby="{{ $btnId }}">
                                <div class="faq-card-body">
                                    {{ $item->answer }}
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </section>
                @endforeach

                {{-- Empty Search State --}}
                <div class="faqs-empty-state" id="faqs-empty-state">
                    <div class="empty-icon-box">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </div>
                    <h3 class="empty-title">No questions found</h3>
                    <p class="empty-desc">We couldn't find any questions matching your search. Try different keywords or contact us directly.</p>
                    <button type="button" class="empty-reset-btn" id="faq-empty-reset">Clear Search</button>
                </div>

            </main>

        </div>
    </div>
</div>

{{-- Footer --}}
@include('components.footer', ['settings' => $settings])

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('faq-search-input');
    const searchClear = document.getElementById('faq-search-clear');
    const emptyState  = document.getElementById('faqs-empty-state');
    const emptyReset  = document.getElementById('faq-empty-reset');
    
    const desktopTopicBtns = document.querySelectorAll('.faqs-topic-btn');
    const mobileTopicBtns  = document.querySelectorAll('.mobile-topic-pill');
    
    const groupSections = Array.from(document.querySelectorAll('.faq-group-section'));
    const cards = Array.from(document.querySelectorAll('.faq-card'));

    let activeTopic = 'all';

    // ─── ACCORDION TOGGLE ───
    function closeCard(card) {
        card.classList.remove('is-expanded');
        const header = card.querySelector('.faq-card-header');
        const collapse = card.querySelector('.faq-card-collapse');
        if (header) header.setAttribute('aria-expanded', 'false');
        if (collapse) collapse.style.maxHeight = null;
    }

    function openCard(card) {
        card.classList.add('is-expanded');
        const header = card.querySelector('.faq-card-header');
        const collapse = card.querySelector('.faq-card-collapse');
        if (header) header.setAttribute('aria-expanded', 'true');
        if (collapse) {
            collapse.style.maxHeight = collapse.scrollHeight + 'px';
        }
    }

    cards.forEach(card => {
        const header = card.querySelector('.faq-card-header');
        if (!header) return;

        header.addEventListener('click', (e) => {
            e.preventDefault();
            const isExpanded = card.classList.contains('is-expanded');
            if (isExpanded) {
                closeCard(card);
            } else {
                openCard(card);
            }
        });
    });

    // ─── FILTER & SEARCH LOGIC ───
    function filterFaqs() {
        const query = (searchInput.value || '').trim().toLowerCase();
        let visibleCardsCount = 0;

        // Toggle clear button
        if (query.length > 0) {
            searchClear.classList.add('is-visible');
        } else {
            searchClear.classList.remove('is-visible');
        }

        groupSections.forEach(section => {
            const sectionCat = section.getAttribute('data-category');
            const sectionCards = Array.from(section.querySelectorAll('.faq-card'));
            let sectionVisibleCount = 0;

            const matchesTopic = (activeTopic === 'all' || activeTopic === sectionCat);

            sectionCards.forEach(card => {
                const questionText = (card.querySelector('.faq-card-question')?.textContent || '').toLowerCase();
                const answerText   = (card.querySelector('.faq-card-body')?.textContent || '').toLowerCase();

                const matchesQuery = !query || questionText.includes(query) || answerText.includes(query);

                if (matchesTopic && matchesQuery) {
                    card.style.display = '';
                    sectionVisibleCount++;
                    visibleCardsCount++;

                    // Auto-open if specific search query matches and search is active
                    if (query.length > 2 && (questionText.includes(query) || answerText.includes(query))) {
                        openCard(card);
                    }
                } else {
                    card.style.display = 'none';
                    closeCard(card);
                }
            });

            if (sectionVisibleCount > 0) {
                section.style.display = '';
            } else {
                section.style.display = 'none';
            }
        });

        if (visibleCardsCount === 0) {
            emptyState.classList.add('is-visible');
        } else {
            emptyState.classList.remove('is-visible');
        }
    }

    // Search Input Event
    searchInput.addEventListener('input', filterFaqs);

    searchClear.addEventListener('click', () => {
        searchInput.value = '';
        searchInput.focus();
        filterFaqs();
    });

    emptyReset.addEventListener('click', () => {
        searchInput.value = '';
        activeTopic = 'all';
        syncTopicButtons('all');
        filterFaqs();
    });

    // ─── TOPIC SWITCHING ───
    function syncTopicButtons(topic) {
        desktopTopicBtns.forEach(btn => {
            if (btn.getAttribute('data-topic') === topic) {
                btn.classList.add('is-active');
            } else {
                btn.classList.remove('is-active');
            }
        });

        mobileTopicBtns.forEach(btn => {
            if (btn.getAttribute('data-topic') === topic) {
                btn.classList.add('is-active');
            } else {
                btn.classList.remove('is-active');
            }
        });
    }

    function selectTopic(topic) {
        activeTopic = topic;
        syncTopicButtons(topic);
        filterFaqs();

        // Scroll into view on mobile if filtered to a specific section
        if (topic !== 'all' && window.innerWidth <= 960) {
            const targetSection = document.getElementById('topic-section-' + topic);
            if (targetSection) {
                targetSection.scrollIntoView({ behavior: 'smooth' });
            }
        }
    }

    desktopTopicBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            selectTopic(btn.getAttribute('data-topic'));
        });
    });

    mobileTopicBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            selectTopic(btn.getAttribute('data-topic'));
        });
    });

    // Window resize recalculation for open cards
    window.addEventListener('resize', () => {
        cards.forEach(card => {
            if (card.classList.contains('is-expanded')) {
                const collapse = card.querySelector('.faq-card-collapse');
                if (collapse) collapse.style.maxHeight = collapse.scrollHeight + 'px';
            }
        });
    });
});
</script>
@endpush
</x-layout>
