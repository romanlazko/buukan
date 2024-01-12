<x-app-layout>
    <x-slot name="header">
        <div class="sm:flex items-center sm:space-x-3 w-max text-center">
            <h2 class="font-semibold text-xl text-gray-800">
                {{ __('Users:') }}
            </h2>
        </div>
        <x-header.menu>
            <x-header.link :href="route('super-duper-admin.user.index')" :active="request()->routeIs('super-duper-admin.user.*')">
                {{ __('User') }}
            </x-header.link>
            <x-header.link :href="route('super-duper-admin.role.index')" :active="request()->routeIs('super-duper-admin.role.*')">
                {{ __('Role') }}
            </x-header.link>
            <x-header.link :href="route('super-duper-admin.permission.index')" :active="request()->routeIs('super-duper-admin.permission.*')">
                {{ __('Permission') }}
            </x-header.link>
            <x-header.link class="float-right" :href="route('super-duper-admin.user.create')">
                <i class="fa-solid fa-circle-plus mr-1 text-indigo-700"></i>
                {{ __("Add user") }}
            </x-header.link>
        </x-header.menu>
    </x-slot>

    <div class="py-4 sm:p-4">
        <x-white-block class="p-0">
            <x-table.table class="whitespace-nowrap">
                <x-table.thead>
                    <tr>
                        <x-table.th>id</x-table.th>
                        @foreach ($attributes as $attribute)
                            <x-table.th>{{ ucfirst($attribute) }}</x-table.th>
                        @endforeach
                        <x-table.th>Role</x-table.th>
                        <x-table.th>Action</x-table.th>
                    </tr>
                </x-table.thead>
                <x-table.tbody>
                    @forelse ($users as $index => $user)
                        <tr class="@if($index % 2 === 0) bg-gray-100 @endif">
                            <x-table.td>{{ $user->id }}</x-table.td>
                            @foreach ($attributes as $attribute)
                                <x-table.td>{{ $user->$attribute }}</x-table.th>
                            @endforeach
                            <x-table.td>
                                @if ($user->roles)
                                    @forelse ($user->roles as $role)
                                        <x-badge color="gray">
                                            <a href="{{ route('admin.role.edit', $role) }}">{{ $role->name }}</a>
                                        </x-badge>
                                    @empty
                                        
                                    @endforelse
                                @endif
                                @if ($user->employee?->roles)
                                    @forelse ($user->employee->roles as $role)
                                        <x-badge color="gray">
                                            <a href="{{ route('admin.role.edit', $role) }}">{{ $role->name }}</a>
                                        </x-badge>
                                    @empty
                                        
                                    @endforelse
                                @endif
                            </x-table.td>
                            <x-table.buttons>
                                <x-a-buttons.primary href="{{ route('super-duper-admin.user.edit', $user) }}">Edit</x-a-buttons.primary>
                                <form action="{{ route('super-duper-admin.user.destroy', $user) }}" method="post" style="display: inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <x-buttons.danger>Delete</x-buttons.dangertton>
                                </form>
                            </x-table.buttons>
                        </tr>
                    @empty
                    @endforelse
                </x-table.tbody>
            </x-table.table>
        </x-white-block>
    </div>
</x-app-layout>