<?php

namespace App\Filament\Resources\Projects\Pages;

use App\Filament\Resources\Projects\ProjectResource;
use App\Filament\Resources\Projects\Widgets\ProjectStats;
use App\Filament\Resources\Projects\Widgets\ProjectStatsWidget;
use App\Services\RecalculateProjectTotal;
use Filament\Actions\Action;
use Filament\Actions\EditAction;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ViewRecord;


class ViewProject extends ViewRecord
{

    protected static string $resource = ProjectResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
            Action::make('approve')
                ->label('ضبط المحصل')
                ->color('success')
                ->icon('heroicon-o-check-circle')
                ->requiresConfirmation()
                ->modalHeading(' ضبط محصل المشروع؟')
                ->modalDescription('هل أنت متأكد من ضبط محصل هذا المشروع؟')
                ->action(function () {
                    (new RecalculateProjectTotal())->recalculate($this->record);
                    Notification::make()
                        ->title('تم ضبط المحصل')
                        ->success()
                        ->send();
                }),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            ProjectStatsWidget::class,
        ];
    }

}
