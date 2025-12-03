<?php

namespace App\Console\Commands;

use App\Models\Airport;
use App\Models\Passenger;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class PassengerCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:passengers';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Passenger::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        $airports = Airport::pluck('id')->toArray();

        for ($i = 1; $i <= 10000; $i++) {
            do {
                $origin = $airports[array_rand($airports)];
                $destination = $airports[array_rand($airports)];
            } while ($origin === $destination);

            $passengers[] = [
                'origin_id'      => $origin,
                'destination_id' => $destination
            ];
        }
        Passenger::insert($passengers);
        dd('done!');
    }
}
