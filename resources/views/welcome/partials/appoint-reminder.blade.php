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
                <i class="fa-solid fa-check text-1xl text-green-500 bg-green-100 w-6 h-6 flex items-center justify-center rounded-full"></i>
                <p>Based on our research  - automatic reminders helps to reduce tardiness by 60%.</p>
            </li>
            <li class="items-center space-x-3 flex">
                <i class="fa-solid fa-check text-1xl text-green-500 bg-green-100 w-6 h-6 flex items-center justify-center rounded-full"></i>
                <p>You will get a reminder of upcoming client, so you do not have to keep it in mind and can focus on things which matter.</p>
            </li>
        </ul>
        <a class="bg-indigo-600 text-white py-2 px-4 rounded-lg whitespace-nowrap block w-min hover:bg-indigo-800 transition ease-in-out duration-150" href="{{ route('admin.register') }}">
            {{ __("Try it for free") }}
        </a>
    </div>
</section>