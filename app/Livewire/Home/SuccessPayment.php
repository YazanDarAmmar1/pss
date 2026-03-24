<?php

namespace App\Livewire\Home;

use App\Jobs\SendDonationReceiptJob;
use App\Models\PaymentTransaction;
use Carbon\Carbon;
use Livewire\Component;

class SuccessPayment extends Component
{
    public $transaction;
    public $email;
    public $successMessage;
    protected $rules = [
        'email' => 'required|email',
    ];

    public function mount($transaction)
    {
        $this->transaction = PaymentTransaction::paid()->with([
            'invoice',
            'invoice.items'
        ])
            ->where('no', $transaction)
            ->first();

        if (!$this->transaction) {
            $this->redirectRoute('home');
            return;
        }

        $this->transaction->invoice?->cart?->changeClose();
    }

    public function render()
    {
        return view('livewire.home.success-payment')->layout('layouts.app');
    }

    public function sendEmail()
    {
        $this->validate();
        $this->successMessage = null;

        // حد أقصى للإرسال
        if ($this->transaction->email_sent_count >= 3) {
            $this->addError(
                'email',
                'تم إرسال إيصال التبرع 3 مرات كحد أقصى.'
            );
            return;
        }

        // الانتظار بين كل إرسال (دقيقتين)
        if ($this->transaction->last_email_sent_at) {

            $lastSent = Carbon::parse($this->transaction->last_email_sent_at);
            $nextAllowedAt = $lastSent->addMinutes(2);
            $now = now();

            if ($now->lt($nextAllowedAt)) {

                $secondsLeft = $now->diffInSeconds($nextAllowedAt);
                $minutes = intdiv($secondsLeft, 60);
                $seconds = $secondsLeft % 60;

                $this->addError(
                    'email',
                    'يرجى الانتظار ' .
                    ($minutes > 0 ? $minutes . ' دقيقة و ' : '') .
                    $seconds . ' ثانية قبل إعادة الإرسال.'
                );

                return;
            }
        }

        // إرسال الإيميل
        dispatch(new SendDonationReceiptJob($this->transaction, $this->email));

        $this->transaction->increment('email_sent_count');
        $this->transaction->update([
            'last_email_sent_at' => now(),
        ]);

        $this->successMessage = 'تم إرسال الإيصال إلى البريد الإلكتروني';

    }
}
