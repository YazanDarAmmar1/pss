<?php

namespace App\Filament\Resources\Sliders\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;

class SliderForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('')
                    ->icon(Heroicon::OutlinedSquares2x2)
                    ->description('يحتوي هذا القسم على البيانات الأساسية اللازمة لتعريف السلايدر وإدارته.')
                    ->schema([
                        TextInput::make('name')
                            ->label('العنوان')
                            ->columnSpanFull()
                            ->required(),
                        Textarea::make('description')
                            ->label('الوصف')
                            ->columnSpanFull(),
                        FileUpload::make('image_path')
                            ->label('الصورة البارزة')
                            ->image()
                            ->columnSpanFull()
                            ->required(),

                        Toggle::make('status')
                            ->label('حالة العرض')
                            ->required(),
                    ]),
                Section::make('')
                    ->icon(Heroicon::OutlinedRectangleGroup)
                    ->description('إعدادات أزرار السلايدر')
                    ->schema([
                        Grid::make(1)
                            ->schema([
                                Toggle::make('first_button_visibility')
                                    ->label('عرض الزر الاول')
                                    ->live()
                                    ->afterStateUpdated(function (Set $set) {
                                        $set('first_button_text',null);
                                        $set('first_button_link',null);
                                    }),
                                TextInput::make('first_button_text')
                                    ->label('عنوان الزر')
                                    ->visible(fn(Get $get) => $get('first_button_visibility')),
                                TextInput::make('first_button_link')
                                    ->label('رابط الزر')
                                    ->visible(fn(Get $get) => $get('first_button_visibility'))
                                    ->url(),
                                Toggle::make('second_button_visibility')
                                    ->label('عرض الزر الثاني')
                                    ->live()
                                    ->afterStateUpdated(function (Set $set) {
                                        $set('second_button_text',null);
                                        $set('second_button_link',null);
                                    }),
                                TextInput::make('second_button_text')
                                    ->label('عنوان الزر')
                                    ->visible(fn (Get $get) => $get('second_button_visibility'))
                                    ->url(),
                                TextInput::make('second_button_link')
                                    ->label('رابط الزر')
                                    ->visible(fn (Get $get) => $get('second_button_visibility'))
                                    ->url(),
                            ]),
                    ]),


            ]);
    }
}
