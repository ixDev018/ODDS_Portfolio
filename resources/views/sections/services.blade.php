<!-- ========================
     SERVICES SECTION
     ======================== -->
<section class="services section-pad" id="services">
    <div class="container-mid">
        <p class="services-label gsap-fade-up">Services</p>
        <h2 class="services-title gsap-fade-up">
            We are a <em>COMPLETE PACKAGE</em>
        </h2>

        <div class="services-grid gsap-fade-up" id="services-grid">
            @php
                $services = [
                    ['icon' => '🌐', 'title' => 'Web-App Development'],
                    ['icon' => '📱', 'title' => 'Mobile Applications'],
                    ['icon' => '⚙️', 'title' => 'Backend & DevOps'],
                    ['icon' => '🎮', 'title' => 'Game Development'],
                    ['icon' => '🎨', 'title' => 'UI/UX Design'],
                    ['icon' => '🖥️', 'title' => 'Hardware Solutions'],
                ];
            @endphp

            @foreach($services as $service)
            <div class="service-card">
                <div class="service-card-icon">{{ $service['icon'] }}</div>
                <p class="service-card-title">{{ $service['title'] }}</p>
            </div>
            @endforeach
        </div>

        <p class="services-description gsap-fade-up">
            Business problems aren't solved by generic templates. Whether you need a standalone
            service or a fully integrated package, we engineer the exact solution your operations demand.
        </p>

        <a href="#cta" class="btn-dark gsap-fade-up">Let's Build</a>
    </div>
</section>
