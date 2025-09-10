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
                value="{{ $menu->name ?? '' }}"
                custom-label
            />
        </div>

        <div class="sm:col-span-6 mb-3">
            <label for="special" class="block font-medium text-sm text-gray-700">Special</label>
            <input
                id="special"
                class="block transition duration-150 ease-in-out appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal sm:text-sm sm:leading-5"
                type="checkbox"
                name="special"
                @isset($menu)
                    @if($menu->special) checked @endif
                @endisset
            />
        </div>

        <div class="sm:col-span-6 mb-3">
            <x-admin.form.input
                id="image"
                class="block w-full transition duration-150 ease-in-out appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal sm:text-sm sm:leading-5"
                type="file"
                name="image"
                label="{{ __('Image') }}"
                custom-label
            />

            @if(isset($menu) && $menu->image)
                <div class="mt-2">
                    <img
                        src="{{ $menu->image }}"
                        alt="{{ $menu->name }}"
                        class="w-64 h-64 object-cover rounded-md border border-gray-300"
                    />
                </div>
            @endif
        </div>
    </x-admin.form>
@endsection
