<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\OddsSetting;
use App\Models\OddsService;
use App\Models\OddsWork;
use App\Models\OddsTestimonial;
use App\Models\OddsWhyReason;
use App\Models\OddsFaq;
use Illuminate\Support\Str;

class OddsContentSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Settings
        $settings = OddsSetting::current();
        $settings->update([
            'cta_email' => 'oddsdevph@gmail.com',
            'cta_phone' => '',
        ]);

        // 2. Services
        $defaultServicesData = [
            [
                'name' => "Software\nDevelopment",
                'tagline' => 'Logic. Built to last.',
                'description' => 'Custom enterprise software engineered from first principles. High performance, zero bloat, and long-term architectural stability.',
                'icon_svg' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><polyline points="16 18 22 12 16 6"></polyline><polyline points="8 6 2 12 8 18"></polyline><line x1="14" y1="4" x2="10" y2="20"></line></svg>',
                'order' => 1,
                'features' => ['Enterprise Architecture', 'High Throughput', 'Custom Algorithms', 'Clean Codebase'],
                'body_content' => [
                    ['type' => 'heading2', 'content' => 'High-Velocity Engineered Systems'],
                    ['type' => 'paragraph', 'content' => 'We design and build bespoke software solutions that tackle complex business problems with clean, scalable code. Rather than fitting your requirements into rigid off-the-shelf templates, we architect custom systems tailored specifically to your operational demands.'],
                    ['type' => 'callout', 'content' => '<strong>The ODDS Guarantee:</strong> Every line of code is stack-agnostic, thoroughly tested, and built for production reliability under heavy load.'],
                    ['type' => 'heading3', 'content' => 'Core Capabilities & Deliverables'],
                    ['type' => 'bullet', 'content' => 'Multi-tier enterprise platforms and distributed desktop software'],
                    ['type' => 'bullet', 'content' => 'Scalable microservice architectures with asynchronous task queues'],
                    ['type' => 'bullet', 'content' => 'Mission-critical database schema design, migration, and query optimization'],
                    ['type' => 'bullet', 'content' => 'Automated test coverage with continuous integration pipelines'],
                ],
            ],
            [
                'name' => "Web\nDevelopment",
                'tagline' => 'Live. Fast. Yours.',
                'description' => 'Scalable, modern cloud web applications with dynamic interactions, ultra-low latency, and responsive glassmorphism UI.',
                'icon_svg' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="3" width="20" height="14" rx="2" ry="2"></rect><line x1="8" y1="21" x2="16" y2="21"></line><line x1="12" y1="17" x2="12" y2="21"></line><line x1="2" y1="8" x2="22" y2="8"></line></svg>',
                'order' => 2,
                'features' => ['Full-Stack Web', 'Real-time Telemetry', 'Modern UI/UX', 'Cloud Hosted'],
                'body_content' => [
                    ['type' => 'heading2', 'content' => 'Modern Web Experiences at Lightning Speed'],
                    ['type' => 'paragraph', 'content' => 'From reactive customer portals to complex SaaS dashboards, we engineer web applications that load in milliseconds and provide seamless, fluid interactive experiences on every screen size.'],
                    ['type' => 'callout', 'content' => '<strong>Next-Gen Frontend + Robust Backend:</strong> We combine pixel-perfect design aesthetics with bulletproof APIs and live websockets.'],
                    ['type' => 'heading3', 'content' => 'What We Ship'],
                    ['type' => 'bullet', 'content' => 'Custom SaaS platforms with multi-tenant authentication and billing'],
                    ['type' => 'bullet', 'content' => 'Interactive admin dashboards with real-time data streaming and charts'],
                    ['type' => 'bullet', 'content' => 'SEO-optimized marketing and institutional web portals'],
                    ['type' => 'bullet', 'content' => 'Progressive Web Apps (PWAs) with offline sync support'],
                ],
            ],
            [
                'name' => "Mobile\nApplications",
                'tagline' => 'Pocket-sized. Full power.',
                'description' => 'Native and cross-platform mobile apps crafted for fluid touch UX, real-time sync, and instant device responsiveness.',
                'icon_svg' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><rect x="5" y="2" width="14" height="20" rx="3" ry="3"></rect><line x1="12" y1="18" x2="12.01" y2="18"></line><line x1="10" y1="5" x2="14" y2="5"></line></svg>',
                'order' => 3,
                'features' => ['iOS & Android', 'Cross-Platform', 'Fluid Animations', 'Offline-First'],
                'body_content' => [
                    ['type' => 'heading2', 'content' => 'Pocket-Sized Power, Zero Compromise'],
                    ['type' => 'paragraph', 'content' => 'We create iOS and Android mobile applications that deliver native performance, smooth 60fps micro-animations, and intuitive touch navigation. Whether building for millions of consumers or enterprise field teams, we ensure rock-solid stability.'],
                    ['type' => 'callout', 'content' => '<strong>Cross-Platform Efficiency:</strong> Build once with Flutter or React Native, or deploy native Swift/Kotlin modules for specialized hardware access.'],
                    ['type' => 'heading3', 'content' => 'Key Features'],
                    ['type' => 'bullet', 'content' => 'Biometric authentication (FaceID / Fingerprint) & secure local storage'],
                    ['type' => 'bullet', 'content' => 'Push notifications and background sync pipelines'],
                    ['type' => 'bullet', 'content' => 'Bluetooth Low Energy (BLE) & hardware accessory connectivity'],
                    ['type' => 'bullet', 'content' => 'App Store & Google Play Store release orchestration'],
                ],
            ],
            [
                'name' => "Backend\n& DevOps",
                'tagline' => 'Invisible. Unbreakable.',
                'description' => 'Bulletproof microservices, automated CI/CD pipelines, and cloud infrastructure engineered for 99.9% uptime and zero-friction scaling.',
                'icon_svg' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="2" width="20" height="8" rx="2" ry="2"></rect><rect x="2" y="14" width="20" height="8" rx="2" ry="2"></rect><line x1="6" y1="6" x2="6.01" y2="6"></line><line x1="6" y1="18" x2="6.01" y2="18"></line></svg>',
                'order' => 4,
                'features' => ['CI/CD Pipelines', 'Docker & K8s', 'Zero-Downtime', 'Microservices'],
                'body_content' => [
                    ['type' => 'heading2', 'content' => 'Resilient Infrastructure Behind Every Transaction'],
                    ['type' => 'paragraph', 'content' => 'The best backend is one you never have to think about because it never goes down. We design high-concurrency API backends, automated deployment pipelines, and observability telemetry to keep your systems operating flawlessly.'],
                    ['type' => 'callout', 'content' => '<strong>99.9% Uptime Mindset:</strong> Infrastructure as code, automated rollbacks, and zero-downtime blue/green deployment strategies.'],
                    ['type' => 'heading3', 'content' => 'DevOps & Backend Stack'],
                    ['type' => 'bullet', 'content' => 'RESTful & GraphQL API gateway development with token rate limiting'],
                    ['type' => 'bullet', 'content' => 'Containerized deployments with Docker, Kubernetes, and serverless compute'],
                    ['type' => 'bullet', 'content' => 'Automated GitHub Actions CI/CD workflows and staging environments'],
                    ['type' => 'bullet', 'content' => 'Real-time telemetry, log aggregation, and error alert automation'],
                ],
            ],
            [
                'name' => "Game\nDevelopment",
                'tagline' => 'Play, on purpose.',
                'description' => 'Custom 2D/3D interactive games, real-time simulations, and gamified digital experiences with fluid physics and mechanics.',
                'icon_svg' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><line x1="6" y1="12" x2="10" y2="12"></line><line x1="8" y1="10" x2="8" y2="14"></line><circle cx="15" cy="13" r="1"></circle><circle cx="18" cy="11" r="1"></circle><rect x="2" y="6" width="20" height="12" rx="6"></rect></svg>',
                'order' => 5,
                'features' => ['2D/3D Engines', 'WebGL & Unity', 'Interactive Physics', 'Gamification'],
                'body_content' => [
                    ['type' => 'heading2', 'content' => 'Engaging Interactive Worlds & Gamified Software'],
                    ['type' => 'paragraph', 'content' => 'We create captivating games, 3D interactive product showcases, and gamified business training simulations that captivate audiences with responsive gameplay and smooth physics.'],
                    ['type' => 'callout', 'content' => '<strong>Web & Native Performance:</strong> Lightweight WebGL experiences directly in the browser or native engine builds for PC, mobile, and consoles.'],
                    ['type' => 'heading3', 'content' => 'Specialized Game Capabilities'],
                    ['type' => 'bullet', 'content' => 'Custom game mechanic architecture and state machine engineering'],
                    ['type' => 'bullet', 'content' => 'Shader development and custom visual effects (VFX)'],
                    ['type' => 'bullet', 'content' => 'Gamified user onboarding and incentive reward systems'],
                    ['type' => 'bullet', 'content' => 'Multiplayer networking with low-latency client-server synchronization'],
                ],
            ],
            [
                'name' => "IoT\nSystems",
                'tagline' => 'Circuits with a pulse.',
                'description' => 'Embedded firmware, IoT sensor telemetry, custom circuit boards, and industrial microcontroller integrations.',
                'icon_svg' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><rect x="4" y="4" width="16" height="16" rx="2" ry="2"></rect><rect x="9" y="9" width="6" height="6"></rect><line x1="9" y1="1" x2="9" y2="4"></line><line x1="15" y1="1" x2="15" y2="4"></line><line x1="9" y1="20" x2="9" y2="23"></line><line x1="15" y1="20" x2="15" y2="23"></line><line x1="20" y1="9" x2="23" y2="9"></line><line x1="20" y1="15" x2="23" y2="15"></line><line x1="1" y1="9" x2="4" y2="9"></line><line x1="1" y1="15" x2="4" y2="15"></line></svg>',
                'order' => 6,
                'features' => ['IoT Sensors', 'Microcontrollers', 'Custom Firmware', 'Live Telemetry'],
                'body_content' => [
                    ['type' => 'heading2', 'content' => 'Bridging the Physical and Digital Worlds'],
                    ['type' => 'paragraph', 'content' => 'ODDS builds hardware-software systems that bring intelligence to physical devices. From custom sensor arrays to smart access gates and automated telemetry devices, we write the firmware and connect it directly to your cloud dashboard.'],
                    ['type' => 'callout', 'content' => '<strong>End-to-End Hardware Integration:</strong> We handle micro-controller logic (ESP32, STM32, Arduino, Raspberry Pi) and build the telemetry pipeline to monitor it in real-time.'],
                    ['type' => 'heading3', 'content' => 'Hardware Services'],
                    ['type' => 'bullet', 'content' => 'Custom micro-controller firmware development (C/C++, MicroPython, Rust)'],
                    ['type' => 'bullet', 'content' => 'IoT gateway integration with MQTT, WebSocket, and HTTP protocols'],
                    ['type' => 'bullet', 'content' => 'Physical device security (RFID, NFC, biometric readers, relays)'],
                    ['type' => 'bullet', 'content' => 'Live sensor telemetry dashboards with remote firmware update (OTA) capabilities'],
                ],
            ],
        ];

        foreach ($defaultServicesData as $svcData) {
            $cleanName = trim(str_replace(["\r\n", "\r", "\n"], ' ', $svcData['name']));
            $existing = OddsService::where('name', $svcData['name'])
                ->orWhere('name', $cleanName)
                ->first();

            $slug = Str::slug($cleanName);
            if ($existing) {
                $existing->update([
                    'slug' => $existing->slug ?: $slug,
                    'tagline' => $existing->tagline ?: $svcData['tagline'],
                    'description' => $existing->description ?: $svcData['description'],
                    'icon_svg' => $existing->icon_svg ?: $svcData['icon_svg'],
                    'body_content' => $existing->body_content ?: $svcData['body_content'],
                    'features' => $existing->features ?: $svcData['features'],
                    'sort_order' => $svcData['order'],
                    'is_active' => true,
                ]);
            } else {
                OddsService::create([
                    'name' => $svcData['name'],
                    'slug' => $slug,
                    'tagline' => $svcData['tagline'],
                    'description' => $svcData['description'],
                    'icon_svg' => $svcData['icon_svg'],
                    'body_content' => $svcData['body_content'],
                    'features' => $svcData['features'],
                    'sort_order' => $svcData['order'],
                    'is_active' => true,
                ]);
            }
        }

        // 3. Works — real project names + thumbnail images copied on every seed run
        // Resolve source folder: bundled repo images (Render + local), fallback to Windows path
        $imageSrcDirs = [
            database_path('seeders/images/works'),
            '/app/odds-pfl-images',
            'C:/Users/sanch/OneDrive/Pictures/ODDS-PFL',
        ];
        $imageSrcDir = null;
        foreach ($imageSrcDirs as $dir) {
            if (is_dir($dir)) { $imageSrcDir = rtrim($dir, '/\\'); break; }
        }

        $storageDir = storage_path('app/public/odds/works');
        if (!is_dir($storageDir)) { mkdir($storageDir, 0775, true); }

        $copyImage = function (string $filename) use ($imageSrcDir, $storageDir): ?string {
            if ($imageSrcDir === null) return null;
            $src  = $imageSrcDir . DIRECTORY_SEPARATOR . $filename;
            if (!file_exists($src)) return null;
            $dest = $storageDir . DIRECTORY_SEPARATOR . $filename;
            if (!file_exists($dest)) { copy($src, $dest); }
            return '/storage/odds/works/' . $filename;
        };

        $lazyQuote = "We built the design but our designer got lazy writing the proper documentation of what these projects were supposed to be.. so coming soon, (hopefully?)";

        $works = [
            [
                'title' => 'Liberty',
                'slug' => 'liberty-1',
                'year' => '2026',
                'category' => 'Web Development',
                'client' => 'Liberty Investigation & Security Agency Inc.',
                'role' => 'Front-End Rebuild & React UI',
                'desc' => 'Their old site was still stuck in an earlier era of the internet. We rebuilt it in React — bilingual EN/ZH, faster navigation, service breakdowns that make sense, and a contact flow that isn\'t a 20-field form.',
                'image' => 'Liberty_thumbnail.png',
                'sort' => 1,
                'body_content' => [
                    ['type' => 'heading2', 'content' => 'Retiring the Legacy Dinosaur'],
                    ['type' => 'paragraph', 'content' => 'Their old site was still stuck in an earlier era of the internet. Liberty handles high-trust security and private investigation, but the web presence didn\'t match the caliber of the team.'],
                    ['type' => 'callout', 'content' => '<strong>What We Changed:</strong> Rebuilt in React from the ground up — snappy, modern, bilingual (EN/ZH), and designed so prospective clients can reach real people without filling out an endless questionnaire.'],
                    ['type' => 'heading3', 'content' => 'Key Highlights'],
                    ['type' => 'bullet', 'content' => '<strong>React Front-End:</strong> Fast, lightweight navigation with zero clunkiness.'],
                    ['type' => 'bullet', 'content' => '<strong>Bilingual Support:</strong> Seamless English and Traditional Chinese (EN/ZH) localization.'],
                    ['type' => 'bullet', 'content' => '<strong>Service Breakdowns:</strong> Clear, sensible presentation of guard dispatch, security systems, and private investigation services.'],
                    ['type' => 'bullet', 'content' => '<strong>Frictionless Contact Flow:</strong> Streamlined inquiry funnel that gets straight to the point instead of a 20-field form.']
                ],
                'story_content' => "<h2>Retiring the Legacy Dinosaur</h2><p>Their old site was still stuck in an earlier era of the internet. We rebuilt it in React — bilingual EN/ZH, faster navigation, service breakdowns that make sense, and a contact flow that isn't a 20-field form.</p>"
            ],
            [
                'title' => 'SPCC Website',
                'slug' => 'spcc-website-2',
                'year' => '2026',
                'category' => 'Web Development',
                'client' => 'Systems Plus Computer College',
                'role' => 'Institutional Web Architecture',
                'desc' => '',
                'image' => 'SPCC WEBSITE.png',
                'sort' => 2,
                'body_content' => [
                    ['type' => 'heading2', 'content' => 'Under Wraps'],
                    ['type' => 'paragraph', 'content' => 'Still under NDA. More soon.'],
                    ['type' => 'callout', 'content' => '<strong>Status:</strong> Confidential. We\'ll share the details when we\'re cleared to.']
                ],
                'story_content' => "<h2>Under Wraps</h2><p>Still under NDA. More soon.</p>"
            ],
            [
                'title' => 'AVONIC',
                'slug' => 'avonic-3',
                'year' => '2025–2026',
                'category' => 'Hardware & IoT',
                'client' => 'Agricultural R&D (Won Best in Hardware)',
                'role' => 'Smart Climate Machine & Custom Firmware',
                'desc' => 'Won Best in Hardware. An automated vermicomposting machine that actually adjusts to the worms instead of just logging conditions. ESP32-S3 master/slave setup with online, offline, or physical controls, and hand-drawn cartoon worms that show their mood.',
                'image' => 'Avonic_thumbnail.png',
                'sort' => 3,
                'body_content' => [
                    ['type' => 'heading2', 'content' => 'Automated Climate That Actually Caters to the Worms'],
                    ['type' => 'paragraph', 'content' => 'This was the capstone — an automated vermicomposting machine that actually adjusts to the worms instead of just logging conditions and leaving them to it. Too hot, it cools down. Too dry, it adds moisture. So on and so forth.'],
                    ['type' => 'callout', 'content' => '<strong>Won Best in Hardware:</strong> Built on an ESP32-S3 master/slave architecture with tri-mode control and custom hand-drawn cartoon worms that express their mood based on the sensor readings.'],
                    ['type' => 'heading3', 'content' => 'Inside the Machine'],
                    ['type' => 'bullet', 'content' => '<strong>ESP32-S3 Master/Slave Setup:</strong> Distributed microcontroller architecture dividing heavy sensor reading from actuator control for rock-solid reliability.'],
                    ['type' => 'bullet', 'content' => '<strong>Tri-Mode Accessibility:</strong> Works online through web telemetry, offline over a local Wi-Fi AP, or directly through physical hardware buttons if both networks fail.'],
                    ['type' => 'bullet', 'content' => '<strong>Active Climate Adjustment:</strong> Closed-loop heating, cooling, misting, and air circulation that self-corrects the substrate environment on the fly.'],
                    ['type' => 'bullet', 'content' => '<strong>Hand-Drawn Cartoon Worm UI:</strong> We didn\'t want it to look like every other generic IoT dashboard, so the UI features hand-drawn cartoon worms whose expressions reflect the environment.']
                ],
                'story_content' => "<h2>Automated Climate That Actually Caters to the Worms</h2><p>This was the capstone — an automated vermicomposting machine that actually adjusts to the worms instead of just logging conditions and leaving them to it. Too hot, it cools down. Too dry, it adds moisture. Runs on an ESP32-S3 master/slave setup, works online, offline, or through physical controls if both fail. Won Best in Hardware.</p>"
            ],
            [
                'title' => 'MoneySense',
                'slug' => 'moneysense-4',
                'year' => '2025–2026',
                'category' => 'Mobile App & ML',
                'client' => 'Assistive Tech (Won Best in Software)',
                'role' => 'Edge ML & Non-Visual UI/UX',
                'desc' => 'Won Best in Software. A camera-based money verifier built for blind users — point it at a bill, it tells you what it is, no cloud round-trip, no lag. UI designed around how someone who can\'t see the screen actually navigates.',
                'image' => 'MoneySense.png',
                'sort' => 4,
                'body_content' => [
                    ['type' => 'heading2', 'content' => 'Camera ML Money Verifier Built for the Blind'],
                    ['type' => 'paragraph', 'content' => 'Also from capstone. A camera-based money verifier built for blind users — point it at a bill, it tells you what it is, no cloud round-trip, no lag. The whole UI was designed around how someone who can\'t see the screen actually navigates a phone, not bolted on as an afterthought.'],
                    ['type' => 'callout', 'content' => '<strong>Won Best in Software:</strong> Designed from the ground up for real-world independence when handling cash.'],
                    ['type' => 'heading3', 'content' => 'How It Works'],
                    ['type' => 'bullet', 'content' => '<strong>Instant On-Device ML:</strong> Point the camera at any bill or coin and hear what it is immediately — zero cloud round-trip, zero latency.'],
                    ['type' => 'bullet', 'content' => '<strong>Non-Visual Navigation Design:</strong> The interface was built entirely around screen-reader accessibility, haptic pulses, and tactile zones rather than visual buttons.'],
                    ['type' => 'bullet', 'content' => '<strong>Offline Reliability:</strong> Runs completely self-contained on the device without requiring cell reception or data credits in wet markets or basements.'],
                    ['type' => 'bullet', 'content' => '<strong>Speech Feedback:</strong> Clear, instant audible verification so users never have to second-guess transactions.']
                ],
                'story_content' => "<h2>Camera ML Money Verifier Built for the Blind</h2><p>Also from capstone. A camera-based money verifier built for blind users — point it at a bill, it tells you what it is, no cloud round-trip, no lag. The whole UI was designed around how someone who can't see the screen actually navigates a phone, not bolted on as an afterthought. Won Best in Software.</p>"
            ],
            [
                'title' => 'SIBOL',
                'slug' => 'sibol-5',
                'year' => '2026',
                'category' => 'IoT & AgriTech',
                'client' => 'Barangay Smart Agriculture',
                'role' => 'LoRa Telemetry, ESP32 & Plant ML',
                'desc' => 'Farm tracking for barangay-level plots that don\'t have real internet access. Runs on LoRa instead of Wi-Fi so it still works miles out, and uses ESP32 + ML to check plant and leaf health from sensor data, not just soil readings.',
                'image' => 'sibol.png',
                'sort' => 5,
                'body_content' => [
                    ['type' => 'heading2', 'content' => 'Grassroots Farm Tracking Miles Off the Grid'],
                    ['type' => 'paragraph', 'content' => 'Farm tracking for barangay-level plots that don\'t have real internet access. Runs on LoRa instead of Wi-Fi so it still works miles out, and uses ESP32 + ML to check plant and leaf health from sensor data, not just soil readings.'],
                    ['type' => 'callout', 'content' => '<strong>Built for the Real Field:</strong> Solving agricultural connectivity where cell towers don\'t reach by pairing long-range radio with on-device intelligence.'],
                    ['type' => 'heading3', 'content' => 'Technical Highlights'],
                    ['type' => 'bullet', 'content' => '<strong>LoRa Wireless Telemetry:</strong> Transmits critical field data miles across rural terrain without expensive cellular SIMs or Wi-Fi dependencies.'],
                    ['type' => 'bullet', 'content' => '<strong>ESP32 + ML Leaf & Plant Health:</strong> Runs edge machine learning to inspect plant leaves and catch disease early right from sensor and vision data.'],
                    ['type' => 'bullet', 'content' => '<strong>Comprehensive Ground Metrics:</strong> Real-time environmental tracking beyond soil readings to give farmers a complete picture of microclimate health.'],
                    ['type' => 'bullet', 'content' => '<strong>Barangay-Level Hub:</strong> Practical, localized monitoring station built for actual daily use by local farming communities.']
                ],
                'story_content' => "<h2>Grassroots Farm Tracking Miles Off the Grid</h2><p>Farm tracking for barangay-level plots that don't have real internet access. Runs on LoRa instead of Wi-Fi so it still works miles out, and uses ESP32 + ML to check plant and leaf health from sensor data, not just soil readings.</p>"
            ],
            [
                'title' => 'THEODORE',
                'slug' => 'theodore-6',
                'year' => '2025',
                'category' => 'Security & Vision',
                'client' => 'Industrial Safety & Fire Detection',
                'role' => 'ESP32 Camera ML & Thermal Triage',
                'desc' => 'The project that actually got ODDS started. ESP32 camera + ML that watches for heat spikes and flame patterns, tells the difference between a machine running hot and an actual fire, and tiers the response — eventually meant to call BFP directly.',
                'image' => 'THEODORE PREVIEW.png',
                'sort' => 6,
                'body_content' => [
                    ['type' => 'heading2', 'content' => 'The Origin Story of ODDS'],
                    ['type' => 'paragraph', 'content' => 'The project that actually got ODDS started. An ESP32 camera paired with machine learning that watches for heat spikes and flame patterns, tells the difference between a machine running hot and an actual fire, and tiers the response.'],
                    ['type' => 'callout', 'content' => '<strong>Autonomous Emergency Calling:</strong> Designed with tiered threat levels and architected with the potential to call BFP (Bureau of Fire Protection) directly once we get there.'],
                    ['type' => 'heading3', 'content' => 'Inside the Rig'],
                    ['type' => 'bullet', 'content' => '<strong>ESP32 Camera + ML:</strong> Microcontroller-based machine learning pipeline trained to spot genuine flame behavior and thermal activity.'],
                    ['type' => 'bullet', 'content' => '<strong>Smart False-Alarm Filtering:</strong> Knows the difference between normal industrial heat or engines running hot versus an active, dangerous fire.'],
                    ['type' => 'bullet', 'content' => '<strong>Tiered Response System:</strong> Escalates warnings progressively depending on thermal severity rather than causing immediate false alarm panic.'],
                    ['type' => 'bullet', 'content' => '<strong>Direct Dispatch Architecture:</strong> Engineered to connect directly with emergency response systems and dispatch alerts autonomously.']
                ],
                'story_content' => "<h2>The Origin Story of ODDS</h2><p>The project that actually got ODDS started. ESP32 camera + ML that watches for heat spikes and flame patterns, tells the difference between a machine running hot and an actual fire, and tiers the response — eventually meant to call BFP directly once we get there.</p>"
            ],
            [
                'title' => 'HALLET',
                'slug' => 'hallet-7',
                'year' => '2026',
                'category' => 'Mobile App',
                'client' => 'Personal FinTech & Companion App',
                'role' => 'Dart Mobile App & Playful Pink UI',
                'desc' => 'Not every project needs to be a system. This one\'s just a Dart app, built pink, built for someone specific — a reminder to ourselves that we can build things that are just warm and useful instead of impressive.',
                'image' => 'HALLET.png',
                'sort' => 7,
                'body_content' => [
                    ['type' => 'heading2', 'content' => 'Warm, Useful, and Built with Love'],
                    ['type' => 'paragraph', 'content' => 'Not every project needs to be a system. This one\'s just a Dart app, built pink, built for someone specific — a reminder to ourselves that we can build things that are just warm and useful instead of impressive.'],
                    ['type' => 'callout', 'content' => '<strong>The Heart of ODDS:</strong> Not everything we ship has to be hardcore hardware or enterprise backends. Sometimes software just needs to show love and make daily life a little better.'],
                    ['type' => 'heading3', 'content' => 'App Highlights'],
                    ['type' => 'bullet', 'content' => '<strong>Crafted in Dart:</strong> Snappy, clean mobile architecture with fluid animations and zero overhead.'],
                    ['type' => 'bullet', 'content' => '<strong>Proudly Pink UI:</strong> Unapologetically colorful and playful aesthetic crafted to bring personality to utility.'],
                    ['type' => 'bullet', 'content' => '<strong>Everyday Practicality:</strong> Frictionless daily finance and tracking designed for real-world convenience.'],
                    ['type' => 'bullet', 'content' => '<strong>Personal Craft:</strong> Proof of ODDS\'s flexibility to adapt code to human emotion and care.']
                ],
                'story_content' => "<h2>Warm, Useful, and Built with Love</h2><p>Not every project needs to be a system. This one's just a Dart app, built pink, built for someone specific — a reminder to ourselves that we can build things that are just warm and useful instead of impressive.</p>"
            ],
            [
                'title' => 'LITIKS',
                'slug' => 'litiks-8',
                'year' => '2026',
                'category' => 'Analytics Platform',
                'client' => 'Multi-Branch Commercial Business',
                'role' => 'PHP Laravel & Holt-Winters Predictive Math',
                'desc' => 'Built for a business running multiple branches with zero visibility into how each one was actually performing. Laravel backend, uses Holt-Winters exponential smoothing so it accounts for seasonality and trend instead of just averaging numbers together.',
                'image' => 'LITIKS_THUMBNA.png',
                'sort' => 8,
                'body_content' => [
                    ['type' => 'heading2', 'content' => 'Visibility Across Branches with Real Predictive Math'],
                    ['type' => 'paragraph', 'content' => 'Built for a business running multiple branches with zero visibility into how each one was actually performing. LITIKS aggregates data from across branches to give leadership real insight into store-level performance.'],
                    ['type' => 'callout', 'content' => '<strong>Holt-Winters Exponential Smoothing:</strong> Employs triple exponential smoothing to account for seasonality and underlying trends instead of just naively averaging numbers together.'],
                    ['type' => 'heading3', 'content' => 'Platform Capabilities'],
                    ['type' => 'bullet', 'content' => '<strong>PHP Laravel Engine:</strong> High-performance backend wrangling multi-location transaction streams with optimized query caching.'],
                    ['type' => 'bullet', 'content' => '<strong>Holt-Winters Forecasting:</strong> Statistically robust forecasting that models seasonal surges and baseline growth for reliable inventory demand planning.'],
                    ['type' => 'bullet', 'content' => '<strong>Cross-Branch Comparisons:</strong> Clear performance benchmarking revealing which locations are thriving and which need intervention.'],
                    ['type' => 'bullet', 'content' => '<strong>Automated Trend Alerts:</strong> Highlights anomalous shifts in sales volume or traffic before small hiccups become serious operational problems.']
                ],
                'story_content' => "<h2>Visibility Across Branches with Real Predictive Math</h2><p>Built for a business running multiple branches with zero visibility into how each one was actually performing. Laravel backend, uses Holt-Winters exponential smoothing so it accounts for seasonality and trend instead of just averaging numbers together.</p>"
            ],
            [
                'title' => 'TRYSEN',
                'slug' => 'trysen-9',
                'year' => '2026',
                'category' => 'Security & Systems',
                'client' => 'Campus & Institutional Attendance',
                'role' => 'Dart Mobile App & Facial Recognition ML',
                'desc' => 'One of a few attendance systems we\'ve built, this one a Dart app that logs attendance by scanning a face directly instead of cards or manual sign-in.',
                'image' => 'TRYSEN_Thumbnail.png',
                'sort' => 9,
                'body_content' => [
                    ['type' => 'heading2', 'content' => 'Instant Face Scan Attendance in Dart'],
                    ['type' => 'paragraph', 'content' => 'One of a few attendance systems we\'ve built, this one a Dart app that logs attendance by scanning a face directly instead of cards or manual sign-in.'],
                    ['type' => 'callout', 'content' => '<strong>Ditch the Cards:</strong> Frictionless, touchless attendance verification powered by on-device computer vision.'],
                    ['type' => 'heading3', 'content' => 'Architecture & Features'],
                    ['type' => 'bullet', 'content' => '<strong>Dart Mobile Framework:</strong> Lightweight, ultra-responsive camera initialization and 60fps face detection.'],
                    ['type' => 'bullet', 'content' => '<strong>Edge ML Biometric Matching:</strong> Rapid facial vector comparison against enrolled roster profiles in milliseconds.'],
                    ['type' => 'bullet', 'content' => '<strong>Anti-Spoofing Protection:</strong> Liveness validation to ensure verified attendance logs represent real physical humans present.'],
                    ['type' => 'bullet', 'content' => '<strong>Instant Audit Streaming:</strong> Automatically synchronizes time-stamped attendance logs for clean administrative reporting without manual clipboards.']
                ],
                'story_content' => "<h2>Instant Face Scan Attendance in Dart</h2><p>One of a few attendance systems we've built, this one a Dart app that logs attendance by scanning a face directly instead of cards or manual sign-in.</p>"
            ],
        ];

        // Always truncate + re-seed works so names, descriptions and images stay in sync
        OddsWork::truncate();
        foreach ($works as $w) {
            OddsWork::create([
                'title'         => $w['title'],
                'slug'          => $w['slug'],
                'category'      => $w['category'],
                'client'        => $w['client'] ?? '',
                'role'          => $w['role'] ?? '',
                'year'          => $w['year'],
                'description'   => $w['desc'],
                'body_content'  => $w['body_content'] ?? [],
                'story_content' => $w['story_content'] ?? '',
                'cover_image'   => $copyImage($w['image']),
                'sort_order'    => $w['sort'],
                'is_featured'   => true,
                'is_active'     => true,
                'count_in_kpi'  => true,
            ]);
        }

        // 4. Testimonials
        if (OddsTestimonial::count() === 0) {
            $testimonials = [
                [
                    'name' => 'Joe Ree',
                    'initials' => 'JR',
                    'role' => 'CEO',
                    'company' => 'TechStart',
                    'stars' => 5,
                    'text' => 'Speed means nothing if the system breaks under pressure. ODDS delivered a rock-solid, production-ready system well ahead of our aggressive launch schedule.'
                ],
                [
                    'name' => 'Sarah Lin',
                    'initials' => 'SL',
                    'role' => 'Director',
                    'company' => 'ClearGuard',
                    'stars' => 5,
                    'text' => 'They took our vague operational requirements and built an elegant, stack-agnostic hardware-software solution without bloated turnaround times.'
                ],
                [
                    'name' => 'Alex Rivera',
                    'initials' => 'AR',
                    'role' => 'Founder',
                    'company' => 'PRISMA Data',
                    'stars' => 5,
                    'text' => 'The velocity and intentionality ODDS brings to the table is unmatched. They do not just build prototypes—they ship battle-tested code.'
                ],
                [
                    'name' => 'Marcus Vance',
                    'initials' => 'MV',
                    'role' => 'CTO',
                    'company' => 'Sentry Ops',
                    'stars' => 4,
                    'text' => 'Highly disciplined team of engineers who build with purpose. Rapid deployment with zero downtime during our cloud migration.'
                ],
                [
                    'name' => 'Elena Rostova',
                    'initials' => 'ER',
                    'role' => 'VP Engineering',
                    'company' => 'Nexus Dynamics',
                    'stars' => 5,
                    'text' => 'A true complete package. From custom hardware integrations to sleek web dashboards, ODDS is our go-to execution partner.'
                ],
            ];

            foreach ($testimonials as $index => $t) {
                OddsTestimonial::create([
                    'name' => $t['name'],
                    'initials' => $t['initials'],
                    'role' => $t['role'],
                    'company' => $t['company'],
                    'stars' => $t['stars'],
                    'text' => $t['text'],
                    'sort_order' => $index + 1,
                    'is_active' => true,
                ]);
            }
        }

        // 5. Why Reasons
        if (OddsWhyReason::count() === 0) {
            $reasons = [
                [
                    'title' => 'Stack-Agnostic Engineering',
                    'text' => 'We build what fits your reality. Whether you need ultra-fast native code or a specific language stack, we architect the exact system your business demands.',
                    'order' => 1
                ],
                [
                    'title' => 'End-to-End Flexibility',
                    'text' => 'A dynamic, multi-service pipeline. Deploy us to solve a single operational bottleneck, or leverage our complete software, design, and hardware capabilities.',
                    'order' => 2
                ],
                [
                    'title' => 'Velocity-Driven Delivery',
                    'text' => 'No endless planning loops. We map precise sequences and execute aggressively to ship stable, production-ready systems exactly when you need them.',
                    'order' => 3
                ],
            ];

            foreach ($reasons as $r) {
                OddsWhyReason::create([
                    'title' => $r['title'],
                    'text' => $r['text'],
                    'sort_order' => $r['order'],
                    'is_active' => true,
                ]);
            }
        }

        // 6. FAQs
        if (OddsFaq::count() === 0) {
            $faqs = [
                [
                    'question' => "Do I need a finished spec to start?",
                    'answer'   => "No — we scope with you first, starting from a rough idea or a problem you need solved.",
                ],
                [
                    'question' => "How long from first contact to kickoff?",
                    'answer'   => "A few days once we've scoped the work.",
                ],
                [
                    'question' => "Do I need a technical co-founder to work with you?",
                    'answer'   => "No — we work directly with non-technical founders and teams.",
                ],
                [
                    'question' => "How does pricing work?",
                    'answer'   => "Based on scope and depth of involvement — quoted only after we've scoped the work together, no hidden costs.",
                ],
                [
                    'question' => "Who owns the code once it's done?",
                    'answer'   => "Full ownership typically transfers to you.",
                ],
            ];

            foreach ($faqs as $index => $faq) {
                OddsFaq::create([
                    'question'   => $faq['question'],
                    'answer'     => $faq['answer'],
                    'sort_order' => $index + 1,
                    'is_active'  => true,
                ]);
            }
        }

        // 7. Team Member Photos
        $teamSrcDirs = [
            database_path('seeders/images/team'),
            'C:/Users/sanch/Downloads',
            '/app/odds-team-images',
        ];
        $teamSrcDir = null;
        foreach ($teamSrcDirs as $dir) {
            if (is_dir($dir)) { $teamSrcDir = rtrim($dir, '/\\'); break; }
        }

        $teamStorageDir = storage_path('app/public/odds/team');
        if (!is_dir($teamStorageDir)) { mkdir($teamStorageDir, 0775, true); }

        $teamImages = [
            'Jerico_Sanchez.jpg',
            'Robert_Santiago.jpeg',
            'Brix_Cura.jpeg',
            'Jazam_Laranio.jpeg',
            'Mark_Paulo_Franco.jpeg',
            'John_Cedric_Abaloyan.jpeg',
            'Sherwin_Ramirez.jpeg',
        ];

        if ($teamSrcDir !== null) {
            foreach ($teamImages as $imgName) {
                $src = $teamSrcDir . DIRECTORY_SEPARATOR . $imgName;
                $dest = $teamStorageDir . DIRECTORY_SEPARATOR . $imgName;
                if (file_exists($src) && (!file_exists($dest) || filesize($src) !== filesize($dest))) {
                    copy($src, $dest);
                }
            }
        }
    }
}
