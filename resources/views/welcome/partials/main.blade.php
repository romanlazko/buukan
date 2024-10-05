<section class="max-w-6xl w-full m-auto py-12 md:flex space-y-12 lg:space-y-0 space-x-0 items-center z-50 p-4 md:space-x-12">
    <div class="w-full space-y-9 md:w-1/2 lg:w-1/3">
        <h1 class="text-5xl leading-[4rem] font-extrabold bg-gradient-to-r from-indigo-500 to-purple-800 text-transparent bg-clip-text">
            {{ __("Online RESERVATION SYSTEM") }}
        </h1>

        <p>
            <b>{{ __("No more errors and overlaps.") }}</b>
            {{ __("Schedule employees and work with client records from multiple sources on a single calendar.") }}
        </p>

        <x-a-buttons.button href="{{ route('admin.login') }}" class="w-full text-center justify-center text-xl p-3 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg">
            {{ __('Start for free') }}
        </x-a-buttons.button>
        
        <ul class="xl:flex xl:space-x-2 space-y-3 xl:space-y-0">
            <li>
                <div class="flex items-center space-x-3">
                    <i class="fa-solid fa-check text-1xl text-green-500 bg-green-100 w-6 h-6 flex items-center justify-center rounded-full"></i>
                    <p>
                        {{ __("31 days free trial") }}
                    </p>
                </div>
            </li>
            <li>
                <div class="flex items-center space-x-3">
                    <i class="fa-solid fa-check text-1xl text-green-500 bg-green-100 w-6 h-6 flex items-center justify-center rounded-full"></i>
                    <p>
                        {{ __("No credit card required") }}
                    </p>
                </div>
            </li>
        </ul>
    </div>

    <div class="rounded-[16px] md:rounded-[20px] border-[2px] border-indigo-900 w-full md:w-1/2 lg:w-2/3">
        <img class="rounded-[14px] md:rounded-[18px] border-4 md:border-[10px] border-gray-800 shadow-2xl" src="{{ asset('img/public/welcome/IMAGE 2024-02-18 14:23:31.jpg')}}" alt="">
    </div>
</section>