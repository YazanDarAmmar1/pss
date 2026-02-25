<?php

namespace App\Filament\Resources\BookCategories;

use App\Filament\Clusters\Book\BookCluster;
use App\Filament\Resources\BookCategories\Pages\CreateBookCategory;
use App\Filament\Resources\BookCategories\Pages\EditBookCategory;
use App\Filament\Resources\BookCategories\Pages\ListBookCategories;
use App\Filament\Resources\BookCategories\Pages\ViewBookCategory;
use App\Filament\Resources\BookCategories\Schemas\BookCategoryForm;
use App\Filament\Resources\BookCategories\Schemas\BookCategoryInfolist;
use App\Filament\Resources\BookCategories\Tables\BookCategoriesTable;
use App\Models\BookCategory;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class BookCategoryResource extends Resource
{
    use \LaraZeus\SpatieTranslatable\Resources\Concerns\Translatable;
    protected static ?string $modelLabel = 'تصنيف';
    protected static ?string $pluralModelLabel = 'تصنيفات المكتبة';
    protected static ?string $navigationLabel = 'تصنيفات المكتبة';
    protected static ?string $model = BookCategory::class;

    protected static ?string $cluster = BookCluster::class;
    protected static ?int $navigationSort = 2;
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBookmark;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return BookCategoryForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return BookCategoryInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return BookCategoriesTable::configure($table);
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
            'index' => ListBookCategories::route('/'),
            'create' => CreateBookCategory::route('/create'),
//            'view' => ViewBookCategory::route('/{record}'),
            'edit' => EditBookCategory::route('/{record}/edit'),
        ];
    }
}
