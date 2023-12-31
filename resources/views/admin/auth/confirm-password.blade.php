<x-guest-layout>
    <div class="mx-auto sm:max-w-md mt-6 bg-white overflow-hidden shadow-sm sm:rounded-lg sm:p-6 lg:p-8">
        <div class="mb-4 text-sm text-gray-600">
            {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
        </div>

        <form method="POST" action="{{ route('password.confirm') }}">
            @csrf

            <!-- Password -->
            <div>
                <x-form.label for="password" :value="__('Password')" />

                <x-form.input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="current-password" />

                <x-form.error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div class="flex justify-end mt-4">
                <x-buttons.primary>
                    {{ __('Confirm') }}
                </x-buttons.primary>
            </div>
        </form>
    </div>
</x-guest-layout>
