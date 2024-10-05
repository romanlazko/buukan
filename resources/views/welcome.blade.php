<x-guest-layout>
    <section class="max-w-6xl w-full m-auto sm:flex items-center px-4 py-12 space-y-12 sm:space-y-0 sm:space-x-20">
        <div class="w-full sm:w-1/3 space-y-8">
            <h1 class="leading-[50px] md:leading-[70px] text-[2.5rem] md:text-[3.5rem] font-[600] ">
                Online <br> RESERVATION <br> SYSTEM
            </h1>
            <p class="border-l-4 border-l-indigo-600 pl-4">
                {{ __("No more mistakes or overlaps. Manage your employees and schedule your client business from multiple sources in one simple calendar") }}
            </p>
            
            <div class="text-white space-y-4">
                <a class="bg-indigo-600 text-white py-2 px-4 rounded-2xl font-bold whitespace-nowrap block w-min hover:bg-indigo-800 transition ease-in-out duration-150" href="{{ route('admin.register') }}">
                    {{ __("Start 31 day trial") }}
                </a>
                <span class="whitespace-nowrap block text-orange-600 underline">
                    {{ __("No credit card required. ") }}
                </span>
            </div>
        </div>
        <div class="rounded-[16px] md:rounded-[20px] border-[2px] border-indigo-900 w-full md:w-2/3">
            <img class="rounded-[14px] md:rounded-[18px] border-4 md:border-[10px] border-gray-800" src="{{ asset('img/public/welcome/IMAGE 2024-02-18 14:23:31.jpg')}}" alt="">
        </div>
    </section>

    {{-- <hr class="border-dashed"> --}}

    <section class="max-w-6xl m-auto flex py-12">
        <div class="space-y-4 p-4 rounded-xl m-3">
            <h2 class=" text-orange-600 font-bold text-xl">
                YOUR RULES, OUR TECHNOLOGY.
            </h2>
            <h3 class="font-bold text-lg">
                Your time, our system
            </h3>
            <p class="border-l-4 border-l-indigo-600 pl-4">
                Resource optimization in every sphere with reservation systems. 
            </p>
        </div>
        <div class="w-full grid grid-cols-4 gap-4">
            <div class="bg-white p-2 rounded-xl space-y-4 shadow-2xl hover:bg-blue-600 hover:scale-105 transition ease-in-out duration-150 text-center">
                <img class="m-auto" src="{{ asset('img/public/welcome/icon/HAIR SALON.PNG')}}" alt="">
                <h2 class="text-black text-md font-bold">
                    Beauty Salon
                </h2>
            </div>
            <div class="bg-white p-2 rounded-xl space-y-4 shadow-2xl hover:bg-blue-600 hover:scale-105 transition ease-in-out duration-150 text-center">
                <img class="m-auto" src="{{ asset('img/public/welcome/icon/HAIR SALON.PNG')}}" alt="">
                <h2 class="text-black text-md font-bold">
                    Beauty Salon
                </h2>
            </div>
            <div class="bg-white p-2 rounded-xl space-y-4 shadow-2xl hover:bg-blue-600 hover:scale-105 transition ease-in-out duration-150 text-center">
                <img class="m-auto" src="{{ asset('img/public/welcome/icon/HAIR SALON.PNG')}}" alt="">
                <h2 class="text-black text-md font-bold">
                    Beauty Salon
                </h2>
            </div>
            <div class="bg-white p-2 rounded-xl space-y-4 shadow-2xl hover:bg-blue-600 hover:scale-105 transition ease-in-out duration-150 text-center">
                <img class="m-auto" src="{{ asset('img/public/welcome/icon/HAIR SALON.PNG')}}" alt="">
                <h2 class="text-black text-md font-bold">
                    Beauty Salon
                </h2>
            </div>
            <div class="bg-white p-2 rounded-xl space-y-4 shadow-2xl hover:bg-blue-600 hover:scale-105 transition ease-in-out duration-150 text-center">
                <img class="m-auto" src="{{ asset('img/public/welcome/icon/HAIR SALON.PNG')}}" alt="">
                <h2 class="text-black text-md font-bold">
                    Beauty Salon
                </h2>
            </div>
            <div class="bg-white p-2 rounded-xl space-y-4 shadow-2xl hover:bg-blue-600 hover:scale-105 transition ease-in-out duration-150 text-center">
                <img class="m-auto" src="{{ asset('img/public/welcome/icon/HAIR SALON.PNG')}}" alt="">
                <h2 class="text-black text-md font-bold">
                    Beauty Salon
                </h2>
            </div>
            <div class="bg-white p-2 rounded-xl space-y-4 shadow-2xl hover:bg-blue-600 hover:scale-105 transition ease-in-out duration-150 text-center">
                <img class="m-auto" src="{{ asset('img/public/welcome/icon/HAIR SALON.PNG')}}" alt="">
                <h2 class="text-black text-md font-bold">
                    Beauty Salon
                </h2>
            </div>
            <div class="bg-white p-2 rounded-xl space-y-4 shadow-2xl hover:bg-blue-600 hover:scale-105 transition ease-in-out duration-150 text-center">
                <img class="m-auto" src="{{ asset('img/public/welcome/icon/HAIR SALON.PNG')}}" alt="">
                <h2 class="text-black text-md font-bold">
                    Beauty Salon
                </h2>
            </div>
        </div>
        
    </section>

    {{-- <hr class="border-dashed"> --}}

    <section class="md:flex max-w-6xl m-auto items-center md:space-x-12 justify-between space-y-12 md:space-y-0 px-4 py-12">
        <div class="space-y-12 w-full">
            <p class="text-xl text-indigo-700 font-bold">
                {{ __("Reservation system") }}
            </p>
            <h2 class="text-4xl font-bold">
                {{ __("Create your schedule") }}
            </h2>
            <p class="text-xl border-l-4 border-l-indigo-600 pl-4">
                {{ __("Delegate your schedule and client records to us, and spend the time you save on improve your business!") }}
            </p>
            <a class="bg-indigo-600 text-white py-2 px-4 rounded-2xl font-bold whitespace-nowrap block w-min hover:bg-indigo-800 transition ease-in-out duration-150" href="{{ route('admin.register') }}">
                {{ __("Try it for free") }}
            </a>
        </div>
        <div class="md:flex border-l border-dashed h-[600px] hidden ">

        </div>
        <div class="w-full flex justify-center hover:scale-105 transition ease-in-out duration-150" x-data="{
            images: [
                '{{ asset('img/public/welcome/IMG_5908.PNG')}}',
                '{{ asset('img/public/welcome/IMG_5909.PNG')}}',
                '{{ asset('img/public/welcome/IMG_5910.PNG')}}',
                '{{ asset('img/public/welcome/IMG_5911.PNG')}}',
            ],
            selected: 0
        }" x-init="setInterval(() => selected = (selected + 1) % images.length, 4000)"">
            <div class="rounded-[45px] border-[2px] border-indigo-900">
                <img :src="images[selected]" alt="" class="rounded-[42px] border-[10px] border-gray-800 max-h-[600px]">
            </div>
        </div>
    </section>

    {{-- <hr class="border-dashed"> --}}

    <section class="md:flex max-w-6xl m-auto items-center md:space-x-12 justify-between space-y-12 md:space-y-0 px-4 py-12">
        <div class="space-y-12 w-full">
            <p class="text-xl text-indigo-700 font-bold">
                Online booking
            </p>
            <h2 class="text-4xl font-bold">
                Give link to your customer
            </h2>
            <p class="text-white font-bold">
                #perfectly works everywhere
            </p>
            <p class="text-xl border-l-4 border-l-indigo-600 pl-4">
                Clients can reach the site on every device or just write direct message via Telegram, ensuring a seamless and user friendly experience.
            </p>
            <ul class="text-md text-gray-700">
                <li><span class="text-indigo-600 font-bold">WebApp</span> - web application for reservation</li>
                <li><span class="text-indigo-600 font-bold">Telegram</span> - bot for reservation</li>
            </ul>
            <a class="bg-indigo-600 text-white py-2 px-4 rounded-2xl font-bold whitespace-nowrap block w-min hover:bg-indigo-800 transition ease-in-out duration-150" href="{{ route('admin.register') }}">
                {{ __("Try it for free") }}
            </a>
        </div>
        <div class="md:flex hidden border-l border-dashed h-[600px]">

        </div>
        <div class="w-full flex justify-center hover:scale-105 transition ease-in-out duration-150" x-data="{
            images: [
                '{{ asset('img/public/welcome/IMG_5908.PNG')}}',
                '{{ asset('img/public/welcome/IMG_5909.PNG')}}',
                '{{ asset('img/public/welcome/IMG_5910.PNG')}}',
                '{{ asset('img/public/welcome/IMG_5911.PNG')}}',
            ],
            selected: 0
        }" x-init="setInterval(() => selected = (selected + 1) % images.length, 4000)"">
            <div class="rounded-[45px] border-[2px] border-indigo-900">
                <img :src="images[selected]" alt="" class="rounded-[42px] border-[10px] border-gray-800 max-h-[600px]">
            </div>
        </div>
    </section>

    {{-- <hr class="border-dashed"> --}}

    <section class="max-w-6xl m-auto items-center space-y-12 px-4 py-12">
        <div class="md:flex md:space-x-12 justify-between items-center space-y-12 md:space-y-0">
            <div class="w-full space-y-12">
                <p class="text-xl text-indigo-700 font-bold">
                    Appointment reminder
                </p>
                <h2 class="text-4xl font-bold">
                    Reduce no-shows and increase repetitive sales
                </h2>
            </div>
            <div class="w-full ">
                <div class="bg-gray-100 rounded-lg shadow-2xl p-4 hover:bg-gray-50 hover:scale-105 transition ease-in-out duration-150">
                    <div class="flex space-x-2 items-center">
                        <i class="fa-solid fa-envelope-open-text text-indigo-600"></i>
                        <p class="text-lg font-bold">Buukan team</p>
                    </div>
                    <p>
                        We would like to remind you that you have an appointment booked on 20.04.2024 at 16:00.
                    </p>
                </div>
            </div>
        </div>
        <div class="max-w-3xl space-y-12">
            <p class="text-xl border-l-4 border-l-indigo-600 pl-4">
                Use marketing tools that definitely work - set up automatic notifications for customers. Communicate with your audience via email and telegram notifications.
            </p>
            <ul class="text-md text-gray-700 space-y-4">
                <li class="items-center space-x-3 flex">
                    <i class="fa-solid fa-square-check text-orange-600 text-4xl"></i>
                    <p>Based on our research  - automatic reminders helps to reduce tardiness by 60%.</p>
                </li>
                <li class="items-center space-x-3 flex">
                    <i class="fa-solid fa-square-check text-orange-600 text-4xl"></i>
                    <p>You will get a reminder of upcoming client, so you do not have to keep it in mind and can focus on things which matter.</p>
                </li>
            </ul>
            <a class="bg-indigo-600 text-white py-2 px-4 rounded-2xl font-bold whitespace-nowrap block w-min hover:bg-indigo-800 transition ease-in-out duration-150" href="{{ route('admin.register') }}">
                {{ __("Try it for free") }}
            </a>
        </div>
    </section>

    <section class="w-full bg-blue-950 px-4 py-12">
        <div class="space-y-12 max-w-6xl m-auto">
            <div class="w-full space-y-12 max-w-xl  text-white">
                <p class="text-xl text-indigo-300 font-bold">
                    Don't waste your time
                </p>
                <h2 class="text-4xl font-bold">
                    Spend your time on business development
                </h2>
                <p>
                    Unlock your potential by streamlining your agenda. Buukan is your partner who can make your business journey more efficient and agile.
                </p>
            </div>
            <div class="md:flex w-full justify-between md:space-x-6 space-y-6 md:space-y-0">
                <div class="w-full bg-blue-700 p-6 rounded-lg text-white space-y-8 hover:bg-blue-600 hover:scale-105 transition ease-in-out duration-150">
                    <i class="fa-solid fa-user-clock text-5xl"></i>
                    <h3 class=" text-xl font-bold ">
                        Find a client for a second
                    </h3>
                    <p>
                        Start typing a name or contact into the search engine and the program will immediately show all the information about the client and their records.
                    </p>
                </div>
                <div class="w-full bg-gray-50 p-6 rounded-lg text-black space-y-8 hover:bg-gray-100 hover:scale-105 transition ease-in-out duration-150">
                    <i class="fa-solid fa-wand-magic-sparkles text-5xl text-blue-700"></i>
                    <h3 class=" text-xl font-bold ">
                        Integrate Buukan with your site
                    </h3>
                    <p>
                        Records from your website will be instantly displayed on the Buukan platform.
                    </p>
                </div>
                <div class="w-full bg-gray-50 p-6 rounded-lg text-black space-y-8 hover:bg-gray-100 hover:scale-105 transition ease-in-out duration-150">
                    <i class="fa-regular fa-calendar-days text-5xl text-blue-700"></i>
                    <h3 class=" text-xl font-bold">
                        Schedule in your smartphone
                    </h3>
                    <p>
                        Client base and logbook always at your fingertips. Work with schedules through the Buukan system.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section class="md:flex max-w-6xl m-auto items-center md:space-x-12 justify-between space-y-12 md:space-y-0 px-4 py-12">
        <div class="space-y-12 w-full">
            <h2 class="text-4xl font-bold">
                Ready to get started?
            </h2>
            <p class="text-xl border-l-4 border-l-indigo-600 pl-4">
                Login or create an account and start attracting more customers.
            </p>
            <div class="flex space-x-4 items-center">
                <a class=" text-gray-800 font-bold whitespace-nowrap block w-min hover:text-gray-500 transition ease-in-out duration-150" href="{{ route('admin.login') }}">
                    {{ __("Login") }}
                </a>
                <a class="bg-indigo-600 text-white py-2 px-4 rounded-2xl font-bold whitespace-nowrap block w-min hover:bg-indigo-800 transition ease-in-out duration-150" href="{{ route('admin.register') }}">
                    {{ __("Try it for free") }}
                </a>
                
            </div>
        </div>
        <div class="w-full bg-white overflow-hidden shadow-3xl rounded-lg p-4">
            <form method="POST" >
                @csrf
        
                <!-- Name -->
                
                <div class="w-full">
                    <x-form.label for="name" :value="__('Name:')" />
                    <x-form.input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required />
                    <x-form.error :messages="$errors->get('name')" class="mt-2" />
                </div>
                
        
                <!-- Email Address -->
                <div class="mt-4">
                    <x-form.label for="email" :value="__('Email:')" />
                    <x-form.input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
                    <x-form.error :messages="$errors->get('email')" class="mt-2" />
                </div>
        
                <!-- Confirm Password -->
                <div class="mt-4">
                    <x-form.label for="question" :value="__('Question:')" />
                    <x-form.textarea>
                    </x-form.textarea>
                </div>
        
                <div class="flex items-center justify-end mt-4">
                    <x-buttons.primary class="ml-4">
                        {{ __('Send') }}
                    </x-buttons.primary>
                </div>
            </form>
        </div>
    </section>

    <footer class="w-full bg-gray-800 text-gray-300">
        <div class="flex justify-between max-w-6xl m-auto px-4 py-6">
            <div class="space-y-4">
                <a href="www.buukan.com" class="w-full text-xl block text-white font-bold hover:underline">BUUKAN.com</a>
                <a href="" class="w-full block text-gray-400 hover:underline">
                    <span class="block">
                        Fyzická osoba
                    </span>
                    <span class="block">
                        Hybešova 64/31
                    </span>
                    <span class="block">
                        IČO: 11940255
                    </span>
                </a>
                <a href="" class="w-full block hover:underline">
                    info@buukan.com
                </a>
            </div>
            <div class="space-y-4 justify-self-center">
                <h3 href="" class="w-full text-xl block text-white font-bold">Important information</h3>
                <a href="" class="w-full block hover:underline">About us</a>
                <x-dropdown align="bottom" width="48">
                    <x-slot name="trigger">
                        <button class="w-full text-left hover:underline">
                            Terms and conditions
                        </button>
                    </x-slot>
                    <x-slot name="content">
                        <x-dropdown-link target="_blank" href="{{ asset('terms_of_use/terms_of_use_cz.pdf')}}">
                            Ru
                        </x-dropdown-link>
                        <x-dropdown-link target="_blank" href="{{ asset('terms_of_use/terms_of_use_cz.pdf')}}">
                            Cz
                        </x-dropdown-link>
                        <x-dropdown-link target="_blank" href="{{ asset('terms_of_use/terms_of_use_en.pdf')}}">
                            En
                        </x-dropdown-link>
                    </x-slot>
                </x-dropdown>
                <x-dropdown align="bottom" width="48">
                    <x-slot name="trigger">
                        <button class="w-full text-left hover:underline">
                            GDPR
                        </button>
                    </x-slot>
                    <x-slot name="content">
                        <x-dropdown-link target="_blank" href="{{ asset('terms_of_use/terms_of_use_cz.pdf')}}">
                            Ru
                        </x-dropdown-link>
                        <x-dropdown-link target="_blank" href="{{ asset('terms_of_use/terms_of_use_cz.pdf')}}">
                            Cz
                        </x-dropdown-link>
                        <x-dropdown-link target="_blank" href="{{ asset('terms_of_use/terms_of_use_en.pdf')}}">
                            En
                        </x-dropdown-link>
                    </x-slot>
                </x-dropdown>
            </div>
            <div class="space-y-4">
                <h3 href="" class="w-full text-xl block text-white font-bold">Help</h3>
                <a href="" class="w-full block hover:underline">Kontact</a>
                <a href="" class="w-full block hover:underline">FAQ</a>
                <a href="" class="w-full block hover:underline">Support 24/7</a>
            </div>
        </div>
        
    </footer>
</x-guest-layout>
 