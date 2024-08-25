<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('beneficiaries', function (Blueprint $table) {
            // alter columns to nullable
            $table->string('gender')->nullable()->change();
            $table->string('material_status')->nullable()->change();
            $table->string('monthly_income')->nullable()->change();
            // add columns
            $table->string('income_source')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('beneficiaries', function (Blueprint $table) {
            // alter columns to be not nullable
            $table->string('gender')->nullable(false)->change();
            $table->string('material_status')->nullable(false)->change();
            $table->string('monthly_income')->nullable(false)->change();
            // remove columns
            $table->dropColumn('income_source');
        });
    }
};