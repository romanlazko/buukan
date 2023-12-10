<x-app-layout>
    <x-slot name="header">
        <div class="sm:flex items-center sm:space-x-3 w-max">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight w-full text-center">
                {{ __('Appointments:') }}
            </h2>
            <form action="{{ route('admin.company.appointment.index', $company) }}" class="w-full" id="appointmentDateForm">
                <x-form.input name="date" type="date" onchange="$('#appointmentDateForm').submit()" class="w-full" value="{{request('date', now()->format('Y-m-d'))}}"/>
            </form>
        </div>
        <x-header.menu>
            <x-header.link class="float-right" x-data="" x-on:click.prevent="$dispatch('openModal', {modal: 'AppointmentModal', params: {{json_encode(['date' => request('date', now()->format('Y-m-d'))])}}})">
                <i class="fa-solid fa-circle-plus mr-1 text-indigo-700"></i>
                {{ __("Add appointment") }}
            </x-header.link>
        </x-header.menu>
    </x-slot>
    
    <livewire:appointment-modal :company="$company"/>

    <div class="flex overflow-auto min-h-full py-4 sm:p-4">
        @forelse ($employees as $employee)
            <div class="min-w-full sm:min-w-0 sm:w-1/2 lg:w-1/3 xl:w-1/4 px-2">
                <div class="p-3 space-y-3 rounded-md bg-gray-100">
                    <div class="flex items-center space-x-3 ">
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
                        </div>
                    </div>
                    <hr>
                    <livewire:employee-events :employee="$employee" :date="request('date', now()->format('Y-m-d'))"/>
                </div>
            </div>
        @empty
        @endforelse
    </div>
</x-app-layout>