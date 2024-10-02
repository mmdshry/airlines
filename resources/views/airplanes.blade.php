<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Airplanes') }}
        </h2>
    </x-slot>

    <div class="bg-white py-5 sm:py-5">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="mx-auto mt-10 grid max-w-2xl grid-cols-1 gap-x-8 gap-y-16 border-t border-gray-200 pt-10 sm:mt-16 sm:pt-16 lg:mx-0 lg:max-w-none lg:grid-cols-3">
                @foreach($airplanes as $airplane)
                    <a href="#" class="block rounded-lg p-4 shadow-sm shadow-indigo-100">
                        <img
                            alt=""
                            src="{{ $airplane->image }}"
                            class="w-fit h-fit rounded-md object-cover"
                        />

                        <div class="mt-2">
                            <dl>
                                <div>
                                    <dt class="sr-only">Price</dt>

                                    <dd class="text-sm text-gray-500">$240,000</dd>
                                </div>

                                <div>
                                    <dt class="sr-only">Name</dt>

                                    <dd class="font-medium">{{ $airplane->name }}</dd>
                                </div>
                            </dl>

                            <div class="mt-6 flex items-center gap-8 text-xs">
                                <div class="sm:inline-flex sm:shrink-0 sm:items-center sm:gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.27 20.875L5.999 12Zm0 0h7.5" />
                                    </svg>


                                    <div class="mt-1.5 sm:mt-0">
                                        <p class="text-gray-500">Type</p>

                                        <p class="font-medium">
                                            @switch($airplane->type)
                                                @case(\App\Enums\AirplaneTypesEnum::COMMERCIAL->value)
                                                    <span class="inline-flex items-center justify-center rounded-full bg-emerald-500 px-2.5 py-0.5 text-emerald-50">
                                                        {{ $airplane->type }}
                                                    </span>
                                                @break
                                                @case(\App\Enums\AirplaneTypesEnum::PRIVATE->value)
                                                    <span class="inline-flex items-center justify-center rounded-full bg-yellow-500 px-2.5 py-0.5 text-yellow-50">
                                                        {{ $airplane->type }}
                                                    </span>
                                                @break
                                                @case(\App\Enums\AirplaneTypesEnum::CARGO->value)
                                                    <span class="inline-flex items-center justify-center rounded-full bg-purple-500 px-2.5 py-0.5 text-purple-50">
                                                        {{ $airplane->type }}
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

                                        <p class="font-medium">{{ $airplane->capacity }}</p>
                                    </div>
                                </div>

                                <div class="sm:inline-flex sm:shrink-0 sm:items-center sm:gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                                    </svg>


                                    <div class="mt-1.5 sm:mt-0">
                                        <p class="text-gray-500">Lifespan</p>

                                        <p class="font-medium">{{ $airplane->lifespan }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
