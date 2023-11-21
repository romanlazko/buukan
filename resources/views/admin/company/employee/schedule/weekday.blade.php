<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div class="flex items-center space-x-2">
                <x-a-buttons.secondary href="{{ route('admin.company.employee.index', $company) }}" title="Back to employees">
                    ←
                </x-a-buttons.secondary>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ $employee->user->first_name}} {{ $employee->user->last_name}}:
                </h2>
            </div>
            
            <div class="flex space-x-2">
            </div>
            <div class="w-min space-x-4 sm:-my-px sm:ml-10 flex">
                <button id="createWeekdayScheduleModalButton" x-data="" x-on:click.prevent="$dispatch('open-modal', 'createWeekdayScheduleModal')">
                    {{ __('+') }}
                </button>
            </div>
        </div>
    </x-slot>
    <x-modal name="createWeekdayScheduleModal">
        <div class="relative">
            <form method="post" action="{{ route('admin.company.employee.schedule.store', [$company, $employee]) }}" class="p-6" id="createWeekdayScheduleModalForm">
                @csrf

                <div class="w-full">
                    <div class="w-full">
                        <x-input-label for="weekday" value="{{ __('Day:') }}"/>
                        <x-form.select name="weekday" class="w-full">
                            <option value="1">Monday</option>
                            <option value="2">Tuesday</option>
                            <option value="3">Wednesday</option>
                            <option value="4">Thursday</option>
                            <option value="5">Friday</option>
                            <option value="6">Saturday</option>
                            <option value="7">Sunday</option>
                        </x-form.select>
                        <x-input-error :messages="$errors->get('term')" class="mt-2" />
                    </div>
                    <div class="w-full" >
                        <x-input-label for="start_time" value="{{ __('From:') }}"/>
                        <x-text-input id="start_time" name="start_time" type="time" class="w-full" value="{{ old('start_time', now()->format('H:s')) }}"/>
                    </div>
                    <div class="w-full" >
                        <x-input-label for="end_time" value="{{ __('To:') }}"/>
                        <x-text-input id="end_time" name="end_time" type="time" class="w-full" value="{{ old('end_time', now()->format('H:s')) }}"/>
                    </div>
                </div>
            </form>

            <hr>

            <div class="flex justify-end w-full p-6">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Close') }}
                </x-secondary-button>
    
                <x-primary-button class="ml-3" onclick="$('#createWeekdayScheduleModalForm').submit()">
                    {{ __('Save') }}
                </x-primary-button>
            </div>
        </div>
    </x-modal>
</x-app-layout>