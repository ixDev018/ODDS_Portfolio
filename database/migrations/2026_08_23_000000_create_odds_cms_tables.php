<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Studio General & Section Settings
        Schema::create('odds_settings', function (Blueprint $table) {
            $table->id();
            // Hero
            $table->string('hero_title')->default("We build what your\nbusiness needs FAST");
            $table->text('hero_subtitle')->nullable();
            $table->string('hero_btn_text')->default("Let's Build");
            $table->string('hero_btn_link')->default('#cta');
            
            // Works KPIs
            $table->string('kpi_projects_accomplished')->default('58');
            $table->string('kpi_client_satisfaction')->default('8');
            $table->string('kpi_satisfaction_denom')->default('/10');
            $table->string('kpi_reliability')->default('99%');
            $table->string('kpi_reliability_label')->default('The Reliability Angle');
            $table->text('works_description')->nullable();

            // Services & Why & Testimonials Headers
            $table->string('services_title')->default('We are a COMPLETE PACKAGE');
            $table->text('services_desc')->nullable();
            $table->string('why_title')->default('Why bet on ODDS ?');
            $table->text('why_desc')->nullable();
            $table->string('testimonials_title')->default("Built Fast.\nTrusted Deeply.");
            $table->text('testimonials_desc')->nullable();

            // CTA & Terminal
            $table->string('cta_title')->default("Let's Build\nSomething Real.");
            $table->text('cta_desc')->nullable();
            $table->string('cta_email')->default('hello@odds.dev');
            $table->string('cta_phone')->default('0999999999');
            $table->string('cta_facebook')->default('ODDS Comp.');
            $table->string('cta_instagram')->default('ODDS Comp.');
            $table->string('cta_youtube')->default('ODDS Comp.');
            $table->string('cta_terminal_prompt')->default('client\\ODDS_Project> project init');
            $table->string('cta_meta_line')->default('ODDS Development Team 2025. All rights reserved');

            // Lorenzo AI System Context
            $table->text('lorenzo_system_prompt')->nullable();

            $table->timestamps();
        });

        // Studio Services
        Schema::create('odds_services', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->text('icon_svg')->nullable();
            $table->integer('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Studio Works / Projects
        Schema::create('odds_works', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('category')->nullable();
            $table->string('client')->nullable();
            $table->string('role')->nullable();
            $table->string('year')->nullable();
            $table->text('description')->nullable();
            $table->longText('story_content')->nullable();
            $table->string('cover_image')->nullable();
            $table->json('gallery_images')->nullable();
            $table->json('tech_stack')->nullable();
            $table->string('demo_url')->nullable();
            $table->string('github_url')->nullable();
            $table->integer('sort_order')->default(0);
            $table->boolean('is_featured')->default(true);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Studio Testimonials
        Schema::create('odds_testimonials', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('initials')->nullable();
            $table->string('role')->nullable();
            $table->string('company')->nullable();
            $table->integer('stars')->default(5);
            $table->text('text');
            $table->string('avatar_path')->nullable();
            $table->integer('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Why Bet On ODDS Reasons
        Schema::create('odds_why_reasons', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('text');
            $table->string('icon_path')->nullable();
            $table->integer('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Client Inquiries / Contact Messages
        Schema::create('odds_inquiries', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('company')->nullable();
            $table->string('service_needed')->nullable();
            $table->text('message');
            $table->boolean('is_read')->default(false);
            $table->string('ip_address')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('odds_inquiries');
        Schema::dropIfExists('odds_why_reasons');
        Schema::dropIfExists('odds_testimonials');
        Schema::dropIfExists('odds_works');
        Schema::dropIfExists('odds_services');
        Schema::dropIfExists('odds_settings');
    }
};
