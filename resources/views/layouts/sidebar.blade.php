<div x-cloak :class="sidebarOpen ? 'block' : 'hidden'" @click="sidebarOpen = false" class="fixed inset-0 z-20 transition-opacity bg-black  opacity-50 lg:hidden"></div>
    
<div x-cloak :class="sidebarOpen ? 'translate-x-0 ease-out' : '-translate-x-full ease-in'" class="fixed inset-y-0 left-0 z-30 w-full sm:w-64 overflow-y-auto transition duration-300 transform bg-gray-900 lg:translate-x-0 lg:static lg:inset-0">
    <div class="justify-between flex items-center md:justify-center p-4">
        <div class="flex items-center justify-center">
			<a href="{{ route('admin.dashboard') }}" class="flex items-center justify-between  w-full px-10 py-3 bg-blue-600 rounded-full hover:bg-blue-500 text-2xl font-semibold text-white">
				{{ auth()->user()?->company->name ?? auth()->user()->employee?->company->name ?? __("+Add") }}
			</a>
        </div>
		<button @click="sidebarOpen = false" class="text-gray-500 focus:outline-none lg:hidden">
			<svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d="M4 6H20M4 12H20M4 18H11" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
			</svg>
		</button>
    </div>

    <nav class="space-y-3">
		<x-company-sidebar/>

		@hasrole('super-duper-admin')
			<x-responsive-nav-link :href="route('super-duper-admin.user.user.index')" :active="request()->routeIs('super-duper-admin.user.*')">
				{{ __('Users') }}
			</x-responsive-nav-link>
		@endhasrole

		<hr>
		
		<x-responsive-nav-link :href="route('admin.profile.edit')" :active="request()->routeIs('admin.profile.*')">
			{{ __('Profile') }}
		</x-responsive-nav-link>
		<x-responsive-nav-link>
			<form method="POST" action="{{ route('admin.logout') }}">
				@csrf
				<button type="submit" >
					{{ __('Log Out') }}
				</button>
			</form>
		</x-responsive-nav-link>
    </nav>
</div>