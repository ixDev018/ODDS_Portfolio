@php
$cards = [
    [
        'img'   => null,
        'init'  => 'JR',
        'name'  => 'Joe Ree',
        'role'  => 'CEO, TechStart',
        'stars' => 4,
        'text'  => '"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat."',
    ],
    [
        'img'   => null,
        'init'  => 'JR',
        'name'  => 'Joe Ree',
        'role'  => 'Director, ClearGuard',
        'stars' => 4,
        'text'  => '"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat."',
    ],
    [
        'img'   => null,
        'init'  => 'JR',
        'name'  => 'Joe Ree',
        'role'  => 'Founder, PRISMA',
        'stars' => 5,
        'text'  => '"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat."',
    ],
    [
        'img'   => null,
        'init'  => 'JR',
        'name'  => 'Joe Ree',
        'role'  => 'CTO, Sentry',
        'stars' => 4,
        'text'  => '"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco."',
    ],
    [
        'img'   => null,
        'init'  => 'JR',
        'name'  => 'Joe Ree',
        'role'  => 'VP Engineering, Nexus',
        'stars' => 5,
        'text'  => '"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat."',
    ],
];
@endphp

<section class="testimonials fp-section" id="testimonials">

    {{-- Decorative glow blobs --}}
    <img class="testi-glow testi-glow--left"
         src="{{ asset('assets/img/Pink_blur.svg') }}" aria-hidden="true" alt="">
    <img class="testi-glow testi-glow--right"
         src="{{ asset('assets/img/Pink_blur.svg') }}" aria-hidden="true" alt="">

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
        <div class="testi-track-inner">
        @foreach($cards as $c)
        <div class="testi-card">
            {{-- Author row --}}
            <div class="testi-author-row">
                @if(!empty($c['img']))
                    <img class="testi-avatar-img" src="{{ asset($c['img']) }}" alt="{{ $c['name'] }}">
                @else
                    <div class="testi-avatar">{{ $c['init'] }}</div>
                @endif
                <div class="testi-author-info">
                    <div class="testi-name">{{ $c['name'] }}</div>
                    <div class="testi-role">{{ $c['role'] }}</div>
                </div>
            </div>

            {{-- Testimonial text --}}
            <p class="testi-text">{{ $c['text'] }}</p>

            {{-- Stars + label --}}
            <div class="testi-stars">
                @for($i = 1; $i <= 5; $i++)
                    <svg class="testi-star" width="24" height="23"
                         viewBox="0 0 32 30" fill="none"
                         xmlns="http://www.w3.org/2000/svg">
                        <path d="M13.9238 1.21606C14.6627 -0.0117486 16.4437 -0.0117496 17.1826 1.21606L20.8447 7.30298C21.1926 7.88103 21.7607 8.29333 22.418 8.44556L29.3389 10.0481C30.7346 10.3717 31.284 12.0647 30.3447 13.1467L25.6885 18.511C25.2462 19.0204 25.0296 19.6875 25.0879 20.3596L25.7021 27.4368C25.826 28.8644 24.3859 29.9107 23.0664 29.3518L16.5254 26.5813C15.9042 26.3181 15.2023 26.3181 14.5811 26.5813L8.04004 29.3518C6.72057 29.9108 5.2804 28.8644 5.4043 27.4368L6.01855 20.3596C6.07682 19.6875 5.8602 19.0204 5.41797 18.511L0.760742 13.1467C-0.178424 12.0647 0.371834 10.3716 1.76758 10.0481L8.68848 8.44556C9.34576 8.29333 9.91382 7.88104 10.2617 7.30298L13.9238 1.21606Z"
                              fill="{{ $i <= $c['stars'] ? '#7B51F3' : '#D9D9D9' }}"
                              stroke="{{ $i <= $c['stars'] ? '#7B51F3' : '#D9D9D9' }}"
                              stroke-width="0.590425"/>
                    </svg>
                @endfor
                <span class="testi-excellent">Excellent</span>
            </div>
        </div>
        @endforeach
        </div>
    </div>
</section>
