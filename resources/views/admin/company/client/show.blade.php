<x-app-layout>
    <x-slot name="header">
        <div class="sm:flex items-center sm:space-x-3 w-max text-center">
            <x-a-buttons.back href="{{ route('admin.company.client.index', $company) }}"/>
            <h2 class="font-semibold text-xl text-gray-800">
                {{ $client->first_name }} {{ $client->last_name }}
            </h2>
        </div>
        <x-header.menu>
            <x-header.link :href="route('admin.company.client.show', [$company, $client])" :active="request()->routeIs('admin.company.client.show')">
                {{ __('Card') }}
            </x-header.link>
            @if ($client->telegram_chat) 
                <x-header.link :href="route('admin.company.client.telegram.chat', [$company, $client])" :active="request()->routeIs('admin.company.client.telegram.chat')">
                    {{ __('Telegram') }}
                </x-header.link>
            @endif
            <x-header.link class="float-right" x-data="" x-on:click.prevent="$dispatch('openModal', {modal: 'AppointmentModal', params: {{json_encode(['client_id' => $client->id])}}})">
                <i class="fa-solid fa-circle-plus mr-1 text-indigo-700"></i>
                {{ __("Add appointment") }}
            </x-header.link>
        </x-header.menu>
    </x-slot>

    <livewire:appointment-modal :company="$company"/>

    <div class="py-4 sm:p-4 space-y-6 max-w-6xl m-auto">
        <div class="sm:flex w-full sm:space-x-8 space-y-3 sm:space-y-0">
            <div class="sm:w-1/2 md:w-1/3 space-y-3">
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
