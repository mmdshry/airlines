<?php

namespace Database\Seeders;

use App\Enums\PassengerStatusEnum;
use App\Models\Airport;
use App\Models\Passenger;
use Illuminate\Database\Seeder;

class PassengerSeeder extends Seeder
{
    public function run(): void
    {
        $airports = Airport::all();

        if ($airports->count() < 2) {
            throw new \Exception('Need at least 2 airports to create passengers');
        }

        for ($i = 0; $i < 100; $i++) {
            // Get random unique origin and destination
            do {
                $origin = $airports->random();
                $destination = $airports->random();
            } while ($origin->id === $destination->id);

            Passenger::create([
                'origin_id' => $origin->id,
                'destination_id' => $destination->id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}