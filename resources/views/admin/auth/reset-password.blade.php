@extends('layouts.admin.guest')

@section('content')
    <form method="POST" action="{{ route('admin.password.store') }}">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Email Address -->
        <div>
            <x-admin.form.input
                    id="email"
                    label="{{ __('Email') }}"
                    class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                    type="email"
                    name="email"
                    placeholder="Email"
                    required
                    autofocus
            />
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
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-admin.button label="{{ __('Reset Password') }}" />
        </div>
    </form>
@endsection
