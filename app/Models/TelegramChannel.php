<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TelegramChannel extends Model
{
    protected $table = 'telegram_channels';

    protected $fillable = [
        'name', 'link', 'description', 'photo'
    ];

    public function findChannelByLink($link)
    {
        return $this->where('link', $link)->first();
    }

    public function saveChannel($channel, $link)
    {
        return $this->create([
            'name' => $channel['name'],
            'link' => $link,
            'photo' => $channel['photo'],
            'description' => $channel['description'],
        ]);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'telegram_subscribers',
            'tg_channel_id', 'user_id');
    }

    public function messages()
    {
        return $this->hasMany(TelegramChannelMessage::class, 'tg_channel_id');
    }
}
