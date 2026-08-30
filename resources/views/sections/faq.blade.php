@php
$faqList = isset($faqs) && count($faqs) > 0 ? $faqs : collect([
    (object)[
        'question' => "We don't have a technical spec yet — can you still help?",
        'answer'   => "Yes. Most of what we take on starts as a rough idea, not a finished spec. We'll work with you to scope the actual problem before writing a line of code.",
    ],
    (object)[
        'question' => "What's the smallest project you'll take on?",
        'answer'   => "There isn't a minimum. We've shipped single technical modules and full end-to-end builds. Scope decides the timeline and cost, not whether we'll take the work.",
    ],
    (object)[
        'question' => "How fast is \"fast,\" really?",
        'answer'   => "Depends on scope — a focused module can ship in days, a full platform takes longer. We'll give you a real timeline range after scoping, not a vague promise.",
    ],
    (object)[
        'question' => "How do you keep quality high while moving quickly?",
        'answer'   => "Speed comes from cutting planning overhead, not testing. We ship production-ready systems, not prototypes dressed up as final products.",
    ],
    (object)[
        'question' => "What does the process look like after I reach out?",
        'answer'   => "You'll hear back within 24 hours with next steps — a short scoping call, then a timeline and quote before any work starts.",
    ],
    (object)[
        'question' => "How is pricing structured?",
        'answer'   => "Project-based quotes are the default, since scope is usually clearer than hours. We're flexible if hourly makes more sense for the work.",
    ],
    (object)[
        'question' => "What happens if something breaks after launch?",
        'answer'   => "You contact us and we fix it. We stand behind what we ship.",
    ],
    (object)[
        'question' => "Do you offer post-launch support or maintenance?",
        'answer'   => "Yes, available as an ongoing arrangement if you want it — not required.",
    ],
    (object)[
        'question' => "Who owns the code and IP once the project is done?",
        'answer'   => "You do. Full ownership transfers on project completion.",
    ],
    (object)[
        'question' => "Do I need to know what tech stack I want?",
        'answer'   => "No. We're stack-agnostic — we'll recommend what actually fits your problem rather than pushing whatever we're most comfortable with.",
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
                    <div class="faq-q-left">
                        <span class="faq-q-num">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</span>
                        <span class="faq-q-text">{{ $item->question }}</span>
                    </div>
                    <div class="faq-toggle-icon" aria-hidden="true">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M6 9l6 6 6-6"/>
                        </svg>
                    </div>
                </button>
                <div class="faq-answer-collapse" 
                     id="faq-answer-{{ $index }}" 
                     role="region" 
                     aria-labelledby="faq-btn-{{ $index }}">
                    <div class="faq-answer-body">
                        {{ $item->answer }}
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
