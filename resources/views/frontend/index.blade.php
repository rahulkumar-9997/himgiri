@extends('frontend.layouts.master')
@section('title','Himgiri Online Store')
@section('description', 'Best Coolrs Store in Varanasi now goes Online')
@section('keywords', 'BestCoolrs Store in Varanasi now goes Online')
@section('main-content')
@if (!empty($data['banner']) && $data['banner']->isNotEmpty())
    @if (isset($_SERVER['HTTP_USER_AGENT']) && preg_match('/(android|iphone|ipod|mobile)/i', strtolower($_SERVER['HTTP_USER_AGENT'])))
        <!--For mobile only-->
        <section class="tf-slideshow slider-default home-slider">
            <div class="swiper tf-sw-slideshow slider-effect-fade" data-preview="1" data-tablet="1" data-mobile="1"
                data-centered="false" data-space="0" data-space-mb="0" data-loop="true" data-auto-play="true"
                data-effect="fade">
                <div class="swiper-wrapper">
                    @foreach ($data['banner'] as $banner)
                    <div class="swiper-slide">
                        <div class="slider-wrap">
                            <a href="{{ $banner->link_desktop }}">
                                <div class="image">
                                    <img src="{{ asset('images/banners/'.$banner->image_path_mobile) }}"
                                        data-src="{{ asset('images/banners/' . $banner->image_path_mobile) }}"
                                        alt="{{ $banner->title ?? 'slider' }}" class="lazyload">
                                </div>
                            </a>
                            @if (!empty($banner->title))
                            <div class="box-content">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="content-slider text-center">
                                                <div class="box-title-slider">
                                                    <h2 class="heading display-xl-2 text-white fw-medium fade-item fade-item-1 font-2">
                                                        {{ $banner->title }}
                                                    </h2>
                                                </div>
                                                @if (!empty($banner->link))
                                                <div class="box-btn-slider fade-item fade-item-3">
                                                    <a href="{{ $banner->link }}"
                                                        class="tf-btn btn-large fw-normal btn-yellow font-2 rounded-0 animate-btn">
                                                        Shop Collection <i class="icon icon-arr-right"></i>
                                                    </a>
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="wrap-pagination">
                    <div class="container">
                        <div class="sw-dots style-grey sw-pagination-slider justify-content-center"></div>
                    </div>
                </div>
            </div>
        </section>
    @else
        <!--For desktop only-->
        <section class="tf-slideshow slider-default home-slider">
            <div class="swiper tf-sw-slideshow slider-effect-fade" data-preview="1" data-tablet="1" data-mobile="1"
                data-centered="false" data-space="0" data-space-mb="0" data-loop="true" data-auto-play="true"
                data-effect="fade">
                <div class="swiper-wrapper">
                    @foreach ($data['banner'] as $banner)
                    <div class="swiper-slide">
                        <div class="slider-wrap">
                            <a href="{{ $banner->link_desktop }}">
                                <div class="image">
                                    <img src="{{ asset('images/banners/'.$banner->image_path_desktop) }}"
                                        data-src="{{ asset('images/banners/' . $banner->image_path_desktop) }}"
                                        alt="{{ $banner->title ?? 'slider' }}" class="lazyload">
                                </div>
                            </a>
                            @if (!empty($banner->title))
                            <div class="box-content">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="content-slider text-center">
                                                <div class="box-title-slider">
                                                    <h2 class="heading display-xl-2 text-white fw-medium fade-item fade-item-1 font-2">
                                                        {{ $banner->title }}
                                                    </h2>
                                                </div>
                                                @if (!empty($banner->link))
                                                <div class="box-btn-slider fade-item fade-item-3">
                                                    <a href="{{ $banner->link }}"
                                                        class="tf-btn btn-large fw-normal btn-yellow font-2 rounded-0 animate-btn">
                                                        Shop Collection <i class="icon icon-arr-right"></i>
                                                    </a>
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="wrap-pagination">
                    <div class="container">
                        <div class="sw-dots style-grey sw-pagination-slider justify-content-center"></div>
                    </div>
                </div>
            </div>
        </section>
    @endif
@endif

@if (!empty($data['seriesValuesWithCategory']) && $data['seriesValuesWithCategory']->isNotEmpty())
<section class="flat-spacing-3 home-category-section">
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="flat-animate-tab">
                <div class="col-lg-12">
                    <div class="flat-title-tab-categories wow fadeInUp text-center">
                        <h4 class="title with-border">Coolers</h4>
                    </div>
                </div>
                <div class="row justify-content-md-center">
                    @foreach($data['seriesValuesWithCategory'] as $item)
                    @php
                    $series = $item->attributeValue;
                    $category_slug = $item->category->slug ?? '';
                    $attributes_value_slug = $item->attributeValue->slug ?? '';
                    $title = $series->name ?? '';
                    $imageName = $item->attributeValue->images;
                    $imagePath = public_path('images/attribute-values/' . $imageName);
                    $imageUrl = file_exists($imagePath) && !empty($imageName)
                    ? asset('images/attribute-values/' . $imageName)
                    : asset('frontend/assets/himgiri-img/logo/1.png');
                    @endphp

                    <div class="col-4 col-md-3 mb-4">
                        <div class="style-circle hover-img text-center">
                            <a href="{{ route('collections', [
                                        'category_slug' => $category_slug,
                                        'attributes_value_slug' => $attributes_value_slug
                                    ]) }}" class="image img-style d-block mb-2">
                                <img src="{{ $imageUrl }}" alt="{{ $title }}" class="img-fluid">
                            </a>
                            <div class="cls-content">
                                <a href="{{ route('collections', [
                                            'category_slug' => $category_slug,
                                            'attributes_value_slug' => $attributes_value_slug
                                        ]) }}" class="link text-md fw-medium">{{ $title }}
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

            </div>
        </div>
    </div>
    <div class="coolers-icon-section-three">
        @include('frontend.layouts.coolers-icon')
    </div>
</section>
@endif

@if (!empty($data['primary_category']) && $data['primary_category']->isNotEmpty())
<section class="flat-spacing-3 primary-category">
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="flat-animate-tab">
                <div class="col-lg-12">
                    <div class="flat-title-tab-categories wow fadeInUp text-center">
                        <h4 class="title with-border">Highlighted Products</h4>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="section-b-space h-button-area">
                        <ul class="list text-center">
                            @php
                            $colors = [
                            '#FF5733', '#a1521b', '#FF69B4',
                            '#8A2BE2', '#efab49', '#00CED1', '#DC143C',
                            '#4682B4', '#FF8C00', '#8B008B', '#2E8B57'
                            ];
                            @endphp
                            @foreach ($data['primary_category'] as $index =>$primary_category_row)
                            <li>
                                <a class="btn text-white" href="{{$primary_category_row->link}}" style="background-color: {{ $colors[$index % count($colors)] }};">
                                    {{$primary_category_row->title}}
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </div>


</section>
@endif


<section class="flat-spacing about-us-main" style="background: #c91818;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="about-us-features wow fadeInLeft step-img">
                    <img class="w100 ls-is-cached lazyloaded" data-src="{{asset('frontend/assets/himgiri-img/about-us-home.jpg')}}" src="{{asset('frontend/assets/himgiri-img/about-us-home.jpg')}}" alt="about">
                </div>
            </div>
            <div class="col-md-6">
                <div class="about-us-content section-ab-content">
                    <h1 class="title wow fadeInUp">Welcome to Himgiri Coolers</h1>
                    <div class="widget-tabs style-3">

                        <div class="widget-content-tab wow fadeInUp">
                            <div class="widget-content-inner">
                                <p>Beat the heat with Himgiri Coolers, your ultimate solution for a cooler, healthier, and more comfortable living space. Our extensive range of fibre and metal coolers is designed to bring you the essence of winter, even in the scorching summer months.</p>
                                <h5>
                                    Experience the Power of Pure Cooling
                                </h5>
                                <p>
                                    Our coolers are engineered to provide a continuous flow of fresh, cool air, ensuring that you breathe easy and stay relaxed. With their compact designs and silent operations, Himgiri Coolers are the perfect addition to any home or office.
                                </p>
                            </div>
                        </div>
                        <div class="about-us-btn">
                            <a href="{{ route('about-us')}}" class="tf-btn btn-fill wow fadeInUp"><span class="text text-button">Read More</span></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>

@if (!empty($data['modelValuesWithCategory']) && $data['modelValuesWithCategory']->isNotEmpty())
<section class="flat-spacing-3 pb-0 overflow-hidden home-almirah">
    <div class="container">
        <div class="flat-title wow fadeInUp">
            <h4 class="title with-border">Almirah</h4>
        </div>
        <div class="fl-control-sw2 wrap-pos-nav sw-over-product wow fadeInUp">
            <div dir="ltr" class="swiper tf-swiper wrap-sw-over" data-swiper='{
                        "slidesPerView": 2,
                        "spaceBetween": 12,
                        "speed": 800,
                        "observer": true,
                        "observeParents": true,
                        "slidesPerGroup": 2,
                        "navigation": {
                            "clickable": true,
                            "nextEl": ".nav-next-top-pick",
                            "prevEl": ".nav-prev-top-pick"
                        },
                        "pagination": { "el": ".sw-pagination-top-pick", "clickable": true },
                        "breakpoints": {
                        "768": { "slidesPerView": 3, "spaceBetween": 12, "slidesPerGroup": 3 },
                        "1200": { "slidesPerView": 5, "spaceBetween": 20, "slidesPerGroup": 5}
                        }
                    }'>
                @php

                $bgColors = ['#f5f5f5', '#fff3d9', '#f4e7fb', '#f4dcdc'];
                @endphp
                <div class="swiper-wrapper">
                    @foreach($data['modelValuesWithCategory'] as $index =>$item)
                    @php
                    $series = $item->attributeValue;
                    $category_slug = $item->category->slug ?? '';
                    $attributes_value_slug = $item->attributeValue->slug ?? '';
                    $title = $series->name ?? '';
                    $imageName = $item->attributeValue->images;
                    $imagePath = public_path('images/attribute-values/' . $imageName);
                    $imageUrl = file_exists($imagePath) && !empty($imageName)
                    ? asset('images/attribute-values/' . $imageName)
                    : asset('frontend/assets/himgiri-img/logo/1.png');
                    @endphp
                    <!-- item 1 -->
                    <div class="swiper-slide">
                        <div class="card-product card-product-size">
                            <div class="card-product-wrapper" style="background-color: {{ $bgColors[$index % count($bgColors)] }}; padding:10px;">
                                <a href="{{ route('collections', [
                                            'category_slug' => $category_slug,
                                            'attributes_value_slug' => $attributes_value_slug
                                        ]) }}" class="product-img">
                                    <img class="img-product lazyload"
                                        data-src="{{ $imageUrl }}"
                                        src="{{ $imageUrl }}" alt="{{ $title }}" loading="lazy">
                                    <!--<img class="img-hover lazyload"
                                        data-src="{{ $imageUrl }}"
                                        src="{{ $imageUrl }}" alt="{{ $title }}" loading="lazy">-->
                                </a>
                                <!-- <div class="on-sale-wrap"><span class="on-sale-item">20% Off</span></div> -->
                            </div>
                            <div class="card-product-info">
                                <a href="{{ route('collections', [
                                            'category_slug' => $category_slug,
                                            'attributes_value_slug' => $attributes_value_slug
                                        ]) }}" class="name-product link fw-medium text-md">
                                    {{ $title }}
                                </a>
                                <!-- <p class="price-wrap fw-medium">
                                        <span class="price-new text-primary">Rs. 100.00</span>
                                        <span class="price-old">Rs. 130.00</span>
                                    </p> -->
                                <!-- <ul class="list-color-product">
                                            <li
                                                class="list-color-item color-swatch hover-tooltip tooltip-bot line active">
                                                <span class="tooltip color-filter">White</span>
                                                <span class="swatch-value bg-white"></span>
                                                <img class=" lazyload" data-src="images/products/fashion/product-29.jpg"
                                                    src="images/products/fashion/product-29.jpg" alt="image-product">
                                            </li>
                                            <li class="list-color-item color-swatch hover-tooltip tooltip-bot">
                                                <span class="tooltip color-filter">Grey</span>
                                                <span class="swatch-value bg-grey-4"></span>
                                                <img class=" lazyload" data-src="images/products/fashion/product-6.jpg"
                                                    src="images/products/fashion/product-6.jpg" alt="image-product">
                                            </li>
                                            <li class="list-color-item color-swatch hover-tooltip tooltip-bot">
                                                <span class="tooltip color-filter">Black</span>
                                                <span class="swatch-value bg-dark"></span>
                                                <img class=" lazyload" data-src="images/products/fashion/product-20.jpg"
                                                    src="images/products/fashion/product-20.jpg" alt="image-product">
                                            </li>
                                        </ul> -->
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div
                    class="d-flex d-xxl-none mt_5 sw-dot-default sw-pagination-top-pick justify-content-center">
                </div>
            </div>
            <div class="d-none d-xxl-flex swiper-button-next nav-swiper nav-next-top-pick"></div>
            <div class="d-none d-xxl-flex swiper-button-prev nav-swiper nav-prev-top-pick"></div>
        </div>
    </div>
</section>
@endif
<!-- Icon box -->
@include('frontend.layouts.almirah-icon')
<!-- /Icon box -->

@endsection
@push('scripts')

@endpush