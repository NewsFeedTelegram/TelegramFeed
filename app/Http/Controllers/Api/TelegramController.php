<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\TelegramStoreRequest;
use App\Http\Controllers\Controller;
use App\TelegramChannel;
use App\TelegramChannelMessage;
use Carbon\Carbon;
use PHPHtmlParser\Dom;

class TelegramController extends Controller
{
    public function parsePosts(TelegramChannel $tg_channel, TelegramChannelMessage $tg_message)
    {
        $MadelineProto = new \danog\MadelineProto\API('session.madeline');
        $dom = new Dom();

        $channels = $tg_channel->all();

        foreach ($channels as $channel) {
            $settings = array(
                'peer' => '@' . basename($channel->link),
                'offset_id' => 0,
                'offset_date' => 0,
                'add_offset' => 0,
                'limit' => 100,
                'max_id' => 0,
                'min_id' => $channel->last_post_id ?: 0,
                'hash' => 0
            );

            $data = $MadelineProto->messages->getHistory($settings);
            if (count($data['messages'])) {
                $channel->last_post_id = $data['messages'][0]['id'];
                $channel->save();
            }

            foreach ($data['messages'] as $message) {
                $status = false;
                $url = null;
                $preview = null;
                $link = null;
                if (isset($message['media']) && $message['media']['_'] == 'messageMediaPhoto') {
                    $dom->load($channel->link . '/' . $message['id'] . '/?embed=1');
                    $photo = $dom->getElementsByClass('tgme_widget_message_photo_wrap');
                    foreach ($photo as $item) {
                        $url[] = preg_replace('/[\s\S]*background-image:[ ]*url\(["\']*([\s\S]*[^"\'])["\']*\)[\s\S]*/u',
                            '$1', $photo->getAttribute('style'));
                    }
                    $status = true;
                } elseif (isset($message['media']) && $message['media']['_'] == 'messageMediaDocument') {
                    $dom->load($channel->link . '/' . $message['id'] . '/?embed=1');
                    $docGifOrVideo = $dom->getElementsByTag('video');
                    $docBigVideoFile = $dom->getElementsByClass('tgme_widget_message_video_thumb');
                    $docAudio = $dom->getElementsByClass('tgme_widget_message_video_thumb');
                    $docSticker = $dom->getElementsByClass('tgme_widget_message_sticker');
                    if (count($docGifOrVideo)) {
                        $url[] = $docGifOrVideo->getAttribute('src');
                        $status = true;
                    } elseif (count($docBigVideoFile)) {
                        $preview = preg_replace('/[\s\S]*background-image:[ ]*url\(["\']*([\s\S]*[^"\'])["\']*\)[\s\S]*/u',
                            '$1', $docBigVideoFile->getAttribute('style'));
                        $status = false;
                    } elseif (count($docAudio)) { // для message voice нужна отдельная проверка!
                        $preview = 'music!!!заглушка';
                    } elseif (count($docSticker)) {
                        $url[] = preg_replace('/[\s\S]*background-image:[ ]*url\(["\']*([\s\S]*[^"\'])["\']*\)[\s\S]*/u',
                            '$1', $docSticker->getAttribute('style'));
                    }
                } elseif (isset($message['media']) && $message['media']['_'] == 'messageMediaWebPage') {
                    $dom->load($channel->link . '/' . $message['id'] . '/?embed=1');
                    $webPage = $dom->getElementsByClass('tgme_widget_message_link_preview');
                    if (count($webPage)) {
                        $photo = $dom->getElementsByClass('link_preview_right_image');
                        $photo = count($photo) ? preg_replace('/[\s\S]*background-image:[ ]*url\(["\']*([\s\S]*[^"\'])["\']*\)[\s\S]*/u',
                            '$1', $photo->getAttribute('style')) : null;
                        $link = [
                            'url' => $message['media']['webpage']['url'] ?? null,
                            'display_url' => $message['media']['webpage']['display_url'] ?? null,
                            'type' => $message['media']['webpage']['type'] ?? null,
                            'site_name' => $message['media']['webpage']['site_name'] ?? null,
                            'title' => $message['media']['webpage']['title'] ?? null,
                            'description' => $message['media']['webpage']['description'] ?? null,
                            'photo' => $photo
                        ];
                    }
                }

                $arr = [
                    'tg_channel_id' => $channel->id,
                    'fwd_from' => isset($message['fwd_from']) ?: null,
                    'message_id' => $message['id'],
                    'date' => Carbon::createFromTimestampUTC($message['date'])->toDateTimeString(),
                    'message' => $message['message'] ?? '',
                    'media' => json_encode([
                        'status' => $status,
                        'url' => $url,
                        'preview' => $preview,
                        'webPage' => $link
                    ])
                ];
                $tg_message->create($arr);
            }
            var_dump(count($data['messages'])); echo '<br>';
        }
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
