<x-app-layout>

<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        {{ __('Airplanes') }}
    </h2>
</x-slot>
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-8">Edit Route</h1>

        <div class="bg-white shadow-md rounded-lg p-6">
            <form action="{{ route('routes.update', $route->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Route Name -->
                    <div class="col-span-1">
                        <label for="name" class="block text-sm font-medium text-gray-700">Route Name</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $route->name) }}" required
                               class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <!-- Origin Airport -->
                    <div class="col-span-1">
                        <label for="origin_id" class="block text-sm font-medium text-gray-700">Origin Airport</label>
                        <select name="origin_id" id="origin_id" required
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            @foreach($airports as $airport)
                                <option value="{{ $airport->id }}" {{ $route->origin_id == $airport->id ? 'selected' : '' }}>
                                    {{ $airport->name }} ({{ $airport->icao }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Destination Airport -->
                    <div class="col-span-1">
                        <label for="destination_id" class="block text-sm font-medium text-gray-700">Destination Airport</label>
                        <select name="destination_id" id="destination_id" required
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            @foreach($airports as $airport)
                                <option value="{{ $airport->id }}" {{ $route->destination_id == $airport->id ? 'selected' : '' }}>
                                    {{ $airport->name }} ({{ $airport->icao }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Receiver Airline -->
                    <div class="col-span-1">
                        <label for="receiver_id" class="block text-sm font-medium text-gray-700">Receiver Airline</label>
                        <select name="receiver_id" id="receiver_id" required
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            @foreach($airlines as $airline)
                                <option value="{{ $airline->id }}" {{ $route->receiver_id == $airline->id ? 'selected' : '' }}>
                                    {{ $airline->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Expiration Date -->
                    <div class="col-span-1">
                        <label for="expires_at" class="block text-sm font-medium text-gray-700">Expiration Date</label>
                        <input type="datetime-local" name="expires_at" id="expires_at"
                               value="{{ old('expires_at', $route->expires_at ? $route->expires_at->format('Y-m-d\TH:i') : '') }}"
                               class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <!-- Status -->
                    @if(auth()->user()->isAdmin())
                        <div class="col-span-1">
                            <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                            <select name="status" id="status"
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                @foreach(\App\Enums\RouteStatusEnum::cases() as $status)
                                    <option value="{{ $status->value }}" {{ $route->status === $status->value ? 'selected' : '' }}>
                                        {{ $status->value }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    @else
                        <input type="hidden" name="status" value="{{ $route->status }}">
                    @endif
                </div>

                <div class="mt-8 flex justify-end">
                    <a href="{{ route('routes.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded-md mr-3 transition">
                        Cancel
                    </a>
                    <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md transition">
                        Update Route
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>