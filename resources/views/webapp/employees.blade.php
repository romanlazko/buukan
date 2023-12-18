<x-web-app>
    <x-slot name="header">
        <div class="flex items-center">
            <div class="flex-col items-center my-auto">
                <img src="{{ asset($web_app->company->logo) }}" alt="Logo" class="mr-4 w-12 h-12 min-w-[48px] rounded-full">
            </div>
            <div class="flex-col justify-center">
                <p class="w-full text-md font-medium text-gray-900">
                    {{ $web_app->company->name ?? null }}
                </p>
                <p class="w-full text-sm font-light text-gray-500 mb-1">
                    {{ $web_app->company->description ?? null }}
                </p>
            </div>
        </div>
    </x-slot>

    <div class="space-y-6">
        <h1 class="p-4 text-white bg-gray-800 rounded-lg sticky top-1 text-2xl font-bold shadow">
            Choose employee:
        </h1>

        <div class="w-full space-y-6">
            @forelse ($employees as $employee)
            <div wire:key="employee-{{$employee->id}}" class="flex items-center space-x-2">
        
                <input wire:model.live="employeeId" type="radio" name="employee" id="{{ $employee->slug }}" class="peer/{{ $employee->slug }}" value="{{ $employee->id }}">
                <x-form.label for="{{ $employee->slug }}" class="w-full bg-white rounded-lg border-2 peer-checked/{{ $employee->slug }}:border-blue-400 overflow-hidden" >
                    <div class="flex justify-between items-center" >
                        <div class="flex w-full">
                            <div class="bg-cover bg-no-repeat bg-center w-36" style="background-image: url('{{ asset($employee->avatar) }}')">
                            </div>
                            <div class="flex w-full p-4 items-center space-x-4">
                                <div class="w-full">
                                    <p class="w-full text-xl font-medium text-gray-900" >
                                        {{ $employee->first_name ?? null }} {{ $employee->last_name ?? null }}
                                    </p>
                                    <p class="w-full text-sm font-light">
                                        {{ $employee->description ?? null }}
                                    </p>
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
        <div class="space-x-4 flex w-full">
            <div>
                <x-a-buttons.primary wire:click="prevStep">
                    <div class="w-full text-center p-3">
                        ←
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
        </div>
    </x-slot>
</x-web-app>