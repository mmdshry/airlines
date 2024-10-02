<?php

namespace Database\Seeders;

use App\Models\Airline;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name'       => 'Mohammad',
                'email'      => 'unshields@gmail.com',
                'password'   => Hash::make('123456789'),
            ],
            [
                'name'       => 'Majid',
                'email'      => 'majid@gmail.com',
                'password'   => Hash::make('123456789'),
            ]
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
