<x-app-layout>
    <x-slot name="navigation">
        <x-form.search :action="route('admin.company.client.index', $company)" :placeholder="__('Search by clients')"/>
        <x-header.menu>
            <x-header.link :href="route('admin.company.client.show', [$company, $client])" :active="request()->routeIs('admin.company.client.show')">
                {{ __('Card') }}
            </x-header.link>
            @if ($client->telegram_chat) 
                <x-header.link :href="route('admin.company.client.telegram.chat', [$company, $client])" :active="request()->routeIs('admin.company.client.telegram.chat')">
                    {{ __('Telegram') }}
                </x-header.link>
            @endif
        </x-header.menu>
    </x-slot>

    <x-slot name="header">
        <div class="flex items-center space-x-2 w-full text-center">
            <x-a-buttons.back href="{{ route('admin.company.client.index', $company) }}"/>
            <h2 class="font-semibold text-lg text-gray-800">
                {{ $client->first_name }} {{ $client->last_name }}
            </h2>
        </div>
    </x-slot>

    <div class="py-4 sm:p-4 space-y-6 max-w-6xl m-auto">
        <div class="sm:flex w-full sm:space-x-3 space-y-3 sm:space-y-0">
            <div class="sm:w-1/2 md:w-1/3 space-y-3 lg:sticky lg:top-1 h-min z-50">
                <livewire:client :company="$company" client_id="{{ $client->id }}" />
            </div>
            <div class="sm:w-1/2 md:w-2/3 space-y-3">
                <div class=" bg-gray-200 space-y-6 ">
                    @foreach ($messages->reverse() as $message)
                        @if ($message->user?->is_bot === 0 OR $message->callback_query?->user?->is_bot === 0 OR $message->sender_chat)
                            <x-message.block class="mr-6 ml-1">
                                @if ($message->photo)
                                    <x-message.img class="rounded-md" :src=" $message->photo "/>
                                @endif
                                <x-message.text :message="$message" class="bg-white"/>
                                <x-message.buttons :message="$message"/>
                            </x-message.block>
                        @else
                            <x-message.block class="sm:ml-auto ml-6 mr-1">
                                @if ($message->photo)
                                    <x-message.img class="rounded-md" :src=" $message->photo "/>
                                @endif
        
                                <x-message.text :message="$message" class="bg-blue-50"/>
                                <x-message.buttons :message="$message"/>
                            </x-message.block>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    
    {{-- <div class="lg:flex my-2 space-x-3">
        <div class="sm:w-1/2 md:w-1/3 space-y-3 sticky top-1 h-min ">
            <livewire:client :company="$company" client_id="{{ $client->id }}" />
        </div>
        <div class="lg:w-2/3 overflow-auto flex-1 flex flex-col h-min">
            <div class=" bg-gray-200 space-y-6 ">
                @foreach ($messages->reverse() as $message)
                    @if ($message->user?->is_bot === 0 OR $message->callback_query?->user?->is_bot === 0 OR $message->sender_chat)
                        <x-message.block class="mr-6 ml-1">
                            @if ($message->photo)
                                <x-message.img class="rounded-md" :src=" $message->photo "/>
                            @endif
                            <x-message.text :message="$message" class="bg-white"/>
                            <x-message.buttons :message="$message"/>
                        </x-message.block>
                    @else
                        <x-message.block class="sm:ml-auto ml-6 mr-1">
                            @if ($message->photo)
                                <x-message.img class="rounded-md" :src=" $message->photo "/>
                            @endif
    
                            <x-message.text :message="$message" class="bg-blue-50"/>
                            <x-message.buttons :message="$message"/>
                        </x-message.block>
                    @endif
                @endforeach
            </div>
        </div>
        
    </div> --}}

    <x-slot name='footer'>
        <div class="w-full p-2 space-y-2">
            <div class="">
                {{$messages->links()}}
            </div>
            {{-- <x-message.send :action="route('message.store', $chat)"/> --}}
        </div>
    </x-slot>
</x-app-layout>