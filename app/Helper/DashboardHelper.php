<?php

namespace App\Helper;

use App\Enums\ContractStatusEnum;
use App\Models\Airline;
use App\Models\Airport;
use App\Models\contract;
use Illuminate\Support\Facades\Auth;

class DashboardHelper
{
    public static function airportsAround(Airline $airline): array
    {

        $mainAirport = $airline->airport;
        $airports = Airport::all();
        $distances = [];
        foreach ($airports as $airport) {
            if ($airport->id === $mainAirport->id) {
                continue;
            }
            $distances[] = [
                'name' => $airport->name,
                'owner' => $airport->owner(),
                'distance' => CalculationHelper::calculateDistance($mainAirport, $airport),
                'time' => CalculationHelper::calculateTime($mainAirport, $airport),
                'ticket' => CalculationHelper::calculateTicketPrice($mainAirport, $airport),
                'contract' => CalculationHelper::calculateContract($airline, $airport->airline),
            ];

        }

        usort($distances, static function ($a, $b) {
            return $a['distance'] <=> $b['distance'];
        });

        return $distances;
    }
}
