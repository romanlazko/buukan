<div class="space-x-4 lg:-my-px lg:ml-10 lg:flex hidden ">
    {{ $slot }}
</div>
<div x-data="{ headerMenu: false }"  class="lg:hidden">
    <button @click="headerMenu = ! headerMenu" class="w-6">
        <i class="fa-solid fa-ellipsis-vertical"></i>
    </button>

    <div x-cloak x-show="headerMenu" @click="headerMenu = false" class="fixed inset-0 z-10 w-full h-full"></div>

    <div x-cloak x-show="headerMenu" class="absolute right-0 z-10 mt-2 overflow-hidden bg-white rounded-md shadow-xl border">
        {{ $slot }}
    </div>
</div>