<section class="hero fp-section" id="hero">
    <div class="shared-glow-left" aria-hidden="true"></div>
    <div class="shared-glow-right" aria-hidden="true"></div>
    <div class="hero-content">
        <h1 class="hero-title fade-up" id="hero-h1">
            {!! nl2br(e($settings->hero_title ?? "We build what your\nbusiness needs FAST")) !!}
        </h1>
        <p class="hero-subtitle fade-up" id="hero-p">
            {{ $settings->hero_subtitle ?? "Driven by technical excellence and a commitment to discomfort-driven growth, we rapidly execute our deployment sequences. At the end of the day, our mission is simple: we ship." }}
        </p>
        <a href="{{ $settings->hero_btn_link ?? '#cta' }}" class="btn-hero fade-up" id="hero-btn">
            {{ $settings->hero_btn_text ?? "Let's Build" }}
        </a>
    </div>
</section>
