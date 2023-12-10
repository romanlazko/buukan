<div>
    <x-modal name="DateEventsModal">
        <x-slot name="header">
            <h1 class="font-bold  text-white w-full text-center">
                {{ $date?->format('d.m.Y') ?? null}}
            </h1>
            <x-a-buttons.close x-on:click="$dispatch('close-all-modal')"/>
        </x-slot>
        
        <div class="relative">
            <div class="w-full p-3">
                <livewire:employee-events :employee="$employee" :date="$date"/>
            </div>
        </div>
        
        <x-slot name="footer">
            <button wire:key="{{ $date?->format('Y-m-d') }}" type="button" wire:click="openModal('CreateEventModal', {{ json_encode(['dateStr' => $date?->format('Y-m-d') ?? now()->format('Y-m-d')]) }})" class="block m-auto w-min whitespace-nowrap text-md text-gray-500 hover:bg-indigo-700 hover:text-white p-3 rounded-lg">
                <i class="fa-solid fa-circle-plus"></i>
                Create schedule
            </button>
        </x-slot>
    </x-modal>
</div>
