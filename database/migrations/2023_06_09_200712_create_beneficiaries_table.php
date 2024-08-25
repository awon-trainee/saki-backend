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
        Schema::create('beneficiaries', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone')->unique();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('nationality_id')->constrained('countries')->cascadeOnDelete();
            $table->string('gender')->comment('male , female');
            $table->string('material_status')->comment('single ,widower ,divorced ,married');
            $table->string("monthly_income");
            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('beneficiaries');
    }
};
