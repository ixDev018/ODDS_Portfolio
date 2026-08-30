@php
$processPhases = [
    [
        'number' => '01',
        'eyebrow' => 'DISCOVERY + PROPOSAL',
        'headline' => 'Talk & Plan',
        'body' => 'We start with a 1-on-1 to understand what you need, what you already know, your current process, and your tech stack preference — or you can leave that decision to us. From there, we put together a draft and come back with a clear proposal covering scope and approach.',
        'image' => asset('assets/img/process/phase-01-discovery.jpg'),
        'alt' => 'ODDS Discovery & Planning Session with Client',
        'theme' => 'pink',
    ],
    [
        'number' => '02',
        'eyebrow' => 'EXECUTION + CHECK-INS',
        'headline' => 'Build',
        'body' => 'Once aligned, we execute — velocity-driven, no bloated planning loops. Regular check-ins happen throughout so nothing drifts and you always know where things stand.',
        'image' => asset('assets/img/process/phase-02-build.jpg'),
        'alt' => 'Active High-Velocity Software Engineering Workspace',
        'theme' => 'purple',
    ],
    [
        'number' => '03',
        'eyebrow' => 'DELIVERY + OWNERSHIP',
        'headline' => 'Launch & Handoff',
        'body' => 'We ship, and hand over what\'s needed — code, docs, ownership.',
        'image' => asset('assets/img/process/phase-03-launch.jpg'),
        'alt' => 'Product Launch Deployment and Client Handoff',
        'theme' => 'cyan',
    ],
];
@endphp

<section class="process" id="process">
    {{-- Ambient light background orbs --}}
    <div class="process-orb process-orb-1" aria-hidden="true"></div>
    <div class="process-orb process-orb-2" aria-hidden="true"></div>

    <div class="process-content-wrap">
        {{-- Section Header --}}
        <div class="process-center">
            <p class="process-label fade-up">Our Process</p>
            <h2 class="process-title fade-up">
                How We Take You From Zero to Shipped.
            </h2>
            <p class="process-desc fade-up">
                A streamlined, battle-tested execution pipeline with zero wasted motion. Built on real internal agility, not generic agency bureaucracy.
            </p>
        </div>

        {{-- Editorial Zigzag Sequence (3 Phases) --}}
        <div class="process-editorial-feed">
            @foreach($processPhases as $idx => $phase)
            @php
                $isFlipped = ($idx % 2 === 1);
            @endphp
            <div class="process-phase-block fade-up {{ $isFlipped ? 'is-flipped' : '' }} phase-{{ $phase['number'] }}" data-phase="{{ $phase['number'] }}">
                
                {{-- Text Content Side with Vertical Eyebrow Strip --}}
                <div class="process-phase-content-side">
                    <div class="process-eyebrow-spine" aria-hidden="true">
                        <span class="process-eyebrow-text">{{ $phase['eyebrow'] }}</span>
                    </div>

                    <div class="process-phase-text-body">
                        {{-- Prominent Anchor Number --}}
                        <div class="process-phase-num-wrap">
                            <span class="process-phase-num">{{ $phase['number'] }}</span>
                        </div>

                        {{-- Phase Headline --}}
                        <h3 class="process-phase-headline">{{ $phase['headline'] }}</h3>

                        {{-- Phase Body Copy --}}
                        <p class="process-phase-body-text">{{ $phase['body'] }}</p>
                    </div>
                </div>

                {{-- Visual Image Side (Rounded Square/Portrait Editorial Image) --}}
                <div class="process-phase-media-side">
                    <div class="process-image-frame">
                        <div class="process-image-glow" aria-hidden="true"></div>
                        <img src="{{ $phase['image'] }}" alt="{{ $phase['alt'] }}" class="process-editorial-img" loading="lazy">
                        <div class="process-image-tint" aria-hidden="true"></div>
                        <div class="process-image-tag">
                            <span>PHASE // {{ $phase['number'] }}</span>
                        </div>
                    </div>
                </div>

            </div>
            @endforeach
        </div>

        {{-- Bottom CTA Action --}}
        <div class="process-footer fade-up">
            <a href="#cta" class="works-see-more">
                Let's Get Started
            </a>
        </div>
    </div>
</section>


