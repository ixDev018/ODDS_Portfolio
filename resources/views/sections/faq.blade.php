@php
$faqList = isset($faqs) && count($faqs) > 0 ? $faqs : collect([
    (object)[
        'question' => "HOW LONG DOES A PROJECT TAKE?",
        'answer'   => "Each project's timeline depends on the scope. A simple landing page can be completed within 2 weeks while a full e-commerce platform might take 3 – 6 weeks. Once we understand your needs, we'll give you a clear, realistic timeline.",
    ],
    (object)[
        'question' => "CAN I MANAGE A SITE AFTER IT'S BUILT?",
        'answer'   => "Absolutely. We build clean, intuitive management workflows and dashboards tailored to your team. We also provide complete documentation, recorded handoffs, and ongoing support so you're never left in the dark.",
    ],
    (object)[
        'question' => "HOW DOES PRICING WORK?",
        'answer'   => "We default to transparent milestone-based quotes so you know the exact deliverables and timeline upfront with zero surprise billing. For evolving product builds or R&D, flexible sprint retainers are also available.",
    ],
    (object)[
        'question' => "WHAT TOOLS ARE USED IN BUILDING?",
        'answer'   => "We are stack-agnostic, choosing modern, robust, and scalable technologies best fitted to your product goals—from performant full-stack frameworks to custom cloud infrastructure and API integrations.",
    ],
    (object)[
        'question' => "HOW MUCH DOES IT COST TO BUILD AN APP?",
        'answer'   => "Pricing varies depending on feature depth, third-party integrations, and platform complexity. Following an initial scoping discussion, we provide a detailed proposal tailored to your requirements and budget.",
    ],
]);
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
            @foreach($faqList as $index => $item)
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
    </div>
</section>
