<?php

namespace App\Filament\Widgets;

use App\Models\Receipt;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class FinanceProjectsOverview extends StatsOverviewWidget
{

    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        $today = Receipt::whereDate('date', now())
            ->sum('amount');

        $thisWeek = Receipt::whereBetween('date', [now()->startOfWeek(), now()->endOfWeek()])
            ->sum('amount');

        $thisMonth = Receipt::whereMonth('date', now()->month)
            ->whereYear('date', now()->year)
            ->sum('amount');

        return [
            Stat::make('المحصّل اليوم', number_format($today) . ' د.ب')
                ->icon('heroicon-o-banknotes')
                ->color('success'),

            Stat::make('المحصّل هذا الأسبوع', number_format($thisWeek) . ' د.ب')
                ->icon('heroicon-o-calendar')
                ->color('info'),

            Stat::make('المحصّل هذا الشهر', number_format($thisMonth) . ' د.ب')
                ->icon('heroicon-o-chart-bar')
                ->color('warning'),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            FinanceProjectsOverview::class,
            DailyCollectionsChart::class,
        ];
    }
}
