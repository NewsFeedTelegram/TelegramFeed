<?php

namespace App\Http\Controllers\Api;

use App\TelegramChannelMessage;
use App\User;
use function Composer\Autoload\includeFile;
use danog\MadelineProto\API;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FeedController extends Controller
{
    public function telegram()
    {
        $api = new API('session.madeline');

        $settings = array(
            'peer' => '@' . 'sund1',
            'offset_id' => 0,
            'offset_date' => 0,
            'add_offset' => 0,
            'limit' => 100,
            'max_id' => 0,
            'min_id' => 0,
            'hash' => 0
        );

        dd($api->messages->getHistory($settings));



//        $user = User::find(1);
////        $arr = $user->telegram_channels->pluck('id');
//
//        dump($user->telegram_messages);
//        return;
//        dd(TelegramChannelMessage::whereIn('tg_channel_id', $arr)
//            ->latest('date')
//            ->take(5)
//            ->get());

    }
}
