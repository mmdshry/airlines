<?php

namespace App\Enums;

enum EventEnum: string
{
    case PASSENGER = 'passenger';
    case CARGO = 'cargo';
    case LIFESPAN = 'lifespan';
    case DELAY = 'delay';
    case AIRPORT_CLOSE = 'airport_close';
    case AIRPLANE = 'airplane';
    case CRASH = 'crash';
    case INCOME = 'income';
}
