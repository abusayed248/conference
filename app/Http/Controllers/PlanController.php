<?php

namespace App\Http\Controllers;

use App\Models\Plan;
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
    // /**
    //  * Write code on Method
    //  *
    //  * @return response()
    //  */
    // public function subscription1(Request $request)
    // {
    //     dd($request->all());
    //     $plan = Plan::find($request->plan);

    //     $subscription = $request->user()->newSubscription($request->plan, $plan->stripe_plan)
    //         ->create($request->token);

    //     return view("subscription_success");
    // }

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
            // Payment was successful
            return response()->json([
                'success' => true,
                'subscription_id' => $subscription->id,
            ]);
        } else {
            // Payment failed or requires further action
            return response()->json([
                'success' => false,
                'message' => 'Payment failed or requires further action.',
            ]);
        }
    }
}
