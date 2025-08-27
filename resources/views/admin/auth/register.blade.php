@extends('layouts.admin.guest')

@section('content')
    <div class="text-white text-4xl mb-4 font-semibold">
        Create user
    </div>

    <form method="POST" action="{{ route('admin.register.store') }}">
        @csrf

        <!-- Name -->
        <div>
            <div class="sm:col-span-6">
                <label for="name" class="block text-sm font-medium text-gray-400"> Name </label>
                <div class="mt-1">
                    <input type="text" id="name" name="name" autofocus
                           class="block w-full transition duration-150 ease-in-out appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('name') border-red-400 @enderror"/>
                </div>
            </div>
            <x-admin.form.input.error :messages="$errors->get('name')" class="mt-2"/>
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <div class="sm:col-span-6">
                <label for="email" class="block text-sm font-medium text-gray-500"> Email </label>
                <div class="mt-1">
                    <input type="email" id="email" name="email" autofocus
                           class="block w-full transition duration-150 ease-in-out appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('email') border-red-400 @enderror"/>
                </div>
            </div>
            <x-admin.form.input.error :messages="$errors->get('email')" class="mt-2"/>
        </div>

        <!-- Is admin -->
        <div class="mt-4">
            <div class="sm:col-span-6">
                <div class="grid grid-cols-2">
                    <div>
                        <label for="isAdmin" class="block text-sm font-medium text-gray-500"> Admin </label>
                    </div>
                    <div>
                        <input type="checkbox" id="isAdmin" name="isAdmin" autocomplete="is-admin"
                               class="block transition duration-150 ease-in-out appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5"/>
                    </div>
                </div>
            </div>
        </div>

        <!-- Password -->
        <div class="mt-4">
            <div class="sm:col-span-6">
                <label for="password" class="block text-sm font-medium text-gray-500"> Password </label>
                <div class="mt-1">
                    <input type="password" id="password" name="password" autocomplete="new-password"
                           class="block w-full transition duration-150 ease-in-out appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('password') border-red-400 @enderror"/>
                </div>
            </div>
            <x-admin.form.input.error :messages="$errors->get('password')" class="mt-2"/>
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <div class="sm:col-span-6">
                <label for="password_confirmation" class="block text-sm font-medium text-gray-500">
                    Confirm password </label>
                <div class="mt-1">
                    <input type="password" id="password_confirmation" name="password_confirmation"
                           autocomplete="new-password"
                           class="block w-full transition duration-150 ease-in-out appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('password_confirmation') border-red-400 @enderror"/>
                </div>
            </div>
            <x-admin.form.input.error :messages="$errors->get('password_confirmation')" class="mt-2"/>
        </div>

        <div class="flex items-center justify-end mt-4 mr">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
               href="{{ route('admin.login.index') }}">
                {{ __('Already registered?') }}
            </a>


            <button
                type="submit"
                class="px-4 py-2 ml-2 bg-gray-500 hover:bg-gray-700 rounded-lg text-white"
            >
                Register
            </button>
        </div>
    </form>
@endsection
