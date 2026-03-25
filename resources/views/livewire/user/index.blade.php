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
                        <img class="flip-en" src="{{asset('home-assets/images/arrow-left.svg')}}" width="24"/>
                        <li>
                            <p>الملف الشخصي</p>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <!-- ##breadcrumb -->


    <!-- #profile -->
    <section class="profile-header-section section-padding pt-30-p pb-20-p">
        <div class="container">
            <!-- #box -->
            <div class="box w-100-p bg-white border-red radius-24 mx-auto pt-25 pb-25 px-40">
                <div class="actions mb-10 d-flex justify-end">
                    <a href="{{route('settings')}}" class="btn-0 flex-all">
                        <img src="{{asset('home-assets/images/edit-profile.svg')}}" width="32" height="32"/>
                    </a>
                </div>

                <figure class="fig flex-all mb-30">
                    <img src="{{Auth::user()->full_image_path}}" width="112" height="112"
                         class="object-fit img rounded"/>
                </figure>
                <div class="cntnt center">
                    <p class="zc bold font-24 pb-10">{{Auth::user()->name}}</p>
                    <p class="zc2 justify-center font-16 pb-10 d-flex align-center gap-5">
                        <img src="{{asset('home-assets/images/mail-2.svg')}}" width="16"/>
                        {{Auth::user()->email}}
                    </p>
                </div>
            </div>
            <!-- ##box -->
        </div>
    </section>
    <!-- ##profile -->

    <!-- #profile-tables -->
    <section class="profile-tables-section section-padding-t pb-80 pb-50-p">
        <div class="container">

            <!-- #box -->
            <div class="box">
                <!-- #tab1 -->
                <div class="profile-table-1">
                    <!-- #wrapper -->
                    <div class="profile-table-box bg-white border-red radius-24 mb-40 mb-20-p">
                        <div class="profile-head-with-filters" x-data="{ open: false }">
                            <!-- #head -->
                            <div class="profile-table-head d-flex align-center space-between py-15 px-30 px-15-p gap-40 gap-10-p">
                                <!-- #right -->
                                <div class="head-right shrink-0 d-flex align-center gap-15 gap-7-p">
                                    <img src="{{ asset('home-assets/images/solar-card.svg') }}" width="40" height="40" class="asdz"/>
                                    <p class="zxcq12 black font-24 font-16-p f-600">تبرعاتي السابقة</p>
                                </div>
                                <!-- ##right -->

                                <div class="search-with-filters-wrap d-flex gap-15 gap-5-p">
                                    <button @click="open = !open"
                                            class="filters-btn-profile gray-5 font-18 d-flex align-center gap-15"
                                            :class="{ 'active': open }">
                                        <span class="do-only">البحث</span>
                                        <img class="trans do-only"
                                             :style="open ? 'transform: rotate(180deg)' : ''"
                                             src="{{ asset('home-assets/images/chev-down.svg') }}" width="14" height="14"/>
                                        <img class="trans mo-only"
                                             src="{{ asset('home-assets/images/filters-red.svg') }}" width="24" height="24"/>
                                    </button>
                                </div>
                            </div>
                            <!-- ##head -->

                            <!-- #filters row -->
                            <div x-show="open"
                                 x-transition
                                 class="filters-profile-row">
                                <div class="wrap-filters-types d-flex flex-column gap-10 px-30 px-15-p">
                                    <!-- #type1 -->
                                    <div class="bbbbb1 grid-4 grid-2-t gap-15 pt-30 pb-30">

                                        <!-- تاريخ -->
                                        <div class="filter-item">
                                            <div class="input-with-icon relative">
                                                <input wire:model.live="filterDate"
                                                       type="date"
                                                       class="form-control-with-icon dark">
                                                <img class="icn" src="{{ asset('home-assets/images/date-icon.svg') }}" width="24" height="24"/>
                                            </div>
                                        </div>

                                        <!-- طريقة الدفع -->
                                        <div class="filter-item">
                                            <div class="input-with-icon relative">
                                                <select wire:model.live="filterPaymentMethod" class="form-control-with-icon dark">
                                                    <option value="">جميع طرق الدفع</option>
                                                    @foreach($this->paymentMethods as $method)
                                                        <option value="{{ $method->value }}">{{ $method->label() }}</option>
                                                    @endforeach
                                                </select>
                                                <img class="icn" src="{{ asset('home-assets/images/payments-icon.svg') }}" width="24" height="24"/>
                                            </div>
                                        </div>

                                    </div>
                                    <!-- ##type1 -->
                                </div>
                            </div>
                            <!-- ##filters row -->

                        </div>

                    </div>
                    <!-- ##wrapper -->

                    <div class="table-here border-red radius-24 overflow-hidden">
                        <div class="table-responsive">
                            <!-- #table -->
                            <table class="table-soft table-body-white">
                                <thead>
                                <tr>
                                    <th class="center">تاريخ التبرع</th>
                                    <th class="center">المبلغ</th>
                                    <th class="center">طريقة الدفع</th>
                                    <th class="center">إجراء</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($receipts as $receipt)
                                    <tr>
                                        <td>{{$receipt->date}}</td>
                                        <td class="bold">BHD {{$receipt->amount}}</td>
                                        <td>{{$receipt->payment_method->label()}}</td>

                                        <td width="1">
                                            <div class="table-actions flex-all">
                                                <button wire:click="viewReceipt({{ $receipt->id }})"
                                                        class="bg-secondary show-btn bold py-10 px-25 radius-30 border-0 flex-all gap-10">
                                                    <span class="text-grad do-only">عرض</span>
                                                    <img src="{{ asset('home-assets/images/eye-red.svg') }}" width="17" height="17" class="zzzzq1">
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <!-- ##table -->
                            @if(count($receipts) > 10)
                                <!-- #foot -->
                                <div class="table-options py-15 px-20 px-5-p bg-white d-flex justify-center">
                                    {{$receipts->links('vendor.livewire.custom-pagination')}}
                                </div>
                                <!-- ##foot -->
                            @endif
                        </div>
                    </div>


                </div>
                <!-- ##tab1 -->
            </div>
            <!-- ##box -->
        </div>
    </section>
    <!-- ##profile-tables -->

    {{-- Modal --}}
    @if($selectedReceipt)
        <div class="modal active" x-data @click.self="$wire.closeReceipt()"
             style="display: flex; align-items: center; justify-content: center;background: rgba(0,0,0,0.4);">
            <div class="modal-body-wrapper">
                <div class="modal-body relative z-1 bg-white radius-24 pt-40 pb-40 px-40">

                    <button wire:click="closeReceipt" class="cls-modal flex-all btn-0">
                        <img src="{{ asset('home-assets/images/close.svg') }}" width="32" height="32">
                    </button>

                    <p class="black bold font-22 pb-25">تفاصيل الإيصال</p>

                    <div class="d-flex flex-column gap-15 pb-25">
                        <div class="d-flex space-between gap-10">
                            <span class="gray-4">رقم الإيصال</span>
                            <span class="bold">{{ $selectedReceipt->no }}</span>
                        </div>
                        <div class="d-flex space-between gap-10">
                            <span class="gray-4">التاريخ</span>
                            <span class="bold">{{ $selectedReceipt->date }}</span>
                        </div>
                        <div class="d-flex space-between gap-10">
                            <span class="gray-4">طريقة الدفع</span>
                            <span class="bold">{{ $selectedReceipt->payment_method->label() }}</span>
                        </div>
                    </div>

                    <div class="hr mb-25"></div>

                    {{-- المشاريع --}}
                    <p class="black bold font-18 pb-15">المشاريع</p>
                    <div class="d-flex flex-column gap-10">
                        @foreach($selectedReceipt->invoice?->items ?? [] as $item)
                            <div class="d-flex align-center space-between gap-15 bg-secondary p-16 radius-16">
                                <div class="d-flex align-center gap-10">
                                    <img src="{{ $item->project->image_full_path }}" width="40" height="40"
                                         style="border-radius: 8px; object-fit: cover;">
                                    <span class="bold">{{ $item->project->name }}</span>
                                </div>
                                <span class="text-grad bold">{{ $item->amount }} BHD</span>
                            </div>
                            <br/>
                        @endforeach
                    </div>

                    <div class="hr my-25"></div>

                    <div class="d-flex space-between align-center">
                        <span class="black bold font-20">الإجمالي</span>
                        <span class="text-grad bold font-24">{{ $selectedReceipt->amount }} BHD</span>
                    </div>

                </div>
            </div>
        </div>
    @endif
</div>
