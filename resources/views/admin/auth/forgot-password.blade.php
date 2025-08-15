@extends('layouts.frontend.app')

@section('content')
    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
    </div>

    <!-- Session Status -->
    <x-admin.auth.session.status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-admin.form.input
                    id="email"
                    class="block mt-1 w-full"
                    label="{{ __('Email') }}"
                    type="email"
                    name="email"
                    :value="old('email')"
                    required
                    autofocus
            />
            <x-admin.form.input.error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-admin.button label="{{ __('Email Password Reset Link') }}" />
        </div>
    </form>
@endsection
