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
        Schema::create('tracking_balances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('action_by')->constrained('users')->cascadeOnDelete();
            $table->foreignIdFor(\App\Models\Transfer::class)->constrained()->cascadeOnDelete();
            $table->unsignedBigInteger('old_balance');
            $table->unsignedBigInteger('new_balance');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tracking_balances');
    }
};
