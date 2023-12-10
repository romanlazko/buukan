<x-app-layout>
    <x-slot name="header">
        <div class="sm:flex items-center sm:space-x-3 w-max text-center">
            <x-a-buttons.back href="{{ route('admin.company.client.show', [$company, $client]) }}"/>
            <div class="flex items-center space-x-1 text-left">
                <div class="flex-col items-center my-auto">
                    <img src="{{ asset($client->avatar) }}" alt="Avatar" class="w-16 h-16 min-w-[64px] rounded-full">
                </div>
                <div class="flex-col justify-center">
                    <div>
                        <a href="{{ route('admin.company.telegram_bot.chat.show', [$company, $client->telegram_chat->bot, $client->telegram_chat]) }}" class="w-full text-sm font-light text-gray-500 mb-1 hover:underline">
                            {{ $client->telegram_chat->chat_id ?? null }}
                        </a>
                    </div>
                    <div>
                        <a href="{{ route('admin.company.telegram_bot.chat.show', [$company, $client->telegram_chat->bot, $client->telegram_chat]) }}" class="w-full text-md font-medium text-gray-900">
                            {{ $client->telegram_chat->first_name ?? null }} {{ $client->telegram_chat->last_name ?? null }}
                        </a>
                    </div>
                    <div>
                        @if ($client->telegram_chat->username)
                            <a class="w-full text-sm font-light text-blue-500 hover:underline" href="https://t.me/{{$client->telegram_chat->username}}">{{ "@".($client->telegram_chat->username ?? null) }}</a>
                        @else
                            <a class="w-full text-sm font-light text-blue-500 hover:underline" href="{{ route('get-contact', $client->telegram_chat) }}">{{ __('@'.$client->telegram_chat->first_name.$client->telegram_chat->last_name) }}</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <x-header.menu>
            <x-header.link :href="route('admin.company.client.show', [$company, $client])" :active="request()->routeIs('admin.company.client.show')">
                {{ __('Card') }}
            </x-header.link>
            <x-header.link :href="route('admin.company.client.telegram.chat', [$company, $client])" :active="request()->routeIs('admin.company.client.telegram.chat')">
                {{ __('Telegram') }}
            </x-header.link>
        </x-header.menu>
    </x-slot>
    
    <div class="space-y-6">
        <div class=" bg-gray-200 space-y-6">
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

    <x-slot name='footer'>
        <div class="w-full p-2 space-y-2">
            <div class="">
                {{$messages->links()}}
            </div>
            {{-- <x-message.send :action="route('message.store', $chat)"/> --}}
        </div>
    </x-slot>
</x-app-layout>