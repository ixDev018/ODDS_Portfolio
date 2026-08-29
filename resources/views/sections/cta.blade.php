<section class="cta" id="cta">
    {{-- Gradient orbs --}}
    <div class="cta-orb cta-orb-1" aria-hidden="true"></div>
    <div class="cta-orb cta-orb-2" aria-hidden="true"></div>
    <div class="cta-orb cta-orb-3" aria-hidden="true"></div>

    <div class="cta-outer">

        <!-- Terminal Window Card -->
        <div class="cta-terminal fade-up">

            <!-- macOS Title Bar -->
            <div class="cta-terminal-bar">
                <span class="dot dot-red"></span>
                <span class="dot dot-yellow"></span>
                <span class="dot dot-green"></span>
            </div>

            <!-- Dark Terminal Body -->
            <div class="cta-terminal-body">
                <!-- Meta info -->
                <div class="cta-meta">
                    <p class="cta-meta-line">{{ $settings->cta_meta_line ?? 'ODDS Development Team 2025. All rights reserved' }}</p>
                    <p class="cta-meta-prompt">{{ $settings->cta_terminal_prompt ?? 'client\ODDS_Project> project init' }}</p>
                </div>

                <!-- Two-column row: content left, graphic right -->
                <div class="cta-row">
                    <div class="cta-content">
                        <h2 class="cta-title">
                            @if(!empty($settings->cta_title))
                                {!! nl2br(e($settings->cta_title)) !!}
                            @else
                                Let's Build<br>Something Real.
                            @endif
                        </h2>

                        <p class="cta-desc">
                            {!! $settings->cta_desc ?? "Tell us what you're facing.<br>Whether you need a quick technical module or an end-to-end package solution, our team is ready to execute. Expect a response with clear next steps within 24 hours." !!}
                        </p>

                        <a href="mailto:{{ $settings->cta_email ?? 'hello@odds.dev' }}" class="cta-btn">Let's Build!</a>
                    </div>

                    <div class="cta-visual">
                        <video id="cta-video-source" style="display: none;" autoplay loop muted playsinline disablePictureInPicture>
                            <source src="{{ asset('assets/img/ascii-animation.mp4') }}" type="video/mp4">
                        </video>
                        <canvas id="cta-video-canvas" class="cta-video"></canvas>
                    </div>
                </div>

                <!-- Footer social bar inside terminal -->
                <div class="cta-terminal-footer">
                    <span>facebook: {{ $settings->cta_facebook ?? 'ODDS Comp.' }}</span>
                    <span>instagram: {{ $settings->cta_instagram ?? 'ODDS Comp.' }}</span>
                    <span>mail: {{ $settings->cta_email ?? 'hello@odds.dev' }}</span>
                    <span>youtube: {{ $settings->cta_youtube ?? 'ODDS Comp.' }}</span>
                    <span>contact: {{ $settings->cta_phone ?? '0999999999' }}</span>
                </div>
            </div>

        </div>

    </div>
</section>
