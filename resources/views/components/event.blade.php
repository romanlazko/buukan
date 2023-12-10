@props(['event'])
@php
    $statusClasses = [
        'new' => 'blue',
        'canceled' => 'red',
        'done' => 'green',
        'no_done' => 'red',
    ];

    $status = $event?->status;
    $statusClass = isset($statusClasses[$status]) ? $statusClasses[$status] : 'gray';

    $defaultClass = " border border-l-4 bg-white px-3 rounded-md w-full shadow-xl ";
    $statusColorClass = $statusClass === 'gray' 
        ? "{$defaultClass} ml-6 text-gray-500"
        : "$defaultClass";
    $active = (!$event?->active AND $event?->type == 'schedule') ? 'bg-gray-100': 'bg-white';
@endphp

<div wire:key="event-{{ rand(15000, 15999) }}" class="border border-l-4 px-3 rounded-md w-full shadow-sm flex items-center space-x-3 hover:shadow-xl transform transition-all duration-200 {{$active}} cursor-pointer" style="border-left-color: {{$statusClass}}">
    <div {{ $attributes->merge() }} class="flex py-2 overflow-hidden w-full ">
        <div class="w-full flex rounded-md transform transition-all duration-200">
            <div class="w-full">
                <p class="block font-bold text-sm whitespace-nowrap">
                    {{ $event?->date->format('d.m (D)') }} {{ $event?->term->format('H:i') }}
                </p>
                @if ($event?->client)
                    <div class="text-start text-blue-400">
                        <a href="{{ route('admin.company.client.show', [$event?->client->company, $event?->client]) }}" class="text-base hover:underline text-blue-600">
                            {{ $event?->client?->first_name }} {{ $event?->client?->last_name }}
                        </a>
                    </div>
                @endif
                <ul class="list-disc space-y-1">
                    @if ($event?->service)
                        <li class="text-gray-500 text-xs flex space-x-1">
                            <span>•</span>
                            <span>{{ $event?->service?->name }}</span>
                        </li>
                    @endif
                    @if ($event?->subServices)
                        @forelse ($event?->subServices as $sub_service)
                            <li class="text-gray-500 text-xs flex space-x-1">
                                <span style="color: {{$sub_service?->color}}">•</span>
                                <span>{{ $sub_service->name }}</span>
                            </li>
                        @empty
                        
                        @endforelse
                    @endif
                </ul>
            </div>
            <div class="text-right">
                <p class="text-gray-500 text-xs">
                    {{ $event?->price ?? $event?->total_price }}
                </p>
            </div>
        </div>
        
    </div>
    @if ($event?->type == 'schedule')
        <x-a-buttons.edit wire:key="edit-{{ rand(15000, 15999) }}" class="my-1" wire:click="openModal('EditEventModal', {{ $event?->id }})">
            Edit
        </x-a-buttons.edit>
    @endif
</div>