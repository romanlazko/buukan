<x-guest-layout>
    <div class=" w-full mx-auto sm:max-w-md mt-6 bg-white overflow-hidden shadow-sm sm:rounded-lg p-4 sm:p-6 lg:p-8">
        <form method="POST" action="{{ route('admin.register') }}">
            @csrf
    
            <!-- Name -->
            <div class="w-full sm:flex sm:space-x-3 space-y-4 sm:space-y-0">
                <div class="w-full sm:w-1/2">
                    <x-form.label for="first_name" :value="__('First name')" />
                    <x-form.input id="first_name" class="block mt-1 w-full" type="text" name="first_name" :value="old('first_name')" required autofocus autocomplete="first_name" />
                    <x-form.error :messages="$errors->get('first_name')" class="mt-2" />
                </div>
                <div class="w-full sm:w-1/2">
                    <x-form.label for="last_name" :value="__('Last name')" />
                    <x-form.input id="last_name" class="block mt-1 w-full" type="text" name="last_name" :value="old('last_name')" required autofocus autocomplete="last_name" />
                    <x-form.error :messages="$errors->get('last_name')" class="mt-2" />
                </div>
            </div>
            
    
            <!-- Email Address -->
            <div class="mt-4">
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
                                required autocomplete="new-password" />
    
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
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('admin.login') }}">
                    {{ __('Already registered?') }}
                </a>
    
                <x-buttons.primary class="ml-4">
                    {{ __('Register') }}
                </x-buttons.primary>
            </div>
        </form>
    </div>
</x-guest-layout>
