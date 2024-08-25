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
            $table->string('barcode_link')->nullable();
            $table->text('card')->nullable()->change();
            $table->text('serial')->nullable()->change();
            $table->string('amount_detect');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('purchases', function (Blueprint $table) {
            $table->dropColumn('barcode_link');
            $table->dropColumn('amount_detect');
        });
    }
};
