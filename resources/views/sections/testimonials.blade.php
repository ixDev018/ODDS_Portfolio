<!-- ========================
     TESTIMONIALS SECTION
     ======================== -->
<section class="testimonials section-pad" id="testimonials">
    <div class="container-mid">
        <!-- Header -->
        <div class="testimonials-header">
            <div>
                <p class="testimonials-label gsap-fade-up">Client Testimonials</p>
                <h2 class="testimonials-title gsap-fade-up">
                    Built Fast.<br>Trusted Deeply.
                </h2>
            </div>
            <p class="testimonials-desc gsap-fade-up">
                Speed means nothing if the system breaks under pressure. Discover how we deliver stable,
                production-ready systems on aggressive timelines for businesses that can't afford to wait.
            </p>
        </div>

        <!-- Scrollable Testimonial Cards -->
        <div class="testimonials-track gsap-fade-up" id="testi-track">
            @php
                $testimonials = [
                    [
                        'name'   => 'Joe Ree',
                        'role'   => 'CEO, TechStart',
                        'avatar' => 'JR',
                        'text'   => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
                        'stars'  => 5,
                    ],
                    [
                        'name'   => 'Joe Ree',
                        'role'   => 'Director, ClearGuard',
                        'avatar' => 'JR',
                        'text'   => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris.',
                        'stars'  => 4,
                    ],
                    [
                        'name'   => 'Joe Ree',
                        'role'   => 'Founder, PRISMA',
                        'avatar' => 'JR',
                        'text'   => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip.',
                        'stars'  => 5,
                    ],
                    [
                        'name'   => 'Joe Ree',
                        'role'   => 'CTO, Sentry',
                        'avatar' => 'JR',
                        'text'   => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.',
                        'stars'  => 5,
                    ],
                ];
            @endphp

            @foreach($testimonials as $t)
            <div class="testi-card">
                <div class="testi-author">
                    <div class="testi-avatar">{{ $t['avatar'] }}</div>
                    <div>
                        <div class="testi-name">{{ $t['name'] }}</div>
                        <div class="testi-role">{{ $t['role'] }}</div>
                    </div>
                </div>
                <p class="testi-text">{{ $t['text'] }}</p>
                <div class="testi-stars">
                    @for($i = 1; $i <= 5; $i++)
                        <span class="{{ $i <= $t['stars'] ? 'filled' : '' }}">★</span>
                    @endfor
                    <span style="margin-left:.4rem;font-size:.75rem;color:rgba(255,255,255,0.7);">Excellent</span>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
