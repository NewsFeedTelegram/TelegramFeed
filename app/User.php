<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    protected $table = 'user';

    protected $fillable = [
        'first_name', 'last_name', 'login', 'avatar', 'password'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey(); // Eloquent Model method
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}
