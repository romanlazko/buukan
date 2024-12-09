<x-guest-layout>
    <section class="max-w-6xl w-full m-auto py-12 space-y-12 items-center z-50 p-4 " x-data="{ plan:  'year' }">
        <h1 class="text-5xl leading-[4rem] font-extrabold bg-gradient-to-r from-indigo-500 to-purple-800 text-transparent bg-clip-text">
            {{ __('prices.prices') }}
        </h1>
        <div class="flex space-x-3 m-auto">
            <button @click="plan = 'month'" x-bind:class="{ 'bg-indigo-700 hover:bg-indigo-500 text-white': plan === 'month' }" class="p-3 border rounded-lg">
                {{ __('prices.monthly') }}
            </button>
            <button @click="plan = 'year'" x-bind:class="{ 'bg-indigo-700 hover:bg-indigo-500 text-white': plan === 'year' }" class="p-3 border rounded-lg">
                {{ __('prices.yearly') }}
            </button>
        </div>
        <div class="w-full grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach ($products as $product)
                <div class="p-4 bg-white rounded-xl border shadow-xl space-y-6">
                    <div class="space-y-3">
                        <h1 class="text-3xl font-bold">
                            {{ $product->name }}
                        </h1>
                        <p class="text-sm text-gray-500">
                            {{ __("$product->description") }}
                        </p>
                        <div class="w-full relative z-0">
                            @foreach ($product->plans as $plan)
                                <p :class="{ 'active': plan === '{{ $plan->interval }}' }" x-show.transition.in.opacity.duration.600="plan === '{{ $plan->interval }}'">
                                    {{ $plan->amount_decimal/100 }} {{ $plan->currency }}/{{ __("$plan->interval") }}
                                </p>
                            @endforeach
                        </div>
                    </div>
                    <ul class="space-y-3">
                        @foreach ($product->metadata->toArray() as $key => $value)
                        <li class="flex items-center space-x-3">
                            <i class="fa-solid fa-check text-1xl text-green-500 bg-green-100 w-6 h-6 flex items-center justify-center rounded-full"></i>
                            <span>{{ __($value) }}</span>
                        </li>
                        @endforeach
                    </ul>
                </div>  
            @endforeach
        </div>
    </section>
</x-guest-layout>