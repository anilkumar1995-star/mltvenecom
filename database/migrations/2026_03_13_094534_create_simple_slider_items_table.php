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
        Schema::create('simple_slider_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('simple_slider_id')->constrained('simple_sliders')->onDelete('cascade');
            $table->string('title')->nullable();
            $table->string('link')->nullable();
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('simple_slider_items');
    }
};
