<?php

namespace App\Services;

use App\Enums\ProjectStatus;
use App\Models\InvoiceItem;
use App\Models\Project;

class RecalculateProjectTotal
{
    public function recalculate(Project $project): void
    {
        $paid = InvoiceItem::whereHas('invoice.receipt')
            ->where('project_id', $project->id)
            ->sum('amount');

        $rate = $project->target_amount > 0
            ? min(100, ($paid / $project->target_amount) * 100)
            : 0;

        $updateData = [
            'paid_amount' => $paid,
            'remaining_amount' => max($project->target_amount - $paid, 0),
            'rate' => $rate,
        ];

        if ($project->hide_on_complete && $rate >= 100) {
            $updateData['status'] = ProjectStatus::FULL;
        }

        $project->update($updateData);
    }
}
