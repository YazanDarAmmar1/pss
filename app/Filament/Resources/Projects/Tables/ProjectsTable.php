<?php

namespace App\Filament\Resources\Projects\Tables;

use App\Enums\ProjectStatus;
use App\Filament\Tables\Columns\ProjectProgressColumn;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class ProjectsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image_path')
                    ->label('')
                    ->imageHeight(40)
                    ->circular(),
                TextColumn::make('no')
                    ->label('')
                    ->sortable(),
                TextColumn::make('category.name')
                    ->label('التصنيف')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('status')
                    ->label('الحالة')
                    ->badge()
                    ->color(fn(ProjectStatus $state) => $state->getColor()),
                TextColumn::make('paid_amount')
                    ->label('المبلغ المحصل')
                    ->sortable(),
                ProjectProgressColumn::make('rate')
                    ->label('النسبة'),

                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([

                Filter::make('name')
                    ->schema([
                        TextInput::make('name')->label('اسم المشروع'),
                    ])
                    ->query(fn(Builder $query, array $data) => $query->when(
                        filled($data['name'] ?? null),
                        fn($q) => $q->where('name->ar', 'like', "%{$data['name']}%")
                            ->orWhere('name->en', 'like', "%{$data['name']}%")
                    )
                    ),
                Filter::make('no')
                    ->schema([
                        TextInput::make('no')->label('رقم المشروع'),
                    ])
                    ->query(fn(Builder $query, array $data) => $query->when(
                        filled($data['no'] ?? null),
                        fn($q) => $q->where('no', $data['no'])
                    )),
                SelectFilter::make('status')
                    ->label('الحالة')
                    ->multiple()
                    ->options(ProjectStatus::class),
                SelectFilter::make('category_id')
                    ->label('التصنيف')
                    ->relationship('category', 'name')
                    ->searchable()
                    ->preload(),
            ], layout: FiltersLayout::Modal)
            ->recordActions([
                EditAction::make(),
                ViewAction::make(),
            ]);

    }
}
