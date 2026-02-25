<div>
    <!-- #breadcrumb -->
    <nav class="breadcrumb-box">
        <div class="container">
            <div class="bxp d-flex space-between flex-column-p gap-20 gap-65-p">
                <div class="right-side">
                    <ul class="list-none breadcrumb-in d-flex wrap gap-15">
                        <li>
                            <a class="body-color to-color" href="#">الرئيسية</a>
                        </li>
                        <img class="flip-en" src="layout/images/arrow-left.svg" width="24" />
                        <li>
                            <p>من نحن</p>
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
                    <button class="btn-0 flex-all">
                        <img src="layout/images/edit-profile.svg" width="32" height="32" />
                    </button>
                </div>

                <figure class="fig flex-all mb-30">
                    <img src="layout/images/news.jpg" width="112" height="112" class="object-fit img rounded" />
                </figure>
                <div class="cntnt center">
                    <p class="zc bold font-24 pb-10">محمد أحمد</p>
                    <p class="zc2 justify-center font-16 pb-10 d-flex align-center gap-5"><img src="layout/images/mail-2.svg" width="16" />mohamed@example.com</p>
                    <p class="zc3 black center f-600 font-16">عضو منذ : ٣ مارس</p>
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
                        <div class="profile-head-with-filters">
                            <!-- #head -->
                            <div class="profile-table-head d-flex align-center space-between py-15 px-30 px-15-p gap-40 gap-10-p">
                                <!-- #right -->
                                <div class="head-right shrink-0 d-flex align-center gap-15 gap-7-p">
                                    <img src="layout/images/solar-card.svg" width="40" height="40" class="asdz" />
                                    <p class="zxcq12 black font-24 font-16-p f-600">تبرعاتي السابقة</p>
                                </div>
                                <!-- ##right -->
                                <div class="search-with-filters-wrap d-flex gap-15 gap-5-p">
                                    <button toggle-filters-profile="controls" class="filters-btn-profile gray-5 font-18 d-flex align-center gap-15">
                                        <span class="do-only">الفلاتر</span>
                                        <img class="trans do-only" src="layout/images/chev-down.svg" width="14" height="14" />
                                        <img class="trans mo-only" src="layout/images/filters-red.svg" width="24" height="24" />
                                    </button>

                                </div>
                            </div>
                            <!-- ##head -->

                            <!-- #filters row -->
                            <div style="display: none;" filters-profile-row class="filters-profile-row">
                                <div class="wrap-filters-types d-flex flex-column gap-10 px-30 px-15-p">
                                    <!-- #type1 -->
                                    <div type="controls" style="display: none;" class="bbbbb1 grid-4 grid-2-t gap-15 pt-30 pb-30">
                                        <!-- #itm -->
                                        <div class="filter-item">
                                            <div class="input-with-icon relative">
                                                <select class="form-control-with-icon dark">
                                                    <option value="">اختر تاريخ</option>
                                                    <option value="">الكل</option>
                                                    <option value="">الكل</option>
                                                </select>
                                                <img class="icn" src="layout/images/date-icon.svg" width="24" height="24" />
                                            </div>
                                        </div>
                                        <!-- ##itm -->
                                        <!-- #itm -->
                                        <div class="filter-item">
                                            <div class="input-with-icon relative">
                                                <select class="form-control-with-icon dark">
                                                    <option value="">اختر المبلغ المدفوع</option>
                                                    <option value="">الكل</option>
                                                    <option value="">الكل</option>
                                                </select>
                                                <img class="icn" src="layout/images/money-icon.svg" width="24" height="24" />
                                            </div>
                                        </div>
                                        <!-- ##itm -->
                                        <!-- #itm -->
                                        <div class="filter-item">
                                            <div class="input-with-icon relative">
                                                <select class="form-control-with-icon dark">
                                                    <option value="">جميع طرق الدفع</option>
                                                    <option value="">الكل</option>
                                                    <option value="">الكل</option>
                                                </select>
                                                <img class="icn" src="layout/images/payments-icon.svg" width="24" height="24" />
                                            </div>
                                        </div>
                                        <!-- ##itm -->
                                        <!-- #itm -->
                                        <div class="filter-item">
                                            <div class="input-with-icon relative">
                                                <select class="form-control-with-icon dark">
                                                    <option value="">جميع الحالات</option>
                                                    <option value="">الكل</option>
                                                    <option value="">الكل</option>
                                                </select>
                                                <img class="icn" src="layout/images/status-icon.svg" width="24" height="24" />
                                            </div>
                                        </div>
                                        <!-- ##itm -->

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
                                    <th class="center">الحالة</th>
                                    <th class="center">إجراء</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>2025-07-01</td>
                                    <td class="bold">BHD 50</td>
                                    <td>بطاقة بنكية</td>
                                    <td>
                                        <span class="bold do-only text-green">ناجحة</span>
                                        <img class="mo-only" src="layout/images/check-green-circle.svg" width="20" />
                                    </td>
                                    <td width="1">
                                        <div class="table-actions flex-all">
                                            <button class="bg-secondary show-btn bold py-10 px-25 radius-30 border-0 flex-all gap-10">
                                                <span class="text-grad do-only">عرض</span>
                                                <img src="layout/images/eye-red.svg" width="17" height="17" class="zzzzq1">
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            <!-- ##table -->
                            <!-- #foot -->
                            <div class="table-options py-15 px-20 px-5-p bg-white d-flex justify-center">
                                <!-- #pagination -->
                                <div class="pagination wrap flex-all gap-15">
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
                            <!-- ##foot -->
                        </div>
                    </div>


                </div>
                <!-- ##tab1 -->
            </div>
            <!-- ##box -->
        </div>
    </section>
    <!-- ##profile-tables -->
</div>
