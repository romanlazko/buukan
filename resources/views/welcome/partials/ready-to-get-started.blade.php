<section class="md:flex max-w-6xl m-auto items-center md:space-x-12 justify-between space-y-12 md:space-y-0 px-4 py-12">
    <div class="space-y-12 w-full">
        <h2 class="text-4xl font-bold">
            {{ __('welcome.ready_to_get_started.title') }}
        </h2>
        <p class="text-xl border-l-4 border-l-indigo-600 pl-4">
            {{ __('welcome.ready_to_get_started.description') }}
        </p>
        <div class="flex space-x-4 items-center">
            <a class=" text-gray-800 whitespace-nowrap block w-min hover:text-gray-500 transition ease-in-out duration-150" href="{{ route('admin.login') }}">
                {{ __('welcome.ready_to_get_started.login') }}
            </a>
            <a class="bg-indigo-600 text-white py-2 px-4 rounded-lg whitespace-nowrap block w-min hover:bg-indigo-800 transition ease-in-out duration-150" href="{{ route('admin.register') }}">
                {{ __('welcome.ready_to_get_started.try_it_for_free') }}
            </a>
            
        </div>
    </div>
    <form action="{{ route('question') }}" method="POST" class="w-full bg-white overflow-hidden shadow-3xl rounded-lg p-4 border shadow-2xl">
        @csrf

        <!-- Name -->
        <div class="w-full">
            <x-form.label for="name" :value="__('welcome.ready_to_get_started.name')" />
            <x-form.input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required />
            <x-form.error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-form.label for="email" :value="__('welcome.ready_to_get_started.email')" />
            <x-form.input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-form.error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-form.label for="message" :value="__('welcome.ready_to_get_started.question')" />
            <x-form.textarea name="message" >
            </x-form.textarea>
            <x-form.error :messages="$errors->get('message')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-buttons.primary class="ml-4">
                {{ __('welcome.ready_to_get_started.send') }}
            </x-buttons.primary>
        </div>
    </form>
</section>