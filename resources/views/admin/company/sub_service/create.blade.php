<x-app-layout>
    <x-slot name="header">
        <div class="sm:flex items-center sm:space-x-3 w-max">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight w-full text-center">
                {{ __('Create sub service:') }}
            </h2>
        </div>
        <x-header.menu>
            <x-header.link :href="route('admin.company.sub_service.index', $company)" :active="request()->routeIs('admin.company.sub_service.index')">
                {{ __('← Back') }}
            </x-header.link>
        </x-header.menu>
    </x-slot>

    <div class="w-full space-y-6 m-auto max-w-2xl">
        <form method="POST" action="{{ route('admin.company.sub_service.store', $company) }}" enctype='multipart/form-data'>
            @csrf
            <div class="space-y-6">
                <x-white-block>
                    <div class="space-y-4">
                        <div>
                            <x-form.label for="name" :value="__('Name:')" />
                            <x-form.input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name')" required autocomplete="name" />
                            <x-form.error class="mt-2" :messages="$errors->get('name')" />
                        </div>
                        <div>
                            <x-form.label for="color" :value="__('Color:')" />
                            <x-form.color id="color" name="color" :value="'#' . substr(md5(uniqid()), 0, 6)"/>
                            <x-form.error class="mt-2" :messages="$errors->get('color')" />
                        </div>
                    </div>
                    
                </x-white-block>

                <x-white-block>
                    <div>
                        <x-form.label for="description" :value="__('Description:')" />
                        <x-form.textarea id="description" name="description" class="mt-1 block w-full" :value="old('description')" />
                        <x-form.error class="mt-2" :messages="$errors->get('name')" />
                    </div>
                </x-white-block>

                <x-white-block>
                    <div>
                        <x-form.label for="price" :value="__('Price:')" />
                            <x-form.input id="price" name="price" type="number" class="mt-1 block w-full" :value="old('price')"/>
                            <x-form.error class="mt-2" :messages="$errors->get('price')" />
                    </div>
                </x-white-block>
                
                <div class="flex justify-end">
                    <x-buttons.primary>{{ __('Create') }}</x-buttons.primary>
                </div>
            </div>
        </form>
    </div>
    
</x-app-layout>
