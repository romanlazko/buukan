<nav x-data="{ open: false }" class="w-full border-gray-100 py-2">
    <!-- Primary Navigation Menu -->
    <div class="w-full max-w-7xl mx-auto flex justify-between h-16 items-center space-x-12">

        <div class="shrink-0 flex items-center px-2">
            <a href="{{ route('welcome') }}">
                <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
            </a>
        </div>

        <div class="border-l h-full hidden md:block">

        </div>

        <x-header.menu class="sm:w-full"> 
            <div class="justify-between sm:flex w-full sm:space-y-0 space-y-5 p-2">
                <div class="sm:flex sm:space-x-6 sm:space-y-0 items-center space-y-5 ">
                    <x-nav-link :href="route('welcome')" :active="request()->routeIs('welcome')" class="block ">
                        <p class="text-gray-600 hover:text-indigo-600">{{ __('Main') }}</p>
                    </x-nav-link>
                    <x-nav-link :href="route('welcome')" :active="request()->routeIs('about')" class="block ">
                        <p class="text-gray-600 hover:text-indigo-600">{{ __('About') }}</p>
                    </x-nav-link>
                    <x-nav-link :href="route('welcome')" :active="request()->routeIs('kontakt')" class="block ">
                        <p class="text-gray-600 hover:text-indigo-600">{{ __('Kontakt') }}</p>
                    </x-nav-link>
                </div>
                <hr class="sm:hidden">
                <div class="flex space-x-2 sm:space-x-6 items-center">
                    @auth
                        <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')" class="block bg-indigo-600 px-4 py-2 rounded-2xl hover:bg-indigo-800">
                            {{ __('Dashboard') }}
                        </x-nav-link>
                    @else
                        <x-nav-link :href="route('admin.login')" :active="request()->routeIs('admin.login')" class="block ">
                            <p class="text-gray-600 hover:text-indigo-600">{{ __('Login') }}</p>
                        </x-nav-link>

                        @if (Route::has('admin.register'))
                            <x-nav-link :href="route('admin.register')" :active="request()->routeIs('admin.register')" class="block bg-indigo-600 px-4 py-2 rounded-2xl hover:bg-indigo-800">
                                {{ __('Register') }}
                            </x-nav-link>
                        @endif
                    @endauth
                </div>
            </div>
        </x-header.menu>
    </div>
</nav>
