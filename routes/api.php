<?php

use App\Http\Controllers\Api\FinanceController;
use Illuminate\Support\Facades\Route;

Route::prefix('eazy')->group(function () {
    Route::match(['get', 'post'], '/callback', [FinanceController::class, 'eazyPayCallback'])
        ->name('eazy.callback');
});
Route::any('benefit-response-url', [FinanceController::class, 'benefitResponseURL'])->name('benefit.response.url');
