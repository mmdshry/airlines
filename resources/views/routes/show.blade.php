<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Airplanes') }}
        </h2>
    </x-slot>
    <div class="container mx-auto px-4 py-8">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-gray-800">Route Details</h1>
            <div class="flex space-x-2">
                <a href="{{ route('routes.edit', $route->id) }}" class="bg-indigo-500 hover:bg-indigo-600 text-white px-4 py-2 rounded-md transition">
                    Edit
                </a>
                <form action="{{ route('routes.destroy', $route->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-md transition" onclick="return confirm('Are you sure?')">
                        Delete
                    </button>
                </form>
            </div>
        </div>

        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-xl font-semibold text-gray-800">{{ $route->name }}</h2>
                <div class="flex items-center mt-2">
                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                    {{ $route->status === \App\Enums\RouteStatusEnum::PENDING->value ? 'bg-yellow-100 text-yellow-800' : '' }}
                    {{ $route->status === \App\Enums\RouteStatusEnum::APPROVED->value ? 'bg-green-100 text-green-800' : '' }}
                    {{ $route->status === \App\Enums\RouteStatusEnum::REJECTED->value ? 'bg-red-100 text-red-800' : '' }}">
                    {{ $route->status }}
                </span>
                </div>
            </div>

            <div class="px-6 py-4 grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Route Information</h3>
                    <div class="space-y-2">
                        <p><span class="font-medium">Origin:</span> {{ $route->origin->name }} ({{ $route->origin->icao }})</p>
                        <p><span class="font-medium">Destination:</span> {{ $route->destination->name }} ({{ $route->destination->icao }})</p>
                        <p><span class="font-medium">Distance:</span> {{ number_format($route->origin->distanceTo($route->destination), 2) }} km</p>
                        <p><span class="font-medium">Estimated Flight Time:</span> {{ $route->estimatedFlightTime() }}</p>
                    </div>
                </div>

                <div>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Parties Involved</h3>
                    <div class="space-y-2">
                        <p><span class="font-medium">Sender:</span> {{ $route->sender->name }}</p>
                        <p><span class="font-medium">Receiver:</span> {{ $route->receiver->name }}</p>
                        <p><span class="font-medium">Created At:</span> {{ $route->created_at->format('M d, Y H:i') }}</p>
                        @if($route->expires_at)
                            <p><span class="font-medium">Expires At:</span> {{ $route->expires_at->format('M d, Y H:i') }}</p>
                        @endif
                    </div>
                </div>
            </div>

            @if(auth()->user()->airline->id === $route->receiver_id && $route->status === \App\Enums\RouteStatusEnum::PENDING->value)
                <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Route Request Actions</h3>
                    <div class="flex space-x-4">
                        <form action="{{ route('routes.approve', $route->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-md transition">
                                Approve Route
                            </button>
                        </form>
                        <form action="{{ route('routes.reject', $route->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-md transition">
                                Reject Route
                            </button>
                        </form>
                    </div>
                </div>
            @endif

            @if($route->flights->count() > 0)
                <div class="px-6 py-4 border-t border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Flights on This Route</h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Flight</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Airplane</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Departure</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Arrival</th>
                            </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($route->flights as $flight)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        <a href="{{ route('flights.show', $flight->id) }}" class="text-blue-600 hover:text-blue-900">{{ $flight->name }}</a>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $flight->airplane->callsign }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                    {{ $flight->status === \App\Enums\FlightStatusEnum::SCHEDULED->value ? 'bg-blue-100 text-blue-800' : '' }}
                                    {{ $flight->status === \App\Enums\FlightStatusEnum::IN_PROGRESS->value ? 'bg-yellow-100 text-yellow-800' : '' }}
                                    {{ $flight->status === \App\Enums\FlightStatusEnum::COMPLETED->value ? 'bg-green-100 text-green-800' : '' }}
                                    {{ $flight->status === \App\Enums\FlightStatusEnum::CANCELLED->value ? 'bg-red-100 text-red-800' : '' }}">
                                    {{ $flight->status }}
                                </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $flight->departed_at ? $flight->departed_at->format('M d, Y H:i') : 'N/A' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $flight->landed_at ? $flight->landed_at->format('M d, Y H:i') : 'N/A' }}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>