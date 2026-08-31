<?php

namespace App\Http\Controllers;

use App\Enums\PaymentStatus;
use App\Models\PaymentTransaction;
use Spatie\Browsershot\Browsershot;

class ReceiptController extends Controller
{
    public function download(string $transaction)
    {
        $transaction = PaymentTransaction::where('id', $transaction)
            ->orWhere('no', $transaction)
            ->firstOrFail();

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
            ->setNodeBinary('/usr/bin/node')
            ->setNpmBinary('/usr/bin/npm')
            ->setChromePath('/www/wwwroot/munasara.bh/storage/app/puppeteer-cache/chrome/linux-148.0.7778.97/chrome-linux64/chrome')
            ->setEnvironmentOptions(['HOME' => '/www/wwwroot/munasara.bh/storage/app'])
            ->noSandbox()
            ->addChromiumArguments([
                'disable-crashpad',
                'disable-dev-shm-usage',
                'disable-gpu',
            ])
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
