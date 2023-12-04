@props(['appointment'])
@php
    $statusClasses = [
        'new' => 'blue',
        'canceled' => 'tomato',
        'done' => 'green',
        'no_done' => 'red',
    ];

    $status = $appointment?->status;
    $statusClass = isset($statusClasses[$status]) ? $statusClasses[$status] : 'gray';

    $defaultClass = " border border-l-4 bg-white px-3 rounded-md w-full shadow-xl ";
    $statusColorClass = $statusClass === 'gray' 
        ? "{$defaultClass} ml-6 text-gray-500"
        : "$defaultClass";
    $active = !$appointment?->active ? 'bg-gray-200': 'bg-white';
@endphp

<div class="border border-l-4 px-3 rounded-md w-full shadow-xl flex items-center space-x-3 hover:bg-gray-100 transform transition-all duration-200 $active" style="border-left-color: {{$statusClass}}">

    <div {{ $attributes->merge() }} class="flex py-2 overflow-hidden w-full ">
        <div class="w-full text-start space-y-1 ">
            <div class="w-full justify-between items-center">
                <p class="block font-semibold text-sm whitespace-nowrap">
                    {{ $appointment?->date->format('d.m (D)') }} {{ $appointment?->term->format('H:i') }}
                </p>
            </div>
            @if ($appointment?->service)
                <x-badge color="{{ $statusClass }}">
                    {{ $appointment?->service?->name }}
                </x-badge>
            @endif
            
            @if ($appointment?->client)
                <div class="text-start text-gray-700">
                    <a href="{{ route('admin.company.client.show', [$appointment?->client->company, $appointment?->client]) }}" class="text-base hover:underline text-gray-700">
                        {{ $appointment?->client?->first_name }} {{ $appointment?->client?->last_name }}
                    </a>
                </div>
            @endif
            
        </div>
        
    </div>
    @if ($appointment?->type == 'schedule')
        <x-a-buttons.edit wire:key="edit-{{ rand(15000, 15999) }}" class="my-1" wire:click="editSchedule({{ $appointment?->id }})">
            Edit
        </x-a-buttons.edit>
    @endif
</div>