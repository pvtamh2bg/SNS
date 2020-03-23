<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Instagram extends JsonResource
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
            'caption' => $this->caption,
            'media_url' => $this->media_url,
            'username' => $this->username,
            'comment_count' => $this->comments_count,
            'like_count' => $this->like_count,
            'created_at' => date('H:s . Y/m/d',strtotime($this->timestamp))
        ];
    }
}
