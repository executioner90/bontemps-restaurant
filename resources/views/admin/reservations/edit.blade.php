<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h1>Update reservation</h1>
            {{-- back to index page --}}
            <div class="flex justify-end mb-2">
                <a class="p-3 bg-gray-500 hover:bg-gray-700 rounded-lg text-white" href="{{ route('admin.reservations.index') }}">
                    Back
                </a>
            </div>
            {{-- form --}}
            <div class="mb-20 bg-slate-100 rounded">
                <div class="space-y-8 divide-y divide-gray-200 w-1/2 mt-10 p-2">
                    <form method="POST" action="{{ route('admin.reservations.update', $reservation->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="sm:col-span-6">
                            <label for="first_name" class="block text-sm font-medium text-gray-700"> First name </label>
                            <div class="mt-1">
                                <input type="text" id="first_name" name="first_name" value="{{ $reservation->first_name }}"
                                       class="block w-full transition duration-150 ease-in-out appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('first_name') border-red-400 @enderror" />
                            </div>
                        </div>
                        @error('first_name')
                        <div class="text-sm text-red-400">{{ $message }}</div>
                        @enderror
                        <div class="sm:col-span-6">
                            <label for="last_name" class="block text-sm font-medium text-gray-700"> Last name </label>
                            <div class="mt-1">
                                <input type="text" id="last_name" name="last_name" value="{{ $reservation->last_name }}"
                                       class="block w-full transition duration-150 ease-in-out appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('last_name') border-red-400 @enderror" />
                            </div>
                        </div>
                        @error('last_name')
                        <div class="text-sm text-red-400">{{ $message }}</div>
                        @enderror
                        <div class="sm:col-span-6">
                            <label for="mobile_number" class="block text-sm font-medium text-gray-700"> Phone number </label>
                            <div class="mt-1">
                                <input type="text" id="mobile_number" name="mobile_number" value="{{ $reservation->mobile_number }}"
                                       class="block w-full transition duration-150 ease-in-out appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('mobile_number') border-red-400 @enderror" />
                            </div>
                        </div>
                        @error('mobile_number')
                        <div class="text-sm text-red-400">{{ $message }}</div>
                        @enderror
                        <div class="sm:col-span-6">
                            <label for="reservation_date" class="block text-sm font-medium text-gray-700"> Date </label>
                            <div class="mt-1">
                                <input type="datetime-local" id="reservation_date" name="reservation_date" value="{{ $reservation->reservation_date }}"
                                       class="block w-full transition duration-150 ease-in-out appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('reservation_date') border-red-400 @enderror" />
                            </div>
                        </div>
                        @error('reservation_date')
                        <div class="text-sm text-red-400">{{ $message }}</div>
                        @enderror
                        <div class="sm:col-span-6">
                            <label for="guest_number" class="block text-sm font-medium text-gray-700"> Guest number </label>
                            <div class="mt-1">
                                <input type="number" id="guest_number" name="guest_number" value="{{ $reservation->guest_number }}"
                                       class="block w-full transition duration-150 ease-in-out appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('guest_number') border-red-400 @enderror" />
                            </div>
                        </div>
                        @error('guest_number')
                        <div class="text-sm text-red-400">{{ $message }}</div>
                        @enderror
                        <div class="sm:col-span-6">
                            <label for="table_id" class="block text-sm font-medium text-gray-700"> Table </label>
                            <div class="mt-1">
                                <select id="table_id" name="table_id" class="form-multiselect block w-full mt-1 @error('table_id') border-red-400 @enderror">
                                    @foreach($tables as $table)
                                        <option value="{{ $table->id }}" @selected($table->id === $reservation->table_id)>{{ $table->name . " ($table->guest_number Guest's')" }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        @error('table_id')
                        <div class="text-sm text-red-400">{{ $message }}</div>
                        @enderror
                        <div class="sm:col-span-6">
                            <label for="meals" class="block text-sm font-medium text-gray-700"> Menus </label>
                            <div class="mt-1">
                                <select id="menus" name="menus[]" class="form-multiselect block w-full mt-1 @error('menus') border-red-400 @enderror" multiple>
                                    @foreach($menus as $menu)
                                        <option value="{{ $menu->id }}" @selected($reservation->menus->contains($menu))>{{ $menu->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        @error('menus')
                        <div class="text-sm text-red-400">{{ $message }}</div>
                        @enderror
                        <div class="mt-6">
                            <button type="submit" class="px-4 py-2 bg-gray-500 hover:bg-gray-700 rounded-lg text-white">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
