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
                'question' => "Do I need a finished spec to start?",
                'answer'   => "No — we scope with you first. Bring a rough idea or an operational problem, and we'll work through it together to define what actually needs to get built before anything is quoted.",
            ],
            [
                'category' => 'Getting Started',
                'question' => "How long from first contact to kickoff?",
                'answer'   => "A few days. Once we've scoped the work, we can move fast into actually starting.",
            ],
            [
                'category' => 'Getting Started',
                'question' => "Do I need a technical co-founder or team to work with you?",
                'answer'   => "No. We work directly with non-technical founders and teams — we handle the engineering and translate it into plain terms as we go.",
            ],
            [
                'category' => 'Getting Started',
                'question' => "Is there a minimum project size?",
                'answer'   => "No. We take on small projects as well as larger ones — scope is scope, there's no size cutoff.",
            ],

            // Development & Stack
            [
                'category' => 'Development & Stack',
                'question' => "Do I need to know what tech stack I want?",
                'answer'   => "No. We lean on a few go-to stacks we trust for speed and reliability, but we're not locked into them — the right tools get picked based on what your project actually needs, decided together during scoping.",
            ],
            [
                'category' => 'Development & Stack',
                'question' => "Can you manage/update the site or app after it's built?",
                'answer'   => "If it's part of the engagement, yes — we build management tools, dashboards, and documentation for your team when that's scoped in from the start.",
            ],
            [
                'category' => 'Development & Stack',
                'question' => "Do you work with legacy systems or old databases/APIs?",
                'answer'   => "Yes, this is common work for us — legacy integration and migration is something we handle regularly, not a special case.",
            ],

            // Scoping & Pricing
            [
                'category' => 'Scoping & Pricing',
                'question' => "How does pricing work?",
                'answer'   => "Pricing is based on the scope and depth of involvement your project needs — full end-to-end work (planning, execution, and deployment) sits at a different level than a focused build that we hand off for your team to take from there. We don't quote off a rough idea; pricing is set after we've scoped the actual work together.",
            ],
            [
                'category' => 'Scoping & Pricing',
                'question' => "Are there any hidden costs?",
                'answer'   => "No. We're fully transparent about what you're paying for and why — no surprise fees once we're underway.",
            ],

            // Security & Ownership
            [
                'category' => 'Security & Ownership',
                'question' => "Who owns the code/IP?",
                'answer'   => "Ownership terms are set per contract, but typically full ownership of the final product transfers to you. Note: ODDS may showcase completed work in our portfolio (rebranded/renamed to protect client identity), and may build on patterns from past projects for future clients — always rebuilt and rebranded, never handed over as-is, unless it's one of our own in-house products.",
            ],
            [
                'category' => 'Security & Ownership',
                'question' => "Is there a warranty period after launch?",
                'answer'   => "Yes, projects include a free post-launch warranty period.",
            ],
            [
                'category' => 'Security & Ownership',
                'question' => "What if something breaks or needs an urgent fix?",
                'answer'   => "We commit to fast turnaround on urgent fixes — you're not left waiting when something critical goes down.",
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
