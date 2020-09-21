<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Auth::routes([
    'register' => false,
    'reset' => false,
    'verify' => false,
    'confirm' => false
]);

Route::get('/{any}', function () {
    return view('app');
})
    ->where('any', '.*')->middleware('auth')->name('home');