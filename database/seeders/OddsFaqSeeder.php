<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\OddsFaq;

class OddsFaqSeeder extends Seeder
{
    public function run(): void
    {
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
