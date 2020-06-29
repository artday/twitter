<?php

namespace App\Http\Resources;

use App\Tweet;
use Illuminate\Http\Resources\Json\JsonResource;

class TweetResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'body' => $this->body,
            'type' => $this->type,
            'original_tweet' => new TweetResource($this->originalTweet),
            'user' => new UserResource($this->user),
            'created_at' => $this->created_at->timestamp,
        ];
    }
}
