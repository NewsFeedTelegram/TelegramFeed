<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\TelegramStoreRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\TelegramChannelResource;
use App\Services\TelegramService;
use App\Models\TelegramChannel;

class TelegramController extends Controller
{

    public function getChannels()
    {
        $channels = auth()->user()->telegram_channels;

        return TelegramChannelResource::collection($channels);
    }

    public function saveChannel(TelegramStoreRequest $request, TelegramChannel $telegramChannel)
    {
        $tg_service = new TelegramService();
        $link = 'https://t.me/' . trim(basename($request->link), '/@');
        $channel = $telegramChannel->findChannelByLink($link);
        if (!$channel) {
            $channel = $tg_service->parseChannelPhoto($link);
            if ($channel['status']) {
                $channel = $telegramChannel->saveChannel($channel, $link);
            } else {
                return response()->json([
                    'errors' => '404: канал не найден'
                ], 404);
            }
        }
        $channel->users()->syncWithoutDetaching(auth()->id());

        return new TelegramChannelResource($channel);
    }

    public function deleteChannel($id)
    {
        if (auth()->user()->telegram_channels()->detach($id)) {
            return response()->json([
                'status' => true
            ], 200);
        } else {
            return response()->json([
                'status' => false
            ], 200);
        }
    }

    /*
     * for test
     */
    public function parsePosts()
    {
        $tg_service = new TelegramService();
        $status = $tg_service->parsePosts();

        return response()->json([
            'status' => $status
        ]);
    }

    public function installMadelineProto()
    {
        $settings['connection_settings']['all']['pfs'] = false;

        $MadelineProto = new \danog\MadelineProto\API('session.madeline', $settings);
        $MadelineProto->start();
        echo 'ok';
    }
}
