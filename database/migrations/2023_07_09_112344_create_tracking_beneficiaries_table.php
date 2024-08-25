<?php

use App\Models\Market;
use App\Models\Beneficiaries;
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
        Schema::create('tracking_beneficiaries', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Market::class)->nullable()->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Beneficiaries::class)->constrained()->cascadeOnDelete();
            $table->string('operation')->index();
            $table->unsignedBigInteger('old_balance');
            $table->unsignedBigInteger('new_balance');
            $table->unsignedBigInteger('amount');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tracking_beneficiaries');
    }
};
