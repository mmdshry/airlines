<?php

namespace App\Console\Commands;

use App\Enums\FlightStatusEnum;
use App\Enums\PassengerStatusEnum;
use App\Helper\CalculationHelper;
use App\Models\Flight;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;

class FlightProcessorCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:flight-processor-command';

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
        Flight::where('status','!=',FlightStatusEnum::LANDED)
            ->where('landed_at','<=',now())->each(static function ($flight) {
                $flight->passengers()->update(['status' => PassengerStatusEnum::LANDED]);
                $income = CalculationHelper::calculateTicketPrice($flight->origin,$flight->destination) * $flight->passengers->count();
                User::first()->deposit($income);
        });
    }
}
