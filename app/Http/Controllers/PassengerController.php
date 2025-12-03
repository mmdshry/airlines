<?php

namespace App\Http\Controllers;

use App\Enums\PassengerStatusEnum;
use App\Helper\CalculationHelper;
use App\Models\Airport;
use App\Models\Passenger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PassengerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Group passengers by origin and destination
        $passengers = Passenger::where('status', 'SEEKING')
            ->with(['origin', 'destination']) // Load both relationships
            ->get()
            ->groupBy(['origin_id', 'destination_id']);

        // Prepare data for the view
        $groupedPassengers = [];
        foreach ($passengers as $originId => $destinationGroups) {
            $origin = Airport::find($originId);
            foreach ($destinationGroups as $destinationId => $group) {
                $destination = Airport::find($destinationId);
                $groupedPassengers[] = [
                    'origin' => $origin->name . ' (' . $origin->iata_code . ')',
                    'destination' => $destination->name . ' (' . $destination->iata_code . ')',
                    'ticket' => CalculationHelper::calculateTicketPrice($origin,$destination),
                    'count' => $group->count(),
                ];
            }
        }

        return view('passengers', compact('groupedPassengers'));
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
    public function show(Passenger $passenger)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Passenger $passenger)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Passenger $passenger)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Passenger $passenger)
    {
        //
    }

    public function reserve(Passenger $passenger)
    {
        $user = Auth::user();
        $flights = $user->flights;

        // Ensure the passenger's origin and destination match the flight's route
        $matchingFlights = $flights->filter(function ($flight) use ($passenger) {
            return $flight->origin_id == $passenger->origin_id && $flight->destination_id == $passenger->destination_id;
        });

        return view('passengers.reserve', compact('passenger', 'matchingFlights'));
    }

    public function storeReservation(Request $request)
    {
        $request->validate([
            'flight_id' => 'required|exists:flights,id',
        ]);


        return redirect()->route('passengers.index')->with('success', 'Passenger reserved successfully.');
    }

}
