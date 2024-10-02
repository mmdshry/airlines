<?php

namespace App\Enums;

enum AirplaneStatusEnum: string
{
    case ACTIVE = 'active';
    case FLYING = 'flying';
    case PENDING = 'pending';
    case CRASHED = 'crashed';
    case INACTIVE = 'inactive';
}
