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
            Choose service: 
        </h1>

        <div class="w-full space-y-6">
            @foreach ($services as $service)
                <div wire:key="service-{{ $service->id }}" class="flex items-center space-x-2">
                    <input wire:model.live="serviceId" type="radio" id="{{ $service->slug }}" class="peer/{{ $service->slug }}" name="service" slug="{{ $service->slug }}" value="{{ $service->id }}">
                    <x-form.label for="{{ $service->slug }}" class="w-full bg-white rounded-lg border-2 peer-checked/{{ $service->slug }}:border-blue-400 overflow-hidden" >
                        <div class="flex justify-between items-center" >
                            <div class="flex w-full">
                                <div class="flex w-full p-4 items-center space-x-4">
                                    <div class="w-full">
                                        <p class="w-full text-xl font-medium text-gray-900" >
                                            {{ $service->name ?? null }}
                                        </p>
                                        <p class="w-full text-sm font-light">
                                            {{ $service->description ?? null }}
                                        </p>
                                    </div>
                                    <div>
                                        
                                        <p class="w-full text-lg font-medium text-gray-900">
                                            @if (isset($service->settings->is_price_from))
                                                from: 
                                            @endif
                                            {{ $service->price ?? null }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </x-form.label>
                </div>
            @endforeach
        </div>
        @if ($web_app->company->sub_services->isNotEmpty())
            <h1 class="p-4 text-white bg-gray-800 rounded-lg sticky top-1 text-2xl font-bold shadow">
                Choose sub service: 
            </h1>

            <div class="w-full space-y-6">
                @foreach ($sub_services as $service)
                    <div wire:key="service-{{ $service->id }}" class="flex items-center space-x-2">
                        <input wire:model="sub_services_ids" type="checkbox" id="{{ $service->slug }}" class="peer/{{ $service->slug }}" name="sub_services_ids[]" slug="{{ $service->slug }}" value="{{ $service->id }}">
                        <x-form.label for="{{ $service->slug }}" class="w-full bg-white rounded-lg border-2 peer-checked/{{ $service->slug }}:border-blue-400 overflow-hidden" >
                            <div class="flex justify-between items-center" >
                                <div class="flex w-full">
                                    <div class="flex w-full p-4 items-center space-x-4">
                                        <div class="w-full">
                                            <p class="w-full text-xl font-medium text-gray-900" >
                                                {{ $service->name ?? null }}
                                            </p>
                                            <p class="w-full text-sm font-light">
                                                {{ $service->description ?? null }}
                                            </p>
                                        </div>
                                        <div>
                                            <p class="w-full text-lg font-medium text-gray-900">
                                                @if (isset($service->settings->is_price_from))
                                                    from: 
                                                @endif
                                                {{ $service->price ?? null }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </x-form.label>
                    </div>
                @endforeach
            </div>
        @endif
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
                <x-buttons.primary wire:click="nextStep" class="w-full" :disabled="$serviceId == null">
                    <div class="w-full text-center p-3">
                        Continue
                    </div>
                </x-buttons.primary>
            </div>
        </div>
    </x-slot>
</x-web-app>