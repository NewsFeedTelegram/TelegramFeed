<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TelegramChannel extends Model
{
    protected $table = 'telegram_channels';

    protected $fillable = [
        'name', 'link', 'description', 'photo'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'telegram_subscribers',
            'tg_channel_id', 'user_id');
    }

    public function findChannelByLink($link)
    {
        return $this->where('link', $link)->first();
    }
}
