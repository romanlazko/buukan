@props(['appointment'])
@php
    $statusClasses = [
        'new' => 'blue',
        'canceled' => 'red',
        'done' => 'green',
        'no_done' => 'red',
    ];

    $status = $appointment?->status;
    $statusClass = isset($statusClasses[$status]) ? $statusClasses[$status] : 'gray';

    $defaultClass = " border border-l-4 bg-white px-3 rounded-md w-full shadow-xl ";
    $statusColorClass = $statusClass === 'gray' 
        ? "{$defaultClass} ml-6 text-gray-500"
        : "$defaultClass";
    $active = (!$appointment?->active AND $appointment?->type == 'schedule') ? 'bg-gray-100': 'bg-white';
@endphp

<div class="border border-l-4 px-3 rounded-md w-full shadow-sm flex items-center space-x-3 hover:shadow-xl transform transition-all duration-200 {{$active}} cursor-pointer" style="border-left-color: {{$statusClass}}">

    <div {{ $attributes->merge() }} class="flex py-2 overflow-hidden w-full ">
        <div class="w-full flex rounded-md transform transition-all duration-200">
            <div class="w-2/3">
                <p class="block font-bold text-sm whitespace-nowrap">
                    {{ $appointment?->date->format('d.m (D)') }} {{ $appointment?->term->format('H:i') }}
                </p>
                @if ($appointment?->client)
                    <div class="text-start text-blue-400">
                        <a href="{{ route('admin.company.client.show', [$appointment?->client->company, $appointment?->client]) }}" class="text-base hover:underline text-blue-600">
                            {{ $appointment?->client?->first_name }} {{ $appointment?->client?->last_name }}
                        </a>
                    </div>
                @endif
               
                
                @if ($appointment?->subServices)
                    <ul class="list-disc space-y-1">
                        @if ($appointment?->service)
                            <li class="text-gray-500 text-xs flex space-x-1">
                                <span style="color: {{$appointment?->service?->color}}">• </span>
                                {{ $appointment?->service?->name }}
                            </li>
                        @endif
                        @forelse ($appointment?->subServices as $sub_service)
                            <li class="text-gray-500 text-xs flex space-x-1">
                                <span style="color: {{$sub_service?->color}}">• </span>
                                {{ $sub_service->name }}
                            </li>
                        @empty
                        @endforelse
                    </ul>
                @endif
                
            </div>
            <div class="w-1/3 text-right">
                <p class="text-gray-500 text-xs">
                    {{ $appointment?->price ?? $appointment?->total_price }}
                </p>
            </div>
        </div>
        
    </div>
    @if ($appointment?->type == 'schedule')
        <x-a-buttons.edit wire:key="edit-{{ rand(15000, 15999) }}" class="my-1" wire:click="editSchedule({{ $appointment?->id }})">
            Edit
        </x-a-buttons.edit>
    @endif
</div>