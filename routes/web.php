<?php

use App\Enums\PaymentStatus;
use App\Models\PaymentTransaction;
use Illuminate\Support\Facades\Route;

Route::match(['get', 'post'], 'callback', function () {
    sleep(5);

    // اضبط الـ locale من السيشن قبل الـ redirect
    $locale = session('locale', 'ar');
    app()->setLocale($locale);

    $globalTransactionId = request('globalTransactionsId');
    info($globalTransactionId);

    if (!$globalTransactionId) {
        return redirect()->route('home');
    }

    $transaction = PaymentTransaction::where('global_transaction_id', $globalTransactionId)->first();

    if (!$transaction) {
        return redirect()->route('home',['locale' => $locale]);
    }

    if ($transaction->status?->value === PaymentStatus::Paid->value) {
        return redirect()->route('success-payment', ['locale' => $locale, 'no' => $transaction->no]);
    }

    return redirect()->route('failed-payment', ['locale' => $locale, 'no' => $transaction->no]);
})->name('payment.callback');


Route::fallback(function () {
    $locale = session('locale', 'ar');
    $path = request()->path();

    $excluded = ['callback'];
    if (in_array($path, $excluded)) {
        abort(404);
    }

    if ($path && !in_array(explode('/', $path)[0], ['ar', 'en'])) {
        return redirect("/{$locale}/{$path}");
    }

    return redirect("/{$locale}");
});
