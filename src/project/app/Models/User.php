<?php

namespace App\Models;

use App\Enums\GroupRole;
use App\Traits\HasRole;
use App\Utility\SMSUtility;
use Hekmatinasser\Verta\Verta;
use App\Utility\Search\WithFilter;
use App\Utility\Search\WithSearch;
use Illuminate\Support\Facades\Hash;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Notifications\ResetPasswordNotification;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable, SMSUtility, HasRole, WithSearch, SoftDeletes, WithFilter;

    protected $fillable = [
        'name',
        'email',
        'mobile',
        'password',
        'two_step_status',
        'two_step_type',
        'sms_code',
        'avatar',
        'country',
        'last_ip',
        'last_login',
        'account_verified_at',
        'mobile_verified_at',
        'email_verified_at',
        'google2fa_secret',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'google2fa_secret',
    ];

    public $search = [
        'name', 'email', 'mobile'
    ];

    public function userChat()
    {
        return $this->hasOne(UserChat::class);
    }

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'account_verified_at' => 'datetime',
        'mobile_verified_at' => 'datetime',
        'email_verified_at' => 'datetime',
    ];

    public function avatar()
    {
        $avatar = $this->profileAvatar;

        if ($avatar) {
            return $avatar->getUrl();
        } else {
            $generalDefaultAvatar = Config::where('key', 'general_default_avatar')->first();

            if ($generalDefaultAvatar) {
                return $generalDefaultAvatar->value;
            }
        }

        return 'cdn/theme/admin/media/avatars/blank.png';
    }

    protected function password(): Attribute
    {
        return Attribute::make(
            set: fn($value) => Hash::make($value)
        );
    }

    public function isAdministrator()
    {
        return $this->roles->contains('name', 'superadmin');
    }

    protected function createdAt(): Attribute
    {
        return Attribute::make(
            get: fn($value) => verta($value)->format('%B %d، %Y')
        );
    }

    protected function lastLogin(): Attribute
    {
        return Attribute::make(
            get: fn($value) => $value ? verta()->format('%B %d، %Y') : ''
        );
    }

    /**
     * @param $token
     * @return void
     */
    public function sendPasswordResetNotification($token): void
    {
        $url = route('password.reset', [
            'token' => $token,
            'email' => $this->email
        ]);

        $this->notify(new ResetPasswordNotification($url));
    }

    /**
     * @return bool
     */
    public function twoStepStatus(): bool
    {
        return (bool)$this->two_step_status;
    }

    /**
     * get towFA type
     * @param int $type
     * @return bool
     */
    public function twoStepType(int $type): bool
    {
        return $this->two_step_type == $type;
    }

    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return (bool)$this->account_verified_at;
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function profileAvatar()
    {
        return $this->morphOne(Media::class, 'mediaable');
    }

    public function chatStatus()
    {
        return $this->hasOne(UserChat::class);
    }

    public function chatMessages()
    {
        return $this->hasMany(ChatMessages::class, 'from_id');
    }

    public function groupMessages()
    {
        return $this->hasMany(GroupMessage::class, 'from_id');
    }

    /**
     * a user can have many group
     *
     * @return void
     */
    public function createdGroups()
    {
        return $this->hasMany(Group::class);
    }

    /**
     *
     *
     * @return void
     */
    public function groups()
    {
        return $this->belongsToMany(Group::class)->withPivot('role');
    }

    /**
     * @param Group $group
     * @return boolean
     */
    public function isAdminInGroup(Group $group):bool
    {
        return $group->users->contains($this->id) && $this->groups->where('id', $group->id)->first()->pivot->role == GroupRole::Admin;
    }

    /**
     *
     */
    public function isSeen()
    {
        return $this->chatStatus && $this->chatStatus->is_online && $this->chatStatus->active_user_id == auth()->id() ;
    }

    /**
     *
     */
    public function isCalling()
    {
        return $this->chatStatus->is_calling ?? false;
    }
}
