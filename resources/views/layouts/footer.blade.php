<footer class="w-full bg-gray-800 text-gray-300 h-min">
    <div class="sm:flex justify-between max-w-6xl m-auto px-4 py-6 sm:space-y-0 space-y-6">
        <div class="space-y-4">
            <a href="{{ route('welcome') }}" class="w-full text-xl block text-white font-bold hover:underline">BUUKAN.com</a>
            <a href="" class="w-full block text-gray-400 hover:underline">
                <span class="block">
                    {{ __('Fyzická osoba') }}
                </span>
                <span class="block">
                    Hybešova 64/31
                </span>
                <span class="block">
                    IČO: 11940255
                </span>
            </a>
            <a href="mailto:info@buukan.com" class="w-full block hover:underline">
                info@buukan.com
            </a>
        </div>
        <div class="space-y-4 justify-self-center">
            <h3 href="" class="w-full text-xl block text-white font-bold">
                {{ __('Important information') }}
            </h3>
            <a href="{{ route('prices')}}" class="w-full block hover:underline">
                {{ __('Prices') }}
            </a>
            <x-dropdown align="bottom" width="48">
                <x-slot name="trigger">
                    <button class="w-full text-left hover:underline">
                        {{ __('Terms and conditions') }}
                    </button>
                </x-slot>
                <x-slot name="content">
                    <x-dropdown-link target="_blank" href="{{ asset('terms_of_use/terms_of_use_cz.pdf')}}">
                        Ru
                    </x-dropdown-link>
                    <x-dropdown-link target="_blank" href="{{ asset('terms_of_use/terms_of_use_cz.pdf')}}">
                        Cz
                    </x-dropdown-link>
                    <x-dropdown-link target="_blank" href="{{ asset('terms_of_use/terms_of_use_en.pdf')}}">
                        En
                    </x-dropdown-link>
                </x-slot>
            </x-dropdown>
            <x-dropdown align="bottom" width="48">
                <x-slot name="trigger">
                    <button class="w-full text-left hover:underline">
                        GDPR
                    </button>
                </x-slot>
                <x-slot name="content">
                    <x-dropdown-link target="_blank" href="{{ asset('terms_of_use/terms_of_use_cz.pdf')}}">
                        Ru
                    </x-dropdown-link>
                    <x-dropdown-link target="_blank" href="{{ asset('terms_of_use/terms_of_use_cz.pdf')}}">
                        Cz
                    </x-dropdown-link>
                    <x-dropdown-link target="_blank" href="{{ asset('terms_of_use/terms_of_use_en.pdf')}}">
                        En
                    </x-dropdown-link>
                </x-slot>
            </x-dropdown>
        </div>
        <div class="space-y-4">
            <h3 class="w-full text-xl block text-white font-bold">
                {{ __('Help') }}
            </h3>
            <a href="{{ route('contacts')}}" class="w-full block hover:underline">
                {{ __('Contacts') }}
            </a>
            <a href="{{ route('contacts')}}" class="w-full block hover:underline">
                {{ __('Support 24/7') }}
            </a>
        </div>
    </div>
    
</footer>