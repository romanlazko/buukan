<x-app-layout>
    <x-slot name="header">
        <div class="sm:flex items-center sm:space-x-3 w-max">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight w-full text-center">
                {{ __('Clients:') }}
            </h2>
            <x-form.search :action="route('admin.company.client.index', $company)" :placeholder="__('Search by clients')"/>
        </div>
        <x-header.menu>
            <x-header.link href="{{ route('admin.company.client.create', $company) }}" class="float-right">
                {{ __("✚ Create client") }}
            </x-header.link>
        </x-header.menu>
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
                            <x-table.td></x-table.td>

                            <x-table.buttons>
                                <x-a-buttons.edit href="{{ route('admin.company.client.edit', [$company, $client]) }}">
                                    {{ __('Edit') }}
                                </x-a-buttons.edit>
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