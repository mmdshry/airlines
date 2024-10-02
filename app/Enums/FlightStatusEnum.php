<?php

namespace App\Enums;

enum FlightStatusEnum: string
{
    case DEPARTING = 'departing';
    case FLYING = 'flying';
    case CRASHED = 'crashed';
    case CANCELED = 'canceled';
    case LANDED = 'landed';
}
