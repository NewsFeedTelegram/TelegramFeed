<?php

namespace App\Http\Resources;

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
            'fwd_from' => json_decode($this->fwd_from),
            'message' => $this->message,
            'media' => json_decode($this->media),
            'data' => $this->date,
            'channel' => [
                'name' => $this->name,
                'link' => $this->link,
                'description' => $this->description,
                'photo' => $this->photo
            ]
        ];
    }
}
