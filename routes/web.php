<?php

use App\Enums\PaymentStatus;
use App\Models\PaymentTransaction;
use Illuminate\Support\Facades\Route;
Route::match(['get', 'post'], 'callback/{globalTransactionsId}', function ($globalTransactionsId) {
    sleep(5);

    $locale = session('locale', 'ar');
    app()->setLocale($locale);

    info('Callback hit - globalTransactionId: ' . ($globalTransactionsId ?? 'NULL'));

    if (!$globalTransactionsId) {
        return redirect()->route('home', ['locale' => $locale]);
    }

    $transaction = PaymentTransaction::where('global_transaction_id', $globalTransactionsId)->first();
    info($transaction);

    if (!$transaction) {
        return redirect()->route('home', ['locale' => $locale]);
    }

    if ($transaction->status?->value === PaymentStatus::Paid->value) {
        return redirect()->route('success-payment', ['locale' => $locale, 'no' => $transaction->no]);
    }

    return redirect()->route('failed-payment', ['locale' => $locale, 'no' => $transaction->no]);
})->name('payment.callback');


Route::fallback(function () {
    $locale = session('locale', 'ar');
    $path = request()->path();

    if ($path && !in_array(explode('/', $path)[0], ['ar', 'en'])) {
        return redirect("/{$locale}/{$path}");
    }

    return redirect("/{$locale}");
});
