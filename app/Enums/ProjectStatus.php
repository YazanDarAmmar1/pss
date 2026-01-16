<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;
use Illuminate\Contracts\Support\Htmlable;

enum ProjectStatus: string implements HasLabel
{

    case NEW = 'new';
    case PENDING = 'pending';
    case ACTIVE = 'active';
    case FULL = 'full';
    case DISABLED = 'disabled';


    public function getLabel(): string | Htmlable | null
    {
        return match ($this) {
            self::NEW => 'جديد',
            self::PENDING => 'تحت الدراسة',
            self::ACTIVE => 'فعال',
            self::FULL => 'مكتمل',
            self::DISABLED => 'متوقف',
        };
    }


    public function getColor(): string | array | null
    {
        return match ($this) {
            self::NEW => 'info',
            self::PENDING => 'warning',
            self::ACTIVE => 'primary',
            self::FULL => 'success',
            self::DISABLED => 'danger',
        };
    }


    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }


    public static function options(): array
    {
        $options = [];
        foreach (self::cases() as $case) {
            $options[$case->value] = $case->label();
        }
        return $options;
    }

}
