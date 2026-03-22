<?php

namespace App\Enums;

enum PaymentMethods: string
{
    case MASTERCARD = 'mastercard';
    case BENEFIT = 'benefit';
    case APPLE = 'apple';
    case VISA = 'visa';

    public function label(): string
    {
        return match ($this) {
            self::MASTERCARD => 'mastercard',
            self::BENEFIT => 'benefit',
            self::APPLE => 'apple',
            self::VISA => 'visa',
        };
    }


    public function color(): string
    {
        return match ($this) {
            self::MASTERCARD => 'primary',
            self::BENEFIT => 'success',
            self::APPLE => 'info',
            self::VISA => 'dark',
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

