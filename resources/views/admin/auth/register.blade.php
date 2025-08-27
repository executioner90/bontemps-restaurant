@extends('layouts.admin.guest')

@section('content')
    <div class="text-white text-4xl mb-4 font-semibold">
        Register
    </div>

    <form method="POST" action="{{ route('admin.register.store') }}">
        @csrf

        <!-- Name -->
        <div>
            <div class="sm:col-span-6">
                <div class="mt-1">
                    <x-admin.form.input
                        id="name"
                        class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                        type="text"
                        name="name"
                        label="{{ __('Name') }}"
                        placeholder="Name"
                        required
                        autofocus
                    />
                </div>
            </div>
            <x-admin.form.input.error :messages="$errors->get('name')" class="mt-2"/>
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <div class="sm:col-span-6">
                <div class="mt-1">
                    <x-admin.form.input
                        id="email"
                        class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                        type="text"
                        name="email"
                        label="{{ __('E-mail') }}"
                        placeholder="E-mail"
                        required
                        autofocus
                    />
                </div>
            </div>
            <x-admin.form.input.error :messages="$errors->get('email')" class="mt-2"/>
        </div>

        <div class="mt-4">
            <div class="sm:col-span-6">
                <div class="mt-1">
                    <label for="role" class="block font-medium text-sm text-gray-700 dark:text-gray-300">
                        Role
                    </label>

                    <select
                        name="role"
                        id="role"
                        class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                    >
                        <option value="">@lang('Select role')</option>

                        @foreach($roles as $role)
                            <option value="{{ $role->id }}">{{ $role->role }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <x-admin.form.input.error :messages="$errors->get('role')" class="mt-2"/>
        </div>

        <!-- Password -->
        <div class="mt-4">
            <div class="sm:col-span-6">
                <div class="mt-1">
                    <x-admin.form.input
                        id="password"
                        class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                        type="password"
                        name="password"
                        label="{{ __('Password') }}"
                        placeholder="Password"
                        required
                        autofocus
                    />
                </div>
            </div>
            <x-admin.form.input.error :messages="$errors->get('password')" class="mt-2"/>
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <div class="sm:col-span-6">
                <div class="mt-1">
                    <x-admin.form.input
                        id="password_confirmation"
                        class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                        type="password"
                        name="password_confirmation"
                        label="{{ __('Confirm password') }}"
                        placeholder="Confirm password"
                        required
                        autofocus
                    />
                </div>
            </div>
            <x-admin.form.input.error :messages="$errors->get('password_confirmation')" class="mt-2"/>
        </div>

        <div class="flex items-center justify-end mt-4 mr">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
               href="{{ route('admin.login.index') }}">
                {{ __('Already registered?') }}
            </a>


            <x-admin.button class="ml-3" label="{{ __('Register') }}"/>
        </div>
    </form>
@endsection
