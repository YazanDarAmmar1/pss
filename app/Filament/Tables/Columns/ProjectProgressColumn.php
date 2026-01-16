<?php

namespace App\Filament\Tables\Columns;

use Filament\Support\Components\Contracts\HasEmbeddedView;
use Filament\Tables\Columns\Column;

class ProjectProgressColumn extends Column
{
    protected string $view = 'filament.tables.columns.project-progress';
}
