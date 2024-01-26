<div class="min-w-full">
    <div class="space-y-6">
        @forelse ($events as $event)
            <livewire:event.event :event="$event" wire:key="event-{{ rand(15000, 15999) }}"/>
        @empty
        @endforelse
    </div>
</div>