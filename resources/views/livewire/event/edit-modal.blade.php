<div>
    <x-modal name="EditEventModal">
        <x-slot name="header">
            <x-a-buttons.back wire:key="{{ $date }}" wire:click="openModal('DateEventsModal', {{ json_encode(['dateStr' => $date ?? now()->format('Y-m-d')]) }})" class="text-white hover:bg-gray-200 hover:text-gray-600"/>
            <h1 class="font-bold  text-white w-full text-center">
                Edit schedule:
            </h1>
            <x-a-buttons.close x-on:click="$dispatch('close-all-modal')"/>
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
                    <option value="">Any service</option>
                    @if ($employee)
                        @forelse ($employee?->services as $service)
                            <option 
                                wire:key="{{$service->slug}}-{{ $service_id }}" 
                                @selected($service_id == $service->id) 
                                value="{{ $service->id }}"
                            >
                                {{ $service->name }} ({{ $service->price }})
                            </option>
                        @empty
                            
                        @endforelse
                    @endif
                    
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
            <x-a-buttons.button class="bg-red-600 text-white hover:bg-red-500 active:bg-red-700" wire:key="remove-schedule-{{ $schedule->id ?? null }}" wire:click="delete" wire:confirm="Are you sure you want to delete this event?">
                {{ __('Delete') }}
            </x-a-buttons.button>
            <div class="space-x-3">
                <x-primary-button wire:click="update">
                    {{ __('Update') }}
                </x-primary-button>
            </div>
        </x-slot>
    </x-modal>
</div>
