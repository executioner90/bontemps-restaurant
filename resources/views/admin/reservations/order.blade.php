@extends('layouts.admin.app')

@section('content')
    <x-admin.form
        title="{{ $title }}"
        method="{{ $method }}"
        action="{{ $action }}"
        back-route="{{ $backRoute }}"
        submit-button="{{ $submitButton }}"
    >
        <div class="sm:col-span-6 mb-3">
            <label for="meals" class="block text-sm font-medium text-gray-700">Choose meals</label>
            <div class="mt-1">
                <select
                    name="meals[]"
                    id="meals"
                    multiple
                    class="block w-full transition duration-150 ease-in-out appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal sm:text-sm sm:leading-5 @error('meals') border-red-400 @enderror"
                >
                    <option value="0">Select meals</option>
                    @foreach($meals as $meal)
                        <option value="{{ $meal->id }}" @if(in_array($meal->id, $reservation->meals()->pluck('id')->toArray())) selected @endif>
                            {{ $meal->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            @error('meals')
                <small class="text-xs text-red-400">{{ $message }}</small>
            @enderror
        </div>

        <div class="sm:col-span-6 mb-3">
            <label for="note" class="block text-sm font-medium text-gray-700"> Note </label>
            <div class="mt-1">
                <textarea id="note" name="note"
                          class="block w-full transition duration-150 ease-in-out appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal sm:text-sm sm:leading-5 @error('note') border-red-400 @enderror">{{ old('note') ?? $reservation->note ?? '' }}</textarea>
            </div>
        </div>
        @error('note')
            <small class="text-xs text-red-400">{{ $message }}</small>
        @enderror
    </x-admin.form>
@endsection
