<x-app-layout>
    <x-slot name="header">
        <form action="{{ route('admin.company.index') }}" class="flex items-center space-x-3 w-max">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Company:') }}
            </h2>
            <div class="relative mx-4 lg:mx-0">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                    <svg class="w-5 h-5 text-gray-500" viewBox="0 0 24 24" fill="none">
                        <path d="M21 21L15 15M17 10C17 13.866 13.866 17 10 17C6.13401 17 3 13.866 3 10C3 6.13401 6.13401 3 10 3C13.866 3 17 6.13401 17 10Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </span>
    
                <input class="w-full pl-10 pr-4 rounded-md form-input sm:w-64 focus:border-indigo-600" type="text" placeholder="Search by companies">
            </div>
        </form>
        
        <div class="w-min space-x-4 sm:-my-px sm:ml-10 flex">
            <x-a-buttons.secondary href="{{ route('admin.company.create') }}" class="float-right">
                {{ __("✚") }}
            </x-a-buttons.secondary>
        </div>
    </x-slot>
    <div class="">
        <x-white-block class="p-0">
            <x-table.table class="whitespace-nowrap">
                <x-table.thead>
                    <tr>
                        <x-table.th>id</x-table.th>
                        <x-table.th>Name</x-table.th>
                        <x-table.th>Description</x-table.th>
                        <x-table.th>ICO</x-table.th>
                        <x-table.th>DIC</x-table.th>
                        <x-table.th>Address</x-table.th>
                        <x-table.th>Action</x-table.th>
                    </tr>
                </x-table.thead>
                <x-table.tbody>
                    @forelse ($companies as $index => $company)
                        <tr class="@if($index % 2 === 0) bg-gray-100 @endif">
                            <x-table.td>{{ $company->id }}</x-table.td>
                            <x-table.td>{{ $company->name }}</x-table.td>
                            <x-table.td>{{ $company->description }}</x-table.td>
                            <x-table.td>{{ $company->ico }}</x-table.td>
                            <x-table.td>{{ $company->dic }}</x-table.td>
                            <x-table.td>{{ $company->address }}</x-table.td>

                            <x-table.buttons>
                                <x-a-buttons.primary href="{{ route('admin.company.edit', $company) }}">
                                    {{ __('Edit') }}
                                </x-a-buttons.primary>
                                <x-buttons.delete action="{{ route('admin.company.destroy', $company) }}">
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