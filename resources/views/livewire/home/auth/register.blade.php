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
    @if(request()->routeIs('login'))
        <div class="actions-form pt-30">
            <p class="no-acc-btn font-18 dark-green">
                لديك حساب؟
                <span class="main-color underline bold" @click="showRegister = false">
                تسجيل دخول
            </span>
            </p>
        </div>
    @endif
</form>
