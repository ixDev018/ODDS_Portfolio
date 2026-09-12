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

$serviceThemes = [
    'software' => [
        'color' => '#6366F1',
        'bg' => 'rgba(99, 102, 241, 0.08)',
        'border' => 'rgba(99, 102, 241, 0.22)',
        'svg' => '<svg viewBox="0 0 120 120" fill="none" xmlns="http://www.w3.org/2000/svg"><rect x="25" y="25" width="80" height="80" rx="8" stroke="#6366F1" stroke-width="1.2" stroke-dasharray="3 3" opacity="0.4"/><path d="M40 50L52 62L40 74" stroke="#6366F1" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" opacity="0.6"/><line x1="58" y1="74" x2="72" y2="74" stroke="#6366F1" stroke-width="1.8" stroke-linecap="round" opacity="0.6"/><circle cx="85" cy="40" r="3" fill="#6366F1" opacity="0.5"/></svg>'
    ],
    'web' => [
        'color' => '#06B6D4',
        'bg' => 'rgba(6, 182, 212, 0.08)',
        'border' => 'rgba(6, 182, 212, 0.22)',
        'svg' => '<svg viewBox="0 0 120 120" fill="none" xmlns="http://www.w3.org/2000/svg"><rect x="15" y="20" width="90" height="75" rx="6" stroke="#06B6D4" stroke-width="1.2" opacity="0.45"/><line x1="15" y1="36" x2="105" y2="36" stroke="#06B6D4" stroke-width="1" opacity="0.4"/><circle cx="26" cy="28" r="2.5" fill="#06B6D4" opacity="0.6"/><circle cx="34" cy="28" r="2.5" fill="#06B6D4" opacity="0.4"/><rect x="26" y="46" width="32" height="24" rx="3" stroke="#06B6D4" stroke-width="0.9" stroke-dasharray="2 2" opacity="0.35"/><line x1="66" y1="50" x2="94" y2="50" stroke="#06B6D4" stroke-width="1.2" stroke-linecap="round" opacity="0.5"/><line x1="66" y1="58" x2="88" y2="58" stroke="#06B6D4" stroke-width="1.2" stroke-linecap="round" opacity="0.35"/></svg>'
    ],
    'mobile' => [
        'color' => '#8B5CF6',
        'bg' => 'rgba(139, 92, 246, 0.08)',
        'border' => 'rgba(139, 92, 246, 0.22)',
        'svg' => '<svg viewBox="0 0 120 120" fill="none" xmlns="http://www.w3.org/2000/svg"><rect x="35" y="15" width="60" height="92" rx="12" stroke="#8B5CF6" stroke-width="1.4" opacity="0.45"/><line x1="55" y1="24" x2="75" y2="24" stroke="#8B5CF6" stroke-width="1.5" stroke-linecap="round" opacity="0.6"/><circle cx="65" cy="94" r="3.5" stroke="#8B5CF6" stroke-width="1" opacity="0.5"/><rect x="43" y="34" width="44" height="48" rx="4" stroke="#8B5CF6" stroke-width="0.8" stroke-dasharray="3 2" opacity="0.3"/></svg>'
    ],
    'backend' => [
        'color' => '#10B981',
        'bg' => 'rgba(16, 185, 129, 0.08)',
        'border' => 'rgba(16, 185, 129, 0.22)',
        'svg' => '<svg viewBox="0 0 120 120" fill="none" xmlns="http://www.w3.org/2000/svg"><rect x="25" y="22" width="75" height="22" rx="4" stroke="#10B981" stroke-width="1.2" opacity="0.45"/><circle cx="36" cy="33" r="2.5" fill="#10B981" opacity="0.7"/><rect x="25" y="52" width="75" height="22" rx="4" stroke="#10B981" stroke-width="1.2" opacity="0.45"/><circle cx="36" cy="63" r="2.5" fill="#10B981" opacity="0.7"/><rect x="25" y="82" width="75" height="22" rx="4" stroke="#10B981" stroke-width="1.2" opacity="0.45"/><circle cx="36" cy="93" r="2.5" fill="#10B981" opacity="0.7"/><line x1="88" y1="33" x2="94" y2="33" stroke="#10B981" stroke-width="1.5" stroke-linecap="round" opacity="0.6"/><line x1="88" y1="63" x2="94" y2="63" stroke="#10B981" stroke-width="1.5" stroke-linecap="round" opacity="0.6"/><line x1="88" y1="93" x2="94" y2="93" stroke="#10B981" stroke-width="1.5" stroke-linecap="round" opacity="0.6"/></svg>'
    ],
    'game' => [
        'color' => '#F59E0B',
        'bg' => 'rgba(245, 158, 11, 0.08)',
        'border' => 'rgba(245, 158, 11, 0.22)',
        'svg' => '<svg viewBox="0 0 120 120" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="60" cy="60" r="42" stroke="#F59E0B" stroke-width="1" stroke-dasharray="3 3" opacity="0.35"/><path d="M52 38H68V52H82V68H68V82H52V68H38V52H52V38Z" stroke="#F59E0B" stroke-width="1.2" opacity="0.5"/><circle cx="86" cy="44" r="3" fill="#F59E0B" opacity="0.6"/><circle cx="94" cy="52" r="3" fill="#F59E0B" opacity="0.6"/></svg>'
    ],
    'hardware' => [
        'color' => '#F43F5E',
        'bg' => 'rgba(244, 63, 94, 0.08)',
        'border' => 'rgba(244, 63, 94, 0.22)',
        'svg' => '<svg viewBox="0 0 120 120" fill="none" xmlns="http://www.w3.org/2000/svg"><rect x="35" y="35" width="50" height="50" rx="6" stroke="#F43F5E" stroke-width="1.3" opacity="0.5"/><circle cx="60" cy="60" r="10" stroke="#F43F5E" stroke-width="1" stroke-dasharray="2 2" opacity="0.4"/><line x1="45" y1="20" x2="45" y2="35" stroke="#F43F5E" stroke-width="1.4" opacity="0.6"/><circle cx="45" cy="18" r="2" fill="#F43F5E" opacity="0.6"/><line x1="60" y1="20" x2="60" y2="35" stroke="#F43F5E" stroke-width="1.4" opacity="0.6"/><circle cx="60" cy="18" r="2" fill="#F43F5E" opacity="0.6"/><line x1="75" y1="20" x2="75" y2="35" stroke="#F43F5E" stroke-width="1.4" opacity="0.6"/><circle cx="75" cy="18" r="2" fill="#F43F5E" opacity="0.6"/><line x1="45" y1="85" x2="45" y2="100" stroke="#F43F5E" stroke-width="1.4" opacity="0.6"/><circle cx="45" cy="102" r="2" fill="#F43F5E" opacity="0.6"/><line x1="60" y1="85" x2="60" y2="100" stroke="#F43F5E" stroke-width="1.4" opacity="0.6"/><circle cx="60" cy="102" r="2" fill="#F43F5E" opacity="0.6"/><line x1="75" y1="85" x2="75" y2="100" stroke="#F43F5E" stroke-width="1.4" opacity="0.6"/><circle cx="75" cy="102" r="2" fill="#F43F5E" opacity="0.6"/></svg>'
    ],
];
$themeKeys = ['software', 'web', 'mobile', 'backend', 'game', 'hardware'];
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

                    $lowerName = strtolower($cleanName);
                    $matchedKey = 'software';
                    if (str_contains($lowerName, 'web')) $matchedKey = 'web';
                    elseif (str_contains($lowerName, 'mobile')) $matchedKey = 'mobile';
                    elseif (str_contains($lowerName, 'backend') || str_contains($lowerName, 'devops')) $matchedKey = 'backend';
                    elseif (str_contains($lowerName, 'game')) $matchedKey = 'game';
                    elseif (str_contains($lowerName, 'hardware')) $matchedKey = 'hardware';
                    else $matchedKey = $themeKeys[$index % count($themeKeys)];

                    $theme = $serviceThemes[$matchedKey];
                @endphp
                <div class="svc-card service-card-trigger"
                     data-service-index="{{ $index }}"
                     data-service-id="{{ $svc->id ?? $index }}"
                     data-service-name="{{ $displayName }}"
                     data-service-tagline="{{ $tagline }}"
                     data-service-desc="{{ $svc->description ?? '' }}"
                     data-service-cover="{{ $svc->cover_image_url ?? ($svc->cover_image ?? '') }}"
                     data-service-path="ODDS_Studio/Services/{{ \Illuminate\Support\Str::studly($cleanName) }}/Overview"
                     style="--svc-color: {{ $theme['color'] }}; --svc-bg: {{ $theme['bg'] }}; --svc-border: {{ $theme['border'] }};">
                    <div class="svc-card-bg-wire" aria-hidden="true">
                        {!! $theme['svg'] !!}
                    </div>
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

                    $lowerName = strtolower($cleanName);
                    $matchedKey = 'software';
                    if (str_contains($lowerName, 'web')) $matchedKey = 'web';
                    elseif (str_contains($lowerName, 'mobile')) $matchedKey = 'mobile';
                    elseif (str_contains($lowerName, 'backend') || str_contains($lowerName, 'devops')) $matchedKey = 'backend';
                    elseif (str_contains($lowerName, 'game')) $matchedKey = 'game';
                    elseif (str_contains($lowerName, 'hardware')) $matchedKey = 'hardware';
                    else $matchedKey = $themeKeys[$index % count($themeKeys)];

                    $theme = $serviceThemes[$matchedKey];
                @endphp
                <div class="svc-card service-card-trigger"
                     data-service-index="{{ $index }}"
                     data-service-id="{{ $svc->id ?? $index }}"
                     data-service-name="{{ $displayName }}"
                     data-service-tagline="{{ $tagline }}"
                     data-service-desc="{{ $svc->description ?? '' }}"
                     data-service-cover="{{ $svc->cover_image_url ?? ($svc->cover_image ?? '') }}"
                     data-service-path="ODDS_Studio/Services/{{ \Illuminate\Support\Str::studly($cleanName) }}/Overview"
                     style="--svc-color: {{ $theme['color'] }}; --svc-bg: {{ $theme['bg'] }}; --svc-border: {{ $theme['border'] }};">
                    <div class="svc-card-bg-wire" aria-hidden="true">
                        {!! $theme['svg'] !!}
                    </div>
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

                    $lowerName = strtolower($cleanName);
                    $matchedKey = 'software';
                    if (str_contains($lowerName, 'web')) $matchedKey = 'web';
                    elseif (str_contains($lowerName, 'mobile')) $matchedKey = 'mobile';
                    elseif (str_contains($lowerName, 'backend') || str_contains($lowerName, 'devops')) $matchedKey = 'backend';
                    elseif (str_contains($lowerName, 'game')) $matchedKey = 'game';
                    elseif (str_contains($lowerName, 'hardware')) $matchedKey = 'hardware';
                    else $matchedKey = $themeKeys[$index % count($themeKeys)];

                    $theme = $serviceThemes[$matchedKey];
                @endphp
                <div class="svc-card service-card-trigger"
                     data-service-index="{{ $index }}"
                     data-service-id="{{ $svc->id ?? $index }}"
                     data-service-name="{{ $displayName }}"
                     data-service-tagline="{{ $tagline }}"
                     data-service-desc="{{ $svc->description ?? '' }}"
                     data-service-cover="{{ $svc->cover_image_url ?? ($svc->cover_image ?? '') }}"
                     data-service-path="ODDS_Studio/Services/{{ \Illuminate\Support\Str::studly($cleanName) }}/Overview"
                     style="--svc-color: {{ $theme['color'] }}; --svc-bg: {{ $theme['bg'] }}; --svc-border: {{ $theme['border'] }};">
                    <div class="svc-card-bg-wire" aria-hidden="true">
                        {!! $theme['svg'] !!}
                    </div>
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
