<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GreetingController;
use App\Http\Controllers\CallActionController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\TelnyxWebhookController;
use App\Http\Controllers\Subscriber\SubscriberController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware('auth')->group(function () {
    Route::get('/', [ProfileController::class, 'home'])->name('home');

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::post('/subscription/free-trial/cancel', [SubscriberController::class, 'cancelFreeTrial'])
        ->name('subscription.free-trial.cancel');
    Route::get('/subscription/free-trial', [SubscriberController::class, 'showFreeTrialForm'])->name('subscription.free-trial');
    Route::get('/sub-menu', [SubscriberController::class, 'subMenu'])->name('sub-menu');
    Route::get('/manage-subscribers', [SubscriberController::class, 'manageSubscriber'])->name('manage.subscribers');
    Route::get('/billing-subscription-plan', [SubscriberController::class, 'subscriptionPlan'])->name('subscription.plans');
    Route::post('/update-payment-method', [SubscriberController::class, 'updatePaymentMethod']);
    Route::post('/cancel-subscription', [SubscriberController::class, 'cancelSubscription'])->name('cancel.subscription');
    Route::post('/update-phone-number', [ProfileController::class, 'updatePhoneNumber'])->name('update.phone.number');
});

Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    Route::get('/subscription', [SubscriberController::class, 'showForm'])->name('subscription.form');
    Route::post('/create-subscription', [SubscriberController::class, 'createSubscription'])->name('create.subscription');


    Route::post('/subscription/create', [PlanController::class, 'createSubscriptions'])->name('subscription.create');


    Route::post('/subscription/free-trial', [SubscriberController::class, 'processFreeTrial'])->name('subscription.free-trial.process');


    Route::get('plans', [PlanController::class, 'index']);
    Route::get('plans/{plan}', [PlanController::class, 'show'])->name("plans.show");
    // routes/web.php
    Route::get('/payment', [SubscriberController::class, 'showPaymentPage'])->name('payment.page');
    //  Route::post('subscription', [PlanController::class, 'subscription'])->name("subscription.create");
});


// admin routes start
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
});
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::post('/user-plan/update/{id}', [PlanController::class, 'updateUserPlan'])->name('userPlan.update');
    Route::get('subscribers', [SubscriberController::class, 'showSubscribers']);

    Route::post('/greetings-subs/update-audio', [CallActionController::class, 'updateAudio'])->name('greetings.updateAudio');
    Route::post('/greetings-non-subs/update-audio', [CallActionController::class, 'updateAudioNonSubscription'])->name('greetings.updateAudioNonSubscribtion');
    Route::post('/save-call-action', [CallActionController::class, 'store'])->name('call-action.store');
    Route::post('/save-mp3-call-action', [CallActionController::class, 'storeMp3CallAction'])->name('mp3-call-action.store');
    Route::post('/save-mp3-sub-call-action', [CallActionController::class, 'storeMp3SubCallAction'])->name('mp3-call-action-sub.store');

    Route::post('/update-call-action', [CallActionController::class, 'updateCallAction'])->name('update-call-action');
    Route::get('/subactions/{digit}', [CallActionController::class, 'getByDigit']);
    Route::get('/all-call-action', [CallActionController::class, 'getCallAction']);
    Route::post('/update-subscription-user/{id}', [SubscriberController::class, 'updateSubscription']);
});


Route::post('/webhook/stripe', [SubscriberController::class, 'handleWebhook']);
// admin routes end

Route::post('/webhook/telnyx', [TelnyxWebhookController::class, 'handle']);
Route::post('/webhook/telnyx/submenu', [TelnyxWebhookController::class, 'handleSubmenu']);

require __DIR__ . '/auth.php';
