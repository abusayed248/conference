<?php

namespace App\Services;

use Carbon\Carbon;
use App\Models\User;

class SubscriptionsService
{
    public function isActive($phoneNumber)
    {
        $user = User::query()->where('phone', $phoneNumber)->first();

        if ($user && $user->payment_done && $user->payment_end && Carbon::now()->lt($user->payment_end)) {
            return true; // Active subscription
        }

        return false; // Inactive subscription or user not found
    }
}
