@extends('layouts.admin.app')

@section('content')
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
                            <x-admin.form.input
                                id="first_name"
                                class="block w-full transition duration-150 ease-in-out appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal sm:text-sm sm:leading-5"
                                type="text"
                                name="first_name"
                                label="{{ __('First name') }}"
                                custom-label
                            />
                        </div>

                        <div class="sm:col-span-6 mb-3">
                            <x-admin.form.input
                                id="last_name"
                                class="block w-full transition duration-150 ease-in-out appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal sm:text-sm sm:leading-5"
                                type="text"
                                name="last_name"
                                label="{{ __('Last name') }}"
                                custom-label
                            />
                        </div>

                        <div class="sm:col-span-6 mb-3">
                            <x-admin.form.input
                                id="email"
                                class="block w-full transition duration-150 ease-in-out appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal sm:text-sm sm:leading-5"
                                type="text"
                                name="email"
                                label="{{ __('Email') }}"
                                custom-label
                            />
                        </div>

                        <div class="sm:col-span-6 mb-3">
                            <x-admin.form.input
                                id="mobile_number"
                                class="block w-full transition duration-150 ease-in-out appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal sm:text-sm sm:leading-5"
                                type="text"
                                name="mobile_number"
                                label="{{ __('Phone number') }}"
                                custom-label
                            />
                        </div>

                        <div class="sm:col-span-6 mb-3">
                            <x-admin.form.input
                                id="total_guests"
                                class="block w-full transition duration-150 ease-in-out appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal sm:text-sm sm:leading-5"
                                type="number"
                                name="total_guests"
                                label="{{ __('Total guests') }}"
                                custom-label
                            />
                        </div>

                        <div class="sm:col-span-6 mb-3">
                            <x-admin.form.input
                                id="date"
                                class="block w-full transition duration-150 ease-in-out appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal sm:text-sm sm:leading-5"
                                type="date"
                                name="date"
                                label="{{ __('Date') }}"
                                custom-label
                            />
                        </div>

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
                            @error('time_slot')
                                <small class="text-xs text-red-400">{{ $message }}</small>
                            @enderror
                            <small id="availableTimeMessage" class="text-red-400"></small>
                        </div>

                        <div class="sm:col-span-6 mb-3">
                            <label for="note" class="block text-sm font-medium text-gray-700"> Note </label>
                            <div class="mt-1">
                                <textarea id="note" name="note" class="block w-full transition duration-150 ease-in-out appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal sm:text-sm sm:leading-5 @error('note') border-red-400 @enderror">{{ old('note') }}</textarea>
                            </div>
                        </div>
                        @error('note')
                            <small class="text-xs text-red-400">{{ $message }}</small>
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
