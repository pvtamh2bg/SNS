<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Tweet extends JsonResource
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
            'text' => $this->text,
            'entities' => (isset($this->extended_entities->media)) ? $this->extended_entities->media : '',
            'retweet_count' => $this->retweet_count,
            'screen_name' => $this->user->screen_name,
            'favorite_count' => $this->favorite_count,
            'created_at' => date('H:s . Y/m/d',strtotime($this->created_at))
        ];
    }
}
