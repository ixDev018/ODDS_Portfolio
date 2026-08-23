@php
$works = [
    ['title' => 'THEODORE', 'delay' => 'delay-row-1'],
    ['title' => 'ClassGuard', 'delay' => 'delay-row-1'],
    ['title' => 'PRISMA', 'delay' => 'delay-row-1'],
    ['title' => 'Sentry', 'delay' => 'delay-row-2'],
    ['title' => 'SPCC Website', 'delay' => 'delay-row-2'],
    ['title' => 'LISAI Website', 'delay' => 'delay-row-2'],
    ['title' => 'ALAMS', 'delay' => 'delay-row-3'],
    ['title' => 'AVONIC', 'delay' => 'delay-row-3'],
    ['title' => 'SPCC Website', 'delay' => 'delay-row-3'],
];
@endphp

<section class="works fp-section" id="works">
  <div class="works-content-wrap">

    {{-- Section label --}}
    <p class="works-section-label animate-fade-up fade-up" style="animation-delay: 50ms;">Our Works</p>

    {{-- Main heading --}}
    <h2 class="works-heading animate-fade-up fade-up" style="animation-delay: 100ms;">
      We Don't Just Build. We Deliver.
    </h2>

    {{-- Stats row --}}
    <div class="works-stats-row animate-fade-up fade-up" id="stats-row" style="animation-delay: 150ms;">

      {{-- 58 Projects --}}
      <div class="works-stat-cell works-stat-cell--bordered">
        <span class="kpi-num" data-target="58" data-suffix="">58</span>
        <span class="kpi-label">Projects Accomplished</span>
      </div>

      {{-- 8/10 Client Satisfaction --}}
      <div class="works-stat-cell works-stat-cell--bordered">
        <div class="kpi-satisfaction">
          <span class="kpi-num" data-target="8" data-suffix="">8</span>
          <span class="kpi-fraction">/10</span>
        </div>
        <span class="kpi-label">Client Satisfaction</span>
      </div>

      {{-- 99% Reliability --}}
      <div class="works-stat-cell">
        <span class="kpi-num" data-target="99" data-suffix="%">99%</span>
        <span class="kpi-label">The Reliability Angle</span>
      </div>

    </div>

    {{-- Description --}}
    <p class="works-description animate-fade-up fade-up" style="animation-delay: 200ms;">
      Real-world solutions, custom-engineered for rapid deployment<br>
      and measurable business impact.
    </p>

    {{-- 3×3 Folder Card Grid --}}
    <div class="works-card-grid">

      @foreach($works as $item)
      <div class="group relative w-[406px] max-w-full h-[246px] drop-shadow-2xl cursor-pointer select-none
                  transition-transform duration-150 ease-out active:scale-[0.97] active:drop-shadow-lg
                  animate-fade-up {{ $item['delay'] }}">
        <div class="sync-ease absolute top-[1px] right-0 h-[31px] z-20 origin-right
                    w-[200px] group-hover:w-[225px]
                    bg-[#2b2b2b] text-white rounded-full font-semibold text-[11px] tracking-widest border border-[#1a1a1a]
                    flex items-center justify-center shadow-md transition-all
                    group-hover:bg-black group-hover:border-white/30 group-hover:shadow-lg">
          <span class="sync-ease whitespace-nowrap transition-transform">{{ $item['title'] }}</span>
        </div>
        <div class="absolute inset-0">
          <svg class="w-full h-full block overflow-visible" viewBox="-1 -1 408 248" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path class="morph-path group-hover:fill-[#d8d8d8]" fill="#CCCCCC" stroke="#262626" stroke-width="1" vector-effect="non-scaling-stroke" />
          </svg>
        </div>
        <div class="absolute inset-0 z-10 flex items-center justify-center p-6 pt-10">
          <div class="sync-ease flex items-center justify-center group-hover:scale-105">
            <svg width="99" height="99" viewBox="0 0 99 99" fill="none" xmlns="http://www.w3.org/2000/svg">
              <g opacity="0.2" class="transition-opacity duration-300 group-hover:opacity-40">
                <path d="M15.6914 92.692C13.0445 92.692 10.7795 91.7503 8.89616 89.8671C7.01287 87.9838 6.06961 85.7171 6.06641 83.067V15.6919C6.06641 13.045 7.00966 10.7799 8.89616 8.89665C10.7827 7.01335 13.0477 6.0701 15.6914 6.06689H83.0665C85.7134 6.06689 87.9801 7.01015 89.8666 8.89665C91.7531 10.7831 92.6947 13.0482 92.6915 15.6919V83.067C92.6915 85.7139 91.7499 87.9805 89.8666 89.8671C87.9833 91.7535 85.7166 92.6952 83.0665 92.692H15.6914ZM15.6914 83.067H83.0665V15.6919H15.6914V83.067ZM20.5039 73.442H78.254L60.2071 49.3794L45.7696 68.6295L34.9414 54.1919L20.5039 73.442Z" fill="black" />
              </g>
            </svg>
          </div>
        </div>
      </div>
      @endforeach

    </div><!-- end grid -->

    {{-- See More button --}}
    <a href="#" class="works-see-more animate-fade-up fade-up" style="animation-delay: 950ms;">
      See More
    </a>

  </div>
</section>
