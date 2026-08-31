<?php

namespace App\Http\Controllers;

use App\Enums\PaymentStatus;
use App\Models\PaymentTransaction;
use Spatie\Browsershot\Browsershot;

class ReceiptController extends Controller
{
    public function download(PaymentTransaction $transaction)
    {
        abort_unless($transaction->status === PaymentStatus::Paid, 404);

        $invoice = $transaction->invoice()
            ->with(['user', 'receipt.user'])
            ->firstOrFail();

        $receipt = $invoice->receipt;

        $html = view('pdf.receipt', [
            'data' => $invoice,
            'receipt' => $receipt,
        ])->render();

        $pdf = Browsershot::html($html)
            ->format('A4')
            ->showBackground()
            ->margins(0, 0, 0, 0)
            ->waitUntilNetworkIdle()
            ->pdf();

        return response($pdf, 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="receipt-' . $invoice->no . '.pdf"',
        ]);
    }
}
