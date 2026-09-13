<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\OddsFaq;

class OddsFaqSeeder extends Seeder
{
    public function run(): void
    {
        $faqs = [
            // Getting Started
            [
                'category' => 'Getting Started',
                'question' => "We don't have a technical spec yet — can you still help?",
                'answer'   => "Yes. Most of what we take on starts as a rough idea or an operational bottleneck, not a finished technical spec. We work directly with you during scoping to define the architecture, requirements, and roadmap before writing a line of code.",
            ],
            [
                'category' => 'Getting Started',
                'question' => "How fast can we kick off and ship the first milestone?",
                'answer'   => "Following an initial scoping discussion, we can typically kick off within 48 to 72 hours. Focused modules ship in days to a couple of weeks, while full platforms are delivered in rapid, testable sprint increments.",
            ],
            [
                'category' => 'Getting Started',
                'question' => "Do I need technical experience to work with ODDS?",
                'answer'   => "Not at all. We handle the complex engineering, cloud infrastructure, and technical architecture while translating everything into clear, actionable business milestones.",
            ],
            [
                'category' => 'Getting Started',
                'question' => "What's the smallest project or engagement you'll take on?",
                'answer'   => "There is no rigid minimum. We have shipped standalone custom modules, high-throughput microservices, and full end-to-end multi-platform applications. Scope decides the timeline and budget, not whether we take the work.",
            ],

            // Development & Stack
            [
                'category' => 'Development & Stack',
                'question' => "Do I need to know what tech stack or framework I want?",
                'answer'   => "No. We are strictly stack-agnostic. We evaluate your scalability, performance, security, and budget requirements to select the exact language and architecture that fits your problem—never forcing you into rigid templates.",
            ],
            [
                'category' => 'Development & Stack',
                'question' => "Can I manage and update the site or application after it's built?",
                'answer'   => "Absolutely. We build clean, intuitive management workflows and dashboards tailored to your team. We also provide complete documentation, recorded handoffs, and ongoing support so you're never left in the dark.",
            ],
            [
                'category' => 'Development & Stack',
                'question' => "Can you integrate with our existing APIs, legacy databases, or hardware systems?",
                'answer'   => "Yes. We specialize in custom API integrations, legacy database migrations, IoT firmware connectivity, and multi-tenant webhook architectures.",
            ],
            [
                'category' => 'Development & Stack',
                'question' => "What tools and technologies are used in building?",
                'answer'   => "We choose modern, robust, and scalable technologies best fitted to your product goals—from performant full-stack frameworks (Laravel, Node.js, Next.js, Flutter) to custom cloud infrastructure, Docker containers, and high-velocity database engines.",
            ],

            // Scoping & Pricing
            [
                'category' => 'Scoping & Pricing',
                'question' => "How does pricing and project scoping work?",
                'answer'   => "We default to milestone-based quotes so you know the exact deliverables and timeline upfront with zero surprise billing. For evolving product builds or R&D, flexible sprint retainers are also available.",
            ],
            [
                'category' => 'Scoping & Pricing',
                'question' => "How much does it cost to build a custom application?",
                'answer'   => "Pricing varies depending on feature depth, third-party integrations, and platform complexity. Following an initial scoping discussion, we provide a detailed proposal tailored to your exact requirements and budget.",
            ],
            [
                'category' => 'Scoping & Pricing',
                'question' => "Are there any hidden costs, vendor lock-ins, or monthly license fees?",
                'answer'   => "Never. We believe in total financial transparency. All hosting accounts, domain registrations, and third-party API keys belong directly to your organization.",
            ],

            // Security & Ownership
            [
                'category' => 'Security & Ownership',
                'question' => "Who owns the source code and intellectual property (IP)?",
                'answer'   => "You do. 100% full ownership of all source code, design assets, database schemas, and intellectual property transfers to your company upon project completion.",
            ],
            [
                'category' => 'Security & Ownership',
                'question' => "Do you provide post-launch support, monitoring, and maintenance?",
                'answer'   => "Yes. We provide complimentary post-launch warranty support on all shipped deliverables. For ongoing scaling, feature iterations, and security monitoring, dedicated retainer plans are available.",
            ],
            [
                'category' => 'Security & Ownership',
                'question' => "What happens if something breaks or needs an urgent fix after launch?",
                'answer'   => "You contact us and we fix it immediately. We stand firmly behind every system and line of code we ship.",
            ],

            // AI & Custom Systems
            [
                'category' => 'AI & Custom Systems',
                'question' => "Can you build custom AI workflows, computer vision, or embedded IoT systems?",
                'answer'   => "Yes. We have built real-world AI CCTV surveillance systems, IoT sensor telemetry pipelines, automated OCR document extractors, and custom LLM agent workflows.",
            ],
            [
                'category' => 'AI & Custom Systems',
                'question' => "Will our proprietary business data be secure when using AI integrations?",
                'answer'   => "Yes. We enforce enterprise-grade data isolation, private VPC endpoints, and strict zero-retention policies so your business data is never exposed or used to train public models.",
            ],
        ];

        OddsFaq::truncate();
        foreach ($faqs as $index => $faq) {
            OddsFaq::create([
                'category'   => $faq['category'],
                'question'   => $faq['question'],
                'answer'     => $faq['answer'],
                'sort_order' => $index + 1,
                'is_active'  => true,
            ]);
        }
    }
}
