<?php

namespace Database\Seeders;

use App\Models\AirlineUser;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AirlineUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'user_id'       => 1,
                'airline_id'      => 1
            ],
            [
                'user_id'       => 2,
                'airline_id'      => 2
            ],
        ];

        foreach ($users as $user) {
            AirlineUser::create($user);
        }
    }
}
