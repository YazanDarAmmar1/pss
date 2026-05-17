<div class="project_item_wrapper">

    <!-- #item -->
    <div class="project_item border-red h-100 p-16 radius-12 bg-white d-flex flex-column space-between gap-25">

        <div class="proj_up d-flex flex-column gap-15 h-100">

            <figure class="fig d-flex relative">

                <img src="{{asset($project->image_path)}}"
                     class="object-fit w-100 img trans radius-12"
                     width="100%"
                     height="156">

                <div class="fff full-el d-flex align-end pb-15 px-15">

                    <p class="lq bg-white main-color bold font-16 py-10 px-25 radius-30">
                        {{$project->category?->name}}
                    </p>

                </div>

            </figure>

            <div class="cntnt h-100 d-flex flex-column space-between gap-15">

                <div class="up-up d-flex flex-column gap-15">

                    <div class="psa">

                        <div class="hh d-flex space-between align-center">

                            <a href="{{route('projects.details', $project->no)}}"
                               class="tt1 bold font-20 one-line main-color">

                                {{$project->name}}

                            </a>

                            <div class="share-action-svg pointer flex-all"
                                 share="link_url_here"
                                 share-title="share_title_here"
                                 data-toggle="tooltip"
                                 click=""
                                 data-title="{{__('تم نسخ الرابط')}}">

                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="18" viewBox="0 0 20 18" fill="none">
                                    <path d="M8.1141 1.49063C8.1902 0.695502 9.0203 0.0412322 9.8571 0.518072C11.597 1.53724 13.2394 2.69776 14.8271 3.94C16.7862 5.48702 18.3603 6.94657 19.4737 8.11191C19.9575 8.61841 19.9118 9.41951 19.4496 9.90321C18.3535 11.0499 17.1732 12.1167 15.9553 13.1316C14.0168 14.7183 12.0104 16.2565 9.8253 17.4897C9.08378 17.9079 8.28121 17.4296 8.13795 16.6886L8.1215 16.5755L7.894 13.0015C6.07832 13.0397 4.31999 13.6639 2.91368 14.8242L2.64911 15.0468C2.60595 15.0822 2.56327 15.1168 2.52106 15.1506L2.27354 15.3427C2.23325 15.373 2.19344 15.4023 2.15412 15.4307L1.92411 15.5899C1.84941 15.6391 1.7767 15.6844 1.70601 15.7256L1.50004 15.8369C0.534113 16.3136 0 15.8918 0 13.9995C0 9.59537 3.24521 5.67693 7.63167 5.08258L7.891 5.05147L8.1141 1.49063ZM10.0229 2.96475L9.8314 6.4366C9.8178 6.68177 9.6283 6.88084 9.3841 6.90635L8.0227 7.04861C4.95767 7.41431 2.52633 9.81061 2.0752 12.9427C3.56496 11.8451 5.33483 11.1772 7.21039 11.0303L7.60656 11.0071L9.311 10.9711C9.5806 10.9655 9.8061 11.1745 9.8208 11.4437L10.0177 15.0392C11.6209 14.0181 13.1491 12.8437 14.6817 11.5896C15.6714 10.7645 16.6261 9.90311 17.5391 8.99411L17.2812 8.73892L16.7253 8.20543C15.8517 7.38345 14.8006 6.46763 13.5911 5.51236C12.4254 4.60048 11.2427 3.74465 10.0229 2.96475Z" fill="#000"/>
                                </svg>

                            </div>

                        </div>

                        <p class="da font-18 one-line pt-10 gray-4">
                            {{$project->short_description}}
                        </p>

                    </div>

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

                            <p class="inf-d bold font-18 black">
                                {{$project->target_amount}}
                            </p>
                        </div>
                        <!-- ##itm -->

                        <!-- #itm -->
                        <div class="inf-itm center">
                            <p class="inf-t gray-3 f-500 font-14">
                                {{__('المدفوع')}}
                            </p>

                            <p class="inf-d bold font-18 black">
                                {{$project->paid_amount}}
                            </p>
                        </div>
                        <!-- ##itm -->

                        <!-- #itm -->
                        <div class="inf-itm center">
                            <p class="inf-t gray-3 f-500 font-14">
                                {{__('المتبقي')}}
                            </p>

                            <p class="inf-d bold font-18 black">
                                {{$project->remaining_amount}}
                            </p>
                        </div>
                        <!-- ##itm -->

                    </div>
                    <!-- ##info -->

                    <div class="amount_box d-flex pt-10 flex-all gap-10 gap-3-p align-center" amount-box-root="">

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

            </div>
            <!-- ##cntnt -->

        </div>

        <!-- #foot -->
        <div class="proj-foot d-flex gap-15">

            <button wire:click="addToCart(1)"
                    class="btn font-12 flex-1 justify-center">

                {{__('إتمام التبرع')}}

            </button>

            <button type="button"
                    wire:click="addToCart"
                    class="btn btn-white img-inside-on-hover font-12 radius-30 justify-center">

                <!-- svg -->

                {{__('إضافة')}}

            </button>

        </div>
        <!-- ##foot -->

    </div>
    <!-- ##item -->

</div>
