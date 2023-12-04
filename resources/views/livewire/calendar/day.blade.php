<div
    class="flex-1 h-40 lg:h-48 border border-gray-200 -mt-px -ml-px"
    style="min-width: 10rem;">

    {{-- Wrapper for Drag and Drop --}}
    <div
        class="w-full h-full"
        id="{{ $day }}">

        <div
            @if($dayClickEnabled)
                wire:click="onDayClick({{ $day->year }}, {{ $day->month }}, {{ $day->day }})"
            @endif
            class="w-full h-full {{ $dayInMonth ? $isToday ? 'bg-yellow-100' : ' bg-white ' : 'bg-gray-100' }} flex flex-col">

            {{-- Number of Day --}}
            <div class="p-1 px-2 flex items-center cursor-pointer">
                <p class="rounded-full w-6 aspect-square text-center grid content-center bg-blue-500 text-white text-sm hover:scale-105 transition ease-in-out duration-150 {{ $dayInMonth ? ' font-medium ' : '' }}">
                    {{ $day->format('j') }}
                </p>
            </div>

            {{-- Events --}}
            <div class="p-1 flex-1 overflow-y-auto">
                <div class="grid grid-cols-1 grid-flow-row gap-1">
                    @foreach($events->sortBy('term') as $event)
                        <div>
                            @include($eventView, [
                                'event' => $event,
                            ])
                        </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
</div>