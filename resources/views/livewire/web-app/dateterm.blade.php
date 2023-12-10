<x-web-app>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-2xl">
                {{ $web_app->company->name }}
            </h2>
        </div>
    </x-slot>

    <div class="space-y-6">

        <h1 class="p-4 text-white bg-gray-800 rounded-lg sticky top-1 text-2xl font-bold shadow">
            Choose date:
        </h1>
        <div class="w-full bg-white rounded-lg p-4 sm:p-8 border-2 space-y-6">
            <div class="flex overflow-x-auto">
                @for ($month = now(), $monthAnd = $month->clone()->addMonth(3); $month < $monthAnd; $month->addMonth())
                    <div class="block w-max p-3">
                        <div class="flex font-bold w-max sticky left-0">
                            {{ $month->format('F Y') }}
                        </div>
                        <div class="w-max flex">
                            @for ($day = $month->clone()->startOfMonth(); $day <= $month->clone()->endOfMonth(); $day = $day->addDay())
                                @if ($day > now())
                                    @if ($day->format('N') == 1)
                                        <div class="w-min border mx-1"></div>
                                    @endif
                                    <div class="p-2 block text-center">
                                        <p class="text-xs font-light mb-3">
                                            {{ $day->format('D') }}
                                        </p>
                                        <input wire:model.live="date" wire:click="resetTerm" id="{{ $day->timestamp }}" type="radio" name="date" class="hidden peer/{{ $day->timestamp }}" @if($unnocupiedDates->where('date', $day)->isEmpty()) disabled @endif value="{{ $day->format('Y-m-d') }}">
                                        <label class="font-medium p-2 rounded-full border peer-checked/{{ $day->timestamp }}:bg-gray-800 peer-checked/{{ $day->timestamp }}:text-white  @if($unnocupiedDates->where('date', $day)->isEmpty()) text-gray-300 @endif" for="{{ $day->timestamp }}">
                                            {{ $day->format('d') }}
                                        </label>
                                    </div>
                                @endif
                            @endfor
                        </div>
                    </div>
                @endfor
            </div>
            <div class="terms space-y-4">
                @if ($schedules AND $date)
                    @forelse ($schedules as $schedule)
                        <x-form.radio wire:key="schedule-{{$schedule->id}}" id="{{ $schedule->id }}" name="term" wire:model.live="term" class="peer/{{ $schedule->id }} hidden" value="{{ $schedule->term->format('H:s') }}"/>
                        <x-form.label for="{{ $schedule->id }}" class="text-center w-full bg-white rounded-full border-2 py-2 peer-checked/{{ $schedule->id }}:bg-gray-800 peer-checked/{{ $schedule->id }}:text-white" >
                            {{ $schedule->term->format('H:s') }}
                        </x-form.label>
                    @empty
                        
                    @endforelse
                @endif
            </div>
        </div>
    </div>

    <x-slot name="footer">
        <div class="w-full">
            <div class="space-x-4 flex w-full">
                <div>
                    <x-a-buttons.primary wire:click="prevStep">
                        <div class="w-full text-center p-3">
                            ←
                        </div>
                    </x-a-buttons.primary>
                </div>
                <div class="w-full">
                    <x-buttons.primary wire:click="create" class="w-full" :disabled="$date == null OR $term == null">
                        <div class="w-full text-center p-3">
                            Confirm
                        </div>
                    </x-buttons.primary>
                </div>
            </div>
        </div>
        
    </x-slot>
</x-web-app>