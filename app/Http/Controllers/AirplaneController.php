<?php

namespace App\Http\Controllers;

use App\Jobs\FlightProcessorJob;
use App\Models\Airplane;
use Illuminate\Http\Request;

class AirplaneController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        dd(FlightProcessorJob::dispatch());
        /*        dd(EventJob::dispatch(User::first()));
                $aorport1= Flight::first();
                dd($aorport1->destination);
                $air1 = Airline::find(1);
                $air2 = Airline::find(2);
                dd(DashboardHelper::airportsAround($air1));

                FlightDepartureJob::dispatch()->delay(now()->addSeconds(5));
                FlightArrivalJob::dispatch()->delay(now()->addSeconds(10));
                dd('don!');
                $user = User::first();

                foreach ($user->airline->airplanes as $airplane) {
                    dd($airplane->name);
                }

                $air1 = Airport::where('iata_code','DXB')->first();
                $air2 = Airport::where('iata_code','IKA')->first();

                $distance = CalculationHelper::calculateDistance($air1, $air2);
                $travelTime = CalculationHelper::calculateTime($distance);
                $ticketPrice = CalculationHelper::calculateTicketPrice($air1, $air2);

                dd($distance,$travelTime,$ticketPrice);
        */

        $airplanes = Airplane::all();
        return view('airplanes', compact('airplanes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Airplane $airplane)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Airplane $airplane)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Airplane $airplane)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Airplane $airplane)
    {
        //
    }
}
