<?php

namespace App\Http\Controllers\Api;

use App\TelegramChannelMessage;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FeedController extends Controller
{
    public function telegram ()
    {
        $user = User::find(1);
        $arr = $user->telegram_channels->pluck('id');

        dd(TelegramChannelMessage::whereIn('tg_channel_id', $arr)
            ->latest('date')
            ->take(5)
            ->get());

    }
}
