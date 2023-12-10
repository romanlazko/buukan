<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Create WebApp:') }}
            </h2>
        </div>
        <div class="space-x-4 sm:-my-px sm:ml-10 flex">
            <x-nav-link :href="route('admin.company.web_app.index', $company)" :active="request()->routeIs('admin.company.web_app.index*')">
                {{ __('←') }}
            </x-nav-link>
        </div>
    </x-slot>
    
    <div class="w-full space-y-6 m-auto max-w-2xl">
        <form method="post" action="{{ route('admin.company.web_app.store', $company) }}" class="space-y-6">
            @csrf
            @method('POST')
            <x-white-block>
                <div class="space-y-4">
                    <h2 class="text-lg font-medium text-gray-900">
                        {{ __('Site setup') }}
                    </h2>

                    <p class="mt-1 text-sm text-gray-600">
                        {{ __('Use this form to specify a URL to tour website.') }}
                    </p>
                    <div>
                        <x-form.label for="url" :value="__('Url:')" />
                        <x-form.input id="url" name="url" type="text" class="mt-1 block w-full" :value="old('url')" required autocomplete="url" />
                        <x-form.error class="mt-2" :messages="$errors->get('url')" />
                    </div>
                </div>
            </x-white-block>

            <x-white-block>
                <div class="space-y-4">
                    <h2 class="text-lg font-medium text-gray-900">
                        {{ __('Settings') }}
                    </h2>
                    <div class="border rounded-md p-3">
                        <div class="flex space-x-2 items-center py-3 border-b">
                            <x-form.label for="" class="w-full ">
                                <div class="flex justify-between w-full items-center">
                                    <span>
                                        {{ __("Can customer cancel an appointment via WebApp")  }}
                                    </span>
                                    <x-form.checkbox id="" name="settings[can_client_cancel_appointment]" type="checkbox" :checked="old('settings[can_client_cancel_appointment]')"/>
                                </div>
                            </x-form.label>
                        </div>
                        <div class="flex space-x-2 items-center py-3 ">
                            <x-form.label for="" class="w-full ">
                                <div class="flex justify-between w-full items-center">
                                    <span>
                                        {{ __("Maximum number of active appointments at the customer")  }}
                                    </span>
                                    <x-form.input id="" name="settings[max_active_appointments]" type="number" :value="old('settings[max_active_appointments]')"/>
                                </div>
                            </x-form.label>
                        </div>
                    </div>
                </div>
            </x-white-block>
            <div class="flex justify-end">
                <x-buttons.primary>{{ __('Save') }}</x-buttons.primary>
            </div>
        </form>
    </div>
</x-app-layout>