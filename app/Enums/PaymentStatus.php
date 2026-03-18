<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;
use Illuminate\Contracts\Support\Htmlable;

enum PaymentStatus: string
{

    case Pending = 'pending';
    case Paid = 'paid';
    case Failed = 'failed';
    case Cancelled = 'cancelled';
    case Invalid = 'invalid';
    case Error = 'error';
    case Down = 'down';

    public function label(): string
    {
        return match ($this) {
            self::Pending => 'قيد الانتظار',
            self::Paid => 'مدفوع',
            self::Failed => 'فشل',
            self::Cancelled => 'ملغي',
            self::Invalid => 'غير صالح',
            self::Error => 'خطأ',
            self::Down => 'معطل',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::Pending => 'warning',
            self::Paid => 'success',
            self::Failed => 'danger',
            self::Cancelled => 'dark',
            self::Invalid => 'danger',
            self::Error => 'danger',
            self::Down => 'dark',
        };
    }
}
