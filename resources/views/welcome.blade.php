<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased">
        <button id="createEventModalButton" class="" x-data="" x-on:click.prevent="$dispatch('open-modal', 'createEventModal')">
            Открыть
        </button>
        <x-modal name="createEventModal">
            <iframe class="w-full min-h-[90vh]" src="http://127.0.0.1:8003/app/1"></iframe>
        </x-modal>
    </body>
</html>
