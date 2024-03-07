<x-app-layout>
    <x-slot name="navigation">
        <x-form.search :action="route('admin.company.sub_service.index', $company)" :placeholder="__('Search by sub services')"/>
        <x-header.menu>
            <x-header.link :href="route('admin.company.service.index', $company)" :active="request()->routeIs('admin.company.service.*')">
                {{ __('Services') }}
            </x-header.link>
            <x-header.link :href="route('admin.company.sub_service.index', $company)" :active="request()->routeIs('admin.company.sub_service.*')">
                {{ __('Sub services') }}
            </x-header.link>
        </x-header.menu>
    </x-slot>
    
    <x-slot name="header">
        <div class="flex items-center justify-between w-full">
            <h2 class="font-semibold text-lg text-gray-800">
                {{ __('Sub services:') }}
            </h2>
            <x-a-buttons.create href="{{ route('admin.company.sub_service.create', $company) }}">
                {{ __("Add sub service") }}
            </x-a-buttons.create>
        </div>
    </x-slot>

    <div class="py-4 sm:p-4 space-y-6">
        @if ($sub_services->isNotEmpty())
            <x-white-block class="p-0">
                <x-table.table class="whitespace-nowrap">
                    <x-table.thead>
                        <tr>
                            <x-table.th>Sub service</x-table.th>
                            <x-table.th>Description</x-table.th>
                            <x-table.th>Price</x-table.th>
                            <x-table.th>Status</x-table.th>
                            <x-table.th>Action</x-table.th>
                        </tr>
                    </x-table.thead>
                    <x-table.tbody>
                        @forelse ($sub_services as $index => $service)
                            <tr class="@if($index % 2 === 0) bg-gray-100 @endif">
                                <x-table.td>
                                    <div class="flex items-center py-2">
                                        <div class="flex-col justify-center">
                                            <div>
                                                <a href="{{ route('admin.company.sub_service.edit', [$company, $service]) }}" class="w-full text-base mb-1 hover:underline">
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

                                <x-table.td>
                                    {{ $service->price }}
                                </x-table.td>

                                <x-table.td>
                                    <x-badge color="{{ $service->active ? 'green' : 'red' }}">
                                        {{ $service->active ? "Active" : "Disabled" }}
                                    </x-badge>
                                </x-table.td>

                                <x-table.buttons>
                                    <x-a-buttons.edit href="{{ route('admin.company.sub_service.edit', [$company, $service]) }}">
                                        {{ __('Edit') }}
                                    </x-a-buttons.edit>
                                    <x-buttons.delete action="{{ route('admin.company.sub_service.destroy', [$company, $service]) }}">
                                        {{ __('Delete') }}
                                    </x-buttons.delete>
                                </x-table.buttons>
                            </tr>
                        @empty
                        @endforelse
                    </x-table.tbody>
                </x-table.table>
            </x-white-block>
        @endif
        <div class="w-full items-center justify-center">
            <a href="{{ route('admin.company.sub_service.create', $company) }}" class="block m-auto w-min whitespace-nowrap text-xl text-gray-500 hover:bg-indigo-700 hover:text-white p-3 rounded-lg">
                <i class="fa-solid fa-circle-plus"></i>
                Create sub service
            </a>
        </div>
    </div>
</x-app-layout>