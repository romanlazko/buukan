{{-- <x-web_app-layout> --}}
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <img id="photoPreview" src="{{ asset($web_app->company->logo) }}" class="w-36">
        </div>
        <div>
            CZ
        </div>
    </x-slot>
    <div class="mx-auto sm:max-w-md mt-6 bg-white overflow-hidden shadow-sm sm:rounded-lg sm:p-6 lg:p-8">
        <form method="POST" action="{{ route('user.client.register.store', $web_app) }}">
            @csrf
    
            <!-- Name -->
            <div class="w-full sm:flex sm:space-x-3">
                <div class="w-full sm:w-1/2">
                    <x-input-label for="first_name" :value="__('First name')" />
                    <x-text-input id="first_name" class="block mt-1 w-full" type="text" name="first_name" :value="old('first_name')" required autofocus autocomplete="first_name" />
                    <x-input-error :messages="$errors->get('first_name')" class="mt-2" />
                </div>
                <div class="w-full sm:w-1/2">
                    <x-input-label for="last_name" :value="__('Last name')" />
                    <x-text-input id="last_name" class="block mt-1 w-full" type="text" name="last_name" :value="old('last_name')" required autofocus autocomplete="last_name" />
                    <x-input-error :messages="$errors->get('last_name')" class="mt-2" />
                </div>
            </div>
            
    
            <!-- Email Address -->
            <div class="mt-4">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', request()->email)" required autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>
    
            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Password')" />
    
                <x-text-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />
    
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>
    
            <!-- Confirm Password -->
            <div class="mt-4">
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
    
                <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required autocomplete="new-password" />
    
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>
    
            <div class="flex items-center justify-end mt-4">
                <x-primary-button class="ml-4">
                    {{ __('Register') }}
                </x-primary-button>
            </div>
        </form>
    </div>
{{-- </x-web_app-layout> --}}
