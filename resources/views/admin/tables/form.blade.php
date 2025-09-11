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
            <x-admin.form.input
                id="number"
                class="block w-full transition duration-150 ease-in-out appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal sm:text-sm sm:leading-5"
                type="number"
                name="number"
                label="{{ __('Number') }}"
                value="{{ $table->number ?? '' }}"
                custom-label
            />
        </div>

        <div class="sm:col-span-6 mb-3">
            <x-admin.form.input
                id="capacity"
                class="block w-full transition duration-150 ease-in-out appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal sm:text-sm sm:leading-5"
                type="number"
                name="capacity"
                label="{{ __('Capacity') }}"
                value="{{ $table->capacity ?? '' }}"
                custom-label
            />
        </div>
    </x-admin.form>>
@endsection
