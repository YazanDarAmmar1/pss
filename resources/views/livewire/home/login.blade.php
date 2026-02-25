<div x-data="{ showRegister: false }">
    <section class="login-section section-padding">
        <div x-show="!showRegister" x-transition class="container">
            <div class="box d-flex align-center flex-column-p gap-80">
                <!-- #right -->
                <div class="right w-43 w-100-p">
                    <p class="tt text-grad bold font-40 pb-15 font-32-p">تسجيل الدخول</p>
                    <p class="dd font-20 gray-4 pb-30 font-18-p">جمعية مناصرة فلسطين تجمع الداعمين والناشطين في مكان واحد لتنظيم العمل، نشر الوعي، وتعزيز نصرة فلسطين.</p>
                    <form wire:submit.prevent="login">
                        @csrf
                        <!-- #form box -->
                        <div class="form-box d-flex flex-column gap-25">
                            <!-- #group -->
                            <div class="form-group">
                                <p class="lbl mb-5 font-18">البريد الالكتروني</p>
                                <div class="input-with-icon relative">
                                    <input wire:model="email" type="email" placeholder="abc@gmail.com" class="form-control-with-icon radius-30" />
                                    <img class="icn" src="{{asset('home-assets/images/mail-gray.svg')}}" />
                                </div>
                                @error('email')
                                <label class="font-14 red d-flex gap-10 pointer main-color">
                                    <span>{{ $message }}</span>
                                </label>
                                @enderror
                            </div>
                            <!-- ##group -->
                            <!-- #group -->
                            <div class="form-group">
                                <p class="lbl mb-5 font-18">كلمة المرور</p>
                                <div x-data="{showPassword: false}" class="input-with-icon with-icon-after relative" password-input-root>
                                    <input wire:model="password" :type="showPassword ? 'text' : 'password'"
                                           placeholder="**********" password-input class="form-control-with-icon radius-30" />
                                    <img class="icn" src="{{asset('home-assets/images/lock.svg')}}" />
                                    <div class="password-icons flex-all">
                                        <button @click="showPassword = !showPassword" type="button" class="btn-0 h-100 w-100 icon-after-input relative" toggle-password-btn>
                                            <img x-show="!showPassword" class="pointer trans shrink-0 no" src="{{asset('home-assets/images/eye-off.svg')}}" width="20" />
                                            <img x-show="showPassword" class="pointer trans shrink-0 yes" src="{{asset('home-assets/images/eye.svg')}}" width="20" />
                                        </button>
                                    </div>
                                </div>
                                <div class="opt-pass d-flex space-between align-center pt-25">
                                    <!-- #itm -->
                                    <label for="" class="checkbox-control">
                                        <input type="radio" />
                                        <div class="dv">تذكرني</div>
                                    </label>
                                    <!-- ##itm -->
                                    <a href="#" class="text-grad font-16">نسيت كلمة المرور؟</a>
                                </div>
                            </div>
                            <!-- ##group -->
                        </div>
                        <!-- ##form box -->
                        <div class="actions-form pt-30">
                            <button type="submit" class="btn btn-submit-disabled-state w-100"
                                    wire:loading.attr="disabled">تسجيل الدخول</button>
                        </div>
                        <div class="actions-form pt-30">
                            <p class="no-acc-btn font-18 dark-green">
                                ليس لديك حساب؟
                                <span @click="showRegister = true"
                                    class="main-color underline bold" >
                                    إنشاء حساب
                                </span>
                            </p>
                        </div>
                    </form>
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
                    <form>
                        <!-- #form box -->
                        <div class="form-box grid-2 gap-25">
                            <!-- #group -->
                            <div class="form-group grid-full-row">
                                <p class="lbl mb-5 font-18">الاسم</p>
                                <div class="input-with-icon relative">
                                    <input type="" placeholder="abc@gmail.com" class="form-control-with-icon">
                                    <img class="icn" src="layout/images/mail-gray.svg">
                                </div>
                            </div>
                            <!-- ##group -->
                            <!-- #group -->
                            <div class="form-group grid-full-row">
                                <p class="lbl mb-5 font-18">البريد الالكتروني</p>
                                <div class="input-with-icon relative">
                                    <input type="email" placeholder="abc@gmail.com" class="form-control-with-icon">
                                    <img class="icn" src="layout/images/mail-gray.svg">
                                </div>
                            </div>
                            <!-- ##group -->
                            <!-- #group -->
                            <div class="form-group">
                                <p class="lbl mb-5 font-18">كود تفعيل ال OTP</p>
                                <div class=" relative">
                                    <input placeholder="0123456789" class="form-control-with-icon no">
                                </div>
                            </div>
                            <!-- ##group -->
                            <!-- #group -->
                            <div class="form-group d-flex align-end">
                                <button type="button" class="btn btn-primary w-100 otp-bbb">
                                    <span class="do">التحقق من البريد الإلكتروني</span>
                                    <span class="mo">التحقق </span>
                                </button>
                            </div>
                            <!-- ##group -->
                            <!-- #group -->
                            <div class="form-group grid-full-row">
                                <p class="lbl mb-5 font-18">رقم الهاتف</p>
                                <div class="input-with-icon relative">
                                    <input placeholder="0123456789" class="form-control-with-icon" mobile-number>
                                    <img class="icn" src="layout/images/phone-gray.svg">
                                </div>
                            </div>
                            <!-- ##group -->

                            <!-- #group -->
                            <div class="form-group grid-full-row-p">
                                <p class="lbl mb-5 font-18">كلمة المرور</p>
                                <div class="input-with-icon with-icon-after relative" password-input-root="">
                                    <input type="password" placeholder="**********" password-input="" class="form-control-with-icon">
                                    <img class="icn" src="layout/images/lock.svg">
                                    <div class="password-icons flex-all">
                                        <button type="button" class="btn-0 h-100 w-100 icon-after-input relative" toggle-password-btn="">
                                            <img class="pointer trans shrink-0 no" src="layout/images/eye-off.svg" width="20">
                                            <img class="pointer trans shrink-0 yes" src="layout/images/eye.svg" width="20">
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <!-- ##group -->
                            <!-- #group -->
                            <div class="form-group grid-full-row-p">
                                <p class="lbl mb-5 font-18">تأكيد كلمة المرور</p>
                                <div class="input-with-icon with-icon-after relative" password-input-root="">
                                    <input type="password" placeholder="**********" password-input="" class="form-control-with-icon">
                                    <img class="icn" src="layout/images/lock.svg">
                                    <div class="password-icons flex-all">
                                        <button type="button" class="btn-0 h-100 w-100 icon-after-input relative" toggle-password-btn="">
                                            <img class="pointer trans shrink-0 no" src="layout/images/eye-off.svg" width="20">
                                            <img class="pointer trans shrink-0 yes" src="layout/images/eye.svg" width="20">
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <!-- ##group -->
                        </div>
                        <!-- ##form box -->
                        <div class="actions-form pt-30">
                            <button class="btn btn-submit-disabled-state w-100">تسجيل</button>
                        </div>
                        <div class="actions-form pt-30">
                            <p class="no-acc-btn font-18 dark-green">
                                لديك حساب؟
                                <span class="main-color underline bold"
                                      @click="showRegister = false">
                                    تسجيل دخول
                                </span>
                            </p>
                        </div>
                    </form>
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
