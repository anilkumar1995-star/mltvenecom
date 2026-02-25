<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ec_faqs', function (Blueprint $table) {
            $table->id();
            $table->string('question', 255);
            $table->text('answer');
            $table->integer('order')->default(0);
            $table->string('status', 60)->default('published');
            $table->timestamps();
        });

        // Pivot table for product-faq relationship
        Schema::create('ec_faq_products', function (Blueprint $table) {
            $table->foreignId('faq_id')->constrained('ec_faqs')->cascadeOnDelete();
            $table->foreignId('product_id')->constrained('ec_products')->cascadeOnDelete();
            $table->primary(['faq_id', 'product_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ec_faq_products');
        Schema::dropIfExists('ec_faqs');
    }
};
