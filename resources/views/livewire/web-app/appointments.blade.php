<x-web-app>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            {{-- <img id="photoPreview" src="{{ asset($web_app->company->logo) }}" class="w-36"> --}}
            {{ $web_app->company->name }}
        </div>
        <div>
            CZ
        </div>
    </x-slot>

    <div class="space-y-6">
        <h1 class="p-4 text-white bg-gray-800 rounded-lg text-2xl font-bold shadow">
            Appointments:
        </h1>
        
        <div class="w-full space-y-6">
            @forelse ($appointments as $appointment)
                <div wire:key="appointment-{{$appointment->id}}" class="space-y-1">
                    <div class="flex space-x-1">
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
                            @if ($appointment->service->img)
                                <div class="bg-cover bg-no-repeat bg-center w-36" style="background-image: url('{{ asset($appointment->service->img) }}')">
                                </div>
                            @endif
                            
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
                                            Total price: {{ $appointment->service->price + $appointment->subServices->sum('price') }}
                                        </p>
                                    </div>
                                    <div>
                                        <x-a-buttons.delete wire:click="destroy({{$appointment->id}})">
                                            {{ __('Cancel') }}
                                        </x-a-buttons.delete>
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
            <x-buttons.primary wire:click="nextStep" class="w-full">
                <div class="w-full text-center p-3">
                    Create new appointment
                </div>
            </x-buttons.primary>
        </div>
    </x-slot>
</x-web-app>