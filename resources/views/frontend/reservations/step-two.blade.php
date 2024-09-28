@extends('layouts.frontend.app')

@section('content')
    <div class="container w-full px-5 py-6 mx-auto">
        <div class="flex items-center min-h-screen bg-gray-50">
            <div class="flex-1 h-full max-w-4xl mx-auto bg-white rounded-lg shadow-xl">
                <div class="flex flex-col md:flex-row">
                    <div class="h-32 md:h-auto md:w-1/2">
                        <img class="object-cover w-full h-full" src="https://cdn.pixabay.com/photo/2021/01/15/17/01/green-5919790_960_720.jpg" alt="">
                    </div>
                    <div class="flex items-center justify-center p-6 sm:p-12 md:w-1/2">
                        <div class="w-full">
                            <h3 class="mb-4 text-xl font-bold text-blue-600">Make reservation</h3>

                            <div class="w-full bg-gray-200 rounded-full">
                                <div class="w-100 p-1 text-xs font-medium leading-none text-center text-blue-100 bg-blue-600 rounded-lg">
                                    step 2
                                </div>
                            </div>

                            <form method="POST" action="{{ route('reservations.store.step.two') }}">
                                @csrf
                                <div class="sm:col-span-6">
                                    <label for="table_id" class="block text-sm font-medium text-gray-700"> Table </label>
                                    <div class="mt-1">
                                        <select id="table_id" name="table_id" class="form-multiselect block w-full mt-1 @error('table_id') border-red-400 @enderror">
                                            @foreach($tables as $table)
                                                <option value="{{ $table->id }}" @selected($table->id === $reservation->table_id)>{{ $table->name . " ($table->guest_number Guests)" }}</option>
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
                                <div class="mt-6 flex justify-between">
                                    <a href="{{ route('reservations.step.one') }}" class="px-4 py-2 bg-indigo-500 hover:bg-indigo-700 rounded-lg text-white">Back</a>
                                    <button type="submit" class="px-4 py-2 bg-indigo-500 hover:bg-indigo-700 rounded-lg text-white">Make reservation</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
