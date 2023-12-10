<x-app-layout>
    <x-slot name="header">
        <div class="sm:flex items-center sm:space-x-3 w-max text-center">
            <x-a-buttons.back href="{{ route('admin.company.client.index', $company) }}"/>
            <h2 class="font-semibold text-xl text-gray-800">
                {{ __('Create client:') }}
            </h2>
        </div>
    </x-slot>
    
    <div class="w-full space-y-6 m-auto max-w-2xl">
        <form method="post" action="{{ route('admin.company.client.store', $company) }}" >
            @csrf
            <div class="space-y-6">
                <x-white-block>
                    <div class="space-y-4 sm:flex sm:space-x-4 sm:space-y-0">
                        <div class="space-y-4 w-full">
                            <h2 class="text-lg font-medium text-gray-900">
                                {{ __('Client:') }}
                            </h2>
                            <div>
                                <x-form.label for="last_name" :value="__('Surname:')" />
                                <x-form.input id="last_name" name="last_name" type="text" class="mt-1 block w-full" :value="old('last_name')" required autocomplete="last_name"/>
                                <x-form.error class="mt-2" :messages="$errors->get('last_name')" />
                            </div>

                            <div>
                                <x-form.label for="first_name" :value="__('Name:')" />
                                <x-form.input id="first_name" name="first_name" type="text" class="mt-1 block w-full" :value="old('first_name')" autocomplete="first_name" />
                                <x-form.error class="mt-2" :messages="$errors->get('first_name')" />
                            </div>
                            <div>
                                <x-form.label for="email" :value="__('Email')" />
                                <x-form.input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"/>
                                <x-form.error :messages="$errors->get('email')" class="mt-2" />
                            </div>
                            <div>
                                <x-form.label for="phone" :value="__('Phone')" />
                                <x-form.input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('phone')"/>
                                <x-form.error :messages="$errors->get('phone')" class="mt-2" />
                            </div>
                        </div>
                    </div>
                </x-white-block>
                
                <x-white-block>
                    <div class="space-y-4 sm:flex sm:space-x-4 sm:space-y-0">
                        <h2 class="text-lg font-medium text-gray-900">
                            {{ __('Social media:') }}
                        </h2>
                        <div class="w-full" >
                            <x-form.label for="instagram" :value="__('Instagram:')" />
                            <x-form.input id="instagram" name="social_media[instagram]" type="text" class="mt-1 block w-full" :value="old('instagram')" placeholder="link or @nickname"/>
                            <x-form.error class="mt-2" :messages="$errors->get('instagram')"/>
                        </div>

                        <div class="w-full" >
                            <x-form.label for="telegram" :value="__('Telegram:')" />
                            <x-form.input id="telegram" name="social_media[telegram]" type="text" class="mt-1 block w-full" :value="old('telegram')" placeholder="link or @nickname"/>
                            <x-form.error class="mt-2" :messages="$errors->get('telegram')"/>
                        </div>

                        <div class="w-full" >
                            <x-form.label for="facebook" :value="__('Facebook:')" />
                            <x-form.input id="facebook" name="social_media[facebook]" type="text" class="mt-1 block w-full" :value="old('facebook')" placeholder="link or @nickname"/>
                            <x-form.error class="mt-2" :messages="$errors->get('facebook')"/>
                        </div>
                    </div>
                </x-white-block>
                
                <div class="flex justify-end px-4 sm:px-0">
                    <x-buttons.primary>{{ __('Create') }}</x-buttons.primary>
                </div>
            </div>
        </form>
    </div>
</x-app-layout>
