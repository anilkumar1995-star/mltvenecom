<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ec_global_options', function (Blueprint $table) {
            $table->id();
            $table->string('name', 191);
            $table->string('option_type', 60)->default('dropdown'); // dropdown, checkbox, radio, text
            $table->boolean('required')->default(false);
            $table->string('status', 60)->default('published');
            $table->timestamps();
        });

        Schema::create('ec_global_option_values', function (Blueprint $table) {
            $table->id();
            $table->foreignId('option_id')->constrained('ec_global_options')->cascadeOnDelete();
            $table->string('option_value', 191);
            $table->decimal('affect_price', 15, 2)->nullable()->default(0);
            $table->string('affect_type', 20)->default('fixed'); // fixed, percent
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ec_global_option_values');
        Schema::dropIfExists('ec_global_options');
    }
};
