@php
$defaultServiceNames = [
    "GAME\nDEVELOPMENT",
    "IOT\nSYSTEMS",
    "SOFTWARE\nDEVELOPMENT",
    "WEB\nDEVELOPMENT",
    "MOBILE\nAPPLICATIONS",
    "BACKEND\n& DEVOPS",
];

$items = isset($services) && count($services) > 0 
    ? $services 
    : collect($defaultServiceNames)->map(fn($n) => (object)['name' => $n]);

$formattedItems = [];
foreach ($items as $svc) {
    $raw = str_replace(["\r\n", "\r"], "\n", $svc->name ?? '');
    if (str_contains($raw, "\n")) {
        $parts = explode("\n", $raw, 2);
        $r1 = trim($parts[0]);
        $r2 = trim($parts[1]);
    } else {
        $words = preg_split('/\s+/', trim($raw));
        if (count($words) > 1) {
            $mid = (int)ceil(count($words) / 2);
            $r1 = implode(' ', array_slice($words, 0, $mid));
            $r2 = implode(' ', array_slice($words, $mid));
        } else {
            $r1 = $words[0] ?? '';
            $r2 = '';
        }
    }
    $formattedItems[] = [
        'row1' => mb_strtoupper($r1),
        'row2' => mb_strtoupper($r2),
    ];
}
@endphp

<div class="services-marquee-wrapper" id="services">
    <section class="services-marquee-strip">
    <div class="services-marquee-inner">
        {{-- Anchored Left Title --}}
        <div class="services-marquee-header">
            <span class="services-marquee-title">Services</span>
        </div>

        {{-- Scrolling Marquee Viewport with Dual-Edge Gradient Fades --}}
        <div class="services-marquee-viewport">
            {{-- Left & Right Vignette / Gradient Fade Edges --}}
            <div class="services-fade-edge services-fade-left" aria-hidden="true"></div>
            <div class="services-fade-edge services-fade-right" aria-hidden="true"></div>

            <div class="services-marquee-track">
                {{-- Primary Group --}}
                <div class="services-marquee-group">
                    @foreach($formattedItems as $item)
                        <div class="services-marquee-item">
                            <span class="services-marquee-text">
                                <span class="block leading-[1.1]">{{ $item['row1'] }}</span>
                                @if(!empty($item['row2']))
                                    <span class="block leading-[1.1]">{{ $item['row2'] }}</span>
                                @endif
                            </span>
                        </div>
                        <span class="services-marquee-dot" aria-hidden="true"></span>
                    @endforeach
                </div>

                {{-- Duplicate Group for Seamless Infinite Loop --}}
                <div class="services-marquee-group" aria-hidden="true">
                    @foreach($formattedItems as $item)
                        <div class="services-marquee-item">
                            <span class="services-marquee-text">
                                <span class="block leading-[1.1]">{{ $item['row1'] }}</span>
                                @if(!empty($item['row2']))
                                    <span class="block leading-[1.1]">{{ $item['row2'] }}</span>
                                @endif
                            </span>
                        </div>
                        <span class="services-marquee-dot" aria-hidden="true"></span>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
</div>
