<?php

namespace App\Models;

use App\Enums\FlightStatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

class Flight extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'departed_at' => 'datetime',
        'landed_at' => 'datetime',
        'expired_at' => 'datetime',
        'status' => FlightStatusEnum::class,
    ];

    /**
     * Get the route for the flight.
     */
    public function route(): BelongsTo
    {
        return $this->belongsTo(Route::class);
    }

    /**
     * Get the origin airport for the flight (through route).
     */
    public function origin(): HasOneThrough
    {
        return $this->hasOneThrough(
            Airport::class,
            Route::class,
            'id', // Foreign key on routes table
            'id', // Foreign key on airports table
            'route_id', // Local key on flights table
            'origin_id' // Local key on routes table
        );
    }

    /**
     * Get the destination airport for the flight (through route).
     */
    public function destination(): HasOneThrough
    {
        return $this->hasOneThrough(
            Airport::class,
            Route::class,
            'id', // Foreign key on routes table
            'id', // Foreign key on airports table
            'route_id', // Local key on flights table
            'destination_id' // Local key on routes table
        );
    }

    /**
     * Get the sender airline for the flight (through route).
     */
    public function sender(): HasOneThrough
    {
        return $this->hasOneThrough(
            Airline::class,
            Route::class,
            'id', // Foreign key on routes table
            'id', // Foreign key on airlines table
            'route_id', // Local key on flights table
            'sender_id' // Local key on routes table
        );
    }

    /**
     * Get the receiver airline for the flight (through route).
     */
    public function receiver(): HasOneThrough
    {
        return $this->hasOneThrough(
            Airline::class,
            Route::class,
            'id', // Foreign key on routes table
            'id', // Foreign key on airlines table
            'route_id', // Local key on flights table
            'receiver_id' // Local key on routes table
        );
    }

    /**
     * Get the airplane for the flight.
     */
    public function airplane(): BelongsTo
    {
        return $this->belongsTo(AirlineAirplane::class, 'airplane_id');
    }

    public function passengers(): HasMany
    {
        return $this->hasMany(Passenger::class, 'flight_id');
    }
}
