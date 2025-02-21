<?php

namespace App\Services;

use Carbon\Carbon;
use App\Models\User;

class SubscriptionsService
{
    public function isActivePremimium($phoneNumber)
    {
        $user = User::query()->where('phone', $phoneNumber)->first();

        if ($user && $user->payment_done && $user->payment_end && Carbon::now()->lt($user->payment_end)) {
            return true;
        }
        return false;
    }

    public function isActive($phoneNumber)
    {
        $user = User::where('phone', $phoneNumber)->first();

        if ($user && ($user->payment_done || $user->free_trial !== null)) {
            return true;
        }
        return false;
    }
}
