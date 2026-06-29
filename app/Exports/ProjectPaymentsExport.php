<?php

namespace App\Exports;

use App\Models\InvoiceItem;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ProjectPaymentsExport implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize
{
    public function __construct(
        protected int     $projectId,
        protected ?string $dateFrom = null,
        protected ?string $dateTo = null,
    )
    {
    }

    public function query()
    {
        return InvoiceItem::query()
            ->with(['invoice.user', 'project'])
            ->where('project_id', $this->projectId)
            ->whereHas('receipts', function ($q) {
                $q->when($this->dateFrom, fn($q) => $q->whereDate('date', '>=', $this->dateFrom))
                    ->when($this->dateTo, fn($q) => $q->whereDate('date', '<=', $this->dateTo));
            })
            ->orderBy('created_at');
    }

    public function map($item): array
    {
        return [
            $item->invoice?->no,
            $item->invoice?->created_at?->format('Y-m-d'),
            $item->invoice?->user?->name ?? 'بدون حساب',
            $item->project?->name,
            $item->amount,
        ];
    }

    public function headings(): array
    {
        return ['رقم الفاتورة', 'التاريخ', 'العميل', 'المشروع', 'المبلغ'];
    }
}
