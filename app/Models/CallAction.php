<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CallAction extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'event',
        'digit',
        'type',
        'transfer_to',
        'afer_time',
        'audio_link'
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('audio_file');
    }
}
