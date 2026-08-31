<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('odds_services', function (Blueprint $table) {
            if (!Schema::hasColumn('odds_services', 'slug')) {
                $table->string('slug')->nullable()->after('name');
            }
            if (!Schema::hasColumn('odds_services', 'tagline')) {
                $table->string('tagline')->nullable()->after('slug');
            }
            if (!Schema::hasColumn('odds_services', 'body_content')) {
                $table->json('body_content')->nullable()->after('description');
            }
            if (!Schema::hasColumn('odds_services', 'cover_image')) {
                $table->string('cover_image')->nullable()->after('body_content');
            }
            if (!Schema::hasColumn('odds_services', 'features')) {
                $table->json('features')->nullable()->after('cover_image');
            }
            if (!Schema::hasColumn('odds_services', 'action_btn_text')) {
                $table->string('action_btn_text')->default("Let's Build")->after('features');
            }
            if (!Schema::hasColumn('odds_services', 'action_btn_url')) {
                $table->string('action_btn_url')->default('#cta')->after('action_btn_text');
            }
        });
    }

    public function down(): void
    {
        Schema::table('odds_services', function (Blueprint $table) {
            $table->dropColumn([
                'slug',
                'tagline',
                'body_content',
                'cover_image',
                'features',
                'action_btn_text',
                'action_btn_url',
            ]);
        });
    }
};
