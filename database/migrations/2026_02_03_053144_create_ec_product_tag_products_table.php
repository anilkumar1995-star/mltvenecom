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
        Schema::create('ec_product_tag_products', function (Blueprint $table) {
            // $table->id();
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('tag_id');

            $table->primary(['product_id', 'tag_id']);

            $table->index('product_id');
            $table->index('tag_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ec_product_tag_products');
    }
};
