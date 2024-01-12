<x-app-layout>
    <x-slot name="header">
        <div class="sm:flex items-center sm:space-x-3 w-max text-center">
            <h2 class="font-semibold text-xl text-gray-800">
                {{ __('Companies:') }}
            </h2>
            <x-form.search :action="route('super-duper-admin.company.index')" :placeholder="__('Search by employees')"/>
        </div>
        <x-header.menu>
            <x-header.link :href="route('super-duper-admin.company.index')" :active="request()->routeIs('super-duper-admin.company.index')">
                {{ __('Companies') }}
            </x-header.link>
            <x-header.link href="{{ route('super-duper-admin.company.create') }}" class="float-right">
                <i class="fa-solid fa-circle-plus mr-1 text-indigo-700"></i>
                {{ __("Create company") }}
            </x-header.link>
        </x-header.menu>
    </x-slot>
    <div class="py-4 sm:p-4 space-y-6">
        @if ($companies->isNotEmpty())
            <x-white-block class="p-0">
                <x-table.table class="whitespace-nowrap">
                    <x-table.thead>
                        <tr>
                            <x-table.th>Name</x-table.th>
                            <x-table.th>Description</x-table.th>
                            <x-table.th>Services</x-table.th>
                            <x-table.th>Action</x-table.th>
                        </tr>
                    </x-table.thead>
                    <x-table.tbody>
                        @forelse ($companies as $index => $company)
                            <tr class="@if($index % 2 === 0) bg-gray-100 @endif">
                                <x-table.td>
                                    <div class="flex items-center py-2">
                                        <a href="{{ route('admin.company.show', [$company]) }}" class="flex-col items-center my-auto">
                                            <img src="{{ asset($company->logo) }}" class="mr-4 w-12 h-12 min-w-[48px] rounded-full bg-slate-300">
                                        </a>
                                        <div class="flex-col justify-center">
                                            <div>
                                                <a href="{{ route('admin.company.show', [$company]) }}" class="w-full text-base mb-1 hover:underline">
                                                    {{ $company->name }}
                                                </a>
                                            </div>
                                            <div>
                                                <p class="text-sm text-gray-600">
                                                    {{ $company->address }}
                                                </p>
                                                <p class="text-sm text-gray-600">
                                                    {{ $company->owner->first_name }} {{ $company->owner->last_name }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </x-table.td>
                                <x-table.td class="text-sm font-light whitespace-normal">
                                    <p class="w-full min-w-[14rem]">
                                        {{ Str::limit($company->description, 100, '...') }}
                                    </p>
                                </x-table.td>
                                
                                <x-table.td>
                                    <div class="w-full pb-2 whitespace-normal">
                                        @forelse ($company->services as $service)
                                            <x-badge color="{{ $service->color }}" >
                                                <a href="" class="whitespace-nowrap" title="{{ $service->description }}">{{ $service->name }}</a>
                                            </x-badge>
                                        @empty
                                            
                                        @endforelse
                                    </div>
                                </x-table.td>

                                <x-table.buttons>
                                    <x-a-buttons.edit href="{{ route('super-duper-admin.company.edit', [$company]) }}">
                                        {{ __('Edit') }}
                                    </x-a-buttons.edit>

                                    <x-buttons.delete action="{{ route('super-duper-admin.company.destroy', [$company]) }}">
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
            <a href="{{ route('super-duper-admin.company.create') }}" class="block m-auto w-min whitespace-nowrap text-xl text-gray-500 hover:bg-indigo-700 hover:text-white p-3 rounded-lg">
                <i class="fa-solid fa-circle-plus"></i>
                Create company
            </a>
        </div>
    </div>
</x-app-layout>