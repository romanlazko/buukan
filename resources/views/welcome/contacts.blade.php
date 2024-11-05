<x-guest-layout>
    <section class="max-w-6xl w-full m-auto py-12 md:flex space-y-12 lg:space-y-0 space-x-0 items-center z-50 p-4 md:space-x-12">
        <div class="w-full lg:w-1/2">
            <h1 class="text-5xl leading-[4rem] font-extrabold bg-gradient-to-r from-indigo-500 to-purple-800 text-transparent bg-clip-text">
                {{ __("Contacts:") }}
            </h1>

            <ul class="p-6 grid grid-cols-2 gap-6">
                <li>
                    <p class="font-bold hover:text-indigo-800 relative">
                        <i class="fa-regular fa-envelope absolute -left-6 bottom-0 leading-6"></i>
                        {{ __('Email') }}
                    </p>
                    <a href="mailto:{{ config('app.email') }}" class="text-indigo-600 hover:text-indigo-800">
                        {{ config('app.email') }}
                    </a>
                </li>

                <li>
                    <p class="font-bold hover:text-indigo-800 relative">
                        <i class="fa-regular fa-circle-question absolute -left-6 bottom-0 leading-6"></i>
                        {{ __('Help') }}
                    </p>
                    <a href="mailto:{{ config('app.tech_support') }}" class="text-indigo-600 hover:text-indigo-800">
                        {{ config('app.tech_support') }}
                    </a>
                </li>

                <li class="">
                    <a href="{{ route('welcome') }}" class="font-bold hover:text-indigo-800 relative">
                        <i class="fa-solid fa-location-dot absolute -left-6 bottom-0 leading-6"></i>
                        BUUKAN.com
                    </a>
                    <a href="" class="w-full block text-gray-400 hover:underline">
                        <span class="block">
                            {{ __('Fyzická osoba') }}
                        </span>
                        <span class="block">
                            Hybešova 64/31
                        </span>
                        <span class="block">
                            IČO: 11940255
                        </span>
                    </a>
                </li>

                <li>
                    <p class="font-bold hover:text-indigo-800 relative">
                        <i class="fa-solid fa-people-group absolute -left-6 bottom-0 leading-6"></i>
                        {{ __('Marketing:') }}
                    </p>
                    <p>
                        Konstantin Janes
                    </p>
                    <a href="mailto:kjanes@buukan.com" class="text-indigo-600 hover:text-indigo-800 block">
                        kjanes@buukan.com
                    </a>
                    <a href="tel:+420735500368" class="block">
                        +420735500368
                    </a>
                </li>
            </ul>
        </div>
        <form action="{{ route('question') }}" method="POST" class="w-full lg:w-1/2 bg-white overflow-hidden shadow-3xl rounded-lg p-4 border shadow-2xl">
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
                <x-form.label for="message" :value="__('Question:')" />
                <x-form.textarea name="message" >
                </x-form.textarea>
                <x-form.error :messages="$errors->get('message')" class="mt-2" />
            </div>
    
            <div class="flex items-center justify-end mt-4">
                <x-buttons.primary class="ml-4">
                    {{ __('Send') }}
                </x-buttons.primary>
            </div>
        </form>
    </section>
    
</x-guest-layout>