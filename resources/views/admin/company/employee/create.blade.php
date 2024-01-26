<x-app-layout>
    <x-slot name="navigation">
        <x-form.search :action="route('admin.company.employee.index', $company)" :placeholder="__('Search by employees')"/>
    </x-slot>
    
    <x-slot name="header">
        <div class="flex items-center space-x-2">
            <x-a-buttons.back href="{{ route('admin.company.employee.index', $company) }}"/>
            <h2 class="font-semibold text-lg text-gray-800">
                {{ __('Create employee:') }}
            </h2>
        </div>
    </x-slot>

    <div class="w-full space-y-6 m-auto max-w-2xl py-4">
        <form method="POST" action="{{ route('admin.company.employee.store', $company) }}" enctype='multipart/form-data'>
            @csrf
            <div class="space-y-6">
                <x-white-block>
                    <div class="flex space-x-4 items-center">
                        <x-form.photo name="avatar" :src="asset('img/public/preview.jpg')" class="w-36"/>
                        <div class="space-y-4 w-full">
                            <div class="space-y-4">
                                <div class="w-full">
                                    <x-form.label for="first_name" :value="__('Name:')" />
                                    <x-form.input id="first_name" name="first_name" type="text" class="block w-full" :value="old('first_name')" required autocomplete="first_name" />
                                    <x-form.error class="mt-2" :messages="$errors->get('first_name')" />
                                </div>
                                <div class="w-full">
                                    <x-form.label for="last_name" :value="__('Surname:')" />
                                    <x-form.input id="last_name" name="last_name" type="text" class="block w-full" :value="old('last_name')" required autocomplete="last_name"/>
                                    <x-form.error class="mt-2" :messages="$errors->get('last_name')" />
                                </div>
                            </div>
                        </div>
                    </div>
                </x-white-block>

                <x-white-block>
                    <div>
                        <x-form.label for="email" :value="__('Email')" />
                        <x-form.input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
                        <x-form.error :messages="$errors->get('email')" class="mt-2" />
                    </div>
                </x-white-block>
                
                <x-white-block>
                    <div>
                        <x-form.label for="description" :value="__('Description:')" />
                        <x-form.textarea id="description" name="description" class="mt-1 block w-full" :value="old('description')" />
                        <x-form.error class="mt-2" :messages="$errors->get('description')" />
                    </div>
                </x-white-block>

                @if ($company->telegram_bots->isNotEmpty())
                    <x-white-block>
                        <div class="space-y-4">
                            <x-form.label for="telegram_chat" :value="__('Telegram chat:')" />
                            <x-form.select id="telegram_chat" name="telegram_chat" class="w-full">
                                <option value="">Select telegram chat</option>
                                @foreach ($company->telegram_bots()->first()->chats()->where('role', 'admin')->get() as $admin)
                                    <option value="{{ $admin->id }}">{{ $admin->first_name }} {{ $admin->last_name }}</option>
                                @endforeach
                            </x-form.select>
                            <x-form.error class="mt-2" :messages="$errors->get('telegram_chat')" />
                        </div>
                    </x-white-block>
                @endif
                
                @if ($company->services->isNotEmpty())
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
                                                <x-form.checkbox id="{{ $service->slug }}" name="services[]" :value="$service->id" type="checkbox" :checked="old('services[{{$service->id}}]')"/>
                                            </div>
                                        </x-form.label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </x-white-block>
                @endif

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
                                            <x-form.checkbox id="{{ $role->name }}" name="roles[]" type="checkbox" :value="$role->id" :checked="old('roles[]')"/>
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
