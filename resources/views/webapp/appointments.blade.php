<x-web-app>
    <x-slot name="header">
        <div class="w-full flex justify-between items-center">
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
            <div>
                {{ auth('user')->user()->first_name }} {{ auth('user')->user()->last_name }}
            </div>
            <form method="POST" action="{{ route('webapp.logout', $web_app) }}">
				@csrf
				<button type="submit" >
					{{ __('Log Out') }}
				</button>
			</form>
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
                                            {{ $appointment->employee->first_name }} {{ $appointment->employee->last_name }} 
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