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
                            <a class="body-color to-color" href="{{route('profile')}}">الملف الشخصي</a>
                        </li>
                        <img class="flip-en" src="{{asset('home-assets/images/arrow-left.svg')}}" width="24"/>
                        <li>
                            <p>الإعدادات</p>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <!-- ##breadcrumb -->


    <!-- #profile edit -->
    <section class="profile-edit-section section-padding-b">
        <div class="container">
            <!-- #box -->
            <div class="box d-flex flex-column-p align-center-p gap-80">
                <!-- #right -->
                <div class="right shrink-0 mx-auto-p" style="width: 240px;">
                    <figure class="prof-av d-flex relative mb-30">
                        <div class="rounded my-avatar-fig overflow-hidden relative" style="width: 240px;height:240px;">
                            <img class="object-fit my-avatar"
                                 src="{{ $avatar ? $avatar->temporaryUrl() : $user->full_image_path }}"
                                 width="100%" height="100%"/>
                            <div class="bg full-el"></div>
                        </div>
                        <div class="full-el flv d-flex align-end justify-end">
                            <label for="avatar-upload" class="bg-white flex-all btn-upl rounded border-0 shadow"
                                   style="width: 60px;height:60px; cursor: pointer;">
                                <img src="{{ asset('home-assets/images/camera.svg') }}" width="30"/>
                            </label>
                            <input id="avatar-upload"
                                   type="file"
                                   wire:model="avatar"
                                   accept="image/*"
                                   class="d-none" style="display: none;">
                        </div>
                    </figure>
                    <p class="gray-4 center vz2 font-20 f-500">يُفضل استخدام صورة بحجم 400x400 بكسل</p>
                </div>
                <!-- ##right -->

                <!-- #left -->
                <div class="left flex-1 w-100-p">
                    <p class="t23 black-3 font-22 bold pb-25">المعلومات الشخصية</p>
                    <div class="form-inside" form-inside>
                        <form wire:submit="save">
                            <div class="form-box d-flex flex-column gap-25">
                                <!-- #field -->
                                <div class="form-group">
                                    <p class="form-lbl">الاسم</p>
                                    <input readonly type="text" class="form-control theme-2 theme-gray"
                                           placeholder="{{Auth::user()->name}}"/>
                                </div>
                                <!-- ##field -->
                                <!-- #field -->
                                <div class="form-group">
                                    <p class="form-lbl">البريد الإلكتروني</p>
                                    <input readonly type="text" class="form-control theme-2 theme-gray"
                                           placeholder="{{Auth::user()->email}}"/>
                                </div>
                                <!-- ##field -->
                                <div class="form-group grid-full-row">
                                    <p class="lbl mb-5 font-18">رقم الهاتف</p>

                                    <div class="input-with-icon relative">

                                        {{-- حقل رقم الهاتف --}}
                                        <input wire:model="user.phone"
                                               type="text"
                                               placeholder="39333333"
                                               class="form-control-with-icon"
                                               style="padding-inline-end: 145px; padding-inline-start: 14px;">

                                        {{-- Select الدولة --}}
                                        <div class="d-flex align-center gap-5"
                                             style="position: absolute; top: 0; bottom: 0; margin: auto; inset-inline-end: 14px; height: 50px;">
                                            <div
                                                style="width: 1px; height: 22px; background: #D0D0D0; flex-shrink: 0;"></div>
                                            <select wire:model.live="user.country_id"
                                                    class="btn-0 d-flex align-center f-500"
                                                    style="font-size: 15px; color: var(--body-color); cursor: pointer; height: 100%;">
                                                @foreach($countries as $country)
                                                    <option value="{{ $country->id }}">
                                                        {{ $country->phone_code }}
                                                    </option>
                                                @endforeach
                                            </select>

                                            <img
                                                src="{{ asset('home-assets/' . ($this->selectedCountry?->image_path ?? 'flags/bahrain.svg')) }}"
                                                width="26" height="19"
                                                style="border-radius: 4px; object-fit: cover; flex-shrink: 0;">

                                        </div>

                                    </div>

                                    @error('user.phone')
                                    <label class="font-14 red d-flex gap-10 pointer">
                                        <span>{{ $message }}</span>
                                    </label>
                                    @enderror
                                    @error('user.country_id')
                                    <label class="font-14 red d-flex gap-10 pointer">
                                        <span>{{ $message }}</span>
                                    </label>
                                    @enderror
                                </div>

                                <div class="hr-block mt-15"></div>
                                <div>
                                    <p class="gdf bold font-22 pb-10">تغيير كلمة السر</p>
                                    <p class="bzv font-18 f-500">اترك الحقول فارغة إذا كنت لا ترغب في تغيير كلمة
                                        السر</p>
                                </div>

                                <!-- #field -->
                                <div class="form-group">
                                    <p class="form-lbl">كلمة السر الحالية</p>
                                    <input wire:model="current_password" type="password"
                                           class="form-control theme-2 theme-gray"/>
                                    @error('current_password')
                                    <label class="font-14 main-color d-flex gap-10 pointer"><span>{{ $message }}</span></label>
                                    @enderror
                                </div>
                                <!-- ##field -->

                                <!-- #field -->
                                <div class="form-group">
                                    <p class="form-lbl">كلمة السر الجديدة</p>
                                    <input wire:model="new_password" type="password"
                                           class="form-control theme-2 theme-gray"/>
                                    @error('new_password')
                                    <label class="font-14 main-color d-flex gap-10 pointer"><span>{{ $message }}</span></label>
                                    @enderror
                                </div>
                                <!-- ##field -->

                                <!-- #field -->
                                <div class="form-group">
                                    <p class="form-lbl">تأكيد كلمة السر الجديدة</p>
                                    <input wire:model="new_password_confirmation" type="password"
                                           class="form-control theme-2 theme-gray"/>
                                    @error('new_password_confirmation')
                                    <label class="font-14 main-color d-flex gap-10 pointer"><span>{{ $message }}</span></label>
                                    @enderror
                                </div>
                                <!-- ##field -->

                                <div class="grid-full-row d-flex accccc gap-40 gap-20-p">
                                    <button wire:click="save" wire:loading.attr="disabled" class="btn btn-primary flex-1">
                                        <span wire:loading.remove wire:target="save">
                                            @if($saved)
                                                تم الحفظ بنجاح
                                            @else
                                                حفظ
                                            @endif
                                        </span>
                                        <span wire:loading wire:target="save">جاري الحفظ...</span>
                                    </button>
                                    <a href="{{route('profile')}}" class="btn btn-outline-trans flex-1">إلغاء</a>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
                <!-- ##left -->
            </div>
            <!-- ##box -->
        </div>
    </section>
    <!-- ##profile edit -->
</div>
