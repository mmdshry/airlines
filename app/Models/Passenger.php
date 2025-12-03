<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Passenger extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * Get the origin airport for the flight.
     */
    public function origin(): BelongsTo
    {
        return $this->belongsTo(Airport::class, 'origin_id');
    }

    /**
     * Get the destination airport for the flight.
     */
    public function destination(): BelongsTo
    {
        return $this->belongsTo(Airport::class, 'destination_id');
    }

    /**
     * Get the destination airport for the flight.
     */
    public function flight(): BelongsTo
    {
        return $this->belongsTo(Flight::class, 'flight_id');
    }
}
