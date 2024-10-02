<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

class Airline extends Model
{
    use HasFactory;

    public function user(): HasOneThrough
    {
        return $this->hasOneThrough(User::class,AirlineUser::class , 'id' , 'id' , 'id' , 'user_id');
    }

    public function airplanes(): HasManyThrough
    {
        return $this->hasManyThrough(
            Airplane::class,
            AirlineAirplane::class,
            'airline_id', // Foreign key on airline_airplanes table
            'id',         // Foreign key on airplanes table
            'id',         // Local key on airlines table
            'airplane_id' // Local key on airline_airplanes table
        );
    }

    public function airlineAirplanes(): HasMany
    {
        return $this->hasMany(AirlineAirplane::class);
    }

    public function contracts(): HasMany
    {
        return $this->hasMany(Contract::class);
    }

    public function airlineAirport(): HasOne
    {
        return $this->hasOne(AirlineAirport::class);
    }

    public function airport(): HasOneThrough
    {
        return $this->hasOneThrough(
            Airport::class,
            AirlineAirport::class,
            'airline_id', // Foreign key on airline_airplanes table
            'id',         // Foreign key on airplanes table
            'id',         // Local key on airlines table
            'airport_id' // Local key on airline_airplanes table
        );
    }

    public function flights(): hasMany
    {
        return $this->hasMany(Flight::class, 'sender_id');
    }

    /**
     * Get the airline associated with the user.
     */
    public function events(): HasMany
    {
        return $this->hasMany(Event::class);
    }
}
