<?php

namespace App\Models;

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TelnyxEvent extends Model
{
    use HasFactory;

    protected $table = 'telnyx_events';

    protected $fillable = [
        'phone',
        'call_control_id',
        'event_type',
        'command_id',
        'client_state',
        'payload',
        'request',
        'status',
    ];

    protected $casts = [
        'payload' => 'array', // Automatically convert JSON to array
        'request' => 'array', // Automatically convert JSON to array
    ];
}
