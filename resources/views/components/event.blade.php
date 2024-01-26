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

<div class="flex">
    <div wire:key="event-{{ rand(15000, 15999) }}" class="border border-l-4 pl-3 rounded-md w-full shadow-sm flex items-center space-x-3 hover:shadow-xl transform transition-all duration-200 {{$active}} cursor-pointer" style="border-left-color: {{$statusClass}}">
        <div {{ $attributes->merge() }} class="flex py-2 overflow-hidden w-full ">
            <div class="w-full flex rounded-md transform transition-all duration-200">
                <div class="w-full">
                    <div class="flex items-center space-x-1">
                        @if ($event->via)
                            <div class="w-4 h-4 flex items-center justify-center border border-blue-500 rounded-full" title="{{ $event->via }}">
                                <span class="text-black text-xs">{{ $event->via[0] ?? null}}</span>
                            </div>
                        @endif
                        
                        <p class="block font-bold text-sm whitespace-nowrap">
                            {{ $event?->date->format('d.m (D)') }} {{ $event?->term->format('H:i') }}
                        </p>
                    </div>
                    
                    @if ($event?->client)
                        <div class="text-start text-blue-400">
                            <a href="{{ route('admin.company.client.show', [$event?->client->company, $event?->client]) }}" class="text-base hover:underline text-blue-600">
                                {{ $event?->client?->first_name ?? "" }} {{ $event?->client?->last_name ?? "" }} 
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
                        @if ($event?->sub_services)
                            @forelse ($event?->sub_services as $sub_service)
                                <li class="text-gray-500 text-xs flex space-x-1">
                                    <span style="color: {{ $sub_service->color }}">•</span>
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
        @if ($event instanceof App\Models\Schedule)
            <button class="hover:text-gray-500" wire:key="edit-{{ rand(15000, 15999) }}" class="my-1" x-on:click.prevent="$dispatch('openModal', {modal: 'EditEventModal', params: {{ $event->resource->toJson()}}})">
                <i class="fa-solid fa-pen-to-square sm:mr-1"></i>
            </button>
        @else
            <div class="h-full" x-data="{ show: false }">
                <button class="h-full w-4 hover:bg-gray-200" @click="show = ! show">
                    <i class="fa-solid fa-ellipsis-vertical"></i>
                </button>

                <div x-cloak x-show="show" @click="show = false" class="fixed inset-0 z-10 w-full h-full"></div>

                <div x-show="show" class="w-min z-50 absolute bg-white h-full top-0 right-0 rounded-md border border-gray-100 items-center flex space-x-2 pl-2">
                    <x-a-buttons.button wire:click="changeStatus({{ $event->id }}, 'new')" class="border-blue-500 hover:bg-blue-100 p-2 text-black items-center text-xs" style="{{ $status == 'new' ? 'background-color:blue; color: white' : 'null' }}">
                        {{ __("New") }}
                    </x-a-buttons.button>
                    <x-a-buttons.button wire:click="changeStatus({{ $event->id }}, 'done')" class="border-green-500 hover:bg-green-100 p-2 text-black items-center text-xs" style="{{ $status == 'done' ? 'background-color:green; color: white' : 'null' }}">
                        {{ __("Done") }}
                    </x-a-buttons.button>
                    <x-a-buttons.button wire:click="changeStatus({{ $event->id }}, 'cancel')" class="border-red-500 hover:bg-red-100 p-2 text-black items-center text-xs" style="{{ $status == 'canceled' ? 'background-color:red; color: white' : 'null' }}">
                        {{ __("Canceled") }}
                    </x-a-buttons.button>
                    <x-a-buttons.button wire:click="changeStatus({{ $event->id }}, 'no_done')" class="border-red-500 hover:bg-red-100 p-2 text-black items-center text-xs" style="{{ $status == 'no_done' ? 'background-color:red; color: white' : 'null' }}">
                        {{ __("No done") }}
                    </x-a-buttons.button>
                    <button class="h-full w-4 hover:bg-gray-200" @click="show = false">
                        <i class="fa-solid fa-ellipsis-vertical"></i>
                    </button>
                </div>
            </div>
        @endif
    </div>
</div>
