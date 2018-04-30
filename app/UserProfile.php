<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    protected $table = 'users_profiles';

    protected $fillable = [
        'user_id', 'gender', 'about_me', 'birthday', 'country', 'city',
        'telegram', 'twitter',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
