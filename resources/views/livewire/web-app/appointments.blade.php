<x-web-app>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-2xl">
                {{ $web_app->company->name }}
            </h2>
        </div>
    </x-slot>

    <div class="space-y-6">
        <h1 class="p-4 text-white bg-gray-800 rounded-lg text-2xl font-bold shadow sticky top-1">
            Appointments:
        </h1>
        
        <div class="w-full space-y-6">
            @forelse ($appointments as $appointment)
                <div wire:key="appointment-{{$appointment->id}}" class="space-y-1">
                    <div class="flex space-x-1 overflow-auto">
                        <x-badge color="{{$appointment->service->color}}">
                            {{$appointment->service->name}}
                        </x-badge>
                        @foreach ($appointment->subServices as $service)
                            <x-badge color="{{$service->color}}">
                                {{$service->name}}
                            </x-badge>
                        @endforeach
                    </div>
                    <x-white-block class="p-0" >
                        <div class="flex justify-between">
                            <div class="w-full p-4 space-y-2">
                                <div class="flex items-center">
                                    <div class="w-full space-y-2">
                                        <p class="font-bold text-xl">
                                            {{ $appointment->date->format('d.m(D)') }} {{ $appointment->term->format('H:s') }} 
                                        </p>
                                        <p class="text-sm font-light">
                                            {{ $appointment->employee->user->first_name }} {{ $appointment->employee->user->last_name }} 
                                        </p>
                                        <p class="font-bold text-md">
                                            Total price: {{ $appointment->total_price }}
                                        </p>
                                    </div>
                                    <div>
                                        <x-a-buttons.button class="bg-red-600 text-white hover:bg-red-500 active:bg-red-700" wire:click="cancel({{$appointment->id}})" wire:confirm="Are you sure">
                                            {{ __('Cancel') }}
                                        </x-a-buttons.button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </x-white-block>
                </div>
            @empty
            @endforelse
        </div>
    </div>

    <x-slot name="footer">
        <div class="w-full">
            <x-buttons.primary wire:click="nextStep" class="w-full" :disabled="$appointments->count() >= $web_app->settings->max_active_appointments">
                <div class="w-full text-center p-3" >
                    Create new appointment
                </div>
            </x-buttons.primary>
        </div>
    </x-slot>
</x-web-app>