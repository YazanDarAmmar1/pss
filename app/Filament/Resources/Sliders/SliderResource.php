<?php

namespace App\Filament\Resources\Sliders;

use App\Filament\Resources\Sliders\Pages\CreateSlider;
use App\Filament\Resources\Sliders\Pages\EditSlider;
use App\Filament\Resources\Sliders\Pages\ListSliders;
use App\Filament\Resources\Sliders\Pages\ViewSlider;
use App\Filament\Resources\Sliders\Schemas\SliderForm;
use App\Filament\Resources\Sliders\Schemas\SliderInfolist;
use App\Filament\Resources\Sliders\Tables\SlidersTable;
use App\Models\Slider;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use LaraZeus\SpatieTranslatable\Resources\Concerns\Translatable;

class SliderResource extends Resource
{
    use Translatable;
    protected static ?string $modelLabel = 'سلايدر';
    protected static ?string $pluralModelLabel = 'السلايدر';
    protected static ?string $navigationLabel = 'السلايدر';
    protected static ?string $model = Slider::class;
    protected static string|null|\UnitEnum $navigationGroup = 'الإعدادات العامة';
    protected static ?int $navigationSort = 4;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedPhoto;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return SliderForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return SliderInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SlidersTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListSliders::route('/'),
            'create' => CreateSlider::route('/create'),
            'view' => ViewSlider::route('/{record}'),
            'edit' => EditSlider::route('/{record}/edit'),
        ];
    }
}
