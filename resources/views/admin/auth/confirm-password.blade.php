@extends('layouts.frontend.app')

@section('content')
    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
        {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
    </div>

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <!-- Password -->
        <div>
            <x-admin.form.input
                id="password"
                class="block mt-1 w-full"
                type="password"
                name="password"
                label="{{ __('Password') }}"
                required
                utocomplete="current-password"
            />
        </div>

        <div class="flex justify-end mt-4">
            <x-admin.button label="{{ __('Confirm') }}" />
        </div>
    </form>
@endsection
