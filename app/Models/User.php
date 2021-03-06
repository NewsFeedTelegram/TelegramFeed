<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;
    protected $fillable = [
        'first_name', 'last_name', 'login', 'avatar', 'password'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    // relations
    public function profile()
    {
        return $this->hasOne(UserProfile::class);
    }

    public function telegram_channels()
    {
        return $this->belongsToMany(TelegramChannel::class, 'telegram_subscribers',
            'user_id', 'tg_channel_id');
    }

    // jwt
    public function getJWTIdentifier()
    {
        return $this->getKey(); // Eloquent Model method
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}
