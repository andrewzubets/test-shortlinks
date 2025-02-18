<?php

use Illuminate\Support\Facades\Route;

Route::get('/', \App\Http\Controllers\ShortLinkController::class.'@index')->name('home');
Route::post('/', \App\Http\Controllers\ShortLinkController::class.'@create')->name('shortlink.create');
