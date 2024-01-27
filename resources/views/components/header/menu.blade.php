<div class="space-x-2 hidden lg:flex overflow-auto">
    {{ $slot }}
</div>
<div x-data="{ headerMenu: false }" class="lg:hidden">
    <button @click="headerMenu = ! headerMenu" class="px-4 py-1 hover:text-indigo-700 bg-gray-200 rounded-lg">
        <i class="fa-solid fa-ellipsis"></i>
    </button>

    <div x-cloak x-show="headerMenu" @click.outside="headerMenu = false" @close.stop="headerMenu = false" class="absolute right-0 z-20 mt-2 overflow-hidden bg-white rounded-md shadow-xl border p-2 space-y-2">
        {{ $slot }}
    </div>
</div>