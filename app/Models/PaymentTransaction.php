<?php

namespace App\Models;

use App\Enums\PaymentStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PaymentTransaction extends Model
{

    protected $table = 'payment_transactions';
    protected $casts = [
        'status' => PaymentStatus::class,

    ];

    protected $fillable = [
        'invoice_id',
        'user_id',
        'amount',
        'no',
        'payment_url',
        'global_transaction_id',
        'status',
        'email_sent_count',
        'last_email_sent_at',
        'created_at'
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($transaction) {
            $lastId = self::max('id') + 1;
            $transaction->no = 'T-' . date('Ymd') . '-' . str_pad($lastId, 6, '0', STR_PAD_LEFT);
        });
    }


    public function user(): BelongsTo
    {
        return $this->belongsTo(AppUser::class, 'user_id');
    }

    public function invoice(): BelongsTo
    {
        return $this->belongsTo(Invoice::class, 'invoice_id');
    }

    public function makeReceipt(string $paymentMethod): Receipt
    {
        $existing = Receipt::where('payment_transaction_id', $this->id)->first();
        if ($existing) {
            return $existing;
        }

        return Receipt::create([
            'app_user_id' => $this->user_id,
            'invoice_id' => $this->invoice_id,
            'payment_transaction_id' => $this->id,
            'amount' => $this->amount,
            'payment_method' => $paymentMethod,
            'date' => $this->created_at->format('Y-m-d'),
        ]);
    }
}
