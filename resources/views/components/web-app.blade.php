<div id="main" class="flex bg-gray-200 font-roboto ">
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

{{-- <div id="main" class="bg-gray-200 font-roboto ">
    <div class="overflow-hidden ">
        @if (isset($header))
            <div class="bg-white fixed h-[10vh] w-full">
                <div class="flex w-full h-[10vh] m-auto px-4 sm:px-6 lg:px-8 items-center justify-between max-w-2xl">
                    {{ $header }}
                </div>
            </div>
        @endif
        
        <main class="py-[12vh] px-2 flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
            <div class="mx-auto max-w-2xl">
                {{$slot}}
            </div>
        </main>

        @if (isset($footer))
            <div class="bg-white fixed h-[10vh] w-full bottom-0 px-2">
                <div class="h-[10vh] flex w-full mx-auto items-center justify-between max-w-2xl space-x-4 ">
                    {{ $footer }}
                </div>
            </div>
        @endif
    </div>
</div> --}}
<script type="module">
    $(document).ready(function(){
    // Устанавливаем высоту блока равной высоте видимой области
        var windowHeight = window.innerHeight;

        $('#main').css('height', windowHeight + 'px');
        
        // Обновляем высоту блока при изменении размеров окна браузера
        $(window).resize(function(){
            var windowHeight = window.innerHeight;
            $('#main').css('height', windowHeight + 'px');
        });

        var targetElement = document.querySelector('main');
        var resizeObserver = new ResizeObserver(function(entries) {
            entries.forEach(function(entry) {
                var windowHeight = window.innerHeight;
                $('#main').css('height', windowHeight + 'px');
            });
        });
        resizeObserver.observe(targetElement);
    });
</script>