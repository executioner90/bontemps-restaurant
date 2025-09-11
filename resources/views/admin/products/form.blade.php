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
                id="name"
                class="block w-full transition duration-150 ease-in-out appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal sm:text-sm sm:leading-5"
                type="text"
                name="name"
                label="{{ __('Name') }}"
                value="{{ $product->name ?? '' }}"
                custom-label
            />
        </div>

        <div class="sm:col-span-6 mb-3">
            <x-admin.form.input
                id="stock"
                class="block w-full transition duration-150 ease-in-out appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal sm:text-sm sm:leading-5"
                type="text"
                name="stock"
                label="{{ __('Stock') }}"
                value="{{ $product->stock ?? '' }}"
                custom-label
            />
        </div>

        <div class="sm:col-span-6 mb-3">
            <x-admin.form.input
                id="unit"
                class="block w-full transition duration-150 ease-in-out appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal sm:text-sm sm:leading-5"
                type="text"
                name="unit"
                label="{{ __('Unit') }}"
                value="{{ $product->unit ?? '' }}"
                custom-label
            />
        </div>

        <div class="sm:col-span-6 mb-3">
            <x-admin.form.input
                id="min_available"
                class="block w-full transition duration-150 ease-in-out appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal sm:text-sm sm:leading-5"
                type="text"
                name="min_available"
                label="{{ __('Minimum') }}"
                value="{{ $product->min_available ?? '' }}"
                custom-label
            />
        </div>
    </x-admin.form>
@endsection
