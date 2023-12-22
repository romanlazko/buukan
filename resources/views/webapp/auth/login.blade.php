<x-web-app-layout>
    <x-web-app>
        <x-slot name="header">
            <div class="flex items-center">
                <div class="flex-col items-center my-auto">
                    <img src="{{ asset($web_app->company->logo) }}" alt="Logo" class="mr-4 w-12 h-12 min-w-[48px] rounded-full">
                </div>
                <div class="flex-col justify-center">
                    <p class="w-full text-md font-medium text-gray-900">
                        {{ $web_app->company->name ?? null }}
                    </p>
                    <p class="w-full text-sm font-light text-gray-500 mb-1">
                        {{ $web_app->company->description ?? null }}
                    </p>
                </div>
            </div>
        </x-slot>
        <div class="mx-auto sm:max-w-md mt-6 bg-white overflow-hidden shadow-sm sm:rounded-lg p-4 sm:p-6 lg:p-8">
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('webapp.login', $web_app) }}">
                @csrf

                <!-- Email Address -->
                <div>
                    <x-form.label for="email" :value="__('Email')" />
                    <x-form.input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
                    <x-form.error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-form.label for="password" :value="__('Password')" />

                    <x-form.input id="password" class="block mt-1 w-full"
                                    type="password"
                                    name="password"
                                    autocomplete="current-password" />

                    <x-form.error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Remember Me -->
                <div class="block mt-4">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                        <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                    </label>
                </div>

                <div class="flex items-center justify-end mt-4">
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('webapp.register', $web_app) }}">
                        {{ __('Register?') }}
                    </a>

                    <x-buttons.primary class="ml-3">
                        {{ __('Log in') }}
                    </x-buttons.primary>
                </div>
            </form>
        </div>
    </x-web-app>
</x-web_app-layout>
