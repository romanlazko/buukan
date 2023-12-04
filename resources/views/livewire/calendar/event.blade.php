<div
    @if($eventClickEnabled)
        wire:click.stop="onEventClick('{{ $event['id'] }}')"
    @endif
    class="bg-white rounded-lg border p-1 shadow-md cursor-pointer">

    <div class="text-sm font-medium flex items-center space-x-2 overflow-hidden">
        <p>
            {{ $event['term'] }}
        </p>
        <x-badge>
            {{ substr($event['description'], 0, 24) }}
        </x-badge>
    </div>
    <p class="text-sm font-medium">
        {{ $event['title'] }}
    </p>
</div>