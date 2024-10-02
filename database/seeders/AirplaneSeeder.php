<?php

namespace Database\Seeders;

use App\Enums\AirplaneTypesEnum;
use App\Models\Airplane;
use Illuminate\Database\Seeder;

class AirplaneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $airplanes = [
            // Commercial
            [
                'name'     => 'Boeing 737-700',
                'type'     => AirplaneTypesEnum::COMMERCIAL,
                'capacity' => 149,
                'lifespan' => 20,
                'speed'    => 842,
                'image'    => asset('img/airplanes/737-900er_white_split_scimitar_sm.png')
            ],
            [
                'name'     => 'Boeing 757-200',
                'type'     => AirplaneTypesEnum::COMMERCIAL,
                'capacity' => 200,
                'lifespan' => 30,
                'speed'    => 850,
                'image'    => asset('img/airplanes/757-300_white_winglets_sm.png')
            ],
            [
                'name'     => 'Boeing 767-300',
                'type'     => AirplaneTypesEnum::COMMERCIAL,
                'capacity' => 218,
                'lifespan' => 35,
                'speed'    => 850,
                'image'    => asset('img/airplanes/767-400_white.png')
            ],
            [
                'name'     => 'Boeing 777-200ER',
                'type'     => AirplaneTypesEnum::COMMERCIAL,
                'capacity' => 314,
                'lifespan' => 40,
                'speed'    => 905,
                'image'    => asset('img/airplanes/777-9_white.png')
            ],
            [
                'name'     => 'Boeing 787',
                'type'     => AirplaneTypesEnum::COMMERCIAL,
                'capacity' => 242,
                'lifespan' => 35,
                'speed'    => 913,
                'image'    => asset('img/airplanes/787-10_white_sm.png')
            ],
            [
                'name'     => 'Boeing 747-400',
                'type'     => AirplaneTypesEnum::COMMERCIAL,
                'capacity' => 416,
                'lifespan' => 45,
                'speed'    => 907,
                'image'    => asset('img/airplanes/747-400_white.png')
            ],
            [
                'name'     => 'Airbus A310neo',
                'type'     => AirplaneTypesEnum::COMMERCIAL,
                'capacity' => 280,
                'lifespan' => 20,
                'speed'    => 840,
                'image'    => asset('img/airplanes/A310-300_white.png')
            ],
            [
                'name'     => 'Airbus A320neo',
                'type'     => AirplaneTypesEnum::COMMERCIAL,
                'capacity' => 240,
                'lifespan' => 25,
                'speed'    => 828,
                'image'    => asset('img/airplanes/A320_NEO_Pratt__Whitney_white_sm.png')
            ],
            [
                'name'     => 'Airbus A330-900',
                'type'     => AirplaneTypesEnum::COMMERCIAL,
                'capacity' => 260,
                'lifespan' => 30,
                'speed'    => 890,
                'image'    => asset('img/airplanes/A330-900_NEO_white_sm.png')
            ],
            [
                'name'     => 'Airbus A340-500',
                'type'     => AirplaneTypesEnum::COMMERCIAL,
                'capacity' => 313,
                'lifespan' => 35,
                'speed'    => 910,
                'image'    => asset('img/airplanes/A340-600_white_sm.png')
            ],
            [
                'name'     => 'Airbus A350-900',
                'type'     => AirplaneTypesEnum::COMMERCIAL,
                'capacity' => 440,
                'lifespan' => 40,
                'speed'    => 910,
                'image'    => asset('img/airplanes/A350-1000_white.png')
            ],
            [
                'name'     => 'Airbus A380-800',
                'type'     => AirplaneTypesEnum::COMMERCIAL,
                'capacity' => 555,
                'lifespan' => 50,
                'speed'    => 903,
                'image'    => asset('img/airplanes/A380-800_white.png')
            ],
            [
                'name'     => "BAe 146-200/Avro RJ85",
                "type"     => AirplaneTypesEnum::COMMERCIAL,
                "capacity" => 112,
                "lifespan" => 25,
                "speed"    => 750,
                "image"    => asset("img/airplanes/BAe_146-200_Avro_RJ85_white.png")
            ],

            // Private Jet
            [
                'name'     => "Bombardier CRJ 1000",
                "type"     => AirplaneTypesEnum::PRIVATE,
                "capacity" => 100,
                "lifespan" => 15,
                "speed"    => 860,
                "image"    => asset("img/airplanes/CRJ-1000_white.png")
            ],
            [
                'name'     => "Bombardier Global 7500",
                "type"     => AirplaneTypesEnum::PRIVATE,
                "capacity" => 19,
                "lifespan" => 15,
                "speed"    => 945,
                "image"    => asset("img/airplanes/Global_7500_white.png")
            ],
            [
                'name'     => "Bombardier Global 5000",
                "type"     => AirplaneTypesEnum::PRIVATE,
                "capacity" => 14,
                "lifespan" => 15,
                "speed"    => 850,
                "image"    => asset("img/airplanes/Global-5000_white.png")
            ],
            [
                'name'     => "Gulfstream G650",
                "type"     => AirplaneTypesEnum::PRIVATE,
                "capacity" => 18,
                "lifespan" => 15,
                "speed"    => 982,
                "image"    => asset("img/airplanes/Gulfstream_G650ER_white.png")
            ],
            [
                'name'     => "Bombardier Learjet 45",
                "type"     => AirplaneTypesEnum::PRIVATE,
                "capacity" => 8,
                "lifespan" => 15,
                "speed"    => 835,
                "image"    => asset("img/airplanes/Learjet-45-white.png")
            ],
            [
                'name'     => "Cessna Citation X",
                "type"     => AirplaneTypesEnum::PRIVATE,
                "capacity" => 8,
                "lifespan" => 15,
                "speed"    => 951,
                "image"    => asset("img/airplanes/Cessna_Citation_X_white.png")
            ],

            // Cargo
            [
                'name'     => "Boeing 737-800BCF",
                "type"     => AirplaneTypesEnum::CARGO,
                "capacity" => 22,
                "lifespan" => 30,
                "speed"    => 830,
                "image"    => asset("img/airplanes/737-800BCF_white.png")
            ],
            [
                'name'     => "Boeing 747-400F",
                "type"     => AirplaneTypesEnum::CARGO,
                "capacity" => 100,
                "lifespan" => 40,
                "speed"    => 907,
                "image"    => asset("img/airplanes/747-400F_white_sm.png")
            ],
            [
                'name'     => "Boeing 777F",
                "type"     => AirplaneTypesEnum::CARGO,
                "capacity" => 102,
                "lifespan" => 40,
                "speed"    => 905,
                "image"    => asset("img/airplanes/777F_white_sm.png")
            ],
            [
                'name'     => "Airbus A330-200F",
                "type"     => AirplaneTypesEnum::CARGO,
                "capacity" => 70,
                "lifespan" => 30,
                "speed"    => 890,
                "image"    => asset("img/airplanes/A330-200F_PW_white.png")
            ],
            [
                'name'     => "Airbus A350F",
                "type"     => AirplaneTypesEnum::CARGO,
                "capacity" => 80,
                'lifespan' => 35,
                'speed'    => 890,
                'image'    => asset('img/airplanes/A350F_white.png')
            ],
            [
                'name'     => "Boeing C-17",
                "type"     => AirplaneTypesEnum::CARGO,
                'capacity' => 77,
                'lifespan' => 30,
                'speed'    => 830,
                'image'    => asset('img/airplanes/C-17_white.png')
            ]
        ];

        foreach ($airplanes as $airplane) {
            Airplane::create([
                'name'       => $airplane['name'],
                'type'       => $airplane['type']->value,
                'image'      => $airplane['image'],
                'speed'      => $airplane['speed'],
                'capacity'   => $airplane['capacity'],
                'lifespan'   => $airplane['lifespan'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
