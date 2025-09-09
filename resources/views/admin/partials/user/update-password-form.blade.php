<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Update Password') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <form method="post" action="{{ route('admin.password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div>
            <x-admin.form.input id="current_password" name="current_password" label="{{ __('Current Password') }}" type="password" class="mt-1 block w-full" autocomplete="current-password" />
        </div>

        <div>
            <x-admin.form.input id="password" name="password" label="{{ __('New Password') }}" type="password" class="mt-1 block w-full" autocomplete="new-password" />
        </div>

        <div>
            <x-admin.form.input id="password_confirmation" name="password_confirmation" label="{{ __('Confirm Password') }}" type="password" class="mt-1 block w-full" autocomplete="new-password" />
        </div>

        <div class="flex items-center gap-4">
            <x-admin.button label="{{ __('Save') }}" />

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
