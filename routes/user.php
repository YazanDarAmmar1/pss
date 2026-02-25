<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => '{locale}', 'where' => ['locale' => 'ar|en']], function () {
    Route::group(['middleware' => 'auth:app'], function () {
        Route::get('/profile', \App\Livewire\User\Index::class)->name('profile');
    });
});

