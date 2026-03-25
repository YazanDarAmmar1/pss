<header class="header">
    <div class="upper-head">
        <div class="container">
            <!-- #box -->
            <div class="box d-flex align-center space-between">
                <!-- #left -->
                <div class="left d-flex align-center gap-7">
                    {{--                    <div class="mo">--}}
                    {{--                        <div class="d-flex">--}}
                    {{--                            <a href="#" class="flex-all btn-back-head">--}}
                    {{--                                <img class="flip" src="{{asset('home-assets/images/arrow-left.svg')}}" width="24"/>--}}
                    {{--                            </a>--}}
                    {{--                        </div>--}}
                    {{--                    </div>--}}
                    <!-- #logo -->
                    <a href="{{route('home')}}" class="header-logo d-flex">
                        <img class="do" width="243" src="{{asset('home-assets/images/logo.svg')}}" alt=""/>
                        <img class="mo" width="53" src="{{asset('home-assets/images/logo-mo.svg')}}" alt=""/>
                    </a>
                    <!-- ##logo -->
                </div>
                <!-- ##left -->

                <div class="do">
                    <div class="middle-side d-flex gap-30 space-between align-center">
                        <!-- #main menu (desktop only) -->
                        <ul class="main-menu-box d-flex list-none gap-25">
                            <!-- #item -->
                            <li>
                                <a href="{{route('projects')}}" wire:current.class="active" wire:navigate.hover
                                   class="menu-item black trans bold relative">مشاريعنا</a>
                            </li>
                            <!-- ##item -->
                            <!-- #item -->
                            <li>
                                <a href="{{route('news')}}" wire:current.class="active" wire:navigate.hover
                                   class="menu-item black trans bold relative">أخبارنا</a>
                            </li>
                            <!-- ##item -->
                            <!-- #item -->
                            <li>
                                <a href="{{route('library')}}" wire:current.class="active" wire:navigate.hover
                                   class="menu-item black trans bold relative">مكتبتنا</a>
                            </li>
                            <!-- ##item -->
                            <!-- #item -->
                            <li>
                                <a href="{{route('about-us')}}" wire:current.class="active" wire:navigate.hover
                                   class="menu-item black trans bold relative">من نحن</a>
                            </li>
                            <!-- ##item -->
                            <!-- #item -->
                            <li>
                                <a href="{{route('contact-us')}}" wire:current.class="active" wire:navigate.hover
                                   class="menu-item black trans bold relative">تواصل معنا</a>
                            </li>
                            <!-- ##item -->
                        </ul>
                        <!-- ##main menu (desktop only) -->
                    </div>
                </div>

                <!-- #btns header -->
                <div class="btns-header d-flex align-center gap-15">
                    <!-- #wrapper -->
                    <div class="wrap-just">
                        <div class="right-options d-flex align-center gap-15">
                            @php
                                $currentLocale = app()->getLocale();
                                $switchTo = $currentLocale === 'ar' ? 'en' : 'ar';
                                $path = request()->path();
                                $cleanPath = preg_replace('/^(ar|en)\//', '', $path); // remove prefix
                            @endphp

                            <a href="/{{ $switchTo }}/{{ $cleanPath }}"
                               class="btn-header do-only btn-header-lang d-flex align-center gap-7 font-14 font-2 black">
                                @if($currentLocale === 'ar')
                                    <img src="{{asset('home-assets/images/flag-en.svg')}}" width="28" height="20"
                                         class="radius-4"/>
                                    <span>EN</span>
                                @else
                                    <img src="{{asset('home-assets/images/flag-en.svg')}}" width="28" height="20"
                                         class="radius-4"/>
                                    <span>AR</span>
                                @endif
                            </a>

                            <button open-modal="search-modal" class="btn-0 btn-head-with-badge search-header-btn">
                                <img src="{{asset('home-assets/images/search-icon.svg')}}" width="40" height="auto"
                                     class="rounded"/>
                            </button>
                            <button wire:click="userBasketBoxModal" class="btn-0 btn-head-with-badge cart-header-btn">
                                <img src="{{asset('home-assets/images/basket-red-menu.svg')}}" width="40" height="auto"
                                     class="rounded"/>
                                <span class="badgecc flex-all">{{$cartCount}}</span>
                            </button>
                        </div>
                    </div>
                    <!-- ##wrapper -->


                    <div class="mo-btns-head mo-only">
                        <div class="mo-btns-head-itms d-flex gap-7">
                            <button open-modal="main-menu-mobile"
                                    class="header-burger-menu-btn flex-all bg-transparent border-0 p-0">
                                <img src="{{asset('home-assets/images/menu.svg')}}" width="24"/>
                            </button>
                        </div>
                    </div>
                    @if(!Auth::check())
                        <a wire:navigate href="{{route('login')}}" class="btn btn-login-header do">
                            <span>تسجيل الدخول</span>
                        </a>
                    @else
                        <div class="header-user-login-wrapper relative do-only">
                            <a wire:navigate href="{{route('profile')}}"
                               class="header-user-in black d-flex align-center gap-7">
                                <img class="object-fit rounded" src="{{Auth::user()->full_image_path}}" width="50"
                                     height="50"/>
                                <span class="spa one-line font-18 f-600 font-16-p">{{ auth()->user()->name }}</span>
                            </a>
                            <!-- #logged-in-user-hover-ddl -->
                            <div class="logged-in-user-hover-ddl">
                                <div class="logged-in-user-hover-ddl-itms">
                                    <ul class="list-none d-flex flex-column gap-5">
                                        <li>
                                            <a class="d-flex align-center gray-9 f-600 font-18 ibx gap-7 pt-10 pb-10"
                                               href="{{route('profile')}}">
                                                <img src="{{asset('home-assets/images/menu-icon-1.svg')}}" width="24"
                                                     height="24"/>
                                                <span>الإعدادات</span>
                                            </a>
                                        </li>
                                        <li class="logout-itm pt-15">
                                            <a class="d-flex justify-center align-center gray-9 f-600 font-18 ibx gap-7 pt-10 pb-10"
                                               href="{{route('user.auth.logout')}}">
                                                <img src="{{asset('home-assets/images/logout.svg')}}" width="24"
                                                     height="24"/>
                                                <span>تسجيل الخروج</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!-- ##logged-in-user-hover-ddl -->
                        </div>
                    @endif
                </div>
                <!-- ##btns header -->

            </div>
            <!-- ##box -->
        </div>
    </div>

    <!-- #menu (mobile only) -->
    <div class="mo">


        <!-- #main menu popup -->
        <aside class="main-menu-mobile modal trans" modal-name="main-menu-mobile">
            <div class="modal-overlay" close-modal="main-menu-mobile"></div>
            <!-- #wrapper -->
            <div class="menu-wrapper relative bg-white d-flex flex-column space-between h-100 trans">
                <!-- #upper part -->
                <div class="menu-upper-part px-25 pb-5">
                    <!-- #part 1 -->
                    <div class="part-wrap-1 pb-15">
                        <div class="menu-part-1 pt-20 pb-20 d-flex space-between align-center relative">
                            <button close-modal="main-menu-mobile"
                                    class="menu-close-btn-in-menu flex-all bg-transparent border-0">
                                <img src="{{asset('home-assets/images/close-red.svg')}}" width="40" height="40"/>
                            </button>
                            <figure class="flex-all w-100">
                                <img src="{{asset('home-assets/images/logo.svg')}}" width="127"/>
                            </figure>
                        </div>
                        <span class="mo-menu-sp"></span>
                    </div>
                    <!-- ##part 1 -->

                    <!-- #links -->
                    <!-- #mobile menu -->
                    <!-- #mobile menu (#gulp) -->
                    <ul class="list-none d-flex flex-column gap-15 main-menu-mo-list">
                        <!-- #item -->
                        <li>
                            <a wire:navigate href="{{route('projects')}}"> مشاريعنا</a>
                        </li>
                        <!-- ##item -->
                        <!-- #item -->
                        <li>
                            <a wire:navigate href="{{route('news')}}">أخبارنا</a>
                        </li>
                        <!-- ##item -->
                        <!-- #item -->
                        <li>
                            <a wire:navigate href="{{route('library')}}">مكتبتنا</a>
                        </li>
                        <!-- ##item -->
                        <!-- #item -->
                        <li>
                            <a href="{{route('about-us')}}" wire:navigate> من نحن</a>
                        </li>
                        <!-- ##item -->
                        <!-- #item -->
                        <li>
                            <a wire:navigate href="{{route('contact-us')}}">تواصل معنا</a>
                        </li>
                        <!-- ##item -->
                        @if(Auth::check())
                            <!-- #item -->
                            <li>
                                <a href="{{route('profile')}}">الملف الشخصي</a>
                            </li>
                            <!-- ##item -->
                        @endif
                    </ul>
                    <!-- ##mobile menu (#gulp) -->

                    <!-- ##mobile menu -->
                    <!-- ##links -->
                </div>
                <!-- ##upper part -->

                <!-- #bottom -->
                <div class="menu-bottom-part d-flex flex-column px-30 pb-25 pt-10 gap-20">
                    <span class="mo-menu-sp"></span>
                    <div class="bm_12 d-flex space-between">
                        @if(Auth::check())
                            <a href="{{route('user.auth.logout')}}"
                               class="btn-0 btn-logout-menu-header body-color font-18 bold d-flex align-center gap-7 no-wrap">
                                <img width="24" src="{{asset('home-assets/images/logout.svg')}}">
                                <span>تسجيل الخروج</span>
                            </a>
                        @else
                            <a href="{{route('login')}}" class="btn btn-login-header" open-modal="login-modal">
                                <span>تسجيل الدخول</span>
                            </a>
                        @endif
                        <a href="/{{ $switchTo }}/{{ $cleanPath }}"
                           class="btn-header btn-header-lang d-flex align-center gap-7 font-14 font-2 black">
                            @if($currentLocale === 'ar')
                                <img src="{{asset('home-assets/images/flag-en.svg')}}" width="28" height="20"
                                     class="radius-4"/>
                                <span>EN</span>
                            @else
                                <img src="{{asset('home-assets/images/flag-en.svg')}}" width="28" height="20"
                                     class="radius-4"/>
                                <span>AR</span>
                            @endif
                        </a>

                    </div>
                </div>
                <!-- ##bottom -->

            </div>
            <!-- ##wrapper -->
        </aside>
        <!-- ##main menu popup -->

    </div>
    <!-- ##menu(mobile only) -->

    <!-- #search modal -->
    <aside class="search-modal modal trans p-0-p" modal-name="search-modal">
        <div class="full-el pointer" close-modal="search-modal"></div>
        <!-- #body -->
        <div class="modal-body relative z-1 w-100">
            <div class="form-inside container px-0-p">
                <form>
                    <div class="form-box d-flex gap-40 gap-15-p py-25">
                        <input type="text" placeholder="ابحث بواسطة اسم المشروع ..."
                               class="form-control search-form-input"/>
                        <button type="submit" class="btn btn-submit">بحث</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- ##body -->
    </aside>
    <!-- ##search modal -->


</header>

