@props(['active'])

@php
$classes = ($active ?? false)
            ? 'items-center uppercase text-sm leading-5 focus:outline-none focus:border-indigo-700 transition duration-150 ease-in-out text-indigo-700 whitespace-nowrap'
            : 'items-center uppercase text-sm leading-5 text-gray-800 hover:text-gray-200 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out whitespace-nowrap';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
