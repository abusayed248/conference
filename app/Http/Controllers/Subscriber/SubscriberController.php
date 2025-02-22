<?php

namespace App\Http\Controllers\Subscriber;

use Stripe\Webhook;
use App\Models\User;
use Stripe\StripeClient;
use App\Models\UserPlans;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use App\Services\SubscriptionsService;
use App\Http\Resources\SubscriberResource;

class SubscriberController extends Controller
{

    public function subMenu()
    {
        return view('sub-menu');
    }

    public function handleWebhook(Request $request)
    {

        $stripeSecretKey = config('services.stripe.secret');
        \Stripe\Stripe::setApiKey($stripeSecretKey);
        $endpoint_secret = config('services.stripe.webhook_secret');

        $payload = @file_get_contents('php://input');
        $event = null;

        try {
            $event = \Stripe\Event::constructFrom(
                json_decode($payload, true)
            );
        } catch (\UnexpectedValueException $e) {
            echo '⚠️  Webhook error while parsing basic request.';
            http_response_code(400);
            exit();
        }
        if ($endpoint_secret) {
            $sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'];
            try {
                $event = \Stripe\Webhook::constructEvent(
                    $payload,
                    $sig_header,
                    $endpoint_secret
                );
            } catch (\Stripe\Exception\SignatureVerificationException $e) {
                echo '⚠️  Webhook error while validating signature.';
                http_response_code(400);
                exit();
            }
        }

        // Handle the event
        switch ($event->type) {
            case 'invoice.payment_succeeded':
                $invoice = $event->data->object;
                $this->handleInvoicePaymentSucceeded($invoice);
                break;
            case 'invoice.payment_failed':
                $invoice = $event->data->object;
                $this->handleInvoicePaymentFailed($invoice);
                break;
                // ... handle other event types
            default:
                Log::warning('Unhandled event type: ' . $event->type);
                break;
        }

        http_response_code(200);
        return response()->json(['status' => 'success'], 200);
    }

    protected function handleInvoicePaymentSucceeded($invoice)
    {

        $paidAmount = $invoice->amount_paid;
        if ($paidAmount > 100) {
            $stripeCustomerId = $invoice->customer;
            $user = User::where('stripe_customer_id', $stripeCustomerId)->first();
            if ($user) {
                $user->update([
                    'payment_done' => 1,
                    'payment_date' => now(),
                    'payment_end' => now()->addMonth(),
                ]);
            }
        }
    }

    protected function handleInvoicePaymentFailed($invoice)
    {
        $stripeCustomerId = $invoice->customer;
        $user = User::where('stripe_customer_id', $stripeCustomerId)->first();
        if ($user) {
            Log::warning('Subscription payment failed for user', ['user_id' => $user->id]);
        } else {
            Log::warning('User not found for Stripe customer ID', ['stripe_customer_id' => $stripeCustomerId]);
        }
    }

    public function updateSubscription(Request $request, $id)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable',
        ]);

        // Start a transaction
        DB::beginTransaction();

        try {

            $subscriber = User::query()->where('id', $id)->first();
            $subscriber->update([
                'email' => $request->email,
                'phone' => $request->phone,
            ]);

            if ($request->filled('password')) {
                $subscriber->update([
                    'password' => Hash::make($request->password)
                ]);
            }

            // Commit the transaction
            DB::commit();

            // Return success response
            return response()->json(['message' => 'Subscriber updated successfully']);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error updating subscriber: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred while updating the subscriber. Please try again.'], 500);
        }
    }

    public function manageSubscriber()
    {

        if (auth()->user()->role != 'admin') {
            abort(403, 'Unauthorized action.');
        }
        $per_page = 20;
        $userPlan = UserPlans::query()->first();
        $subscribers = User::query()->where('payment_done', 1)->cursorPaginate($per_page);
        return view("manage-subscriber", compact("userPlan", "subscribers"));
    }

    public function cancelFreeTrial()
    {

        $stripe = new StripeClient(env('STRIPE_SECRET'));
        $user = auth()->user();
        // Update user record

        if ($user->stripe_subcription_id) {
            $subscription = $stripe->subscriptions->retrieve($user->stripe_subcription_id);
            if ($subscription && $subscription->status !== 'canceled') {
                $stripe->subscriptions->cancel($user->stripe_subcription_id);
                $user->update([
                    'stripe_subcription_id' => null,
                    'is_cancel_free_trial' => 1,
                ]);
            } else {
                return redirect()->back()->with('error', 'Subscription is already canceled or invalid.');
            }
        }

        return redirect()->back()->with('success', 'Your free trial has been canceled.');
    }


    public function showFreeTrialForm()
    {
        $user = auth()->user();
        $userPlan = UserPlans::query()->first();

        return view('free-trial', compact('user', 'userPlan'));
    }

    public function processFreeTrial(Request $request)
    {

        $stripe = new StripeClient(env('STRIPE_SECRET'));
        $user = auth()->user();

        if (!$user->stripe_customer_id) {
            $customer = $stripe->customers->create([
                'email' => $user->email,
                'name' => $user->name,
            ]);
            $user->stripe_customer_id = $customer->id;
            $user->save();
        }

        $stripe->paymentMethods->attach(
            $request->token, // Payment method from Stripe Elements
            ['customer' => $user->stripe_customer_id]
        );

        $stripe->customers->update(
            $user->stripe_customer_id,
            ['invoice_settings' => ['default_payment_method' => $request->token]]
        );

        $userPlan = UserPlans::query()->first();
        $freeTrialDays = $userPlan->free_trial;

        $subscription = $stripe->subscriptions->create([
            'customer' => $user->stripe_customer_id,
            'items' => [['price' => $userPlan->stripe_price_id]], // Replace with your actual price ID
            'trial_period_days' => $freeTrialDays,
            'default_payment_method' => $request->token,
        ]);

        // Save subscription ID to user for future reference
        $user->update([
            'stripe_subcription_id' => $subscription->id,
            'free_trial' => now()->addDays($freeTrialDays),
        ]);

        // Redirect with success message
        return redirect()->back()->with('success', 'Your free trial has started!');
    }

    private function isValidCard($cardNumber)
    {
        // Basic Luhn Algorithm for card number validation
        $sum = 0;
        $shouldDouble = false;

        for ($i = strlen($cardNumber) - 1; $i >= 0; $i--) {
            $digit = (int) $cardNumber[$i];

            if ($shouldDouble) {
                $digit *= 2;
                if ($digit > 9) {
                    $digit -= 9;
                }
            }

            $sum += $digit;
            $shouldDouble = !$shouldDouble;
        }

        return $sum % 10 === 0;
    }

    public function showSubscribers(Request $request)
    {
        $perPage = $request->get('per_page', 8);
        $search = $request->get('search', '');

        // Query the User model to get subscribers who have payment_done = 1

        $query = User::query()
            ->where(function ($q) {
                $q->where('payment_done', 1)
                    ->orWhereNotNull('free_trial');
            });

        // If search query is provided, filter the results by name or email
        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $subscribers = $query->paginate($perPage);
        return response()->json([
            'data' => SubscriberResource::collection($subscribers),
            'next_page_url' => $subscribers->nextPageUrl(), // Check if more pages exist
        ]);
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

        $user = auth()->user();
        $subscriptionsService = new SubscriptionsService();
        $hasSubscription = $subscriptionsService->isActivePremimium($user->phone);
        return view("subscription", compact("userPlan", "hasSubscription", "user"));
    }

    public function updatePaymentMethod(Request $request)
    {
        $user = auth()->user();
        $stripe = new StripeClient(env('STRIPE_SECRET'));

        // Attach the new payment method
        $newPaymentMethod = $stripe->paymentMethods->attach(
            $request->token, // New payment method token from Stripe Elements
            ['customer' => $user->stripe_customer_id]
        );

        // Update the customer's default payment method
        $stripe->customers->update(
            $user->stripe_customer_id,
            ['invoice_settings' => ['default_payment_method' => $newPaymentMethod->id]]
        );

        // Update the subscription to use the new payment method
        $stripe->subscriptions->update($user->stripe_subcription_id, [
            'default_payment_method' => $newPaymentMethod->id,
        ]);

        return response()->json(['success' => true]);
    }

    public function cancelSubscription(Request $request)
    {
        $user = auth()->user();
        $stripe = new StripeClient(env('STRIPE_SECRET'));

        try {
            // Cancel the subscription at the end of the billing period
            $stripe->subscriptions->update($user->stripe_subcription_id, [
                'cancel_at_period_end' => true,
            ]);
            $user->update([
                'is_cancel_subscription' => 1
            ]);
            return response()->json(['success' => true, 'message' => 'Subscription will not renew.']);
        } catch (\Exception $e) {
            info($e);
            return response()->json(['success' => false, 'message' => 'Failed to cancel subscription.'], 500);
        }
    }
}
