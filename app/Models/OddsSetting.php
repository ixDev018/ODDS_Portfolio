<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OddsSetting extends Model
{
    protected $table = 'odds_settings';

    protected $fillable = [
        'hero_title',
        'hero_subtitle',
        'hero_btn_text',
        'hero_btn_link',
        'kpi_projects_accomplished',
        'kpi_client_satisfaction',
        'kpi_satisfaction_denom',
        'kpi_reliability',
        'kpi_reliability_label',
        'works_description',
        'services_title',
        'services_desc',
        'why_title',
        'why_desc',
        'testimonials_title',
        'testimonials_desc',
        'cta_title',
        'cta_desc',
        'cta_email',
        'cta_phone',
        'cta_facebook',
        'cta_instagram',
        'cta_youtube',
        'cta_terminal_prompt',
        'cta_meta_line',
        'lorenzo_system_prompt',
    ];

    public static function current(): self
    {
        return static::firstOrCreate([], [
            'hero_title' => "We build what your\nbusiness needs FAST",
            'hero_subtitle' => "Driven by technical excellence and a commitment to discomfort-driven growth, we rapidly execute our deployment sequences. At the end of the day, our mission is simple: we ship.",
            'hero_btn_text' => "Let's Build",
            'hero_btn_link' => "#cta",
            'kpi_projects_accomplished' => "58",
            'kpi_client_satisfaction' => "8",
            'kpi_satisfaction_denom' => "/10",
            'kpi_reliability' => "99%",
            'kpi_reliability_label' => "The Reliability Angle",
            'works_description' => "Real-world solutions, custom-engineered for rapid deployment\nand measurable business impact.",
            'services_title' => "We are a COMPLETE PACKAGE",
            'services_desc' => "Business problems aren't solved by generic templates. Whether you need a standalone service or a fully integrated package, we engineer the exact solution your operations demand.",
            'why_title' => "Why bet on ODDS ?",
            'why_desc' => "Choosing a development partner shouldn't feel like a gamble. We replace slow timelines and bloated frameworks with clean, flexible engineering that delivers.",
            'testimonials_title' => "Built Fast.\nTrusted Deeply.",
            'testimonials_desc' => "Speed means nothing if the system breaks under pressure. Discover how we deliver stable, production-ready systems on aggressive timelines for businesses that can't afford to wait.",
            'cta_title' => "Let's Build\nSomething Real.",
            'cta_desc' => "Tell us what you're facing. Whether you need a quick technical module or an end-to-end package solution, our team is ready to execute. Expect a response with clear next steps within 24 hours.",
            'cta_email' => "hello@odds.dev",
            'cta_phone' => "0999999999",
            'cta_facebook' => "ODDS Comp.",
            'cta_instagram' => "ODDS Comp.",
            'cta_youtube' => "ODDS Comp.",
            'cta_terminal_prompt' => "client\\ODDS_Project> project init",
            'cta_meta_line' => "ODDS Development Team 2025. All rights reserved",
        ]);
    }
}
