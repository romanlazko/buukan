<x-app-layout>
    <x-slot name="header">
        <div class="sm:flex items-center sm:space-x-3 w-max text-center">
            <a class="font-semibold text-xl text-gray-600 hidden lg:grid hover:bg-gray-200 aspect-square w-8 rounded-full content-center text-center" href="{{ route('admin.company.service.index', $company) }}">
                {{ __('←') }}
            </a>
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
                                <x-form.color id="color" name="color" :value="'#' . substr(md5(uniqid()), 0, 6)"/>
                                <x-form.error class="mt-2" :messages="$errors->get('color')" />
                            </div>
                        </div>
                    </div>
                </x-white-block>

                <x-white-block>
                    <div>
                        <x-form.label for="description" :value="__('Description:')"/>
                        <x-form.textarea id="description" name="description" class="mt-1 block w-full" :value="old('description')" />
                        <x-form.error class="mt-2" :messages="$errors->get('name')"/>
                    </div>
                </x-white-block>

                <x-white-block>
                    <div class="space-y-4">
                        <div>
                            <x-form.label for="price" :value="__('Price:')"/>
                            <x-form.input id="price" name="price" type="number" class="mt-1 block w-full" :value="old('price')"/>
                            <x-form.error class="mt-2" :messages="$errors->get('price')"/>
                        </div>
                        <div>
                            <x-form.label for="currency" :value="__('Currency:')" />
                            <x-form.select id="currency" name="currency" class="mt-1 block w-full">
                                <option value="CZK">CZK</option>
                                <option value="EUR">EUR</option>
                                <option value="USD">USD</option>
                            </x-form.select>
                            <x-form.error class="mt-2" :messages="$errors->get('currency')" />
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
