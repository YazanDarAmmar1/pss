<?php

namespace App\Filament\Resources\Categories\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class CategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label(__('اسم التصنيف'))
                    ->required()
                    ->columnSpanFull(),
                FileUpload::make('image_path')
                    ->label('الصورة البارزة')
                    ->image()
                    ->disk('public')
                    ->directory('categories')
                    ->required()
                    ->columnSpanFull(),
                Textarea::make('description')
                    ->label('الوصف')
                    ->columnSpanFull(),
                Toggle::make('is_active')
                    ->label('الحالة')
                    ->required(),
            ]);
    }
}
