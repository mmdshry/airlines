<?php

namespace Database\Seeders;

use App\Enums\FlightStatusEnum;
use App\Helper\CalculationHelper;
use App\Models\Airline;
use App\Models\AirlineAirplane;
use App\Models\Airport;
use App\Models\Flight;
use App\Models\Route;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FlightSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Flight::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        for ($i = 0; $i < 50; $i++) { // Create 50 flights, adjust as needed
            $departedAt = Carbon::now();
            $route = Route::inRandomOrder()->first();
            $airplane = AirlineAirplane::inRandomOrder()->first();
            $time = CalculationHelper::calculateTime($route->origin, $route->destination,$airplane->airplane);
            $landedAt = $departedAt->copy()->addMinutes($time);
            $sender = Airline::inRandomOrder()->first();

            Flight::create([
                'name' => $sender->icao_code . random_int(1000,9999),
                'route_id' => $route->id,
                'airplane_id' => $airplane->id,
                'departed_at' => $departedAt,
                'landed_at' => $landedAt,
                'expired_at' => null,
                'status' => FlightStatusEnum::FLYING->value,
            ]);
        }
    }
}
