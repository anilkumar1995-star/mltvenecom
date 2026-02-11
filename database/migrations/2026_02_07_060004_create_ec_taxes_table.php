<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ec_taxes', function (Blueprint $table) {
            $table->id();
            $table->string('title', 191);
            $table->decimal('percentage', 8, 4)->default(0);
            $table->integer('priority')->default(0);
            $table->string('status', 60)->default('published');
            $table->timestamps();
        });

        // Pivot table for product-tax relationship
        Schema::create('ec_tax_products', function (Blueprint $table) {
            $table->foreignId('tax_id')->constrained('ec_taxes')->cascadeOnDelete();
            $table->foreignId('product_id')->constrained('ec_products')->cascadeOnDelete();
            $table->primary(['tax_id', 'product_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ec_tax_products');
        Schema::dropIfExists('ec_taxes');
    }
};
