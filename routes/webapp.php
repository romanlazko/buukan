<?php
use Illuminate\Support\Facades\Route;

Route::domain('webapp.buukan.com')->group(function () {
    Route::get('/', function (string $account) {
        return $account;
    });
});