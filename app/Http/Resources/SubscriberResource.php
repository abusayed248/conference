<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SubscriberResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {


        if ($this->payment_done && $this->payment_end && Carbon::now()->lt($this->payment_end)) {
            $status = 'Subscriber';
        } elseif (Carbon::now() <= $this->free_trial) {
            $status = 'Free Trial';
        } elseif ($this->is_cancel_free_trial) {
            $status = 'Cancel Free Trial';
        } elseif (Carbon::now() >= $this->free_trial) {
            $status = 'Free Trial Expire';
        }





        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'is_cancel_free_trial' => $this->is_cancel_free_trial,
            'card_number' => $this->card_number,
            'photo' => $this->photo,
            'email_verified_at' => $this->email_verified_at,
            'role' => $this->role,
            'stripe_customer_id' => $this->stripe_customer_id,
            'payment_done' => $this->payment_done,
            'free_trial' => $this->free_trial,
            'payment_date' => $this->payment_date,
            'payment_end' => $this->payment_end,
            'stripe_subscription_id' => $this->stripe_subcription_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'status' => $status
        ];
    }
}
