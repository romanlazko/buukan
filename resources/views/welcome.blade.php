<x-guest-layout>
    <section class="max-w-6xl w-full m-auto sm:flex items-center px-4 py-12 space-y-12 sm:space-y-0 sm:space-x-20">
        <div class="w-full sm:w-1/3 space-y-8">
            <h1 class="leading-[50px] md:leading-[70px] text-[2.5rem] md:text-[3.5rem] font-extrabold">
                Online <br> RESERVATION <br> SYSTEM
            </h1>
            <p>
                No more errors and overlaps. Schedule employees and work with client records from multiple sources on a single calendar.
            </p>
            
            <div class="text-white space-y-4">
                <a class="bg-indigo-600 text-white py-2 px-4 rounded-2xl font-bold whitespace-nowrap block w-min hover:bg-indigo-800 transition ease-in-out duration-150" href="{{ route('admin.register') }}">
                    {{ __("Start 31 day trial") }}
                </a>
                <span class="whitespace-nowrap block text-orange-600">
                    {{ __("No credit card required. ") }}
                </span>
            </div>
        </div>
        <div class="rounded-[20px] md:rounded-[40px] border-[2px] border-gray-600 w-full md:w-2/3">
            <img class="rounded-[18px] md:rounded-[38px] border-8 md:border-[10px] border-gray-100" src="{{ asset('img/public/welcome/IMAGE 2024-02-18 14:23:31.jpg')}}" alt="">
        </div>
    </section>

    <section class="max-w-6xl m-auto grid grid-cols-1 md:grid-cols-3 py-12">
        <div class="space-y-4 p-4 rounded-xl m-3">
            <h2 class=" text-orange-600 font-bold text-xl">
                YOUR RULES, OUR TECHNOLOGY.
            </h2>
            <h3 class="font-bold text-lg">
                Your time, our system
            </h3>
            <p>
                Resource optimization in every sphere with reservation systems. 
            </p>
        </div>
        <div class="bg-blue-700 p-4 rounded-xl space-y-4 m-3 shadow-2xl hover:bg-blue-600 hover:scale-105 transition ease-in-out duration-150">
            <svg width="61" height="61" viewBox="0 0 61 61" fill="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                <mask id="mask0_157_709" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="61" height="61">
                    <rect width="61" height="61" fill="url(#pattern0)"/>
                </mask>
                <g mask="url(#mask0_157_709)">
                    <rect width="61" height="61" fill="url(#pattern1)"/>
                    <rect width="61" height="61" fill="white"/>
                </g>
                <defs>
                    <pattern id="pattern0" patternContentUnits="objectBoundingBox" width="1" height="1">
                        <use xlink:href="#image0_157_709" transform="scale(0.00195312)"/>
                    </pattern>
                    <pattern id="pattern1" patternContentUnits="objectBoundingBox" width="1" height="1">
                        <use xlink:href="#image0_157_709" transform="scale(0.00195312)"/>
                    </pattern>
                    <image id="image0_157_709" width="512" height="512" xlink:href="data:image/png;base64,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"/>
                </defs>
            </svg>
                
            <h2 class="text-white text-md font-bold">
                Beauty Salon
            </h2>
            <p class="text-gray-300">
                The salon can easily manage its schedule, avoiding overloads or downtime, contributing to increased staff efficiency. 
            </p>
        </div>
        <div class="bg-white p-4 rounded-xl space-y-4 m-3 shadow-2xl hover:bg-gray-100 hover:scale-105 transition ease-in-out duration-150">
            <img src="{{ asset('img/public/icon/HAIR SALON.PNG')}}" alt="">
            <h2 class="text-black text-md font-bold">
                Hair Salon
            </h2>
            <p class="text-gray-500">
                The salon can easily manage its schedule, avoiding overloads or downtime, contributing to increased staff efficiency. 
            </p>
        </div>
        <div class="bg-white p-4 rounded-xl space-y-4 m-3 shadow-2xl hover:bg-gray-100 hover:scale-105 transition ease-in-out duration-150">
            <img src="{{ asset('img/public/icon/HAIR SALON.png')}}" alt="">
            <h2 class="text-black text-md font-bold">
                Hair Salon
            </h2>
            <p class="text-gray-500">
                The salon can easily manage its schedule, avoiding overloads or downtime, contributing to increased staff efficiency. 
            </p>
        </div>
        <div class="bg-white p-4 rounded-xl space-y-4 m-3 shadow-2xl hover:bg-gray-100 hover:scale-105 transition ease-in-out duration-150">
            <img src="{{ asset('img/public/icon/HAIR SALON.png')}}" alt="">
            <h2 class="text-black text-md font-bold">
                Hair Salon
            </h2>
            <p class="text-gray-500">
                The salon can easily manage its schedule, avoiding overloads or downtime, contributing to increased staff efficiency. 
            </p>
        </div>
        <div class="bg-white p-4 rounded-xl space-y-4 m-3 shadow-2xl hover:bg-gray-100 hover:scale-105 transition ease-in-out duration-150">
            <img src="{{ asset('img/public/icon/HAIR SALON.png')}}" alt="">
            <h2 class="text-black text-md font-bold">
                Hair Salon
            </h2>
            <p class="text-gray-500">
                The salon can easily manage its schedule, avoiding overloads or downtime, contributing to increased staff efficiency. 
            </p>
        </div>
        <div class="bg-white p-4 rounded-xl space-y-4 m-3 shadow-2xl hover:bg-gray-100 hover:scale-105 transition ease-in-out duration-150">
            <img src="{{ asset('img/public/icon/HAIR SALON.png')}}" alt="">
            <h2 class="text-black text-md font-bold">
                Hair Salon
            </h2>
            <p class="text-gray-500">
                The salon can easily manage its schedule, avoiding overloads or downtime, contributing to increased staff efficiency. 
            </p>
        </div>
        <div class="bg-white p-4 rounded-xl space-y-4 m-3 shadow-2xl hover:bg-gray-100 hover:scale-105 transition ease-in-out duration-150">
            <img src="{{ asset('img/public/icon/HAIR SALON.png')}}" alt="">
            <h2 class="text-black text-md font-bold">
                Hair Salon
            </h2>
            <p class="text-gray-500">
                The salon can easily manage its schedule, avoiding overloads or downtime, contributing to increased staff efficiency. 
            </p>
        </div>
        <div class="bg-white p-4 rounded-xl space-y-4 m-3 shadow-2xl hover:bg-gray-100 hover:scale-105 transition ease-in-out duration-150">
            <img src="{{ asset('img/public/icon/HAIR SALON.png')}}" alt="">
            <h2 class="text-black text-md font-bold">
                Hair Salon
            </h2>
            <p class="text-gray-500">
                The salon can easily manage its schedule, avoiding overloads or downtime, contributing to increased staff efficiency. 
            </p>
        </div>
    </section>

    <section class="md:flex max-w-6xl m-auto items-center md:space-x-12 justify-between space-y-12 md:space-y-0 px-4 py-12">
        <div class="space-y-12 w-full">
            <p class="text-xl text-indigo-700 font-bold">
                Schedule system
            </p>
            <h2 class="text-4xl font-bold">
                Create your schedule
            </h2>
            <p class="text-xl">
                Delegate your schedule and client records to us, and spend the time you save on upgrade your business!
            </p>
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
            <div class="rounded-[45px] border-[2px] border-gray-600">
                <img :src="images[selected]" alt="" class="rounded-[42px] border-[14px] border-gray-100 max-h-[600px]">
            </div>
        </div>
    </section>

    <section class="md:flex max-w-6xl m-auto items-center md:space-x-12 justify-between space-y-12 md:space-y-0 px-4 py-12">
        <div class="space-y-12 w-full">
            <p class="text-xl text-indigo-700 font-bold">
                Online booking
            </p>
            <h2 class="text-4xl font-bold">
                Give link to your customer
            </h2>
            <p class="text-xl">
                Delegate your schedule and client records to us, and spend the time you save on upgrade your business!
            </p>
            <ul class="text-md text-gray-700">
                <li><span class="text-indigo-600 font-bold">WebApp</span> - web application for reservation</li>
                <li><span class="text-indigo-600 font-bold">Telegram</span> - bot for reservation</li>
            </ul>
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
            <div class="rounded-[45px] border-[2px] border-gray-600">
                <img :src="images[selected]" alt="" class="rounded-[42px] border-[14px] border-gray-100 max-h-[600px]">
            </div>
        </div>
    </section>

    <section class="max-w-6xl m-auto items-center space-y-12 px-4 py-12">
        <div class="md:flex md:space-x-12 justify-between items-center space-y-12 md:space-y-0">
            <div class="w-full space-y-12">
                <p class="text-xl text-indigo-700 font-bold">
                    Appointment reminder
                </p>
                <h2 class="text-4xl font-bold">
                    Reduce no-shows and increase repeat sales
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
            <p class="text-xl">
                Use marketing tools that definitely work - set up automatic notifications for customers. Communicate with your audience via sms and email newsletters, in-app notifications or messengers.
            </p>
            <ul class="text-md text-gray-700 space-y-4">
                <li class="items-center space-x-3 flex">
                    <i class="fa-solid fa-square-check text-orange-600 text-4xl"></i>
                    <p>Send appointment reminders to customer and reduce tardiness by 60%.</p>
                </li>
                <li class="items-center space-x-3 flex">
                    <i class="fa-solid fa-square-check text-orange-600 text-4xl"></i>
                    <p>Get a reminder of upcoming recordings so you don't have to prepare.</p>
                </li>
            </ul>
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
                    Unlock your potential by streamlining your tasks. Buukan is here to make your business development journey efficient and seamless.
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
            <p class="text-xl">
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

    <footer class="w-full bg-gray-800 h-12">

    </footer>
</x-guest-layout>
 