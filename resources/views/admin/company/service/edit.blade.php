<x-app-layout>
    <x-slot name="navigation">
        <x-form.search :action="route('admin.company.service.index', $company)" :placeholder="__('Search by services')"/>
        <x-header.menu>
            <x-header.link :href="route('admin.company.service.index', $company)" :active="request()->routeIs('admin.company.service.*')">
                {{ __('Services') }}
            </x-header.link>
            <x-header.link :href="route('admin.company.sub_service.index', $company)" :active="request()->routeIs('admin.company.sub_service.*')">
                {{ __('Sub services') }}
            </x-header.link>
        </x-header.menu>
    </x-slot>
    
    <x-slot name="header">
        <div class="flex items-center justify-between w-min space-x-2">
            <x-a-buttons.back href="{{ route('admin.company.service.index', $company) }}"/>
            <h2 class="font-semibold text-xl text-gray-800 whitespace-nowrap">
                {{ __('Edit service:') }}
            </h2>
        </div>
    </x-slot>

    <div class="w-full space-y-6 m-auto max-w-2xl py-4">
        <form method="POST" action="{{ route('admin.company.service.update', [$company, $service]) }}" enctype='multipart/form-data'>
            @csrf
            @method('PATCH')
            <div class="space-y-6">
                <x-white-block>
                    <x-form.label for="name" :value="__('Name of service:')" />
                    <div class="space-x-2 w-full flex">
                        <div>
                            <x-form.color id="color" name="color" :value="old('color', $service->color)"/>
                            <x-form.error class="mt-2" :messages="$errors->get('color')" />
                        </div>
                        <div class="w-full">
                            <x-form.input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $service->name)" required autocomplete="name" />
                            <x-form.error class="mt-2" :messages="$errors->get('name')" />
                        </div>
                    </div>
                </x-white-block>

                <x-white-block>
                    <div>
                        <x-form.label for="description" :value="__('Description:')" />
                        <x-form.textarea id="description" name="description" class="mt-1 block w-full" :value="old('description', $service->description)" />
                        <x-form.error class="mt-2" :messages="$errors->get('description')" />
                    </div>
                </x-white-block>

                <x-white-block>
                    <x-form.label for="price" :value="__('Price:')"/>
                    
                    <div class="flex space-x-2">
                        <div class="w-full">
                            <x-form.input id="price" name="price" type="number" class="mt-1 block w-full" :value="old('price', $service->price->getAmount()->toInt())"/>
                            <x-form.error class="mt-2" :messages="$errors->get('price')"/>
                        </div>
                        <div class="w-1/3">
                            <x-form.select id="currency" name="currency" class="mt-1 block w-full">
                                <option @selected($service->currency == 'CZK') value="CZK">CZK</option>
                                <option @selected($service->currency == 'EUR') value="EUR">EUR</option>
                                <option @selected($service->currency == 'USD') value="USD">USD</option>
                            </x-form.select>
                            <x-form.error class="mt-2" :messages="$errors->get('currency')" />
                        </div>
                    </div>
                    <div class="flex space-x-2 items-center py-3">
                        <x-form.label for="is_price_from" class="w-full">
                            <div class="flex justify-between w-full items-center">
                                <span>
                                    {{ __("Price from:")  }}
                                </span>
                                <x-form.checkbox id="is_price_from" name="settings[is_price_from]" type="checkbox" :checked="old('settings[is_price_from]', $service->settings->is_price_from ?? null)"/>
                            </div>
                        </x-form.label>
                    </div>
                </x-white-block>

                <x-white-block>
                    <div class="space-y-4">
                        <h2 class="text-lg font-medium text-gray-900">
                            {{ __('Employees') }}
                        </h2>
                        <div class="border rounded-md p-3">
                            @foreach ($company->employees()->role('employee', 'company')->get() as $employee)
                                <div class="flex space-x-2 items-center py-3 @if(!$loop->last) border-b @endif">
                                    <x-form.label for="{{ $employee->slug }}" class="w-full ">
                                        <div class="flex justify-between w-full items-center">
                                            <span>
                                                {{ $employee->first_name }} {{ $employee->last_name }}
                                            </span>
                                            <x-form.checkbox id="{{ $employee->slug }}" name="employees[]" :value="$employee->id" type="checkbox" :checked="old('employees[{{$employee->id}}]', !$service->employees->where('id', $employee->id)->isEmpty())"/>
                                        </div>
                                    </x-form.label>
                                </div>
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
                            <div class="flex space-x-2 items-center py-3">
                                <x-form.label for="is_available_on_telegram" class="w-full">
                                    <div class="flex justify-between w-full items-center">
                                        <span>
                                            {{ __("Is available on Telegram")  }}
                                        </span>
                                        <x-form.checkbox id="is_available_on_telegram" name="settings[is_available_on_telegram]" type="checkbox" :checked="old('settings[is_available_on_telegram]', $service->settings->is_available_on_telegram ?? null)"/>
                                    </div>
                                </x-form.label>
                            </div>
                            <hr>
                            <div class="flex space-x-2 items-center py-3">
                                <x-form.label for="is_available_on_webapp" class="w-full">
                                    <div class="flex justify-between w-full items-center">
                                        <span>
                                            {{ __("Is available on WebApp")  }}
                                        </span>
                                        <x-form.checkbox id="is_available_on_webapp" name="settings[is_available_on_webapp]" type="checkbox" :checked="old('settings[is_available_on_webapp]', $service->settings->is_available_on_webapp ?? null)"/>
                                    </div>
                                </x-form.label>
                            </div>
                        </div>
                    </div>
                </x-white-block>

                <x-white-block>
                    <div class="space-y-4">
                        <x-form.label for="active" value="{{ __('Status') }}"/>
                        <x-form.select id="active" name="active" class="w-full">
                            <option @selected($service->active == 1) value="1">Active</option>
                            <option @selected($service->active == 0) value="0">Disable</option>
                        </x-form.select>
                    </div>
                </x-white-block>
                
                <div class="flex justify-end px-4 sm:px-0">
                    <x-buttons.primary>{{ __('Save') }}</x-buttons.primary>
                </div>
            </div>
        </form>
    </div>
</x-app-layout>
