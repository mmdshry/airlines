<?php

namespace App\Models;

use Couchbase\Origin;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Flight extends Model
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

    public function sender(): BelongsTo
    {
        return $this->belongsTo(Airline::class, 'sender_id');
    }

    public function receiver(): BelongsTo
    {
        return $this->belongsTo(Airline::class, 'receiver_id');
    }

    public function airplane(): BelongsTo
    {
        return $this->belongsTo(AirlineAirplane::class,'airplane_id');
    }
}
