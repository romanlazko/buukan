<div x-data="{ hasChanged: true }">
    @if (isset($client_data['id']))
        <div class="flex items-center space-x-3 ">
            <div class="w-1/4 bg-cover bg-no-repeat aspect-square rounded-full h-min" style="background-image: url({{asset($client_data['avatar'] ?? '/storage/img/public/preview.jpg' )}})"></div>
            <div class="w-3/4 overflow-hidden">
                <p class="w-full text-md font-medium text-gray-900">
                    {{ $client_data['first_name'] ?? null }} {{ $client_data['last_name'] ?? null }}
                </p>
                <p class="text-sm text-gray-500">
                    {{ $client_data['email'] ?? null }}
                </p>
                <p class="text-sm text-gray-500">
                    {{ $client_data['phone'] ?? null }}
                </p>
            </div>
            <div class="text-lg">
                <i class="fa-solid {{$isClientFormOpen ? 'fa-circle-xmark' : 'fa-pen-to-square'}}" wire:click="toggleClientForm" x-on:click="hasChanged = true"></i>
            </div>
        </div>
    @endif

    @if(!isset($client_data['id']) OR $isClientFormOpen)
        <form wire:submit="save" class="space-y-4" >
            <div class="w-full space-y-4">
                <div class="w-full" wire:key="client-first_name-{{$client_id}}">
                    <x-form.label for="first_name" value="{{ __('Name:') }}"/>
                    <x-form.input id="first_name" wire:model.live="client_data.first_name" type="text" class="w-full" required x-on:change="hasChanged = false"/>
                </div>
    
                <div class="w-full" wire:key="client-last_name-{{$client_id}}">
                    <x-form.label for="last_name" value="{{ __('Surname:') }}"/>
                    <x-form.input id="last_name" wire:model.live="client_data.last_name" type="text" class="w-full" x-on:change="hasChanged = false"/>
                </div>
            </div>
    
            <div class="w-full" wire:key="client-email-{{$client_id}}">
                <x-form.label for="email" value="{{ __('Email:') }}"/>
                <x-form.input id="email" wire:model.live="client_data.email" type="email" class="w-full" x-on:change="hasChanged = false"/>
            </div>
    
            <div class="w-full" wire:key="client-phone-{{$client_id}}">
                <x-form.label for="phone" value="{{ __('Phone:') }}"/>
                <x-form.input id="phone" wire:model.live="client_data.phone" type="text" class="w-full" x-on:change="hasChanged = false"/>
            </div>
            <x-buttons.primary x-bind:disabled="hasChanged" >
                {{ __('Save') }}
            </x-buttons.primary>
        </form>
    @endif
</div>

