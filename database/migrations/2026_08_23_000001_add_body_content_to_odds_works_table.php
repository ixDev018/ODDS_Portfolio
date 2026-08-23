<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('odds_works', function (Blueprint $table) {
            if (!Schema::hasColumn('odds_works', 'body_content')) {
                $table->longText('body_content')->nullable()->after('story_content');
            }
        });
    }

    public function down(): void
    {
        Schema::table('odds_works', function (Blueprint $table) {
            if (Schema::hasColumn('odds_works', 'body_content')) {
                $table->dropColumn('body_content');
            }
        });
    }
};
