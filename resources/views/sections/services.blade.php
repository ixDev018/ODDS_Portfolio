@php
$defaultIcon = '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>';
$serviceItems = isset($services) && count($services) > 0 ? $services : collect([
    (object)['name' => "Software\nDevelopment"],
    (object)['name' => "Web-App\nDevelopment"],
    (object)['name' => "Mobile\nApplications"],
    (object)['name' => "Backend\n& DevOps"],
    (object)['name' => "Game\nDevelopment"],
    (object)['name' => "Hardware\nSolutions"],
]);
@endphp

<section class="services fp-section" id="services">
    <div class="services-glow-left"></div>
    <div class="services-glow-right"></div>
    <div class="sec-inner services-header">
        <p class="sec-label fade-up">Services</p>
        <h2 class="services-title fade-up">
            {!! $settings->services_title ?? 'We are a <strong>COMPLETE PACKAGE</strong>' !!}
        </h2>
    </div>

    <div class="services-cards" id="svc-cards">
        <div class="services-track">
            <div class="services-group">
                @foreach($serviceItems as $svc)
                <div class="svc-card">
                    <div class="svc-icon">{!! !empty($svc->icon_svg) ? $svc->icon_svg : $defaultIcon !!}</div>
                    <p class="svc-card-name" style="white-space:pre-line;">{{ $svc->name }}</p>
                </div>
                @endforeach
            </div>
            <!-- Duplicate group for infinite loop marquee -->
            <div class="services-group" aria-hidden="true">
                @foreach($serviceItems as $svc)
                <div class="svc-card">
                    <div class="svc-icon">{!! !empty($svc->icon_svg) ? $svc->icon_svg : $defaultIcon !!}</div>
                    <p class="svc-card-name" style="white-space:pre-line;">{{ $svc->name }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="sec-inner services-footer">
        <p class="services-desc fade-up">
            {!! nl2br(e($settings->services_desc ?? "Business problems aren't solved by generic templates. Whether you need a standalone\nservice or a fully integrated package, we engineer the exact solution your operations demand.")) !!}
        </p>
        <a href="#cta" class="btn-dark fade-up">Let's Build</a>
    </div>
</section>
