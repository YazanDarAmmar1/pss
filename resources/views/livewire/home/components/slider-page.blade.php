<section wire:ignore class="landing-section section-padding-b overflow-hidden relative" slider-section>
    <div class="h-100 container relative overflow-hidden relative">
        <div class="landing-slider h-100" dynamic-slider space-between="50">
            <div class="swiper-wrapper" equal-height>
                @foreach($sliders as $slider)
                    <div class="swiper-slide relative">
                        <div class="containerxxx relative h-100">
                            <!-- #box -->
                            <div class="box radius-24 relative pt-40 pb-60 d-flex align-center h-100 radius-16-p overflow-hidden">
                                <img src="{{ asset('storage/' . $slider->image_path) }}" class="object-fit full-el" />
                                <span class="bg full-el"></span>
                                <!-- <span class="full-el bg"></span> -->
                                <!-- #in -->
                                <div class="in white  relative z-1">
                                    <h1 class="land-tt font-24-p bold font-40 pb-10">{{$slider->name}}</h1>
                                    <p class="land-dd f-500 gray br-0-p font-24 font-14-p pb-20 pb-40-p two-line">
                                        {{$slider->description}}
                                    </p>
                                    <div class="actions d-flex gap-30 gap-15-p">
                                        @if($slider->first_button_visibility)
                                            <a href="{{$slider->first_button_link}}" class="btn b1">{{$slider->first_button_text}}</a>
                                        @endif
                                        @if($slider->first_button_visibility)
                                            <a href="{{$slider->second_button_link}}" class="btn btn-outline no-wrap">{{$slider->second_button_text}}</a>
                                        @endif
                                    </div>
                                </div>
                                <!-- ##in -->
                            </div>
                            <!-- ##box -->
                        </div>

                    </div>
                @endforeach
            </div>
        </div>
        <div class="swiper-custom-pagination flex-all gap-15"></div>

        <button class="slider-arrow slider-arrow-white do-only bg-white rounded lt-slide flex-all btn-0" arrow-right>
            <img src="{{asset('home-assets/images/chev-right.svg')}}" width="50" height="auto" />
        </button>
        <button class="slider-arrow slider-arrow-white do-only bg-white rounded rt-slide flex-all btn-0" arrow-left>
            <img class="flip" src="{{asset('home-assets/images/chev-right.svg')}}" width="50" height="auto" />
        </button>
    </div>
</section>
