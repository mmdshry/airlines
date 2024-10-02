<?php

namespace App\Helper;

use App\Enums\ContractStatusEnum;
use App\Models\Airline;
use App\Models\Airport;
use App\Models\contract;
use Illuminate\Support\Facades\Auth;

class ContractHelper
{

    public static function hasPermission(Airline $airline1,Airline $airline2): int
    {
        return contract::where('sender', $airline1->id)->where('receiver',$airline2->id)->where('status', ContractStatusEnum::ACCEPTED->value)->exists();
    }

    public static function hasPendingPermission(Airline $airline1,Airline $airline2): int
    {
        return contract::where('sender', $airline1->id)->where('receiver',$airline2->id)->where('status', ContractStatusEnum::PENDING->value)->exists();
    }
}
