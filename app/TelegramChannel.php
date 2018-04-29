<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TelegramChannel extends Model
{
    protected $table = 'telegram_channel';

    protected $fillable = [
        'name', 'link', 'description', 'photo'
    ];
}
