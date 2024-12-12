<?php

namespace App\Http\Controllers\Subscriber;

use App\Models\User;
use Stripe\StripeClient;
use App\Models\UserPlans;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SubscriberController extends Controller
{
    public function subMenu()
    {
        return view('sub-menu');
    }
    public function manageSubscriber()
    {
        $per_page = 20;
        $userPlan = UserPlans::query()->first();
        $subscribers = User::query()->where('payment_done', 1)->cursorPaginate($per_page);
        return view("manage-subscriber", compact("userPlan", "subscribers"));
    }

    public function showSubscribers(Request $request)
    {
        $perPage = $request->get('per_page', 2);
        $search = $request->get('search', '');

        // Query the User model to get subscribers who have payment_done = 1
        $query = User::query()->where('payment_done', 1);

        // If search query is provided, filter the results by name or phone
        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            });
        }

        // Paginate the result and return the data
        $subscribers = $query->paginate($perPage);

        // Return the subscribers as JSON
        return response()->json($subscribers);
    }

    public function createProduct()
    {
        $stripe = new StripeClient(env('STRIPE_SECRET'));

        $product = $stripe->products->create([
            'name' => 'Monthly Subscription', // Product name
            'description' => 'A subscription plan for premium users.', // Optional description
        ]);

        return response()->json([
            'success' => true,
            'product_id' => $product->id, // Use this ID for your prices
        ]);
    }

    // app/Http/Controllers/SubscriptionController.php
    public function showPaymentPage()
    {
        $userPlan = UserPlans::query()->first();
        return view("payment", compact("userPlan"));
    }


    public function listProducts()
    {
        $stripe = new StripeClient(env('STRIPE_SECRET'));

        $products = $stripe->products->all();

        return response()->json([
            'success' => true,
            'products' => $products->data,
        ]);
    }

    public function listPrices()
    {
        $stripe = new StripeClient(env('STRIPE_SECRET'));

        $prices = $stripe->prices->all();

        return response()->json([
            'success' => true,
            'prices' => $prices->data,
        ]);

        //  price_1QUjDHKpSAQYC19tXIoTHd4L
    }

    public function createSubscriptions()
    {
        $stripe = new StripeClient(env('STRIPE_SECRET'));

        $stripe = new StripeClient(env('STRIPE_SECRET'));

        // Step 1: Create the product
        $product = $stripe->products->create([
            'name' => 'Monthly Subscription', // Product name
            'description' => 'A subscription plan for premium users.', // Optional description
        ]);

        // Step 2: Create the price for the product (recurring monthly)
        $price = $stripe->prices->create([
            'unit_amount' => 1200, // The amount in cents (e.g., $12)
            'currency' => 'usd',
            'recurring' => ['interval' => 'month'], // Monthly subscription
            'product' => $product->id, // Link to the created product
        ]);

        return response()->json([
            'success' => true,
            'subscription_id' => $price->id,
        ]);


        $user = Auth::user();
        if (!$user->stripe_customer_id) {
            $customer = $stripe->customers->create([
                'email' => $user->email,
                'name' => $user->name,
            ]);
            $user->stripe_customer_id = $customer->id;
            $user->save();
        }

        $stripeCustomerId = $user->stripe_customer_id;
        $subscription = $stripe->subscriptions->create([
            'customer' => $stripeCustomerId,
            'items' => [['price' => 'price_1QUjDHKpSAQYC19tXIoTHd4L']],
            'trial_period_days' => 7, // Default to 0 if not provided
            'billing_cycle_anchor_config' => ['day_of_month' => 31], // Custom billing anchor
        ]);
        return response()->json([
            'success' => true,
            'subscription_id' => $subscription->id,
        ]);
    }

    // subscription plans
    public function subscriptionPlan()
    {
        $userPlan = UserPlans::query()->first();
        return view("subscription", compact("userPlan"));
    }
}
