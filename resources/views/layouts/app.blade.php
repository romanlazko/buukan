<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <script src="https://kit.fontawesome.com/f4c6764ec6.js" crossorigin="anonymous"></script>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    
    <body>
        <div x-data="{ sidebarOpen: false }" class="flex h-screen bg-gray-200 font-roboto">
            @include('layouts.sidebar')
            
            <div class="flex-1 flex flex-col overflow-hidden">
                {{-- <div class="sm:hidden">
                    @include('layouts.header')
                </div> --}}
                
                @if (isset($header))
                    <div class="bg-white  " x-data="{ headerOpen: false }">
                        <div class="flex w-full m-auto px-4 sm:px-6 lg:px-8 min-h-[80px] items-center justify-between">
                            <button @click="sidebarOpen = true" class="text-gray-500 focus:outline-none lg:hidden">
                                <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M4 6H20M4 12H20M4 18H11" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </button>
                            {{ $header }}
                        </div>
                        <hr>
                    </div>
                @endif
                
                <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
                    <div class="mx-auto">
                        {{$slot}}
                    </div>
                </main>
                @if (isset($footer))
                    <div class="bg-white">
                        <div class="flex w-full m-auto px-4 sm:px-6 lg:px-8 items-center justify-between">
                            {{ $footer }}
                        </div>
                    </div>
                @endif
            </div>
        </div>
        @if (session('ok') === true)
            <x-notifications.small class="bg-green-400 z-50" :title="session('description')"/>
        @elseif (session('ok') === false)
            <x-notifications.small class="bg-red-400 z-50" :title="session('description')"/>
        @endif
        
    </body>
    @stack('scripts')
</html>