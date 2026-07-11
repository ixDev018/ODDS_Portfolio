<x-layout>
    <div class="hero-services-wrapper">
        <div class="services-bg-color"></div>
        <div class="shared-glow-left"></div>
        <div class="shared-glow-right"></div>
        
        <div class="services-transition-overlay">
            <div class="trans-col"></div>
            <div class="trans-col"></div>
            <div class="trans-col"></div>
            <div class="trans-col"></div>
            <div class="trans-col"></div>
            <div class="trans-col"></div>
            <div class="trans-col"></div>
            <div class="trans-col"></div>
            <div class="trans-col"></div>
            <div class="trans-col"></div>
            <div class="trans-col"></div>
            <div class="trans-col"></div>
            <div class="trans-col"></div>
            <div class="trans-col"></div>
            <div class="trans-col"></div>
            <div class="trans-col"></div>
            <div class="trans-col"></div>
            <div class="trans-col"></div>
            <div class="trans-col"></div>
            <div class="trans-col"></div>
        </div>

        @include('sections.services')
        @include('sections.hero')
    </div>
    @include('sections.works')
    @include('sections.testimonials')
    @include('sections.why')
    @include('sections.cta')
    
    <x-odds-chat-widget />
</x-layout>
