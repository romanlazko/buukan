<x-web-app>
    <x-slot name="header">
        <div class="w-full flex justify-between items-center">
            <div class="flex items-center">
                <div class="flex-col items-center my-auto">
                    <img src="{{ asset($web_app->company->logo) }}" alt="Logo" class="mr-4 w-12 h-12 min-w-[48px] rounded-full">
                </div>
                <div class="flex-col justify-center">
                    <p class="w-full text-md font-medium text-gray-900">
                        {{ $web_app->company->name ?? null }}
                    </p>
                    <p class="w-full text-sm font-light text-gray-500 mb-1">
                        {{ $web_app->company->description ?? null }}
                    </p>
                </div>
            </div>
            <form method="POST" action="{{ route('webapp.logout', $web_app) }}">
				@csrf
				<button type="submit" >
					{{ __('Log Out') }}
				</button>
			</form>
        </div>
    </x-slot>
    @dump($current)
    <livewire:dynamic-component :is="$current"/>
    

    <x-slot name="footer">
        <div class="w-full">
            <x-buttons.primary wire:click="nextStep" class="w-full" >
                <div class="w-full text-center p-3" >
                    Create new appointment
                </div>
            </x-buttons.primary>
        </div>
    </x-slot>
</x-web-app>