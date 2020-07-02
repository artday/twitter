<?php

namespace App\Http\Resources;

use App\Http\Resources\TweetResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class TweetCollection extends ResourceCollection
{
    public $collects = TweetResource::class;

    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'data' => $this->collection
        ];
    }

    public function with($request)
    {
        return [
            'meta' => [
                'likes' => $this->likes($request->user())
            ]
        ];
    }

    protected function likes($user)
    {
        return !$user ? []  : $user->likes()
            ->whereIn('tweet_id', $this->collection->pluck('id'))
            ->pluck('tweet_id')->toArray();
    }
}
