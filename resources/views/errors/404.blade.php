<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <title>404 page</title>
    <link rel="stylesheet" href="{{ asset('home-assets/css/common.css') }}"/>
    <link rel="stylesheet" href="{{ asset('home-assets/css/style.css') }}"/>
</head>
<body class="lang-{{ app()->getLocale() }}">
<livewire:layouts.home.header/>

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
                        <p>404</p>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
<!-- ##breadcrumb -->


<!-- #sub-success -->
<section class="error-section section-padding-b">
    <div class="container">
        <!-- #box -->
        <div class="box center mx-auto">
            <figure class="flex-all ff pb-30">
                <img src="{{asset('home-assets/images/404.png')}}" width="288"/>
            </figure>
            <p class="tt main-color text-grad title-32 pb-10">عذراً، الصفحة غير موجودة</p>
            <p class="dd gray-4 font-24">قد يكون المسار مقطوعا، ولكن الطريق إلى فلسطين مفتوح دائماً ..</p>

        </div>
        <br/>
        <!-- ##box -->
        <div class="flex-all flex-column">
            <a href="{{ route('home') }}" class="btn px-40">العودة للرئيسية</a>
        </div>

    </div>
</section>
<!-- ##sub-success -->
<livewire:layouts.home.footer/>

</body>
</html>
