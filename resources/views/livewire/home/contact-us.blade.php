<div>
    <!-- #breadcrumb -->
    <nav class="breadcrumb-box">
        <div class="container">
            <div class="bxp d-flex space-between flex-column-p gap-20 gap-65-p">
                <div class="right-side">
                    <ul class="list-none breadcrumb-in d-flex wrap gap-15">
                        <li>
                            <a class="body-color to-color" href="{{route('home')}}">{{__('الرئيسية')}}</a>
                        </li>
                        <img class="flip-en" src="{{asset('home-assets/images/arrow-left.svg')}}" width="24"/>
                        <li>
                            <p>{{__('تواصل معنا')}}</p>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <!-- ##breadcrumb -->

    <section class="cont-info-section">
        <div class="container">
            <div class="box grid-3 grid-2-t grid-1-p">

                <!-- #itm -->
                <div
                    class="itm border-red radius-24 pt-50 pb-50 px-30 bg-secondary d-flex center flex-column align-center">
                    <figure class="flex-all c mb-15">
                        <img src="{{asset('home-assets/images/call-circle.svg')}}" width="50" height="50" class="v"/>
                    </figure>

                    <p class="vz text-grad font-24 f-500 pb-15">{{__('اتصل بنا')}}</p>

                    <div class="d-flex justifu-center gap-7 font-20 vq">
                        <div class="md body-color d-flex gap-10 wrap-p justify-center">
                            <a href="#" class="main-color unicode">{{$settings['phone']}}</a> <span>:Mo</span>
                            <a href="#" class="main-color unicode">{{$settings['mobile']}}</a> <span>:PH</span>
                        </div>
                    </div>
                </div>
                <!-- ##itm -->

                <!-- #itm -->
                <div
                    class="itm border-red radius-24 pt-50 pb-50 px-30 bg-secondary d-flex center flex-column align-center">
                    <figure class="flex-all c mb-15">
                        <img src="{{asset('home-assets/images/pin-circle.svg')}}" width="50" height="50" class="v"/>
                    </figure>

                    <p class="vz text-grad font-24 f-500 pb-15">{{__('العنوان')}}</p>

                    <div class="d-flex justifu-center gap-7 font-20 vq">
                        <div class="md body-color d-flex gap-10">
                            {{$settings['location']}}
                        </div>
                    </div>
                </div>
                <!-- ##itm -->

                <!-- #itm -->
                <div
                    class="itm border-red radius-24 pt-50 pb-50 px-30 bg-secondary d-flex center flex-column align-center">
                    <figure class="flex-all c mb-15">
                        <img src="{{asset('home-assets/images/mail-circle.svg')}}" width="50" height="50" class="v"/>
                    </figure>

                    <p class="vz text-grad font-24 f-500 pb-15">{{__('البريد الالكتروني')}}</p>

                    <div class="d-flex justifu-center gap-7 font-20 vq">
                        <div class="md body-color d-flex gap-7">
                            <a href="#" class="main-color unicode">{{$settings['email']}}</a> <span>:Email</span>
                        </div>
                    </div>
                </div>
                <!-- ##itm -->

            </div>
        </div>
    </section>


    <!-- #banks -->
    <section class="banks-acc-section section-padding">
        <div class="container">

            <div class="hd center pb-50">
                <p class="tx main-color text-grad title-32 pb-15">{{__('الحسابات المصرفية')}}</p>

                <p class="cz font-20 f-500">
                    {{__('يمكنكم دعم مشاريعنا وأنشطتنا من خلال التبرع عبر أحد حساباتنا المصرفية التالية')}}
                </p>
            </div>

            <div class="box d-flex justify-center wrap gap-40 gap-25-p">

                @foreach($accounts as $account)
                    <!-- #itm -->
                    <div wire:ignore class="itm border-red bg-white relative radius-24 overflow-hidden">

                        <div class="toop bg-grad p-16 white relative d-flex space-between">
                            <img src="{{asset('home-assets/images/e2.png')}}" class="e2"/>
                            <img src="{{asset('home-assets/images/e1.png')}}" class="e1"/>

                            <div class="rights">
                                <figure class="d-flex pb-15">
                                    <img src="{{asset('home-assets/images/bank.svg')}}" width="32"/>
                                </figure>

                                <p class="txt font-20 bold pb-5">{{$account->name}}</p>
                            </div>

                            <div class="lft center font-20 f-500 center align-self radius-8">
                                <p class="tv">{{__('العملة')}}</p>
                                <p class="tv2 bold">{{$account->currency}}</p>
                            </div>
                        </div>

                        <div class="bb d-flex space-between align-center p-16">

                            <div class="bb-right font-20 f-500">
                                <p class="b44 pb-">{{__('رقم الحساب')}}</p>
                                <p class="b55 main-color">{{$account->account_number}}</p>
                            </div>

                            <div x-data="{ copyToClipboard: false }" class="bb-left">
                                <button
                                    :class="{ 'btn': copyToClipboard}"
                                    @click="navigator.clipboard.writeText('{{$account->account_number}}');
                                    copyToClipboard = true;
                                    setTimeout(() => copyToClipboard = false, 2000)"
                                    class="copp font-18">

                                    <span x-show="!copyToClipboard">{{__('نسخ')}}</span>

                                    <span x-transition x-show="copyToClipboard">
                                        {{__('تم النسخ')}}
                                    </span>

                                </button>
                            </div>

                        </div>
                    </div>
                    <!-- ##itm -->
                @endforeach

            </div>
        </div>
    </section>
    <!-- ##banks -->

    <livewire:home.components.contact-us-page/>
</div>
