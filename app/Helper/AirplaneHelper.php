<?php

namespace App\Helper;

use App\Enums\AirplaneTypesEnum;
use App\Models\Airline;
use App\Models\AirlineAirplane;
use App\Models\Airplane;
use App\Models\Airport;
use Illuminate\Support\Str;

class AirplaneHelper
{
    public static function callsignGenerator(Airline $airline,Airplane $airplane): string
    {
        $number = AirlineAirplane::count() + 1;
        // Remove leading and trailing spaces
        $string = trim($airline->callsign . ' ' . $airplane->name);

        // Split the string into words

        $words = explode(' ', $string);

        // Initialize the abbreviation string
        $abbreviation = '';

        // Iterate over each word
        foreach ($words as $word) {
            // Take the first letter of each word, convert to uppercase
            $abbreviation .= strtoupper(substr($word, 0, 3));
        }

        return match ($airplane->type) {
            AirplaneTypesEnum::COMMERCIAL->value => $abbreviation.'C'.$number,
            AirplaneTypesEnum::PRIVATE->value => $abbreviation.'P'.$number,
            AirplaneTypesEnum::CARGO->value => $abbreviation.'F'.$number,
            default => $abbreviation,
        };
    }
}
