<div>

    <section class="footer-banner relative section-margin-t">

        <img class="object-fit full-el"
             src="{{asset('home-assets/images/footer-banner.jpg')}}">

        <div class="bg full-el"></div>

        <div class="container relative white">

            <div class="box d-flex align-center space-between py-25 gap-30">

                <p class="title-28 font-16-p">
                    {{__('جمعية مناصرة فلسطين - البحرين ... بدعمكم وتبرعكم يستمر عطاؤنا')}}
                </p>

                <div class="d-flex">

                    <a href="{{route('projects')}}" class="btn no-wrap">
                        {{__('تبرع الآن')}}
                    </a>

                </div>

            </div>

        </div>

    </section>

    <footer class="footer relative z-1 bg-dark-green pt-40 pt-20-p pb-20-p pb-50">

        <div class="container">

            <!-- #box -->
            <div class="box d-flex space-between flex-column-p gap-25-p pb-30 pb-25-p">

                <!-- #right -->
                <div class="right">

                    <!-- #col1 -->
                    <div class="col1 pb-100 pb-25-p">

                        <div class="d-flex logo-foot-wrap">

                            <a href="#" class="footer-logo d-flex">

                                <img src="{{asset('home-assets/images/logo-white.svg')}}"
                                     width="243"
                                     class=""/>

                            </a>

                        </div>

                        <p class="mo font-16 f-500 white pt-25">
                            {{__('جمعية مرخصة، تحت قيد رقم ٢٥ / ج / أ ج . ث. ع./ 2002')}}
                        </p>

                    </div>
                    <!-- #!col1 -->

                    <!-- #col2 -->
                    <div class="col2">

                        <ul class="foot-list list-none d-flex wrap flex-column-p gap-40">

                            <li class="">
                                <a href="{{route('home')}}" class="white font-16 bold to-color">
                                    {{__('الرئيسة')}}
                                </a>
                            </li>

                            <li class="">
                                <a href="{{route('about-us')}}" class="white font-16 bold to-color">
                                    {{__('من نحن')}}
                                </a>
                            </li>

                            <li class="">
                                <a href="{{route('projects')}}" class="white font-16 bold to-color">
                                    {{__('مشاريعنا')}}
                                </a>
                            </li>

                            <li class="">
                                <a href="{{route('news')}}" class="white font-16 bold to-color">
                                    {{__('أخبارنا')}}
                                </a>
                            </li>

                            <li class="">
                                <a href="{{route('library')}}" class="white font-16 bold to-color">
                                    {{__('مكتبتنا')}}
                                </a>
                            </li>

                            <li class="">
                                <a href="{{route('contact-us')}}" class="white font-16 bold to-color">
                                    {{__('تواصل معنا')}}
                                </a>
                            </li>

                        </ul>

                    </div>
                    <!-- #!col2 -->

                </div>
                <!-- ##right -->

            </div>
            <!-- ##box -->

            <!-- #box2 -->
            <div class="box2 d-flex align-center space-between flex-column-p gap-10-p pt-30 pt-25-p white">

                <p class="zxc1 font-16 bold center text-start-p font-16-p f-500-p">

                    {{__('2026 جمعية مناصرة فلسطين . جميع الحقوق محفوظة لجمعية مناصرة فلسطين.')}}

                </p>

                <ul class="list-none social-foot d-flex gap-10">

                    <li>
                        <a href="https://www.instagram.com/pss_bah?igsi=eGRoajZ5YXkzNzg4" class="d-flex">
                            <img src="{{asset('home-assets/images/instagram.svg')}}" width="28" height="28"/>
                        </a>
                    </li>

                </ul>

            </div>
            <!-- ##box2 -->

        </div>

    </footer>

</div>
