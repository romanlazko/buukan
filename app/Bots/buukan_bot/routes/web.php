<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['web', 'auth', 'telegram:buukan_bot'])->name('buukan_bot.')->group(function () {
    Route::get('/page', function(){
        return view('buukan_bot::page');
    })->name('page');
});