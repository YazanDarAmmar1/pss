<section class="our-projects-humans section-padding">
    <div class="container full-p">

        <div class="head flex-all container-p">
            <div class="title-with-line">
                <span>مشاريعنا الإنسانية</span>
            </div>
        </div>

        <!-- #box -->
        <div class="box grid-4 grid-2-t grid-1-p gap-40 pt-25 container-left-p">
            @foreach($categories as $category)
                <!-- #itm -->
                <a href="#" class="itm px-15 body-color py-25 relative d-flex gap-30 flex-column space-between radius-24 trans">
                    <span class="bg pointer-none full-el radius-24"></span>
                    <div class="up relative">
                        <figure class="fig d-flex pb-15">
                            <img src="{{ asset($category->image_path) }}" class="object-fit radius-24" width="100%" height="207" />
                        </figure>
                        <p class="cz center title-28">{{$category->name}}</p>
                    </div>
                    <div class="btns flex-all px-40 relative">
                        <span class="btn sp">تعرف على المزيد</span>
                    </div>
                </a>
                <!-- ##itm -->
            @endforeach
        </div>
        <!-- ##box -->
    </div>
</section>
