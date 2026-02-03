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
        Schema::create('ec_product_tag_translations', function (Blueprint $table) {
            // $table->id();
            $table->string('lang_code', 191);
            $table->unsignedBigInteger('ec_product_tags_id');
            $table->string('name', 191)->nullable();

            $table->primary(['lang_code', 'ec_product_tags_id']);

            $table->index('ec_product_tags_id', 'idx_product_tags_fk');

            $table->foreign('ec_product_tags_id')
                ->references('id')
                ->on('ec_product_tags')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ec_product_tag_translations');
    }
};
