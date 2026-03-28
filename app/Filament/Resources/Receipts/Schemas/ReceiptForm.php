<?php

namespace App\Filament\Resources\Receipts\Schemas;

use App\Enums\PaymentMethods;
use App\Models\Project;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;

class ReceiptForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(2)
            ->components([
                Section::make('معلومات التبرع')
                    ->description('بيانات المتبرع وطريقة الدفع')
                    ->icon('heroicon-o-user-circle')
                    ->columns(2)
                    ->columnSpan(1)
                    ->schema([
                        DatePicker::make('date')
                            ->label('التاريخ')
                            ->required()
                            ->default(now()),

                        Select::make('app_user_id')
                            ->label('المتبرع')
                            ->relationship('user', 'name')
                            ->searchable()
                            ->preload()
                            ->nullable()
                            ->placeholder('بدون حساب'),

                        Select::make('payment_method')
                            ->label('طريقة الدفع')
                            ->options(PaymentMethods::class)
                            ->required(),
                    ]),

                Section::make('المشاريع والمبالغ')
                    ->description('حدد المشاريع ومبلغ التبرع لكل مشروع')
                    ->icon('heroicon-o-folder-open')
                    ->columnSpan(1)
                    ->schema([
                        Repeater::make('items')
                            ->label('')
                            ->schema([
                                Select::make('project_id')
                                    ->label('المشروع')
                                    ->options(Project::query()->pluck('name', 'id'))
                                    ->searchable()
                                    ->required()
                                    ->columnSpan(2),

                                TextInput::make('amount')
                                    ->label('المبلغ (د.ب)')
                                    ->numeric()
                                    ->required()
                                    ->minValue(0.001)
                                    ->prefix('BD')
                                    ->columnSpan(1),
                            ])
                            ->columns(3)
                            ->addActionLabel('+ أضف مشروع')
                            ->minItems(1)
                            ->live()
                    ]),

                Section::make('الملخص')
                    ->description('إجمالي التبرع وأي ملاحظات إضافية')
                    ->icon('heroicon-o-calculator')
                    ->columnSpanFull()
                    ->schema([
                        Placeholder::make('total')
                            ->label('إجمالي المبلغ')
                            ->content(fn(Get $get) =>
                                number_format(collect($get('items'))->sum('amount'), 2) . ' دينار بحريني'
                            ),

                        Textarea::make('note')
                            ->label('ملاحظة')
                            ->columnSpanFull(),
                    ]),
            ]);
    }}
