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
        Schema::create('daleel_store_markets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('daleel_store_id');
            $table->string('product');
            $table->string('category');
            $table->string('store');
            $table->string('amount');
            $table->string('description')->nullable();
            $table->string('price');
            $table->string('has_vat');
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daleel_store_markets');
    }
};
