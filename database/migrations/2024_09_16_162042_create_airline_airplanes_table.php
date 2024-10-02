<?php

use App\Enums\AirplaneStatusEnum;
use App\Enums\AirplaneTypesEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('airline_airplanes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('airline_id')->constrained('airlines');
            $table->foreignId('airplane_id')->constrained('airplanes');
            $table->foreignId('airport_id')->constrained('airports');
            $table->string('callsign')->unique()->nullable();
            $table->unsignedInteger('lifespan')->default(5);
            $table->enum('status', array_column(AirplaneStatusEnum::cases(), 'value'))->default(AirplaneStatusEnum::ACTIVE->value);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('airline_airplanes');
    }
};
