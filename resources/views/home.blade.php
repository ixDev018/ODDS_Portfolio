<x-layout>
    <div class="fp-container" id="fp-container">
        {{-- Cyberpunk Digital Aperture & Chroma Shift Overlay --}}
        <div class="fp-overlay" id="fp-overlay" aria-hidden="true">
            <div class="cyber-stage" id="cyber-stage">
                {{-- Chromatic Aberration RGB Glitch Flashes --}}
                <div class="cyber-glitch-layer rgb-cyan"></div>
                <div class="cyber-glitch-layer rgb-pink"></div>
                <div class="cyber-scanlines"></div>

                {{-- 8 Diagonal Kinetic Shear Blades with HUD Accents --}}
                <div class="cyber-blades-wrap">
                    @for ($b = 0; $b < 8; $b++)
                        <div class="cyber-blade blade-{{ $b }}" data-blade="{{ $b }}">
                            <div class="cyber-blade-surface"></div>
                            <div class="cyber-blade-hud">
                                <span class="cyber-hud-code">ODDS // 0{{ $b + 1 }}</span>
                                <div class="cyber-hud-line"></div>
                            </div>
                        </div>
                    @endfor
                </div>
            </div>
        </div>

        {{-- All 6 Full-Page Sections --}}
        @include('sections.hero')
        @include('sections.services')
        @include('sections.works')
        @include('sections.testimonials')
        @include('sections.why')
        @include('sections.cta')
    </div>

    <x-odds-chat-widget />
</x-layout>
