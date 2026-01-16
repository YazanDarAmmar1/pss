<?php

namespace App\Filament\Resources\Projects\Widgets;

use Filament\Support\Enums\IconPosition;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class ProjectStatsWidget extends StatsOverviewWidget
{
    public ?object $record = null;

    protected function getStats(): array
    {
        $target = $this->record->target_amount ?? 0;
        $collected = $this->record->collected_amount ?? 0;
        $remaining = $this->record->remaining_amount ?? 0;
        return [
            Stat::make('المستهدف', $target)
                ->description('مجموع المبلغ المستهدف')
                ->descriptionIcon('heroicon-o-currency-dollar', IconPosition::Before),
            Stat::make('المحصل', $collected)
                ->description('مجموع المبلغ المحصل')
                ->descriptionIcon('heroicon-o-archive-box-arrow-down', IconPosition::Before),
            Stat::make('المتبقي', $remaining)
                ->description('مجموع المبلغ المتبقي')
                ->descriptionIcon('heroicon-o-gift', IconPosition::Before),

        ];
    }
}
