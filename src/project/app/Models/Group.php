<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Group extends Model
{
    use HasFactory;

    protected $fillable = ['username', 'title', 'user_id', 'type'];

    public function messages()
    {
        return $this->hasMany(GroupMessage::class);
    }

    public function owner()
    {
        return $this->belongsTo(User::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class)->withPivot('role');
    }

    public function avatar()
    {
        return $this->morphOne(Media::class, 'mediaable')->where('type', Media::IMAGE);
    }

    protected function updatedAt(): Attribute
    {
        return Attribute::make(
            get: fn($value) => verta($value)->format('%B %d، %Y')
        );
    }

    public function getAvatar()
    {
        $avatar = $this->avatar;
        if ($avatar) {
            return $avatar->getUrl();
        }

        return 'cdn/theme/admin/media/avatars/blank.png';
    }
}
