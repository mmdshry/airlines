<?php

namespace Database\Seeders;

use App\Helper\AirplaneHelper;
use App\Models\Airline;
use App\Models\AirlineAirplane;
use App\Models\Airplane;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class AirlineAirplanesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (Airplane::all() as $airplane) {
            foreach (Airline::all() as $airline) {
                AirlineAirplane::insert([
                    'airline_id' => $airline->id,
                    'airplane_id' => $airplane->id,
                    'airport_id' => $airline->airport->id,
                    'callsign' => AirplaneHelper::callsignGenerator($airline, $airplane),
                    'lifespan' => $airplane->lifespan,
                    'status' => 'active',
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }
        }
    }
}
