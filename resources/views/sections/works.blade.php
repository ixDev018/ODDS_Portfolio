@php
$imgSvg = '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>';
$works = [
    'THEODORE', 'ClearGuard', 'PRISMA',
    'Sentry',   'SPCC Website', 'USAF Website',
    'ALAMI',    'AVONIC',       'SPCC Website',
];
@endphp

<section class="works" id="works">
    <div class="sec-inner">
        <p class="works-label fade-up">Our Works</p>
        <h2 class="works-title fade-up">We Don't Just Build. We Deliver.</h2>

        <div class="works-stats fade-up" id="stats-row">
            <div>
                <div class="stat-num" data-target="58">0</div>
                <div class="stat-lbl">Projects Accomplished</div>
            </div>
            <div>
                <div class="stat-num" data-target="8" data-suffix="/10">0</div>
                <div class="stat-lbl">Client Satisfaction</div>
            </div>
            <div>
                <div class="stat-num" data-target="99" data-suffix="%">0</div>
                <div class="stat-lbl">The Reliability Angle</div>
            </div>
        </div>

        <p class="works-desc fade-up">
            Real-world solutions, custom-engineered for rapid deployment and measurable business impact.
        </p>

        <div class="works-grid">
            @foreach($works as $client)
            <div class="work-card scale-in">
                <div class="work-img">{!! $imgSvg !!}</div>
                <div class="work-label">{{ $client }}</div>
            </div>
            @endforeach
        </div>

        <div class="works-cta fade-up">
            <a href="#" class="btn-dark">See More</a>
        </div>
    </div>
</section>
