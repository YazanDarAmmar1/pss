<?php

namespace App\Listeners;

use App\Enums\ProjectStatus;
use App\Events\UserPaymentDone;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;

class freshProjectTotals
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(UserPaymentDone $event): void
    {
        $receipt = $event->receipt;

        foreach ($receipt->invoice->items as $invoiceItem) {
            $project = $invoiceItem->project;

            if ($project) {
                DB::transaction(function () use ($project, $invoiceItem) {
                    $project = $project->lockForUpdate()->fresh();

                    $paidAmount = $project->paid_amount + $invoiceItem->amount;
                    $remainingAmount = max(0, $project->target_amount - $paidAmount);
                    $rate = $project->target_amount > 0
                        ? min(100, round(($paidAmount / $project->target_amount) * 100, 3))
                        : 0;

                    $updateData = [
                        'paid_amount' => $paidAmount,
                        'remaining_amount' => $remainingAmount,
                        'rate' => $rate,
                    ];

                    if ($project->hide_on_complete && $rate >= 100) {
                        $updateData['status'] = ProjectStatus::FULL;
                    }

                    $project->update($updateData);
                });
            }
        }
    }
}
