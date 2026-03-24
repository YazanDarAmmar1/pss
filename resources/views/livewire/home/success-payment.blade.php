<div>
    <!-- #breadcrumb -->
    <nav class="breadcrumb-box">
        <div class="container">
            <div class="bxp d-flex space-between flex-column-p gap-20 gap-65-p">
                <div class="right-side">
                    <ul class="list-none breadcrumb-in d-flex wrap gap-15">
                        <li>
                            <a class="body-color to-color" href="{{route('home')}}">الرئيسية</a>
                        </li>
                        <img class="flip-en" src="{{asset('home-assets/images/arrow-left.svg')}}" width="24"/>
                        <li>
                            <p>عملة تبرع ناجحة</p>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <!-- ##breadcrumb -->
    <section class="payment-section payment-section-status pt-80 pt-40-p pb-40-p pb-80">
        <div class="container">
            <!-- #wrpa -->
            <div class="wrap d-flex space-between gap-20 gap-40-p">
                <!-- #right -->
                <div class="right-side w-50 w-100-p">
                    <!-- #box -->
                    <div class="box pt-10">

                        <p class="vz2 text-grad font-36 center pb-10">شكرًا لك على تبرعك!</p>
                        <p class="vz3 font-20 gray-4 center pb-30">لقد ساهمت في صناعة أثر حقيقي في حياة من هم بأمس
                            الحاجة للدعم. تبرعك يعني الكثير لنا وللمستفيدين.</p>
                        <div class="form-inside">
                            <div class="email-cont mx-auto mb-30 w-100-p">
                                <div class="email-temp flex-all wrap gap-15">
                                    <div class="emapi-inp flex-1 w-100-p">
                                        <input wire:model.live.debounce.500ms="email" type="email" class="form-control theme-2"
                                               placeholder="البريد الالكتروني"/>
                                    </div>
                                    @if(!empty($this->email))
                                        <button x-transition
                                                wire:target="sendEmail"
                                                wire:click="sendEmail"
                                                wire:loading.class="disabled"
                                                class="btn bn2">
                                            <span wire:target="sendEmail" wire:loading.remove>إرسال الإيصال</span>
                                            <span wire:target="sendEmail" wire:loading>جاري الإرسال...</span>
                                        </button>
                                    @endif
                                </div>
                                @error('email')
                                <label class="font-14 red d-flex gap-10 pointer main-color">
                                    {{$message}}
                                </label>
                                @enderror
                                @if($successMessage)
                                    <label class="font-14 green d-flex gap-10 pointer">
                                        {{ $successMessage }}
                                    </label>
                                @endif
                                <p class="zxczz font-16 gray-4 align pt-10">يمكنك إضافة البريد الإلكتروني الذي ترغب بأن
                                    يصله إِشعار بالمبلغ المتبرع به.</p>
                            </div>
                            <div class="actions flex-all">
                                <a href="{{route('home')}}" class="btn btn-white w-100">العودة للصفحة الرئيسية</a>
                            </div>
                        </div>

                    </div>
                    <!-- ##box -->
                </div>
                <!-- ##right -->

                <!-- #left -->
                <div class="left-side w-35 w-100-p">
                    <!-- #left box -->
                    <div class="left-box bg-secondary p-32 border-red radius-24">
                        <div class="left-box-hd pb-15 center">
                            <p class="black bold font-20 t12">ملخص التبرع</p>
                        </div>
                        <p class="znn black f-600 font-16 pb-10">{{count($transaction->invoice?->items ?? [])}}
                            تبرعات</p>
                        <div class="zxc23 pb-15 black f-600 font-16 d-flex align-center space-between gap-10 wrap">
                            <p class="zzzzz">إجمالي التبرعات</p>
                            <p class="cc213 bold font-20">{{$transaction->invoice?->amount}} BHD</p>
                        </div>

                        <!-- #itms -->
                        <div class="cart-itms-payment">
                            <!-- #itm -->
                            @foreach($transaction->invoice?->items ?? [] as $item)
                                <div class="itm py-15 d-flex align-center gap-15">
                                    <figure class="flex-all shrink-0">
                                        <img src="{{$item->project->image_full_path}}" width="40" height="40"
                                             class="zcq2"/>
                                    </figure>
                                    <div class="cncnc">
                                        <p class="zccccc text-grad bold font-16 pb-5">{{$item->project->name}}</p>
                                        <p class="zccccc2 text-grad bold">{{$item->amount}} BHD</p>
                                    </div>
                                </div>
                                <!-- ##itm -->
                            @endforeach

                        </div>
                        <!-- ##itms -->
                        <div class="ttls pt-15 d-flex space-between gap-10 wrap">
                            <span class="zq2m f-500 font-18">المجموع</span>
                            <span class="zq2m1 bold font-20">{{$transaction->invoice?->amount}} BHD</span>
                        </div>
                    </div>
                    <!-- ##left box -->
                </div>
                <!-- ##left -->


            </div>
            <!-- ##wrpa -->
        </div>
    </section>

</div>
