<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CallActionDetails extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'call_action_id',
        'number',
        'need_time_for_transfer',
        'afer_time',
        'audio_link',
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('audio_file');
    }
}
