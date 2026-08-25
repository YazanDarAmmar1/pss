<?php

namespace App\Filament\Widgets;

use App\Models\Receipt;
use Filament\Widgets\ChartWidget;

class DailyCollectionsChart extends ChartWidget
{
    protected ?string $heading = 'التحصيل اليومي (آخر 30 يوم)';

    protected static ?int $sort = 2;


    protected function getData(): array
    {
        $data = collect(range(29, 0))->map(function ($i) {
            $date = now()->subDays($i);
            return [
                'label' => $date->format('m-d'),
                'total' => Receipt::whereDate('date', $date)->sum('amount'),
            ];
        });

        return [
            'datasets' => [
                [
                    'label' => 'المبلغ المحصّل',
                    'data' => $data->pluck('total'),
                    'borderColor' => '#3b82f6',
                    'backgroundColor' => 'rgba(59, 130, 246, 0.1)',
                    'fill' => true,
                ],
            ],
            'labels' => $data->pluck('label'),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
