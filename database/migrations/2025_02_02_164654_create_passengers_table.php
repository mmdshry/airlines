<?php

use App\Enums\PassengerStatusEnum;
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
        Schema::create('passengers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('origin_id')->constrained('airports')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('destination_id')->constrained('airports')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('flight_id')->nullable()->constrained('flights')->cascadeOnUpdate()->cascadeOnDelete();
            $table->enum('status', array_column(PassengerStatusEnum::cases(), 'value'))->default(PassengerStatusEnum::SEEKING);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('passengers');
    }
};
