<x-app-layout>
    <x-slot name="navigation">
        <x-form.search :action="route('admin.company.client.index', $company)" :placeholder="__('Search by clients')"/>
        <x-header.menu>
            <x-header.link :href="route('admin.company.client.show', [$company, $client])" :active="request()->routeIs('admin.company.client.show')">
                {{ __('Card') }}
            </x-header.link>
            @if ($client->telegram_chat) 
                <x-header.link :href="route('admin.company.client.telegram.chat', [$company, $client])" :active="request()->routeIs('admin.company.client.telegram.chat')">
                    {{ __('Telegram') }}
                </x-header.link>
            @endif
        </x-header.menu>
    </x-slot>
    
    <x-slot name="header">
        <div class="flex items-center justify-between w-full">
            <div class="flex items-center space-x-2">
                <x-a-buttons.back href="{{ route('admin.company.client.index', $company) }}"/>
                <h2 class="font-semibold text-lg text-gray-800">
                    {{ $client->first_name }} {{ $client->last_name }}
                </h2>
            </div>
            
            <x-a-buttons.create x-data="" x-on:click.prevent="$dispatch('openModal', {modal: 'AppointmentModal', params: {{json_encode(['client_id' => $client->id])}}})">
                {{ __("Add appointment") }}
            </x-a-buttons.create>
        </div>
    </x-slot>

    <livewire:appointment-modal :company="$company"/>

    <div class="py-4 sm:p-4 space-y-6 max-w-6xl m-auto">
        <div class="sm:flex w-full sm:space-x-3 space-y-3 sm:space-y-0">
            <div class="sm:w-1/2 md:w-1/3 space-y-3 lg:sticky lg:top-1 h-min">
                <livewire:client :company="$company" client_id="{{ $client->id }}" />
            </div>
            <div class="sm:w-1/2 md:w-2/3 space-y-3">
                <h1 class="w-full text-2xl font-semibold py-3">
                    All appointments:
                </h1>
                <livewire:client-events :client="$client"/>
            </div>
        </div>
    </div>
</x-app-layout>
