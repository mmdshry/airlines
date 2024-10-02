<?php

use App\Enums\AirplaneTypesEnum;
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
        Schema::create('airplanes', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->enum('type', array_column(AirplaneTypesEnum::cases(), 'value'));
            $table->string('image')->nullable();
            $table->unsignedInteger('capacity');
            $table->unsignedInteger('lifespan');
            $table->unsignedInteger('speed')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('airplanes');
    }
};
