<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TelegramChannelMessage extends Model
{
    protected $table = 'telegram_channels_messages';

    protected $fillable = [
      'tg_channel_id', 'fwd_from', 'message_id', 'date', 'message', 'media'
    ];
}
