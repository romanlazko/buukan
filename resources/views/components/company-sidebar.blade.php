@hasanyrole('super-duper-admin|admin|administrator')
    <x-responsive-nav-link :href="route('admin.company.show', $company)" :active="request()->routeIs('admin.company.show')">
        {{ __('Dashboard') }}
    </x-responsive-nav-link>
@endhasanyrole

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
        <div class="flex space-x-2 items-center">
            @unlesssubscribed(['premium'])
                <i class="fa-solid fa-crown text-yellow-500"></i>
            @endsubscribed
            <p>{{ __('Telegram') }}</p>
        </div>
    </x-responsive-nav-link>
@endhasanyrole

@hasanyrole('super-duper-admin|admin|administrator')
    <x-responsive-nav-link :href="route('admin.company.web_app.index', $company)" :active="request()->routeIs('admin.company.web_app.*')">
        <div class="flex space-x-2 items-center">
            @unlesssubscribed(['premium'])
                <i class="fa-solid fa-crown text-yellow-500"></i>
            @endsubscribed
            <p>{{ __('WebApp') }}</p>
        </div>
    </x-responsive-nav-link>
@endhasanyrole

@hasanyrole('super-duper-admin|admin|administrator')
    <x-responsive-nav-link :href="route('admin.company.edit', $company)" :active="request()->routeIs('admin.company.edit')">
        {{ __('Settings') }}
    </x-responsive-nav-link>
@endhasanyrole

@hasanyrole('super-duper-admin|admin|administrator')
    <x-responsive-nav-link :href="route('admin.company.subscription.index', $company)">
        {{ __('Subscribtion') }}
    </x-responsive-nav-link>
@endhasanyrole

