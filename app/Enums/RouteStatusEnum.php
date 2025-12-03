<?php

namespace App\Enums;

enum RouteStatusEnum: string
{
    case ACTIVE = 'active';
    case DEACTIVATE = 'deactivate';
    case EXPIRED = 'expired';
    case SANCTIONED = 'sanctioned';
}
