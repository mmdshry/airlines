<?php

use App\Enums\EventEnum;
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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->enum('type', array_column(EventEnum::cases(), 'value'));
            $table->foreignId('airline_id')->constrained();
            $table->foreignId('airplane_id')->nullable()->constrained('airline_airplanes');
            $table->foreignId('airport_id')->nullable()->constrained('airline_airports');
            $table->foreignId('flight_id')->nullable()->constrained('flights');
            $table->unsignedInteger('passengers')->nullable();
            $table->unsignedInteger('cargo')->nullable();
            $table->unsignedInteger('delay')->nullable();
            $table->unsignedInteger('lifespan')->nullable();
            $table->foreignId('airdrop')->nullable()->constrained('airplanes');
            $table->boolean('is_crashed')->default(0);
            $table->boolean('is_missed')->default(0);
            $table->longText('description');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
