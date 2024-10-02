<?php

namespace Database\Seeders;

use App\Models\Airline;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AirlineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $airlines = [
            [
                'name' => 'American Airlines',
                'iata_code' => 'AA',
                'icao_code' => 'AAL',
                'callsign' => 'AMERICAN',
                'airport_iata_code' => 'JFK',
                'image' => asset('img/airlines/American_Airlines_logo_2013.svg.png')
            ],
            [
                'name' => 'Air France',
                'iata_code' => 'AF',
                'icao_code' => 'AFR',
                'callsign' => 'AIRFRANS',
                'airport_iata_code' => 'CDG',
                'image' => asset('img/airlines/Air_France_Logo.svg.png')
            ],
            [
                'name' => 'British Airways',
                'iata_code' => 'BA',
                'icao_code' => 'BAW',
                'callsign' => 'SPEEDBIRD',
                'airport_iata_code' => 'LHR',
                'image' => asset('img/airlines/British_Airways_Logo.svg.png')
            ],
            [
                'name' => 'Lufthansa',
                'iata_code' => 'LH',
                'icao_code' => 'DLH',
                'callsign' => 'LUFTHANSA',
                'airport_iata_code' => 'FRA',
                'image' => asset('img/airlines/Lufthansa_Logo_2018.svg.png')
            ],
            [
                'name' => 'Air Canada',
                'iata_code' => 'AC',
                'icao_code' => 'ACA',
                'callsign' => 'AIR CANADA',
                'airport_iata_code' => 'YYZ',
                'image' => asset('img/airlines/Air_Canada_Logo.svg.png')
            ],
            [
                'name' => 'Qantas',
                'iata_code' => 'QF',
                'icao_code' => 'QFA',
                'callsign' => 'QANTAS',
                'airport_iata_code' => 'SYD',
                'image' => asset('img/airlines/Qantas_Airways_logo_2016.svg.png')
            ],
            [
                'name' => 'Japan Airlines',
                'iata_code' => 'JL',
                'icao_code' => 'JAL',
                'callsign' => 'JAPAN AIR',
                'airport_iata_code' => 'HND',
                'image' => asset('img/airlines/Japan_Airlines_Logo_(2011).svg.png')
            ],
            [
                'name' => 'Qatar Airways',
                'iata_code' => 'QR',
                'icao_code' => 'QTR',
                'callsign' => 'QATARI',
                'airport_iata_code' => 'DOH',
                'image' => asset('img/airlines/Qatar_Airways_Logo.svg.png')
            ],
            [
                'name' => 'Emirates',
                'iata_code' => 'EK',
                'icao_code' => 'UAE',
                'callsign' => 'EMIRATES',
                'airport_iata_code' => 'DXB',
                'image' => asset('img/airlines/Emirates_logo.svg.png')
            ],
            [
                'name' => 'Singapore Airlines',
                'iata_code' => 'SQ',
                'icao_code' => 'SIA',
                'callsign' => 'SINGAPORE',
                'airport_iata_code' => 'SIN',
                'image' => asset('img/airlines/Singapore_Airlines_Logo_2.svg.png')
            ],
            [
                'name' => 'Turkish Airlines',
                'iata_code' => 'TK',
                'icao_code' => 'THY',
                'callsign' => 'TURKISH',
                'airport_iata_code' => 'IST',
                'image' => asset('img/airlines/Turkish_Airlines_logo_2019_compact.svg.png')
            ],
            [
                'name' => 'Iran Air',
                'iata_code' => 'IR',
                'icao_code' => 'IRA',
                'callsign' => 'IRANAIR',
                'airport_iata_code' => 'IKA',
                'image' => asset('img/airlines/Logo_IranAir2022.png')
            ],
            [
                'name' => 'Aeroflot',
                'iata_code' => 'SU',
                'icao_code' => 'AFL',
                'callsign' => 'AEROFLOT',
                'airport_iata_code' => 'SVO',
                'image' => asset('img/airlines/Aeroflot_Logo_en.svg.png')
            ],
            [
                'name' => 'China Airlines',
                'iata_code' => 'CI',
                'icao_code' => 'CAL',
                'callsign' => 'DYNASTY',
                'airport_iata_code' => 'CAN',
                'image' => asset('img/airlines/China_Airlines.svg.png')
            ],
        ];

        foreach ($airlines as $airline) {
            Airline::create($airline);
        }
    }
}
