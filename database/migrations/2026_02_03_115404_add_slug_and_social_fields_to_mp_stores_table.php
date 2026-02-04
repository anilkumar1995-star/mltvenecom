<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('mp_stores', function (Blueprint $table) {
            $table->string('slug')->nullable()->unique()->after('name');
            $table->json('social_links')->nullable()->after('tax_id');
            $table->string('seo_title')->nullable()->after('social_links');
            $table->text('seo_description')->nullable()->after('seo_title');
            $table->string('seo_index')->default('index')->after('seo_description');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mp_stores', function (Blueprint $table) {
            $table->dropColumn(['slug', 'social_links', 'seo_title', 'seo_description', 'seo_index']);
        });
    }
};
