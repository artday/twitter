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
        $user = $request->user();

        $meta = [
            'meta' => [
                'likes' => [],
                'retweets' => []
            ]
        ];

        if ($user) {
            $meta['meta']['likes'] = $this->likes($user);
            $meta['meta']['retweets'] = $this->retweets($user);
        }

        return $meta;
    }

    protected function likes($user)
    {
        return $user->likes()
            ->whereIn(
                'tweet_id',
                $this->collection->pluck('id')
                    ->merge($this->collection->pluck('original_tweet_id'))
            )
            ->pluck('tweet_id')->toArray();
    }
}
