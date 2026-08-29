@php
$workItems = isset($works) && count($works) > 0 ? $works : collect([
    (object)['title' => 'THEODORE', 'category' => 'Full-Stack Platform', 'year' => '2024', 'description' => 'Scalable enterprise application built for rapid throughput.'],
    (object)['title' => 'ClassGuard', 'category' => 'Security & Vision', 'year' => '2024', 'description' => 'Real-time security monitoring and automated access protocol system.'],
    (object)['title' => 'PRISMA', 'category' => 'Data Analytics', 'year' => '2024', 'description' => 'High-velocity telemetry pipeline and data visualization platform.'],
    (object)['title' => 'Sentry', 'category' => 'DevOps Automation', 'year' => '2024', 'description' => 'Infrastructure heartbeat monitor with zero-downtime deployment pipelines.'],
    (object)['title' => 'SPCC Website', 'category' => 'Web Architecture', 'year' => '2023', 'description' => 'Educational portal with responsive multi-tier course management.'],
    (object)['title' => 'LISAI Website', 'category' => 'Brand & Platform', 'year' => '2023', 'description' => 'Interactive digital showcase with smooth kinetic motion.'],
    (object)['title' => 'ALAMS', 'category' => 'Hardware & IoT', 'year' => '2023', 'description' => 'Integrated micro-controller system with live sensor analytics.'],
    (object)['title' => 'AVONIC', 'category' => 'Hardware Systems', 'year' => '2022', 'description' => 'Embedded control architecture with rapid telemetry feedback.'],
    (object)['title' => 'SPCC Web App', 'category' => 'Cloud Systems', 'year' => '2022', 'description' => 'Enterprise administrative system for institutional workflows.'],
]);
@endphp

<section class="works" id="works">
  <div class="works-content-wrap">

    {{-- Section label --}}
    <p class="works-section-label animate-fade-up fade-up" style="animation-delay: 50ms;">Our Works</p>

    {{-- Main heading --}}
    <h2 class="works-heading animate-fade-up fade-up" style="animation-delay: 100ms;">
      <span class="works-heading-lead">We Don't Just Build.</span><br>
      <span class="works-heading-deliver">We Deliver.</span>
    </h2>

    {{-- Stats row --}}
    <div class="works-stats-row animate-fade-up fade-up" id="stats-row" style="animation-delay: 150ms;">

      {{-- Projects Accomplished --}}
      <div class="works-stat-cell works-stat-cell--bordered">
        @php
          $projCount = $accomplishedCount ?? (isset($works) ? $works->where('count_in_kpi', true)->count() : count($workItems));
        @endphp
        <span class="kpi-num" data-target="{{ $projCount }}" data-suffix="">{{ $projCount }}</span>
        <span class="kpi-label">Projects Accomplished</span>
      </div>

      {{-- Client Satisfaction --}}
      <div class="works-stat-cell works-stat-cell--bordered">
        <div class="kpi-satisfaction">
          @php
            $satVal = $clientSatisfactionAvg ?? 5;
            $satDenom = $clientSatisfactionDenom ?? '/5';
          @endphp
          <span class="kpi-num" data-target="{{ $satVal }}" data-suffix="">{{ $satVal }}</span>
          <span class="kpi-fraction">{{ $satDenom }}</span>
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
    <p class="works-description animate-fade-up fade-up" style="animation-delay: 200ms;">
      Real-world solutions, custom-engineered for rapid deployment and measurable business impact.
    </p>

    {{-- 3×3 Folder Card Grid --}}
    <div class="works-card-grid">

      @foreach($workItems as $index => $item)
      @php 
        $rowNum = floor($index / 3) + 1;
        $delayClass = "delay-row-{$rowNum}";
      @endphp
      <div class="project-card-trigger works-folder-card group relative drop-shadow-2xl
                  transition-transform duration-150 ease-out active:scale-[0.97] active:drop-shadow-lg
                  animate-fade-up {{ $delayClass }}"
           data-project-index="{{ $index }}"
           data-project-id="{{ $item->id ?? $index }}"
           data-project-title="{{ $item->title }}"
           data-project-category="{{ $item->category ?? 'Software Architecture' }}"
           data-project-year="{{ $item->year ?? '2024' }}"
           data-project-desc="{{ $item->description ?? '' }}"
           data-project-cover="{{ $item->cover_image ?? '' }}"
           data-project-demo="{{ $item->demo_url ?? '' }}"
           data-project-github="{{ $item->github_url ?? '' }}"
           data-project-path="ODDS_Project/{{ Str::studly($item->title) }}/Project_Story">
        <div class="sync-ease absolute top-[1px] right-0 h-[31px] z-20 origin-right
                    w-[200px] group-hover:w-[225px]
                    bg-[#2b2b2b] text-white rounded-full font-semibold text-[11px] tracking-widest border border-[#1a1a1a]
                    flex items-center justify-center shadow-md transition-all
                    group-hover:bg-black group-hover:border-white/30 group-hover:shadow-lg">
          <span class="sync-ease whitespace-nowrap transition-transform">{{ $item->title }}</span>
        </div>
        <div class="absolute inset-0">
          <svg class="w-full h-full block overflow-visible" viewBox="-1 -1 408 248" fill="none" xmlns="http://www.w3.org/2000/svg">
            <defs>
              <clipPath id="folder-clip-{{ $item->id ?? $index }}">
                <path class="morph-path" d="M182.5 0C192.717 0 201 8.28273 201 18.5C201 28.7173 209.283 37 219.5 37H396C401.523 37 406 41.4772 406 47V236C406 241.523 401.523 246 396 246H10C4.47715 246 0 241.523 0 236V10C0 4.47716 4.47715 0 10 0H182.5Z" />
              </clipPath>
            </defs>

            <!-- Base Gray Folder Body Background -->
            <path class="morph-path group-hover:fill-[#d8d8d8]" fill="#CCCCCC" />

            @if(!empty($item->cover_image))
            <!-- Clipped 16:9 Image Body from Admin -->
            <g clip-path="url(#folder-clip-{{ $item->id ?? $index }})">
              <image href="{{ $item->cover_image }}" xlink:href="{{ $item->cover_image }}" x="0" y="0" width="406" height="246" preserveAspectRatio="xMidYMid slice" class="transition-transform duration-300 ease-out group-hover:scale-105 origin-center" />
              <rect x="0" y="0" width="406" height="246" fill="#000000" class="opacity-10 group-hover:opacity-0 transition-opacity duration-300 pointer-events-none" />
            </g>
            @endif

            <!-- Clean Outline Stroke -->
            <path class="morph-path" fill="none" stroke="#262626" stroke-width="1" vector-effect="non-scaling-stroke" />
          </svg>
        </div>

        @if(empty($item->cover_image))
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

    </div><!-- end grid -->

    {{-- See More button --}}
    <a href="#cta" class="works-see-more animate-fade-up fade-up" style="animation-delay: 950ms;">
      See More
    </a>

  </div>
</section>

{{-- High-fidelity JSON Data Payload for Modal Stories --}}
<script type="application/json" id="odds-projects-data">
{!! json_encode($workItems->map(function($item, $idx) {
    $rawBlocks = $item->body_content ?? [];
    if (is_string($rawBlocks)) {
        $decoded = json_decode($rawBlocks, true);
        $rawBlocks = is_array($decoded) ? $decoded : [];
    }
    return [
        'id' => $item->id ?? ($idx + 1),
        'title' => $item->title ?? 'ODDS Project',
        'category' => $item->category ?? 'Software Architecture',
        'year' => $item->year ?? '2024',
        'client' => $item->client ?? '',
        'role' => $item->role ?? '',
        'description' => $item->description ?? '',
        'story_content' => $item->story_content ?? '',
        'body_content' => $rawBlocks,
        'cover_image' => $item->cover_image ?? '',
        'demo_url' => $item->demo_url ?? '',
        'github_url' => $item->github_url ?? '',
        'path_str' => 'ODDS_Project/' . \Illuminate\Support\Str::studly($item->title ?? 'Project') . '/Project_Story',
    ];
})->values()) !!}
</script>

{{-- Project Detail Modal --}}
@include('components.project-modal')
