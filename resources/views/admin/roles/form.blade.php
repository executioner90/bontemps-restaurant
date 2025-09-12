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
                id="role"
                class="block w-full transition duration-150 ease-in-out appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal sm:text-sm sm:leading-5"
                type="text"
                name="role"
                label="{{ __('Role') }}"
                value="{{ $role->role ?? '' }}"
                custom-label
            />
        </div>

        <div class="sm:col-span-6 mb-3">
            <x-admin.form.input
                id="abbreviation"
                class="block w-full transition duration-150 ease-in-out appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal sm:text-sm sm:leading-5"
                type="text"
                name="abbreviation"
                label="{{ __('Abbreviation') }}"
                value="{{ $role->abbreviation ?? '' }}"
                custom-label
            />
        </div>
    </x-admin.form>
@endsection
