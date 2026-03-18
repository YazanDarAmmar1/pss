<div x-data="{ activeTab: '{{ auth('app')->check() ? 'tgl-guest' : 'tgl-login' }}' }">
    <!-- #breadcrumb -->
    <nav class="breadcrumb-box">
        <div class="container">
            <div class="bxp d-flex space-between flex-column-p gap-20 gap-65-p">
                <div class="right-side">
                    <ul class="list-none breadcrumb-in d-flex wrap gap-15">
                        <li>
                            <a class="body-color to-color" href="#">الرئيسية</a>
                        </li>
                        <img class="flip-en" src="{{asset('home-assets/images/arrow-left.svg')}}" width="24"/>
                        <li>
                            <p>الدفع</p>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <!-- ##breadcrumb -->


    <!-- #payment -->
    <section class="payment-section pt-80 pt-40-p pb-40-p pb-80">
        <div class="container">

            <div class="wrap d-flex space-between gap-20 gap-25-p">

                <!-- #right -->
                <div class="right-side w-50 w-100-p">

                    <!-- التبويبات تظهر فقط إذا غير مسجل -->
                    @if(!auth('app')->check())
                        <div class="tabs-box_custom d-flex gap-30 gap-10-p pb-30">

                            <button
                                class="btn-0 tab_btn_custom bold font-20 font-16-p px-10-p py-10 px-40 trans no-wrap relative"
                                :class="{ active: activeTab === 'tgl-login' }"
                                @click="activeTab = 'tgl-login'"
                            >
                                تسجيل الدخول
                            </button>

                            <button
                                class="btn-0 tab_btn_custom bold font-20 font-16-p px-10-p py-10 px-40 trans no-wrap relative"
                                :class="{ active: activeTab === 'tgl-new' }"
                                @click="activeTab = 'tgl-new'"
                            >
                                متبرع جديد
                            </button>

                            <button
                                class="btn-0 tab_btn_custom bold font-20 font-16-p px-10-p py-10 px-40 trans no-wrap relative"
                                :class="{ active: activeTab === 'tgl-guest' }"
                                @click="activeTab = 'tgl-guest'"
                            >
                                فاعل خير
                            </button>

                        </div>
                    @endif
                    <!-- ##tabs -->


                    <div class="box">

                        <!-- تسجيل الدخول -->
                        @if(!auth('app')->check())
                            <div class="payment-tab" x-show="activeTab === 'tgl-login'" x-transition>
                                <p class="tt text-grad bold font-24 pb-30">تسجيل الدخول</p>
                                <livewire:home.auth.login :redirect="route('checkout')"/>
                            </div>

                            <div class="payment-tab" x-show="activeTab === 'tgl-new'" x-transition>
                                <livewire:home.auth.register/>
                            </div>
                        @endif


                        <!-- الدفع -->
                        <div class="payment-tab"
                             @if(!auth('app')->check())
                                 x-show="activeTab === 'tgl-guest'"
                             @endif
                             x-transition>

                            <p class="tt text-grad bold font-24 pb-25">الدفع و التسديد</p>

                            <form wire:submit="pay">

                                <div class="form-box d-flex flex-column gap-30">

                                    <div class="form-group">
                                        <p class="lbl mb-10 f-500 font-18-p">
                                            يرجى اختيار طريقة الدفع:
                                        </p>

                                        <div class="vt-row-group d-flex flex-column gap-15">

                                            <div class="inner-group form-group">

                                                <p class="lbl mb-10 f-500 black font-20 font-18-p">
                                                    جميع أنواع البطاقات
                                                </p>

                                                <div class="d-flex gap-15 wrap">

                                                    <label class="radio-control-img d-flex align-center gap-15">
                                                        <input wire:model="payment_type" value="1" type="radio" name="payment"/>
                                                        <span class="dv flex-all gap-10">
                                                            <img src="{{asset('home-assets/images/payment-card-1.svg')}}" width="59"/>
                                                            <img src="{{asset('home-assets/images/payment-card-2.svg')}}" width="35"/>
                                                            <img src="{{asset('home-assets/images/payment-card-3.svg')}}" width="68"/>
                                                        </span>
                                                    </label>

                                                    <label class="radio-control-img d-flex align-center gap-15">
                                                        <input wire:model="payment_type" value="2" type="radio" name="payment"/>
                                                        <span class="dv flex-all">
                                                            <img src="{{asset('home-assets/images/payment-card-4.svg')}}" width="46"/>
                                                        </span>
                                                    </label>

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                    <p class="gray-7 f-600 font-14 pb-10">
                                        سوف تتلقى صفحة تأكيد تحتوي على جميع معلومات المعاملة
                                        بمجرد موافقتك على الدفع.
                                    </p>

                                </div>

                                <div class="actions-form d-flex justify-end pt-25">
                                    <button type="submit" class="btn btn-primary w-100">
                                        إتمام الدفع
                                    </button>
                                </div>

                            </form>

                        </div>

                    </div>

                </div>
                <!-- ##right -->


                <!-- #left -->
                <div class="left-side w-35 w-100-p">

                    <div class="left-box bg-secondary p-32 border-red radius-24">

                        <div class="left-box-hd pb-15 d-flex space-between">
                            <p class="black bold font-20">ملخص التبرع</p>
                            <a href="#" class="btn btn-primary">تعديل</a>
                        </div>

                        <p class="black f-600 font-16 pb-15">1 تبرعات</p>

                        <div class="black f-600 font-16 d-flex align-center space-between gap-10 wrap pb-15">
                            <p>إجمالي التبرعات</p>
                            <p class="bold font-20">50 BHD</p>
                        </div>

                        <div class="cart-itms-payment">

                            <div class="itm py-15 d-flex align-center gap-15">

                                <figure class="flex-all shrink-0">
                                    <img src="layout/images/cart.svg" width="40"/>
                                </figure>

                                <div>
                                    <p class="text-grad bold font-16 pb-5">
                                        تهيئة المنازل لكبار السن
                                    </p>
                                    <p class="text-grad bold">50 BHD</p>
                                </div>

                            </div>

                        </div>

                        <div class="ttls pt-15 d-flex space-between gap-10 wrap">
                            <span class="bold font-18">المجموع</span>
                            <span class="bold font-20">50 BHD</span>
                        </div>

                    </div>

                </div>
                <!-- ##left -->


            </div>

        </div>
    </section>
    <!-- ##payment -->

</div>
