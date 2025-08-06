@extends('layouts.frontend.app')

@section('content')
    <form method="POST" action="{{ route('password.store') }}">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Email Address -->
        <div>
            <x-admin.form.input
                    id="email"
                    label="{{ __('Email') }}"
                    class="block mt-1 w-full"
                    type="email"
                    name="email"
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

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-admin.form.input
                    id="password_confirmation"
                    label="{{ __('Confirm Password') }}"
                    class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                    type="password"
                    name="password_confirmation"
                    placeholder="{{  __('Confirm Password') }}"
                    required
            />

            <x-admin.form.input.error :messages="$errors->get('password_confirmation')" class="mt-2"/>
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Reset Password') }}
            </x-primary-button>
        </div>
    </form>
@endsection
