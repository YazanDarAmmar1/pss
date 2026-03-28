<?php

namespace App\Filament\Resources\Receipts\Schemas;

use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ReceiptInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(2)
            ->components([
                Section::make('معلومات الإيصال')
                    ->description('البيانات الأساسية للإيصال')
                    ->icon('heroicon-o-document-text')
                    ->columnSpan(1)
                    ->schema([
                        TextEntry::make('no')
                            ->label('رقم الإيصال')
                            ->badge()
                            ->color('primary'),

                        TextEntry::make('date')
                            ->label('التاريخ')
                            ->date()
                            ->icon('heroicon-o-calendar'),

                        TextEntry::make('payment_method')
                            ->label('طريقة الدفع')
                            ->badge(),

                        TextEntry::make('amount')
                            ->label('المبلغ')
                            ->numeric()
                            ->prefix('BD ')
                            ->icon('heroicon-o-banknotes'),
                    ]),

                Section::make('المراجع')
                    ->description('الفاتورة والمعاملة المرتبطة')
                    ->icon('heroicon-o-link')
                    ->columnSpan(1)
                    ->schema([
                        TextEntry::make('invoice.no')
                            ->label('رقم الفاتورة')
                            ->icon('heroicon-o-document'),

                        TextEntry::make('paymentTransaction.no')
                            ->label('رقم المعاملة')
                            ->icon('heroicon-o-arrow-path'),

                        TextEntry::make('user.name')
                            ->label('المتبرع')
                            ->placeholder('— بدون حساب —')
                            ->icon('heroicon-o-user'),
                    ]),

                Section::make('عناصر التبرع')
                    ->description('المشاريع المرتبطة بهذا الإيصال')
                    ->icon('heroicon-o-folder-open')
                    ->columnSpanFull()
                    ->schema([
                        RepeatableEntry::make('invoice.items')
                            ->label('المشاريع')
                            ->schema([
                                TextEntry::make('project.name')
                                    ->label('المشروع'),

                                TextEntry::make('amount')
                                    ->label('المبلغ')
                                    ->numeric()
                                    ->prefix('BD '),
                            ])
                            ->columns(2),
                    ]),

                Section::make('ملاحظات')
                    ->description('أي معلومات إضافية')
                    ->icon('heroicon-o-chat-bubble-left-ellipsis')
                    ->columnSpanFull()
                    ->schema([
                        TextEntry::make('note')
                            ->label('ملاحظة')
                            ->placeholder('— لا توجد ملاحظات —')
                            ->columnSpanFull(),

                        TextEntry::make('created_at')
                            ->label('تاريخ الإنشاء')
                            ->dateTime()
                            ->icon('heroicon-o-clock'),

                        TextEntry::make('updated_at')
                            ->label('آخر تحديث')
                            ->dateTime()
                            ->icon('heroicon-o-clock'),
                    ]),
            ]);
    }
}
