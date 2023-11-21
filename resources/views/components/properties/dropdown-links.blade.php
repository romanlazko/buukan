<div x-data="{ dropdownOpen: false }"  class="relative sm:hidden">
    <button @click="dropdownOpen = ! dropdownOpen" class="relative block w-8 h-8 overflow-hidden ">
        <i class="fa-solid fa-ellipsis"></i>
    </button>

    <div x-cloak x-show="dropdownOpen" @click="dropdownOpen = false" class="fixed inset-0 z-10 w-full h-full"></div>

    <div x-cloak x-show="dropdownOpen" class="absolute right-0 z-10 mt-2 overflow-hidden bg-white rounded-md shadow-xl border">
        <x-responsive-nav-link :href="route('admin.property.unit.index', $property)" :active="request()->routeIs('admin.property.unit.*')">
            {{ __('Units') }}
        </x-responsive-nav-link>
        <x-responsive-nav-link :href="route('admin.property.tenant.index', $property)" :active="request()->routeIs('admin.property.tenant.*')">
            {{ __('Tenants') }}
        </x-responsive-nav-link>
    </div>
</div>