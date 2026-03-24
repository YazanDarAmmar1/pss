<?php

namespace App\Jobs;

use App\Mail\DonationReceiptMail;
use App\Models\PaymentTransaction;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendDonationReceiptJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $transaction;
    public $email;

    public function __construct(PaymentTransaction $transaction, $email)
    {
        $this->transaction = $transaction;
        $this->email = $email;
    }

    public function handle()
    {
        Mail::to($this->email)
            ->send(new DonationReceiptMail($this->transaction));
    }
}
