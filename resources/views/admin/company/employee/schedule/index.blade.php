<x-app-layout>
    <x-slot name="navigation">
        <x-form.search :action="route('admin.company.employee.index', $company)" :placeholder="__('Search by employees')"/>
        <x-header.menu>
            <x-header.link :href="route('admin.company.employee.show', [$company, $employee])" :active="request()->routeIs('admin.company.employee.show')">
                {{ __('Card') }}
            </x-header.link>
            <x-header.link href="{{ route('admin.company.employee.schedule.index', [$company, $employee]) }}" :active="request()->routeIs('admin.company.employee.schedule.index')">
                {{ __("Callendar") }}
            </x-header.link>
        </x-header.menu>
    </x-slot>
    
    <x-slot name="header">
        <div class="flex items-center justify-between w-full">
            <div class="flex items-center space-x-2">
                <x-a-buttons.back href="{{ route('admin.company.employee.index', $company) }}"/>
                <h2 class="font-semibold text-lg text-gray-800">
                    {{ $employee->first_name }} {{ $employee->last_name }}
                </h2>
            </div>
            
            <x-a-buttons.create x-data="" x-on:click.prevent="$dispatch('openModal', {modal: 'AppointmentModal', params: {{json_encode(['employee_id' => $employee->id])}}})">
                {{ __("Add appointment") }}
            </x-a-buttons.create>
        </div>
    </x-slot>
        
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js'></script>

    <div class="w-fullrounded-xl">
        <livewire:calendar :employee="$employee">
    </div>
</x-app-layout>