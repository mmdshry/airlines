<?php

namespace App\Helper;

use App\Models\Airline;
use App\Models\Airplane;
use App\Models\Airport;

class CalculationHelper
{

    public static function calculateDistance(Airport $airport1,Airport $airport2): int
    {
        $earthRadius = 6371; // in kilometers

        $lat1 = $airport1->latitude;
        $lon1 = $airport1->longitude;

        $lat2 = $airport2->latitude;
        $lon2 = $airport2->longitude;

        $latDelta = deg2rad($lat2 - $lat1);
        $lonDelta = deg2rad($lon2 - $lon1);

        $a = sin($latDelta / 2) * sin($latDelta / 2) +
            cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
            sin($lonDelta / 2) * sin($lonDelta / 2);

        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        return ceil($earthRadius * $c);
    }

    public static function calculateTime(Airport $airport1,Airport $airport2, Airplane|null $airplane = null): int
    {
        $speed = $airplane->speed ?? config('services.server.airplane_speed');
        $distance = self::calculateDistance($airport1, $airport2);
        $timeInHours = $distance / $speed;

        return ceil($timeInHours);
    }

    public static function calculateTicketPrice(Airport $airport1,Airport $airport2): int
    {
        $timeInHours = self::calculateTime($airport1, $airport2);
        $distance = self::calculateDistance($airport1, $airport2);

        // Coefficients for the linear model (these values would be determined by training a model)
        $basePrice = $timeInHours * config('services.server.ticket_rate');  // Base price in dollars
        $pricePerKm = 0.03;  // Cost per kilometer
        $pricePerHour = 10;  // Cost per hour

        // Calculate the ticket price
        $predictedPrice = $basePrice + ($pricePerKm * $distance) + ($pricePerHour * $timeInHours);

        return ceil($predictedPrice);
    }

    public static function calculateContract(Airline $airline1,Airline $airline2): int
    {
        $timeInHours = self::calculateTime($airline1->airport, $airline2->airport);
        $contractPrice = $timeInHours * config('services.server.contract_rate');

        return ceil($contractPrice);
    }
}
