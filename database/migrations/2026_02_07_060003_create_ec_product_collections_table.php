<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ec_product_collections', function (Blueprint $table) {
            $table->id();
            $table->string('name', 191);
            $table->string('slug', 191)->unique();
            $table->string('description', 400)->nullable();
            $table->string('image', 191)->nullable();
            $table->string('status', 60)->default('published');
            $table->boolean('is_featured')->default(false);
            $table->timestamps();
        });

        // Pivot table for product-collection relationship
        Schema::create('ec_product_collection_products', function (Blueprint $table) {
            $table->foreignId('product_id')->constrained('ec_products')->cascadeOnDelete();
            $table->foreignId('collection_id')->constrained('ec_product_collections')->cascadeOnDelete();
            $table->primary(['product_id', 'collection_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ec_product_collection_products');
        Schema::dropIfExists('ec_product_collections');
    }
};
