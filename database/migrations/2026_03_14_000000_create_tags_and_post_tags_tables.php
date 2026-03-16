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
        if (!Schema::hasTable('tags')) {
            Schema::create('tags', function (Blueprint $table) {
                $table->id();
                $table->string('name', 120);
                $table->integer('author_id')->nullable();
                $table->string('author_type', 255)->default('Admin');
                $table->string('description', 400)->nullable();
                $table->string('status', 60)->default('published');
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('post_tags')) {
            Schema::create('post_tags', function (Blueprint $table) {
                $table->integer('post_id')->unsigned();
                $table->integer('tag_id')->unsigned();
                $table->primary(['post_id', 'tag_id']);
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post_tags');
        Schema::dropIfExists('tags');
    }
};
