<div class="flex h-screen bg-gray-200 font-roboto ">
    <div class="relative flex-1 flex flex-col overflow-hidden">
        @if (isset($header))
            <div class="bg-white w-full h-[80px]">
                <div class="bg-white flex w-full mx-auto h-[80px] px-4 sm:px-6 lg:px-8 items-center justify-between max-w-2xl">
                    {{ $header }}
                </div>
            </div>
        @endif
        
        <main class="flex-1 overflow-x-hidden w-full overflow-y-auto bg-gray-200">
            <div class="mx-auto max-w-2xl px-2">
                {{$slot}}
            </div>
        </main>

        @if (isset($footer))
            <div class="flex w-full m-auto items-center justify-between max-w-2xl space-x-4 h-[80px] bottom-0 px-2">
                {{ $footer }}
            </div>
        @endif
    </div>
</div>