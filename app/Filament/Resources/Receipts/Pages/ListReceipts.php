<?php

namespace App\Filament\Resources\Receipts\Pages;

use App\Exports\ProjectPaymentsExport;
use App\Filament\Resources\Receipts\ReceiptResource;
use App\Models\Project;
use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Resources\Pages\ListRecords;
use Maatwebsite\Excel\Facades\Excel;

class ListReceipts extends ListRecords
{
    protected static string $resource = ReceiptResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('export_project_payments')
                ->label('تصدير حركات المشروع')
                ->icon('heroicon-o-arrow-down-tray')
                ->color('info')
                ->modalHeading('تصدير حركات الدفع')
                ->modalSubmitActionLabel('تصدير')
                ->schema([
                    Select::make('project_id')
                        ->label('المشروع')
                        ->options(Project::query()->pluck('name', 'id'))
                        ->searchable()
                        ->required(),
                    DatePicker::make('date_from')->label('من تاريخ'),
                    DatePicker::make('date_to')->label('إلى تاريخ'),
                ])
                ->action(fn(array $data) => Excel::download(
                    new ProjectPaymentsExport(
                        projectId: $data['project_id'],
                        dateFrom: $data['date_from'] ?? null,
                        dateTo: $data['date_to'] ?? null,
                    ),
                    'project-payments-' . now()->format('Y-m-d') . '.xlsx',
                )),

            CreateAction::make(),
        ];
    }
}
