<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Seeking Passengers by Route') }}
        </h2>
    </x-slot>

    <div class="bg-white py-6 dark:bg-gray-900">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <section class="container px-4 mx-auto">
                <div class="flex flex-col mt-6 space-y-6">
                    @php
                        $sortedGroups = collect($groupedPassengers)->sortByDesc(fn($group) => $group['ticket'] * $group['count']);
                    @endphp

                    @foreach ($sortedGroups->groupBy('origin') as $origin => $groups)
                        <div x-data="{ open: false, showBulkModal: false, selectedDestinations: [] }" class="border border-gray-200 dark:border-gray-700 rounded-md">
                            <button @click="open = !open" class="w-full px-4 py-3 text-left font-medium bg-gray-100 dark:bg-gray-800 dark:text-white rounded-t-md">
                                {{ $origin }} ({{ $groups->sum('count') }} Passengers)
                            </button>

                            <div x-show="open" class="p-4 bg-white dark:bg-gray-900">
                                <form @submit.prevent="showBulkModal = true">
                                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                        <thead class="bg-gray-50 dark:bg-gray-800">
                                        <tr>
                                            <th></th>
                                            <th class="px-4 py-3.5 text-sm text-left text-gray-500 dark:text-gray-400">Destination</th>
                                            <th class="px-4 py-3.5 text-sm text-left text-gray-500 dark:text-gray-400">Passengers</th>
                                            <th class="px-4 py-3.5 text-sm text-left text-gray-500 dark:text-gray-400">Ticket Price</th>
                                            <th class="px-4 py-3.5 text-sm text-left text-gray-500 dark:text-gray-400">Total Value</th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody class="bg-white dark:bg-gray-900 divide-y dark:divide-gray-700">
                                        @foreach ($groups as $i => $group)
                                            <tr>
                                                <td class="px-4 py-4">
                                                    <input type="checkbox" :value="{{ json_encode($group) }}" @change="(e) => {
                                                            if (e.target.checked) {
                                                                selectedDestinations.push(@js($group));
                                                            } else {
                                                                selectedDestinations = selectedDestinations.filter(d => d.destination !== '{{ $group['destination'] }}');
                                                            }
                                                        }" />
                                                </td>
                                                <td class="px-4 py-4 text-sm font-medium text-gray-800 dark:text-white">
                                                    {{ $group['destination'] }}
                                                </td>
                                                <td class="px-4 py-4 text-sm text-emerald-500 bg-emerald-100/60 dark:bg-gray-800 rounded-full">
                                                    {{ $group['count'] }} Passengers
                                                </td>
                                                <td class="px-4 py-4 text-sm text-gray-800 dark:text-white">${{ $group['ticket'] }}</td>
                                                <td class="px-4 py-4 text-sm text-gray-800 dark:text-white">${{ $group['ticket'] * $group['count'] }}</td>
                                                <td class="px-4 py-4">
                                                    <button type="button" @click="selectedDestinations = [@js($group)]; showBulkModal = true" class="px-3 py-1 text-sm text-white bg-blue-600 rounded hover:bg-blue-700">
                                                        Reserve
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>

                                    <div class="mt-4">
                                        <button type="submit" :disabled="selectedDestinations.length === 0"
                                                class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 disabled:opacity-50">

                                        </button>
                                    </div>
                                </form>

                                <!-- Bulk Reservation Modal -->
                                <div x-show="showBulkModal" class="fixed inset-0 flex items-center justify-center bg-black/50 z-50">
                                    <div class="bg-white dark:bg-gray-800 p-6 rounded-md shadow-lg w-full max-w-md">
                                        <h2 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">Reserve Seats</h2>
                                        <form method="POST" >
                                            @csrf
                                            <input type="hidden" name="reservations" :value="JSON.stringify(selectedDestinations)">

                                            <label class="block text-sm text-gray-600 dark:text-gray-300">Select Flight</label>
                                            <select name="flight_id" class="mt-2 w-full px-4 py-2 border rounded-md dark:bg-gray-700 dark:text-white" required>
                                                @foreach(Auth::user()->flights as $flight)
                                                    <option value="{{ $flight->id }}">{{ $flight->name }}</option>
                                                @endforeach
                                            </select>

                                            <label class="block mt-4 text-sm text-gray-600 dark:text-gray-300">Passenger Count (Total: <span x-text="selectedDestinations.reduce((t, d) => t + d.count, 0)"></span>)</label>
                                            <input type="number" name="passenger_count" min="1"
                                                   :max="selectedDestinations.reduce((t, d) => t + d.count, 0)"
                                                   class="mt-2 w-full px-4 py-2 border rounded-md dark:bg-gray-700 dark:text-white" required>

                                            <div class="mt-4 flex justify-end">
                                                <button type="button" @click="showBulkModal = false"
                                                        class="px-4 py-2 text-gray-600 dark:text-gray-300">Cancel</button>
                                                <button type="submit"
                                                        class="ml-2 px-4 py-2 text-white bg-green-600 rounded-md hover:bg-green-700">Submit</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <!-- End Modal -->
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
        </div>
    </div>
</x-app-layout>
