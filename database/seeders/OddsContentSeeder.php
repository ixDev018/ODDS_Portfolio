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
        OddsSetting::current();

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
                'name' => "Web-App\nDevelopment",
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
                'name' => "Hardware\nSolutions",
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

        // 3. Works
        if (OddsWork::count() === 0) {
            $works = [
                ['title' => 'THEODORE', 'year' => '2024', 'category' => 'Web App & AI', 'desc' => 'High-velocity AI integration and document automation system.'],
                ['title' => 'ClassGuard', 'year' => '2024', 'category' => 'Security & Systems', 'desc' => 'Automated attendance & campus security hardware-software module.'],
                ['title' => 'PRISMA', 'year' => '2024', 'category' => 'Analytics Platform', 'desc' => 'Real-time telemetry and data aggregation dashboard for enterprise.'],
                ['title' => 'Sentry', 'year' => '2023', 'category' => 'DevOps & Monitoring', 'desc' => 'Infrastructure monitoring pipeline with ultra-low latency alerts.'],
                ['title' => 'SPCC Website', 'year' => '2023', 'category' => 'Web Development', 'desc' => 'Modern institutional web portal designed for scale and accessibility.'],
                ['title' => 'LISAI Website', 'year' => '2023', 'category' => 'Web & CMS', 'desc' => 'Custom content-managed portal with dynamic case study showcases.'],
                ['title' => 'ALAMS', 'year' => '2023', 'category' => 'Enterprise System', 'desc' => 'Asset lifecycle & maintenance scheduling architecture.'],
                ['title' => 'AVONIC', 'year' => '2023', 'category' => 'Hardware & IoT', 'desc' => 'Embedded device control system and smart terminal firmware.'],
                ['title' => 'SPCC Portal', 'year' => '2022', 'category' => 'Academic System', 'desc' => 'Student enrollment and grading pipeline with role-based access.'],
            ];

            foreach ($works as $index => $w) {
                OddsWork::create([
                    'title' => $w['title'],
                    'slug' => Str::slug($w['title'] . '-' . ($index + 1)),
                    'category' => $w['category'],
                    'year' => $w['year'],
                    'description' => $w['desc'],
                    'story_content' => "<h3>The Challenge</h3><p>{$w['desc']}</p><h3>The ODDS Solution</h3><p>Engineered using stack-agnostic principles for high stability and immediate deployment.</p>",
                    'sort_order' => $index + 1,
                    'is_featured' => true,
                    'is_active' => true,
                ]);
            }
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
                    'question' => "We don't have a technical spec yet — can you still help?",
                    'answer' => "Yes. Most of what we take on starts as a rough idea, not a finished spec. We'll work with you to scope the actual problem before writing a line of code.",
                ],
                [
                    'question' => "What's the smallest project you'll take on?",
                    'answer' => "There isn't a minimum. We've shipped single technical modules and full end-to-end builds. Scope decides the timeline and cost, not whether we'll take the work.",
                ],
                [
                    'question' => "How fast is \"fast,\" really?",
                    'answer' => "Depends on scope — a focused module can ship in days, a full platform takes longer. We'll give you a real timeline range after scoping, not a vague promise.",
                ],
                [
                    'question' => "How do you keep quality high while moving quickly?",
                    'answer' => "Speed comes from cutting planning overhead, not testing. We ship production-ready systems, not prototypes dressed up as final products.",
                ],
                [
                    'question' => "What does the process look like after I reach out?",
                    'answer' => "You'll hear back within 24 hours with next steps — a short scoping call, then a timeline and quote before any work starts.",
                ],
                [
                    'question' => "How is pricing structured?",
                    'answer' => "Project-based quotes are the default, since scope is usually clearer than hours. We're flexible if hourly makes more sense for the work.",
                ],
                [
                    'question' => "What happens if something breaks after launch?",
                    'answer' => "You contact us and we fix it. We stand behind what we ship.",
                ],
                [
                    'question' => "Do you offer post-launch support or maintenance?",
                    'answer' => "Yes, available as an ongoing arrangement if you want it — not required.",
                ],
                [
                    'question' => "Who owns the code and IP once the project is done?",
                    'answer' => "You do. Full ownership transfers on project completion.",
                ],
                [
                    'question' => "Do I need to know what tech stack I want?",
                    'answer' => "No. We're stack-agnostic — we'll recommend what actually fits your problem rather than pushing whatever we're most comfortable with.",
                ],
            ];

            foreach ($faqs as $index => $faq) {
                OddsFaq::create([
                    'question' => $faq['question'],
                    'answer' => $faq['answer'],
                    'sort_order' => $index + 1,
                    'is_active' => true,
                ]);
            }
        }
    }
}
