<?php

use App\Enums\RouteStatusEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('routes', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->foreignId('origin_id')->constrained('airports')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('destination_id')->constrained('airports')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('sender_id')->constrained('airlines')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('receiver_id')->constrained('airlines')->cascadeOnUpdate()->cascadeOnDelete();
            $table->dateTime('expires_at')->nullable();
            $table->enum('status', array_column(RouteStatusEnum::cases(), 'value'));
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('routes');
    }
};
