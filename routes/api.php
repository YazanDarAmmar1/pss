<?php

use Illuminate\Support\Facades\Route;

Route::prefix('eazy')->group(function () {
    Route::match(['get', 'post'], '/callback', [\App\Http\Controllers\Api\FinanceController::class, 'eazyPayCallback'])
        ->name('eazy.callback');
});
