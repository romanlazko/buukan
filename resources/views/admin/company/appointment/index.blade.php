<x-app-layout>
    <x-slot name="navigation">
        <form action="{{ route('admin.company.appointment.index', $company) }}" class="w-min" id="appointmentDateForm">
            <x-form.input name="date" type="date" onchange="$('#appointmentDateForm').submit()" class="w-full" value="{{request('date', now()->format('Y-m-d'))}}"/>
        </form>
    </x-slot>

    <x-slot name="header">
        <div class="flex items-center justify-between w-full">
            <h2 class="font-semibold text-xl text-gray-800">
                {{ __('Appointments:') }}
            </h2>
            <x-a-buttons.create x-data="" x-on:click.prevent="$dispatch('openModal', {modal: 'AppointmentModal', params: {{json_encode(['date' => request('date', now()->format('Y-m-d'))])}}})">
                {{ __("Add appointment") }}
            </x-a-buttons.create>
        </div>
    </x-slot>

    <livewire:event.edit-event-modal/>
    <livewire:appointment-modal :company="$company"/>

    <div class="flex overflow-auto min-h-full py-4 sm:p-4">
        @forelse ($employees as $employee)
            <div class="min-w-full sm:min-w-0 sm:w-1/2 lg:w-1/3 xl:w-1/4 px-2">
                <div class="p-3 space-y-3 rounded-md bg-gray-100">
                    <div class="flex items-center space-x-3">
                        <img class="aspect-square rounded-full object-cover max-w-[60px]" src="{{ asset($employee->avatar) }}" alt="">
                        <div class="w-full overflow-hidden">
                            <a href="{{ route('admin.company.employee.schedule.index', [$company, $employee]) }}" class="w-full text-md font-medium text-gray-900 hover:underline">
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