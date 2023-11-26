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
            <x-header.link class="float-right" onclick="showAppointmentModal()">
                <i class="fa-solid fa-circle-plus mr-1 text-indigo-700"></i>
                {{ __("Add appointment") }}
            </x-header.link>
        </x-header.menu>
    </x-slot>
    
    <x-modal.appointment-modal :company="$company"/>

    <div class="flex overflow-auto min-h-full py-4 sm:p-4">
        @forelse ($employees as $employee)
            <div class="min-w-full sm:min-w-0 sm:w-1/2 lg:w-1/4 px-2">
                <div class="p-3 space-y-3 rounded-md bg-gray-100">
                    <div class="flex">
                        <div>
                            <a href="{{ route('admin.company.employee.schedule.index', [$company, $employee]) }}" class="font-semibold text-lg hover:underline hover:text-blue-500">
                                {{ $employee->user->first_name }} {{ $employee->user->last_name }}
                            </a>
                            <p>
                                {{ $employee->user->email }}
                            </p>
                        </div>
                    </div>
                    <hr>

                    <div class="space-y-6">
                        @forelse ($employee->appointments as $appointment)
                            @php
                                $statusClasses = [
                                    'new' => 'blue',
                                    'canceled' => 'red',
                                    'done' => 'green',
                                    'no_done' => 'red',
                                ];
                            
                                $status = $appointment->status;
                                $statusClass = isset($statusClasses[$status]) ? $statusClasses[$status] : 'gray';

                                $defaultClass = " border-l-{$statusClass}-600 hover:bg-{$statusClass}-100 border border-l-4 bg-white px-3 rounded-md w-full shadow-xl hover:scale-105 transform transition-all duration-200";
                                $statusColorClass = $statusClass === 'gray' 
                                    ? "{$defaultClass} ml-6 text-gray-500"
                                    : "$defaultClass";
                            @endphp
                            <button class="w-full rounded-md space-y-2 term flex items-center space-x-3" event="{{ $appointment->resource()->toJson() }}">
                                <div class=" {{ $statusColorClass }}">
                                    <div class="flex items-center space-x-2 py-2 justify-between">
                                        <div class="flex space-x-2">
                                            <p class="font-semibold">
                                                {{ $appointment->term->format('H:i') }}
                                            </p>
                                            @if ($appointment->service)
                                                <x-badge color="{{ $statusClass }}">
                                                    {{ $appointment->service->name }}
                                                </x-badge>
                                            @endif
                                        </div>
                                    </div>
                                    @if ($appointment->client)
                                        <div class="flex py-2">
                                            <div class="text-start">
                                                <a href="" class="font-semibold text-lg hover:underline">
                                                    {{ $appointment->client?->first_name }} {{ $appointment->client?->last_name }}
                                                </a>
                                    
                                                <p class="">
                                                    {{ $appointment->client?->email }}
                                                </p>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </button>
                        @empty
                        @endforelse
                    </div>
                </div>
            </div>
        @empty
        @endforelse
    </div>

    @push('scripts')
        <script type="module">
            $(document).ready(function() {
                $('.term').click(function(){
                    var event = $(this).attr('event');
                    showAppointmentModal(JSON.parse(event));
                });
            });
        </script>
    @endpush
</x-app-layout>