<a 
    {{ 
        $attributes->merge([
            'class' => 'cursor-pointer inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs uppercase tracking-widest focus:outline-none focus:ring-2 focus:ring-offset-2 transition ease-in-out duration-150 disabled:opacity-25'
        ]) 
    }}
>
    {{ $slot }}
</a>