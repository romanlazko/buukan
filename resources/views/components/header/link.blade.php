@props(['active'])

@php
    $activeClasses = ($active ?? false)
        ? ' text-left text-indigo-700 focus:outline-none focus:text-indigo-800 focus:bg-indigo-100 focus:border-indigo-700 bg-gray-200 '
        : ' border-transparent text-gray-500 hover:text-gray-800 focus:outline-none focus:text-gray-800 focus:border-gray-300';
@endphp

<a {{ $attributes->merge(['class' => 'block text-left text-md font-base transition duration-150 ease-in-out cursor-pointer rounded-lg w-full lg:w-min hover:bg-gray-100 px-4 py-2 text-gray-700 hover:bg-indigo-600 hover:text-white' . $activeClasses]) }}>
    <div class="flex whitespace-nowrap items-center ">
        {{ $slot }}
    </div>
</a>