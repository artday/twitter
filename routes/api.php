<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/timeline', 'Api\Timeline\TimelineController@index')->name('timeline');

Route::post('/tweets', 'Api\Tweets\TweetController@store')->name('tweets.store');

Route::post('/tweets/{tweet}/likes', 'Api\Tweets\TweetLikeController@store')
    ->name('tweets.like');
Route::delete('/tweets/{tweet}/likes', 'Api\Tweets\TweetLikeController@destroy')
    ->name('tweets.unlike');
