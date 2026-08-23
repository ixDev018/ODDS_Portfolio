@php
$imgSvgWhy = '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>';
$reasons = [
    ['label' => '', 'title' => 'Stack-Agnostic Engineering',
     'text'  => 'We build what fits your reality. Whether you need ultra-fast native code or a specific language stack, we architect the exact system your business demands.'],
    ['label' => '', 'title' => 'End-to-End Flexibility',
     'text'  => 'A dynamic, multi-service pipeline. Deploy us to solve a single operational bottleneck, or leverage our complete software, design, and hardware capabilities.'],
    ['label' => '', 'title' => 'Velocity-Driven Delivery',
     'text'  => 'No endless planning loops. We map precise sequences and execute aggressively to ship stable, production-ready systems exactly when you need them.'],
];
@endphp

<section class="why fp-section" id="why">
    {{-- Gradient orbs --}}
    <div class="why-orb why-orb-1" aria-hidden="true"></div>
    <div class="why-orb why-orb-2" aria-hidden="true"></div>
    <div class="why-orb why-orb-3" aria-hidden="true"></div>

    <div class="sec-inner">
        <div class="why-center">
            <h2 class="why-title fade-up">Why bet on <img src="{{ asset('assets/img/ODDS_logo.svg') }}" alt="ODDS" style="display: inline-block; height: 0.75em; vertical-align: baseline; filter: invert(1); margin-left: 4px;"> ?</h2>
            <p class="why-desc fade-up">
                Choosing a development partner shouldn't feel like a gamble. We replace slow
                timelines and bloated frameworks with clean, flexible engineering that delivers.
            </p>
        </div>

        <div class="why-grid">
            @foreach($reasons as $r)
            <div class="why-card scale-in">
                <div class="why-card-bg"><img src="{{ asset('assets/img/img_placeholder.svg') }}" alt=""></div>
                <p class="why-card-title">{{ $r['title'] }}</p>
                <p class="why-card-text">{{ $r['text'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>
