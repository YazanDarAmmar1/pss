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
                        <img class="flip-en" src="{{asset('home-assets/images/arrow-left.svg')}}" width="24" />
                        <li>
                            <p>أخبارنا</p>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <!-- ##breadcrumb -->

    <!-- #news-all section -->
    <section class="news-all-section section-padding-b">
        <div class="container">

            <!-- #box -->
            <div class="box">
                <!-- #wrapper -->
                <div class="wrapper-only d-flex flex-column gap-25">
                    @foreach($news as $new)
                        <!-- #item -->
                        <a href="{{route('news.details', $new->id)}}" class="news_item border-red radius-12 p-32 px-p d-flex gap-40 flex-column-p gap-40 bg-white">
                            <!-- #right -->
                            <div class="right d-flex align-self shrink-0 w-100-p relative" style="width: 348px;">
                                <img src="{{ asset('storage/' . $new->image_path) }}" class="object-fit radius-12 img w-100" width="270" height="295">
                            </div>
                            <!-- ##right -->
                            <!-- #left -->
                            <div class="left d-flex flex-column space-between flex-1 w-100-p">
                                <div class="uu">
                                    <div class="psa pb-10">
                                        <div class="hh d-flex space-between align-center gap-5">
                                            <p class="tt1 bold font-20 main-color">{{$new->name}}</p>
                                        </div>
                                    </div>
                                    <p class="da font-18 mb-25 two-line gray-4">{{$new->short_description}}</p>
                                </div>
                                <div class="dwn d-flex flex-column gap-25">
                                    <div class="dw1 d-flex space-between gray-4 align-center">
                                        <span class="czb f4">{{$new->DateHuman}}</span>
                                    </div>
                                    <div class="fd2 pt-25 border-t">
                                        <span class="text-grad d-flex align-center gap-10">
                                            اقرأ المزيد
                                            <img src="{{asset('home-assets/images/arrow-left.svg')}}" class="flip-en" />
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <!-- ##left -->
                        </a>
                        <!-- ##item -->
                    @endforeach

                </div>
                <!-- ##wrapper -->

                <!-- #pagination -->
                <div class="pagination wrap flex-all gap-15 pt-40 pt-30-p">
                    <a href="#" class="btn-0 pagination-arr flex-all disabled"><img class="flip-ar" src="layout/images/chev-left.svg" width="20" height="20"></a>
                    <a href="#" class="pagination-item flex-all active">1</a>
                    <a href="#" class="pagination-item flex-all">2</a>
                    <a href="#" class="pagination-item flex-all">3</a>
                    <a href="#" class="pagination-item flex-all">4</a>
                    <a href="#" class="pagination-item flex-all">5</a>
                    <a href="#" class="btn-0 pagination-arr flex-all"><img class="flip-en" src="layout/images/chev-left.svg" width="20" height="20"></a>
                </div>
                <!-- ##pagination -->

            </div>
            <!-- #3box -->
        </div>
    </section>
    <!-- ##search section -->
</div>
