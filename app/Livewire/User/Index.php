<?php

namespace App\Livewire\User;

use App\Enums\PaymentMethods;
use App\Models\Receipt;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $filterDate = '';
    public $filterPaymentMethod = '';
    public $selectedReceipt = null;

    public function updatedFilterDate()
    {
        $this->resetPage();
    }

    public function updatedFilterPaymentMethod()
    {
        $this->resetPage();
    }

    #[Computed]
    public function receiptList()
    {
        return Auth::guard('app')->user()
            ->receipts()
            ->when($this->filterDate, function ($query) {
                $query->whereDate('date', $this->filterDate);
            })
            ->when($this->filterPaymentMethod, function ($query) {
                $query->where('payment_method', $this->filterPaymentMethod);
            })
            ->latest()
            ->paginate(10);
    }

    #[Computed]
    public function paymentMethods()
    {
        return PaymentMethods::cases();
    }

    public function viewReceipt($receiptId)
    {
        $this->selectedReceipt = $this->receiptList()
            ->getCollection()
            ->firstWhere('id', $receiptId)
            ?->load('invoice.items.project');
    }

    public function closeReceipt()
    {
        $this->selectedReceipt = null;
    }

    public function render()
    {
        return view('livewire.user.index', [
            'receipts' => $this->receiptList()
        ])->layout('layouts.app');
    }
}
