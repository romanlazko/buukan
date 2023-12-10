<x-app-layout>
    <x-slot name="header">
        <div class="sm:flex items-center sm:space-x-3 w-max text-center">
            <x-a-buttons.back href="{{ route('admin.company.employee.show', [$company, $employee]) }}"/>
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
        
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js'></script>

    <div class="w-full py-6 bg-white">
        <livewire:calendar :employee="$employee">
    </div>
</x-app-layout>