<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8"/>
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />

    <!-- الحل الأساسي لمنع /ar/livewire/update -->
    <meta name="livewire:asset-url" content="{{ url('/') }}">

    <link rel="shortcut icon" href="{{asset('home-assets/image/favicon.ico')}}" type="image/x-icon">
    <title>Pss</title>

    <!-- fonts -->
    <link rel="stylesheet" href="{{asset('home-assets/fonts/stylesheet.css')}}"/>
    <!-- swiper -->
    <link rel="stylesheet" href="{{asset('home-assets/css/swiper-bundle.min.css')}}"/>
    <!-- intl -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.13/css/intlTelInput.css" rel="stylesheet">
    <!-- nice select -->
    <link rel="stylesheet" href="{{asset('home-assets/css/nice-select.css')}}"/>
    <!-- custom styles -->
    <link rel="stylesheet" href="{{asset('home-assets/css/common.css')}}"/>
    <link rel="stylesheet" href="{{asset('home-assets/css/style.css')}}"/>

    @stack('css')
    @livewireStyles
</head>

<body class="lang-{{ app()->getLocale() }}">
<livewire:layouts.home.header/>

{{ $slot }}

<livewire:layouts.home.footer/>

<button class="go-up-btn" go-up-btn>
    <img src="{{asset('home-assets/images/arrow-up.svg')}}" width="34" />
</button>

<script src="{{asset('home-assets/js/jquery.js')}}"></script>
<script src="{{asset('home-assets/js/jquery.nice-select.min.js')}}"></script>
<script src="{{asset('home-assets/js/swiper-bundle.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.13/js/intlTelInput-jquery.min.js"></script>
<script src="{{asset('home-assets/js/jscript.js')}}"></script>
<script src="{{asset('home-assets/js/app.js')}}"></script>

@livewireScripts

@include('modals.home')
@stack('js')
</body>
</html>
