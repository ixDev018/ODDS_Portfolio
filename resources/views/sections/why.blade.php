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

        {{-- Casino Dealer Control Capsule (Shuffle & Flip All) --}}
        <div class="why-dealer-wrap fade-up">
            <div class="why-dealer-bar" id="why-dealer-bar" role="toolbar" aria-label="Deck dealer controls">
                <button type="button" class="why-dealer-btn" id="why-shuffle-btn" title="Shuffle playing card deck">
                    <svg class="why-dealer-icon" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="16 3 21 3 21 8"></polyline>
                        <line x1="4" y1="20" x2="21" y2="3"></line>
                        <polyline points="21 16 21 21 16 21"></polyline>
                        <line x1="15" y1="15" x2="21" y2="21"></line>
                        <line x1="4" y1="4" x2="9" y2="9"></line>
                    </svg>
                    <span>Shuffle Deck</span>
                </button>
                <div class="why-dealer-divider" aria-hidden="true"></div>
                <button type="button" class="why-dealer-btn" id="why-reveal-btn" title="Reveal or hide all cards">
                    <svg class="why-dealer-icon why-reveal-icon" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                        <circle cx="12" cy="12" r="3"></circle>
                    </svg>
                    <span id="why-reveal-label">Flip All</span>
                </button>
            </div>
        </div>

        <div class="why-deck-wrap" id="why-deck-wrap">
            <div class="why-deck" id="why-deck">
                @foreach($reasonsList as $index => $r)
                @php
                    $theme = $r->accent ?? ($accentThemes[$index % count($accentThemes)]);
                @endphp
                <div class="why-card" data-index="{{ $index }}" style="--card-index: {{ $index }};" role="button" tabindex="0" aria-label="Playing card 0{{ $index + 1 }}: {{ $r->title }}. Click to flip.">
                    <div class="why-card-inner">
                        {{-- Inactive Card Face (Playing Card Back - Default State) --}}
                        <div class="why-card-face why-card-back">
                            <svg viewBox="0 0 394 502" fill="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="why-card-back-svg" aria-hidden="true" preserveAspectRatio="none">
                                <g filter="url(#filter0_i_card_{{ $index }})">
                                    <rect width="394" height="502" rx="26" fill="#3C3C3C"/>
                                </g>
                                <rect class="why-card-svg-border" x="8.33862" y="8.33862" width="377.323" height="485.323" rx="17.7196" stroke="white" stroke-width="16.6772"/>
                                <rect opacity="0.02" x="5.21094" y="8.33862" width="383.577" height="487.81" rx="25" fill="url(#pattern0_card_{{ $index }})"/>
                                <path d="M183.615 242.275C183.715 243.612 184.537 244.787 185.759 245.339L226.397 263.693C228.928 264.836 231.759 262.855 231.553 260.086L229.586 233.636C229.487 232.299 228.665 231.124 227.443 230.572L186.805 212.218C184.274 211.075 181.442 213.056 181.648 215.826L183.615 242.275Z" fill="white"/>
                                <path d="M181.214 247.586C182.283 246.777 183.709 246.617 184.931 247.169L225.569 265.522C228.099 266.665 228.486 270.1 226.272 271.776L205.128 287.788C204.059 288.597 202.634 288.757 201.412 288.205L160.774 269.852C158.243 268.709 157.857 265.274 160.07 263.598L181.214 247.586Z" fill="white"/>
                                <path d="M268.919 251.201C268.919 290.922 236.719 323.122 196.999 323.122C157.278 323.122 125.078 290.922 125.078 251.201C125.078 211.48 157.278 179.28 196.999 179.28C236.719 179.28 268.919 211.48 268.919 251.201ZM140.53 251.201C140.53 282.388 165.812 307.67 196.999 307.67C228.186 307.67 253.468 282.388 253.468 251.201C253.468 220.014 228.186 194.732 196.999 194.732C165.812 194.732 140.53 220.014 140.53 251.201Z" fill="white"/>
                                <defs>
                                    <filter id="filter0_i_card_{{ $index }}" x="-5.21164" y="0" width="399.212" height="509.698" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                                        <feFlood flood-opacity="0" result="BackgroundImageFix"/>
                                        <feBlend mode="normal" in="SourceGraphic" in2="BackgroundImageFix" result="shape"/>
                                        <feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha"/>
                                        <feOffset dx="-5.21164" dy="8.33862"/>
                                        <feGaussianBlur stdDeviation="10.9444"/>
                                        <feComposite in2="hardAlpha" operator="arithmetic" k2="-1" k3="1"/>
                                        <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.5 0"/>
                                        <feBlend mode="normal" in2="shape" result="effect1_innerShadow_307_747"/>
                                    </filter>
                                    <pattern id="pattern0_card_{{ $index }}" patternUnits="userSpaceOnUse" patternTransform="matrix(27.6842 0 0 55.3685 5.21094 8.33862)" preserveAspectRatio="none" viewBox="0 0 26.56 53.12" width="1" height="1">
                                        <use xlink:href="#pattern0_inner_card_{{ $index }}" transform="translate(-26.56 0)"/>
                                        <g id="pattern0_inner_card_{{ $index }}">
                                            <path d="M6.51116 7.00708C6.52222 7.15578 6.6137 7.28655 6.7496 7.34792L11.2699 9.38947C11.5514 9.5166 11.8664 9.29626 11.8435 8.98824L11.6247 6.04618C11.6137 5.89747 11.5222 5.76671 11.3863 5.70533L6.86595 3.66378C6.58445 3.53665 6.26946 3.757 6.29237 4.06502L6.51116 7.00708Z" fill="white"/>
                                            <path d="M6.24639 7.59789C6.36527 7.50787 6.52385 7.49004 6.65975 7.55142L11.1801 9.59296C11.4616 9.7201 11.5045 10.1021 11.2583 10.2886L8.90639 12.0696C8.78751 12.1596 8.62893 12.1775 8.49303 12.1161L3.97269 10.0745C3.69119 9.9474 3.64824 9.56539 3.89448 9.37892L6.24639 7.59789Z" fill="white"/>
                                            <path d="M16 8C16 12.4183 12.4183 16 8 16C3.58172 16 0 12.4183 0 8C0 3.58172 3.58172 0 8 0C12.4183 0 16 3.58172 16 8ZM1.71872 8C1.71872 11.4691 4.53095 14.2813 8 14.2813C11.4691 14.2813 14.2813 11.4691 14.2813 8C14.2813 4.53095 11.4691 1.71872 8 1.71872C4.53095 1.71872 1.71872 4.53095 1.71872 8Z" fill="white"/>
                                        </g>
                                        <use xlink:href="#pattern0_inner_card_{{ $index }}" transform="translate(-13.28 26.56)"/>
                                        <use xlink:href="#pattern0_inner_card_{{ $index }}" transform="translate(13.28 26.56)"/>
                                    </pattern>
                                </defs>
                            </svg>
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

            {{-- Mobile Dynamic Swipe Pill Hint --}}
            <div class="why-swipe-pill-wrap" id="why-swipe-pill-wrap" aria-live="polite">
                <div class="why-swipe-pill" id="why-swipe-pill">
                    <svg class="why-swipe-icon why-swipe-icon-left" id="why-swipe-icon-left" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="display: none;">
                        <line x1="19" y1="12" x2="5" y2="12"></line>
                        <polyline points="12 19 5 12 12 5"></polyline>
                    </svg>
                    <span class="why-swipe-text" id="why-swipe-text">Swipe left to see other cards</span>
                    <svg class="why-swipe-icon why-swipe-icon-right" id="why-swipe-icon-right" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                        <polyline points="12 5 19 12 12 19"></polyline>
                    </svg>
                </div>
            </div>
        </div>
        </div>
    </div>
</section>
