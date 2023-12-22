<x-app-layout>
    <x-slot name="header">
        <div class="sm:flex items-center sm:space-x-3 w-max text-center">
            <x-a-buttons.back href="{{ route('admin.company.sub_service.index', $company) }}"/>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Edit sub service:') }}
            </h2>
            <x-badge color="{{ $sub_service->color }}" class="hidden sm:block">
                {{ $sub_service->name ?? null }}
            </x-badge>
        </div>
        <div></div>
    </x-slot>

    <div class="w-full space-y-6 m-auto max-w-2xl py-4">
        <form method="POST" action="{{ route('admin.company.sub_service.update', [$company, $sub_service]) }}" enctype='multipart/form-data'>
            @csrf
            @method('PATCH')
            <div class="space-y-6">
                <x-white-block>
                    <div class="space-y-6 items-center">
                        <div>
                            <x-form.label for="name" :value="__('Name:')" />
                            <x-form.input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $sub_service->name)" required autocomplete="name" />
                            <x-form.error class="mt-2" :messages="$errors->get('name')" />
                        </div>
                        <div>
                            <x-form.label for="color" :value="__('Color:')" />
                            <x-form.color id="color" name="color" :value="old('color', $sub_service->color)"/>
                            <x-form.error class="mt-2" :messages="$errors->get('color')" />
                        </div>
                    </div>
                </x-white-block>

                <x-white-block>
                    <div>
                        <x-form.label for="description" :value="__('Description:')" />
                        <x-form.textarea id="description" name="description" class="mt-1 block w-full" :value="old('description', $sub_service->description)" />
                        <x-form.error class="mt-2" :messages="$errors->get('description')" />
                    </div>
                </x-white-block>

                <x-white-block>
                    <x-form.label for="price" :value="__('Price:')"/>
                    
                    <div class="flex space-x-2">
                        <div class="w-full">
                            <x-form.input id="price" name="price" type="number" class="mt-1 block w-full" :value="old('price', $sub_service->price->getAmount()->toInt())"/>
                            <x-form.error class="mt-2" :messages="$errors->get('price')"/>
                        </div>
                        <div class="w-1/3">
                            <x-form.select id="currency" name="currency" class="mt-1 block w-full">
                                <option @selected($sub_service->currency == 'CZK') value="CZK">CZK</option>
                                <option @selected($sub_service->currency == 'EUR') value="EUR">EUR</option>
                                <option @selected($sub_service->currency == 'USD') value="USD">USD</option>
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
                                <x-form.checkbox id="is_price_from" name="settings[is_price_from]" type="checkbox" :checked="old('settings[is_price_from]', $sub_service->settings->is_price_from ?? null)"/>
                            </div>
                        </x-form.label>
                    </div>
                </x-white-block>
                
                <div class="flex justify-end px-4 sm:px-0">
                    <x-buttons.primary>{{ __('Update') }}</x-buttons.primary>
                </div>
            </div>
        </form>
    </div>
</x-app-layout>
