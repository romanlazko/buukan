<x-guest-layout>
    <div class="mx-auto sm:max-w-md mt-6 bg-white overflow-hidden shadow-sm sm:rounded-lg sm:p-6 lg:p-8">
        <form method="POST" action="{{ route('password.store') }}">
            @csrf

            <!-- Password Reset Token -->
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <!-- Email Address -->
            <div>
                <x-form.label for="email" :value="__('Email')" />
                <x-form.input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" />
                <x-form.error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-form.label for="password" :value="__('Password')" />
                <x-form.input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
                <x-form.error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-form.label for="password_confirmation" :value="__('Confirm Password')" />

                <x-form.input id="password_confirmation" class="block mt-1 w-full"
                                    type="password"
                                    name="password_confirmation" required autocomplete="new-password" />

                <x-form.error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-buttons.primary>
                    {{ __('Reset Password') }}
                </x-buttons.primary>
            </div>
        </form>
    </div>
</x-guest-layout>
