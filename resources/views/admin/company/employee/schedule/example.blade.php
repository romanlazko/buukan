
<x-app-layout>
    <x-slot name="header">
        <div class="sm:flex items-center sm:space-x-3 w-max">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight w-full text-center flex whitespace-nowrap items-center">
                <a class="text-gray-600 hidden lg:grid hover:bg-gray-200 aspect-square mr-5 w-8 rounded-full content-center" href="{{ route('admin.company.employee.show', [$company, $employee]) }}">
                    {{ __('←') }}
                </a>
                <p>
                    {{ $employee->first_name }} {{ $employee->last_name }}
                </p>
            </h2>
            <x-buttons.secondary id="editScheduleButton" class="whitespace-nowrap">
                {{ __("Edit schedule") }}
            </x-buttons.secondary>
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
            <x-header.link class="float-right" x-data="" x-on:click.prevent="$dispatch('openModal', {modal: 'AppointmentModal', params: { type: 'schedule'}})">
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