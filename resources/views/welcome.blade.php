<x-guest-layout>
    <div></div>
    <section class="w-full sm:flex items-center p-5 space-y-12 sm:space-y-0 sm:space-x-20">
        <div class="w-full sm:w-2/3 space-y-12">
            <h1 class="text-5xl sm:text-6xl font-extrabold">
                ONLINE RESERVATION SYSTEM
            </h1>
            <h3 class="text-xl font-bold">
                Ваши правила. Наша технология.
            </h3>
            <p>
                Добро пожаловать в инновационную резервационную систему, созданную специально для профессионалов в сфере красоты и ухода. У нас есть все необходимое, чтобы ваш бизнес процветал и вы могли предоставлять своим клиентам высший уровень сервиса.
            </p>
            
            <ul class="text-gray-400 space-y-3">
                <x-a-buttons.button class="bg-blue-600 text-white" href="{{ route('admin.register') }}">
                    {{ __("Start free trial") }}
                </x-a-buttons.button>
                <li>
                    {{ __("No credit card required. ") }}
                </li>
                <li class="text-blue-500">
                    {{ __("31 days trial ") }}
                </li>
            </ul>
        </div>
        <div class="w-full sm:w-1/3">
            <div class="w-full" style="background-image:url({{ asset('img/public/phone.png')}});">
                <img class="m-auto " src="{{ asset('img/public/tablet.png')}}" alt="">
            </div>
        </div>
    </section>
</x-guest-layout>
