<x-app-layout>
    <x-slot name="navigation">
        <div class="flex items-center space-x-2">
            <h2 class="font-semibold text-lg text-gray-800">
                {{ __("Subscription:") }}
            </h2>
        </div>
    </x-slot>
    
    <script async src="https://js.stripe.com/v3/pricing-table.js"></script>
    <div class="py-4 sm:p-4 space-y-6">
        @if ($company->onTrial())
            <x-white-block>
                <p class="text-xl font-bold">
                    {{ __("Trial") }}
                </p>
                <p>
                    {{ __("Ends at:") }} {{ $company->trial_ends_at->format('d.m.Y') }}
                </p>
            </x-white-block>
        @elseif($company->subscribed(['premium', 'standard']))
            <x-white-block>
                <div class="lg:flex lg:space-x-3 items-center lg:justify-between space-y-6 lg:space-y-0">
                    <div class="">
                        <div class="flex items-center space-x-2">
                            @subscribed(['premium'])
                                <i class="fa-solid fa-crown text-yellow-500"></i>
                            @endsubscribed
                            <p class="text-xl font-bold">
                                {{ $subscription->product->name }}
                            </p>
                            <p class="py-1 px-2 text-gray-900 bg-gray-200 rounded-lg whitespace-nowrap">
                                <span class="font-bold text-lg">{{ $subscription->plan->amount_decimal/100 }}</span> {{ $subscription->plan->currency }}/{{ $subscription->plan->interval }}
                            </p>
                        </div>
                        <p>
                            {{ __("Ends at:") }} {{ \Illuminate\Support\Carbon::parse($subscription->current_period_end)->format('d.m.Y') }}
                        </p>
                    </div>
                    <x-a-buttons.create class="cursor-pointer" href="{{ route('admin.company.subscription.billing', $company) }}">
                        {{ __("Manage subscription") }}
                    </x-a-buttons.create>
                </div>
            </x-white-block>
        @endif

        <x-white-block>
            <stripe-pricing-table 
                pricing-table-id="prctbl_1OdWteHnWOcTbmCZtwrvcXYq"
                publishable-key="pk_live_51OZtRGHnWOcTbmCZAO6KVl1Rr77W82kNoDCQ9TxVrnt5sDqKnQUvBvFQkJmsXtRwkGhhbqetsF48iOnpvX0eN9x500io4tJWGO"
                customer-session-client-secret="{{ $session->client_secret }}"
            >
            </stripe-pricing-table>
        </x-white-block>
    </div>
</x-app-layout>