<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ChatMessages extends Model
{
    use HasFactory;

    protected $fillable = ['from_id', 'to_id', 'message', 'seen'];

    protected function createdAt(): Attribute
    {
        return Attribute::make(
            get: fn($value) => verta($value)->format('%B %d، %Y')
        );
    }

    public function image()
    {
        return $this->morphOne(Media::class, 'mediaable')->where('type', Media::IMAGE);
    }

    public function audio()
    {
        return $this->morphOne(Media::class, 'mediaable')->where('type', Media::AUDIO_MEDIA);
    }

    public function video()
    {
        return $this->morphOne(Media::class, 'mediaable')->where('type', Media::VIDEO);
    }

    public function otherMedia()
    {
        return $this->morphOne(Media::class, 'mediaable')->where('type', Media::OTHER_MEDIA);
    }

    public function fromUser()
    {
        return $this->belongsTo(User::class, 'from_id');
    }

    public function toUser()
    {
        return $this->belongsTo(User::class, 'to_id');
    }
}
