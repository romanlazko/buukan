<x-app-layout>
    <x-slot name="navigation">
        <x-form.search :action="route('admin.company.client.index', $company)" :placeholder="__('Search by clients')"/>
    </x-slot>
    
    <x-slot name="header">
        <div class="flex items-center justify-between w-full">
            <h2 class="font-semibold text-xl text-gray-800">
                {{ __('Clients:') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-4 sm:p-4">
        <x-white-block class="p-0">
            <x-table.table class="whitespace-nowrap">
                <x-table.thead>
                    <tr>
                        <x-table.th>id</x-table.th>
                        <x-table.th>Client</x-table.th>
                        <x-table.th>Phone</x-table.th>
                        <x-table.th>Social media</x-table.th>
                        <x-table.th>Created Updated</x-table.th>
                        <x-table.th>Action</x-table.th>
                    </tr>
                </x-table.thead>
                <x-table.tbody>
                    @forelse ($clients as $index => $client)
                        <tr class="@if($index % 2 === 0) bg-gray-100 @endif">
                            <x-table.td>{{ $client->id }}</x-table.td>
                            <x-table.td>
                                <div>
                                    <a href="{{ route('admin.company.client.show', [$company, $client]) }}" class="hover:text-blue-500 hover:underline">
                                        {{ $client->first_name }} {{ $client->last_name }}
                                    </a>
                                    <p class="text-sm text-gray-600">
                                        {{ $client->email }}
                                    </p>
                                    
                                </div>
                            </x-table.td>
                            <x-table.td>{{ $client->phone }}</x-table.td>
                            <x-table.td>
                                <div class="flex space-x-2">
                                    @if (isset($client->social_media->instagram))
                                        <a href="https://instagram.com/{{ str_replace('@', '', $client->social_media->instagram) }}" class="flex items-center space-x-1 text-2xl" target="blank">
                                            <i class="fa-brands fa-instagram text-pink-700"></i>
                                        </a>
                                    @endif
                                    @if (isset($client->social_media->facebook))
                                        <a href="{{ $client->social_media->facebook }}" class="flex items-center space-x-1 text-2xl" target="blank">
                                            <i class="fa-brands fa-facebook text-blue-700"></i>
                                        </a>
                                    @endif
                                    @if (isset($client->social_media->telegram) OR $client->telegram_chat)
                                        <a href="{{ $client->telegram_chat->contact ?? "https://t.me/{$client->social_media->telegram}" }}" class="flex items-center space-x-1 text-2xl" target="blank">
                                            <i class="fa-brands fa-telegram text-blue-500"></i>
                                        </a>
                                    @endif
                                </div>
                                
                            </x-table.td>
                            <x-table.td>
                                <div class="text-xs text-gray-500">
                                    <p>{{ $client->created_at->diffForHumans() }}</p>
                                    <p>{{ $client->updated_at->diffForHumans() }}</p>
                                </div>
                            </x-table.td>
                            <x-table.buttons>
                                <x-buttons.delete action="{{ route('admin.company.client.destroy', [$company, $client]) }}">
                                    {{ __('Delete') }}
                                </x-buttons.delete>
                            </x-table.buttons>
                        </tr>
                    @empty
                    @endforelse
                </x-table.tbody>
            </x-table.table>
        </x-white-block>
    </div>
</x-app-layout>