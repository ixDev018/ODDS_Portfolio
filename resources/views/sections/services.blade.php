@php
$defaultServices = [
    [
        'name' => "Software\nDevelopment",
        'tagline' => 'Logic. Built to last.',
        'icon' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><polyline points="16 18 22 12 16 6"></polyline><polyline points="8 6 2 12 8 18"></polyline><line x1="14" y1="4" x2="10" y2="20"></line></svg>'
    ],
    [
        'name' => "Web-App\nDevelopment",
        'tagline' => 'Live. Fast. Yours.',
        'icon' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="3" width="20" height="14" rx="2" ry="2"></rect><line x1="8" y1="21" x2="16" y2="21"></line><line x1="12" y1="17" x2="12" y2="21"></line><line x1="2" y1="8" x2="22" y2="8"></line></svg>'
    ],
    [
        'name' => "Mobile\nApplications",
        'tagline' => 'Pocket-sized. Full power.',
        'icon' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><rect x="5" y="2" width="14" height="20" rx="3" ry="3"></rect><line x1="12" y1="18" x2="12.01" y2="18"></line><line x1="10" y1="5" x2="14" y2="5"></line></svg>'
    ],
    [
        'name' => "Backend\n& DevOps",
        'tagline' => 'Invisible. Unbreakable.',
        'icon' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="2" width="20" height="8" rx="2" ry="2"></rect><rect x="2" y="14" width="20" height="8" rx="2" ry="2"></rect><line x1="6" y1="6" x2="6.01" y2="6"></line><line x1="6" y1="18" x2="6.01" y2="18"></line></svg>'
    ],
    [
        'name' => "Game\nDevelopment",
        'tagline' => 'Play, on purpose.',
        'icon' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><line x1="6" y1="12" x2="10" y2="12"></line><line x1="8" y1="10" x2="8" y2="14"></line><circle cx="15" cy="13" r="1"></circle><circle cx="18" cy="11" r="1"></circle><rect x="2" y="6" width="20" height="12" rx="6"></rect></svg>'
    ],
    [
        'name' => "Hardware\nSolutions",
        'tagline' => 'Circuits with a pulse.',
        'icon' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><rect x="4" y="4" width="16" height="16" rx="2" ry="2"></rect><rect x="9" y="9" width="6" height="6"></rect><line x1="9" y1="1" x2="9" y2="4"></line><line x1="15" y1="1" x2="15" y2="4"></line><line x1="9" y1="20" x2="9" y2="23"></line><line x1="15" y1="20" x2="15" y2="23"></line><line x1="20" y1="9" x2="23" y2="9"></line><line x1="20" y1="15" x2="23" y2="15"></line><line x1="1" y1="9" x2="4" y2="9"></line><line x1="1" y1="15" x2="4" y2="15"></line></svg>'
    ],
];

$defaultMap = [];
foreach ($defaultServices as $ds) {
    $key = trim(str_replace(["\r\n", "\r", "\n"], ' ', $ds['name']));
    $defaultMap[$key] = $ds;
}

$serviceItems = isset($services) && count($services) > 0 ? $services : collect(array_map(fn($s) => (object)$s, $defaultServices));
@endphp

<section class="services" id="services">
    <div class="services-glow-left"></div>
    <div class="services-glow-right"></div>

    <div class="sec-inner services-header">
        <p class="sec-label fade-up">Services</p>
        <h2 class="services-title fade-up">
            @php
                $titleRaw = $settings->services_title ?? "The odds are, we've already built something like it.";
                if (stripos($titleRaw, 'COMPLETE PACKAGE') !== false) {
                    $titleRaw = "The odds are, we've already built something like it.";
                }
                $formattedTitle = preg_replace('/\b(odds)\b/i', '<span class="services-odds-word">$1</span>', e($titleRaw));
            @endphp
            {!! $formattedTitle !!}
        </h2>
        <p class="services-subline fade-up">
            {!! nl2br(e($settings->services_subline ?? "Software, apps, backend, games, hardware — chances are, whatever you're building, we've built its cousin before.")) !!}
        </p>
    </div>

    <div class="services-cards" id="svc-cards">
        <div class="services-track">
            <div class="services-group">
                @foreach($serviceItems as $index => $svc)
                @php
                    $cleanName = trim(str_replace(["\r\n", "\r", "\n"], ' ', $svc->name));
                    $itemConfig = $defaultMap[$cleanName] ?? null;
                    $displayName = !empty($svc->name) ? $svc->name : ($itemConfig['name'] ?? $cleanName);
                    $iconSvg = !empty($svc->icon_svg) ? $svc->icon_svg : ($itemConfig['icon'] ?? '');
                    $tagline = $svc->tagline ?? ($itemConfig['tagline'] ?? 'Engineering Service');
                @endphp
                <div class="svc-card service-card-trigger"
                     data-service-index="{{ $index }}"
                     data-service-id="{{ $svc->id ?? $index }}"
                     data-service-name="{{ $displayName }}"
                     data-service-tagline="{{ $tagline }}"
                     data-service-desc="{{ $svc->description ?? '' }}"
                     data-service-cover="{{ $svc->cover_image_url ?? ($svc->cover_image ?? '') }}"
                     data-service-path="ODDS_Studio/Services/{{ \Illuminate\Support\Str::studly($cleanName) }}/Overview">
                    <div class="svc-icon">{!! $iconSvg !!}</div>
                    <h3 class="svc-card-name" style="white-space:pre-line;">{{ $displayName }}</h3>
                </div>
                @endforeach
            </div>
            <!-- Duplicate group for infinite loop marquee -->
            <div class="services-group" aria-hidden="true">
                @foreach($serviceItems as $index => $svc)
                @php
                    $cleanName = trim(str_replace(["\r\n", "\r", "\n"], ' ', $svc->name));
                    $itemConfig = $defaultMap[$cleanName] ?? null;
                    $displayName = !empty($svc->name) ? $svc->name : ($itemConfig['name'] ?? $cleanName);
                    $iconSvg = !empty($svc->icon_svg) ? $svc->icon_svg : ($itemConfig['icon'] ?? '');
                    $tagline = $svc->tagline ?? ($itemConfig['tagline'] ?? 'Engineering Service');
                @endphp
                <div class="svc-card service-card-trigger"
                     data-service-index="{{ $index }}"
                     data-service-id="{{ $svc->id ?? $index }}"
                     data-service-name="{{ $displayName }}"
                     data-service-tagline="{{ $tagline }}"
                     data-service-desc="{{ $svc->description ?? '' }}"
                     data-service-cover="{{ $svc->cover_image_url ?? ($svc->cover_image ?? '') }}"
                     data-service-path="ODDS_Studio/Services/{{ \Illuminate\Support\Str::studly($cleanName) }}/Overview">
                    <div class="svc-icon">{!! $iconSvg !!}</div>
                    <h3 class="svc-card-name" style="white-space:pre-line;">{{ $displayName }}</h3>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="sec-inner services-footer">
        <a href="#cta" class="btn-dark fade-up">Let's Build</a>
    </div>
</section>

{{-- High-fidelity JSON Data Payload for Services Modal Stories --}}
<script type="application/json" id="odds-services-data">
{!! json_encode($serviceItems->map(function($svc, $idx) use ($defaultMap) {
    $cleanName = trim(str_replace(["\r\n", "\r", "\n"], ' ', $svc->name ?? ''));
    $itemConfig = $defaultMap[$cleanName] ?? null;
    $rawBlocks = $svc->body_content ?? [];
    if (is_string($rawBlocks)) {
        $decoded = json_decode($rawBlocks, true);
        $rawBlocks = is_array($decoded) ? $decoded : [];
    }
    $svcFeatures = $svc->features ?? null;
    $featuresArr = is_array($svcFeatures) ? $svcFeatures : (is_string($svcFeatures) ? (json_decode($svcFeatures, true) ?? []) : ($itemConfig['features'] ?? []));
    return [
        'id' => $svc->id ?? ($idx + 1),
        'name' => $svc->name ?? 'ODDS Service',
        'clean_name' => $cleanName,
        'tagline' => $svc->tagline ?? ($itemConfig['tagline'] ?? 'Engineering Service'),
        'description' => $svc->description ?? '',
        'icon_svg' => !empty($svc->icon_svg ?? null) ? $svc->icon_svg : ($itemConfig['icon'] ?? ''),
        'cover_image' => $svc->cover_image_url ?? ($svc->cover_image ?? ''),
        'features' => $featuresArr,
        'body_content' => $rawBlocks,
        'action_btn_text' => $svc->action_btn_text ?? "Let's Build",
        'action_btn_url' => $svc->action_btn_url ?? '#cta',
        'path_str' => 'ODDS_Studio/Services/' . \Illuminate\Support\Str::studly($cleanName ?: 'Service') . '/Overview',
    ];
})->values()) !!}
</script>

{{-- Service Detail Modal --}}
@include('components.service-modal')
