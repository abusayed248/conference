<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\AdminController;
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
    Route::get('/', function () {
        return view('home');
    })->name('home');

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/sub-menu', [SubscriberController::class, 'subMenu'])->name('sub-menu');
    Route::get('/manage-subscribers', [SubscriberController::class, 'manageSubscriber'])->name('manage.subscribers');
    Route::get('/billing-subscription-plan', [SubscriberController::class, 'subscriptionPlan'])->name('subscription.plans');
});

Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    Route::get('/subscription', [SubscriberController::class, 'showForm'])->name('subscription.form');
    Route::post('/create-subscription', [SubscriberController::class, 'createSubscription'])->name('create.subscription');


    Route::post('/subscription/create', [PlanController::class, 'createSubscriptions'])->name('subscription.create');



    Route::get('plans', [PlanController::class, 'index']);
    Route::get('plans/{plan}', [PlanController::class, 'show'])->name("plans.show");
    // routes/web.php
    Route::get('/payment', [SubscriberController::class, 'showPaymentPage'])->name('payment.page');
    Route::post('/user-plan/update/{id}', [PlanController::class, 'updateUserPlan'])->name('userPlan.update');
    //  Route::post('subscription', [PlanController::class, 'subscription'])->name("subscription.create");
});


// admin routes start
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
});
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('subscribers', [SubscriberController::class, 'showSubscribers']);
});



// admin routes end

require __DIR__ . '/auth.php';
