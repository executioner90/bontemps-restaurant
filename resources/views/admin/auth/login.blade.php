@extends('layouts.frontend.app')

@section('content')
    <!-- Session Status -->
    <x-admin.auth.session.status class="mb-4" :status="session('status')"/>

    <div class="container w-1/3 px-5 py-6 mx-auto">
        <div class="flex items-center justify-center bg-gray-50 p-6 rounded-lg">
            <form method="POST" action="{{ route('admin.login.store') }}">
                @csrf

                <!-- Email Address -->
                <div>
                    <x-admin.form.input
                            id="email"
                            class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                            type="email"
                            name="email"
                            label="{{ __('Email') }}"
                            placeholder="Email"
                            required
                            autofocus
                    />

                    <x-admin.form.input.error :messages="$errors->get('email')" class="mt-2"/>
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-admin.form.input
                            label="{{ __('Password') }}"
                            id="password"
                            class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                            type="password"
                            name="password"
                            placeholder="Password"
                            required
                    />

                    <x-admin.form.input.error :messages="$errors->get('password')" class="mt-2"/>
                </div>

                <!-- Remember Me -->
                <div class="block mt-4">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox"
                               class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800"
                               name="remember">
                        <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
                    </label>
                </div>

                <div class="flex items-center justify-end mt-4">
                    @if (Route::has('password.request'))
                        <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                           href="{{ route('password.request') }}">
                            {{ __('Forgot your password?') }}
                        </a>
                    @endif

                    <x-admin.button class="ml-3" label="{{ __('Log in') }}"/>
                </div>
            </form>
        </div>
    </div>
@endsection
