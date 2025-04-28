@extends('frontend.layouts.master')
@section('title','Himgiri Collection')
@section('description', 'Best Kitchen Retail Store in Varanasi now goes Online')
@section('keywords', 'Best Kitchen Retail Store in Varanasi now goes Online')
@section('main-content')
<!-- Breadcrumb -->
<div class="tf-breadcrumb space-t">
    <div class="container">
        <ul class="breadcrumb-list">
            <li class="item-breadcrumb">
                <a href="{{ url('/') }}" class="text">Home</a>
            </li>

            <li class="item-breadcrumb dot">
                <span></span>
            </li>
            <li class="item-breadcrumb">
                <span class="text">About Us</span>
            </li>
        </ul>
    </div>
</div>
<!-- /Breadcrumb -->
<section class="flat-spacing-3 pb-0 about-us-top">
    <div class="container">
        <div class="flat-title-2 d-xl-flex justify-content-xl-between">
            <div class="box-title">
                <h1 class="about-ush1">
                    Welcome to Himgiri
                </h1>
                <p class="text-xl">
                    Your Cooling & Storage Solution
                </p>
            </div>
            <div class="box-text">
                <p class="text-md text-main">
                    At <span class="fw-medium">Himgiri</span>, we make strong almirahs and powerful air coolers that are easy to<br> use and built to last. Our products are made for homes and  shops that <br>need comfort, safety, and simple design.

                </p>
            </div>
        </div>
    </div>
</section>
<section class="flat-spacing-3 about-us-bottom">
    <div class="container">
        <div class="about-page-img">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="flat-title-2">
                        <h2 class="about-us-h2">
                            Why Choose Himgiri ?
                        </h2>
                        <p class="text-md text-main">
                            Our air coolers and almirahs are made with smart design and everyday needs in mind. We mix strong build with modern style to give you products that are useful, comfortable, and easy to rely on.
                        </p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="image radius-16 overflow-hidden w-100 h-100">
                        <img src="{{ asset('frontend/assets/himgiri-img/about-us-page.jpg') }}" data-src="{{ asset('frontend/assets/himgiri-img/about-us-page.jpg') }}" alt="about" class="w-100 h-100 object-fit-cover ls-is-cached lazyloaded">
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-6 col-md-6">
                <ul class="list-esd d-md-flex flex-md-column justify-content-md-center h-100 about-us-ul">
                    <li class="item">
                        <h6>
                            Care & Quality
                        </h6>
                        <p class="text-md text-main">
                            At Himgiri, we follow simple and honest methods to make our products. We focus on safe materials, careful checks, and thoughtful designs that work well for homes, shops, and offices.
                        </p>
                    </li>
                    <li class="item">
                        <h6>
                            Smart Design, Strong Build
                        </h6>
                        <p class="text-md text-main">
                            Whether it’s cool air in summer or safe storage every day, Himgiri products are made to last. We balance comfort and strength to fit right into your space and lifestyle.
                        </p>
                    </li>
                    <li class="item">
                        <h6>
                            Comfort and Convenience
                        </h6>
                        <p class="text-md text-main">
                            Our coolers bring fresh air to your space, while our almirahs help you stay organised. Himgiri gives you products that are easy to use and fit perfectly into your home or shop.
                        </p>
                    </li>
                    
                </ul>
            </div>
            <div class="col-xl-6 col-md-6">
                <ul class="list-esd d-md-flex flex-md-column justify-content-md-center h-100 about-us-ul">
                    
                    <li class="item">
                        <h6>
                            Strong Build, Neat Finish
                        </h6>
                        <p class="text-md text-main">
                        We use quality materials and careful work to make sure each product is strong, safe, and lasts long. Every detail is made with care and purpose.

                        </p>
                    </li>
                    <li class="item">
                        <h6>
                        Simple, Useful, Reliable
                        </h6>
                        <p class="text-md text-main">
                        Himgiri products are made for real life. Whether it's cool air or organized storage, we focus on what matters most—easy use and lasting value.
                        </p>
                    </li>
                    <li class="item">
                        <h6>
                            Made for Every Space
                        </h6>
                        <p class="text-md text-main">
                            From small rooms to large shops, our coolers and almirahs fit in anywhere. At Himgiri, we believe everyone deserves comfort and convenience.
                        </p>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>

@endsection
@push('scripts')

@endpush