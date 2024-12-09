<section class="max-w-6xl m-auto items-center space-y-12 px-4 py-12">
    <div class="md:flex md:space-x-12 justify-between items-center space-y-12 md:space-y-0">
        <div class="w-full space-y-12">
            <p class="text-xl text-indigo-700 font-bold">
                {{ __('welcome.appointment_reminder.subtitle') }}
            </p>
            <h2 class="text-4xl font-bold">
                {{ __('welcome.appointment_reminder.title') }}
            </h2>
        </div>
        <div class="w-full ">
            <div class="bg-gray-100 rounded-lg shadow-2xl p-4 hover:bg-gray-50 hover:scale-105 transition ease-in-out duration-150">
                <div class="flex space-x-2 items-center">
                    <i class="fa-solid fa-envelope-open-text text-indigo-600"></i>
                    <p class="text-lg font-bold">
                        {{ __('welcome.appointment_reminder.buukan_team') }}
                    </p>
                </div>
                <p>
                    {{ __('welcome.appointment_reminder.we_would_like_to_remind_you_that_you_have_an_appointment_booked_on_20_04_2024_at_16_00') }}
                </p>
            </div>
        </div>
    </div>
    <div class="max-w-3xl space-y-12">
        <p class="text-xl border-l-4 border-l-indigo-600 pl-4">
            {{ __('welcome.appointment_reminder.description') }}
        </p>
        <ul class="text-md text-gray-700 space-y-4">
            <li class="items-center space-x-3 flex">
                <i class="fa-solid fa-check text-1xl text-green-500 bg-green-100 w-6 h-6 min-w-6 min-h-6 flex items-center justify-center rounded-full"></i>
                <p>
                    {{ __('welcome.appointment_reminder.based_on_our_research_automatic_reminders_helps_to_reduce_tardiness_by_60') }}
                </p>
            </li>
            <li class="items-center space-x-3 flex">
                <i class="fa-solid fa-check text-1xl text-green-500 bg-green-100 w-6 h-6 min-w-6 min-h-6 flex items-center justify-center rounded-full"></i>
                <p>
                    {{ __('welcome.appointment_reminder.you_will_get_a_reminder_of_upcoming_client_so_you_do_not_have_to_keep_it_in_mind_and_can_focus_on_things_which_matter') }}
                </p>
            </li>
        </ul>
        <a class="bg-indigo-600 text-white py-2 px-4 rounded-lg whitespace-nowrap block w-min hover:bg-indigo-800 transition ease-in-out duration-150" href="{{ route('admin.register') }}">
            {{ __('welcome.appointment_reminder.try_it_for_free') }}
        </a>
    </div>
</section>