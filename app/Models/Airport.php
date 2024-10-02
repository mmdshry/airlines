<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

class Airport extends Model
{
    use HasFactory;

    public function owner()
    {
        return $this->airline->user->name ?? 'N/A';
    }

    /**
     * Get the flights that depart from this airport.
     */
    public function departures()
    {
        return $this->hasMany(Flight::class, 'origin');
    }

    /**
     * Get the flights that arrive at this airport.
     */
    public function arrivals()
    {
        return $this->hasMany(Flight::class, 'destination');
    }

    public function airline(): HasOneThrough
    {
        return $this->hasOneThrough(
            Airline::class,
            AirlineAirport::class,
            'airport_id', // Foreign key on airline_airplanes table
            'id',         // Foreign key on airplanes table
            'id',         // Local key on airlines table
            'airline_id' // Local key on airline_airplanes table
        );
    }

    /**
     * Get all flights (departures and arrivals) for this airport.
     */
    public function flights()
    {
        // Retrieve both departures and arrivals
        $departures = $this->departures()->get();
        $arrivals = $this->arrivals()->get();

        // Merge both collections
        return $departures->merge($arrivals);
    }

    public function scopeActive($query)
    {
        return $query->whereHas('airline.user');
    }
}
