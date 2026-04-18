<?php

use App\Enums\PaymentStatus;
use App\Models\PaymentTransaction;
use Illuminate\Support\Facades\Route;


Route::match(['get', 'post'], 'callback', function () {
    sleep(5);
    $globalTransactionId = request('globalTransactionsId');
    info('Callback hit: ' . $globalTransactionId);

    if (!$globalTransactionId) {
        return redirect()->route('home');
    }

    $transaction = PaymentTransaction::where('global_transaction_id', $globalTransactionId)->first();

    if (!$transaction) {
        return redirect()->route('home');
    }

    if ($transaction->status?->value === PaymentStatus::Paid->value) {
        return redirect()->route('success-payment', $transaction->no);
    }

    return redirect()->route('failed-payment', $transaction->no);
})->name('payment.callback');


Route::fallback(function () {
    $locale = session('locale', 'ar');
    $path = request()->path();

    if ($path && !in_array(explode('/', $path)[0], ['ar', 'en'])) {
        return redirect("/{$locale}/{$path}");
    }

    return redirect("/{$locale}");
});
