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
        Schema::create('ec_products', function (Blueprint $table) {
            $table->id();
            $table->string('name', 191);
            $table->string('slug', 191)->nullable()->index();
            $table->text('description')->nullable();
            $table->longText('content')->nullable();
            $table->string('status', 60)->default('published')->index();
            $table->text('images')->nullable();
            $table->text('video_media')->nullable();
            $table->string('sku', 191)->nullable()->index();
            $table->unsignedInteger('order')->default(0)->index();
            $table->unsignedInteger('quantity')->nullable()->index();
            $table->unsignedTinyInteger('allow_checkout_when_out_of_stock')->default(0);
            $table->unsignedTinyInteger('with_storehouse_management')->default(0)->index();
            $table->string('stock_status', 191)->default('in_stock')->index();
            $table->unsignedTinyInteger('is_featured')->default(0);
            $table->date('is_new_until')->nullable();
            $table->unsignedBigInteger('brand_id')->nullable()->index();
            $table->tinyInteger('is_variation')->default(0)->index();
            $table->unsignedInteger('variations_count')->default(0)->index();
            $table->unsignedInteger('reviews_count')->default(0)->index();
            $table->decimal('reviews_avg', 3, 2)->default(0.00)->index();
            $table->tinyInteger('sale_type')->default(0)->index();
            $table->double('price')->nullable()->unsigned()->index();
            $table->double('sale_price')->nullable()->unsigned()->index();
            $table->timestamp('start_date')->nullable()->index();
            $table->timestamp('end_date')->nullable()->index();
            $table->double('length')->nullable();
            $table->double('wide')->nullable();
            $table->double('height')->nullable();
            $table->double('weight')->nullable();
            $table->unsignedBigInteger('tax_id')->nullable();
            $table->bigInteger('views')->default(0);
            $table->unsignedBigInteger('store_id')->nullable()->index();
            $table->unsignedBigInteger('created_by_id')->nullable()->default(0);
            $table->string('created_by_type', 191)->default('Botble\\ACL\\Models\\User');
            $table->unsignedBigInteger('approved_by')->nullable()->default(0);
            $table->string('image', 191)->nullable();
            $table->string('product_type', 60)->default('physical');
            $table->string('barcode', 150)->nullable();
            $table->double('cost_per_item')->nullable();
            $table->tinyInteger('price_includes_tax')->default(0);
            $table->tinyInteger('generate_license_code')->default(0);
            $table->enum('license_code_type', ['auto_generate', 'pick_from_list'])
                  ->default('auto_generate');

            $table->unsignedInteger('minimum_order_quantity')->nullable()->default(0);
            $table->unsignedInteger('maximum_order_quantity')->nullable()->default(0);
            $table->tinyInteger('notify_attachment_updated')->default(0);
            $table->unsignedBigInteger('specification_table_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ec_products');
    }
};
