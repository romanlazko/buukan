<x-app-layout>
    <x-slot name="header">
        <div class="sm:flex items-center sm:space-x-3 w-max text-center">
            <x-a-buttons.back href="{{ route('super-duper-admin.permission.index') }}"/>
            <h2 class="font-semibold text-xl text-gray-800">
                {{ __('Create permission:') }}
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
                <x-form.post method="post" action="{{ route('super-duper-admin.permission.store') }}">
                    <div>
                        <x-form.label for="name" :value="__('Name:')" />
                        <x-form.input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name')" required autofocus autocomplete="name" />
                        <x-form.error class="mt-2" :messages="$errors->get('name')" />
                    </div>

                    <div>
                        <x-form.label for="guard_name" :value="__('Guard Name:')" />
                        <x-form.input id="guard_name" name="guard_name" type="text" class="mt-1 block w-full" :value="old('guard_name')" required autocomplete="guard_name" />
                        <x-form.error class="mt-2" :messages="$errors->get('guard_name')" />
                    </div>

                    <div>
                        <x-form.label for="comment" :value="__('Comment:')" />
                        <x-form.input id="comment" name="comment" type="text" class="mt-1 block w-full" :value="old('comment')" autocomplete="comment" />
                        <x-form.error class="mt-2" :messages="$errors->get('comment')" />
                    </div>

                    <div class="flex items-center gap-4">
                        <x-buttons.primary>{{ __('Create') }}</x-buttons.primary>
                    </div>
                </x-form.post>
            </x-white-block>
        </div>
    </div>

</x-app-layout>
