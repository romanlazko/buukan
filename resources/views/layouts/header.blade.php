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
		
		{{-- <div x-data="{ notificationOpen: false }" class="relative">
			<button @click="notificationOpen = ! notificationOpen" class="flex text-gray-500 hover:text-indigo-700">
				<i class="fa-solid fa-bell text-lg"></i>
			</button>

			<div x-cloak x-show="notificationOpen" @click="notificationOpen = false" class="fixed inset-0 z-10 w-full h-full"></div>

			<div x-cloak x-show="notificationOpen" class="absolute right-0 z-10 mt-2 overflow-hidden bg-white rounded-lg shadow-xl w-80" style="width:20rem;">
				<a href="#" class="flex items-center px-4 py-3 -mx-2 text-gray-600 hover:text-white hover:bg-indigo-600">
					<img class="object-cover w-8 h-8 mx-1 rounded-full" src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=334&q=80" alt="avatar">
					<p class="mx-2 text-sm">
						<span class="font-bold" href="#">Sara Salah</span> replied on the <span class="font-bold text-indigo-400" href="#">Upload Image</span> artical . 2m
					</p>
				</a>
				<a href="#" class="flex items-center px-4 py-3 -mx-2 text-gray-600 hover:text-white hover:bg-indigo-600">
					<img class="object-cover w-8 h-8 mx-1 rounded-full" src="https://images.unsplash.com/photo-1531427186611-ecfd6d936c79?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=634&q=80" alt="avatar">
					<p class="mx-2 text-sm">
						<span class="font-bold" href="#">Slick Net</span> start following you . 45m
					</p>
				</a>
				<a href="#" class="flex items-center px-4 py-3 -mx-2 text-gray-600 hover:text-white hover:bg-indigo-600">
					<img class="object-cover w-8 h-8 mx-1 rounded-full" src="https://images.unsplash.com/photo-1450297350677-623de575f31c?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=334&q=80" alt="avatar">
					<p class="mx-2 text-sm">
						<span class="font-bold" href="#">Jane Doe</span> Like Your reply on <span class="font-bold text-indigo-400" href="#">Test with TDD</span> artical . 1h
					</p>
				</a>
				<a href="#" class="flex items-center px-4 py-3 -mx-2 text-gray-600 hover:text-white hover:bg-indigo-600">
					<img class="object-cover w-8 h-8 mx-1 rounded-full" src="https://images.unsplash.com/photo-1580489944761-15a19d654956?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=398&q=80" alt="avatar">
					<p class="mx-2 text-sm">
						<span class="font-bold" href="#">Abigail Bennett</span> start following you . 3h
					</p>
				</a>
			</div>
		</div> --}}
		
		<div x-data="{ dropdownOpen: false }"  class="relative">
			<button @click="dropdownOpen = ! dropdownOpen" class="flex text-gray-500 hover:text-indigo-700">
				<i class="fa-solid fa-gear text-lg"></i>
			</button>

			<div x-cloak x-show="dropdownOpen" @click="dropdownOpen = false" class="fixed inset-0 z-10 w-full h-full"></div>

			<div x-cloak x-show="dropdownOpen" class="absolute right-0 z-10 mt-2 overflow-hidden bg-white rounded-md shadow-xl border">
				
				<a href="{{ route('admin.profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-600 hover:text-white">
					<div class="whitespace-nowrap">
						<div class="font-medium text-base">{{ __("Profile") }}</div>
					</div>
				</a>
				<form method="POST" action="{{ route('admin.logout') }}">
					@csrf
					<button type="submit" class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-600 hover:text-white w-full text-left whitespace-nowrap">
						{{ __('Log Out') }}
					</button>
				</form>
			</div>
		</div>
	</div>
</header>