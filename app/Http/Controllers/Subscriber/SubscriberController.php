<?php

namespace App\Http\Controllers\Subscriber;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SubscriberController extends Controller
{
    public function subMenu() {
        return view('sub-menu');
    }
    public function manageSubscriber() {
        return view('manage-subscriber');
    }
}
