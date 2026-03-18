<div x-data="{ showRegister: false }">
    <section class="login-section section-padding">
        <div x-show="!showRegister" x-transition class="container">
            <div class="box d-flex align-center flex-column-p gap-80">
                <!-- #right -->
                <div class="right w-43 w-100-p">
                    <p class="tt text-grad bold font-40 pb-15 font-32-p">تسجيل الدخول</p>
                    <p class="dd font-20 gray-4 pb-30 font-18-p">جمعية مناصرة فلسطين تجمع الداعمين والناشطين في مكان واحد لتنظيم العمل، نشر الوعي، وتعزيز نصرة فلسطين.</p>
                   <livewire:home.auth.login/>
                </div>
                <!-- ##right -->
                <!-- #left -->
                <div class="left do-only d-flex w-53 w-100-p">
                    <img src="{{asset('home-assets/images/login.png')}}" width="100%" class="object-fit" />
                </div>
                <!-- ##left -->
            </div>
        </div>
         {{--Register--}}
        <div x-show="showRegister" x-transition class="container">
            <div class="box d-flex align-center flex-column-p gap-80">
                <!-- #right -->
                <div class="right w-43 w-100-p">
                    <p class="tt text-grad bold font-40 pb-15 font-32-p">إنشاء حساب جديد</p>
                    <p class="dd font-20 gray-4 pb-30 font-18-p">جمعية مناصرة فلسطين تجمع الداعمين والناشطين في مكان واحد لتنظيم العمل، نشر الوعي، وتعزيز نصرة فلسطين.</p>
                    <livewire:home.auth.register/>
                </div>
                <!-- ##right -->
                <!-- #left -->
                <div class="left do-only d-flex w-53 w-100-p">
                    <img src="{{asset('home-assets/images/login.png')}}" width="100%" class="object-fit" />
                </div>
                <!-- ##left -->
            </div>
        </div>
    </section>

</div>
