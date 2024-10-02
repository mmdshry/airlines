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
        Schema::create('airline_airports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('airline_id')->constrained('airlines');
            $table->foreignId('airport_id')->constrained('airports');
            $table->unsignedInteger('passengers')->default(0);
            $table->unsignedInteger('cargo')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('airline_airports');
    }
};
