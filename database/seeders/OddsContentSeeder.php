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
        if (OddsService::count() === 0) {
            $services = [
                ['name' => "Software\nDevelopment", 'order' => 1],
                ['name' => "Web-App\nDevelopment", 'order' => 2],
                ['name' => "Mobile\nApplications", 'order' => 3],
                ['name' => "Backend\n& DevOps", 'order' => 4],
                ['name' => "Game\nDevelopment", 'order' => 5],
                ['name' => "Hardware\nSolutions", 'order' => 6],
            ];
            foreach ($services as $svc) {
                OddsService::create([
                    'name' => $svc['name'],
                    'sort_order' => $svc['order'],
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
