<x-layout>
@push('styles')
<style>
    /* ─── STANDALONE OUR WORK PAGE THEME OVERRIDES ─── */
    body:has(.our-work-universe) .navbar {
        background: rgba(255, 255, 255, 0.92) !important;
        backdrop-filter: blur(16px);
        -webkit-backdrop-filter: blur(16px);
        border-bottom: 1px solid rgba(0, 0, 0, 0.07) !important;
        color: #111111 !important;
    }
    body:has(.our-work-universe) .navbar .nav-logo {
        color: #111111 !important;
    }
    body:has(.our-work-universe) .navbar .nav-links a {
        color: rgba(17, 17, 17, 0.7) !important;
        font-weight: 600;
        font-size: 14px;
        transition: color 0.2s ease;
    }
    body:has(.our-work-universe) .navbar .nav-links a:hover,
    body:has(.our-work-universe) .navbar .nav-links a.active {
        color: #f359b0 !important;
    }
    body:has(.our-work-universe) .navbar .btn-nav {
        background: #111111 !important;
        color: #ffffff !important;
    }
    body:has(.our-work-universe) .navbar .btn-nav:hover {
        background: #f359b0 !important;
        color: #ffffff !important;
    }
    body:has(.our-work-universe) .nav-toggle .hamburger-bar {
        background-color: #111111 !important;
    }

    /* ─── STANDALONE WORK PAGE LAYOUT ─── */
    .our-work-universe {
        min-height: 100vh;
        width: 100%;
        background: radial-gradient(ellipse 55% 70% at 0% 40%, rgba(185, 155, 235, 0.45) 0%, transparent 100%),
                    radial-gradient(ellipse 55% 70% at 100% 40%, rgba(185, 155, 235, 0.45) 0%, transparent 100%),
                    #ffffff;
        padding-top: calc(10vh + 32px);
        padding-bottom: 96px;
        font-family: var(--font-primary), sans-serif;
    }

    .our-work-universe .works-content-wrap {
        max-width: 1320px;
    }

    /* Keep all grid cards visible on full page regardless of screen size */
    .our-work-universe .works-card-grid .works-folder-card {
        display: block !important;
    }

    @media (max-width: 1280px) {
        .our-work-universe .works-card-grid {
            grid-template-columns: repeat(2, 406px);
            gap: 32px;
        }
    }

    @media (max-width: 880px) {
        .our-work-universe .works-card-grid {
            grid-template-columns: 1fr;
            max-width: 406px;
            width: 100%;
            gap: 24px;
        }
    }

    /* Calmer Closing Section */
    .our-work-closing {
        text-align: center;
        max-width: 600px;
        margin: 56px auto 0 auto;
        padding: 0 20px;
    }

    .our-work-closing-title {
        font-size: clamp(26px, 3.5vw, 38px);
        font-weight: 800;
        color: #111111;
        letter-spacing: -0.02em;
        line-height: 1.2;
        margin-bottom: 12px;
    }

    .our-work-closing-desc {
        font-size: 15px;
        color: #6b7280;
        line-height: 1.7;
        margin-bottom: 28px;
    }
</style>
@endpush

@php
$workItems = isset($works) && count($works) > 0 ? $works : collect([
    (object)['id' => 1, 'title' => 'THEODORE', 'category' => 'Full-Stack Platform', 'year' => '2024', 'description' => 'Scalable enterprise application built for rapid throughput.', 'cover_image' => null, 'cover_image_url' => null, 'client' => '', 'role' => '', 'demo_url' => '', 'github_url' => '', 'story_content' => '', 'body_content' => []],
    (object)['id' => 2, 'title' => 'ClassGuard', 'category' => 'Security & Vision', 'year' => '2024', 'description' => 'Real-time security monitoring and automated access protocol system.', 'cover_image' => null, 'cover_image_url' => null, 'client' => '', 'role' => '', 'demo_url' => '', 'github_url' => '', 'story_content' => '', 'body_content' => []],
    (object)['id' => 3, 'title' => 'PRISMA', 'category' => 'Data Analytics', 'year' => '2024', 'description' => 'High-velocity telemetry pipeline and data visualization platform.', 'cover_image' => null, 'cover_image_url' => null, 'client' => '', 'role' => '', 'demo_url' => '', 'github_url' => '', 'story_content' => '', 'body_content' => []],
    (object)['id' => 4, 'title' => 'Sentry', 'category' => 'DevOps Automation', 'year' => '2024', 'description' => 'Infrastructure heartbeat monitor with zero-downtime deployment pipelines.', 'cover_image' => null, 'cover_image_url' => null, 'client' => '', 'role' => '', 'demo_url' => '', 'github_url' => '', 'story_content' => '', 'body_content' => []],
    (object)['id' => 5, 'title' => 'SPCC Website', 'category' => 'Web Architecture', 'year' => '2023', 'description' => 'Educational portal with responsive multi-tier course management.', 'cover_image' => null, 'cover_image_url' => null, 'client' => '', 'role' => '', 'demo_url' => '', 'github_url' => '', 'story_content' => '', 'body_content' => []],
    (object)['id' => 6, 'title' => 'LISAI Website', 'category' => 'Brand & Platform', 'year' => '2023', 'description' => 'Interactive digital showcase with smooth kinetic motion.', 'cover_image' => null, 'cover_image_url' => null, 'client' => '', 'role' => '', 'demo_url' => '', 'github_url' => '', 'story_content' => '', 'body_content' => []],
    (object)['id' => 7, 'title' => 'ALAMS', 'category' => 'Hardware & IoT', 'year' => '2023', 'description' => 'Integrated micro-controller system with live sensor analytics.', 'cover_image' => null, 'cover_image_url' => null, 'client' => '', 'role' => '', 'demo_url' => '', 'github_url' => '', 'story_content' => '', 'body_content' => []],
    (object)['id' => 8, 'title' => 'AVONIC', 'category' => 'Hardware Systems', 'year' => '2022', 'description' => 'Embedded control architecture with rapid telemetry feedback.', 'cover_image' => null, 'cover_image_url' => null, 'client' => '', 'role' => '', 'demo_url' => '', 'github_url' => '', 'story_content' => '', 'body_content' => []],
    (object)['id' => 9, 'title' => 'SPCC Web App', 'category' => 'Cloud Systems', 'year' => '2022', 'description' => 'Enterprise administrative system for institutional workflows.', 'cover_image' => null, 'cover_image_url' => null, 'client' => '', 'role' => '', 'demo_url' => '', 'github_url' => '', 'story_content' => '', 'body_content' => []],
]);

$accomplishedCount = isset($works) && $works->count() > 0 ? $works->count() : count($workItems);
@endphp

<div class="our-work-universe">
    <div class="works-content-wrap">

        {{-- Section label --}}
        <p class="works-section-label animate-fade-up fade-up">Our Works</p>

        {{-- Main heading --}}
        <h1 class="works-heading animate-fade-up fade-up">
            <span class="works-heading-lead">Every System We Build.</span><br>
            <span class="works-heading-deliver">We Deliver.</span>
        </h1>

        {{-- Stats row --}}
        <div class="works-stats-row animate-fade-up fade-up" id="stats-row">

            {{-- Projects Accomplished --}}
            <div class="works-stat-cell works-stat-cell--bordered">
                <span class="kpi-num" data-target="{{ $accomplishedCount }}" data-suffix="">{{ $accomplishedCount }}</span>
                <span class="kpi-label">Projects Accomplished</span>
            </div>

            {{-- Client Satisfaction --}}
            <div class="works-stat-cell works-stat-cell--bordered">
                <div class="kpi-satisfaction">
                    <span class="kpi-num" data-target="5" data-suffix="">5</span>
                    <span class="kpi-fraction">/5</span>
                </div>
                <span class="kpi-label">Client Satisfaction</span>
            </div>

            {{-- Reliability --}}
            <div class="works-stat-cell">
                <span class="kpi-num" data-target="{{ preg_replace('/[^0-9]/', '', $settings->kpi_reliability ?? '99') }}" data-suffix="%">{{ $settings->kpi_reliability ?? '99%' }}</span>
                <span class="kpi-label">{{ $settings->kpi_reliability_label ?? 'The Reliability Angle' }}</span>
            </div>

        </div>

        {{-- Description --}}
        <p class="works-description animate-fade-up fade-up">
            Real-world solutions, custom-engineered for rapid deployment and measurable business impact. Explore the complete catalog of systems we've shipped across software, hardware, cloud, and interactive platforms.
        </p>

        {{-- Full Work Grid (Folder Cards) --}}
        <div class="works-card-grid">
            @foreach($workItems as $index => $item)
            @php 
                $rowNum = floor($index / 3) + 1;
                $delayClass = "delay-row-{$rowNum}";
                $itemTitle = data_get($item, 'title', 'Project');
                $itemCategory = data_get($item, 'category', 'Software Architecture');
                $itemYear = data_get($item, 'year', '2024');
                $itemClient = data_get($item, 'client', '');
                $itemRole = data_get($item, 'role', '');
                $itemDesc = data_get($item, 'description', '');
                $coverSrc = data_get($item, 'cover_image_url') ?: data_get($item, 'cover_image');
                $itemDemo = data_get($item, 'demo_url', '');
                $itemGithub = data_get($item, 'github_url', '');
                $itemId = data_get($item, 'id', $index);
            @endphp
            <div class="project-card-trigger works-folder-card group relative drop-shadow-2xl
                        transition-transform duration-150 ease-out active:scale-[0.97] active:drop-shadow-lg
                        animate-fade-up {{ $delayClass }}"
                 data-project-index="{{ $index }}"
                 data-project-id="{{ $itemId }}"
                 data-project-title="{{ $itemTitle }}"
                 data-project-category="{{ $itemCategory }}"
                 data-project-year="{{ $itemYear }}"
                 data-project-client="{{ $itemClient }}"
                 data-project-role="{{ $itemRole }}"
                 data-project-desc="{{ $itemDesc }}"
                 data-project-cover="{{ $coverSrc ?? '' }}"
                 data-project-demo="{{ $itemDemo }}"
                 data-project-github="{{ $itemGithub }}"
                 data-project-path="ODDS_Project/{{ \Illuminate\Support\Str::studly($itemTitle) }}/Project_Story"
                 role="button"
                 tabindex="0"
                 aria-label="View {{ $itemTitle }} project details">

                {{-- Folder Top Pill Tab --}}
                <div class="sync-ease absolute top-[1px] right-0 h-[31px] z-20 origin-right
                            w-[200px] group-hover:w-[225px]
                            bg-[#2b2b2b] text-white rounded-full font-semibold text-[11px] tracking-widest border border-[#1a1a1a]
                            flex items-center justify-center shadow-md transition-all
                            group-hover:bg-black group-hover:border-white/30 group-hover:shadow-lg">
                    <span class="sync-ease whitespace-nowrap transition-transform">{{ $itemTitle }}</span>
                </div>

                <div class="absolute inset-0">
                    <svg class="w-full h-full block overflow-visible" viewBox="-1 -1 408 248" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <defs>
                            <clipPath id="folder-clip-{{ $itemId }}">
                                <path class="morph-path" d="M182.5 0C192.717 0 201 8.28273 201 18.5C201 28.7173 209.283 37 219.5 37H396C401.523 37 406 41.4772 406 47V236C406 241.523 401.523 246 396 246H10C4.47715 246 0 241.523 0 236V10C0 4.47716 4.47715 0 10 0H182.5Z" />
                            </clipPath>
                        </defs>

                        <!-- Base Gray Folder Body Background -->
                        <path class="morph-path group-hover:fill-[#d8d8d8]" fill="#CCCCCC" />

                        @if(!empty($coverSrc))
                        <!-- Clipped 16:9 Image Body from Admin -->
                        <g clip-path="url(#folder-clip-{{ $itemId }})">
                            <image href="{{ $coverSrc }}" xlink:href="{{ $coverSrc }}" x="0" y="0" width="406" height="246" preserveAspectRatio="xMidYMid slice" class="transition-transform duration-300 ease-out group-hover:scale-105 origin-center" />
                            <rect x="0" y="0" width="406" height="246" fill="#000000" class="opacity-10 group-hover:opacity-0 transition-opacity duration-300 pointer-events-none" />
                        </g>
                        @endif

                        <!-- Clean Outline Stroke -->
                        <path class="morph-path" fill="none" stroke="#262626" stroke-width="1" vector-effect="non-scaling-stroke" />
                    </svg>
                </div>

                @if(empty($coverSrc))
                <div class="absolute inset-0 z-10 flex items-center justify-center p-6 pt-10 pointer-events-none">
                    <div class="sync-ease flex items-center justify-center group-hover:scale-105">
                        <svg width="99" height="99" viewBox="0 0 99 99" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g opacity="0.2" class="transition-opacity duration-300 group-hover:opacity-40">
                                <path d="M15.6914 92.692C13.0445 92.692 10.7795 91.7503 8.89616 89.8671C7.01287 87.9838 6.06961 85.7171 6.06641 83.067V15.6919C6.06641 13.045 7.00966 10.7799 8.89616 8.89665C10.7827 7.01335 13.0477 6.0701 15.6914 6.06689H83.0665C85.7134 6.06689 87.9801 7.01015 89.8666 8.89665C91.7531 10.7831 92.6947 13.0482 92.6915 15.6919V83.067C92.6915 85.7139 91.7499 87.9805 89.8666 89.8671C87.9833 91.7535 85.7166 92.6952 83.0665 92.692H15.6914ZM15.6914 83.067H83.0665V15.6919H15.6914V83.067ZM20.5039 73.442H78.254L60.2071 49.3794L45.7696 68.6295L34.9414 54.1919L20.5039 73.442Z" fill="black" />
                            </g>
                        </svg>
                    </div>
                </div>
                @endif
            </div>
            @endforeach
        </div>

        {{-- Closing Block --}}
        <div class="our-work-closing animate-fade-up fade-up">
            <h2 class="our-work-closing-title">Want to see yours here?</h2>
            <p class="our-work-closing-desc">
                Tell us what you're facing. Whether you need a focused module or a full end-to-end architecture, our engineering team executes with velocity.
            </p>
            <a href="{{ url('/#cta') }}" class="works-see-more">
                Let's Build
            </a>
        </div>

    </div>
</div>

{{-- High-fidelity JSON Data Payload for Modal Stories --}}
<script type="application/json" id="odds-projects-data">
{!! json_encode($workItems->map(function($item, $idx) {
    $rawBlocks = data_get($item, 'body_content', []);
    if (is_string($rawBlocks)) {
        $decoded = json_decode($rawBlocks, true);
        $rawBlocks = is_array($decoded) ? $decoded : [];
    }
    $itemTitle = data_get($item, 'title', 'ODDS Project');
    return [
        'id' => data_get($item, 'id', $idx + 1),
        'title' => $itemTitle,
        'category' => data_get($item, 'category', 'Software Architecture'),
        'year' => data_get($item, 'year', '2024'),
        'client' => data_get($item, 'client', ''),
        'role' => data_get($item, 'role', ''),
        'description' => data_get($item, 'description', ''),
        'story_content' => data_get($item, 'story_content', ''),
        'body_content' => $rawBlocks,
        'cover_image' => data_get($item, 'cover_image_url') ?: data_get($item, 'cover_image', ''),
        'demo_url' => data_get($item, 'demo_url', ''),
        'github_url' => data_get($item, 'github_url', ''),
        'path_str' => 'ODDS_Project/' . \Illuminate\Support\Str::studly($itemTitle) . '/Project_Story',
    ];
})->values()) !!}
</script>

{{-- Project Detail Modal --}}
@include('components.project-modal')

{{-- Odds Studio Signature Footer --}}
<x-footer :settings="$settings" />

{{-- Lorenzo AI Chat Widget --}}
<x-odds-chat-widget />

</x-layout>