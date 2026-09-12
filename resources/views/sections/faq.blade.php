$faqList = isset($faqs) && count($faqs) > 0 ? $faqs : collect([
    (object)[
        'question' => "We only have a rough idea, not a finished technical spec. Can you still help?",
        'answer'   => "Yes. Most of our projects start with an operational bottleneck or concept, not a spec. We work directly with you during scoping to define the architecture, requirements, and roadmap before writing a line of code.",
    ],
    (object)[
        'question' => "Do I need to know what tech stack or framework I want?",
        'answer'   => "No. We are strictly stack-agnostic. We evaluate your scalability, performance, and budget requirements to select the exact language and architecture that fits your problem—never forcing you into rigid templates.",
    ],
    (object)[
        'question' => "How does pricing and scoping work?",
        'answer'   => "We default to milestone-based quotes so you know the exact deliverables and timeline upfront with zero surprise billing. For evolving product builds or R&D, flexible sprint retainers are also available.",
    ],
    (object)[
        'question' => "Who owns the code and intellectual property once complete?",
        'answer'   => "You do. 100% of the source code, repository commits, design assets, and intellectual property transfer directly to you upon milestone completion. No vendor lock-in, ever.",
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
