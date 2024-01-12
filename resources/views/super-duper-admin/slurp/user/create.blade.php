<x-app-layout>
    <x-slot name="header">
        <div class="sm:flex items-center sm:space-x-3 w-max text-center">
            <x-a-buttons.back href="{{ route('super-duper-admin.user.index') }}"/>
            <h2 class="font-semibold text-xl text-gray-800">
                {{ __('Create user:') }}
            </h2>
        </div>
        <x-header.menu>
            <x-header.link :href="route('super-duper-admin.user.index')" :active="request()->routeIs('super-duper-admin.user.*')">
                {{ __('User') }}
            </x-header.link>
            <x-header.link :href="route('super-duper-admin.role.index')" :active="request()->routeIs('super-duper-admin.role.*')">
                {{ __('Role') }}
            </x-header.link>
            <x-header.link :href="route('super-duper-admin.permission.index')" :active="request()->routeIs('super-duper-admin.permission.*')">
                {{ __('Permission') }}
            </x-header.link>
        </x-header.menu>
    </x-slot>

    <div class="py-4 sm:p-4">
        <div class="w-full space-y-6 m-auto max-w-2xl">
            <x-white-block>
                <x-form.post method="post" action="{{ route('super-duper-admin.user.store') }}">
                    <div>
                        <x-form.label for="first_name" :value="__('First_name:')" />
                        <x-form.input id="first_name" name="first_name" type="text" class="mt-1 block w-full" :value="old('first_name')" required autofocus autocomplete="first_name" />
                        <x-form.error class="mt-2" :messages="$errors->get('first_name')" />
                    </div>

                    <div>
                        <x-form.label for="last_name" :value="__('Last_name:')" />
                        <x-form.input id="last_name" name="last_name" type="text" class="mt-1 block w-full" :value="old('last_name')" required autofocus autocomplete="last_name" />
                        <x-form.error class="mt-2" :messages="$errors->get('last_name')" />
                    </div>

                    <div>
                        <x-form.label for="email" :value="__('Email:')" />
                        <x-form.input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email')" autocomplete="email" />
                        <x-form.error class="mt-2" :messages="$errors->get('email')" />
                    </div>

                    <div>
                        <x-form.label for="password" :value="__('Password:')" />
                        <x-form.input id="password" name="password" type="password" class="mt-1 block w-full" autocomplete="new-password"/>
                        <x-form.error class="mt-2" :messages="$errors->get('password')" />
                    </div>

                    <div>
                        <x-form.label for="password_confirmation" :value="__('Confirm Password:')" />
                        <x-form.input id="password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full" autocomplete="new-password"/>
                        <x-form.error class="mt-2" :messages="$errors->get('password_confirmation')" />
                    </div>

                    <div class="flex items-center gap-4">
                        <x-buttons.primary>{{ __('Create') }}</x-buttons.primary>
                    </div>
                </x-form.post>
            </x-white-block>
        </div>
    </div>
    
</x-app-layout>