<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\TelegramPostsResource;
use App\Http\Controllers\Controller;
use App\TelegramChannelMessage;
use Illuminate\Http\Request;

class FeedController extends Controller
{
    public function telegramPosts(TelegramChannelMessage $tg_message, Request $request)
    {
        // валидация
        $date = $request->date;
        $id = $request->id;
        $messages = $tg_message->lastMessages($date, $id);

        return TelegramPostsResource::collection($messages);
    }
}
