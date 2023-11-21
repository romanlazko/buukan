<div class="flex h-screen bg-gray-200 font-roboto ">
    <div class="flex-1 flex flex-col overflow-hidden ">
        @if (isset($header))
            <div class="bg-white">
                <div class="flex w-full m-auto px-4 sm:px-6 lg:px-8 min-h-[80px] items-center justify-between max-w-2xl">
                    {{ $header }}
                </div>
                <hr>
            </div>
        @endif
        
        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
            <div class="mx-auto max-w-2xl">
                {{$slot}}
            </div>
        </main>

        @if (isset($footer))
            <div class="flex w-full m-auto items-center justify-between max-w-2xl space-x-4">
                {{ $footer }}
            </div>
        @endif
    </div>
</div>