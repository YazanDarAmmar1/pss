<?php

namespace App\Filament\Resources\Projects\Schemas;

use App\Enums\ProjectStatus;
use App\Models\Category;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Malzariey\FilamentLexicalEditor\Enums\ToolbarItem;
use Malzariey\FilamentLexicalEditor\LexicalEditor;

class ProjectForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('البيانات الأساسية للمشروع')
                    ->icon(Heroicon::OutlinedSquares2x2)
                    ->description('يحتوي هذا القسم على جميع البيانات الأساسية اللازمة لتعريف المشروع وإدارته.')
                    ->schema([
                        Grid::make(3)
                            ->schema([
                                TextInput::make('name')
                                    ->label('الاسم')
                                    ->required()
                                    ->formatStateUsing(fn($state) => self::localize($state))
                                    ->columnSpan(1),
                                Select::make('category_id')
                                    ->label('التصنيف')
                                    ->searchable()
                                    ->options(Category::Active()->pluck('name', 'id'))
                                    ->preload()
                                    ->required(),
                                Select::make('status')
                                    ->searchable()
                                    ->options(ProjectStatus::class)
                                    ->label('الحالة')
                                    ->required()
                                    ->default('new'),
                            ]),
                        Grid::make(2)
                            ->schema([
                                DatePicker::make('date_start')
                                    ->label('تاريخ البداية'),
                                DatePicker::make('date_end')
                                    ->label('تاريخ النهاية'),
                                TextInput::make('target_amount')
                                    ->label('المبلغ المستهدف')
                                    ->numeric()
                                    ->default(0.0),
                                TextInput::make('default_amount')
                                    ->label('مبلغ التبرع الإفتراضي')
                                    ->required()
                                    ->numeric()
                                    ->default(1.0),
                            ]),

                        FileUpload::make('image_path')
                            ->label('الصورة البارزة')
                            ->image()
                            ->disk('public')
                            ->directory('projects')
                            ->imageEditor()
                            ->required()
                            ->columnSpanFull(),
                        Textarea::make('short_description')
                            ->label('الوصف الخارجي')
                            ->required()
                            ->rows(5)
                            ->formatStateUsing(fn($state) => self::localize($state))
                            ->columnSpanFull(),
                        LexicalEditor::make('description')
                            ->label('الوصف الداخلي')
                            ->columnSpanFull()
                            ->formatStateUsing(fn($state) => self::localize($state))
                            ->enabledToolbars([
                                ToolbarItem::H1,
                                ToolbarItem::H2,
                                ToolbarItem::H3,
                                ToolbarItem::H4,
                                ToolbarItem::H5,
                                ToolbarItem::H6,
                                ToolbarItem::TEXT_COLOR,
                                ToolbarItem::BACKGROUND_COLOR,
                                ToolbarItem::LEFT,
                                ToolbarItem::CENTER,
                                ToolbarItem::RIGHT,
                                ToolbarItem::JUSTIFY,
                                ToolbarItem::BULLET,
                                ToolbarItem::NUMBERED,
                            ])->required(),


                    ])
                    ->columnSpanFull()
                    ->collapsible(),


                Section::make('إعدادت إضافية للمشروع')
                    ->icon(Heroicon::OutlinedCog)
                    ->schema([
                        Toggle::make('is_seasonal')
                            ->label("تعيين مشروع موسمي")
                            ->live()
                            ->afterStateUpdated(function (Set $set) {
                                $set('seasonal_start', null);
                                $set('seasonal_end', null);
                            })
                            ->required(),
                        Grid::make(2)->schema([
                            DatePicker::make('seasonal_start')
                                ->label('تاريخ البداية')
                                ->visible(fn(Get $get) => $get('is_seasonal')),
                            DatePicker::make('seasonal_end')
                                ->label('تاريخ النهاية')
                                ->visible(fn(Get $get) => $get('is_seasonal')),
                        ]),
                        Toggle::make('hide_on_complete')
                            ->label('إخفاء المشروع عند الإكتمال'),
                        Toggle::make('show_counter')
                            ->label('عرض نسبة التحصيل'),
                    ])
                    ->columnSpanFull()
                    ->collapsible()
                    ->collapsed(),

            ]);
    }

    protected static function localize($state)
    {
        return is_array($state)
            ? ($state[app()->getLocale()] ?? '')
            : $state;
    }

}
