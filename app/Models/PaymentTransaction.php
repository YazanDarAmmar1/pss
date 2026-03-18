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

}
