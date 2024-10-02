<?php

namespace Database\Seeders;

use App\Models\Airport;
use Illuminate\Database\Seeder;

class AirportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $airports = [
            ['name' => 'John F. Kennedy International Airport', 'iata_code' => 'JFK', 'icao_code' => 'KJFK', 'latitude' => 40.6413, 'longitude' => -73.7781],
            ['name' => 'Paris Charles de Gaulle Airport', 'iata_code' => 'CDG', 'icao_code' => 'LFPG', 'latitude' => 49.0097, 'longitude' => 2.5479],
            ['name' => 'London Heathrow Airport', 'iata_code' => 'LHR', 'icao_code' => 'EGLL', 'latitude' => 51.4700, 'longitude' => -0.4543],
            ['name' => 'Frankfurt Airport', 'iata_code' => 'FRA', 'icao_code' => 'EDDF', 'latitude' => 50.0379, 'longitude' => 8.5622],
            ['name' => 'Toronto Pearson International Airport', 'iata_code' => 'YYZ', 'icao_code' => 'CYYZ', 'latitude' => 43.6777, 'longitude' => -79.6248],
            ['name' => 'Sydney Airport', 'iata_code' => 'SYD', 'icao_code' => 'YSSY', 'latitude' => -33.9399, 'longitude' => 151.1753],
            ['name' => 'Haneda Airport', 'iata_code' => 'HND', 'icao_code' => 'RJTT', 'latitude' => 35.5533, 'longitude' => 139.7811],
            ['name' => 'Hamad International Airport', 'iata_code' => 'DOH', 'icao_code' => 'OTHH', 'latitude' => 25.2731, 'longitude' => 51.6081],
            ['name' => 'Dubai International Airport', 'iata_code' => 'DXB', 'icao_code' => 'OMDB', 'latitude' => 25.2532, 'longitude' => 55.3657],
            ['name' => 'Singapore Changi Airport', 'iata_code' => 'SIN', 'icao_code' => 'WSSS', 'latitude' => 1.3644, 'longitude' => 103.9915],
            ['name' => 'Istanbul Airport', 'iata_code' => 'IST', 'icao_code' => 'LTFM', 'latitude' => 41.2751, 'longitude' => 28.7519],
            ['name' => 'Imam Khomeini Airport', 'iata_code' => 'IKA', 'icao_code' => 'OIIE', 'latitude' => 35.4161, 'longitude' => 51.1522],
            ['name' => 'Sheremetyevo International Airport', 'iata_code' => 'SVO', 'icao_code' => 'UUEE', 'latitude' => 55.9736, 'longitude' => 37.4125],
            ['name' => 'Guangzhou Baiyun International Airport', 'iata_code' => 'CAN', 'icao_code' => 'ZGGG', 'latitude' => 23.392500, 'longitude' => 113.298889],
        ];

        foreach ($airports as $airport) {
            Airport::create($airport);
        }
    }
}
