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
        $defaultWorks = [
            [
                'title' => 'THEODORE',
                'year' => '2024',
                'category' => 'Web App & AI',
                'desc' => 'High-velocity AI integration and document automation system.',
                'client' => 'Enterprise AI Solutions',
                'role' => 'Full-Stack Architecture & AI Integration',
                'tech_stack' => ['Laravel', 'Python', 'FastAPI', 'OpenAI', 'Tailwind CSS'],
                'body_content' => [
                    ['type' => 'callout', 'content' => '<strong>Executive Summary:</strong> High-velocity AI integration and document automation platform for enterprise workflows.'],
                    ['type' => 'heading2', 'content' => 'The Challenge'],
                    ['type' => 'paragraph', 'content' => 'Legacy document handling created high operational latency and manual processing errors.'],
                    ['type' => 'heading2', 'content' => 'The ODDS Solution'],
                    ['type' => 'paragraph', 'content' => 'Engineered automated AI pipelines and responsive dashboards built for rapid throughput.'],
                ],
            ],
            [
                'title' => 'ClassGuard',
                'year' => '2024',
                'category' => 'Security & Systems',
                'desc' => 'Automated attendance & campus security hardware-software module.',
                'client' => 'Educational & Institutional Security',
                'role' => 'Embedded Systems & Real-Time Monitoring',
                'tech_stack' => ['ESP32', 'RFID/Biometrics', 'Laravel', 'WebSockets', 'MySQL'],
                'body_content' => [
                    ['type' => 'callout', 'content' => '<strong>Executive Summary:</strong> Integrated hardware-software security and automated attendance telemetry system.'],
                    ['type' => 'heading2', 'content' => 'The Challenge'],
                    ['type' => 'paragraph', 'content' => 'Manual campus verification caused long queues and unreliable entry audit trails.'],
                    ['type' => 'heading2', 'content' => 'The ODDS Solution'],
                    ['type' => 'paragraph', 'content' => 'Developed custom micro-controller access gates paired with a real-time web monitoring suite.'],
                ],
            ],
            [
                'title' => 'PRISMA',
                'year' => '2024',
                'category' => 'Analytics Platform',
                'desc' => 'Multi-branch retail intelligence platform replacing static sales sheets with real-time KPI telemetry, Holt-Winters predictive demand forecasting, and automated RFM customer clustering.',
                'client' => null,
                'role' => null,
                'tech_stack' => ['Laravel', 'MySQL', 'Chart.js', 'Tailwind CSS', 'Holt-Winters Engine', 'DomPDF', 'Docker'],
                'count_in_kpi' => true,
                'body_content' => [
                    [
                        'type' => 'callout',
                        'content' => '<strong>Executive Summary:</strong> PRISMA replaces end-of-day spreadsheets across multi-branch retail chains with live operational telemetry, predictive Holt-Winters demand forecasting, and automated RFM customer segmentation.',
                    ],
                    [
                        'type' => 'heading2',
                        'content' => '1. The Challenge: Fragmented Data & Reactive Stocking',
                    ],
                    [
                        'type' => 'paragraph',
                        'content' => 'Retail chains with distributed store locations frequently operate with siloed point-of-sale systems and disconnected end-of-day reports. This creates critical operational blind spots: inventory shortages are caught only after sales are already lost, branch managers lack localized visibility, and customer purchase data remains unmined.',
                    ],
                    [
                        'type' => 'image',
                        'src' => '/storage/works/prisma/dashboard-overview.png',
                        'caption' => 'PRISMA Executive Dashboard: Real-time branch revenue telemetry, KPI cards, and dynamic sales trends.',
                    ],
                    [
                        'type' => 'heading2',
                        'content' => '2. The Solution: Unified Intelligence & Predictive Modeling',
                    ],
                    [
                        'type' => 'paragraph',
                        'content' => 'ODDS architected PRISMA from the ground up as a unified web platform that ingests raw branch transaction logs and transforms them into predictive operational intelligence.',
                    ],
                    [
                        'type' => 'heading3',
                        'content' => 'Key Capabilities Delivered',
                    ],
                    [
                        'type' => 'bullet',
                        'content' => '<strong>Holt-Winters Predictive Forecasting:</strong> Statistical triple-exponential smoothing projecting demand trends with 95% confidence bounds and real-time MAPE validation.',
                    ],
                    [
                        'type' => 'bullet',
                        'content' => '<strong>RFM Customer Segmentation:</strong> Automated scoring (Recency, Frequency, Monetary) that dynamically categorizes customers into VIP, Loyal, and At-Risk tiers.',
                    ],
                    [
                        'type' => 'bullet',
                        'content' => '<strong>Market Basket & Cross-Selling:</strong> Apriori-style association analysis calculating Support, Confidence, and Lift to optimize shelf merchandising.',
                    ],
                    [
                        'type' => 'bullet',
                        'content' => '<strong>Automated Inventory Audits:</strong> Hourly background cron auditing threshold limits per branch, dispatching throttled email alerts before out-of-stock events occur.',
                    ],
                    [
                        'type' => 'image',
                        'src' => '/storage/works/prisma/forecasting-rfm-analytics.png',
                        'caption' => 'Holt-Winters demand projection curves with confidence intervals alongside RFM customer clustering.',
                    ],
                    [
                        'type' => 'heading2',
                        'content' => '3. Architecture & Enterprise Security',
                    ],
                    [
                        'type' => 'paragraph',
                        'content' => 'Engineered with strict multi-branch data isolation, localized role-based access control (RBAC), and SHA-256 deduplicated CSV batch ingestion to ensure data integrity under high daily transaction loads.',
                    ],
                    [
                        'type' => 'image',
                        'src' => '/storage/works/prisma/mobile-responsive-showcase.png',
                        'caption' => 'Responsive mobile-first interface designed for store managers on the floor with dark/light mode support.',
                    ],
                    [
                        'type' => 'heading2',
                        'content' => '4. Business Outcomes',
                    ],
                    [
                        'type' => 'numbered',
                        'content' => '<strong>90% Reduction in Reporting Overhead:</strong> Eliminated manual spreadsheet collation across branches.',
                    ],
                    [
                        'type' => 'numbered',
                        'content' => '<strong>Zero Preventable Stockouts:</strong> Proactive safety stock threshold alerts protected core margins.',
                    ],
                    [
                        'type' => 'numbered',
                        'content' => '<strong>High-Yield Cross Selling:</strong> Data-driven product bundle suggestions boosted average transaction value.',
                    ],
                ],
            ],
            [
                'title' => 'Sentry',
                'year' => '2023',
                'category' => 'DevOps & Monitoring',
                'desc' => 'Infrastructure monitoring pipeline with ultra-low latency alerts.',
                'client' => 'Cloud Infrastructure Systems',
                'role' => 'DevOps & Telemetry Engineering',
                'tech_stack' => ['Docker', 'Prometheus', 'Grafana', 'Laravel', 'Redis'],
                'body_content' => [
                    ['type' => 'callout', 'content' => '<strong>Executive Summary:</strong> Zero-downtime infrastructure heartbeat monitor with instant alert routing.'],
                    ['type' => 'heading2', 'content' => 'The Challenge'],
                    ['type' => 'paragraph', 'content' => 'Unmonitored cloud instances led to delayed outage detection and high recovery MTTR.'],
                    ['type' => 'heading2', 'content' => 'The ODDS Solution'],
                    ['type' => 'paragraph', 'content' => 'Architected a lightweight heartbeat collector with automated alert dispatch.'],
                ],
            ],
            [
                'title' => 'SPCC Website',
                'year' => '2024',
                'category' => 'Web Architecture & Dynamic CMS',
                'desc' => 'Complete institutional digital transformation overhauling a legacy static site into a high-performance web portal with dynamic admissions, live student journalism CMS, and real-time administrative control.',
                'client' => null,
                'role' => null,
                'tech_stack' => ['Laravel 12', 'Blade Components', 'Tailwind CSS', 'MySQL', 'Figma Design System', 'JavaScript'],
                'count_in_kpi' => true,
                'body_content' => [
                    [
                        'type' => 'callout',
                        'content' => '<strong>Executive Summary:</strong> A complete digital transformation replacing Systems Plus Computer College’s abandoned static website with an agile, high-conversion web platform. Features instantaneous page routing, categorized admission funnels, an integrated student journalism engine, and a full-featured admin CMS.',
                    ],
                    [
                        'type' => 'heading2',
                        'content' => '1. The Challenge: Legacy Bottlenecks & Frozen Content',
                    ],
                    [
                        'type' => 'paragraph',
                        'content' => 'Prior to the overhaul, the institution’s web presence suffered from severe technical and usability handicaps that directly damaged credibility and student recruitment:',
                    ],
                    [
                        'type' => 'bullet',
                        'content' => '<strong>The "Static Code" Maintenance Trap:</strong> The website lacked an admin dashboard. Even minor typo corrections, schedule adjustments, or emergency announcements required manual code editing and redeployment, leaving the campus calendar frozen for over 2 years.',
                    ],
                    [
                        'type' => 'bullet',
                        'content' => '<strong>Forced Loading Screens & High Bounce Rates:</strong> A mandatory 1–3 second loading screen interrupted every single internal page navigation, causing high friction for mobile-first prospective students and parents.',
                    ],
                    [
                        'type' => 'bullet',
                        'content' => '<strong>Fragmented Information Architecture:</strong> Confusing dual menus (top bar plus dark vertical sidebar) and buried calls-to-action resulted in missed enrollment conversions and user frustration.',
                    ],
                    [
                        'type' => 'image',
                        'src' => '/storage/works/spcc/legacy-audit-comparison.png',
                        'caption' => 'Legacy Website Audit: Outdated design, frozen event calendar, poor text contrast, and intrusive loading screens.',
                    ],
                    [
                        'type' => 'heading2',
                        'content' => '2. The Solution: Institutional Modernization & Dynamic CMS Engine',
                    ],
                    [
                        'type' => 'paragraph',
                        'content' => 'ODDS executed a complete ground-up re-architecture using Laravel 12 and a Figma-engineered Design System, delivered through a continuous deployment assembly line.',
                    ],
                    [
                        'type' => 'heading3',
                        'content' => 'Core Systems Delivered',
                    ],
                    [
                        'type' => 'bullet',
                        'content' => '<strong>Unified Institutional CMS & Admin Suite:</strong> Empowered non-technical academic staff to manage announcements, update program curricula, edit academic calendars, and moderate user feedback in real time without touching code.',
                    ],
                    [
                        'type' => 'bullet',
                        'content' => '<strong>Dynamic Multi-Tier Admissions Portal:</strong> Replaced generic requirement lists with an interactive admissions funnel that automatically tailors prerequisites and steps based on applicant status (New Student, Transferee, Irregular).',
                    ],
                    [
                        'type' => 'bullet',
                        'content' => '<strong>The SPCnian Bugle (Digital Journalism Hub):</strong> Integrated a content management workflow for the official student publication, featuring multi-category articles, editorial approval states, and rich media showcases.',
                    ],
                    [
                        'type' => 'bullet',
                        'content' => '<strong>Zero-Latency Public Portal:</strong> Eliminated all artificial loading barriers, delivering sub-second page transitions, responsive mobile typography, and branded high-contrast UI (SPCC Navy & Gold).',
                    ],
                    [
                        'type' => 'image',
                        'src' => '/storage/works/spcc/modernized-portal-showcase.png',
                        'caption' => 'The Modernized SPCC Platform: High-conversion hero section, dynamic programs catalog, and interactive campus facilities gallery.',
                    ],
                    [
                        'type' => 'heading2',
                        'content' => '3. Architecture & Agile Execution',
                    ],
                    [
                        'type' => 'paragraph',
                        'content' => 'Built with modular Laravel Blade components and strict role-based access control (RBAC), ensuring that administrative permissions are securely segregated between super administrators, faculty contributors, and student editors.',
                    ],
                    [
                        'type' => 'image',
                        'src' => '/storage/works/spcc/spcc-admin-dashboard.png',
                        'caption' => 'Administrative Control Center: Real-time event publisher, inquiry inbox routing, and automated activity logging.',
                    ],
                    [
                        'type' => 'heading2',
                        'content' => '4. Business & Institutional Impact',
                    ],
                    [
                        'type' => 'numbered',
                        'content' => '<strong>100% Operational Autonomy:</strong> Completely eliminated reliance on external developers for routine content publishing and institutional notices.',
                    ],
                    [
                        'type' => 'numbered',
                        'content' => '<strong>Streamlined Enrollment Funnel:</strong> Prominent "Apply Now" CTAs and intelligent dynamic requirements accelerated admission inquiry turnaround times.',
                    ],
                    [
                        'type' => 'numbered',
                        'content' => '<strong>Elevated Institutional Brand:</strong> Transformed a neglected digital footprint into a responsive, award-worthy flagship portal for thousands of students and faculty members.',
                    ],
                ],
            ],
            [
                'title' => 'LISAI Website',
                'year' => '2023',
                'category' => 'Web & CMS',
                'desc' => 'Custom content-managed portal with dynamic case study showcases.',
                'client' => 'Design & Creative Studio',
                'role' => 'CMS Development & Interactive Motion',
                'tech_stack' => ['Laravel', 'GSAP', 'Tailwind CSS', 'Livewire'],
                'body_content' => [
                    ['type' => 'callout', 'content' => '<strong>Executive Summary:</strong> Interactive brand showcase and dynamic case study CMS.'],
                    ['type' => 'heading2', 'content' => 'The Challenge'],
                    ['type' => 'paragraph', 'content' => 'Need for custom storytelling blocks without sacrificing web performance.'],
                    ['type' => 'heading2', 'content' => 'The ODDS Solution'],
                    ['type' => 'paragraph', 'content' => 'Custom block editor paired with GSAP micro-animations and zero-layout shift.'],
                ],
            ],
            [
                'title' => 'ALAMS',
                'year' => '2023',
                'category' => 'Enterprise System',
                'desc' => 'Asset lifecycle & maintenance scheduling architecture.',
                'client' => 'Industrial Operations',
                'role' => 'Enterprise Backend & Lifecycle Automation',
                'tech_stack' => ['Laravel', 'PostgreSQL', 'Tailwind CSS', 'Chart.js'],
                'body_content' => [
                    ['type' => 'callout', 'content' => '<strong>Executive Summary:</strong> Comprehensive equipment lifecycle and scheduled maintenance tracking.'],
                    ['type' => 'heading2', 'content' => 'The Challenge'],
                    ['type' => 'paragraph', 'content' => 'Unscheduled equipment downtime caused significant operational delays.'],
                    ['type' => 'heading2', 'content' => 'The ODDS Solution'],
                    ['type' => 'paragraph', 'content' => 'Automated preventative maintenance scheduling and asset depreciation tracking.'],
                ],
            ],
            [
                'title' => 'AVONIC',
                'year' => '2024',
                'category' => 'IoT & AgriTech Automation',
                'desc' => 'Sensor-integrated IoT vermicomposting automation platform protecting African Nightcrawler colonies from environmental stressors with real-time telemetry and closed-loop micro-climate regulation.',
                'client' => null,
                'role' => null,
                'tech_stack' => ['ESP32', 'C/C++ Firmware', 'Capacitive Moisture V2.0', 'DHT22', 'MQ-135 Gas Sensor', 'Relay Actuation', 'Tailwind CSS', 'JavaScript Telemetry'],
                'count_in_kpi' => true,
                'body_content' => [
                    [
                        'type' => 'callout',
                        'content' => '<strong>Executive Summary:</strong> AVONIC transforms traditional, high-risk vermicomposting into an automated, precision-regulated bio-manufacturing system. By integrating edge sensors with automatic overhead misting and localized web telemetry, it prevents costly worm colony crashes and accelerates organic fertilizer production for commercial vegetable farms.',
                    ],
                    [
                        'type' => 'heading2',
                        'content' => '1. The Challenge: Silent Colony Mortality & High Chemical Input Costs',
                    ],
                    [
                        'type' => 'paragraph',
                        'content' => 'Commercial vegetable farming in the Philippines faces severe economic pressure, spending up to ₱60,000 per season on synthetic fertilizers that degrade soil over time. While vermicast (organic worm castings from African Nightcrawlers / <em>Eudrilus eugeniae</em>) offers a superior biological alternative, traditional open-bin setups fail because worms are biological organisms hyper-sensitive to micro-climate swings.',
                    ],
                    [
                        'type' => 'bullet',
                        'content' => '<strong>Thermal & Moisture Stress:</strong> Temperatures exceeding 30°C or substrate moisture falling below 45% trigger mass worm escape behaviors or sudden mortality within hours.',
                    ],
                    [
                        'type' => 'bullet',
                        'content' => '<strong>Toxic Gas Accumulation:</strong> Anaerobic pocketing from excessive wetness causes rapid rotting and dangerous ammonia/methane spikes.',
                    ],
                    [
                        'type' => 'bullet',
                        'content' => '<strong>Zero Feedback Loops:</strong> Farmers rely on subjective "touch and smell" checks, discovering colony failure only after the biological investment is lost.',
                    ],
                    [
                        'type' => 'image',
                        'src' => '/storage/works/avonic/avonic-problem-environment.png',
                        'caption' => 'Environmental stressors affecting worm vitality: Extreme heat, dryness, oversaturation, and toxic gas buildup.',
                    ],
                    [
                        'type' => 'heading2',
                        'content' => '2. The Solution: Closed-Loop Sensor Regulation & Edge Telemetry',
                    ],
                    [
                        'type' => 'paragraph',
                        'content' => 'ODDS engineered AVONIC as a dual-bin, autonomous hardware-software unit. Rather than relying on cloud dependency in remote farm areas, AVONIC executes real-time sensor processing directly on the ESP32 micro-controller while hosting an offline-capable localized web telemetry portal.',
                    ],
                    [
                        'type' => 'heading3',
                        'content' => 'Engineered Subsystems & Technology Stack',
                    ],
                    [
                        'type' => 'bullet',
                        'content' => '<strong>Multi-Point Abiotic Telemetry:</strong> Integrates corrosion-resistant Capacitive Moisture Sensors V2.0, dual DHT22 ambient temperature/humidity probes, and MQ-135 electrochemical gas sensors to monitor ammonia levels continuously.',
                    ],
                    [
                        'type' => 'bullet',
                        'content' => '<strong>Closed-Loop Micro-Climate Actuation:</strong> Automatically triggers relay-controlled overhead misting nozzles the second moisture dips below biological safety limits, stabilizing bin temperature without oversaturating the compost bed.',
                    ],
                    [
                        'type' => 'bullet',
                        'content' => '<strong>Offline-First Farm Dashboard:</strong> Broadcasts an instant local Wi-Fi telemetry suite with responsive gauge visuals, status indicators (Normal, Too Dry, Too Hot, Gas Spike), and real-time manual override toggles.',
                    ],
                    [
                        'type' => 'bullet',
                        'content' => '<strong>Dual-Language Operator UX:</strong> Packaged with English and Tagalog field manuals and clear color-coded vital cards designed for direct adoption by agricultural field staff.',
                    ],
                    [
                        'type' => 'image',
                        'src' => '/storage/works/avonic/avonic-dashboard-telemetry.png',
                        'caption' => 'AVONIC Real-Time Telemetry Interface: Multi-sensor gauges, bin condition status, and automated actuation controls.',
                    ],
                    [
                        'type' => 'heading2',
                        'content' => '3. Why It Works: Precision-Targeted Biological Optimization',
                    ],
                    [
                        'type' => 'paragraph',
                        'content' => 'By maintaining the bin within the golden ratio (60–80% moisture, 24–28°C, and sub-threshold gas levels), African Nightcrawlers remain in peak reproductive and digestion states. Organic crop waste is converted into nutrient-dense vermicast and liquid worm tea in accelerated 15–30 day cycles, directly competing with synthetic fertilizer timelines.',
                    ],
                    [
                        'type' => 'image',
                        'src' => '/storage/works/avonic/avonic-hardware-assembly.png',
                        'caption' => 'Dual-bin modular enclosure with integrated sensor probes, misting relays, and ESP32 controller unit.',
                    ],
                    [
                        'type' => 'heading2',
                        'content' => '4. Business & Ecological Outcomes',
                    ],
                    [
                        'type' => 'numbered',
                        'content' => '<strong>Eliminated Colony Loss:</strong> Autonomous threshold regulation reduced worm mortality and escape rates to near zero.',
                    ],
                    [
                        'type' => 'numbered',
                        'content' => '<strong>Significant Fertilizer Cost Reductions:</strong> Enabled on-site recycling of crop residues into high-grade bio-fertilizer, slashing chemical input dependency.',
                    ],
                    [
                        'type' => 'numbered',
                        'content' => '<strong>Measurable ESG & SDG Alignment:</strong> Directly advances UN SDG 2 (Zero Hunger), SDG 12 (Responsible Production), and SDG 15 (Life on Land) through soil regeneration.',
                    ],
                ],
            ],
            [
                'title' => 'SPCC Portal',
                'year' => '2022',
                'category' => 'Academic System',
                'desc' => 'Student enrollment and grading pipeline with role-based access.',
                'client' => 'Academic Administration',
                'role' => 'Database Architecture & RBAC System',
                'tech_stack' => ['Laravel', 'MySQL', 'Bootstrap', 'jQuery'],
                'body_content' => [
                    ['type' => 'callout', 'content' => '<strong>Executive Summary:</strong> Secure academic portal managing student enrollment and grading pipelines.'],
                    ['type' => 'heading2', 'content' => 'The Challenge'],
                    ['type' => 'paragraph', 'content' => 'High peak load during enrollment periods leading to database lockups.'],
                    ['type' => 'heading2', 'content' => 'The ODDS Solution'],
                    ['type' => 'paragraph', 'content' => 'Optimized database indices, transaction queues, and strict RBAC.'],
                ],
            ],
        ];

        foreach ($defaultWorks as $index => $w) {
            $slug = Str::slug($w['title']);
            $existing = OddsWork::where('title', $w['title'])->first();

            $data = [
                'title' => $w['title'],
                'slug' => $existing ? $existing->slug : ($slug . '-' . ($index + 1)),
                'category' => $w['category'],
                'year' => $w['year'],
                'client' => $w['client'] ?? null,
                'role' => $w['role'] ?? null,
                'tech_stack' => $w['tech_stack'] ?? null,
                'description' => $w['desc'],
                'body_content' => $w['body_content'] ?? null,
                'story_content' => "<h3>The Challenge</h3><p>{$w['desc']}</p><h3>The ODDS Solution</h3><p>Engineered using stack-agnostic principles for high stability and immediate deployment.</p>",
                'sort_order' => $index + 1,
                'is_featured' => true,
                'is_active' => true,
                'count_in_kpi' => $w['count_in_kpi'] ?? true,
            ];

            if ($existing) {
                // If existing has no body_content or we are updating PRISMA / AVONIC / SPCC Website specifically, update it
                if (empty($existing->body_content) || in_array($w['title'], ['PRISMA', 'AVONIC', 'SPCC Website'])) {
                    $existing->update($data);
                }
            } else {
                OddsWork::create($data);
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
