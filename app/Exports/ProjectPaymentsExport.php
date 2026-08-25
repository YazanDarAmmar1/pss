<?php

namespace App\Exports;

use App\Models\InvoiceItem;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class ProjectPaymentsExport implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize, WithCustomStartCell, WithEvents
{
    public function __construct(
        protected ?int    $projectId,
        protected ?string $dateFrom = null,
        protected ?string $dateTo = null,
    )
    {
    }

    public function query()
    {
        return InvoiceItem::query()
            ->with(['invoice.user', 'project'])
            ->when($this->projectId, fn($q) => $q->where('project_id', $this->projectId))
            ->whereHas('receipts', function ($q) {
                $q->when($this->dateFrom, fn($q) => $q->whereDate('date', '>=', $this->dateFrom))
                    ->when($this->dateTo, fn($q) => $q->whereDate('date', '<=', $this->dateTo));
            })
            ->orderBy('created_at');
    }

    public function map($item): array
    {
        return [
            $item->invoice?->receipt?->no,
            $item->invoice?->no,
            $item->invoice?->transaction?->no,
            $item->invoice?->user?->name ?? 'بدون حساب',
            $item->invoice?->receipt?->payment_method->label(),
            $item->invoice?->created_at?->format('Y-m-d'),
            $item->project?->name,
            $item->project?->no,
            $item->amount,
        ];
    }

    public function headings(): array
    {
        return ['رقم الرصيد', 'رقم الفاتورة', 'رقم الحركة', 'العميل', 'طريقة الدفع', 'التاريخ', 'اسم المشروع', 'رقم المشروع', 'المبلغ'];
    }

    public function startCell(): string
    {
        return 'A3';
    }

    protected function periodLabel(): string
    {
        return match (true) {
            $this->dateFrom && $this->dateTo => "من {$this->dateFrom} إلى {$this->dateTo}",
            $this->dateFrom => "من {$this->dateFrom}",
            $this->dateTo => "إلى {$this->dateTo}",
            default => 'كل الفترات',
        };
    }

    public function registerEvents(): array
    {
        $columnsCount = count($this->headings());
        $lastColumn = Coordinate::stringFromColumnIndex($columnsCount);

        return [
            AfterSheet::class => function (AfterSheet $event) use ($lastColumn) {
                $sheet = $event->sheet->getDelegate();

                $sheet->setRightToLeft(true);

                $sheet->setCellValue('A1', 'تقرير تبرعات المشروع');
                $sheet->mergeCells("A1:{$lastColumn}1");
                $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(14);
                $sheet->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

                $sheet->setCellValue('A2', $this->periodLabel());
                $sheet->mergeCells("A2:{$lastColumn}2");
                $sheet->getStyle('A2')->getFont()->setItalic(true);
                $sheet->getStyle('A2')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

                $headerRow = 3;
                $sheet->getStyle("A{$headerRow}:{$lastColumn}{$headerRow}")->getFont()->setBold(true);
            },
        ];
    }
}
