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
            <x-header.link class="float-right" onclick="showAppointmentModal({{ $client->resource->toJson() }})">
                <i class="fa-solid fa-circle-plus mr-1 text-indigo-700"></i>
                {{ __("Add appointment") }}
            </x-header.link>
        </x-header.menu>
    </x-slot>

    <x-modal.appointment-modal :company="$company"/>

    <div class="py-4 sm:p-4 space-y-6 max-w-6xl m-auto">
        <div class="sm:flex w-full sm:space-x-6 space-y-3 sm:space-y-0">
            <div class="sm:w-1/3 space-y-3">
                    <div class="block space-y-3 sm:space-x-0 items-center sm:bg-white rounded-lg p-4">
                        <div class="w-20 bg-cover bg-no-repeat aspect-square rounded-full h-min m-auto" style="background-image: url({{asset($client->avatar ?? $client->telegram_chat->photo ?? '/storage/img/public/preview.jpg' )}})"></div>
                        <div class="m-auto text-center">
                            <h2 class="text-xl font-bold w-full">
                                {{ $client->first_name }} {{ $client->last_name }}
                            </h2>
                            <p class="text-sm text-gray-500">
                                {{ $client->email }}
                            </p>
                            <p class="text-sm text-gray-500">
                                {{ $client->phone }}
                            </p>
                        </div>
                    </div>
                <div class="w-full items-center justify-center">
                    <a href="{{ route('admin.company.client.edit', [$company, $client]) }}" class="block m-auto w-min whitespace-nowrap text-sm text-gray-500 hover:bg-indigo-700 hover:text-white p-3 rounded-lg">
                        <i class="fa-solid fa-pen-to-square sm:mr-1"></i>
                        Edit client
                    </a>
                </div>
            </div>
            <div class="w-full space-y-3">
                <div class="min-w-full">
                    <div class="p-3 space-y-3 rounded-md">
                        <div class="space-y-6">
                            @forelse ($client->appointments as $appointment)
                                <x-appointment.block :appointment="$appointment"/>
                            @empty
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
