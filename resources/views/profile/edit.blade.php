<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="w-full space-y-6 m-auto max-w-2xl py-4">
        <x-white-block>
            @include('profile.partials.update-profile-information-form')
        </x-white-block>

        {{-- <x-white-block>
            @include('profile.partials.update-password-form')
        </x-white-block> --}}
    </div>
</x-app-layout>
