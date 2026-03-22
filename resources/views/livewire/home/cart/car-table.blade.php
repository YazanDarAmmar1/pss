<div>
    <div class="hda d-flex space-between align-center pb-50 pb-30-p">
        <div class="ha d-flex align-center gap-25 gap-10-p">
            <div class="gz d-flex align-center gap-15 gap-7-p">
                <img src="{{asset('home-assets/images/cart-red.svg')}}" width="40" height="40">
                <p class="tt black f-600 font-30">سلة التبرع</p>
            </div>
            <span class="cart-badge rounded bold flex-all">{{count($cartItems ?? [])}}</span>
        </div>
        <button class="cls-modal flex-all btn-0" close-modal="cart-modal">
            <img src="{{asset('home-assets/images/close.svg')}}" width="32" height="32">
        </button>
    </div>

    <div class="table-responsive pb-30 table-modal-box">
        <table class="table-soft">
            <thead>
            <tr>
                <th class="center">المشروع</th>
                <th class="center">القيمة</th>
                <th class="center">إجراء</th>
            </tr>
            </thead>
            <tbody>
            @foreach($cartItems ?? [] as $item)
                <livewire:home.cart.cart-item :item="$item" :key="$item['id']"/>
            @endforeach
            </tbody>
        </table>
    </div>

    <div class="actions d-flex space-between flex-column-p gap-15 pt-25 pt-20-p pb-25-p">
        <div class="zcq12 d-flex align-center gap-3-p">
            <span class="zxc123asd f-500 font-20 font-18-p bold-p">المجموع الكلي: </span>
            <div class="d-flex gap-5">
                <span class="zxc123asd bold font-32 font-20-p">{{$cartTotal}}</span>
                <span class="zxc123asd bold font-32 font-20-p">BHD</span>
            </div>
        </div>
        <a href="{{route('checkout')}}" class="btn font-16 px-30 py-20-p justify-center w-100-p">إتمام التبرع </a>
    </div>
</div>
