<?php

namespace App\Filament\Resources\News\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;

class NewsForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('')
            ->description('يحتوي هذا القسم على بيانات الخبر الاساسية')
                    ->icon(Heroicon::OutlinedSquares2x2)
                    ->schema([
                Grid::make(1)
                ->schema([
                    TextInput::make('name')
                        ->label('العنوان')
                        ->required(),
                    FileUpload::make('image_path')
                        ->label('الصورة البارزة')
                        ->image()
                        ->disk('files')
                        ->directory('news')
                        ->required(),

                    DatePicker::make('date')
                        ->label('التاريخ')
                        ->required(),
                    Toggle::make('is_active')
                        ->label('حالة العرض')
                        ->required(),
                ]),

            ]),

                Section::make('')
                    ->description('يحتوي هذا القسم على وصف الخبر')
                    ->icon(Heroicon::OutlinedRectangleGroup)

                    ->schema([
                    Grid::make(1)
                        ->schema([
                            Textarea::make('short_description')
                                ->label('الوصف المختصر')
                                ->required()
                                ->rows(4)
                                ->columnSpanFull(),
                            RichEditor::make('description')
                                ->label('الوصف')
                                ->required()
                                ->columnSpanFull(),
                        ])
                ])

            ]);
    }
}
