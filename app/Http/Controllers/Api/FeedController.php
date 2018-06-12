<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\TelegramPostsRequest;
use App\Http\Resources\TelegramPostsResource;
use App\Http\Controllers\Controller;
use App\Models\TelegramChannelMessage;
use Illuminate\Http\Request;

class FeedController extends Controller
{
    public function telegramPosts(TelegramChannelMessage $tg_message, TelegramPostsRequest $request)
    {
        $messages = $tg_message->lastMessages($request->id);

        return TelegramPostsResource::collection($messages);
    }
}
