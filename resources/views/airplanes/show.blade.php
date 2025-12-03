<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ $airplane->name }}
            </h2>
            <div class="flex space-x-4">
                <a href="{{ route('airplanes.edit', $airplane) }}" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                    Edit
                </a>
                <form action="{{ route('airplanes.destroy', $airplane) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150" onclick="return confirm('Are you sure you want to delete this airplane?')">
                        Delete
                    </button>
                </form>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <img src="{{ $airplane->image }}" alt="{{ $airplane->name }}" class="w-full h-auto rounded-lg shadow-lg">
                        </div>
                        <div class="space-y-6">
                            <div>
                                <h3 class="text-lg font-semibold">Details</h3>
                                <div class="mt-4 space-y-4">
                                    <div class="flex justify-between">
                                        <span class="text-gray-600 dark:text-gray-400">Type:</span>
                                        <span class="font-medium">
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
                                        </span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-600 dark:text-gray-400">Capacity:</span>
                                        <span class="font-medium">{{ $airplane->capacity }} passengers</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-600 dark:text-gray-400">Lifespan:</span>
                                        <span class="font-medium">{{ $airplane->lifespan }} years</span>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <h3 class="text-lg font-semibold">Airlines</h3>
                                <div class="mt-4">
                                    @forelse($airplane->airlines as $airline)
                                        <div class="flex items-center space-x-2 mb-2">
                                            <span class="inline-flex items-center justify-center rounded-full bg-blue-500 px-2.5 py-0.5 text-blue-50">
                                                {{ $airline->name }}
                                            </span>
                                        </div>
                                    @empty
                                        <p class="text-gray-500">No airlines assigned</p>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 