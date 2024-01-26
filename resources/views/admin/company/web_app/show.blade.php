<x-app-layout>
    <x-slot name="navigation">
        <div class="flex items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                <a class="hover:underline text-blue-500" href="{{ route('webapp.index', $web_app) }}">{{ __('WebApp Link') }}</a>
            </h2>
        </div>
        <x-header.menu>
            <x-header.link :href="route('admin.company.web_app.show', [$company, $web_app])" :active="request()->routeIs('admin.company.web_app.show')">
                {{ __('Preview') }}
            </x-header.link>
            <x-header.link :href="route('admin.company.web_app.edit', [$company, $web_app])" :active="request()->routeIs('admin.company.web_app.edit')">
                {{ __('Settings') }}
            </x-header.link>
        </x-header.menu>
    </x-slot>

    <x-slot name="header">
        <div class="flex items-center justify-between w-full">
            <h2 class="font-semibold text-lg text-gray-800">
                {{ __('Preview:') }}
            </h2>
        </div>
    </x-slot>

    <div class="w-full space-y-6 m-auto max-w-4xl">
        <x-white-block class="p-0 w-full h-min">
            <iframe class="w-full min-h-[80vh]" src="{{ route('webapp.index', $web_app) }}"></iframe>
        </x-white-block>
    </div>
</x-app-layout>