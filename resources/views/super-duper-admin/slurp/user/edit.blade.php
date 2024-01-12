<x-app-layout>
    <x-slot name="header">
        <div class="sm:flex items-center sm:space-x-3 w-max text-center">
            <x-a-buttons.back href="{{ route('super-duper-admin.user.index') }}"/>
            <h2 class="font-semibold text-xl text-gray-800">
                {{ __('Edit user:') }}
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
                <x-form.post method="patch" action="{{ route('super-duper-admin.user.update', $user) }}">
                    @foreach ($attributes as $attribute)
                        <div>
                            <x-form.label for="{{ $attribute }}" :value="__(ucfirst($attribute).':')" />
                            <x-form.input id="{{ $attribute }}" name="{{ $attribute }}" type="text" class="mt-1 block w-full" :value="old($attribute, $user->$attribute)" required/>
                            <x-form.error class="mt-2" :messages="$errors->get($attribute)" />
                        </div>
                    @endforeach

                    @forelse ($roles as $role)
                        <div>
                            <x-form.label for="{{ $role->id }}">
                                <div class="w-full flex items-center space-x-2">
                                    <div class="flex-col">
                                        <x-form.input id="{{ $role->id }}" name="roles[]" type="checkbox" value="{{ $role->id }}" :checked="$user->hasRole($role)"/>
                                    </div>
                                    <div class="flex-col">
                                        {{ $role->name }} 
                                    </div>
                                </div>
                            </x-form.label>
                        </div>
                    @empty
                        
                    @endforelse

                    <div class="flex items-center gap-4">
                        <x-buttons.primary>{{ __('Update') }}</x-buttons.primary>
                    </div>
                </x-form.post>
            </x-white-block>
        </div>
    </div>
    
</x-app-layout>