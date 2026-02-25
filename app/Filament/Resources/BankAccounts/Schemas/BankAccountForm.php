<?php

namespace App\Filament\Resources\BankAccounts\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class BankAccountForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('اسم الحساب')
                    ->required(),
                TextInput::make('account_number')
                    ->label('رقم الحساب')
                    ->required(),
                TextInput::make('currency')
                    ->label('العملة')
                    ->required()
                    ->default('BHD'),
            ]);
    }
}
