<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\TelegramStoreRequest;
use App\Http\Controllers\Controller;
use App\Services\TelegramService;
use App\TelegramChannel;
use PHPHtmlParser\Dom;

class TelegramController extends Controller
{

    public function parsePosts()
    {
        $telegramService = new TelegramService();
        $count = $telegramService->parsePosts();

        return response()->json([
           'new_messages' => $count
        ]);
    }

    public function store(TelegramStoreRequest $request, TelegramChannel $telegramChannel)
    {
        $link = 'https://t.me/' . trim($request->link, '/@');
        $channel = $telegramChannel->findChannelByLink($link);
        if (!$channel) {
            $dom = new Dom();
            $dom->load($link);
            $isChannel = count($dom->getElementsByClass('tgme_action_button_new'));

            if ($isChannel) {
                $name = $photo = $description = null;

                $nameTag = $dom->getElementsByClass('tgme_page_title');
                if (count($nameTag)) {
                    $name = $nameTag->innerHtml;
                }

                $imageTag = $dom->getElementsByClass('tgme_page_photo_image');
                if (count($imageTag)) {
                    $photo = $imageTag->getAttribute('src');
                }

                $descriptionTag = $dom->getElementsByClass('tgme_page_description');
                if (count($descriptionTag)) {
                    $description = $descriptionTag->innerHtml;
                }

                if ($name) {
                    $channel = $telegramChannel->create([
                        'name' => $name,
                        'link' => $link,
                        'photo' => $photo,
                        'description' => $description
                    ]);
                } else {
                    return response()->json([
                        'errors' => 'Произошла ошибка.'
                    ], 400);
                }
            } else {
                return response()->json([
                    'errors' => '404 канал не найден'
                ], 404);
            }
        }

        $telegram_subscribers = $channel->users()->syncWithoutDetaching(auth()->id());

        return response()->json([
            'status' => true
        ], 201);

    }

    public function installMadelineProto()
    {
        $settings['connection_settings']['all']['pfs'] = false;

        $MadelineProto = new \danog\MadelineProto\API('session.madeline', $settings);
        $MadelineProto->start();
        echo 'ok';
    }
}
