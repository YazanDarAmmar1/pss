<section class="about-us-normal section-padding">
    <div class="container pt-20-p">
        <!-- #box -->
        <div class="box d-flex flex-column-p gap-50 gap-30-p">
            <!-- #right -->
            <div class="right w-47 w-100-p">
                <div class="title-with-line">
                    <span>من نحن</span>
                </div>
                <div class="dd f-500 font-24-p">رسالتنا دعم الإنسانية وبناء الأمل..</div>
                <div class="dd1 font-20">تأسست جمعية مناصرة فلسطين بهدف تقديم الدعم الشامل للشعب الفلسطيني في مختلف المجالات. نعمل على توفير المساعدات الإنسانية، دعم التعليم، تحسين الرعاية الصحية، وتمكين المجتمعات المحلية.
                    منذ تأسيسنا، استطعنا الوصول إلى آلاف العائلات وتقديم الدعم الذي يحتاجونه لبناء مستقبل أفضل. نؤمن بأن التضامن والعمل الجماعي هما المفتاح لتحقيق التغيير الحقيقي.</div>
                @if(!Route::is('about-us'))
                    <div class="btns d-flex pt-30 pt-15-p">
                        <a href="{{route('about-us')}}" wire:navigate.hover class="btn">تعرف على المزيد</a>
                    </div>
                @endif
            </div>
            <!-- ##right -->

            <!-- #left -->
            <div class="left grid-2 w-50 w-100-p align-self">
                <!-- #itm -->
                <div class="itm center pt-25 pb-15 px-15 radius-24 align-self">
                    <p class="t2a text-grad font-36 pb-10">{{$this->settings['local_palestinian']}}</p>
                    <p class="xz">الفلسطينيون داخل فلسطين</p>
                </div>
                <!-- ##itm -->
                <!-- #itm -->
                <div class="itm center pt-25 pb-15 px-15 radius-24 align-self">
                    <p class="t2a text-grad font-36 pb-10">{{$this->settings['palestinians_in_jordan']}}</p>
                    <p class="xz">الفلسطينيون في الاردن</p>
                </div>
                <!-- ##itm -->
                <!-- #itm -->
                <div class="itm center pt-25 pb-15 px-15 radius-24 align-self">
                    <p class="t2a text-grad font-36 pb-10">{{$this->settings['palestinians_arab_world']}}</p>
                    <p class="xz">الفلسطينيون في الدول العربية</p>
                </div>
                <!-- ##itm -->
                <!-- #itm -->
                <div class="itm center pt-25 pb-15 px-15 radius-24 align-self">
                    <p class="t2a text-grad font-36 pb-10">{{$this->settings['palestinians_abroad']}}</p>
                    <p class="xz">الفلسطينيون في الدول الاجنبية</p>
                </div>
                <!-- ##itm -->
            </div>
            <!-- ##left -->
        </div>
        <!-- ##box -->
    </div>
</section>
