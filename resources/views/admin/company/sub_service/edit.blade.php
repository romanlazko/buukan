<x-app-layout>
    <x-slot name="navigation">
        <x-form.search :action="route('admin.company.sub_service.index', $company)" :placeholder="__('Search by sub services')"/>
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
            <x-a-buttons.back href="{{ route('admin.company.sub_service.index', $company) }}"/>
            <h2 class="font-semibold text-xl text-gray-800 whitespace-nowrap">
                {{ __('Edit sub service:') }}
            </h2>
        </div>
    </x-slot>

    <div class="w-full space-y-6 m-auto max-w-2xl py-4">
        <form method="POST" action="{{ route('admin.company.sub_service.update', [$company, $sub_service]) }}" enctype='multipart/form-data'>
            @csrf
            @method('PATCH')
            <div class="space-y-6">

                <x-white-block>
                    <x-form.label for="name" :value="__('Name of sub service:')" />
                    <div class="space-x-2 w-full flex">
                        <div>
                            <x-form.color id="color" name="color" :value="old('color', $sub_service->color)"/>
                            <x-form.error class="mt-2" :messages="$errors->get('color')" />
                        </div>
                        <div class="w-full">
                            <x-form.input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $sub_service->name)" required autocomplete="name" />
                            <x-form.error class="mt-2" :messages="$errors->get('name')" />
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
