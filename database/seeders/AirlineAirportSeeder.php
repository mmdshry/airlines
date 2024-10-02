<?php

namespace Database\Seeders;

use App\Helper\AirplaneHelper;
use App\Models\Airline;
use App\Models\AirlineAirplane;
use App\Models\AirlineAirport;
use App\Models\Airport;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AirlineAirportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (Airline::all() as $airline) {
            AirlineAirport::create([
                'airline_id' => $airline->id,
                'airport_id' => Airport::where('iata_code', $airline->airport_iata_code)->first()->id
            ]);
        }
    }
}
