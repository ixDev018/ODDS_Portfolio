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
        <div class="why-main-stage" id="why-main-stage">
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

        <div class="why-deck-wrap" id="why-deck-wrap">
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

                            {{-- Background Geometric Tech Wireframe Watermark --}}
                            <div class="why-card-bg" aria-hidden="true">
                                @if($theme === 'purple' || $index === 0)
                                    {{-- Stack-Agnostic: Isometric Layers / Modular Cube Wireframe --}}
                                    <svg viewBox="0 0 160 160" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full h-full opacity-60">
                                        <g stroke="#7B51F3" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round">
                                            <!-- Top Layer -->
                                            <path d="M80 15L135 45L80 75L25 45Z" fill="#7B51F3" fill-opacity="0.06"/>
                                            <path d="M80 35L107 50L80 65L53 50Z" stroke-dasharray="2 3"/>
                                            <!-- Mid Layer -->
                                            <path d="M80 50L135 80L80 110L25 80Z" fill="#7B51F3" fill-opacity="0.04"/>
                                            <!-- Bottom Layer -->
                                            <path d="M80 85L135 115L80 145L25 115Z" fill="#7B51F3" fill-opacity="0.08"/>
                                            <!-- Connecting Nodes -->
                                            <line x1="80" y1="15" x2="80" y2="145" stroke-dasharray="3 4"/>
                                            <line x1="135" y1="45" x2="135" y2="115"/>
                                            <line x1="25" y1="45" x2="25" y2="115"/>
                                            <!-- Tech crosshairs -->
                                            <circle cx="80" cy="75" r="3" fill="#7B51F3" fill-opacity="0.4"/>
                                            <circle cx="135" cy="80" r="2.5" fill="#7B51F3" fill-opacity="0.5"/>
                                            <circle cx="25" cy="80" r="2.5" fill="#7B51F3" fill-opacity="0.5"/>
                                        </g>
                                    </svg>
                                @elseif($theme === 'pink' || $index === 1)
                                    {{-- End-to-End Flexibility: Dynamic Concentric Nodes & Interconnected Mesh --}}
                                    <svg viewBox="0 0 160 160" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full h-full opacity-60">
                                        <g stroke="#F359B0" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round">
                                            <!-- Concentric rings -->
                                            <circle cx="100" cy="100" r="65" stroke-dasharray="4 4" fill="#F359B0" fill-opacity="0.03"/>
                                            <circle cx="100" cy="100" r="45" stroke-opacity="0.7"/>
                                            <circle cx="100" cy="100" r="25" stroke-dasharray="2 3" fill="#F359B0" fill-opacity="0.06"/>
                                            <circle cx="100" cy="100" r="8" fill="#F359B0" fill-opacity="0.4"/>
                                            <!-- Orbital Axis Nodes -->
                                            <line x1="20" y1="100" x2="160" y2="100" stroke-dasharray="3 4"/>
                                            <line x1="100" y1="20" x2="100" y2="160" stroke-dasharray="3 4"/>
                                            <line x1="43" y1="43" x2="145" y2="145" stroke-opacity="0.4"/>
                                            <circle cx="145" cy="100" r="3" fill="#F359B0"/>
                                            <circle cx="100" cy="55" r="3" fill="#F359B0"/>
                                            <circle cx="68" cy="68" r="2" fill="#F359B0"/>
                                        </g>
                                    </svg>
                                @else
                                    {{-- Velocity-Driven Delivery: High-Speed Cyber Matrix & Accelerated Vectors --}}
                                    <svg viewBox="0 0 160 160" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full h-full opacity-60">
                                        <g stroke="#00B4D8" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round">
                                            <!-- Perspective Grid Mesh -->
                                            <path d="M10 150L150 150L130 90L30 90Z" fill="#00B4D8" fill-opacity="0.05"/>
                                            <line x1="30" y1="90" x2="10" y2="150"/>
                                            <line x1="60" y1="90" x2="50" y2="150"/>
                                            <line x1="90" y1="90" x2="90" y2="150"/>
                                            <line x1="115" y1="90" x2="130" y2="150"/>
                                            <line x1="130" y1="90" x2="150" y2="150"/>
                                            <line x1="20" y1="120" x2="140" y2="120" stroke-dasharray="3 3"/>
                                            <!-- Velocity Chevrons -->
                                            <path d="M90 20L135 65L90 110" stroke-width="1.8" stroke-opacity="0.8"/>
                                            <path d="M65 35L100 70L65 105" stroke-opacity="0.5" stroke-dasharray="2 3"/>
                                            <path d="M45 50L70 75L45 100" stroke-opacity="0.3"/>
                                            <!-- Fast telemetry pulse -->
                                            <circle cx="135" cy="65" r="3" fill="#00B4D8"/>
                                        </g>
                                    </svg>
                                @endif
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
    </div>
</section>
