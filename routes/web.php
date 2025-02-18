<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShortLinkController;

Route::get('/', ShortLinkController::class.'@index')->name('home');
Route::post('/', ShortLinkController::class.'@create')->name('shortlink.create');

Route::get('/s/{shortId}',ShortLinkController::class.'@followShortLink')->name('shortlink.shortlink');
