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
                value="{{ $meal->name ?? '' }}"
                custom-label
            />
        </div>

        <div class="sm:col-span-6 mb-3">
            <x-admin.form.input
                id="price"
                class="block w-full transition duration-150 ease-in-out appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal sm:text-sm sm:leading-5"
                type="text"
                name="price"
                label="{{ __('Price') }}"
                value="{{ $meal->price ?? '' }}"
                custom-label
            />
        </div>

        <div class="sm:col-span-6 mb-3">
            <label for="menu" class="block text-sm font-medium text-gray-700">Menu</label>
            <div class="mt-1">
                <select
                    name="menu"
                    id="menu"
                    class="block w-full transition duration-150 ease-in-out appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal sm:text-sm sm:leading-5 @error('time_slot') border-red-400 @enderror"
                >
                    <option selected value="0">Select menu</option>
                    @foreach($menus as $menu)
                        <option value="{{ $menu->id }}" @if(isset($meal) && $meal->menu_id === $menu->id) selected @endif>
                            {{ $menu->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            @error('menu')
                <small class="text-xs text-red-400">{{ $message }}</small>
            @enderror
        </div>

        <div class="sm:col-span-6 mb-3">
            <label for="products" class="block text-sm font-medium text-gray-700">Products</label>
            <div class="mt-1">
                <select
                    id="products"
                    name="products[]"
                    class="block w-full transition duration-150 ease-in-out appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal sm:text-sm sm:leading-5 @error('products') border-red-400 @enderror"
                    multiple
                >
                    @foreach($products as $product)
                        <option value="{{ $product->id }}" @if(isset($meal) && in_array($product->id, $meal->products()->pluck('id')->toArray())) selected @endif>
                            {{ $product->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            @error('products')
            <div class="text-sm text-red-400">{{ $message }}</div>
            @enderror
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

            @if(isset($meal) && $meal->image)
                <div class="mt-2">
                    <img
                        src="{{ $meal->image }}"
                        alt="{{ $meal->name }}"
                        class="w-64 h-64 object-cover rounded-md border border-gray-300"
                    />
                </div>
            @endif
        </div>

        <div class="sm:col-span-6 mb-3">
            <label for="description" class="block text-sm font-medium text-gray-700"> Description </label>
            <div class="mt-1">
                <textarea id="description" name="description"
                          class="block w-full transition duration-150 ease-in-out appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal sm:text-sm sm:leading-5 @error('description') border-red-400 @enderror">{{ old('description') ?? $meal->description ?? '' }}</textarea>
            </div>

            @error('description')
            <small class="text-xs text-red-400">{{ $message }}</small>
            @enderror
        </div>
    </x-admin.form>
@endsection
