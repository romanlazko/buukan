<x-web-app-layout>
    <x-web-app>
        <x-slot name="header">
            <div class="flex justify-between items-center">
                <img id="photoPreview" src="{{ asset($web_app->company->logo) }}" class="w-36">
            </div>
            <div>
                CZ
            </div>
        </x-slot>

        <div class="mx-auto sm:max-w-2xl mt-6 overflow-hidden shadow-sm sm:rounded-lg sm:p-6 lg:p-8">
            <form method="POST" action="{{ route('user.client.login.store', $web_app) }}">
                @csrf

                <x-white-block>
                    <div>
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', request()->email)" required autofocus autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div class="mt-4">
                        <x-input-label for="password" :value="__('Password')" />

                        <x-text-input id="password" class="block mt-1 w-full"
                                        type="password"
                                        name="password"
                                        required autocomplete="current-password" />

                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <x-primary-button class="ml-3">
                            {{ __('Log in') }}
                        </x-primary-button>
                    </div>
                </x-white-block>
            </form>
        </div>
        
    </x-web-app>
</x-web-app-layout>