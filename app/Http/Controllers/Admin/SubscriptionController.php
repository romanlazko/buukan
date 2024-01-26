<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Price;
use Stripe\Checkout\Session;
use App\Models\Company;
use Laravel\Cashier\Cashier;
use Illuminate\Support\Carbon;
use App\Models\Product;

class SubscriptionController extends Controller
{
    public function index(Company $company)
    {
        $stripe = Cashier::stripe();

        $subscription = [];

        if ($stripe_id = $company->subscription()?->stripe_id) {
            $subscription = $stripe->subscriptions->retrieve($stripe_id);
            $subscription->product = Product::whereProductId($subscription->plan->product)->first();
        }

        $customer = $company->createOrGetStripeCustomer([
            'name' => $company->name,
            'email' => $company->owner->email,
        ]);

        $session = $stripe->customerSessions->create([
            'customer' => $customer->id,
            'components' => [
                'pricing_table' => [
                    'enabled' => true
                ] 
            ],
        ]);

        return view('admin.company.subscription.index', compact(
            'company', 
            'subscription', 
            'session'
        ));
    }

    public function billing(Company $company)
    {
        if (!$company->subscribed(['premium', 'standard'])) {
            return redirect()->route('admin.company.subscription.index', $company);
        }

        return $company->redirectToBillingPortal(route('admin.dashboard'));
    }

    public function success(Company $company, Request $request)
    {
        return redirect()->route('admin.dashboard');
    }
}
