<section class="news-section section-padding">
    <div class="container">

        <div class="head d-flex align-center wrap space-between">
            <div class="title-with-line">
                <span>الأخبار</span>
            </div>
            <a class="text-grad f-500 font-24-p" href="#">الكل</a>
        </div>

        @if($news)
            @php
                $firstNews = $news->first();
                $otherNews = $news->skip(1);
            @endphp
            @if($firstNews)
                <div class="box box1 pt-30">
                    <a href="{{route('news.details', $firstNews->id)}}"
                       class="item item-1 pb-40 d-flex flex-column-p gap-50 gap-40-p body-color">
                        <figure class="fig d-flex shrink-0 w-50 w-100-p">
                            <img src="{{ asset('storage/' . $firstNews->image_path) }}" class="object-fit radius-24"
                                 width="100%" height="297"/>
                        </figure>
                        <div class="lft-side pt-25 w-47 w-100-p">
                            <p class="tz1 title-28 pb-15">{{ $firstNews->name }}</p>
                            <div class="dd font-22">{{ $firstNews->short_description }}</div>
                            <p class="timesz gray-1 font-20 pt-15">{{ $firstNews->date_human }}</p>
                            <div class="btns d-flex pt-40">
                    <span class="cz d-flex align-center gap-20 font-24-p main-color">
                        المزيد..
                        <img src="{{asset('home-assets/images/arrow-left.svg')}}" width="24" class="flip-en"/>
                    </span>
                            </div>
                        </div>
                    </a>
                </div>
            @endif


            <div class="box do-only box2 grid-2 grid-1-p gap-50 pt-40">
                @foreach($otherNews as $newsItem)
                    <a href="{{route('news.details', $newsItem->id)}}"
                       class="item item-2 d-flex gap-50 body-color flex-column-p">
                        <figure class="fig d-flex shrink-0 w-50 w-100-p">
                            <img src="{{ asset('storage/' . $newsItem->image_path) }}" class="object-fit radius-24"
                                 width="234" height="234"/>
                        </figure>
                        <div class="lft-side pt-15 w-47 w-100-p">
                            <p class="tz1 bold font-18 pb-15">{{ $newsItem->name }}</p>
                            <div class="dd font-16 two-line">{{ $newsItem->short_description }}</div>
                            <p class="timesz gray-1 font-16 pt-15">{{ $newsItem->date_human }}</p>
                            <div class="btns d-flex pt-40">
                        <span class="cz d-flex align-center gap-20 main-color font-16">المزيد..
                            <img src="{{asset('home-assets/images/arrow-left.svg')}}" width="24" class="flip-en"/>
                        </span>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        @endif


    </div>
</section>
