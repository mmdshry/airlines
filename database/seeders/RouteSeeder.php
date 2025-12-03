<?php

namespace Database\Seeders;

use App\Enums\RouteStatusEnum;
use App\Models\Airline;
use App\Models\Airport;
use App\Models\Route;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class RouteSeeder extends Seeder
{
    public function run(): void
    {
        $airports = Airport::all();
        $airlines = Airline::all();

        if ($airports->count() < 2 || $airlines->count() < 2) {
            throw new \Exception('Need at least 2 airports and 2 airlines to create routes');
        }

        $statuses = array_column(RouteStatusEnum::cases(), 'value');
        $routeNames = $this->generateUniqueRouteNames(100);

        for ($i = 0; $i < 100; $i++) {
            // Get random unique origin and destination
            do {
                $origin = $airports->random();
                $destination = $airports->random();
            } while ($origin->id === $destination->id);

            // Get random unique sender and receiver airlines
            do {
                $sender = $airlines->random();
                $receiver = $airlines->random();
            } while ($sender->id === $receiver->id);

            Route::create([
                'name' => $routeNames[$i],
                'origin_id' => $origin->id,
                'destination_id' => $destination->id,
                'sender_id' => $sender->id,
                'receiver_id' => $receiver->id,
                'expires_at' => Carbon::now()->addMonths(random_int(1, 24)),
                'status' => $statuses[array_rand($statuses)],
                'created_at' => Carbon::now()->subDays(random_int(0, 365)),
            ]);
        }
    }

    protected function generateUniqueRouteNames(int $count): array
    {
        $names = [];
        $usedCodes = [];

        for ($i = 1; $i <= $count; $i++) {
            do {
                // Generate route codes like "NYC-LON-AA-UA" (origin-destination-sender-receiver)
                $code = strtoupper(
                    substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 3) . '-' .
                    substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 3) . '-' .
                    substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 2) . '-' .
                    substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 2)
                );
            } while (in_array($code, $usedCodes));

            $usedCodes[] = $code;
            $names[] = $code;
        }

        return $names;
    }
}