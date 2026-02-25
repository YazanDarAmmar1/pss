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
                            <p>من نحن</p>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <!-- ##breadcrumb -->

    <!-- #news details -->
    <section class="single-news-section section-padding-b">
        <div class="container">
            <div class="box d-flex">
                <div class="in w-100-p">
                    <h1 class="ggz main-color f-500 font-40 pb-20">
                        {{$this->news->name}}
                    </h1>
                    <div class="top-hd d-flex align-center gray-4 font-20 gap-25 pb-25">
                        <p class="x2 d-flex align-center gap-5">
                            <img src="{{asset('home-assets/images/calendar-red.svg')}}" width="20" />
                            <span>{{$news->date}}</span>
                        </p>
                    </div>
                    @php
                        $url = urlencode(route('news.details', ['news_id' => $news->id]));
                        $title = urlencode($news->name);
                    @endphp

                    <div class="share_social-box pt-30 pb-30 border-t d-flex align-center justify-end gap-15">
                        <span class="font-22">شارك الخبر:</span>
                        <div class="social_wrap d-flex gap-15">
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ $url }}" target="_blank">
                                <img src="{{ asset('home-assets/images/facebook1.png') }}" width="50" height="50" />
                            </a>
                            <a href="https://twitter.com/intent/tweet?text={{ $title }}&url={{ $url }}" target="_blank">
                                <img src="{{ asset('home-assets/images/twitter1.png') }}" width="50" height="50" />
                            </a>
                            <a href="mailto:?subject={{ $title }}&body={{ $url }}" target="_blank">
                                <img src="{{ asset('home-assets/images/share1.png') }}" width="50" height="50" />
                            </a>
                        </div>
                    </div>

                    <figure class="ff d-flex pb-40">
                        <img src="{{asset('storage/'.$news->image_path)}}" height="393" width="100%" class="object-fit radius-24" />
                    </figure>
                    <div class="desc">
                        <div class="cntnt pb-40">
                            {!! $news->description !!}
                        </div>

                        <div class="border-t pt-25 tags-more">



                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ##news details -->

    <!-- #cont -->
    <section class="join-our-porjs section-padding white">
        <div class="container">
            <div class="box">
                <div class="in bg-grad radius-24 center p-40 px-p">
                    <p class="t1 title-32 pb-25">ساهم في أحد مشاريعنا الأن</p>
                    <p class="d1 font-20 pb-25">كل مساهمة تصنع فرقاً في حياة عائلة فلسطينية محتاجة</p>
                    <div class="actions flex-all">
                        <a href="#" class="btn btn-white">تبرع الآن</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ##cont -->


    <!-- #related news -->
    <section class="related-news-section section-padding ">
        <div class="container">

            <div class="title-with-line">
                <span>أخبار ذات صلة</span>
            </div>

            <!-- #box -->
            <div class="box grid-3 grid-2-t grid-1-p pt-25">

                @foreach($otherNews as $item)
                    <!-- #item -->
                    <a href="{{route('news.details', $item->id)}}" class="related_news trans p-24 bg-white radius-24 gap-25 d-flex flex-column space-between">
                        <div class="u">
                            <figure class="dd relative d-flex mb-25">
                                <img src="{{asset('storage/'. $item->image_path)}}" width="100%" height="169" class="object-fit radius-12" />
                            </figure>
                            <p class="t1 main-color bold two-line">{{$item->name}}</p>
                            <p class="d44 gray-4 font-15 pt-10 one-line">
                                {{$item->short_description}}
                            </p>
                        </div>

                        <div class="dwn d-flex flex-column gap-15">
                            <div class="dw1 d-flex space-between font-14 gray-4 align-center">
                                <span class="czb f4">{{$item->date_human}}</span>
                            </div>
                            <div class="fd2 pt-15 border-t font-14">
                                <span class="text-grad d-flex align-center gap-10">
                                    اقرأ المزيد
                                    <img src="{{asset('home-assets/images/arrow-left.svg')}}" class="flip-en" />
                                </span>
                            </div>
                        </div>

                    </a>
                    <!-- ##item -->
                @endforeach
            </div>
            <!-- ##box -->
        </div>
    </section>
    <!-- ##related news -->
</div>
