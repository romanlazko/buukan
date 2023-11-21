<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ __('WebApp') }}</title>

        <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio"></script>
        

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    
    <body>
        {{$slot}}
        {{-- <div class="flex h-screen bg-gray-200 font-roboto">
            
            <div class="flex-1 flex flex-col overflow-hidden">
                
                @if (isset($header))
                    <div class="bg-white  ">
                        <div class="flex w-full m-auto px-4 sm:px-6 lg:px-8 min-h-[80px] items-center justify-between">
                            {{ $header }}
                        </div>
                        <hr>
                    </div>
                @endif
                
                <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
                    <div class="mx-auto sm:px-6 py-8">
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
        </div> --}}
    </body>
</html>
