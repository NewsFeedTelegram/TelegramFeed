<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class TelegramPostsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'message_id' => $this->message_id,
            'fwd_from' => json_decode($this->fwd_from),
            'message' => $this->message,
            'media' => json_decode($this->media),
            'data' => Carbon::createFromTimeString($this->date)->timestamp,
            'channel' => [
                'name' => $this->name,
                'link' => $this->link,
                'description' => $this->description,
                'photo' => $this->photo
            ]
        ];
    }
}
