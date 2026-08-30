<?php

namespace App\Listeners;

use App\Enums\ProjectStatus;
use App\Events\UserPaymentDone;
use App\Services\RecalculateProjectTotal;
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


    public function handle(UserPaymentDone $event): void
    {
        $receipt = $event->receipt;

        foreach ($receipt->invoice->items as $invoiceItem) {
            if ($project = $invoiceItem->project) {
                DB::transaction(function () use ($project) {
                    $project = \App\Models\Project::where('id', $project->id)
                        ->lockForUpdate()
                        ->first();

                    (new RecalculateProjectTotal())->recalculate($project);
                });
            }
        }
    }
}
