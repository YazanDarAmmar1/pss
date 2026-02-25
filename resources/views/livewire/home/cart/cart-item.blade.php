<tr>
    <td>
        <div class="td-img-tt d-flex align-center gap-15">
            <figure class="d-flex fff do-only">
                <img src="{{$item['image']}}" width="70" height="70" class="mmm rounded object-fit">
            </figure>
            <p class="z1sda bold font-18 text-grad">{{$item['name']}}</p>
        </div>
    </td>
    <td>
        <div
            x-data="{
            editing: false,
            tempAmount: {{ $item['amount'] }}
        }"
            class="table-edit-amount"
            table-edit-amount-edit-root
            amount-box-root-table
            :class="{ 'active': editing }"
        >
            <div
                table-edit-amount-before-edit
                class="table-edit-amount-before-edit d-flex gap-10 gap-5-p justify-center"
            >
                <div class="table-edit-amount-before-edit1 relative d-flex align-center space-between radius-30">
                    <div class="amount-val w-100 flex-all black f-600">
                        <input
                            x-ref="amountInput"
                            x-model="tempAmount"
                            type="number"
                            class="amount-input no-arr full-el"
                            @keydown.enter="
                            $wire.set('amount', tempAmount);
                            $wire.saveAmount();
                        "
                            @keydown.escape="
                            tempAmount = {{ $item['amount'] }};
                        "
                        >
                        <span class="mnis bold font-20">BHD</span>
                        <span class="mnis bold font-20" val-lbl>{{ $item['amount'] }}</span>
                    </div>
                </div>
                <div
                    class="editable-switcher relative pointer"
                    switcher
                    @click="
                    if (!editing) {
                        editing = true;
                        tempAmount = {{ $item['amount'] }};
                        $nextTick(() => $refs.amountInput.select());
                    } else {
                        $wire.set('amount', tempAmount);
                        $wire.saveAmount();
                        editing = false;
                    }
                "
                >
                    <img class="imxz4m trans i1" src="{{ asset('home-assets/images/edit.svg') }}" width="20" height="20">
                    <img class="imxz4m trans i2" src="{{ asset('home-assets/images/check-red-only.svg') }}" width="20">
                </div>
            </div>
        </div>
    </td>
    <td>
        <div class="td-actions flex-all">
            <button wire:click="deleteItem({{$item['id']}})" class="btn-0 btn-table-red do-only">
                إزالة
            </button>
            <button wire:click="deleteItem({{$item['id']}})" class="btn-0 mo-only trash-btn flex-all rounded">
                <img src="{{asset('home-assets/images/trash.svg')}}" width="17" height="17" class="zzzzq1">
            </button>
        </div>
    </td>
</tr>
