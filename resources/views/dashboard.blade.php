@php($airline = auth()->user()->airline)
@php($user = auth()->user())
@php($airlineAirplanes = auth()->user()->airline->airlineAirplanes)
@php($airports = \App\Helper\DashboardHelper::airportsAround($airline))
@php($flights = \App\Models\Flight::with(['origin','destination','sender','receiver','airplane.airplane'])->get())
@php($activeAirports = \App\Models\Airport::active()->with('airline.user')->get())

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="bg-white py-5 sm:py-5">

        <div class="mx-auto max-w-7xl px-6 lg:px-8">

            <div class="mx-auto max-w-2xl lg:mx-0">
                <x-flight-map :flights="$flights" />
            </div>

            <div class="mx-auto max-w-2xl lg:mx-0">
                <x-airports-map :airports="$activeAirports" />
            </div>

            <div class="mx-auto max-w-2xl lg:mx-0">
                <h1 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl py-3">Airline</h1>
                <img
                    alt=""
                    src="{{ $airline->image }}"
                    class="h-auto w-auto max-w-full max-h-full object-contain sm:h-56 lg:h-64"
                />
                <p class="mt-2 text-lg leading-8 text-gray-600">{{$user->name}} you are the current CEO
                    of {{$airline->name}} airline.</p>
                <p class="mt-2 text-sm leading-6 text-gray-600">Wish you and your airline the best.</p>
            </div>

            <div class="bg-white py-24 sm:py-32">
                <div class="mx-auto max-w-7xl px-6 lg:px-8">
                    <dl class="grid grid-cols-1 gap-x-8 gap-y-16 text-center lg:grid-cols-4">
                        <div class="mx-auto flex max-w-xs flex-col gap-y-4">
                            <dt class="text-base leading-7 text-gray-600">Scoreboard</dt>
                            <dd class="order-first text-3xl font-semibold tracking-tight text-gray-900 sm:text-5xl">#1
                            </dd>
                        </div>
                        <div class="mx-auto flex max-w-xs flex-col gap-y-4">
                            <dt class="text-base leading-7 text-gray-600">Balance</dt>
                            <dd class="order-first text-3xl font-semibold tracking-tight text-gray-900 sm:text-5xl">${{ $user->balanceInt }}</dd>
                        </div>
                        <div class="mx-auto flex max-w-xs flex-col gap-y-4">
                            <dt class="text-base leading-7 text-gray-600">Passengers</dt>
                            <dd class="order-first text-3xl font-semibold tracking-tight text-gray-900 sm:text-5xl">{{ $airline->airlineAirport->passengers }} Person</dd>
                        </div>
                        <div class="mx-auto flex max-w-xs flex-col gap-y-4">
                            <dt class="text-base leading-7 text-gray-600">Cargo</dt>
                            <dd class="order-first text-3xl font-semibold tracking-tight text-gray-900 sm:text-5xl">{{ $airline->airlineAirport->cargo }} Tons</dd>
                        </div>
                    </dl>
                </div>
            </div>


            <div class="mx-auto max-w-2xl lg:mx-0">
                <h1 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl py-3">My Airplanes</h1>
            </div>
            <div class="mx-auto mt-10 grid max-w-2xl gap-x-8 gap-y-16 grid-cols-1 border-t border-gray-200 pt-10 sm:mt-16 sm:pt-16 lg:mx-0 lg:max-w-none lg:grid-cols-3">

                @foreach($airlineAirplanes as $airlineAirplane)
                    <a href="#" class="block rounded-lg p-4 shadow-sm shadow-indigo-100">
                        <img
                            alt=""
                            src="{{ $airlineAirplane->airplane->image }}"
                            class="w-fit h-fit rounded-md object-cover"
                        />

                        <div class="mt-3">
                            <dl>
                                <div>
                                    <dt class="sr-only">Price</dt>

                                    <dd class="text-sm text-gray-500">$240,000</dd>
                                </div>

                                <div>
                                    <dt class="sr-only">Name</dt>

                                    <dd class="font-medium">{{ $airlineAirplane->airplane->name }}</dd>
                                </div>
                            </dl>


                            <div class="mt-3 flex-auto gap-10 p-1 m-1 text-sm">
                                <div class="sm:inline-flex sm:shrink-0 sm:items-center sm:gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M7.864 4.243A7.5 7.5 0 0 1 19.5 10.5c0 2.92-.556 5.709-1.568 8.268M5.742 6.364A7.465 7.465 0 0 0 4.5 10.5a7.464 7.464 0 0 1-1.15 3.993m1.989 3.559A11.209 11.209 0 0 0 8.25 10.5a3.75 3.75 0 1 1 7.5 0c0 .527-.021 1.049-.064 1.565M12 10.5a14.94 14.94 0 0 1-3.6 9.75m6.633-4.596a18.666 18.666 0 0 1-2.485 5.33" />
                                    </svg>

                                    <div class="mt-1.5 sm:mt-0">
                                        <p class="text-gray-500">Callsign</p>

                                        <p class="font-medium">{{ $airlineAirplane->callsign }}</p>
                                    </div>
                                </div>

                                <div class="sm:inline-flex sm:shrink-0 sm:items-center sm:gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.27 20.875L5.999 12Zm0 0h7.5" />
                                    </svg>


                                    <div class="mt-1.5 sm:mt-0">
                                        <p class="text-gray-500">Type</p>

                                        <p class="font-medium">
                                            @switch($airlineAirplane->airplane->type)
                                                @case(\App\Enums\AirplaneTypesEnum::COMMERCIAL->value)
                                                    <span class="inline-flex items-center justify-center rounded-full bg-emerald-500 px-2.5 py-0.5 text-emerald-50">
                                                        {{ $airlineAirplane->airplane->type }}
                                                    </span>
                                                    @break
                                                @case(\App\Enums\AirplaneTypesEnum::PRIVATE->value)
                                                    <span class="inline-flex items-center justify-center rounded-full bg-yellow-500 px-2.5 py-0.5 text-yellow-50">
                                                        {{ $airlineAirplane->airplane->type }}
                                                    </span>
                                                    @break
                                                @case(\App\Enums\AirplaneTypesEnum::CARGO->value)
                                                    <span class="inline-flex items-center justify-center rounded-full bg-purple-500 px-2.5 py-0.5 text-purple-50">
                                                        {{ $airlineAirplane->airplane->type }}
                                                    </span>
                                                    @break
                                            @endswitch
                                        </p>
                                    </div>
                                </div>

                                <div class="sm:inline-flex sm:shrink-0 sm:items-center sm:gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                                    </svg>


                                    <div class="mt-1.5 sm:mt-0">
                                        <p class="text-gray-500">Capacity</p>

                                        <p class="font-medium">{{ $airlineAirplane->airplane->capacity }}</p>
                                    </div>
                                </div>

                                <div class="sm:inline-flex sm:shrink-0 sm:items-center sm:gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                                    </svg>


                                    <div class="mt-1.5 sm:mt-0">
                                        <p class="text-gray-500">Lifespan</p>

                                        <p class="font-medium">{{ $airlineAirplane->airplane->lifespan }}</p>
                                    </div>
                                </div>

                                <div class="sm:inline-flex sm:shrink-0 sm:items-center sm:gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                                    </svg>


                                    <div class="mt-1.5 sm:mt-0">
                                        <p class="text-gray-500">Current Airport</p>

                                        <p class="font-medium">{{ $airlineAirplane->airport->name }}</p>
                                    </div>
                                </div>

                                <div class="sm:inline-flex sm:shrink-0 sm:items-center sm:gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                    </svg>


                                    <div class="mt-1.5 sm:mt-0">
                                        <p class="text-gray-500">Traveled time</p>

                                        <p class="font-medium">{{ $airlineAirplane->getTotalTraveledTime() }}</p>
                                    </div>
                                </div>

                                <div class="sm:inline-flex sm:shrink-0 sm:items-center sm:gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                    </svg>


                                    <div class="mt-1.5 sm:mt-0">
                                        <p class="text-gray-500">Remained travel time</p>

                                        <p class="font-medium">{{ $airlineAirplane->getRemainedTraveledTime() }}</p>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </a>
                @endforeach
            </div>

            <div class="mx-auto max-w-2xl lg:mx-0">
                <h1 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl py-3">Airports</h1>
            </div>
            <div
                class="mx-auto mt-10 grid max-w-2xl grid-cols-1 gap-x-8 gap-y-16 border-t border-gray-200 pt-10 sm:mt-16 sm:pt-16 lg:mx-0 lg:max-w-none">
                <article class="overflow-hidden rounded-lg shadow transition hover:shadow-lg">
                    <div class="bg-white p-4 sm:p-6">
                        <a href="#">
                            <h1 class="mt-0.5 text-lg text-gray-900">Nearby Airports</h1>
                        </a>
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y-2 divide-gray-200 bg-white text-sm">
                                <thead class="ltr:text-left rtl:text-right">
                                <tr>
                                    <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Name</th>
                                    <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Owner</th>
                                    <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Distance</th>
                                    <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Time</th>
                                    <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Ticket</th>
                                    <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Contract</th>
                                    <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Permission</th>
                                </tr>
                                </thead>

                                <tbody class="divide-y divide-gray-200">
                                @foreach($airports as $airport)
                                    <tr>
                                        <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">{{ $airport['name'] }}</td>
                                        <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">{{ $airport['owner'] }}</td>
                                        <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ $airport['distance'] }}KM</td>
                                        <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ $airport['time'] }} Hours</td>
                                        <td class="whitespace-nowrap px-4 py-2 text-gray-700">${{ $airport['ticket'] }}</td>
                                        <td class="whitespace-nowrap px-4 py-2 text-gray-700">${{ $airport['contract'] }}</td>
                                        <td class="whitespace-nowrap px-4 py-2">
                                            <a
                                                href="#"
                                                class="inline-block rounded bg-indigo-600 px-4 py-2 text-xs font-medium text-white hover:bg-indigo-700"
                                            >
                                                View
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </article>
            </div>

            <div class="mx-auto max-w-2xl lg:mx-0">
                <h1 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl py-3">Flight</h1>
            </div>
            <div
                class="mx-auto mt-10 grid max-w-2xl grid-cols-1 gap-x-8 gap-y-16 border-t border-gray-200 pt-10 sm:mt-16 sm:pt-16 lg:mx-0 lg:max-w-none">
                <article class="overflow-hidden rounded-lg shadow transition hover:shadow-lg">
                    <div class="bg-white p-4 sm:p-6">
                        <a href="#">
                            <h1 class="mt-0.5 text-lg text-gray-900">Nearby Airports</h1>
                        </a>
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y-2 divide-gray-200 bg-white text-sm">
                                <thead class="ltr:text-left rtl:text-right">
                                <tr>
                                    <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Airline</th>
                                    <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Flight Number</th>
                                    <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Origin</th>
                                    <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Destination</th>
                                    <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Departure</th>
                                    <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Arrival</th>
                                    <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Status</th>
                                </tr>
                                </thead>

                                <tbody class="divide-y divide-gray-200">
                                @foreach($flights as $flight)
                                    <ul class="timeline">
                                        <li>
                                            <div class="timeline-start">{{$flight->departed_at}}</div>
                                            <div class="timeline-middle">
                                                <svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 20 20"
                                                    fill="currentColor"
                                                    class="h-5 w-5">
                                                    <path
                                                        fill-rule="evenodd"
                                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                            <div class="timeline-end timeline-box">{{ $flight->origin->name }}</div>
                                            <hr />
                                        </li>
                                        <li>
                                            <hr />
                                            <div class="timeline-start">{{$flight->landed_at}}</div>
                                            <div class="timeline-middle">
                                                <svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 20 20"
                                                    fill="currentColor"
                                                    class="h-5 w-5">
                                                    <path
                                                        fill-rule="evenodd"
                                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                            <div class="timeline-end timeline-box">{{ $flight->destination->name }}</div>
                                        </li>
                                    </ul>
                                    <tr>
                                        <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">{{ $flight->sender->name }}</td>
                                        <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">{{ $flight->airplane->callsign }}</td>
                                        <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">{{ $flight->origin->name}}</td>
                                        <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ $flight->destination->name }}
                                            KM
                                        </td>
                                        <td class="whitespace-nowrap px-4 py-2 text-gray-700">$</td>
                                        <td class="whitespace-nowrap px-4 py-2 text-gray-700">
                                            ${{ $flight['contract'] }}</td>
                                        <td class="whitespace-nowrap px-4 py-2">
                                            <a
                                                href="#"
                                                class="inline-block rounded bg-indigo-600 px-4 py-2 text-xs font-medium text-white hover:bg-indigo-700"
                                            >
                                                View
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </article>
            </div>

        </div>
    </div>
</x-app-layout>
