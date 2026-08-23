@php
$reasonsList = isset($whyReasons) && count($whyReasons) > 0 ? $whyReasons : collect([
    (object)['title' => 'Stack-Agnostic Engineering', 'text' => 'We build what fits your reality. Whether you need ultra-fast native code or a specific language stack, we architect the exact system your business demands.'],
    (object)['title' => 'End-to-End Flexibility', 'text' => 'A dynamic, multi-service pipeline. Deploy us to solve a single operational bottleneck, or leverage our complete software, design, and hardware capabilities.'],
    (object)['title' => 'Velocity-Driven Delivery', 'text' => 'No endless planning loops. We map precise sequences and execute aggressively to ship stable, production-ready systems exactly when you need them.'],
]);
@endphp

<section class="why fp-section" id="why">
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
                {{ $settings->why_desc ?? "Choosing a development partner shouldn't feel like a gamble. We replace slow timelines and bloated frameworks with clean, flexible engineering that delivers." }}
            </p>
        </div>

        <div class="why-grid">
            @foreach($reasonsList as $r)
            <div class="why-card scale-in">
                <div class="why-card-bg"><img src="{{ asset('assets/img/img_placeholder.svg') }}" alt=""></div>
                <p class="why-card-title">{{ $r->title }}</p>
                <p class="why-card-text">{{ $r->text }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>
