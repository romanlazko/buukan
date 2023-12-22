<x-app-layout>
    <x-slot name="header">
        <div class="sm:flex items-center sm:space-x-3 w-max text-center">
            <x-a-buttons.back href="{{ route('admin.company.service.index', $company) }}"/>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Create service:') }}
            </h2>
        </div>
        <div></div>
    </x-slot>

    <div class="w-full space-y-6 m-auto max-w-2xl py-4">
        <form method="POST" action="{{ route('admin.company.service.store', $company) }}" enctype='multipart/form-data'>
            @csrf
            <div class="space-y-6">
                <x-white-block>
                    <div class="space-y-4 sm:flex sm:space-x-4 sm:space-y-0">
                        <div class="space-y-4 w-full">
                            <div>
                                <x-form.label for="name" :value="__('Name of service:')" />
                                <x-form.input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name')" required autocomplete="name" />
                                <x-form.error class="mt-2" :messages="$errors->get('name')" />
                            </div>
                            <div>
                                <x-form.label for="color" :value="__('Color:')" />
                                <x-form.color id="color" name="color" :value="old('color', '#' . substr(md5(uniqid()), 0, 6))"/>
                                <x-form.error class="mt-2" :messages="$errors->get('color')" />
                            </div>
                        </div>
                    </div>
                </x-white-block>

                <x-white-block>
                    <div>
                        <x-form.label for="description" :value="__('Description:')"/>
                        <x-form.textarea id="description" name="description" class="mt-1 block w-full" :value="old('description')"/>
                        <x-form.error class="mt-2" :messages="$errors->get('description')"/>
                    </div>
                </x-white-block>

                <x-white-block>
                    <div>
                        <x-form.label for="additional" :value="__('Additional information:')"/>
                        <x-form.textarea id="additional" name="additional" class="mt-1 block w-full" :value="old('additional')"/>
                        <x-form.error class="mt-2" :messages="$errors->get('additional')"/>
                    </div>
                </x-white-block>

                <x-white-block>
                    <x-form.label for="price" :value="__('Price:')"/>
                    
                    <div class="flex space-x-2">
                        <div class="w-full">
                            <x-form.input id="price" name="price" type="number" class="mt-1 block w-full" :value="old('price')"/>
                            <x-form.error class="mt-2" :messages="$errors->get('price')"/>
                        </div>
                        <div class="w-1/3">
                            <x-form.select id="currency" name="currency" class="mt-1 block w-full">
                                <option value="CZK">CZK</option>
                                <option value="EUR">EUR</option>
                                <option value="USD">USD</option>
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
                                <x-form.checkbox id="is_price_from" name="settings[is_price_from]" type="checkbox" :checked="old('settings[is_price_from]')"/>
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
                                            <x-form.checkbox id="{{ $employee->slug }}" name="employees[]" :value="$employee->id" type="checkbox" :checked="in_array($employee->id, old('employees') ?? [])"/>
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
                                        <x-form.checkbox id="is_available_on_telegram" name="settings[is_available_on_telegram]" type="checkbox" :checked="old('settings[is_available_on_telegram]')"/>
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
                                        <x-form.checkbox id="is_available_on_webapp" name="settings[is_available_on_webapp]" type="checkbox" :checked="old('settings[is_available_on_telegram]')"/>
                                    </div>
                                </x-form.label>
                            </div>
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
