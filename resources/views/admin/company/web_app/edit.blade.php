<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center">
            
        </div>
        <div class="space-x-4 sm:-my-px sm:ml-10 flex">
            <x-nav-link :href="route('admin.company.web_app.index', $company)" :active="request()->routeIs('admin.company.web_app.index*')">
                {{ __('←') }}
            </x-nav-link>
            <x-nav-link :href="route('admin.company.web_app.edit', [$company, $web_app])" :active="request()->routeIs('admin.company.web_app.edit*')">
                {{ __('App') }}
            </x-nav-link>
            <x-nav-link :href="route('admin.company.web_app.show', [$company, $web_app])" :active="request()->routeIs('admin.company.web_app.show')">
                {{ __('Preview') }}
            </x-nav-link>
        </div>
    </x-slot>
    
    <div class="w-full flex space-x-4 m-auto max-w-2xl">
        <form method="post" action="{{ route('admin.company.web_app.update', [$company, $web_app]) }}" class="w-full">
            @csrf
            @method('PUT')
            <div class="space-y-6 ">
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
                            <x-form.input id="url" name="url" type="text" class="mt-1 block w-full" :value="old('url', $web_app->url)" required autocomplete="url" />
                            <x-form.error class="mt-2" :messages="$errors->get('url')" />
                        </div>
                    </div>
                </x-white-block>
    
                <x-white-block>
                    <div class="space-y-4">
                        <h2 class="text-lg font-medium text-gray-900">
                            {{ __('Employees') }}
                        </h2>
    
                        <p class="mt-1 text-sm text-gray-600">
                            {{ __('Use this form to specify a which employee will be shown inside app.') }}
                        </p>
                        <div class="border rounded-md p-3">
                            @foreach ($company->employees as $employee)
                                <div class="flex space-x-2 items-center py-3">
                                    <x-form.label for="{{ $employee->slug }}" class="w-full">
                                        <div class="flex justify-between w-full items-center">
                                            <span>
                                                {{ $employee->first_name }} {{ $employee->last_name }}
                                            </span>
                                            <x-form.checkbox 
                                                id="{{ $employee->slug }}" 
                                                name="settings[employees][]"
                                                :checked="old('', in_array($employee->id, $web_app->settings->employees ?? []))"
                                                value="{{ $employee->id }}"/>
                                        </div>
                                    </x-form.label>
                                </div>
                                @if(!$loop->last) <hr> @endif
                            @endforeach
                        </div>
                    </div>
                </x-white-block>
    
                <x-white-block>
                    <div class="space-y-4">
                        <h2 class="text-lg font-medium text-gray-900">
                            {{ __('Services') }}
                        </h2>
    
                        <p class="mt-1 text-sm text-gray-600">
                            {{ __('Use this form to specify a which service will be shown inside app.') }}
                        </p>
                        <div class="border rounded-md p-3">
                            @foreach ($company->services as $service)
                                <div class="flex space-x-2 items-center py-3">
                                    <x-form.label for="{{ $service->slug }}" class="w-full ">
                                        <div class="flex justify-between w-full items-center">
                                            <span>
                                                {{ $service->name }}
                                            </span>
                                            <x-form.checkbox 
                                                id="{{ $service->slug }}" 
                                                name="settings[services][]" 
                                                :checked="old('settings[services][]', in_array($service->id, $web_app->settings?->services ?? []))"
                                                value="{{ $service->id }}"/>
                                        </div>
                                    </x-form.label>
                                </div>
                                @if(!$loop->last) <hr> @endif
                            @endforeach
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
                                            {{ __("Can customer cancel an appointment via bot")  }}
                                        </span>
                                        <x-form.checkbox id="" name="settings[can_client_cancel_appointment]" type="checkbox" :checked="old('settings[can_client_cancel_appointment]', $web_app->settings->can_client_cancel_appointment ?? null)"/>
                                    </div>
                                </x-form.label>
                            </div>
                            <div class="flex space-x-2 items-center py-3 ">
                                <x-form.label for="" class="w-full ">
                                    <div class="flex justify-between w-full items-center">
                                        <span>
                                            {{ __("Maximum number of active appointments at the customer")  }}
                                        </span>
                                        <x-form.input id="" name="settings[max_active_appointments]" type="number" :value="old('settings[max_active_appointments]', $web_app->settings->max_active_appointments ?? 1)"/>
                                    </div>
                                </x-form.label>
                            </div>
                        </div>
                    </div>
                </x-white-block>
                <div class="flex justify-end">
                    <x-buttons.primary>{{ __('Save') }}</x-buttons.primary>
                </div>
            </div>
            
        </form>
        
    </div>
</x-app-layout>