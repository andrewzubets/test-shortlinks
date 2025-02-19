<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ShortLinkController;
use App\Http\Controllers\Api\ShortLinkController as ApiShortLinkController;

Route::get('/', IndexController::class.'@index')->name('home');
Route::post('/', IndexController::class.'@create')->name('index.create_shortlink');

Route::get('/s/{shortId}',IndexController::class.'@followShortLink')->name('index.follow_shortlink');


Route::prefix('/short-link')->group(function (){
   Route::get('/', ShortLinkController::class.'@index')->name('shortlink.index');
   Route::get('/edit/{shortLink}', ShortLinkController::class.'@edit')->name('shortlink.edit');
   Route::post('/edit/{shortLink}', ShortLinkController::class.'@update')->name('shortlink.update');
   Route::get('/delete/{shortLink}', ShortLinkController::class.'@destroy')->name('shortlink.destroy');
});


Route::prefix('/api/short-link')->group(function (){
    Route::get('/', ApiShortLinkController::class.'@index');
    Route::post('/', ApiShortLinkController::class.'@store');
    Route::get('/{shortLink}', ApiShortLinkController::class.'@show');
    Route::put('/{shortLink}', ApiShortLinkController::class.'@update');
    Route::delete('/{shortLink}', ApiShortLinkController::class.'@destroy');
//    Route::resource('short-link', \App\Http\Controllers\Api\ShortLinkController::class);
});

