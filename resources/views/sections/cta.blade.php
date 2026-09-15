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

                        <div class="cta-actions" style="display: flex; align-items: center; gap: 12px; flex-wrap: wrap;">
                            <a href="#contact" class="cta-btn js-open-contact-modal" data-open-contact>Let's Talk & Build</a>
                            <a href="mailto:{{ $settings->cta_email ?? 'oddsdevph@gmail.com' }}" class="cta-btn-email" title="Send direct email" style="display: inline-flex; align-items: center; gap: 8px; padding: 12px 18px; border-radius: 12px; background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.14); color: #cbd5e1; font-size: 0.85rem; font-weight: 600; text-decoration: none; transition: all 0.2s;">
                                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                                    <polyline points="22,6 12,13 2,6"></polyline>
                                </svg>
                                <span>{{ $settings->cta_email ?? 'oddsdevph@gmail.com' }}</span>
                            </a>
                        </div>
                    </div>

                    <div class="cta-visual">
                        <video id="cta-video-source" style="display: none;" autoplay loop muted playsinline disablePictureInPicture>
                            <source src="{{ asset('assets/img/ascii-animation.mp4') }}" type="video/mp4">
                        </video>
                        <canvas id="cta-video-canvas" class="cta-video"></canvas>
                    </div>
                </div>

                <!-- Footer social bar inside terminal -->
                <!-- <div class="cta-terminal-footer">
                    <span>facebook: {{ $settings->cta_facebook ?? 'ODDS Comp.' }}</span>
                    <span>instagram: {{ $settings->cta_instagram ?? 'ODDS Comp.' }}</span>
                    <span>mail: {{ $settings->cta_email ?? 'oddsdevph@gmail.com' }}</span>
                    <span>youtube: {{ $settings->cta_youtube ?? 'ODDS Comp.' }}</span>
                </div> -->
            </div>

        </div>

    </div>
</section>
