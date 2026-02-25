<?php

namespace App\Filament\Resources\BoardMembers\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class BoardMemberForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('الاسم')
                    ->required(),
                TextInput::make('position')
                ->label('المنصب'),
                FileUpload::make('image_path')
                    ->label('الصورة الخارجية')
                    ->disk('public')
                    ->directory('projects')
                    ->required()
                    ->columnSpanFull()
                    ->image(),
            ]);
    }
}
