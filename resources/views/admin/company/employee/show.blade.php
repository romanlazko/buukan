<x-app-layout>
    <x-slot name="header">
        <div class="sm:flex items-center sm:space-x-3 w-max text-center">
            <x-a-buttons.back href="{{ route('admin.company.employee.index', $company) }}"/>
            <h2 class="font-semibold text-xl text-gray-800">
                {{ $employee->first_name }} {{ $employee->last_name }}
            </h2>
        </div>
        <x-header.menu>
            <x-header.link :href="route('admin.company.employee.show', [$company, $employee])" :active="request()->routeIs('admin.company.employee.show')">
                {{ __('Card') }}
            </x-header.link>
            <x-header.link href="{{ route('admin.company.employee.schedule.index', [$company, $employee]) }}" :active="request()->routeIs('admin.company.employee.schedule.index')">
                {{ __("Callendar") }}
            </x-header.link>
            <x-header.link class="float-right" x-data="" x-on:click.prevent="$dispatch('openModal', {modal: 'AppointmentModal', params: {{json_encode(['employee_id' => $employee->id])}}})">
                <i class="fa-solid fa-circle-plus mr-1 text-indigo-700"></i>
                {{ __("Add appointment") }}
            </x-header.link>
        </x-header.menu>
    </x-slot>

    <livewire:event.edit-event-modal :employee="$employee"/>

    <livewire:appointment-modal :company="$company"/>

    <div class="py-4 sm:p-4 space-y-6 max-w-6xl m-auto">
        <div class="sm:flex w-full sm:space-x-6 space-y-3 sm:space-y-0">
            <div class="sm:w-1/2 md:w-1/3 space-y-3">
                <div class="flex items-center space-x-3 rounded-lg bg-white p-3">
                    <div class="w-1/4 bg-cover bg-no-repeat aspect-square rounded-full h-min" style="background-image: url({{ asset($employee->avatar) }})"></div>
                    <div class="w-3/4 overflow-hidden">
                        <a href="{{ route('admin.company.employee.show', [$company, $employee]) }}" class="w-full text-md font-medium text-gray-900 hover:underline">
                            {{ $employee->first_name }} {{ $employee->last_name }}
                        </a>
                        <p class="text-sm text-gray-500">
                            {{ $employee->email }}
                        </p>
                        <p class="text-sm text-gray-500">
                            {{ $employee->phone }}
                        </p>
                        @forelse ($employee->admin->roles as $role)
                            <x-badge color="green">
                                {{ $role->name }}
                            </x-badge>
                        @empty
                            
                        @endforelse
                    </div>
                    <div class="text-lg">
                        <a href="{{ route('admin.company.employee.edit', [$company, $employee]) }}"  wire:click="toggleClientForm" x-on:click="hasChanged = true">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>
                    </div>
                </div>
                <h3 class="text-md font-bold">
                    {{ __('Description:') }}
                </h3>
                <x-white-block>
                    <p class="text-sm text-gray-500">
                        {{ $employee->description }}
                    </p>
                </x-white-block>
                <h3 class="text-md font-bold">
                    {{ __('Services:') }}
                </h3>
                <x-white-block>
                    <div class="space-y-2">
                        @forelse ($employee->services as $service)
                            <div class="w-full flex hover:bg-gray-100 hover:shadow-sm rounded-md transform transition-all duration-200">
                                <div class="w-2/3">
                                    <a href="{{ route('admin.company.service.edit', [$company, $service]) }}" class="text-sm font-semibold "  title="{{ $service->description }}">{{ $service->name }}</a>
                                    <p class="text-gray-500 text-xs">
                                        {{ $service->description }}
                                    </p>
                                </div>
                                <div class="w-1/3 text-right">
                                    <p class="text-gray-500 text-xs">
                                        {{ $service->price }}
                                    </p>
                                </div>
                            </div>
                            @if(!$loop->last) <hr> @endif
                        @empty
                            
                        @endforelse
                    </div>
                </x-white-block>
            </div>
            <div class="sm:w-1/2 md:w-2/3 space-y-3">
                <x-white-block class="p-3">
                    <form action="{{ route('admin.company.employee.show', [$company, $employee]) }}" class="w-full" id="appointmentDateForm">
                        <x-form.input name="date" type="date" onchange="$('#appointmentDateForm').submit()" class="w-full" value="{{request('date', now()->format('Y-m-d'))}}"/>
                    </form>
                </x-white-block>
                <livewire:employee-events :employee="$employee" :date="request('date')"/>
            </div>
        </div>
    </div>
</x-app-layout>
