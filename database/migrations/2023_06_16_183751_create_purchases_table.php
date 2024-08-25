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
        Schema::create('purchases', function (Blueprint $table) {
            $table->id()->startingValue(1000);
            $table->foreignIdFor(\App\Models\Beneficiaries::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(\App\Models\Item::class)->constrained()->cascadeOnDelete();
            $table->unsignedBigInteger('amount');
            $table->string('status');
            $table->unsignedBigInteger('qty');
            $table->unsignedBigInteger('purchase_daleel_id');
            $table->text('card');
            $table->text('serial');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchases');
    }
};
