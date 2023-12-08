<div>
    <x-modal name="EditEventModal">
        <x-slot name="header">
            <a wire:key="{{$date}}" wire:click="toDateEventsModal({{ json_encode(['dateStr' => $date]) }})" class="font-semibold text-base text-white grid hover:bg-gray-200 hover:text-gray-600 aspect-square w-8 rounded-full content-center text-center h-min">
                <i class="fa-solid fa-arrow-left"></i>
            </a>
            <h1 class="font-bold  text-white">
                Edit schedule:
            </h1>
            <a x-on:click="$dispatch('close')" class="font-semibold text-xl text-white grid hover:bg-gray-200 hover:text-gray-600 aspect-square w-8 rounded-full content-center text-center h-min">
                <i class="fa-solid fa-xmark"></i>
            </a>
        </x-slot>
        <form class="space-y-6 p-2">
            <div class="w-full flex space-x-2 p-2 bg-white rounded-md shadow-sm">
                <div class="w-full">
                    <x-input-label for="date" value="{{ __('Date:') }}"/>
                    <x-text-input id="date" type="date" class="w-full" wire:model="date" value="{{ $date }}"/>
                </div>
                <div class="w-full">
                    <x-input-label for="term" value="{{ __('Term') }}"/>
                    <x-text-input id="term" type="time" class="w-full" wire:model="term" value="{{ $term }}"/>
                </div>
            </div>
            <div class="w-full p-2 bg-white rounded-md shadow-sm">
                <x-input-label for="service" value="{{ __('Service') }}"/>
                <x-form.select id="service" wire:model.live="service_id" class="w-full">
                    <option @selected($service_id == null) value="null">Any service</option>
                    @forelse ($employee->services as $service)
                        <option 
                            wire:key="{{$service->slug}}-{{ $service_id }}" 
                            @selected($service_id == $service->id) 
                            value="{{ $service->id }}"
                        >
                            {{ $service->name }} ({{ $service->price }})
                        </option>
                    @empty
                        
                    @endforelse
                </x-form.select>
            </div>

            <div class="w-full p-2 bg-white rounded-md shadow-sm">
                <x-input-label for="active" value="{{ __('Status') }}"/>
                <x-form.select id="active" wire:model="active" class="w-full">
                    <option wire:key="{{$active }}-0" @selected($active == 1) value="1">Active</option>
                    <option wire:key="{{$active }}-1" @selected($active == 0) value="0">Disable</option>
                </x-form.select>
            </div>
        </form>
        <x-slot name="footer">
            <x-a-buttons.delete wire:click="delete">
                {{ __('Delete') }}
            </x-a-buttons.delete>
            <div class="space-x-3">
                <x-primary-button wire:click="update">
                    {{ __('Update') }}
                </x-primary-button>
            </div>
        </x-slot>
    </x-modal>
</div>
