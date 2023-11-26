<x-app-layout>
    <x-slot name="header">
        <div class="sm:flex items-center sm:space-x-3 w-max text-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight w-full text-center">
                {{ __('Services:') }}
            </h2>
            <x-form.search :action="route('admin.company.service.index', $company)" :placeholder="__('Search by services')"/>
        </div>
        <x-header.menu>
            <x-header.link :href="route('admin.company.service.index', $company)" :active="request()->routeIs('admin.company.service.index')">
                {{ __('Services') }}
            </x-header.link>
            <x-header.link :href="route('admin.company.sub_service.index', $company)" :active="request()->routeIs('admin.company.sub_service.index')">
                {{ __('Sub services') }}
            </x-header.link>
            <x-header.link href="{{ route('admin.company.service.create', $company) }}" :active="request()->routeIs('admin.company.service.create')">
                {{ __("✚ Create service") }}
            </x-header.link>
        </x-header.menu>
    </x-slot>
    
    <div class="">
        <x-white-block class="p-0">
            <x-table.table class="whitespace-nowrap">
                <x-table.thead>
                    <tr>
                        <x-table.th>Service</x-table.th>
                        <x-table.th>Description</x-table.th>
                        <x-table.th>Price</x-table.th>
                        <x-table.th>Action</x-table.th>
                    </tr>
                </x-table.thead>
                <x-table.tbody>
                    @forelse ($services as $index => $service)
                        <tr class="@if($index % 2 === 0) bg-gray-100 @endif">
                            <x-table.td>
                                <div class="flex items-center py-2">
                                    <div class="flex-col justify-center">
                                        <div>
                                            <a href="{{ route('admin.company.service.edit', [$company, $service]) }}" class="w-full text-base mb-1 hover:underline">
                                                {{ $service->name ?? null }}
                                            </a>
                                        </div>
                                        <x-badge color="{{ $service->color }}">
                                            {{ $service->name ?? null }}
                                        </x-badge>
                                    </div>
                                </div>
                            </x-table.td>
                            <x-table.td class="text-sm font-light whitespace-normal">
                                <p class="w-full min-w-[14rem]">
                                    {{ Str::limit($service->description, 100, '...') }}
                                </p>
                            </x-table.td>
                            <x-table.td>{{ $service->price }}</x-table.td>

                            <x-table.buttons>
                                <x-a-buttons.edit href="{{ route('admin.company.service.edit', [$company, $service]) }}">
                                    {{ __('Edit') }}
                                </x-a-buttons.edit>
                                <x-buttons.delete action="{{ route('admin.company.service.destroy', [$company, $service]) }}">
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