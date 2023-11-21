<div class="space-y-6">
    <h1 class="p-4 text-white bg-gray-800 rounded-lg sticky top-1 text-2xl font-bold shadow">
        Choose service:
    </h1>
    
    <div class="w-full space-y-6">
        @forelse ($web_app->company->services as $service)
            <div class="flex items-center space-x-2">
                <input type="radio" id="{{ $service->slug }}" class="peer/{{ $service->slug }} peer/service" name="service" slug="{{ $service->slug }}" value="{{ $service->id }}">
                <x-form.label for="{{ $service->slug }}" class="w-full bg-white rounded-lg border-2 peer-checked/{{ $service->slug }}:border-blue-500 overflow-hidden" >
                    <div class="flex justify-between items-center" >
                        <div class="flex">
                            <div class="bg-cover bg-no-repeat bg-center w-36 bg-[url('{{ asset($service->img) }}')]">
                            </div>
                            <div class="flex w-full p-4 items-center space-x-4">
                                <div>
                                    <p class="w-full text-xl font-medium text-gray-900" >
                                        {{ $service->name ?? null }}
                                    </p>
                                    <p class="w-full text-sm font-light">
                                        {{ $service->description ?? null }}
                                    </p>
                                </div>
                                <div>
                                    <p class="w-full text-lg font-medium text-gray-900">
                                        {{ $service->price ?? null }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </x-form.label>
            </div>
        @empty
        @endforelse
    </div>
</div>


