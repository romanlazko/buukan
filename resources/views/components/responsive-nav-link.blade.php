@props(['active'])

@php
    if (isset($active) AND is_array($active)) {
            if (in_array(true, $active)) {
                $classes = 'block w-full pl-3 pr-4 py-2 border-l-4 border-indigo-400 text-left text-base font-medium text-indigo-700 bg-indigo-50 focus:outline-none focus:text-indigo-800 focus:bg-indigo-100 focus:border-indigo-700 transition duration-150 ease-in-out';
            }
            else {
                $classes = 'block w-full pl-3 pr-4 py-2 border-l-4 border-transparent text-left text-base font-medium text-gray-300 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300 focus:outline-none focus:text-gray-800 focus:bg-gray-50 focus:border-gray-300 transition duration-150 ease-in-out';
            }
    }
    else {
        $classes = ($active ?? false)
                        ? 'block w-full pl-3 pr-4 py-2 border-l-4 border-indigo-400 text-left text-base font-medium text-indigo-700 bg-indigo-50 focus:outline-none focus:text-indigo-800 focus:bg-indigo-100 focus:border-indigo-700 transition duration-150 ease-in-out'
                        : 'block w-full pl-3 pr-4 py-2 border-l-4 border-transparent text-left text-base font-medium text-gray-300 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300 focus:outline-none focus:text-gray-800 focus:bg-gray-50 focus:border-gray-300 transition duration-150 ease-in-out block';
    }
@endphp


<div class="group space-y-2">
    <a {{ $attributes->merge(['class' => $classes]) }}>
        <div class="flex">
            {{ $slot }}
        </div>
    </a>
    @if (isset($submenu))
        <div class="pl-2 group-hover:block {{ request()->routeIs('admin.company.sub_service.*') ? 'block' : 'hidden' }}">
            {{ $submenu }}
        </div>
    @endif
</div>

