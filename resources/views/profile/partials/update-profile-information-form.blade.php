<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form method="post" action="{{ route('admin.profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div class="flex space-x-4">
            <div class="w-full">
                <x-form.label for="first_name" :value="__('Name:')" />
                <x-form.input id="first_name" name="first_name" type="text" class="block w-full" :value="old('first_name', $user->first_name)" required autocomplete="first_name" />
                <x-form.error class="mt-2" :messages="$errors->get('first_name')" />
            </div>
            <div class="w-full">
                <x-form.label for="last_name" :value="__('Surname:')" />
                <x-form.input id="last_name" name="last_name" type="text" class="block w-full" :value="old('last_name', $user->last_name)" required autocomplete="last_name"/>
                <x-form.error class="mt-2" :messages="$errors->get('last_name')" />
            </div>
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')"/>
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
