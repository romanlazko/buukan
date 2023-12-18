<x-app-layout>
    <x-slot name="header">
        <div class="sm:flex items-center sm:space-x-3 w-max text-center">
            <h2 class="font-semibold text-xl text-gray-800">
                {{ __('Employees:') }}
            </h2>
            <x-form.search :action="route('admin.company.employee.index', $company)" :placeholder="__('Search by employees')"/>
        </div>
        <x-header.menu>
            <x-header.link :href="route('admin.company.employee.index', $company)" :active="request()->routeIs('admin.company.employee.index')">
                {{ __('Employees') }}
            </x-header.link>
            <x-header.link href="{{ route('admin.company.employee.create', $company) }}" class="float-right">
                <i class="fa-solid fa-circle-plus mr-1 text-indigo-700"></i>
                {{ __("Create employee") }}
            </x-header.link>
        </x-header.menu>
    </x-slot>
    <div class="py-4 sm:p-4 space-y-6">
        @if ($employees->isNotEmpty())
            <x-white-block class="p-0">
                <x-table.table class="whitespace-nowrap">
                    <x-table.thead>
                        <tr>
                            <x-table.th>Name</x-table.th>
                            <x-table.th>Description</x-table.th>
                            <x-table.th>Services</x-table.th>
                            <x-table.th>Role</x-table.th>
                            <x-table.th>Action</x-table.th>
                        </tr>
                    </x-table.thead>
                    <x-table.tbody>
                        @forelse ($employees as $index => $employee)
                            <tr class="@if($index % 2 === 0) bg-gray-100 @endif">
                                <x-table.td>
                                    <div class="flex items-center py-2">
                                        <a href="{{ route('admin.company.employee.show', [$company, $employee]) }}" class="flex-col items-center my-auto">
                                            <img src="{{ asset($employee->avatar) }}" class="mr-4 w-12 h-12 min-w-[48px] rounded-full bg-slate-300">
                                        </a>
                                        <div class="flex-col justify-center">
                                            <div>
                                                <a href="{{ route('admin.company.employee.show', [$company, $employee]) }}" class="w-full text-base mb-1 hover:underline">
                                                    {{ $employee->first_name }} {{ $employee->last_name }}
                                                </a>
                                            </div>
                                            <div>
                                                <p class="text-sm text-gray-600">
                                                    {{ $employee->email }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </x-table.td>
                                <x-table.td class="text-sm font-light whitespace-normal">
                                    <p class="w-full min-w-[14rem]">
                                        {{ Str::limit($employee->description, 100, '...') }}
                                    </p>
                                </x-table.td>
                                
                                <x-table.td>
                                    <div class="w-full pb-2 whitespace-normal">
                                        @forelse ($employee->services as $service)
                                            <x-badge color="{{ $service->color }}" >
                                                <a href="{{ route('admin.company.service.edit', [$company, $service]) }}" class="whitespace-nowrap" title="{{ $service->description }}">{{ $service->name }}</a>
                                            </x-badge>
                                        @empty
                                            
                                        @endforelse
                                    </div>
                                </x-table.td>

                                <x-table.td>
                                    <div class="w-full pb-2">
                                        @forelse ($employee->admin->roles as $role)
                                            <x-badge color="green">
                                                {{ $role->name }}
                                            </x-badge>
                                        @empty
                                            
                                        @endforelse

                                        @forelse ($employee->roles as $role)
                                            <x-badge color="green">
                                                {{ $role->name }}
                                            </x-badge>
                                        @empty
                                            
                                        @endforelse
                                    </div>
                                </x-table.td>

                                <x-table.buttons>
                                    <x-a-buttons.edit href="{{ route('admin.company.employee.edit', [$company, $employee]) }}">
                                        {{ __('Edit') }}
                                    </x-a-buttons.edit>

                                    <x-buttons.delete action="{{ route('admin.company.employee.destroy', [$company, $employee]) }}">
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
            <a href="{{ route('admin.company.employee.create', $company) }}" class="block m-auto w-min whitespace-nowrap text-xl text-gray-500 hover:bg-indigo-700 hover:text-white p-3 rounded-lg">
                <i class="fa-solid fa-circle-plus"></i>
                Create employee
            </a>
        </div>
    </div>
</x-app-layout>