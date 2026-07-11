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
