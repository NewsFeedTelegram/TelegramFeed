<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'login' => $this->login,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'avatart' => $this->avatar,
            'last_visit' => $this->last_visit,
        ];
    }
}
