<a 
    {{ 
        $attributes->merge([
            'class' => 'cursor-pointer inline-flex items-center border rounded-md font-semibold tracking-widest focus:outline-none focus:ring-2 focus:ring-offset-2 transition ease-in-out duration-150 disabled:opacity-25'
        ]) 
    }}
>
    {{ $slot }}
</a>