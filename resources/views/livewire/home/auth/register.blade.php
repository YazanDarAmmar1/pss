<form wire:submit="register">
    <!-- #form box -->
    <div class="form-box grid-2 gap-25" @registered.window="showRegister = false">
        <!-- #group -->
        <div class="form-group grid-full-row">
            <p class="lbl mb-5 font-18">الاسم</p>
            <div class="input-with-icon relative">
                <input wire:model="name" type="text" placeholder="abcdefg" class="form-control-with-icon" required>
                <img class="icn" src="{{asset('home-assets/images/mobile.png')}}">
            </div>
            @error('name')
            <label class="font-14 red d-flex gap-10 pointer">
                <span>{{ $message }}</span>
            </label>
            @enderror
        </div>
        <!-- ##group -->
        <!-- #group -->
        <div class="form-group grid-full-row">
            <p class="lbl mb-5 font-18">البريد الالكتروني</p>
            <div class="input-with-icon relative">
                <input wire:model="email" type="email" placeholder="abc@gmail.com" class="form-control-with-icon" required>
                <img class="icn" src="{{asset('home-assets/images/mail-gray.svg')}}">
            </div>
            @error('email')
            <label class="font-14 red d-flex gap-10 pointer">
                <span>{{ $message }}</span>
            </label>
            @enderror
        </div>
        <!-- ##group -->
        <!-- #group -->
        <div class="form-group">
            <p class="lbl mb-5 font-18">كود تفعيل ال OTP</p>
            <div class=" relative">
                <input wire:model="otp" placeholder="12345" class="form-control-with-icon no" required>
            </div>
            @error('otp')
            <label class="font-14 red d-flex gap-10 pointer">
                <span>{{ $message }}</span>
            </label>
            @enderror
        </div>
        <!-- ##group -->
        <!-- #group -->
        <div class="form-group d-flex align-end">
            <button
                type="button"
                class="btn btn-green f-600 w-100"
                wire:click="sendOtp"
                wire:loading.attr="disabled"
                @disabled($otpCooldown > 0)
            >
                @if($otpCooldown > 0)
                    {{__('Resend after')}} {{ $otpCooldown }} {{__('seconds')}}
                @else
                    <span class="do">التحقق من البريد</span>
                    <span class="mo">التحقق </span>
                @endif
            </button>
        </div>
        <!-- ##group -->
        @if($otpCooldown > 0)
            <div wire:poll.1000ms="decrementOtpCooldown"></div>
        @endif
        <!-- #group -->
        <div class="form-group grid-full-row">
            <p class="lbl mb-5 font-18">رقم الهاتف</p>

            <div class="input-with-icon relative">

                {{-- حقل رقم الهاتف --}}
                <input wire:model="phone"
                       type="number"
                       placeholder="39333333"
                       class="form-control-with-icon"
                       style="padding-inline-end: 145px; padding-inline-start: 14px;">

                {{-- Select الدولة --}}
                <div class="d-flex align-center gap-5"
                     style="position: absolute; top: 0; bottom: 0; margin: auto; inset-inline-end: 14px; height: 50px;">

                    <div style="width: 1px; height: 22px; background: #D0D0D0; flex-shrink: 0;"></div>

                    <select wire:model.live="country_id"
                            class="btn-0 d-flex align-center f-500"
                            style="font-size: 15px; color: var(--body-color); cursor: pointer; height: 100%;">
                        @foreach($countries as $country)
                            <option value="{{ $country->id }}">
                                {{ $country->phone_code }}
                            </option>
                        @endforeach
                    </select>

                    <img src="{{ asset('home-assets/' . ($this->selectedCountry?->image_path ?? 'flags/bahrain.svg')) }}"
                         width="26" height="19"
                         style="border-radius: 4px; object-fit: cover; flex-shrink: 0;">

                </div>

            </div>

            @error('phone')
            <label class="font-14 red d-flex gap-10 pointer">
                <span>{{ $message }}</span>
            </label>
            @enderror
        </div>

        <!-- #group -->
        <div class="form-group grid-full-row-p">
            <p class="lbl mb-5 font-18">كلمة المرور</p>
            <div class="input-with-icon with-icon-after relative" password-input-root="">
                <input wire:model="password" type="password" placeholder="**********" password-input=""
                       class="form-control-with-icon" required>
                <img class="icn" src="{{asset('home-assets/images/lock.svg')}}">
                <div class="password-icons flex-all">
                    <button type="button" class="btn-0 h-100 w-100 icon-after-input relative" toggle-password-btn="">
                        <img class="pointer trans shrink-0 no" src="{{asset('home-assets/images/eye-off.svg')}}"
                             width="20">
                        <img class="pointer trans shrink-0 yes" src="{{asset('home-assets/images/eye.svg')}}"
                             width="20">
                    </button>
                </div>
            </div>
            @error('password')
            <label class="font-14 red d-flex gap-10 pointer">
                <span>{{ $message }}</span>
            </label>
            @enderror
        </div>
        <!-- ##group -->
        <!-- #group -->
        <div class="form-group grid-full-row-p">
            <p class="lbl mb-5 font-18">تأكيد كلمة المرور</p>
            <div class="input-with-icon with-icon-after relative" password-input-root="">
                <input wire:model="password_confirmation" type="password" placeholder="**********" password-input=""
                       class="form-control-with-icon" required>
                <img class="icn" src="{{asset('home-assets/images/lock.svg')}}">
                <div class="password-icons flex-all">
                    <button type="button" class="btn-0 h-100 w-100 icon-after-input relative" toggle-password-btn="">
                        <img class="pointer trans shrink-0 no" src="{{asset('home-assets/images/eye-off.svg')}}"
                             width="20">
                        <img class="pointer trans shrink-0 yes" src="{{asset('home-assets/images/eye.svg')}}"
                             width="20">
                    </button>
                </div>
            </div>
            @error('password_confirmation')
            <label class="font-14 red d-flex gap-10 pointer">
                <span>{{ $message }}</span>
            </label>
            @enderror
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
