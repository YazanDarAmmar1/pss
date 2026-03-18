<?php

namespace App\Models;

use App\Enums\PaymentStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Invoice extends Model
{
    protected $table = 'invoices';

    protected $fillable = [
        'user_id',
        'cart_id',
        'no',
        'amount',
        'status',
        'admin_id',
        'created_at'
    ];
    protected $casts = [
        'status' => PaymentStatus::class,
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($invoice) {
            $lastId = self::max('id') + 1;
            $invoice->no = 'INV-' . date('Ymd') . '-' . str_pad($lastId, 6, '0', STR_PAD_LEFT);
        });

    }

    public function cart(): BelongsTo
    {
        return $this->belongsTo(Cart::class, 'cart_id', 'id');
    }

    public function items(): HasMany
    {
        return $this->hasMany(InvoiceItem::class, 'invoice_id', 'id');
    }

    public function transactions(): HasMany
    {
        return $this->hasMany(PaymentTransaction::class, 'invoice_id', 'id');
    }
}
