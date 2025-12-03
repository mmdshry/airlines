<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create New Airplane') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('airplanes.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="space-y-6">
                            <!-- Name -->
                            <div>
                                <x-input-label for="name" :value="__('Name')" />
                                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name')" required autofocus />
                                <x-input-error class="mt-2" :messages="$errors->get('name')" />
                            </div>

                            <!-- Type -->
                            <div>
                                <x-input-label for="type" :value="__('Type')" />
                                <select id="type" name="type" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                    @foreach(\App\Enums\AirplaneTypesEnum::cases() as $type)
                                        <option value="{{ $type->value }}" {{ old('type') == $type->value ? 'selected' : '' }}>
                                            {{ $type->value }}
                                        </option>
                                    @endforeach
                                </select>
                                <x-input-error class="mt-2" :messages="$errors->get('type')" />
                            </div>

                            <!-- Capacity -->
                            <div>
                                <x-input-label for="capacity" :value="__('Capacity')" />
                                <x-text-input id="capacity" name="capacity" type="number" class="mt-1 block w-full" :value="old('capacity')" required />
                                <x-input-error class="mt-2" :messages="$errors->get('capacity')" />
                            </div>

                            <!-- Lifespan -->
                            <div>
                                <x-input-label for="lifespan" :value="__('Lifespan (years)')" />
                                <x-text-input id="lifespan" name="lifespan" type="number" class="mt-1 block w-full" :value="old('lifespan')" required />
                                <x-input-error class="mt-2" :messages="$errors->get('lifespan')" />
                            </div>

                            <!-- Image -->
                            <div>
                                <x-input-label for="image" :value="__('Image')" />
                                <input id="image" name="image" type="file" class="mt-1 block w-full" accept="image/*" />
                                <x-input-error class="mt-2" :messages="$errors->get('image')" />
                            </div>

                            <!-- Airlines -->
                            <div>
                                <x-input-label for="airlines" :value="__('Airlines')" />
                                <select id="airlines" name="airlines[]" multiple class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                    @foreach($airlines as $airline)
                                        <option value="{{ $airline->id }}" {{ (collect(old('airlines'))->contains($airline->id)) ? 'selected' : '' }}>
                                            {{ $airline->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <x-input-error class="mt-2" :messages="$errors->get('airlines')" />
                            </div>

                            <div class="flex items-center justify-end mt-4">
                                <x-secondary-button type="button" class="mr-3" onclick="window.history.back()">
                                    {{ __('Cancel') }}
                                </x-secondary-button>
                                <x-primary-button>
                                    {{ __('Create Airplane') }}
                                </x-primary-button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 