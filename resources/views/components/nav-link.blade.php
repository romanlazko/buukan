@props(['active'])

@php
$classes = ($active ?? false)
            ? 'items-center uppercase font-bold text-sm leading-5 text-gray-100 focus:outline-none focus:border-indigo-700 transition duration-150 ease-in-out'
            : 'items-center uppercase font-bold text-sm leading-5 text-white hover:text-gray-200 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
