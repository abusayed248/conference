<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Subscriber\SubscriberController;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
