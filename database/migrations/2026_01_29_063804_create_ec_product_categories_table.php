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
        Schema::create('ec_product_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name', 191);
            $table->string('slug', 191)->nullable();
            $table->unsignedBigInteger('parent_id')->default(0);
            $table->mediumText('description')->nullable();
            $table->string('status', 60)->default('published');
            $table->unsignedInteger('order')->default(0);
            $table->string('image', 191)->nullable();
            $table->tinyInteger('is_featured')->unsigned()->default(0);
            $table->string('icon', 191)->nullable();
            $table->string('icon_image', 191)->nullable();
            $table->index(['parent_id', 'status', 'created_at'], 'ec_product_categories_parent_id_status_created_at_index');
            $table->index(['parent_id', 'status'], 'ec_product_categories_parent_id_status_index');
            $table->index(['status', 'order'], 'idx_categories_status_order');
            $table->index(['order'], 'idx_categories_order');
            $table->index(['slug'], 'ec_product_categories_slug_index');
            $table->index(['status'], 'idx_ec_product_categories_status');
            $table->index(['parent_id'], 'idx_ec_product_categories_parent_id');
            $table->index(['status','parent_id','order'], 'idx_ec_product_categories_status_parent_order');
            $table->index(['is_featured'], 'idx_ec_product_categories_is_featured');
            $table->index(['name'], 'idx_ec_product_categories_name');
            $table->index(['slug'], 'idx_ec_product_categories_slug');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ec_product_categories');
    }
};
