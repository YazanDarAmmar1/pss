<div>
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
                            <p>المكتبة</p>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <section class="library-listing-section relative section-padding">

        <div class="container full-p">
            <div class="toggle-tabs toggle-tabs-mo theme-2  d-flex gap-15 pb-40">
                <button wire:click="filterByCategory(null)" class="toggle-tab-btn w-100 radius-30 no-wrap {{$category_id === null ? 'active' : ''}}">الكل</button>
                @foreach($this->book_category as $index => $category)
                    <button type="button" wire:click="filterByCategory({{ $category->id }})" class="toggle-tab-btn w-100 radius-30 no-wrap {{$category->id == $category_id ? 'active' : ''}}">
                        {{$category->name}}
                    </button>

                @endforeach
            </div>
            <div class="container-p">
                <!-- #search -->
                <div class="search-box-custom d-flex">
                    <input wire:model.live="search" class="search-input" type="text" placeholder="ابحث عن كتاب ...">
                    <button class="btn-0 search-custom-btn"><img src="{{asset('home-assets/images/search.svg')}}" width="20"></button>
                </div>
                <!-- ##search -->
            </div>
        </div>
        <div class="container">
            <div class="box grid-3 grid-2-t grid-1-p gap-40 pt-40">
                <!-- #project item -->
                    @foreach($this->books as $book_index => $book)
                    <div class="library_item_wrapper">

                    <a href="{{ asset('storage/' . $book->book_file_path) }}" target="_blank" class="library_item box_hover overflow-hidden h-100 radius-12 bg-white d-flex flex-column space-between gap-25">
                            <div class="xx d-flex flex-column gap-15 h-100">
                                <figure class="fig d-flex relative">
                                    <img src="{{asset('storage/'. $book->image_path)}}" class="object-fit w-100 img trans" width="100%" height="231">
                                    <div class="fff full-el d-flex align-end pb-15 px-15">
                                        <p class="lq bg-secondary main-color bold font-16 py-10 px-25 radius-30">{{$book->bookCategory?->name}}</p>
                                    </div>
                                </figure>
                                <div class="cntnt pt-15 px-15 h-100 d-flex flex-column space-between gap-15">
                                    <div class="up-up d-flex flex-column gap-15">
                                        <div class="psa">
                                            <div class="hh d-flex space-between align-center">
                                                <p class="tt1 bold font-20 one-line main-color">{{$book->name}}</p>
                                            </div>
                                            <p class="usr d-flex align-center gap-5 pt-5">
                                                <img src="{{asset('home-assets/images/user.svg')}}" class="shrink-0" />
                                                <span class="gray-4 czv">{{$book->author}}</span>
                                            </p>
                                            <p class="da font-18 four-line pt-10 gray-4 pt-15">
                                                {{$book->description}}
                                            </p>
                                        </div>
                                    </div>

                                </div>
                                <!-- ##cntnt -->
                            </div>

                            <!-- #foot -->
                            <div class="proj-foot d-flex gap-15 px-15 pb-15">
                                <button class="btn font-12 flex-1 justify-center">
                                    <img src="{{asset('home-assets/images/download.svg')}}" width="24" />
                                    تحميل
                                </button>
                            </div>
                            <!-- ##foot -->
                        </a>
                    </div>

                @endforeach
                <!-- ##project item -->

            </div>

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
    </section>
</div>
