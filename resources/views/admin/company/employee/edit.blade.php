<x-app-layout>
    <x-slot name="header">
        <div class="sm:flex items-center sm:space-x-3 w-max text-center">
            <x-a-buttons.back href="{{ route('admin.company.employee.show', [$company, $employee]) }}"/>
            <h2 class="font-semibold text-xl text-gray-800">
                {{ $employee->first_name }} {{ $employee->last_name }}
            </h2>
        </div>
        <div>
            
        </div>
    </x-slot>

    <div class="w-full space-y-6 m-auto max-w-2xl py-4">
        <form method="POST" action="{{ route('admin.company.employee.update', [$company, $employee]) }}" enctype='multipart/form-data'>
            @csrf
            @method('PATCH')
            <div class="space-y-6">
                <x-white-block>
                    <div class="flex space-x-4 items-center">
                        <x-form.photo name="avatar" :src="asset($employee->avatar ?? '/storage/img/public/preview.jpg')" class="w-36"/>
                        <div class="space-y-4 w-full">
                            <div>
                                <x-form.label for="last_name" :value="__('Surname:')" />
                                <x-form.input id="last_name" name="last_name" type="text" class="mt-1 block w-full" :value="old('last_name', $employee->user->last_name)" required autocomplete="last_name"/>
                                <x-form.error class="mt-2" :messages="$errors->get('last_name')" />
                            </div>
    
                            <div>
                                <x-form.label for="first_name" :value="__('Name:')" />
                                <x-form.input id="first_name" name="first_name" type="text" class="mt-1 block w-full" :value="old('first_name', $employee->user->first_name)" required autocomplete="first_name" />
                                <x-form.error class="mt-2" :messages="$errors->get('first_name')" />
                            </div>
                        </div>
                    </div>
                </x-white-block>

                <x-white-block>
                    <div>
                        <x-form.label for="email" :value="__('Email')" />
                        <x-form.input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $employee->user->email)" required autocomplete="username" />
                        <x-form.error :messages="$errors->get('email')" class="mt-2" />
                    </div>
                </x-white-block>

                <x-white-block>
                    <div>
                        <x-form.label for="description" :value="__('Description:')" />
                        <x-form.textarea id="description" name="description" class="mt-1 block w-full" :value="old('description', $employee->description)" />
                        <x-form.error class="mt-2" :messages="$errors->get('name')" />
                    </div>
                </x-white-block>

                <x-white-block>
                    <div class="space-y-4">
                        <h2 class="text-lg font-medium text-gray-900">
                            {{ __('Services') }}
                        </h2>
                        <div class="border rounded-md p-3">
                            @foreach ($company->services as $service)
                                <div class="flex space-x-2 items-center py-3 @if(!$loop->last) border-b @endif">
                                    <x-form.label for="{{ $service->slug }}" class="w-full ">
                                        <div class="flex justify-between w-full items-center">
                                            <span>
                                                {{ $service->name }}
                                            </span>
                                            <x-form.checkbox id="{{ $service->slug }}" name="services[]" :value="$service->id" type="checkbox" :checked="old('services[{{$service->id}}]', !$employee->services->where('id', $service->id)->isEmpty())"/>
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
                            {{ __('Roles') }}
                        </h2>
                        <div class="border rounded-md p-3">
                            @foreach ($company->roles as $role)
                                <div class="flex space-x-2 items-center py-3 @if(!$loop->last) border-b @endif">
                                    <x-form.label for="{{ $role->name }}" class="w-full ">
                                        <div class="flex justify-between w-full items-center">
                                            <span>
                                                {{ $role->name }}
                                            </span>
                                            <x-form.checkbox id="{{ $role->name }}" name="roles[]" type="checkbox" :value="$role->id" :checked="old('roles[]', $employee->hasRole($role->name))"/>
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
                                        <x-form.checkbox id="is_available_on_telegram" name="settings[is_available_on_telegram]" type="checkbox" :checked="old('settings[is_available_on_telegram]', $employee->settings->is_available_on_telegram ?? null)"/>
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
                                        <x-form.checkbox id="is_available_on_webapp" name="settings[is_available_on_webapp]" type="checkbox" :checked="old('settings[is_available_on_webapp]', $employee->settings->is_available_on_webapp ?? null)"/>
                                    </div>
                                </x-form.label>
                            </div>
                        </div>
                    </div>
                </x-white-block>
                
                <div class="flex justify-end px-4 sm:px-0">
                    <x-buttons.primary>{{ __('Update') }}</x-buttons.primary>
                </div>
            </div>
        </form>
    </div>
</x-app-layout>
