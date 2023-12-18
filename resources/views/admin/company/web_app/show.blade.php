<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center">
            
        </div>
        <x-header.menu>
            <x-header.link :href="route('admin.company.web_app.show', [$company, $web_app])" :active="request()->routeIs('admin.company.web_app.show')">
                {{ __('App') }}
            </x-header.link>
            <x-header.link :href="route('admin.company.web_app.edit', [$company, $web_app])" :active="request()->routeIs('admin.company.web_app.edit')">
                {{ __('Settings') }}
            </x-header.link>
        </x-header.menu>
    </x-slot>
    <div class="w-full space-y-6 m-auto max-w-4xl">
        <x-white-block class="p-0 w-full h-min">
            <h2 class="text-lg font-medium text-gray-900 p-4 bg-gray-100">
                {{ __('Preview:') }}
            </h2>
            <iframe class="w-full min-h-[80vh]" src="{{ url('app/'.$web_app->id) }}"></iframe>
        </x-white-block>
    </div>
</x-app-layout>