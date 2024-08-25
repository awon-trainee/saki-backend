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
        Schema::table('purchases', function (Blueprint $table) {
            $table->dropColumn('purchase_daleel_id');

            $table->unsignedBigInteger('resal_order_id')->nullable();
            $table->string('resal_redemption_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('purchases', function (Blueprint $table) {
            $table->string('purchase_daleel_id')->nullable();

            $table->dropColumn('resal_order_id');
            $table->dropColumn('resal_redemption_id');
        });
    }
};
