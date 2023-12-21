<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Create company:') }}
            </h2>
        </div>
    </x-slot>

    <div class="w-full space-y-6 m-auto max-w-2xl">
        <form method="post" action="{{ route('admin.company.store') }}" enctype='multipart/form-data' class="space-y-6">
            @csrf

            <x-white-block>
                <div class="flex space-x-4 items-center">
                    <x-form.photo name="logo" :src="asset('img/public/preview.jpg')" class="w-36"/>
                    <div class="space-y-4 w-full">
                        <div>
                            <x-form.label for="name" :value="__('Name of company:')" />
                            <x-form.input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name')" required/>
                            <x-form.error class="mt-2" :messages="$errors->get('name')" />
                        </div>
                    </div>
                </div>
            </x-white-block>

            <x-white-block>
                <div class="space-y-4">
                    <div>
                        <x-form.label for="description" :value="__('Description of company:')" />
                        <p class="text-sm text-gray-500">Write somethig about your company</p>
                        <x-form.textarea id="description" name="description" class="mt-1 block w-full" :value="old('description')" required/>
                        <x-form.error class="mt-2" :messages="$errors->get('description')" />
                    </div>
                </div>
            </x-white-block>

            <x-white-block>
                <div class="space-y-4">
                    <div>
                        <x-form.label for="ico" :value="__('ICO:')" />
                        <x-form.input id="ico" name="ico" type="text" class="mt-1 block w-full" :value="old('ico')"/>
                        <x-form.error class="mt-2" :messages="$errors->get('ico')" />
                    </div>

                    <div>
                        <x-form.label for="dic" :value="__('DIC:')" />
                        <x-form.input id="dic" name="dic" type="text" class="mt-1 block w-full" :value="old('dic')"/>
                        <x-form.error class="mt-2" :messages="$errors->get('dic')" />
                    </div>

                    <div>
                        <x-form.label for="address" :value="__('Address:')" />
                        <x-form.input id="address" name="address" type="text" class="mt-1 block w-full" :value="old('address')" required/>
                        <x-form.error class="mt-2" :messages="$errors->get('address')" />
                    </div>
                </div>
            </x-white-block>
            
            <div class="flex justify-end">
                <x-buttons.primary>{{ __('Save') }}</x-buttons.primary>
            </div>
        </form>
    </div>
</x-app-layout>
