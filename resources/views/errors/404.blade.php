<x-layout>
    @push('styles')
        <style>
            html, body {
                background-color: #0e0e0e !important;
                color: #fff;
            }
            .error-section {
                background: #0e0e0e;
                min-height: 100vh;
                min-height: 100dvh;
                padding: calc(10vh + 30px) 24px 60px;
                position: relative;
                overflow: hidden;
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                box-sizing: border-box;
            }
            .error-terminal {
                max-width: 820px;
                width: 100%;
                margin: 0 auto;
                position: relative;
                z-index: 10;
            }
            .error-terminal .cta-terminal-body {
                padding: 48px 56px 36px;
            }
            .error-terminal .cta-title {
                margin-bottom: 18px;
            }
            .error-terminal .cta-desc {
                margin-bottom: 28px;
                max-width: 600px;
            }
            .error-meta-prompt span.error-code {
                color: #ff5f56;
                font-weight: 700;
            }
            @media (max-width: 768px) {
                .error-terminal .cta-terminal-body {
                    padding: 32px 24px 24px;
                }
            }
        </style>
    @endpush

    <section class="error-section">
        {{-- Gradient orbs --}}
        <div class="cta-orb cta-orb-1" aria-hidden="true"></div>
        <div class="cta-orb cta-orb-2" aria-hidden="true"></div>
        <div class="cta-orb cta-orb-3" aria-hidden="true"></div>

        <div class="error-terminal fade-up">
            <!-- Terminal Window Card -->
            <div class="cta-terminal">

                <!-- macOS Title Bar -->
                <div class="cta-terminal-bar" style="justify-content: space-between;">
                    <div style="display: flex; align-items: center; gap: 10px;">
                        <span class="dot dot-red"></span>
                        <span class="dot dot-yellow"></span>
                        <span class="dot dot-green"></span>
                    </div>
                    <span style="font-family: var(--font-mono); font-size: 12px; color: #71717a; font-weight: 500; letter-spacing: -0.01em;">bash — 404: route_not_found</span>
                </div>

                <!-- Dark Terminal Body -->
                <div class="cta-terminal-body">
                    <!-- Meta info -->
                    <div class="cta-meta">
                        <p class="cta-meta-line">system://odds/router</p>
                        <p class="cta-meta-prompt error-meta-prompt">
                            GET {{ request()->getRequestUri() }} &gt; <span class="error-code">404 Not Found</span>
                        </p>
                    </div>

                    <h1 class="cta-title">
                        404 — Route Not Found
                    </h1>

                    <p class="cta-desc">
                        This endpoint doesn't exist, or it got deprecated somewhere between sprints. Let's get you back to something that ships.
                    </p>

                    <div>
                        <a href="{{ url('/') }}" class="cta-btn">
                            return to base
                        </a>
                    </div>

                    <!-- Terminal Footer -->
                    <div class="cta-terminal-footer" style="margin-top: 36px;">
                        <span>status: 404_NOT_FOUND</span>
                        <span>stack: odds-runtime</span>
                        <span>exit_code: 1</span>
                    </div>
                </div>

            </div>
        </div>
    </section>
</x-layout>
