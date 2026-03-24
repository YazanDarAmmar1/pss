<?php

namespace App\Mail;

use App\Models\PaymentTransaction;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class DonationReceiptMail extends Mailable
{
    use Queueable, SerializesModels;

    public PaymentTransaction $transaction;

    public function __construct(PaymentTransaction $transaction)
    {
        $this->transaction = $transaction;
    }

    /**
     * Subject
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: ' # '. __('Donation Receipt No.') . $this->transaction->no
        );
    }

    /**
     * Blade view + data
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.donation-receipt',
            with: [
                'transaction' => $this->transaction,
            ]
        );
    }

    /**
     * No attachments
     */
    public function attachments(): array
    {
        return [];
    }
}
