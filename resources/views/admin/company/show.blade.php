<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center">
            <div class="flex-col items-center my-auto">
                <img src="{{ asset($company->logo) }}" alt="Avatar" class="mr-4 w-12 h-12 min-w-[48px] rounded-full">
            </div>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $company->name }}
            </h2>
        </div>
    </x-slot>
    

</x-app-layout>