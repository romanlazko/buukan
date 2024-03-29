<x-app-layout>
    <x-slot name="navigation">
        <x-form.search :action="route('admin.company.telegram_bot.chat.index', [$company, $telegram_bot] )" :placeholder="__('Search by chats')"/>
        <x-header.menu>
            <x-header.link href="{{ route('admin.company.telegram_bot.show', [$company, $telegram_bot]) }}" :active="request()->routeIs('admin.company.telegram_bot.show*')">
                {{ __('Bot') }}
            </x-header.link>
            <x-header.link href="{{ route('admin.company.telegram_bot.chat.index', [$company, $telegram_bot] ) }}" :active="request()->routeIs('admin.company.telegram_bot.chat.*')">
                {{ __('Chats') }}
            </x-header.link>
            <x-header.link href="{{ route('admin.company.telegram_bot.edit', [$company, $telegram_bot]) }}" :active="request()->routeIs('admin.company.telegram_bot.edit.*')">
                {{ __('Settings') }}
            </x-header.link>
        </x-header.menu>
    </x-slot>

    <x-slot name="header">
        <div class="sm:flex items-center sm:space-x-3 w-max">
            <div class="flex items-center">
                <div class="flex-col items-center my-auto">
                    <img src="{{ $telegram_bot->photo ?? null }}" alt="Avatar" class="mr-4 w-12 h-12 min-w-[48px] rounded-full">
                </div>
                <div class="flex-col justify-center">
                    <div>
                        <a href="{{ route('admin.company.telegram_bot.show', [$company, $telegram_bot]) }}" class="w-full text-sm font-light text-gray-500 mb-1 hover:underline">
                            {{ $telegram_bot->id ?? null }}
                        </a>
                    </div>
                    <div>
                        <a href="{{ route('admin.company.telegram_bot.show', [$company, $telegram_bot]) }}" class="w-full text-md font-medium text-gray-900">
                            {{ $telegram_bot->first_name ?? null }} {{ $telegram_bot->last_name ?? null }}
                        </a>
                    </div>
                    <div>
                        <a class="w-full text-sm font-light text-blue-500 hover:underline" href="https://t.me/{{ $telegram_bot->username }}" target="_blank">
                            {{ "@".($telegram_bot->username ?? null) }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="space-y-6 py-4 sm:p-4">
        <x-white-block class="p-0">
            <x-table.table class="whitespace-nowrap">
                <x-table.thead class="text-left py-2 ">
                    <tr>
                        <x-table.th>id</x-table.th>
                        <x-table.th>Chat</x-table.th>
                        <x-table.th>Role</x-table.th>
                        <x-table.th>Last message</x-table.th>
                        <x-table.th>Referal</x-table.th>
                        <x-table.th>Manager</x-table.th>
                        <x-table.th>Created<br>Updated</x-table.th>
                    </tr>
                </x-table.thead>
                <x-table.tbody>
                    @forelse ($chats_collection as $index => $chat)
                        <tr class="@if($index % 2 === 0) bg-gray-100 @endif text-sm">
                            <x-table.td>{{ $chat->id }}</x-table.td>
                            <x-table.td class="whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-col items-center my-auto">
                                        <img src="{{ $chat->photo ?? null }}" alt="Avatar" class="mr-4 w-12 h-12 min-w-[48px] rounded-full">
                                    </div>
                                    <div class="flex-col justify-center">
                                        <div class="">
                                            <a href="{{ route('admin.company.telegram_bot.chat.show', [$company, $telegram_bot, $chat]) }}" class="w-full text-sm font-light text-gray-500 mb-1 hover:underline">
                                                {{ $chat->chat_id ?? null }}
                                            </a>
                                            <div class="w-full text-md font-medium text-gray-900">
                                                {{ $chat->first_name ?? null }} {{ $chat->last_name ?? null }}
                                            </div>
                                            <a class="w-full text-sm font-light text-blue-500 hover:underline" href="{{ $chat->contact }}" target="_blank">
                                                {{ "@".($chat->username ?? $chat->first_name.$chat->last_name) }}
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </x-table.td>
                            <x-table.td>
                                <x-badge color="green">
                                    {{ $chat->role }}
                                </x-badge>
                            </x-table.td>
                            <x-table.td>
                                <a class="w-full text-sm font-light hover:underline text-gray-500" href="{{ route('admin.company.telegram_bot.chat.show', [$company, $telegram_bot, $chat]) }}">
                                    {{ $chat->last_message }}
                                </a>
                            </x-table.td>
                            <x-table.td>{{ $chat->referal_id }}</x-table.td>
                            <x-table.td>{{ $chat->manager_id }}</x-table.td>
                            <x-table.td class="text-xs">
                                <p title="{{ $chat->created_at->format('d.m.Y (H:i)') }}">
                                    {{ $chat->created_at->diffForHumans() }}
                                </p>
                                <p title="{{ $chat->updated_at->format('d.m.Y (H:i)') }}">
                                    {{ $chat->updated_at->diffForHumans() }}
                                </p>
                            </x-table.td>
                        </tr>
                    @empty
                        <tr>
                            <x-table.td></x-table.td>
                            <x-table.td>Nothing found</x-table.td>
                        </tr>
                    @endforelse
                </x-table.tbody>
            </x-table.table>
            
        </x-white-block>
        <div>
            {{$chats->links()}}
        </div>
    </div>
</x-app-layout>