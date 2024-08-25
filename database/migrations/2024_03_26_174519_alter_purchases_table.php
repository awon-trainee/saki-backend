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
        Schema::table('purchases', function (Blueprint $table) {
            $table->dropColumn('serial');
            $table->dropColumn('card');
            $table->dropColumn('barcode_link');

            $table->text('code');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('purchases', function (Blueprint $table) {
            $table->string('serial')->nullable();
            $table->string('card')->nullable();
            $table->string('barcode_link')->nullable();

            $table->dropColumn('code');
        });
    }
};
