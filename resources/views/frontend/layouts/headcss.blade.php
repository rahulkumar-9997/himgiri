<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
@yield('meta')
<meta name="description" content="@yield('description')">
<meta name="keywords" content="@yield('keywords')">
<link rel="canonical" href="{{ url()->current() }}" />
<meta name="base-url" content="{{ url('/') }}">
<meta name="author" content="Himgiri">
<meta name="csrf-token" content="{{ csrf_token() }}" />
<title>@yield('title')</title>
<link rel="stylesheet" href="{{asset('frontend/assets/fonts/fonts.css')}}">
<link rel="stylesheet" href="{{asset('frontend/assets/fonts/font-icons.css')}}">
<!-- css -->
<link rel="stylesheet" href="{{asset('frontend/assets/css/bootstrap.min.css')}}">
<link rel="stylesheet" href="{{asset('frontend/assets/css/swiper-bundle.min.css')}}">
<link rel="stylesheet" href="{{asset('frontend/assets/css/animate.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('frontend/assets/css/styles.css')}}">
<!-- Favicon and Touch Icons  -->
<link rel="shortcut icon" href="{{asset('frontend/assets/himgiri-img/logo/fav-icon.png')}}">
<link rel="apple-touch-icon-precomposed" href="{{asset('frontend/assets/himgiri-img/logo/fav-icon.png')}}">
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-NRRR0WX8VP"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', 'G-NRRR0WX8VP');
</script>

