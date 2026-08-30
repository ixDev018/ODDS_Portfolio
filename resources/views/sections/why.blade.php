@php
$reasonsList = isset($whyReasons) && count($whyReasons) > 0 ? $whyReasons : collect([
    (object)[
        'title' => 'Stack-Agnostic Engineering',
        'text' => 'We build what fits your reality. Whether you need ultra-fast native code or a specific language stack, we architect the exact system your business demands.',
        'accent' => 'purple',
    ],
    (object)[
        'title' => 'End-to-End Flexibility',
        'text' => 'A dynamic, multi-service pipeline. Deploy us to solve a single operational bottleneck, or leverage our complete software, design, and hardware capabilities.',
        'accent' => 'pink',
    ],
    (object)[
        'title' => 'Velocity-Driven Delivery',
        'text' => 'No endless planning loops. We map precise sequences and execute aggressively to ship stable, production-ready systems exactly when you need them.',
        'accent' => 'cyan',
    ],
]);

$accentThemes = ['purple', 'pink', 'cyan'];
@endphp

<section class="why" id="why">
    {{-- Gradient orbs --}}
    <div class="why-orb why-orb-1" aria-hidden="true"></div>
    <div class="why-orb why-orb-2" aria-hidden="true"></div>
    <div class="why-orb why-orb-3" aria-hidden="true"></div>

    <div class="sec-inner">
        <div class="why-center">
            <h2 class="why-title fade-up">
                @if(!empty($settings->why_title))
                    {!! $settings->why_title !!}
                @else
                    Why bet on <img src="{{ asset('assets/img/ODDS_logo.svg') }}" alt="ODDS" style="display: inline-block; height: 0.75em; vertical-align: baseline; filter: invert(1); margin-left: 4px;"> ?
                @endif
            </h2>
            <p class="why-desc fade-up">
                {{ $settings->why_desc ?? "Choosing a development partner shouldn't feel like a gamble. We replace slow timelines and bloated frameworks with clean, flexible engineering that delivers." }}
            </p>
        </div>

        <div class="why-deck-wrap">
            <div class="why-deck" id="why-deck">
                @foreach($reasonsList as $index => $r)
                @php
                    $theme = $r->accent ?? ($accentThemes[$index % count($accentThemes)]);
                @endphp
                <div class="why-card scale-in" data-index="{{ $index }}" style="--card-index: {{ $index }};" role="button" tabindex="0" aria-label="Playing card 0{{ $index + 1 }}: {{ $r->title }}. Click to flip.">
                    <div class="why-card-inner">
                        {{-- Inactive Card Face (Playing Card Back - Default State) --}}
                        <div class="why-card-face why-card-back">
                            <img src="{{ asset('assets/img/Card_inactive.svg') }}" alt="ODDS Card {{ $index + 1 }} Inactive" class="why-card-back-svg" draggable="false" loading="lazy">
                            <div class="why-card-hint">
                                <span class="why-hint-pill">
                                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M21.5 2v6h-6M21.34 15.57a10 10 0 1 1-.57-8.38l5.67-5.67"/>
                                    </svg>
                                    <span>Click to flip</span>
                                </span>
                            </div>
                        </div>

                        {{-- Active Card Face (Playing Card Front - Content Revealed on Flip) --}}
                        <div class="why-card-face why-card-front theme-{{ $theme }}">
                            {{-- Flip back prompt / button in top right --}}
                            <div class="why-card-front-hint" aria-hidden="true">
                                <span class="why-front-hint-btn" title="Click to flip card back">
                                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M3 12a9 9 0 1 0 9-9 9.75 9.75 0 0 0-6.74 2.74L3 8"/>
                                        <path d="M3 3v5h5"/>
                                    </svg>
                                </span>
                            </div>

                            {{-- Ambient Corner Glow --}}
                            <div class="why-card-glow" aria-hidden="true"></div>

                            {{-- Title & Body --}}
                            <div class="why-card-content">
                                <div class="why-card-num">0{{ $index + 1 }}</div>
                                <h3 class="why-card-title">{{ $r->title }}</h3>
                                <p class="why-card-text">{{ $r->text }}</p>
                            </div>

                            {{-- Background Tech Grid Watermark --}}
                            <div class="why-card-bg" aria-hidden="true">
                                <img src="{{ asset('assets/img/img_placeholder.svg') }}" alt="" draggable="false">
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            {{-- Mobile Deck Navigation & Controls --}}
            <div class="why-mobile-controls" id="why-mobile-controls">
                <button type="button" class="why-nav-arrow why-nav-prev" id="why-nav-prev" aria-label="Previous pillar">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M15 18l-6-6 6-6"/>
                    </svg>
                </button>

                <div class="why-progress-status">
                    <div class="why-counter">
                        <span class="why-current-idx" id="why-current-idx">01</span>
                        <span class="why-counter-divider">/</span>
                        <span class="why-total-idx">0{{ count($reasonsList) }}</span>
                    </div>
                    <div class="why-segmented-bar" id="why-segmented-bar">
                        @foreach($reasonsList as $index => $r)
                        <span class="why-bar-segment {{ $index === 0 ? 'active' : '' }}" data-segment="{{ $index }}"></span>
                        @endforeach
                    </div>
                </div>

                <button type="button" class="why-nav-arrow why-nav-next" id="why-nav-next" aria-label="Next pillar">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M9 18l6-6-6-6"/>
                    </svg>
                </button>
            </div>

            {{-- Swipe Gesture Hint --}}
            <div class="why-swipe-hint" aria-hidden="true">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M7 16l-4-4m0 0l4-4m-4 4h18M17 8l4 4m0 0l-4 4"/>
                </svg>
                <span>Swipe left or right to explore</span>
            </div>
        </div>
    </div>
</section>
