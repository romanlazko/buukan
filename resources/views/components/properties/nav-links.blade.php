<div {{ $attributes->merge(['class' => 'whitespace-nowrap']) }}>
    <x-nav-link :href="route('admin.property.unit.index', $property)" :active="request()->routeIs('admin.property.unit.*')">
        {{ __('Units') }}
    </x-nav-link>
    <x-nav-link :href="route('admin.property.tenant.index', $property)" :active="request()->routeIs('admin.property.tenant.*')">
        {{ __('Tenants') }}
    </x-nav-link>
    {{ $slot ?? null }}
</div>