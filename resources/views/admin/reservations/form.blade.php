@extends('layouts.admin.app')

@section('content')
    <div class="py-12">
        <x-admin.form
            title="{{ $title }}"
            method="{{ $method }}"
            action="{{ $action }}"
            back-route="{{ $backRoute }}"
            submit-button="{{ $submitButton }}"
        >
            <div class="sm:col-span-6 mb-3">
                <x-admin.form.input
                    id="first_name"
                    class="block w-full transition duration-150 ease-in-out appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal sm:text-sm sm:leading-5"
                    type="text"
                    name="first_name"
                    label="{{ __('First name') }}"
                    value="{{ $reservation->first_name ?? '' }}"
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
                    value="{{ $reservation->last_name ?? '' }}"
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
                    value="{{ $reservation->email ?? '' }}"
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
                    value="{{ $reservation->mobile_number ?? '' }}"
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
                    value="{{ $reservation->total_guests ?? '' }}"
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
                    value="{{ $reservation->date ?? '' }}"
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
                    <textarea id="note" name="note" class="block w-full transition duration-150 ease-in-out appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal sm:text-sm sm:leading-5 @error('note') border-red-400 @enderror">{{ old('note') ?? $reservation->note ?? '' }}</textarea>
                </div>
            </div>
            @error('note')
            <small class="text-xs text-red-400">{{ $message }}</small>
            @enderror
        </x-admin.form>
    </div>
@endsection

@vite('resources/js/admin/reservation/availableTimes.js')
