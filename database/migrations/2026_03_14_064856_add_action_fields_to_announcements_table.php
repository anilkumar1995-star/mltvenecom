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
        Schema::table('announcements', function (Blueprint $table) {
            $table->boolean('has_action')->default(0);
            $table->string('action_label')->nullable();
            $table->string('action_url')->nullable();
            $table->boolean('action_open_new_tab')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('announcements', function (Blueprint $table) {
            $table->dropColumn(['has_action', 'action_label', 'action_url', 'action_open_new_tab']);
        });
    }
};
