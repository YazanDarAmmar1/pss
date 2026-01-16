<?php

namespace App\Filament\Resources\Projects\Pages;

use App\Filament\Resources\Projects\ProjectResource;
use App\Filament\Resources\Projects\Widgets\ProjectStats;
use App\Filament\Resources\Projects\Widgets\ProjectStatsWidget;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;


class ViewProject extends ViewRecord
{

    protected static string $resource = ProjectResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            ProjectStatsWidget::class,
        ];
    }

}
