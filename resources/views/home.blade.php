<x-layout>
    <!-- HERO SECTION -->
    <section class="hero" id="hero">
        <div class="hero-glow-left"></div>
        <div class="hero-glow-right"></div>

        <div class="hero-content">
            <h1 class="hero-title fade-up" id="hero-h1">
                We build what your<br>business needs <strong>FAST</strong>
            </h1>
            <p class="hero-subtitle fade-up" id="hero-p">
                Driven by technical excellence and a commitment to discomfort-driven growth,
                we rapidly execute our deployment sequences. At the end of the day,
                our mission is simple: we ship.
            </p>
            <a href="#cta" class="btn-hero fade-up" id="hero-btn">Let's Build</a>
        </div>
    </section>

    <!-- SERVICES SECTION -->
    @php
    $imgIcon = '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>';
    $services = [
        ['name' => "Software\nDevelopment"],
        ['name' => "Web-App\nDevelopment"],
        ['name' => "Mobile\nApplications"],
        ['name' => "Backend\n& DevOps"],
        ['name' => "Game\nDevelopment"],
        ['name' => "Hardware\nSolutions"],
    ];
    @endphp

    <section class="services" id="services">
        <div class="services-glow-left"></div>
        <div class="services-glow-right"></div>
        <div class="sec-inner services-header">
            <p class="sec-label fade-up">Services</p>
            <h2 class="services-title fade-up">We are a <strong>COMPLETE PACKAGE</strong></h2>
        </div>

        <div class="services-cards" id="svc-cards">
            <div class="services-track">
                <div class="services-group">
                    @foreach($services as $svc)
                    <div class="svc-card">
                        <div class="svc-icon">{!! $imgIcon !!}</div>
                        <p class="svc-card-name" style="white-space:pre-line;">{{ $svc['name'] }}</p>
                    </div>
                    @endforeach
                </div>
                <!-- Duplicate group for infinite loop marquee -->
                <div class="services-group" aria-hidden="true">
                    @foreach($services as $svc)
                    <div class="svc-card">
                        <div class="svc-icon">{!! $imgIcon !!}</div>
                        <p class="svc-card-name" style="white-space:pre-line;">{{ $svc['name'] }}</p>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="sec-inner services-footer">
            <p class="services-desc fade-up">
                Business problems aren't solved by generic templates. Whether you need a standalone<br>
                service or a fully integrated package, we engineer the exact solution your operations demand.
            </p>
            <a href="#cta" class="btn-dark fade-up">Let's Build</a>
        </div>
    </section>

    <!-- WORKS SECTION -->
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
                Real-world solutions, custom-engineered for rapid deployment<br>
                and measurable business impact.
            </p>

            <div class="works-grid">
                @foreach($works as $client)
                <div class="work-card scale-in">
                    <div class="work-card-tab"></div>
                    <div class="work-card-body">
                        <div class="work-img">{!! $imgSvg !!}</div>
                    </div>
                    <span class="work-label">{{ $client }}</span>
                </div>
                @endforeach
            </div>

            <div class="works-cta fade-up">
                <a href="#" class="btn-dark">See More</a>
            </div>
        </div>
    </section>

    <!-- TESTIMONIALS SECTION -->
    @php
    $cards = [
        ['init' => 'JR', 'name' => 'Joe Ree', 'role' => 'CEO, TechStart', 'stars' => 4,
         'text' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.'],
        ['init' => 'JR', 'name' => 'Joe Ree', 'role' => 'Director, ClearGuard', 'stars' => 4,
         'text' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.'],
        ['init' => 'JR', 'name' => 'Joe Ree', 'role' => 'Founder, PRISMA', 'stars' => 4,
         'text' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.'],
        ['init' => 'JR', 'name' => 'Joe Ree', 'role' => 'CTO, Sentry', 'stars' => 4,
         'text' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco.'],
    ];
    @endphp

    <section class="testimonials" id="testimonials">
        <div class="sec-inner">
            <div class="testi-header">
                <div>
                    <p class="testi-label fade-up">Client Testimonials</p>
                    <h2 class="testi-title fade-up">Built Fast.<br>Trusted Deeply.</h2>
                </div>
                <p class="testi-right-desc fade-up">
                    Speed means nothing if the system breaks under pressure. Discover how we deliver stable,
                    production-ready systems on aggressive timelines for businesses that can't afford to wait.
                </p>
            </div>
        </div>

        <div class="testi-track" id="testi-track">
            @foreach($cards as $c)
            <div class="testi-card">
                <div class="testi-author-row">
                    <div class="testi-avatar">{{ $c['init'] }}</div>
                    <div>
                        <div class="testi-name">{{ $c['name'] }}</div>
                        <div class="testi-role">{{ $c['role'] }}</div>
                    </div>
                </div>
                <p class="testi-text">{{ $c['text'] }}</p>
                <div class="testi-stars">
                    @for($i = 1; $i <= 5; $i++)
                        <span class="{{ $i <= $c['stars'] ? 's' : 'e' }}">★</span>
                    @endfor
                    <span class="testi-excellent">Excellent</span>
                </div>
            </div>
            @endforeach
        </div>
    </section>

    <!-- WHY BET ON US SECTION -->
    @php
    $imgSvgWhy = '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>';
    $reasons = [
        ['label' => '', 'title' => 'Stack-Agnostic Engineering',
         'text'  => 'We build what fits your reality. Whether you need ultra-fast native code or a specific language stack, we architect the exact system your business demands.'],
        ['label' => '', 'title' => 'End-to-End Flexibility',
         'text'  => 'A dynamic, multi-service pipeline. Deploy us to solve a single operational bottleneck, or leverage our complete software, design, and hardware capabilities.'],
        ['label' => '', 'title' => 'Velocity-Driven Delivery',
         'text'  => 'No endless planning loops. We map precise sequences and execute aggressively to ship stable, production-ready systems exactly when you need them.'],
    ];
    @endphp

    <section class="why" id="why">
        <div class="sec-inner">
            <div class="why-center">
                <h2 class="why-title fade-up">Why bet on <img src="{{ asset('assets/img/ODDS_logo.svg') }}" alt="ODDS" style="display: inline-block; height: 0.75em; vertical-align: baseline; filter: invert(1); margin-left: 4px;"> ?</h2>
                <p class="why-desc fade-up">
                    Choosing a development partner shouldn't feel like a gamble. We replace slow
                    timelines and bloated frameworks with clean, flexible engineering that delivers.
                </p>
            </div>

            <div class="why-grid">
                @foreach($reasons as $r)
                <div class="why-card scale-in">
                    <div class="why-card-bg">{!! $imgSvgWhy !!}</div>
                    <p class="why-card-title">{{ $r['title'] }}</p>
                    <p class="why-card-text">{{ $r['text'] }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- CTA SECTION -->
    <section class="cta" id="cta">
        <div class="cta-bg-play" aria-hidden="true">▶</div>

        <div class="sec-inner cta-inner">
            <p class="cta-label fade-up">Initialize Project</p>
            <h2 class="cta-title fade-up">
                Let's Build<br>Something Real.
            </h2>
            <p class="cta-desc fade-up">
                Tell us what you're facing. Whether you need a quick technical module or an end-to-end
                package solution, our team is ready to execute. Expect a response with clear next steps
                within 24 hours.
            </p>
            <a href="mailto:hello@odds.dev" class="btn-hero fade-up">Let's Build</a>
        </div>
    </section>
</x-layout>
