<div class="modal-body-wrapper">
    <div class="modal-body relative z-1 bg-white radius-24 radius-16-p pt-40 pb-40 px-40">
        <div class="hda d-flex space-between align-center pb-50 pb-30-p">
            <div class="ha d-flex align-center gap-25 gap-10-p">
                <div class="gz d-flex align-center gap-15 gap-7-p">
                    <img src="{{asset('home-assets/images/cart-red.svg')}}" width="40" height="40">
                    <p class="tt black f-600 font-30">سلة التبرع</p>
                </div>
                <span class="cart-badge rounded bold flex-all">0</span>
            </div>
            <button class="cls-modal flex-all btn-0" close-modal="cart-modal">
                <img src="{{asset('home-assets/images/close.svg')}}" width="32" height="32">
            </button>
        </div>

        <div class="flex-all xxx mb-15">
            <img src="{{asset('home-assets/images/empty-cart.png')}}" width="212" />
        </div>
        <p class="cc center f-500 font-24 pb-30">سلة التبرع فارغة، لم يتم إضافة أي مشروع بعد</p>
        <div class="actions flex-all pb-25-p">
            <button class="btn btn-primary img-inside w-100">
                تصفح المشاريع للتبرع
                <img class="flip-en" src="{{asset('home-assets/images/arrow-left.svg')}}" />
            </button>
        </div>

    </div>
</div>
