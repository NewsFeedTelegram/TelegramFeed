<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\TelegramStoreRequest;
use App\Http\Controllers\Controller;
use App\TelegramChannel;
use PHPHtmlParser\Dom;

class TelegramController extends Controller
{
    public function store(TelegramStoreRequest $request,
                          TelegramChannel $telegramChannel)
    {
        $link = 'https://t.me/' . $request->link;
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
                $description = $photo = $imageTag->innerHtml;
            }

            if ($name) {
                $telegramChannel->create([
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


            return response()->json([
                'status' => true
            ], 201);
        } else {
            return response()->json([
                'errors' => '404 канал не найден'
            ], 404);
        }
    }
}
