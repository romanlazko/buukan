<header class="flex items-center justify-between px-2 md:px-4 py-1 bg-white border-b border-gray-300 space-x-3">
	<div class="flex items-center w-full">
		<button @click="sidebarOpen = true" class="text-gray-500 focus:outline-none lg:hidden">
			<svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d="M4 6H20M4 12H20M4 18H11" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
			</svg>
		</button>
		@if (isset($navigation))
			<div class="ml-2 lg:ml-0 flex items-center justify-between w-full space-x-2">
				{{ $navigation }}
			</div>
		@endif
	</div>
	
	
	<div class="flex items-center space-x-3">
		<div x-data="{ dropdownOpen: false }"  class="relative">
			<button @click="dropdownOpen = ! dropdownOpen" class="flex text-gray-500 hover:text-indigo-700">
				<i class="fa-solid fa-gear text-lg"></i>
			</button>

			<div x-cloak x-show="dropdownOpen" @click="dropdownOpen = false" class="fixed inset-0 z-10 w-full h-full"></div>

			<div x-cloak x-show="dropdownOpen" class="absolute right-0 z-20 mt-2 overflow-hidden bg-white rounded-md shadow-xl border">
				
				<a href="{{ route('admin.profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-600 hover:text-white">
					<div class="whitespace-nowrap">
						<div class="font-medium text-base">
							{{ __("header.profile") }}
						</div>
					</div>
				</a>
				<form method="POST" action="{{ route('admin.logout') }}">
					@csrf
					<button type="submit" class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-600 hover:text-white w-full text-left whitespace-nowrap">
						{{ __('header.logout') }}
					</button>
				</form>
			</div>
		</div>
	</div>
</header>