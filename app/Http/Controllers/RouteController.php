<?php

namespace App\Http\Controllers;

use App\Models\Route;
use App\Models\Airport;
use App\Models\Airline;
use App\Enums\RouteStatusEnum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class RouteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // For regular users, show only their airline's routes
        // For admins, show all routes
        $routes = Route::with(['origin', 'destination', 'sender', 'receiver'])
            ->when(!auth()->user()->isAdmin(), function($query) {
                $query->where(function($q) {
                    $q->where('sender_id', auth()->user()->airline->id)
                        ->orWhere('receiver_id', auth()->user()->airline->id);
                });
            })
            ->latest()
            ->paginate(10);

        return view('routes.index', compact('routes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $airports = Airport::active()->get();
        $airlines = Airline::where('id', '!=', auth()->user()->airline->id)->get();

        return view('routes.create', compact('airports', 'airlines'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:routes',
            'origin_id' => 'required|exists:airports,id',
            'destination_id' => 'required|exists:airports,id|different:origin_id',
            'receiver_id' => 'required|exists:airlines,id',
            'expires_at' => 'nullable|date',
        ]);

        // Prevent creating a route to yourself
        if ($validated['receiver_id'] == auth()->user()->airline->id) {
            return back()->withErrors(['receiver_id' => 'You cannot create a route to your own airline.']);
        }

        // Check if similar route already exists
        $existingRoute = Route::where('origin_id', $validated['origin_id'])
            ->where('destination_id', $validated['destination_id'])
            ->where('sender_id', auth()->user()->airline->id)
            ->where('receiver_id', $validated['receiver_id'])
            ->exists();

        if ($existingRoute) {
            return back()->withErrors(['name' => 'A similar route already exists.']);
        }

        $route = Route::create([
            'name' => $validated['name'],
            'origin_id' => $validated['origin_id'],
            'destination_id' => $validated['destination_id'],
            'sender_id' => auth()->user()->airline->id,
            'receiver_id' => $validated['receiver_id'],
            'expires_at' => $validated['expires_at'],
            'status' => RouteStatusEnum::PENDING->value,
        ]);

        // Optionally send notification to receiver here

        return redirect()->route('routes.show', $route->id)
            ->with('success', 'Route request created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Route $route)
    {
        // Authorization - user must be either sender or receiver
        if (!Gate::allows('view-route', $route)) {
            abort(403);
        }

        $route->load(['origin', 'destination', 'sender', 'receiver', 'flights.airplane.airplane']);

        return view('routes.show', compact('route'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Route $route)
    {
        // Authorization - only sender can edit pending routes
        if (!Gate::allows('update-route', $route)) {
            abort(403);
        }

        $airports = Airport::active()->get();
        $airlines = Airline::where('id', '!=', auth()->user()->airline->id)->get();

        return view('routes.edit', compact('route', 'airports', 'airlines'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Route $route)
    {
        // Authorization - only sender can edit pending routes
        if (!Gate::allows('update-route', $route)) {
            abort(403);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:routes,name,' . $route->id,
            'origin_id' => 'required|exists:airports,id',
            'destination_id' => 'required|exists:airports,id|different:origin_id',
            'receiver_id' => 'required|exists:airlines,id',
            'expires_at' => 'nullable|date',
            'status' => 'sometimes|in:' . implode(',', array_column(RouteStatusEnum::cases(), 'value')),
        ]);

        // Prevent creating a route to yourself
        if ($validated['receiver_id'] == auth()->user()->airline->id) {
            return back()->withErrors(['receiver_id' => 'You cannot create a route to your own airline.']);
        }

        // Only allow status change if user is admin
        if (!auth()->user()->isAdmin() && isset($validated['status'])) {
            unset($validated['status']);
        }

        $route->update($validated);

        return redirect()->route('routes.show', $route->id)
            ->with('success', 'Route updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Route $route)
    {
        // Authorization - only sender can delete pending routes
        if (!Gate::allows('delete-route', $route)) {
            abort(403);
        }

        $route->delete();

        return redirect()->route('routes.index')
            ->with('success', 'Route deleted successfully!');
    }

    /**
     * Approve a route request
     */
    public function approve(Route $route)
    {
        // Authorization - only receiver can approve
        if ($route->receiver_id != auth()->user()->airline->id) {
            abort(403);
        }

        // Only pending routes can be approved
        if ($route->status != RouteStatusEnum::PENDING->value) {
            return back()->with('error', 'Only pending routes can be approved.');
        }

        $route->update([
            'status' => RouteStatusEnum::APPROVED->value,
        ]);

        // Optionally send notification to sender here

        return back()->with('success', 'Route approved successfully!');
    }

    /**
     * Reject a route request
     */
    public function reject(Route $route)
    {
        // Authorization - only receiver can reject
        if ($route->receiver_id != auth()->user()->airline->id) {
            abort(403);
        }

        // Only pending routes can be rejected
        if ($route->status != RouteStatusEnum::PENDING->value) {
            return back()->with('error', 'Only pending routes can be rejected.');
        }

        $route->update([
            'status' => RouteStatusEnum::REJECTED->value,
        ]);

        // Optionally send notification to sender here

        return back()->with('success', 'Route rejected.');
    }
}