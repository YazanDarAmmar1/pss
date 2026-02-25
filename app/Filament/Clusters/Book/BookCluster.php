<?php

namespace App\Filament\Clusters\Book;

use BackedEnum;
use Filament\Clusters\Cluster;
use Filament\Support\Icons\Heroicon;

class BookCluster extends Cluster
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedSquares2x2;
    protected static ?string $navigationLabel = 'المكتبة';
    protected static string|null|\UnitEnum $navigationGroup = 'الإعدادات العامة';
    protected static ?int $navigationSort = 2;
    protected static bool $shouldRegisterNavigation = true;

}
