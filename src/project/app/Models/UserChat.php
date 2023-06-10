<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserChat extends Model
{
    use HasFactory;

    protected $fillable = [
        'is_online',
        'is_calling',
        'peer_id',
        'user_id',
        'active_user_id',
    ];

    protected $table = 'user_chat_status';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
