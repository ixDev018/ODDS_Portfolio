<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\OddsFaq;

class OddsFaqSeeder extends Seeder
{
    public function run(): void
    {
        $faqs = [
            [
                'question' => "We only have a rough idea, not a finished technical spec. Can you still help?",
                'answer'   => "Yes. Most of our projects start with an operational bottleneck or concept, not a spec. We work directly with you during scoping to define the architecture, requirements, and roadmap before writing a line of code.",
            ],
            [
                'question' => "Do I need to know what tech stack or framework I want?",
                'answer'   => "No. We are strictly stack-agnostic. We evaluate your scalability, performance, and budget requirements to select the exact language and architecture that fits your problem—never forcing you into rigid templates.",
            ],
            [
                'question' => "How does pricing and scoping work?",
                'answer'   => "We default to milestone-based quotes so you know the exact deliverables and timeline upfront with zero surprise billing. For evolving product builds or R&D, flexible sprint retainers are also available.",
            ],
            [
                'question' => "Who owns the code and intellectual property once complete?",
                'answer'   => "You do. 100% of the source code, repository commits, design assets, and intellectual property transfer directly to you upon milestone completion. No vendor lock-in, ever.",
            ],
        ];

        OddsFaq::truncate();
        foreach ($faqs as $index => $faq) {
            OddsFaq::create([
                'question'   => $faq['question'],
                'answer'     => $faq['answer'],
                'sort_order' => $index + 1,
                'is_active'  => true,
            ]);
        }
    }
}
