<?php

namespace App\Enums;

enum AirplaneTypesEnum: string
{
    case COMMERCIAL = 'commercial';
    case PRIVATE = 'private';
    case CARGO = 'cargo';

    public function label(): string
    {
        return match($this)
        {
            self::COMMERCIAL => 'Commercial Airplane',
            self::PRIVATE => 'Private Airplane',
            self::CARGO => 'Cargo Airplane',
        };
    }
}
