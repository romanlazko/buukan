<x-web-app>
    <x-slot name="header">
        <div class="sm:flex items-center sm:space-x-3 w-max">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight w-full text-center">
                {{ $web_app->company->name ?? __('WebApp') }}
            </h2>
        </div>
    </x-slot>
    <div class="space-y-6">
        <h1 class="p-4 text-white bg-gray-800 rounded-lg sticky top-1 text-2xl font-bold shadow">
            Choose employee:
        </h1>

        <div class="w-full space-y-6">
            @forelse ($employees as $employee)
            <div wire:key="employee-{{$employee->id}}" class="flex items-center space-x-2">
        
                <input wire:model.live="employeeId" type="radio" name="employee" id="{{ $employee->user->first_name }}" class="peer/{{ $employee->user->first_name }}" value="{{ $employee->id }}">
        
                <x-form.label for="{{ $employee->user->first_name }}" class="w-full bg-white border-2 rounded-lg p-4 sm:p-8 peer-checked/{{ $employee->user->first_name }}:border-blue-500">
                    <div class="flex justify-between items-center">
                        <div class="flex items-center">
                            <div class="flex-col items-center my-auto">
                                <img src="{{ $employee->photo ?? null }}" alt="Avatar" class="mr-4 w-12 h-12 min-w-[48px] rounded-full">
                            </div>
                            <div class="flex-col justify-center">
                                <div>
                                    <a href="" class="w-full text-md font-medium text-gray-900">
                                        {{ $employee->user->first_name ?? null }} {{ $employee->user->last_name ?? null }}
                                    </a>
                                </div>
                                <div>
                                    <a class="w-full text-sm font-light" href="">
                                        {{ $employee->description ?? null }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </x-form.label>
            </div>
            @empty
                
            @endforelse
        </div>
    </div>

    <x-slot name="footer">
        <div>
            <x-a-buttons.primary wire:click="prevStep">
                <div class="w-full text-center p-3">
                    <
                </div>
            </x-a-buttons.primary>
        </div>
        <div class="w-full">
            <x-buttons.primary wire:key="employee-continue-button" wire:click="nextStep" class="w-full" :disabled="$employeeId == null">
                <div class="w-full text-center p-3">
                    Continue
                </div>
            </x-buttons.primary>
        </div>
    </x-slot>
</x-web-app>