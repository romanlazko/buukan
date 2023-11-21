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
            Choose service:
        </h1>

        <div class="w-full space-y-6">
            @foreach ($services as $service)
                <div wire:key="service-{{ $service->id }}" class="flex items-center space-x-2">
                    <input type="radio" id="{{ $service->slug }}" class="peer/{{ $service->slug }} peer/service" name="service" slug="{{ $service->slug }}" value="{{ $service->id }}">
                    <x-form.label for="{{ $service->slug }}" class="w-full bg-white rounded-lg border-2 peer-checked/{{ $service->slug }}:border-blue-500 overflow-hidden" >
                        <div class="flex justify-between items-center" >
                            <div class="flex">
                                <div class="bg-cover bg-no-repeat bg-center w-36 bg-[url('{{ asset($service->img) }}')]">
                                </div>
                                <div class="flex w-full p-4 items-center space-x-4">
                                    <div>
                                        <p class="w-full text-xl font-medium text-gray-900" >
                                            {{ $service->name ?? null }}
                                        </p>
                                        <p class="w-full text-sm font-light">
                                            {{ $service->description ?? null }}
                                        </p>
                                    </div>
                                    <div>
                                        <p class="w-full text-lg font-medium text-gray-900">
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
            <x-buttons.primary wire:click="nextStep" class="w-full" >
                <div class="w-full text-center p-3">
                    Continue
                </div>
            </x-buttons.primary>
        </div>
    </x-slot>
</x-web-app>