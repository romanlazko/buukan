<div class="bg-gray-200 font-roboto ">
    <div class="overflow-hidden ">
        @if (isset($header))
            <div class="bg-white fixed h-[10vh] w-full">
                <div class="flex w-full h-[10vh] m-auto px-4 sm:px-6 lg:px-8 items-center justify-between max-w-2xl">
                    {{ $header }}
                </div>
                <hr>
            </div>
        @endif
        
        <main class="py-[10vh] flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
            <div class="mx-auto max-w-2xl">
                {{$slot}}
            </div>
        </main>

        @if (isset($footer))
            <div class="h-[10vh] fixed flex w-full m-auto items-center justify-between max-w-2xl space-x-4 bottom-0">
                {{ $footer }}
            </div>
        @endif
    </div>
</div>
<script type="module">
    $(document).ready(function(){
    // Устанавливаем высоту блока равной высоте видимой области
    var windowHeight = window.innerHeight;
    $('main').css('height', windowHeight + 'px');
    
    // Обновляем высоту блока при изменении размеров окна браузера
    $(window).resize(function(){
        var windowHeight = window.innerHeight;
        $('main').css('height', windowHeight + 'px');
    });
});
</script>