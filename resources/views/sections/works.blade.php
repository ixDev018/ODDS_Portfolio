<!-- ========================
     OUR WORKS SECTION
     ======================== -->
<section class="works section-pad" id="works">
    <div class="container-mid">
        <p class="works-label gsap-fade-up">Our Works</p>
        <h2 class="works-title gsap-fade-up">We Don't Just Build. We Deliver.</h2>

        <!-- Stats -->
        <div class="works-stats gsap-fade-up" id="works-stats">
            <div class="works-stat">
                <div class="works-stat-number" data-count="58">0</div>
                <div class="works-stat-label">Projects Accomplished</div>
            </div>
            <div class="works-stat">
                <div class="works-stat-number" data-count="8" data-suffix="/10">0</div>
                <div class="works-stat-label">Client Satisfaction</div>
            </div>
            <div class="works-stat">
                <div class="works-stat-number" data-count="99" data-suffix="%">0</div>
                <div class="works-stat-label">The Reliability Angle</div>
            </div>
        </div>

        <p class="works-description gsap-fade-up">
            Real-world solutions, custom-engineered for rapid deployment and measurable business impact.
        </p>

        <!-- Works Grid -->
        <div class="works-grid" id="works-grid">
            @php
                $works = [
                    ['client' => 'THEODORE', 'bg' => '#c4c4c4'],
                    ['client' => 'ClearGuard', 'bg' => '#c4c4c4'],
                    ['client' => 'PRISMA', 'bg' => '#c4c4c4'],
                    ['client' => 'Sentry', 'bg' => '#c4c4c4'],
                    ['client' => 'SPCC Website', 'bg' => '#c4c4c4'],
                    ['client' => 'USAF Website', 'bg' => '#c4c4c4'],
                    ['client' => 'ALAMI', 'bg' => '#c4c4c4'],
                    ['client' => 'AVONIC', 'bg' => '#c4c4c4'],
                    ['client' => 'SPCC Website', 'bg' => '#c4c4c4'],
                ];
            @endphp

            @foreach($works as $work)
            <div class="work-card gsap-scale-in">
                <div class="work-card-img" style="background: {{ $work['bg'] }};">
                    <span style="opacity:0.4;">🖼</span>
                    <span class="work-card-label">{{ $work['client'] }}</span>
                </div>
            </div>
            @endforeach
        </div>

        <div class="works-see-more gsap-fade-up">
            <a href="#" class="btn-dark">See More</a>
        </div>
    </div>
</section>
