<?php

namespace Database\Seeders;

use App\Enums\FlightStatusEnum;
use App\Helper\CalculationHelper;
use App\Models\Airline;
use App\Models\AirlineAirplane;
use App\Models\Airport;
use App\Models\Flight;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class FlightSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 50; $i++) { // Create 50 flights, adjust as needed
            $departedAt = Carbon::now();
            $origin = Airport::inRandomOrder()->first();
            $destination = Airport::inRandomOrder()->first();
            $airplane = AirlineAirplane::inRandomOrder()->first();
            $time = CalculationHelper::calculateTime($origin, $destination,$airplane->airplane);
            $landedAt = $departedAt->copy()->addMinutes($time);

            Flight::create([
                'origin_id' => $origin->id,
                'destination_id' => $destination->id,
                'airplane_id' => $airplane->id,
                'sender_id' => Airline::inRandomOrder()->first()->id,
                'receiver_id' => Airline::inRandomOrder()->first()->id,
                'capacity' => random_int(50, 200),
                'departed_at' => $departedAt,
                'landed_at' => $landedAt,
                'expired_at' => null,
                'status' => FlightStatusEnum::FLYING->value,
            ]);
        }
    }
}