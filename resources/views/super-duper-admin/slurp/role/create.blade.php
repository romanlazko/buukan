<x-app-layout>
    <x-slot name="header">
        <div class="sm:flex items-center sm:space-x-3 w-max text-center">
            <x-a-buttons.back href="{{ route('super-duper-admin.role.index') }}"/>
            <h2 class="font-semibold text-xl text-gray-800">
                {{ __('Create role:') }}
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
                <x-form.post method="post" action="{{ route('super-duper-admin.role.store') }}">
                    <div>
                        <x-form.label for="name" :value="__('Name:')" />
                        <x-form.input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name')" required autocomplete="name" />
                        <x-form.error class="mt-2" :messages="$errors->get('name')" />
                    </div>

                    <div>
                        <x-form.label for="guard_name" :value="__('Guard Name:')" />
                        <x-form.input id="guard_name" name="guard_name" type="text" class="mt-1 block w-full" :value="old('guard_name')" required autocomplete="guard_name" />
                        <x-form.error class="mt-2" :messages="$errors->get('guard_name')" />
                    </div>

                    @forelse ($permissions as $permission)
                        <div>
                            <x-form.label for="{{ $permission->id }}">
                                <div class="w-full flex items-center space-x-2">
                                    <div class="flex-col">
                                        <x-form.input id="{{ $permission->id }}" name="permissions[]" type="checkbox" value="{{ $permission->id }}"/>
                                    </div>
                                    <div class="flex-col" title="{{ $permission->comment }}">
                                        {{ $permission->name }} 
                                    </div>
                                </div>
                            </x-form.label>
                        </div>
                    @empty
                        
                    @endforelse
                    
                    <div class="flex items-center gap-4">
                        <x-buttons.primary>{{ __('Create') }}</x-buttons.primary>
                    </div>
                </x-form.post>
            </x-white-block>
        </div>
    </div>

</x-app-layout>
