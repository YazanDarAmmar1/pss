<div>

    <nav class="breadcrumb-box">
        <div class="container">

            <div class="bxp d-flex space-between flex-column-p gap-20 gap-65-p">

                <div class="right-side">

                    <ul class="list-none breadcrumb-in d-flex wrap gap-15">

                        <li>
                            <a class="body-color to-color" href="{{route('home')}}">
                                {{__('الرئيسية')}}
                            </a>
                        </li>

                        <img class="flip-en" src="{{asset('home-assets/images/arrow-left.svg')}}" width="24"/>

                        <li>
                            <a class="body-color to-color" href="{{route('projects')}}">
                                {{__('مشاريعنا')}}
                            </a>
                        </li>

                        <img class="flip-en" src="{{asset('home-assets/images/arrow-left.svg')}}" width="24"/>

                        <li>
                            <p>{{$project->name}}</p>
                        </li>

                    </ul>

                </div>

            </div>
        </div>
    </nav>
    <!-- ##breadcrumb -->

    <!-- #search section -->
    <section class="proj--details-section section-padding-b">

        <div class="container">

            <!-- #box -->
            <div class="box">

                <!-- #item -->
                <div
                    class="box proj__details_item box1 border-red radius-24 p-32 px-15-p pt-15-p d-flex gap-40 flex-column-p gap-40 gap-15-p bg-white">

                    <!-- #right -->
                    <div class="right d-flex align-self shrink-0 w-100-p relative" style="width:451px;">

                        <img src="{{asset($project->image_path)}}"
                             class="object-fit radius-12 img w-100"
                             width="270"
                             height="384">

                    </div>
                    <!-- ##right -->

                    <!-- #left -->
                    <div class="left d-flex flex-column space-between flex-1 w-100-p">

                        <div class="tc1">

                            <div class="psa pb-10">

                                <div class="hh d-flex space-between column-reverse-p align-center gap-5">

                                    <p class="tt1 bold title-28 main-color">
                                        {{$project->name}}
                                    </p>

                                    <div class="share-action-svg pointer flex-all"
                                         share="link_url_here"
                                         share-title="share_title_here"
                                         data-toggle="tooltip"
                                         click=""
                                         data-title="{{__('تم نسخ الرابط')}}">

                                        <!-- svg -->

                                    </div>

                                </div>

                            </div>

                            <p class="da font-18 f-500 pb-80 pb-20-p">
                                {{$project->short_description}}
                            </p>

                        </div>

                        <div class="up-btm d-flex flex-column gap-15">

                            <div class="indec bg-soft-2 radius-4 overflow-hidden d-flex w-100" style="height:8px ;">
                                <span class="bg-main radius-4" style="width: {{$project->rate}}%;"></span>
                            </div>

                            <!-- #info -->
                            <div class="info d-flex space-between gap-10">

                                <!-- #itm -->
                                <div class="inf-itm">
                                    <p class="inf-t gray-3 f-500 font-14">
                                        {{__('الهدف')}}
                                    </p>

                                    <p class="inf-d bold font-18">
                                        {{$project->target_amount}}
                                    </p>
                                </div>
                                <!-- ##itm -->

                                <!-- #itm -->
                                <div class="inf-itm center">
                                    <p class="inf-t gray-3 f-500 font-14">
                                        {{__('المدفوع')}}
                                    </p>

                                    <p class="inf-d bold font-18">
                                        {{$project->paid_amount}}
                                    </p>
                                </div>
                                <!-- ##itm -->

                                <!-- #itm -->
                                <div class="inf-itm center">
                                    <p class="inf-t gray-3 f-500 font-14">
                                        {{__('المتبقي')}}
                                    </p>

                                    <p class="inf-d bold font-18">
                                        {{$project->remaining_amount}}
                                    </p>
                                </div>
                                <!-- ##itm -->

                            </div>
                            <!-- ##info -->


                            <div class="amount_box d-flex pt-10 flex-all gap-10 gap-3-p align-center"
                                 amount-box-root="">

                                <button wire:click="increment" class="amount_btn btn-0">
                                    <!-- svg -->
                                </button>

                                <div class="amount-val flex-all black f-600 relative">

                                    <input wire:model="amount"
                                           type="number"
                                           class="amount-input no-arr full-el"
                                           value="{{$amount}}">

                                    <span>BHD</span>

                                    <span val-lbl="">
                                        {{$amount}}
                                    </span>

                                </div>

                                <button wire:click="decrement" class="amount_btn btn-0">
                                    <!-- svg -->
                                </button>

                            </div>

                        </div>

                        <div class="pt-25 zxc2">

                            <div class="proj-det-foot2 d-flex gap-15">

                                <button wire:click="addToCart(1)" class="btn w-100 btnxp">
                                    {{__('إتمام التبرع')}}
                                </button>

                                <button wire:click="addToCart" class="btn btn-outline-trans btn98">

                                    <!-- svg -->

                                    <span class="do-only">
                                        {{__('إضافة')}}
                                    </span>

                                </button>

                            </div>

                        </div>

                    </div>
                    <!-- ##left -->

                </div>
                <!-- ##item -->

            </div>
            <!-- #3box -->

        </div>

    </section>
    <!-- ##search section -->

</div>
