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
        Schema::table('simple_slider_items', function (Blueprint $table) {
            $table->string('subtitle')->nullable()->after('title');
            $table->string('button_label')->nullable()->after('link');
            $table->string('background_color')->nullable()->after('image');
            $table->boolean('background_color_light')->default(0)->after('background_color');
            $table->string('tablet_image')->nullable()->after('background_color_light');
            $table->string('mobile_image')->nullable()->after('tablet_image');
            $table->string('status', 60)->default('published')->after('order');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('simple_slider_items', function (Blueprint $table) {
            $table->dropColumn([
                'subtitle',
                'button_label',
                'background_color',
                'background_color_light',
                'tablet_image',
                'mobile_image',
                'status'
            ]);
        });
    }
};
