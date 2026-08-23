<x-layout>
    <div class="fp-container" id="fp-container">
        {{-- 20-col transition overlay — bars are painted with FROM section's bg color,
             so at scaleY:1 they are invisible against the current section.
             Staggered collapse reveals the incoming section below (no visible grid). --}}
        <div class="fp-overlay" id="fp-overlay" aria-hidden="true">
            @for ($i = 0; $i < 20; $i++)
                <div class="fp-col"></div>
            @endfor
        </div>

        {{-- All 6 Full-Page Sections --}}
        @include('sections.hero')
        @include('sections.services')
        @include('sections.works')
        @include('sections.testimonials')
        @include('sections.why')
        @include('sections.cta')
    </div>

    <x-odds-chat-widget />
</x-layout>
