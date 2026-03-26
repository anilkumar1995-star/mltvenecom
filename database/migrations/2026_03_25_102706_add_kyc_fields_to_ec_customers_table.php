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
        Schema::table('ec_customers', function (Blueprint $table) {
            if (!Schema::hasColumn('ec_customers', 'pan_number')) {
                $table->string('pan_number', 50)->nullable()->after('phone');
            }
            if (!Schema::hasColumn('ec_customers', 'aadhar_number')) {
                $table->string('aadhar_number', 50)->nullable()->after('pan_number');
            }
            if (!Schema::hasColumn('ec_customers', 'kyc_kid')) {
                $table->string('kyc_kid', 191)->nullable()->after('aadhar_number');
            }
            if (!Schema::hasColumn('ec_customers', 'kyc_url')) {
                $table->text('kyc_url')->nullable()->after('kyc_kid');
            }
            if (!Schema::hasColumn('ec_customers', 'kyc_status')) {
                $table->string('kyc_status', 60)->nullable()->default('pending')->after('kyc_url');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ec_customers', function (Blueprint $table) {
            $table->dropColumn(['pan_number', 'aadhar_number', 'kyc_kid', 'kyc_url', 'kyc_status']);
        });
    }
};
