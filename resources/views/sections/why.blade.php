<!-- ========================
     WHY ODDS SECTION
     ======================== -->
<section class="why-odds section-pad" id="why">
    <div class="container-mid">
        <p class="why-odds-label gsap-fade-up">
            <span style="color:#F359B0; font-size:.85rem; font-weight:700; letter-spacing:.1em; text-transform:uppercase;">Why bet on</span>
        </p>
        <h2 class="why-odds-title gsap-fade-up">
            Why bet on <span class="brand"><span>©</span>DDS</span>&thinsp;?
        </h2>
        <p class="why-odds-desc gsap-fade-up">
            Choosing a development partner shouldn't feel like a gamble. We replace slow
            timelines and bloated frameworks with clean, flexible engineering that delivers.
        </p>

        <div class="why-odds-grid">
            @php
                $reasons = [
                    [
                        'icon'  => '⚡',
                        'title' => 'Stack-Agnostic Engineering',
                        'text'  => 'We build what fits your reality. Whether you need ultra-fast native code or a specific language stack, we architect the exact system your business demands.',
                    ],
                    [
                        'icon'  => '🔁',
                        'title' => 'End-to-End Flexibility',
                        'text'  => 'A dynamic, multi-service pipeline. Deploy us to solve a single operational bottleneck, or leverage our complete software, design, and hardware capabilities.',
                    ],
                    [
                        'icon'  => '🚀',
                        'title' => 'Velocity-Driven Delivery',
                        'text'  => 'No endless planning loops. We map precise sequences and execute aggressively to ship stable, production-ready systems exactly when you need them.',
                    ],
                ];
            @endphp

            @foreach($reasons as $r)
            <div class="why-card gsap-scale-in">
                <div class="why-card-icon">{{ $r['icon'] }}</div>
                <h3 class="why-card-title">{{ $r['title'] }}</h3>
                <p class="why-card-text">{{ $r['text'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>
