<section class="md:flex max-w-6xl m-auto items-center md:space-x-12 justify-between space-y-12 md:space-y-0 px-4 py-12">
    <div class="space-y-12 w-full">
        <h2 class="text-4xl font-bold">
            Ready to get started?
        </h2>
        <p class="text-xl border-l-4 border-l-indigo-600 pl-4">
            Login or create an account and start attracting more customers.
        </p>
        <div class="flex space-x-4 items-center">
            <a class=" text-gray-800 whitespace-nowrap block w-min hover:text-gray-500 transition ease-in-out duration-150" href="{{ route('admin.login') }}">
                {{ __("Login") }}
            </a>
            <a class="bg-indigo-600 text-white py-2 px-4 rounded-lg whitespace-nowrap block w-min hover:bg-indigo-800 transition ease-in-out duration-150" href="{{ route('admin.register') }}">
                {{ __("Try it for free") }}
            </a>
            
        </div>
    </div>
    <form method="POST" class="w-full bg-white overflow-hidden shadow-3xl rounded-lg p-4 border shadow-2xl">
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
</section>