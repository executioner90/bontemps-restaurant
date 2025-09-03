@extends('layouts.admin.app')

@section('content')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            {{-- back to index page --}}
            <div class="flex justify-start mb-2">
                <h1 class="font-semibold">Create reservation</h1>
            </div>

            {{-- form --}}
            <div class="bg-slate-100 rounded">
                <div class="w-10/12 py-9 mx-auto">
                    <form method="POST" action="{{ route('admin.reservation.store') }}">
                        @csrf

                        <div class="sm:col-span-6 mb-3">
                            <label for="first_name" class="block text-sm font-medium text-gray-700"> First name </label>
                            <div class="mt-1">
                                <input type="text" value="{{ old('first_name') }}" id="first_name" name="first_name" class="block w-full transition duration-150 ease-in-out appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal sm:text-sm sm:leading-5 @error('first_name') border-red-400 @enderror" />
                            </div>
                        </div>
                        @error('first_name')
                        <div class="text-sm text-red-400">{{ $message }}</div>
                        @enderror

                        <div class="sm:col-span-6 mb-3">
                            <label for="last_name" class="block text-sm font-medium text-gray-700"> Last name </label>
                            <div class="mt-1">
                                <input type="text" value="{{ old('last_name') }}" id="last_name" name="last_name" class="block w-full transition duration-150 ease-in-out appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal sm:text-sm sm:leading-5 @error('last_name') border-red-400 @enderror" />
                            </div>
                        </div>
                        @error('last_name')
                        <div class="text-sm text-red-400">{{ $message }}</div>
                        @enderror

                        <div class="sm:col-span-6 mb-3">
                            <label for="email" class="block text-sm font-medium text-gray-700"> Email </label>
                            <div class="mt-1">
                                <input type="text" value="{{ old('email') }}" id="email" name="email" class="block w-full transition duration-150 ease-in-out appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal sm:text-sm sm:leading-5 @error('email') border-red-400 @enderror" />
                            </div>
                        </div>
                        @error('email')
                        <div class="text-sm text-red-400">{{ $message }}</div>
                        @enderror

                        <div class="sm:col-span-6 mb-3">
                            <label for="mobile_number" class="block text-sm font-medium text-gray-700"> Phone number </label>
                            <div class="mt-1">
                                <input type="text" value="{{ old('mobile_number') }}" id="mobile_number" name="mobile_number" class="block w-full transition duration-150 ease-in-out appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal sm:text-sm sm:leading-5 @error('mobile_number') border-red-400 @enderror" />
                            </div>
                        </div>
                        @error('mobile_number')
                        <div class="text-sm text-red-400">{{ $message }}</div>
                        @enderror

                        <div class="sm:col-span-6 mb-3">
                            <label for="total_guests" class="block text-sm font-medium text-gray-700"> Total guests </label>
                            <div class="mt-1">
                                <input type="number" value="{{ old('total_guests') }}" id="total_guests" name="total_guests" class="block w-full transition duration-150 ease-in-out appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal sm:text-sm sm:leading-5 @error('total_guests') border-red-400 @enderror" />
                            </div>
                        </div>
                        @error('total_guests')
                        <div class="text-sm text-red-400">{{ $message }}</div>
                        @enderror

                        <div class="sm:col-span-6 mb-3">
                            <label for="date" class="block text-sm font-medium text-gray-700"> Date </label>
                            <div class="mt-1">
                                <input type="date" value="{{ old('date') }}" id="date" name="date" class="block w-full transition duration-150 ease-in-out appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal sm:text-sm sm:leading-5 @error('reservation_date') border-red-400 @enderror" />
                            </div>
                        </div>
                        @error('date')
                        <div class="text-sm text-red-400">{{ $message }}</div>
                        @enderror

                        <div class="sm:col-span-6 mb-3">
                            <label for="time_slot" class="block text-sm font-medium text-gray-700"> Choose a suitable time </label>
                            <div class="mt-1">
                                <select
                                    name="time_slot[]"
                                    id="time_slot"
                                    disabled
                                    multiple
                                    class="block w-full transition duration-150 ease-in-out appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal sm:text-sm sm:leading-5 @error('time_slot') border-red-400 @enderror"
                                >
                                    <option selected value="0">Select time</option>
                                </select>
                            </div>
                            <small>Fill first total guests and date.</small>
                            <div>
                                <small id="availableTimeMessage" class="text-red-400"></small>
                            </div>
                        </div>
                        @error('time_slot')
                        <div class="text-sm text-red-400">{{ $message }}</div>
                        @enderror

                        <div class="sm:col-span-6 mb-3">
                            <label for="note" class="block text-sm font-medium text-gray-700"> Note </label>
                            <div class="mt-1">
                                <textarea id="note" name="note" class="block w-full transition duration-150 ease-in-out appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal sm:text-sm sm:leading-5 @error('note') border-red-400 @enderror">{{ old('note') }}</textarea>
                            </div>
                        </div>
                        @error('note')
                        <div class="text-sm text-red-400">{{ $message }}</div>
                        @enderror

                        <div class="flex justify-between">
                            <a class="text-gray-500 py-2 hover:text-gray-700 underline" href="{{ route('admin.reservation.index') }}">
                                Back
                            </a>

                            <button type="submit" class="px-4 py-2 bg-gray-500 hover:bg-gray-700 rounded-lg text-white">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@vite('resources/js/admin/reservation/availableTimes.js')
