<?php

namespace App\Filament\Resources\Receipts\Pages;

use App\Enums\PaymentStatus;
use App\Filament\Resources\Receipts\ReceiptResource;
use App\Models\Invoice;
use App\Models\Receipt;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CreateReceipt extends CreateRecord
{
    protected static string $resource = ReceiptResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $items = $data['items'] ?? [];
        unset($data['items']);

        DB::transaction(function () use ($items, &$data) {
            $totalAmount = collect($items)->sum('amount');

            $invoice = Invoice::create([
                'user_id' => $data['app_user_id'] ?? null,
                'amount' => $totalAmount,
                'status' => PaymentStatus::Paid->value,
            ]);

            foreach ($items as $item) {
                $invoice->items()->create([
                    'project_id' => $item['project_id'],
                    'amount' => $item['amount'],
                ]);
            }

            $transaction = $invoice->transactions()->create([
                'amount' => $totalAmount,
                'user_id' => $data['app_user_id'] ?? null,
                'created_at' => $data['date'],
                'status' => PaymentStatus::Paid->value,
            ]);

            $data['invoice_id'] = $invoice->id;
            $data['payment_transaction_id'] = $transaction->id;
            $data['amount'] = $totalAmount;
            // payment_method يوصل كـ string لـ Filament ينشئ الـ Receipt
            $data['payment_method'] = $data['payment_method']->value;
        });

        return $data;
    }

}
