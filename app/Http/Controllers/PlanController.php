<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Models\UserPlans;
use Stripe\StripeClient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PlanController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function index()
    {
        $plans = Plan::query()->get();

        return view("plans", compact("plans"));
    }

    public function updateUserPlan(Request $request, $id)
    {
        $request->validate([
            'monthly_fee' => 'required|numeric|min:0',
            'free_trial' => 'required|integer|min:0',
        ]);

        // Find the UserPlan by ID
        $userPlan = UserPlans::query()->where('id', $id)->first();

        if ($userPlan && $userPlan->monthly_fee != $request->input('monthly_fee')) {
            $stripe = new StripeClient(env('STRIPE_SECRET'));
            $product = $stripe->products->retrieve($userPlan->stripe_product_id);
            if ($product) {
                $productId = $product->id;
            } else {
                $product = $stripe->products->create([
                    'name' => 'Monthly Subscription', // Product name
                    'description' => 'A subscription plan for premium users.', // Optional description
                ]);
                $productId = $product->id;
            }

            $unitAmount = $request->monthly_fee * 100;
            // Step 2: Create the price for the product (recurring monthly)
            $price = $stripe->prices->create([
                'unit_amount' => $unitAmount, // The amount in cents (e.g., $12)
                'currency' => 'usd',
                'recurring' => ['interval' => 'month'], // Monthly subscription
                'product' => $productId, // Link to the created product
            ]);

            $userPlan->update([
                'monthly_fee' => $request->monthly_fee,
                'stripe_price_id' => $price->id,
                'free_trial' => $request->free_trial,
                'stripe_product_id' => $productId
            ]);
        } else {
            $userPlan->update([
                'free_trial' => $request->free_trial,
            ]);
        }

        // Redirect with success message
        return redirect()->back()->with('success', 'User Plan updated successfully!');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function show(Plan $plan, Request $request)
    {
        $intent = auth()->user()->createSetupIntent();

        return view("subscription", compact("plan", "intent"));
    }

    public function createSubscriptions(Request $request)
    {
        $stripe = new StripeClient(env('STRIPE_SECRET'));

        $user = Auth::user();

        // Step 1: Create a Stripe customer if not already exists
        if (!$user->stripe_customer_id) {
            $customer = $stripe->customers->create([
                'email' => $user->email,
                'name' => $user->name,
            ]);
            $user->stripe_customer_id = $customer->id;
            $user->save();
        }

        // Step 2: Attach payment method to the customer
        $stripe->paymentMethods->attach(
            $request->token, // Payment method from Stripe Elements
            ['customer' => $user->stripe_customer_id]
        );

        // Step 3: Set the default payment method for the customer
        $stripe->customers->update(
            $user->stripe_customer_id,
            ['invoice_settings' => ['default_payment_method' => $request->token]]
        );

        // Step 4: Create the subscription
        $subscription = $stripe->subscriptions->create([
            'customer' => $user->stripe_customer_id,
            'items' => [['price' => $request->plan]], // Use the price ID from the form
            'expand' => ['latest_invoice.payment_intent'], // Expand to get payment details
        ]);

        // Step 5: Check payment status
        $paymentIntent = $subscription->latest_invoice->payment_intent;

        if ($paymentIntent->status === 'succeeded') {

            $user->payment_done = 1;
            $user->payment_date = now();
            $user->stripe_subcription_id = $subscription->id;
            $user->payment_end = now()->addMonth();;
            $user->save();
            return redirect()->route('payment.page')->with('success', 'Your payment was successful. Thank you for subscribing!');
        } else {

            return redirect()->route('payment.page')->with('error', 'Payment failed. Please try again.');
        }
    }
}
