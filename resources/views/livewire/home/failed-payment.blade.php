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
                            <p>عملية تبرع فاشلة</p>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <!-- ##breadcrumb -->


    <!-- #sub-success -->
    <section class="sub-success-section section-padding-b pt-30">
        <div class="container">
            <!-- #box -->
            <div class="box center mx-auto">
                <figure class="flex-all ff">
                    <img src="{{asset('home-assets/images/failed.png')}}" width="150"/>
                </figure>
                <p class="tt main-color text-grad title-32 pb-10">
                    فشلت عملية التبرع رقم
                    {{$transaction->no}}
                </p>
                <p class="dd gray-4 font-24 pb-40">
                    نعتذر، لم تتم عملية التبرع بنجاح. يرجى التحقق من بيانات الدفع والمحاولة مرة أخرى.
                    تبرعكم يعني الكثير لنا وللمستفيدين من خدماتنا الخيرية.
                </p>
                <div class="actions flex-all column-reverse-p gap-30">
                    <a href="{{route('checkout')}}" class="btn btn-primary w-100">
                        <img src="{{asset('home-assets/images/retry.svg')}}" width="24"/>
                        إعادة المحاولة
                    </a>
                    <a href="{{route('home')}}" class="btn btn-outline-trans w-100">العودة للصفحة الرئيسية</a>
                </div>
            </div>
            <!-- ##box -->
        </div>
    </section>
    <!-- ##sub-success -->
</div>
