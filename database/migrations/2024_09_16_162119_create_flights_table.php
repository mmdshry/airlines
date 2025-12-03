<?php

use App\Enums\FlightStatusEnum;
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
        Schema::create('flights', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->foreignId('route_id')->constrained('routes')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('airplane_id')->constrained('airline_airplanes')->cascadeOnUpdate()->cascadeOnDelete();
            $table->dateTime('departed_at')->nullable();
            $table->dateTime('landed_at')->nullable();
            $table->dateTime('expired_at')->nullable();
            $table->enum('status', array_column(FlightStatusEnum::cases(), 'value'));
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('flights');
    }
};
