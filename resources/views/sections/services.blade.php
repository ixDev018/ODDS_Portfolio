@php
$imgIcon = '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>';
$services = [
    ['name' => "Software\nDevelopment"],
    ['name' => "Web-App\nDevelopment"],
    ['name' => "Mobile\nApplications"],
    ['name' => "Backend\n& DevOps"],
    ['name' => "Game\nDevelopment"],
    ['name' => "Hardware\nSolutions"],
];
@endphp

<section class="services" id="services">
    <div class="sec-inner services-header">
        <p class="sec-label fade-up">Services</p>
        <h2 class="services-title fade-up">We are a <strong>COMPLETE PACKAGE</strong></h2>
    </div>

    <div class="services-cards" id="svc-cards">
        @foreach($services as $svc)
        <div class="svc-card scale-in">
            <div class="svc-icon">{!! $imgIcon !!}</div>
            <p class="svc-card-name" style="white-space:pre-line;">{{ $svc['name'] }}</p>
        </div>
        @endforeach
    </div>

    <div class="sec-inner services-footer">
        <p class="services-desc fade-up">
            Business problems aren't solved by generic templates. Whether you need a standalone
            service or a fully integrated package, we engineer the exact solution your operations demand.
        </p>
        <a href="#cta" class="btn-dark fade-up">Let's Build</a>
    </div>
</section>
