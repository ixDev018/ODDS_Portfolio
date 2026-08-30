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
                @php
                    $rawWhyDesc = $settings->why_desc ?? "Choosing a development partner shouldn't feel like a gamble. We replace slow timelines and bloated frameworks with clean, flexible engineering that delivers.";
                    $escapedWhyDesc = e($rawWhyDesc);
                    $highlightSvg = '<span class="draw-highlight-wrap">clean, flexible engineering<svg class="draw-highlight-svg" viewBox="0 0 240 14" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M 2 10 C 60 2, 130 11, 238 4" stroke="#875af5" stroke-width="2.5" stroke-linecap="round" vector-effect="non-scaling-stroke"/></svg></span>';
                    $formattedWhyDesc = str_replace('clean, flexible engineering', $highlightSvg, $escapedWhyDesc);
                @endphp
                {!! $formattedWhyDesc !!}
            </p>
        </div>

        <div class="why-deck-wrap">
            <div class="why-deck" id="why-deck">
                @foreach($reasonsList as $index => $r)
                @php
                    $theme = $r->accent ?? ($accentThemes[$index % count($accentThemes)]);
                @endphp
                <div class="why-card scale-in theme-{{ $theme }}" data-index="{{ $index }}" style="--card-index: {{ $index }};">
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
                        <img src="{{ asset('assets/img/img_placeholder.svg') }}" alt="">
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
