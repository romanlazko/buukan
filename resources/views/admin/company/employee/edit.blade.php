
<x-app-layout>
    <x-slot name="header">
        <div class="sm:flex items-center sm:space-x-3 w-max">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight w-full text-center">
                {{ __('Edit employee:') }}
            </h2>
        </div>
        <x-header.menu>
            <x-header.link :href="route('admin.company.employee.index', $company)" :active="request()->routeIs('admin.company.employee.index')">
                {{ __('Employees') }}
            </x-header.link>
            <x-header.link href="{{ route('admin.company.employee.create', $company) }}" :active="request()->routeIs('admin.company.employee.create')">
                {{ __("✚ Create employee") }}
            </x-header.link>
        </x-header.menu>
    </x-slot>

    <div class="w-full space-y-6 m-auto max-w-2xl py-4">
        <form method="POST" action="{{ route('admin.company.employee.update', [$company, $employee]) }}" enctype='multipart/form-data'>
            @csrf
            @method('PATCH')
            <div class="space-y-6">
                <x-white-block>
                    <div class="space-y-4 sm:flex sm:space-x-4 sm:space-y-0">
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
                            <div>
                                <x-form.label for="email" :value="__('Email')" />
                                <x-form.input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $employee->user->email)" required autocomplete="username" />
                                <x-form.error :messages="$errors->get('email')" class="mt-2" />
                            </div>
                        </div>
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
                            {{ __('Schedule type') }}
                        </h2>
                        <div class="border rounded-md p-3">
                            @forelse (App\Models\ScheduleType::all() as $schedule_type)
                                <div class="flex space-x-2 items-center py-3 @if(!$loop->last) border-b @endif">
                                    <x-form.label for="{{ $schedule_type->name }}" class="w-full ">
                                        <div class="flex justify-between w-full items-center">
                                            <span>
                                                {{ $schedule_type->name }}
                                            </span>
                                            <x-form.radio id="{{ $schedule_type->name }}" name="schedule_model" value="{{ $schedule_type->id }}" :checked="old('schedule', $employee->schedule_model)"/>
                                        </div>
                                    </x-form.label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </x-white-block>
                
                <div class="flex justify-end">
                    <x-buttons.primary>{{ __('Update') }}</x-buttons.primary>
                </div>
            </div>
        </form>
    </div>
</x-app-layout>
