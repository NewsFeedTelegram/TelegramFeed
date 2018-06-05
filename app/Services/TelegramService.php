<?php

namespace App\Services;

use App\Models\TelegramChannel;
use App\Models\TelegramChannelMessage;
use Carbon\Carbon;
use function Couchbase\defaultDecoder;
use danog\MadelineProto\API;
use PHPHtmlParser\Dom;

class TelegramService
{
    private $dom;

    public function parseChannelPhoto($link)
    {
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
                return [
                    'status' => true,
                    'name' => $name,
                    'photo' => $photo,
                    'description' => $description
                ];
            }
        }

        return ['status' => false];
    }

    public function parsePosts()
    {
        $tg_channel = new TelegramChannel();
        $tg_message = new TelegramChannelMessage();

        $MadelineProto = new API(base_path() . '/public/session.madeline');
        $channels = $tg_channel->all();
        $this->dom = new Dom();

        foreach ($channels as $channel) {
            $settings = array(
                'peer' => '@' . basename($channel->link),
                'offset_id' => 0,
                'offset_date' => 0,
                'add_offset' => 0,
                'limit' => 100,
                'max_id' => 0,
                'min_id' => /*$channel->last_post_id ?:*/
                    0,
                'hash' => 0
            );

            $data = $MadelineProto->messages->getHistory($settings);

            if (count($data['messages'])) {
                $channel->last_post_id = $data['messages'][0]['id'];
                $channel->save();
            }

            $prev_album = null;

            foreach ($data['messages'] as $message) {
                /*
                 * type 1 photo messageMediaPhoto
                 * type 2 media album
                 * type 3 video or gif messageMediaDocument
                 * type 4 video > 15 mb messageMediaDocument
                 * type 5 document other messageMediaDocument
                 * type 6 link messageMediaWebPage
                 * type 7 sticker messageMediaDocument
                 * type 8 document audio messageMediaDocument
                 */

                if ($message['_'] === 'messageService') {
                    continue;
                }
                $album = $message['grouped_id'] ?? null;

                if ($album && $prev_album === $album) {
                    continue;
                }
                $prev_album = $message['grouped_id'] ?? null;

                $view_status = false;
                $links_media = $preview = $link = $type = $name_fwd_channel = $link_fwd_channel = $preview_doc = null;
                $post_link = $channel->link . '/' . $message['id'] . '?embed=1';

                if (isset($message['grouped_id'])) {
                    $this->dom->load($post_link);
                    $album = $this->dom->getElementsByClass('tgme_widget_message_grouped_layer');
                    $album_items = $album->find('a');
                    foreach ($album_items as $item) {
                        $photo = preg_replace('/[\s\S]*background-image:[ ]*url\(["\']*([\s\S]*[^"\'])["\']*\)[\s\S]*/u',
                            '$1', $item->getAttribute('style'));
                        $video = $item->find('video');

                        if (count($video)) {
                            $links_media[] = $video->offsetGet(0)->getAttribute('src');
                        }

                        if (strpos($photo, 'http') !== false) {
                            $links_media[] = $photo;
                        }
                        $type = 2;
                        $view_status = true;
                    }
                } elseif (isset($message['media']) && $message['media']['_'] == 'messageMediaPhoto') {
                    //  type 1
                    list($links_media, $type, $view_status) = $this->parseMessageMediaPhoto($post_link);
                } elseif (isset($message['media']) && $message['media']['_'] == 'messageMediaDocument') {
                    // type 3/4/5/7
                    $pmmd = $this->parseMessageMediaDocument($post_link, $message);
                    list($links_media, $type, $view_status, $preview_doc, $preview) = $pmmd;
                } elseif (isset($message['media']) && $message['media']['_'] == 'messageMediaWebPage') {
                    // type 6
                    list($link, $type) = $this->parseMessageMediaWebPage($post_link, $message);
                }

                $id_fwd_channel = isset($message['fwd_from']) ? $message['fwd_from']['channel_id'] : null;
                if ($id_fwd_channel) {
                    foreach ($data['chats'] as $chat) {
                        if ($chat['id'] == $id_fwd_channel) {
                            $name_fwd_channel = $chat['title'];
                            $link_fwd_channel = $chat['username'] ?? null;
                            break;
                        }
                    }
                }

                $arr = [
                    'tg_channel_id' => $channel->id,
                    'fwd_from' => json_encode([
                        'id' => $id_fwd_channel,
                        'name' => $name_fwd_channel,
                        'link' => $link_fwd_channel
                    ]),
                    'message_id' => $message['id'],
                    'date' => Carbon::createFromTimestampUTC($message['date'])->toDateTimeString(),
                    'message' => $message['message'] ?? '',
                    'media' => json_encode([
                        'view_status' => $view_status, // можно ли посмотреть в браузере (true / false)
                        'links_media' => $links_media, // сылки на img, video, gif
                        'preview' => $preview, // превью img для видео больше 15 мб
                        'webPage' => $link, // данные ссылки. тип 6
                        'preview_doc' => $preview_doc,
                        'type' => $type, // тип медиа соо
                    ])
                ];
                $tg_message->create($arr);
            }
        }

        return true;
    }

    private function parseMessageMediaWebPage($post_link, $message)
    {
        $this->dom->load($post_link);
        $webPage = $this->dom->getElementsByClass('tgme_widget_message_link_preview');

        $link = null;

        if (count($webPage)) {
            $photo = $this->dom->getElementsByClass('link_preview_right_image');
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

        return [$link, 6];
    }

    private function parseMessageMediaDocument($post_link, $message)
    {
        $this->dom->load($post_link);
        $docGifOrVideo = $this->dom->getElementsByTag('video'); // type 3
        $docBigVideoFile = $this->dom->getElementsByClass('tgme_widget_message_video_thumb'); // type 4
        $docSticker = $this->dom->getElementsByClass('tgme_widget_message_sticker');  // type 7
        $docAudio = $this->dom->getElementsByClass('audio');  // type 8

        $view_status = false;
        $links_media = $preview_doc = $preview = null;

        if (count($docGifOrVideo)) {
            $links_media[] = $docGifOrVideo->getAttribute('src');
            $view_status = true;
            $type = 3;
        } elseif (count($docBigVideoFile)) {
            $preview = preg_replace('/[\s\S]*background-image:[ ]*url\(["\']*([\s\S]*[^"\'])["\']*\)[\s\S]*/u',
                '$1', $docBigVideoFile->getAttribute('style'));
            $type = 4;
        } elseif (count($docSticker)) {
            $links_media[] = preg_replace('/[\s\S]*background-image:[ ]*url\(["\']*([\s\S]*[^"\'])["\']*\)[\s\S]*/u',
                '$1', $docSticker->getAttribute('style'));
            $view_status = true;
            $type = 8;
        } elseif (count($docAudio)) {
            $type = 8;
            $preview_doc = [
                'name' => $message['media']['document']['attributes'][1]['file_name']
            ];
        } else {
            $type = 5;
            $preview_doc = [
                'name' => $message['media']['document']['attributes'][0]['file_name']
            ];
        }

        return [$links_media, $type, $view_status, $preview_doc, $preview];
    }

    private function parseMessageMediaPhoto($post_link)
    {
        $this->dom->load($post_link);
        $photo = $this->dom->getElementsByClass('tgme_widget_message_photo_wrap');

        $links_media[] = preg_replace('/[\s\S]*background-image:[ ]*url\(["\']*([\s\S]*[^"\'])["\']*\)[\s\S]*/u',
            '$1', $photo->getAttribute('style'));

        return [$links_media, 1, true];
    }
}