<?php


use App\Enums\PaymentStatus;
use App\Models\PaymentTransaction;
use Illuminate\Support\Facades\Route;

Route::fallback(function () {
    $locale = session('locale', 'ar');
    $path = request()->path();

    if ($path && !in_array(explode('/', $path)[0], ['ar', 'en'])) {
        return redirect("/{$locale}/{$path}");
    }

    return redirect("/{$locale}");
});


Route::get('/callback', function () {
    $globalTransactionId = request('globalTransactionsId');

    if ($globalTransactionId) {
        $transaction = PaymentTransaction::where('global_transaction_id', $globalTransactionId)->first();

        if ($transaction) {
            if ($transaction->status === PaymentStatus::Paid->value) {
                return redirect()->route('success-payment', $transaction->no);
            }
            return redirect()->route('failed-payment', $transaction->no);
        }
    }

    return redirect()->route('home');
})->name('payment.callback');
