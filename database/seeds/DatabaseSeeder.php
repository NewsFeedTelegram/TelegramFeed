<?php

use Illuminate\Database\Seeder;
use PHPHtmlParser\Dom;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->createChannels();

    }

    private function createChannels()
    {
        $channels = ['breakingmash', 'lentachold', 'MRZLKVK', 'meduzalive', 'nronlineru', 'meduzaevening',
            'TJournal', 'tv360ru', 'shapi_to'
        ];

        foreach ($channels as $channel) {
            $telegramChannel = new \App\TelegramChannel();
            $link = 'https://t.me/' . $channel;

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
                    $ch = $telegramChannel->create([
                        'name' => $name,
                        'link' => $link,
                        'photo' => $photo,
                        'description' => $description
                    ]);
                    $ch->users()->attach(1);
                } else {
                    continue;
                }
            } else {
                continue;
            }
        }
    }
}
