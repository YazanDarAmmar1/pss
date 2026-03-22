<?php

namespace App\Models;

use App\Enums\PaymentMethods;
use App\Events\UserPaymentDone;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Receipt extends Model
{
    protected $table = 'receipts';
    protected $fillable = [
        'app_user_id',
        'invoice_id',
        'payment_transaction_id',
        'amount',
        'no',
        'payment_method',
        'date',
        'created_at',
    ];

    protected $casts = [
        'payment_method' => PaymentMethods::class,
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($receipt) {
            $lastId = self::max('id') + 1;
            $receipt->no = 'REC' . '-' . str_pad($lastId, 6, '0', STR_PAD_LEFT);
        });

        static::created(function ($receipt) {
            event(new UserPaymentDone($receipt));
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

    public function paymentTransaction(): BelongsTo
    {
        return $this->belongsTo(PaymentTransaction::class, 'payment_transaction_id');
    }
}
