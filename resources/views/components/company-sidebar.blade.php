@hasanyrole('super-duper-admin|admin|administrator')
    <x-responsive-nav-link :href="route('admin.company.appointment.index', $company)" :active="request()->routeIs('admin.company.appointment.*')">
        {{ __('Appointments') }}
    </x-responsive-nav-link>
@endhasanyrole

@hasanyrole('super-duper-admin|admin|administrator')
    <x-responsive-nav-link :href="route('admin.company.client.index', $company)" :active="request()->routeIs('admin.company.client.*')">
        {{ __('Clients') }}
    </x-responsive-nav-link>
@endhasanyrole

@hasanyrole('super-duper-admin|admin|administrator')
    <x-responsive-nav-link :href="route('admin.company.service.index', $company)" :active="[request()->routeIs('admin.company.service.*'), request()->routeIs('admin.company.sub_service.*')]">
        {{ __('Services') }}
    </x-responsive-nav-link>
@endhasanyrole

@hasanyrole('super-duper-admin|admin|administrator')
    <x-responsive-nav-link :href="route('admin.company.employee.index', $company)" :active="request()->routeIs('admin.company.employee.*')">
        {{ __('Employees') }}
    </x-responsive-nav-link>
@endhasanyrole

@hasanyrole('super-duper-admin|admin|administrator')
    <x-responsive-nav-link :href="route('admin.company.telegram_bot.index', $company)" :active="request()->routeIs('admin.company.telegram_bot.*')">
        {{ __('Telegram') }}
    </x-responsive-nav-link>
@endhasanyrole

@hasanyrole('super-duper-admin|admin|administrator')
    <x-responsive-nav-link :href="route('admin.company.web_app.index', $company)" :active="request()->routeIs('admin.company.web_app.*')">
        {{ __('WebApp') }}
    </x-responsive-nav-link>
@endhasanyrole

@hasanyrole('super-duper-admin|admin|administrator')
    <x-responsive-nav-link :href="route('admin.company.edit', $company)" :active="request()->routeIs('admin.company.edit')">
        {{ __('Settings') }}
    </x-responsive-nav-link>
@endhasanyrole

