<div class="flex bg-gray-200 font-roboto overflow-hidden">
    <div class="relative flex-1 flex flex-col overflow-hidden">
        @if (isset($header))
            <div class="bg-white w-full">
                <div class="bg-white flex w-full mx-auto h-[10vh] fixed px-4 sm:px-6 lg:px-8 items-center justify-between max-w-2xl z-50">
                    {{ $header }}
                </div>
            </div>
        @endif
        
        <main class="my-[10vh] flex-1 overflow-x-hidden w-full overflow-y-auto bg-gray-200 fixed overflow-auto h-[80vh]">
            <div class="mx-auto max-w-2xl px-2">
                {{$slot}}
            </div>
        </main>

        @if (isset($footer))
            <div class="flex w-full m-auto items-center justify-between max-w-2xl space-x-4 h-[10vh] fixed bottom-0 px-2">
                {{ $footer }}
            </div>
        @endif
    </div>
</div>