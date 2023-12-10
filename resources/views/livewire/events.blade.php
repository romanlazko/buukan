<div class="min-w-full">
    <div class="space-y-6">
        @forelse ($events as $event)
            <x-event :event="$event" x-on:click.prevent="$dispatch('openModal', {modal: 'AppointmentModal', params: {{ $event->resource->toJson()}}})"/>
        @empty
        @endforelse
    </div>
</div>