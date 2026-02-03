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
        Schema::create('ec_specification_attributes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('group_id');
            $table->string('name', 191);
            $table->string('type', 20);
            $table->text('options')->nullable();
            $table->string('default_value', 191)->nullable();
            $table->string('author_type', 191)->nullable()->index();
            $table->unsignedBigInteger('author_id')->nullable()->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ec_specification_attributes');
    }
};