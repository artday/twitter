<?php

namespace App\Http\Controllers\Api\Tweets;

use App\Tweet;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Events\Tweets\TweetLikesWereUpdated;

class TweetLikeController extends Controller
{
    public function store(Tweet $tweet, Request $request)
    {
        $user = $request->user();

        if($user->hasLiked($tweet)) {
            return response(null, 409);
        }

        $user->likes()->create([
            'tweet_id' => $tweet->id
        ]);

        broadcast(new TweetLikesWereUpdated($user, $tweet));
    }

    public function destroy(Tweet $tweet, Request $request)
    {
        $user = $request->user();

        $user->likes->where('tweet_id', $tweet->id)->first()->delete();

        broadcast(new TweetLikesWereUpdated($user, $tweet));
    }
}
