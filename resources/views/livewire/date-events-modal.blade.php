<div>
    <x-modal name="DateEventsModal">
        <x-slot name="header">
            <div>

            </div>
            <h1 class="font-bold  text-white">
                {{ $date?->format('d.m.Y') ?? null}}
            </h1>
            <a x-on:click="$dispatch('close')" class="font-semibold text-xl text-white grid hover:bg-gray-200 hover:text-gray-600 aspect-square w-8 rounded-full content-center text-center h-min">
                <i class="fa-solid fa-xmark"></i>
            </a>
        </x-slot>
        <div class="relative">
            <div class="w-full space-y-6 p-3">
                @foreach ($events as $item)
                    <x-appointment.block wire:key="appointment-{{ rand(15000, 15999) }}" :appointment="$item" wire:click="appointmentModal({{ json_encode(['id' => $item?->id, 'type' => $item?->type ]) }})"/>
                @endforeach
            </div>
        </div>
        <x-slot name="footer">
            <a wire:click="createSchedule" class="block m-auto w-min whitespace-nowrap text-md text-gray-500 hover:bg-indigo-700 hover:text-white p-3 rounded-lg">
                <i class="fa-solid fa-circle-plus"></i>
                Create schedule
            </a>
        </x-slot>
    </x-modal>
</div>
