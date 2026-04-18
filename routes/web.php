<?php


use App\Enums\PaymentStatus;
use App\Models\PaymentTransaction;
use Illuminate\Support\Facades\Route;

Route::match(['get', 'post'], 'callback', function () {
    sleep(5);
    $globalTransactionId = request('globalTransactionsId');
    info($globalTransactionId);

    if (!$globalTransactionId) {
        return redirect()->route('home');
    }

    $transaction = PaymentTransaction::where('global_transaction_id', $globalTransactionId)->first();
    info($transaction);

    if (!$transaction) {
        return redirect()->route('home');
    }
    info($transaction->status?->value);

    if ($transaction->status?->value === PaymentStatus::Paid->value) {
        return redirect()->route('success-payment', $transaction->no);
    }

    return redirect()->route('failed-payment', $transaction->no);

})->name('payment.callback');


