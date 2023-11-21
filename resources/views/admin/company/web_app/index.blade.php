<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('WebApps:') }}
        </h2>
        <div class="space-x-4 sm:-my-px sm:ml-10 flex">
            <x-a-buttons.secondary href="{{ route('admin.company.web_app.create', $company) }}" class="float-right" title="Create new bot">
                {{ __("✚") }}
            </x-a-buttons.secondary>
        </div>
    </x-slot>
    <div class="space-y-6">
        @forelse ($web_apps as $web_app)
            <x-white-block class="p-4">
                <div class="w-full flex justify-between">
                    <div class="flex items-center">
                        <div class="flex-col items-center my-auto">
                            <img src="{{ $web_app->photo ?? null }}" alt="Avatar" class="mr-4 w-12 h-12 min-w-[48px] rounded-full">
                        </div>
                        <div class="flex-col justify-center">
                            <div>
                                <a href="{{ route('admin.company.web_app.edit', [$company, $web_app]) }}" class="w-full text-sm font-light text-gray-500 mb-1 hover:underline">
                                    {{ $web_app->id ?? null }}
                                </a>
                            </div>
                            <div>
                                <a href="{{ route('admin.company.web_app.edit', [$company, $web_app]) }}" class="w-full text-md font-medium text-gray-900">
                                    {{ $web_app->url ?? null }}
                                </a>
                            </div>
                            
                            <div>
                                <a href="{{ url('app/'.$web_app->id) }}" class="w-full text-sm font-light text-blue-500 hover:underline">
                                    {{ __("link") }}
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center space-x-2">
                        <x-buttons.delete action="{{ route('admin.company.web_app.destroy', [$company, $web_app]) }}">
                            {{ __('Delete') }}
                        </x-buttons.delete>
                    </div>
                </div>
            </x-white-block>
        @empty
            
        @endforelse
    </div>
</x-app-layout>