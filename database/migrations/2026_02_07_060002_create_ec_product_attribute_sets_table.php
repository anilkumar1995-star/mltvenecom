<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ec_product_attribute_sets', function (Blueprint $table) {
            $table->id();
            $table->string('title', 191);
            $table->string('slug', 191)->unique();
            $table->string('status', 60)->default('published');
            $table->integer('order')->default(0);
            $table->string('display_layout', 60)->default('dropdown'); // dropdown, swatch, text
            $table->boolean('is_searchable')->default(true);
            $table->timestamps();
        });

        Schema::create('ec_product_attributes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('attribute_set_id')->constrained('ec_product_attribute_sets')->cascadeOnDelete();
            $table->string('title', 191);
            $table->string('slug', 191);
            $table->string('color', 50)->nullable();
            $table->string('image', 191)->nullable();
            $table->boolean('is_default')->default(false);
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ec_product_attributes');
        Schema::dropIfExists('ec_product_attribute_sets');
    }
};
