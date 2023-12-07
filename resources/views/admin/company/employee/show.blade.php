<x-app-layout>
    <x-slot name="header">
        <div class="sm:flex items-center sm:space-x-3 w-max">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight w-full text-center flex whitespace-nowrap items-center">
                <a class="text-gray-600 hidden lg:grid hover:bg-gray-200 aspect-square mr-5 w-8 rounded-full content-center" href="{{ route('admin.company.employee.index', $company) }}">
                    {{ __('←') }}
                </a>
                <p>
                    {{ $employee->first_name }} {{ $employee->last_name }}
                </p>
            </h2>
        </div>
        <x-header.menu>
            <x-header.link :href="route('admin.company.employee.show', [$company, $employee])" :active="request()->routeIs('admin.company.employee.show')">
                {{ __('Card') }}
            </x-header.link>
            <x-header.link href="{{ route('admin.company.employee.schedule.index', [$company, $employee]) }}" :active="request()->routeIs('admin.company.employee.schedule.index')">
                {{ __("Callendar") }}
            </x-header.link>
            <x-header.link href="{{ route('admin.company.employee.schedule.example', [$company, $employee]) }}" :active="request()->routeIs('admin.company.employee.schedule.example')">
                {{ __("Example Callendar") }}
            </x-header.link>
            <x-header.link class="float-right" x-data="" x-on:click.prevent="$dispatch('openModal', {modal: 'AppointmentModal', params: {{json_encode(['employee_id' => $employee->id])}}})">
                <i class="fa-solid fa-circle-plus mr-1 text-indigo-700"></i>
                {{ __("Add appointment") }}
            </x-header.link>
        </x-header.menu>
    </x-slot>

    <livewire:appointment-modal :company="$company"/>

    <div class="py-4 sm:p-4 space-y-6 max-w-6xl m-auto">
        <div class="sm:flex w-full sm:space-x-6 space-y-3 sm:space-y-0">
            <div class="sm:w-1/2 md:w-1/3 space-y-3">
                <div class="block space-y-3 sm:space-x-0 items-center sm:bg-white rounded-lg p-4">
                    <div class="w-20 bg-cover bg-no-repeat aspect-square rounded-full h-min m-auto" style="background-image: url({{asset($employee->avatar)}})"></div>
                    <div class="m-auto text-center">
                        <h2 class="text-xl font-bold w-full">
                            {{ $employee->first_name }} {{ $employee->last_name }}
                        </h2>
                        <p class="text-sm text-gray-500">
                            {{ $employee->user->email }}
                        </p>
                        @forelse ($employee->user->roles as $role)
                            <x-badge color="green">
                                {{ $role->name }}
                            </x-badge>
                        @empty
                            
                        @endforelse

                        @forelse ($employee->roles as $role)
                            <x-badge color="green">
                                {{ $role->name }}
                            </x-badge>
                        @empty
                            
                        @endforelse
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
                            <div class="border-l-4 px-2 py-1 w-full flex hover:scale-105 hover:shadow-sm rounded-md transform transition-all duration-200" style="border-color: {{$service->color}}">
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
                            {{-- <x-badge color="{{ $service->color }}" >
                                <a href="{{ route('admin.company.service.edit', [$company, $service]) }}" class="whitespace-nowrap" title="{{ $service->description }}">{{ $service->name }}</a>
                            </x-badge> --}}
                        @empty
                            
                        @endforelse
                    </div>
                    
                </x-white-block>
                
                
                <div class="w-full items-center justify-center">
                    <a href="{{ route('admin.company.employee.edit', [$company, $employee]) }}" class="block m-auto w-min whitespace-nowrap text-sm text-gray-500 hover:bg-indigo-700 hover:text-white p-3 rounded-lg">
                        <i class="fa-solid fa-pen-to-square sm:mr-1"></i>
                        Edit employee
                    </a>
                </div>
            </div>
            <div class="sm:w-1/2 md:w-2/3 space-y-3">
                <x-white-block class="p-3">
                    <form action="{{ route('admin.company.employee.show', [$company, $employee]) }}" class="w-full" id="appointmentDateForm">
                        <x-form.input name="date" type="date" onchange="$('#appointmentDateForm').submit()" class="w-full" value="{{request('date', now()->format('Y-m-d'))}}"/>
                    </form>
                </x-white-block>
                <div class="min-w-full">
                    <div class="p-3 space-y-3 rounded-md">
                        <div class="space-y-6">
                            @forelse ($employee->appointments as $appointment)
                                <x-appointment.block :appointment="$appointment" x-on:click.prevent="$dispatch('openModal', {modal: 'AppointmentModal', params: {{ $appointment->resource->toJson()}}})"/>
                            @empty
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
