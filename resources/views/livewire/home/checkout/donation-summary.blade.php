<div class="left-box bg-secondary p-32 border-red radius-24">

    <div class="left-box-hd pb-15 d-flex space-between">
        <p class="black bold font-20">ملخص التبرع</p>
        <a href="{{route('cart')}}" class="btn btn-primary">تعديل</a>
    </div>

    <p class="black f-600 font-16 pb-15">{{count($cartItems ?? [])}} تبرعات </p>

    <div class="black f-600 font-16 d-flex align-center space-between gap-10 wrap pb-15">
        <p>إجمالي التبرعات</p>
        <p class="bold font-20">{{$cartTotal}} BHD</p>
    </div>

    <div class="cart-itms-payment">
        @foreach($cartItems as $item)
            <div class="itm py-15 d-flex align-center gap-15">

                <figure class="flex-all shrink-0">
                    <img src="{{$item['image']}}" width="40"/>
                </figure>

                <div>
                    <p class="text-grad bold font-16 pb-5">
                        {{$item['name']}}
                    </p>
                    <p class="text-grad bold">
                        {{$item['amount']}}
                        BHD
                    </p>
                </div>

            </div>
        @endforeach
    </div>

    <div class="ttls pt-15 d-flex space-between gap-10 wrap">
        <span class="bold font-18">المجموع</span>
        <span class="bold font-20">{{$cartTotal}} BHD</span>
    </div>

</div>
