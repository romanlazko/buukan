<nav x-data="{ open: false }" class="w-full border border-gray-100 py-2">
    <!-- Primary Navigation Menu -->
    <div class="w-full max-w-6xl mx-auto flex justify-between h-16 items-center space-x-3 lg:space-x-12 px-4">

        <div class="shrink-0 flex items-center">
            <a href="{{ route('welcome') }}">
                <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
            </a>
        </div>

        <div class="w-full px-3 lg:px-12 border-x h-12 flex items-center justify-between">
            <div class="lg:flex space-x-2 sm:space-x-6 items-center hidden">
                <x-nav-link :href="route('welcome')" :active="request()->routeIs('welcome')" class="block ">
                    <p class="hover:text-indigo-600 hover:underline">{{ __('navigation.home') }}</p>
                </x-nav-link>
                <x-nav-link :href="route('prices')" :active="request()->routeIs('prices')" class="block ">
                    <p class="hover:text-indigo-600 hover:underline">{{ __('navigation.prices') }}</p>
                </x-nav-link>
                <x-nav-link :href="route('contacts')" :active="request()->routeIs('contacts')" class="block ">
                    <p class="hover:text-indigo-600 hover:underline">{{ __('navigation.contacts') }}</p>
                </x-nav-link>
            </div>

            <x-dropdown align="right" width="" >
                <x-slot name="trigger">
                    <x-nav-link class="block cursor-pointer">
                        <p class="text-gray-600 hover:text-indigo-600 hover:underline">{{ app()->getLocale() }}</p>
                    </x-nav-link>
                </x-slot>
                <x-slot name="content">
                    <x-dropdown-link href="{{ route('setlocale', 'ru') }}">
                        RU
                    </x-dropdown-link>
                    <x-dropdown-link href="{{ route('setlocale', 'cz') }}">
                        CZ
                    </x-dropdown-link>
                    <x-dropdown-link href="{{ route('setlocale', 'sk') }}">
                        SK
                    </x-dropdown-link>
                    <x-dropdown-link href="{{ route('setlocale', 'en') }}">
                        EN
                    </x-dropdown-link>
                </x-slot>
            </x-dropdown>
        </div>

        <div class="hidden lg:flex space-x-2 sm:space-x-6 items-center">
            @auth
                <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')" class="block bg-indigo-600 px-4 py-2 rounded-2xl hover:bg-indigo-800 hover:underline">
                    {{ __('navigation.dashboard') }}
                </x-nav-link>
            @else
                <x-nav-link :href="route('admin.login')" :active="request()->routeIs('admin.login')" class="block ">
                    <p class="hover:text-indigo-600 hover:underline">{{ __('navigation.login') }}</p>
                </x-nav-link>

                @if (Route::has('admin.register'))
                    <x-nav-link :href="route('admin.register')" :active="request()->routeIs('admin.register')" class="text-white block bg-indigo-600 px-4 py-2 rounded-lg hover:bg-indigo-800 hover:underline">
                        {{ __('navigation.register') }}
                    </x-nav-link>
                @endif
            @endauth
        </div>

        <div class="block lg:hidden">
            <x-dropdown align="right" width="" class="hidden">
                <x-slot name="trigger">
                    <i class="fa-solid fa-bars"></i>
                </x-slot>
                <x-slot name="content">
                    <x-dropdown-link :href="route('welcome')" :active="request()->routeIs('welcome')" class="block ">
                        <p class="text-gray-800 hover:text-indigo-600 hover:underline">{{ __('navigation.home') }}</p>
                    </x-dropdown-link>
                    <x-dropdown-link :href="route('prices')" :active="request()->routeIs('prices')" class="block ">
                        <p class="text-gray-800 hover:text-indigo-600 hover:underline">{{ __('navigation.prices') }}</p>
                    </x-dropdown-link>
                    <x-dropdown-link :href="route('contacts')" :active="request()->routeIs('contacts')" class="block ">
                        <p class="text-gray-800 hover:text-indigo-600 hover:underline">{{ __('navigation.contacts') }}</p>
                    </x-dropdown-link>
                    <hr>
                    @auth
                        <x-dropdown-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')" class="block bg-indigo-600 px-4 py-2 rounded-2xl hover:bg-indigo-800 hover:underline">
                            {{ __('navigation.dashboard') }}
                        </x-dropdown-link>
                    @else
                        <x-dropdown-link :href="route('admin.login')" :active="request()->routeIs('admin.login')" class="block ">
                            <p class="text-gray-600 hover:text-indigo-600 hover:underline">{{ __('navigation.login') }}</p>
                        </x-dropdown-link>

                        @if (Route::has('admin.register'))
                            <x-dropdown-link :href="route('admin.register')" :active="request()->routeIs('admin.register')" class="block bg-indigo-600 px-4 py-2 rounded-lg hover:bg-indigo-800 hover:underline text-white">
                                {{ __('navigation.register') }}
                            </x-dropdown-link>
                        @endif
                    @endauth
                </x-slot>
            </x-dropdown>
        </div>
        
    </div>
</nav>
