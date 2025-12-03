<?php

namespace App\Enums;

enum PassengerStatusEnum: string
{
    case SEEKING = 'seeking';
    case WAITING = 'waiting';
    case DEPARTING = 'departing';
    case FLYING = 'flying';
    case CRASHED = 'crashed';
    case CANCELED = 'canceled';
    case LANDED = 'landed';
}
