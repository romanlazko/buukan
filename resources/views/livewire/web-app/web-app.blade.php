<x-web-app>
    <x-slot name="header">
        <div class="sm:flex items-center sm:space-x-3 w-max">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight w-full text-center">
                {{ $web_app->company->name ?? __('WebApp') }}
            </h2>
        </div>
    </x-slot>

    {{-- @livewire('web-app.'.$steps[$currentStep], ['client' => $client]) --}}
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