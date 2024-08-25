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
        Schema::create('resal_variants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('resal_product_id')->constrained()->cascadeOnDelete();
            $table->string('value');
            $table->decimal('price_with_vat', 10, 2);
            $table->boolean('display')->default(true);
            $table->boolean('barcode')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resal_variants');
    }
};
