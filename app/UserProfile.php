<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    protected $table = 'user_profile';

    protected $fillable = [
        'user_id', 'gender', 'about_me', 'birthday', 'country', 'city',
        'telegram', 'twitter',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
