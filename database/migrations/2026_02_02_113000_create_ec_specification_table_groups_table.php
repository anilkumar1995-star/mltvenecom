<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ec_specification_table_groups', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('table_id');
            $table->unsignedBigInteger('group_id');
            $table->timestamps();

            $table->foreign('table_id')->references('id')->on('ec_specification_tables')->onDelete('cascade');
            $table->foreign('group_id')->references('id')->on('ec_specification_groups')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ec_specification_table_groups');
    }
};