<?php

namespace App\Filament\Resources\Books\Schemas;

use App\Models\BookCategory;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;

class BookForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('المعلومات الأساسية للكتاب')
                    ->description('يحتوي هذا القسم على البيانات التعريفية الأساسية للكتاب مثل الاسم، التصنيف، المؤلف، والوصف العام.')
                    ->icon(Heroicon::OutlinedSquares2x2)
            ->schema([
                Grid::make(1)
                ->schema([
                    TextInput::make('name')
                        ->label('اسم الكتاب')
                        ->required(),
                    Select::make('book_category_id')
                        ->label('تصنيف الكتاب')
                        ->options(BookCategory::all()->pluck('name', 'id'))
                        ->searchable()
                        ->preload()
                        ->required(),
                    TextInput::make('author')
                        ->label('اسم المؤلف')
                        ->required(),
                    Textarea::make('description')
                        ->label('وصف الكتاب')
                        ->columnSpanFull(),
                ])
            ]),
                Section::make('الملفات والمرفقات الخاصة بالكتاب')
                    ->description('يشمل هذا القسم رفع صورة الغلاف وإرفاق ملف الكتاب بصيغته الإلكترونية.')
                    ->icon(Heroicon::OutlinedRectangleGroup)
                    ->schema([
                        Grid::make(1)
                            ->schema([
                                FileUpload::make('image_path')
                                    ->label('صورة الكتاب')
                                    ->disk('files')
                                    ->directory('books')
                                    ->image()
                                    ->required(),

                                FileUpload::make('book_file_path')
                                    ->label('ملف الكتاب')
                                    ->disk('files')
                                    ->directory('book_files')
                                    ->acceptedFileTypes(['application/pdf'])
                                    ->required(),
                            ])
                    ]),

            ]);
    }
}
