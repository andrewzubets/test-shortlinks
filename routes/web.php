<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;

Route::get('/', IndexController::class.'@index')->name('home');
Route::post('/', IndexController::class.'@create')->name('index.create_shortlink');

Route::get('/s/{shortId}',IndexController::class.'@followShortLink')->name('index.follow_shortlink');


Route::prefix('/short-links')->group(function (){
   Route::get('/', \App\Http\Controllers\ShortLinkController::class.'@index')->name('shortlink.index');
   Route::get('/edit/{shortLink}', \App\Http\Controllers\ShortLinkController::class.'@edit')->name('shortlink.edit');
   Route::post('/edit/{shortLink}', \App\Http\Controllers\ShortLinkController::class.'@update')->name('shortlink.update');
   Route::get('/delete/{shortLink}', \App\Http\Controllers\ShortLinkController::class.'@destroy')->name('shortlink.destroy');
});
