<form wire:submit.prevent="login">
    @csrf
    <!-- #form box -->
    <div class="form-box d-flex flex-column gap-25">
        <!-- #group -->
        <div class="form-group">
            <p class="lbl mb-5 font-18">البريد الالكتروني</p>
            <div class="input-with-icon relative">
                <input wire:model="email" type="email" placeholder="abc@gmail.com"
                       class="form-control-with-icon radius-30"/>
                <img class="icn" src="{{asset('home-assets/images/mail-gray.svg')}}"/>
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
                       placeholder="**********" password-input class="form-control-with-icon radius-30"/>
                <img class="icn" src="{{asset('home-assets/images/lock.svg')}}"/>
                <div class="password-icons flex-all">
                    <button @click="showPassword = !showPassword" type="button"
                            class="btn-0 h-100 w-100 icon-after-input relative" toggle-password-btn>
                        <img x-show="!showPassword" class="pointer trans shrink-0 no"
                             src="{{asset('home-assets/images/eye-off.svg')}}" width="20"/>
                        <img x-show="showPassword" class="pointer trans shrink-0 yes"
                             src="{{asset('home-assets/images/eye.svg')}}" width="20"/>
                    </button>
                </div>
            </div>
            <div class="opt-pass d-flex space-between align-center pt-25">
                <!-- #itm -->
                <label for="" class="checkbox-control">
                    <input type="radio"/>
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
                wire:loading.attr="disabled">تسجيل الدخول
        </button>
    </div>
    @if(request()->routeIs('login'))
        <div class="actions-form pt-30">
            <p class="no-acc-btn font-18 dark-green">
                ليس لديك حساب؟
                <span @click="showRegister = true"
                      class="main-color underline bold">
                إنشاء حساب
            </span>
            </p>
        </div>
    @endif
</form>
