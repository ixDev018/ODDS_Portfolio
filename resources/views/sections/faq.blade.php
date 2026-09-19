@php
$faqList = isset($faqs) && count($faqs) > 0 ? $faqs : collect([
    (object)[
        'question' => "Do I need a finished spec to start?",
        'answer'   => "No — we scope with you first, starting from a rough idea or a problem you need solved.",
    ],
    (object)[
        'question' => "How long from first contact to kickoff?",
        'answer'   => "A few days once we've scoped the work.",
    ],
    (object)[
        'question' => "Do I need a technical co-founder to work with you?",
        'answer'   => "No — we work directly with non-technical founders and teams.",
    ],
    (object)[
        'question' => "How does pricing work?",
        'answer'   => "Based on scope and depth of involvement — quoted only after we've scoped the work together, no hidden costs.",
    ],
    (object)[
        'question' => "Who owns the code once it's done?",
        'answer'   => "Full ownership typically transfers to you.",
    ],
]);

$displayFaqs = $faqList->take(5);
@endphp

<section class="faq" id="faq">
    <div class="faq-content-wrap">
        <div class="faq-center">
            <p class="faq-label fade-up">FAQS</p>
            <h2 class="faq-title fade-up">Questions, Answered.</h2>
            <p class="faq-desc fade-up">
                Direct answers to how we work, scope, price, and deliver high-velocity systems.
            </p>
        </div>

        <div class="faq-accordion-wrap fade-up" id="faq-accordion">
            @foreach($displayFaqs as $index => $item)
            <div class="faq-item" data-faq-index="{{ $index }}">
                <button type="button" 
                        class="faq-question-btn" 
                        aria-expanded="false" 
                        aria-controls="faq-answer-{{ $index }}"
                        id="faq-btn-{{ $index }}">
                    <span class="faq-q-text">{{ $item->question }}</span>
                    <div class="faq-toggle-icon" aria-hidden="true">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="12" y1="5" x2="12" y2="19"></line>
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                        </svg>
                    </div>
                </button>
                <div class="faq-answer-collapse" 
                     id="faq-answer-{{ $index }}" 
                     role="region" 
                     aria-labelledby="faq-btn-{{ $index }}">
                    <div class="faq-answer-inner">
                        <div class="faq-answer-spacer"></div>
                        <div class="faq-answer-body">
                            {{ $item->answer }}
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="faq-footer-action fade-up">
            <a href="{{ route('portfolio.faqs') }}" class="faq-more-btn">
                <span>More FAQs</span>
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                    <polyline points="12 5 19 12 12 19"></polyline>
                </svg>
            </a>
        </div>
    </div>
</section>

