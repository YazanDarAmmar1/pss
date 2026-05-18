<div>

    <!-- #breadcrumb -->
    <nav class="breadcrumb-box">

        <div class="container">

            <div class="bxp d-flex space-between flex-column-p gap-20 gap-65-p">

                <div class="right-side">

                    <ul class="list-none breadcrumb-in d-flex wrap gap-15">

                        <li>
                            <a class="body-color to-color" href="{{route('home')}}">
                                {{__('الرئيسية')}}
                            </a>
                        </li>

                        <img class="flip-en"
                             src="{{asset('home-assets/images/arrow-left.svg')}}"
                             width="24"/>

                        <li>
                            <p>{{__('عملية التبرع تحت الإنتظار')}}</p>
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

                        <p class="vz2 text-grad font-36 center pb-10">
                            {{__('المعاملة تحت الإنتظار')}}
                        </p>

                        <p class="vz3 font-20 gray-4 center pb-30">
                            {{__('نأسف، يرجى الإنتظار والتحقق من عملية الدفع في وقت لاحق أو التواصل مع فريق الدعم للحصول على المساعدة اللازمة. نحن هنا لمساعدتك.')}}
                        </p>

                    </div>
                    <!-- ##box -->

                </div>
                <!-- ##right -->

                <!-- #left -->
                <div class="left-side w-35 w-100-p">

                    <!-- #left box -->
                    <div class="left-box bg-secondary p-32 border-red radius-24">

                        <div class="left-box-hd pb-15 center">

                            <p class="black bold font-20 t12">
                                {{__('ملخص التبرع')}}
                            </p>

                        </div>

                        <p class="znn black f-600 font-16 pb-10">

                            {{count($transaction->invoice?->items ?? [])}}

                            {{__('تبرعات')}}

                        </p>

                        <div class="zxc23 pb-15 black f-600 font-16 d-flex align-center space-between gap-10 wrap">

                            <p class="zzzzz">
                                {{__('إجمالي التبرعات')}}
                            </p>

                            <p class="cc213 bold font-20">
                                {{$transaction->invoice?->amount}} BHD
                            </p>

                        </div>

                        <!-- #itms -->
                        <div class="cart-itms-payment">

                            <!-- #itm -->
                            @foreach($transaction->invoice?->items ?? [] as $item)

                                <div class="itm py-15 d-flex align-center gap-15">

                                    <figure class="flex-all shrink-0">

                                        <img src="{{$item->project->image_full_path}}"
                                             width="40"
                                             height="40"
                                             class="zcq2"/>

                                    </figure>

                                    <div class="cncnc">

                                        <p class="zccccc text-grad bold font-16 pb-5">
                                            {{$item->project->name}}
                                        </p>

                                        <p class="zccccc2 text-grad bold">
                                            {{$item->amount}} BHD
                                        </p>

                                    </div>

                                </div>
                                <!-- ##itm -->

                            @endforeach

                        </div>
                        <!-- ##itms -->

                        <div class="ttls pt-15 d-flex space-between gap-10 wrap">

                            <span class="zq2m f-500 font-18">
                                {{__('المجموع')}}
                            </span>

                            <span class="zq2m1 bold font-20">
                                {{$transaction->invoice?->amount}} BHD
                            </span>

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
