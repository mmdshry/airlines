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
            ['name'     => 'Boeing 737-700',
             'type'     => AirplaneTypesEnum::COMMERCIAL,
             'capacity' => 50,
             'lifespan' => 5,
             'image'    => asset('img/airplanes/737-900er_white_split_scimitar_sm.png')
            ],
            ['name'     => 'Boeing 757-200',
             'type'     => AirplaneTypesEnum::COMMERCIAL,
             'capacity' => 60,
             'lifespan' => 5,
             'image'    => asset('img/airplanes/757-300_white_winglets_sm.png')
            ],
            ['name' => 'Boeing 767-300', 'type' => AirplaneTypesEnum::COMMERCIAL, 'capacity' => 70, 'lifespan' => 5, 'image' => asset('img/airplanes/767-400_white.png')],
            ['name' => 'Boeing 777-200ER', 'type' => AirplaneTypesEnum::COMMERCIAL, 'capacity' => 80, 'lifespan' => 5, 'image' => asset('img/airplanes/777-9_white.png')],
            ['name' => 'Boeing 787', 'type' => AirplaneTypesEnum::COMMERCIAL, 'capacity' => 90, 'lifespan' => 5, 'image' => asset('img/airplanes/787-10_white_sm.png')],
            ['name' => 'Boeing 747-400', 'type' => AirplaneTypesEnum::COMMERCIAL, 'capacity' => 100, 'lifespan' => 5, 'image' => asset('img/airplanes/747-400_white.png')],
            ['name' => 'Airbus A310neo', 'type' => AirplaneTypesEnum::COMMERCIAL, 'capacity' => 50, 'lifespan' => 5, 'image' => asset('img/airplanes/A310-300_white.png')],
            ['name'     => 'Airbus A320neo',
             'type'     => AirplaneTypesEnum::COMMERCIAL,
             'capacity' => 60,
             'lifespan' => 5,
             'image'    => asset('img/airplanes/A320_NEO_Pratt__Whitney_white_sm.png')
            ],
            ['name' => 'Airbus A330-900', 'type' => AirplaneTypesEnum::COMMERCIAL, 'capacity' => 70, 'lifespan' => 5, 'image' => asset('img/airplanes/A330-900_NEO_white_sm.png')],
            ['name' => 'Airbus A340-500', 'type' => AirplaneTypesEnum::COMMERCIAL, 'capacity' => 80, 'lifespan' => 5, 'image' => asset('img/airplanes/A340-600_white_sm.png')],
            ['name' => 'Airbus A350-900', 'type' => AirplaneTypesEnum::COMMERCIAL, 'capacity' => 90, 'lifespan' => 5, 'image' => asset('img/airplanes/A350-1000_white.png')],
            ['name' => 'Airbus A380-800', 'type' => AirplaneTypesEnum::COMMERCIAL, 'capacity' => 100, 'lifespan' => 5, 'image' => asset('img/airplanes/A380-800_white.png')],
            ['name'     => 'BAe 146-200/Avro RJ85',
             'type'     => AirplaneTypesEnum::COMMERCIAL,
             'capacity' => 60,
             'lifespan' => 5,
             'image'    => asset('img/airplanes/BAe_146-200_Avro_RJ85_white.png')
            ],

            // Private Jet
            ['name' => 'Bombardier CRJ 1000', 'type' => AirplaneTypesEnum::PRIVATE, 'capacity' => 60, 'lifespan' => 5, 'image' => asset('img/airplanes/CRJ-1000_white.png')],
            ['name' => 'Bombardier Global 7500', 'type' => AirplaneTypesEnum::PRIVATE, 'capacity' => 50, 'lifespan' => 5, 'image' => asset('img/airplanes/Global_7500_white.png')],
            ['name' => 'Bombardier Global 5000', 'type' => AirplaneTypesEnum::PRIVATE, 'capacity' => 40, 'lifespan' => 5, 'image' => asset('img/airplanes/Global-5000_white.png')],
            ['name' => 'Gulfstream G650', 'type' => AirplaneTypesEnum::PRIVATE, 'capacity' => 30, 'lifespan' => 5, 'image' => asset('img/airplanes/Gulfstream_G650ER_white.png')],
            ['name' => 'Bombardier Learjet 45', 'type' => AirplaneTypesEnum::PRIVATE, 'capacity' => 30, 'lifespan' => 20, 'image' => asset('img/airplanes/Learjet-45-white.png')],
            ['name' => 'Cessna Citation X', 'type' => AirplaneTypesEnum::PRIVATE, 'capacity' => 20, 'lifespan' => 5, 'image' => asset('img/airplanes/Cessna_Citation_X_white.png')],

            // Cargo
            ['name' => 'Boeing 737-800BCF', 'type' => AirplaneTypesEnum::CARGO, 'capacity' => 50, 'lifespan' => 5, 'image' => asset('img/airplanes/737-800BCF_white.png')],
            ['name' => 'Boeing 747-400F', 'type' => AirplaneTypesEnum::CARGO, 'capacity' => 90, 'lifespan' => 5, 'image' => asset('img/airplanes/747-400F_white_sm.png')],
            ['name' => 'Boeing 777F', 'type' => AirplaneTypesEnum::CARGO, 'capacity' => 60, 'lifespan' => 5, 'image' => asset('img/airplanes/777F_white_sm.png')],
            ['name' => 'Airbus A330-200F', 'type' => AirplaneTypesEnum::CARGO, 'capacity' => 70, 'lifespan' => 5, 'image' => asset('img/airplanes/A330-200F_PW_white.png')],
            ['name' => 'Airbus A350F', 'type' => AirplaneTypesEnum::CARGO, 'capacity' => 80, 'lifespan' => 5, 'image' => asset('img/airplanes/A350F_white.png')],
            ['name' => 'Boeing C-17', 'type' => AirplaneTypesEnum::CARGO, 'capacity' => 100, 'lifespan' => 5, 'image' => asset('img/airplanes/C-17_white.png')],
        ];

        foreach ($airplanes as $airplane) {
            Airplane::create([
                'name'       => $airplane['name'],
                'type'       => $airplane['type']->value,
                'image'      => $airplane['image'],
                'capacity'   => $airplane['capacity'],
                'lifespan'   => $airplane['lifespan'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
