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
            <form method="post" action="{{ route('user.client.email.store', $web_app) }}" class="space-y-6">
                @csrf
                @method('POST')
                <x-white-block>
                    <div>
                        <x-form.label for="email" :value="__('Email')" />
                        <x-form.input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                        <x-form.error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <x-buttons.primary class="ml-3">
                            {{ __('Continue') }}
                        </x-buttons.primary>
                    </div>
                </x-white-block>
            </form>
        </div>
        
    </x-web-app>
</x-web-app-layout>