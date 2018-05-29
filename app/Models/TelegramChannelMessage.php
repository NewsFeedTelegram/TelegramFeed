<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TelegramChannelMessage extends Model
{
    protected $table = 'telegram_channels_messages';

    protected $fillable = [
        'tg_channel_id', 'fwd_from', 'message_id', 'date', 'message', 'media'
    ];

    public function lastMessages($id)
    {
        $query = DB::table('telegram_channels_messages as m')
            ->select([
                'm.id', 'm.fwd_from', 'm.date', 'm.message', 'm.media',
                'c.name', 'c.link', 'c.description', 'c.photo'
            ])
            ->join('telegram_channels as c', 'c.id', 'tg_channel_id');

        if ($id !== null) {
            $query->where([['m.date', '<=', function($query) use ($id) {
                $query->select('date')
                    ->from('telegram_channels_messages')
                    ->where('id', $id)
                    ->first();
            }], ['m.id', '!=', $id]]);
        }

        return
            $query
                ->whereIn('m.tg_channel_id', function ($query) {
                    $query->select('tg_channel_id')
                        ->from('telegram_subscribers')
                        ->where('user_id', auth()->id())->get();
                })
                ->orderBy('m.date', 'DESK')
                ->limit(10)
                ->get();
    }
}
