<?php

namespace App\Jobs;

use App\Enums\AirplaneStatusEnum;
use App\Enums\FlightStatusEnum;
use App\Helper\CalculationHelper;
use App\Models\Flight;
use Bavix\Wallet\Internal\Exceptions\ExceptionInterface;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class FlightProcessorJob  implements ShouldQueue
{
    use Queueable;

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        foreach ($this->getFlyingFlights() as $flight) {
            $this->processLandedFlight($flight);
        }
        dd('dome!');
    }

    /**
     * Retrieve all flights that are currently flying.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    private function getFlyingFlights()
    {
        return Flight::with(['airplane', 'origin', 'destination', 'sender.user'])
            ->where('status', AirplaneStatusEnum::FLYING->value)
            ->whereDate('landed_at', '<=', now())
            ->get();
    }

    /**
     * Process a landed flight by updating its status and handling financial transactions.
     *
     * @param  Flight  $flight
     * @return void
     * @throws ExceptionInterface
     */
    private function processLandedFlight(Flight $flight): void
    {
        // Update flight status to landed
        $flight->update(['status' => FlightStatusEnum::LANDED->value]);

        // Update airplane status and airport ID
        $flight->airplane->update([
            'status' => AirplaneStatusEnum::ACTIVE->value,
            'airport_id' => $flight->destination->id,
        ]);
        
        // Calculate ticket price and salary for sender
        $ticketPrice = CalculationHelper::calculateTicketPrice($flight->origin, $flight->destination);
        $salary = $ticketPrice * $flight->capacity;

        // Deposit salary to sender's user account
        $flight->sender->user->deposit($salary,$flight->fresh()->toArray());

    }
}
