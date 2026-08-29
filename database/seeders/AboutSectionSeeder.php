<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\OddsAboutSection;

class AboutSectionSeeder extends Seeder
{
    public function run(): void
    {
        if (OddsAboutSection::count() === 0) {
            OddsAboutSection::create([
                'title' => 'The ODDS Engineering Philosophy',
                'slug' => 'the-odds-engineering-philosophy',
                'subtitle' => 'How we build high-velocity systems without the fluff, bloated dependencies, or endless timelines.',
                'category' => 'Engineering DNA',
                'author' => 'ODDS Core Team',
                'read_time' => '4 min read',
                'sort_order' => 1,
                'is_active' => true,
                'body_content' => [
                    ['type' => 'heading2', 'content' => 'Why Velocity Is Our Foundational Benchmark'],
                    ['type' => 'paragraph', 'content' => 'In standard development agency paradigms, projects are bogged down by excessive design sprints, bureaucratic reviews, and inflexible tech choices. We took the opposite approach: stack-agnostic precision and aggressive shipping velocity.'],
                    ['type' => 'quote', 'content' => 'We replace slow corporate timelines with clean, flexible engineering that actually delivers in production.'],
                    ['type' => 'callout', 'content' => 'Our Core Guarantee: Rapid architecture, zero downtime deployments, and clean code that scales seamlessly under heavy business loads.'],
                    ['type' => 'heading3', 'content' => 'What Sets Us Apart'],
                    ['type' => 'bullet', 'content' => 'Direct engineer-to-client collaboration without layers of account managers.'],
                    ['type' => 'bullet', 'content' => 'Complete end-to-end capabilities spanning web, mobile, IoT, AI, and cloud infrastructure.'],
                    ['type' => 'bullet', 'content' => 'Production-ready code delivered with enterprise testing and continuous integration.']
                ]
            ]);

            OddsAboutSection::create([
                'title' => 'End-to-End Technical Capabilities',
                'slug' => 'end-to-end-technical-capabilities',
                'subtitle' => 'From embedded micro-controllers to distributed cloud services and reactive frontend interfaces.',
                'category' => 'Tech Spectrum',
                'author' => 'ODDS Architecture',
                'read_time' => '3 min read',
                'sort_order' => 2,
                'is_active' => true,
                'body_content' => [
                    ['type' => 'heading2', 'content' => 'Full Spectrum Digital Craftsmanship'],
                    ['type' => 'paragraph', 'content' => 'Our team operates across the complete technical spectrum. Whether you need an IoT telemetry dashboard or a multi-tenant enterprise portal, we pick the right tools for the job without vendor lock-in.'],
                    ['type' => 'code', 'content' => "// System Architecture Standard\n- Backend: High-throughput API & Async Queues\n- Frontend: Reactive UI with 60fps Micro-interactions\n- DevOps: Zero-downtime CI/CD Pipelines"],
                    ['type' => 'callout', 'content' => 'Stack Agility: We do not force a framework onto your problem. We architect the exact solution your business requires.']
                ]
            ]);
        }
    }
}
