<?php

namespace App\Filament\Resources\BookCategories\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;

class BookCategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('بيانات التصنيف')
            ->icon(Heroicon::OutlinedInformationCircle)
            ->schema([
                TextInput::make('name')
                    ->label('الاسم')
                    ->columnSpanFull()
                    ->required(),
                Textarea::make('description')
                    ->label('الوصف')
                    ->rows(3)
                    ->columnSpanFull(),
            ])->columnSpanFull()

            ]);
    }
}
