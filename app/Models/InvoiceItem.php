<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class InvoiceItem extends Model
{
    protected $table = 'invoice_items';
    protected $fillable = [
        'invoice_id',
        'project_id',
        'amount',
        'created_at'
    ];

    public function invoice(): BelongsTo
    {
        return $this->belongsTo(Invoice::class, 'invoice_id', 'id');
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class, 'project_id', 'id');
    }

    public function receipts(): HasManyThrough
    {
        return $this->hasManyThrough(
            Receipt::class,  // الموديل النهائي
            Invoice::class,  // الموديل الوسيط
            'id',
            'invoice_id',
            'invoice_id',
            'id'
        );
    }
}
