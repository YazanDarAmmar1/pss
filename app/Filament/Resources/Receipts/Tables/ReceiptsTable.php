<?php

namespace App\Filament\Resources\Receipts\Tables;

use App\Enums\PaymentMethods;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

class ReceiptsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('no')
                    ->label('رقم الإيصال')
                    ->searchable(),
                TextColumn::make('paymentTransaction.no')
                    ->label('رقم الحركة')
                    ->searchable(),
                TextColumn::make('user.name')
                    ->label('المتبرع')
                    ->numeric()
                    ->searchable()
                    ->sortable(),
                TextColumn::make('payment_method')
                    ->label('طريقة الدفع')
                    ->badge(),
                TextColumn::make('amount')
                    ->label('المبلغ')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->label('التاريخ')
                    ->date('Y-m-d H:i:s')
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('payment_method')
                    ->label('طريقة الدفع')
                    ->multiple()
                    ->options(PaymentMethods::class),
                Filter::make('date')
                    ->schema([
                        DatePicker::make('created_from')->label('من تاريخ'),
                        DatePicker::make('created_until')->label('إلى تاريخ'),
                    ])
                    ->columns(2)
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['created_from'],
                                fn(Builder $query, $date): Builder => $query->whereDate('date', '>=', $date),
                            )
                            ->when(
                                $data['created_until'],
                                fn(Builder $query, $date): Builder => $query->whereDate('date', '<=', $date),
                            );
                    }),
                Filter::make('amount')
                    ->schema([
                        TextInput::make('amount_from')->label('من مبلغ')->numeric(),
                        TextInput::make('amount_to')->label('إلى مبلغ')->numeric(),
                    ])
                    ->columns(2)
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['amount_from'],
                                fn(Builder $query, $amount): Builder => $query->where('amount', '>=', $amount),
                            )
                            ->when(
                                $data['amount_to'],
                                fn(Builder $query, $amount): Builder => $query->where('amount', '<=', $amount),
                            );
                    })
            ], layout: FiltersLayout::AboveContentCollapsible)
            ->filtersFormColumns(1)
            ->recordActions([
                ViewAction::make(),
                //EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    // DeleteBulkAction::make(),
                ]),
            ]);
    }
}
