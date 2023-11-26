@props(['tag', 'color' => "gray", 'trigger', 'customColor' => null])

@if ((isset($trigger) AND $trigger == true) OR !isset($trigger))
    <span {{ $attributes->merge([
        'class' => "rounded-lg text-center items-center text-sm text-white inline-block max-w-max px-2 items-center justify-center whitespace-nowrap"
    ]) }} style="background-color: {{ $color }}">
        {{ $slot }}
    </span>
@endif
