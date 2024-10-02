<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Airplanes') }}
        </h2>
    </x-slot>

    <div class="bg-white py-5 sm:py-5">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="mx-auto max-w-2xl lg:mx-0">
                <h1 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl py-3">Events</h1>
            </div>
            <div
                class="mx-auto mt-10 grid max-w-2xl grid-cols-1 gap-x-8 gap-y-16 border-t border-gray-200 pt-10 sm:mt-16 sm:pt-16 lg:mx-0 lg:max-w-none">
                <article class="overflow-hidden rounded-lg shadow transition hover:shadow-lg">
                    <div class="bg-white p-4 sm:p-6">
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y-2 divide-gray-200 bg-white text-sm">
                                <thead class="ltr:text-left rtl:text-right">
                                <tr>
                                    <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Airline</th>
                                    <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Type</th>
                                    <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Passengers</th>
                                    <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Cargo</th>
                                    <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Airport</th>
                                    <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Airplane</th>
                                    <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Flight</th>
                                    <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Crashed</th>
                                    <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Missed</th>
                                    <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Flight</th>
                                    <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Description</th>
                                    <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Created_at</th>
                                </tr>
                                </thead>

                                <tbody class="divide-y divide-gray-200">
                                @foreach($events as $event)
                                    <tr>
                                        <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">{{ $event->airline->name }}</td>
                                        <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">{{ $event->type }}</td>
                                        <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">{{ $event->passengers ?? '-' }} Person</td>
                                        <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">{{ $event->cargo ?? '-' }} Ton's</td>
                                        <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">{{ $event->airport->name ?? '-' }}</td>
                                        <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ $event->airlineAirplane->callsign ?? '-' }}</td>
                                        <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ $event->flight->origin->name ?? '-' }} -> {{$event->flight->destination->name ?? '-'}}</td>
                                        <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">{{ $event->is_crashed }}</td>
                                        <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">{{ $event->is_missed  }}</td>
                                        <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ $event->description }}</td>
                                        <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ $event->created_at }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
        </div>
    </div>
</x-app-layout>
