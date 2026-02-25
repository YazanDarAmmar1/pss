<div>
    <!-- #landing -->
    <livewire:home.components.slider-page/>
    <!-- ##landing -->

    <!-- #about us -->
    <livewire:home.components.about-page/>
    <!-- ##about us -->

    <!-- #projects -->
    <livewire:home.components.category-page/>
    <!-- ##projects -->

    <!-- #news -->
    <livewire:home.components.news-page/>
    <!-- ##news -->

    <!-- #aqsa lab -->
    <livewire:home.components.library-page/>
    <!-- ##aqsa lab -->


    <!-- #contact form section -->
    <section class="contact-form-section section-padding pb-0-p">
        <!-- #container -->
        <div class="container">
            <!-- #box -->
            <div class="box d-flex flex-column-p gap-40 justify-center">
                <!-- #right -->
                <div class="right w-40 w-100-p">
                    <p class="d1z span-inside title-40 pb-25 font-32-p">نـــــحـــن هنــــا للإجــــــابــــة على
                        <span>اســـتفســـاراتـــــكــم </span></p>
                    <p class="desc font-22 pb-40">لا تتردد في التواصل معنا لأي استفسار أو للحصول على مزيد من المعلومات حول مبادراتنا وكيف يمكنك المساهمة.</p>
                    <div class="bzw d-flex flex-column gap-35">
                        <a class="itmmm border bg-soft radius-24 p-24 d-flex align-center gap-30 body-color" href="tel:">
                            <img src="{{asset('home-assets/images/phone.svg')}}" class="shrink-0 icn" width="60" height="60" />
                            <div class="innzc">
                                <p class="czb gray-1 font-18">اتصل بنا</p>
                                <p class="ccc unicode pt-5">+97312345678</p>
                            </div>
                        </a>
                        <a class="itmmm border bg-soft radius-24 p-24 d-flex align-center gap-30 body-color" href="mailto:">
                            <img src="{{asset('home-assets/images/mail.svg')}}" class="shrink-0 icn" width="60" height="60" />
                            <div class="innzc">
                                <p class="czb gray-1 font-18">البريد الإلكتروني</p>
                                <p class="ccc unicode pt-5">info@pss-bh.org</p>
                            </div>
                        </a>
                        <a class="itmmm border bg-soft radius-24 p-24 d-flex align-center gap-30 body-color" href="mailto:">
                            <img src="{{asset('home-assets/images/pin.svg')}}" class="shrink-0 icn" width="60" height="60" />
                            <div class="innzc">
                                <p class="czb gray-1 font-18">العنوان</p>
                                <p class="ccc unicode pt-5">المحرق , مملكة البحرين</p>
                            </div>
                        </a>
                    </div>
                </div>
                <!-- ##right -->
                <!-- #left -->
                <div class="left w-53 w-100-p">
                    <div class="left-box bg-soft radius-24 border pt-40 pb-40 px-30 px-p">
                        <p class="lf-t title-32 f-400 pb-30 center-p">أرسل لنا رسالة</p>
                        <div class="form-inside">
                            <form>
                                <div class="form-box d-flex flex-column gap-30">
                                    <!-- #form group -->
                                    <div class="form-group">
                                        <p class="form-lbl">
                                            الاسم الكامل
                                        </p>
                                        <input class="form-control" placeholder="أدخل اسمك" />
                                    </div>
                                    <!-- ##form group -->
                                    <!-- #form group -->
                                    <div class="form-group">
                                        <p class="form-lbl">
                                            البريد الإلكتروني
                                        </p>
                                        <input class="form-control" placeholder="abc@gmail.com" />
                                    </div>
                                    <!-- ##form group -->
                                    <!-- #form group -->
                                    <div class="form-group">
                                        <p class="form-lbl">
                                            الرسالة
                                        </p>
                                        <textarea class="form-control" placeholder="اكتب رسالتك هنا" ></textarea>
                                    </div>
                                    <!-- ##form group -->
                                    <!-- #form group -->
                                    <div class="form-group flex-all">
                                        <button type="submit" class="btn btn-submit w-100">إرسال الرسالة</button>
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
    <!-- ##contact form section -->
</div>
