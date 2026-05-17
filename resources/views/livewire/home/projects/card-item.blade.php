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

                                <!-- svg -->

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
