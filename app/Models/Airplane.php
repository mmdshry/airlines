<?php

namespace App\Models;

use App\Helper\CalculationHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Airplane extends Model
{
    use HasFactory;

    public function airlines()
    {
        return $this->belongsToMany(Airline::class, 'airline_airplanes');
    }

    public function airport()
    {
        return $this->hasManyThrough(Airport::class,AirlineAirplane::class,'airport_id','id');
    }

    public function airlineAirplanes()
    {
        return $this->hasMany(AirlineAirplane::class);
    }
}
