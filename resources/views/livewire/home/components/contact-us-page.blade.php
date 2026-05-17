<section class="contact-form-section theme-2 section-padding">

    <!-- #container -->
    <div class="container">

        <!-- #box -->
        <div class="box d-flex flex-column-p gap-40 justify-center">

            <!-- #right -->
            <div class="right w-40 w-100-p">

                <p class="d1z span-inside title-40 pb-25 font-32-p">
                    {{__('نـــــحـــن هنــــا للإجــــــابــــة على اســـتفســـاراتـــــكــم ')}}
                </p>

                <p class="desc font-22 pb-40">
                    {{__('لا تتردد في التواصل معنا لأي استفسار أو للحصول على مزيد من المعلومات حول مبادراتنا وكيف يمكنك المساهمة.')}}
                </p>

                <div class="bzw d-flex flex-column gap-35">

                    <a class="itmmm border bg-soft radius-24 p-24 d-flex align-center gap-30 body-color"
                       href="tel:">
                        <img src="{{asset('home-assets/images/phone.svg')}}" class="shrink-0 icn" width="60"
                             height="60"/>

                        <div class="innzc">
                            <p class="czb gray-1 font-18">{{__('اتصل بنا')}}</p>
                            <p class="ccc unicode pt-5">{{$settings['phone']}}</p>
                        </div>
                    </a>

                    <a class="itmmm border bg-soft radius-24 p-24 d-flex align-center gap-30 body-color"
                       href="mailto:">
                        <img src="{{asset('home-assets/images/mail.svg')}}" class="shrink-0 icn" width="60"
                             height="60"/>

                        <div class="innzc">
                            <p class="czb gray-1 font-18">{{__('البريد الإلكتروني')}}</p>
                            <p class="ccc unicode pt-5">{{$settings['email']}}</p>
                        </div>
                    </a>

                    <a class="itmmm border bg-soft radius-24 p-24 d-flex align-center gap-30 body-color"
                       href="mailto:">
                        <img src="{{asset('home-assets/images/pin.svg')}}" class="shrink-0 icn" width="60"
                             height="60"/>

                        <div class="innzc">
                            <p class="czb gray-1 font-18">{{__('العنوان')}}</p>
                            <p class="ccc unicode pt-5">{{$settings['location']}}</p>
                        </div>
                    </a>

                </div>
            </div>
            <!-- ##right -->

            <!-- #left -->
            <div class="left w-53 w-100-p">

                <div class="left-box h-100 bg-soft radius-24 border pt-40 pb-40 px-30 px-p">

                    <p class="lf-t title-32 f-400 pb-30 center-p">
                        {{__('أرسل لنا رسالة')}}
                    </p>

                    <div class="form-inside">

                        <form>

                            <div class="form-box d-flex flex-column gap-30">

                                <!-- #form group -->
                                <div class="form-group">
                                    <p class="form-lbl">
                                        {{__('الاسم الكامل')}}
                                    </p>

                                    <input class="form-control" placeholder="{{__('أدخل اسمك')}}"/>
                                </div>
                                <!-- ##form group -->

                                <!-- #form group -->
                                <div class="form-group">
                                    <p class="form-lbl">
                                        {{__('البريد الإلكتروني')}}
                                    </p>

                                    <input class="form-control" placeholder="abc@gmail.com"/>
                                </div>
                                <!-- ##form group -->

                                <!-- #form group -->
                                <div class="form-group">
                                    <p class="form-lbl">
                                        {{__('الرسالة')}}
                                    </p>

                                    <textarea class="form-control"
                                              placeholder="{{__('اكتب رسالتك هنا')}}"></textarea>
                                </div>
                                <!-- ##form group -->

                                <!-- #form group -->
                                <div class="form-group flex-all">
                                    <button type="submit" class="btn btn-submit w-100">
                                        {{__('إرسال الرسالة')}}
                                    </button>
                                </div>
                                <!-- ##form group -->

                            </div>

                        </form>

                    </div>
                </div>
            </div>
            <!-- ##left -->

        </div>
        <!-- ##box -->

    </div>
    <!-- ##container -->

</section>
