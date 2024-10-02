<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Event extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function airline(): BelongsTo
    {
        return $this->belongsTo(Airline::class);
    }

    public function airlineAirplane(): BelongsTo
    {
        return $this->belongsTo(AirlineAirplane::class);
    }

    public function airlineAirport(): BelongsTo
    {
        return $this->belongsTo(AirlineAirport::class);
    }

    public function flight(): BelongsTo
    {
        return $this->belongsTo(Flight::class);
    }
}
