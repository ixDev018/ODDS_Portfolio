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
                <div class="cta-terminal-dots">
                    <span class="dot dot-red"></span>
                    <span class="dot dot-yellow"></span>
                    <span class="dot dot-green"></span>
                </div>
                <div class="cta-terminal-title">bash — odds@client: ~/project-init</div>
                <div class="cta-terminal-status">
                    <span class="cta-status-indicator"></span>
                    <span>ONLINE</span>
                </div>
            </div>

            <!-- Dark Terminal Body -->
            <div class="cta-terminal-body">
                <!-- Top Row: Meta Copyright (2026) -->
                <div class="cta-top-row">
                    <p class="cta-top-meta-line">{{ str_replace('2025', '2026', $settings->cta_meta_line ?? 'ODDS Development Team 2026. All rights reserved') }}</p>
                </div>

                <!-- CLI Banner: Pink ASCII Art for ODDS + Telemetry -->
                <div class="cta-cli-banner">
                    <div class="cta-ascii-wrapper">
                        <pre class="cta-ascii-art" aria-label="ODDS">
 ██████╗  ██████╗  ██████╗  ███████╗
██╔═══██╗ ██╔══██╗ ██╔══██╗ ██╔════╝
██║   ██║ ██║  ██║ ██║  ██║ ███████╗
██║   ██║ ██║  ██║ ██║  ██║ ╚════██║
╚██████╔╝ ██████╔╝ ██████╔╝ ███████║
 ╚═════╝  ╚═════╝  ╚═════╝  ╚══════╝</pre>
                        <div class="cta-ascii-tagline">
                            <span class="cta-tagline-prompt">//</span>
                            @if(!empty($settings->cta_title))
                                <span class="cta-tagline-text">{!! e(str_replace(["\r\n", "\n", "<br>", "<br/>", "<br />"], " ", $settings->cta_title)) !!}</span>
                            @else
                                <span class="cta-tagline-text">Let's Build Something Real.</span>
                            @endif
                        </div>
                    </div>

                    <!-- Live System Telemetry Grid (Option 4: Interactive Functional Readout) -->
                    <div class="cta-cli-telemetry-grid">
                        <div class="cta-telem-item">
                            <span class="cta-telem-key">sys.studio</span>
                            <span class="cta-telem-sep">:</span>
                            <span class="cta-telem-val">
                                Manila, PH <span class="cta-telem-tag text-green"><span class="cta-telem-pulse"></span> ACTIVE NOW</span>
                            </span>
                        </div>
                        <div class="cta-telem-item">
                            <span class="cta-telem-key">sys.ping</span>
                            <span class="cta-telem-sep">:</span>
                            <span class="cta-telem-val">
                                <span id="cta-live-ping">18ms</span> <span class="cta-telem-tag text-cyan">OPTIMAL</span>
                            </span>
                        </div>
                        <div class="cta-telem-item">
                            <span class="cta-telem-key">sys.dispatch</span>
                            <span class="cta-telem-sep">:</span>
                            <span class="cta-telem-val text-pink">&lt; 24h SLA GUARANTEE</span>
                        </div>
                        <div class="cta-telem-item">
                            <span class="cta-telem-key">sys.agent</span>
                            <span class="cta-telem-sep">:</span>
                            <span class="cta-telem-val">
                                Lorenzo
                                <button type="button" id="cta-open-chat-btn" class="cta-telem-btn cta-telem-btn-chat" title="Open live chat with Lorenzo">
                                    [ Chat with AI ↗ ]
                                </button>
                            </span>
                        </div>
                        <div class="cta-telem-item">
                            <span class="cta-telem-key">sys.email</span>
                            <span class="cta-telem-sep">:</span>
                            <span class="cta-telem-val">
                                <span class="cta-email-text">{{ $settings->cta_email ?? 'oddsdevph@gmail.com' }}</span>
                                <button type="button" id="cta-copy-email-btn" class="cta-telem-btn cta-telem-btn-copy" data-email="{{ $settings->cta_email ?? 'oddsdevph@gmail.com' }}" title="Copy email address to clipboard">
                                    <span class="cta-copy-label">[ Copy ]</span>
                                </button>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="cta-cli-divider"></div>

                <!-- Meta Prompt & Content -->
                <div class="cta-main-block">
                    <div class="cta-meta">
                        <p class="cta-meta-prompt">
                            <span class="cta-prompt-symbol">&gt;</span> {{ $settings->cta_terminal_prompt ?? 'client\ODDS_Project> project init --exec' }}
                        </p>
                    </div>

                    <div class="cta-content">
                        <div class="cta-terminal-dialogue">
                            <div class="cta-speaker-header">
                                <span class="cta-speaker-dot"></span>
                                <span class="cta-speaker-name">Lorenzo:</span>
                            </div>
                            <div class="cta-speaker-message">
                                &ldquo;{!! $settings->cta_desc ?? "Tell us what you're facing. Whether you need a quick technical module or an end-to-end package solution, our team is ready to execute. Expect a response with clear next steps within 24 hours." !!}&rdquo;
                            </div>
                        </div>

                        <div class="cta-actions-prompt">
                            <span class="cta-actions-label">&gt; select dispatch action:</span>
                        </div>

                        <div class="cta-actions">
                            <a href="#contact" class="cta-btn cta-btn-primary js-open-contact-modal" data-open-contact>
                                <span class="cta-btn-chevron">&gt;</span> Let's Talk &amp; Build
                            </a>
                            <a href="mailto:{{ $settings->cta_email ?? 'oddsdevph@gmail.com' }}" class="cta-btn" title="Send direct email">
                                <span class="cta-btn-chevron">&gt;</span> {{ $settings->cta_email ?? 'oddsdevph@gmail.com' }}
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Interactive Terminal Footer Prompt -->
                <div class="cta-cli-footer">
                    <span class="cta-footer-path">guest@odds:~$</span>
                    <span class="cta-footer-command">odds deploy --interactive</span>
                    <span class="cta-cursor" aria-hidden="true">█</span>
                </div>
            </div>

        </div>

    </div>
</section>
