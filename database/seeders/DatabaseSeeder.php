<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            AirlineSeeder::class,
            AirportSeeder::class,
            AirplaneSeeder::class,
            AirlineAirportSeeder::class,
            AirlineAirplanesSeeder::class,
            UserSeeder::class,
            AirlineUserSeeder::class,

        ]);
    }
}
