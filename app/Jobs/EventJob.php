<?php

namespace App\Jobs;

use App\Enums\AirplaneStatusEnum;
use App\Enums\EventEnum;
use App\Models\Airline;
use App\Models\Airplane;
use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class EventJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private Airline $airline;

    public function __construct(Airline $airline)
    {
        $this->airline = $airline;
    }

    public function handle()
    {
        // Define tasks with their respective probabilities
        $tasks = [
            EventEnum::PASSENGER->value => 0.70,
            EventEnum::CARGO->value     => 0.20,
            EventEnum::LIFESPAN->value  => 0.05,
            EventEnum::DELAY->value     => 0.03,
            EventEnum::AIRPLANE->value  => 0.02,
            EventEnum::CRASH->value     => 0.01
        ];

        // Get a random number between 0 and 1
        $random = mt_rand() / mt_getrandmax();
        echo $random;

        // Determine which task to execute based on probabilities
        $cumulativeProbability = 0;
        foreach ($tasks as $task => $probability) {
            $cumulativeProbability += $probability;
            if ($random <= $cumulativeProbability) {
                $this->executeTask($task, $this->airline);
                break;
            }
        }
    }

    protected function executeTask($task)
    {
        if (count($this->airline->flights->where('status', AirplaneStatusEnum::FLYING->value))) {
            $flight = $this->airline->flights->shuffle()->first();
            $airplane = $flight->airplane;
            $airplane->update(['status' => AirplaneStatusEnum::CRASHED->value]);
            $flight->expired_at = now();
            $flight->status = AirplaneStatusEnum::CRASHED->value;
            $flight->save();
            Event::create([
                'airline_id'  => $this->airline->id,
                'flight_id'   => $flight->id,
                'is_crashed'  => 1,
                'airplane_id' => $airplane->id,
                'description' => "Flight {$flight->origin->iata_code} -> {$flight->destination->iata_code} has crashed"
            ]);
        }
        Event::create(['airline_id' => $this->airline->id,'is_missed' => 1, 'description' => "No {$task} for {$this->airline->name} flights"]);
        dd('ok!');
        switch ($task) {
            case EventEnum::PASSENGER->value:
                $passengers = random_int(30, 60);
                $this->airline->airlineAirport->increment('passengers', $passengers);
                Event::create([
                    'airline_id'  => $this->airline->id,
                    'airport_id'  => $this->airline->id,
                    'passengers'  => $passengers,
                    'description' => "{$passengers} {$task}'s added to {$this->airline->airport->name}"
                ]);
                break;
            case EventEnum::CARGO->value:
                $cargo = random_int(10, 20);
                $this->airline->airlineAirport->increment('cargo', $cargo);
                Event::create([
                    'airline_id'  => $this->airline->id,
                    'airport_id'  => $this->airline->id,
                    'cargo'       => $cargo,
                    'description' => "{$cargo} Ton {$task}'s added to {$this->airline->airport->name}"
                ]);
                break;
            case EventEnum::LIFESPAN->value:
                $lifespan = random_int(5, 20);
                if (count($this->airline->airlineAirplanes)) {
                    $airplane = $this->airline->airlineAirplanes->shuffle()->first();
                    $airplane->increment('lifespan', $lifespan);
                    Event::create([
                        'airline_id'  => $this->airline->id,
                        'airplane_id' => $airplane->id,
                        'lifespan'    => $lifespan,
                        'description' => "{$lifespan} Hours {$task} added to {$airplane->callsign}"
                    ]);
                }
                Event::create(['airline_id' => $this->airline->id,'is_missed' => 1, 'description' => "No {$task} $lifespan Hours {$task} for {$this->airline->name}"]);
                break;
            case EventEnum::DELAY->value:
                $delay = random_int(5, 15);
                if (count($this->airline->flights)) {
                    $flight = $this->airline->flights->shuffle()->first();
                    $flight->landed_at = Carbon::parse($flight->landed_at)->addMinutes($delay);
                    $flight->save();
                    Event::create([
                        'airline_id'  => $this->airline->id,
                        'flight_id'   => $flight->id,
                        'delay'       => $delay,
                        'description' => "{$delay} Minutes {$task} added to {$flight->origin->iata_code} -> {$flight->destination->iata_code} flight"
                    ]);
                }
                Event::create(['airline_id' => $this->airline->id,'is_missed' => 1, 'description' => "No {$delay} Minutes {$task} for {$this->airline->name} flight"]);
                break;
            case EventEnum::AIRPLANE->value:
                $airplane = Airplane::inRandomOrder()->first();
                $airlineAirplane = $this->airline->airlineAirplanes()->create([
                    'airplane_id' => $airplane->id,
                    'airport_id'  => $this->airline->airport->id,
                ]);
                Event::create([
                    'airline_id'  => $this->airline->id,
                    'airplane_id' => $airlineAirplane->id,
                    'airdrop'     => $airplane->id,
                    'description' => "A brand new {$airplane->name}{$task} added to {$this->airline->name}"
                ]);
                break;
            case EventEnum::CRASH->value:
                if (count($this->airline->flights->where('status', AirplaneStatusEnum::FLYING->value))) {
                    $flight = $this->airline->flights->shuffle()->first();
                    $airplane = $flight->airplane;
                    $airplane->update(['status', AirplaneStatusEnum::CRASHED->value]);
                    $flight->expired_at = now();
                    $flight->status = AirplaneStatusEnum::CRASHED->value;
                    $flight->save();
                    Event::create([
                        'airline_id'  => $this->airline->id,
                        'flight_id'   => $flight->id,
                        'is_crashed'  => 1,
                        'airplane_id' => $airplane->id,
                        'description' => "Flight {$flight->origin->iata_code} -> {$flight->destination->iata_code} has crashed"
                    ]);
                }
                Event::create(['airline_id' => $this->airline->id,'is_missed' => 1, 'description' => "No {$task} for {$this->airline->name} flights"]);
                break;
        }
    }
}
