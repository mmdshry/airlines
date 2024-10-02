<?php

use App\Enums\ContractStatusEnum;
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
        Schema::create('contracts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sender_id')->constrained('airlines');
            $table->foreignId('receiver_id')->constrained('airlines');
            $table->enum('status', array_column(ContractStatusEnum::cases(), 'value'))->default(ContractStatusEnum::PENDING->value);
            $table->datetime('expired_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contracts');
    }
};
