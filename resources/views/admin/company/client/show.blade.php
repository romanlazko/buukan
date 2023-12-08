<x-app-layout>
    <x-slot name="header">
        <div class="sm:flex items-center sm:space-x-3 w-max text-center">
            <a class="font-semibold text-xl text-gray-600 hidden lg:grid hover:bg-gray-200 aspect-square w-8 rounded-full content-center text-center" href="{{ route('admin.company.client.index', $company) }}">
                {{ __('←') }}
            </a>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $client->first_name }} {{ $client->last_name }}
            </h2>
        </div>
        <x-header.menu>
            <x-header.link :href="route('admin.company.client.show', [$company, $client])" :active="request()->routeIs('admin.company.client.show')">
                {{ __('Card') }}
            </x-header.link>
            <x-header.link :href="route('admin.company.client.telegram.chat', [$company, $client])" :active="request()->routeIs('admin.company.client.telegram.chat')">
                {{ __('Telegram') }}
            </x-header.link>
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
                {{-- <h1 class="w-full text-2xl font-semibold py-3">
                    Client data:
                </h1>
                <x-white-block> --}}
                    {{-- <div class="flex items-center space-x-3">
                        <div class="w-1/4 bg-cover bg-no-repeat aspect-square rounded-full h-min" style="background-image: url({{ asset($client->avatar) }})"></div>
                        <div class="w-3/4 overflow-hidden">
                            <a href="{{ route('admin.company.client.show', [$company, $client]) }}" class="w-full text-md font-medium text-gray-900 hover:underline">
                                {{ $client->first_name }} {{ $client->last_name }}
                            </a>
                            <p class="text-sm text-gray-500">
                                {{ $client->email }}
                            </p>
                            <p class="text-sm text-gray-500">
                                {{ $client->phone }}
                            </p>
                        </div>
                        <div class="text-lg">
                            <a href="{{ route('admin.company.client.edit', [$company, $client]) }}"  wire:click="toggleClientForm" x-on:click="hasChanged = true">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                        </div>
                    </div> --}}
                    <livewire:client :company="$company" client_id="{{ $client->id }}" />
                {{-- </x-white-block> --}}
            </div>
            <div class="sm:w-1/2 md:w-2/3 space-y-3">
                <h1 class="w-full text-2xl font-semibold py-3">
                    All appointments:
                </h1>
                <div class="min-w-full">
                    <div class="rounded-md">
                        <div class="space-y-6">
                            @forelse ($appointments as $appointment)
                                <x-appointment.block :appointment="$appointment" x-on:click.prevent="$dispatch('openModal', {modal: 'AppointmentModal', params: {{ $appointment->resource->toJson()}}})"/>
                            @empty
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
