@php
if ($data['product_details']->meta_title) {
$meta_title = $data['product_details']->meta_title;
} else {
$meta_title = ucwords(strtolower($data['product_details']->title));
}

if ($data['product_details']->meta_description) {
$meta_description = $data['product_details']->meta_description;
} else {
$meta_description = 'Himgiri Coolers';
}
@endphp

@extends('frontend.layouts.master')
@section('title', $meta_title)
@section('description', $meta_description)
@section('main-content')
<!-- Breadcrumb -->
<div class="tf-breadcrumb mb-27">
    <div class="container">
        <ul class="breadcrumb-list">
            <li class="item-breadcrumb">
                <a href="{{ url('/') }}" class="text">Home</a>
            </li>
            <li class="item-breadcrumb dot">
                <span></span>
            </li>
            <li class="item-breadcrumb">
                <a href="{{ url()->previous() }}" class="text">
                    {{$data['product_details']->category->title}} : {{$data['attributes_value_name']->name}}
                </a>
            </li>
            <li class="item-breadcrumb dot">
                <span></span>
            </li>
            <li class="item-breadcrumb">
                <span class="text">
                    {{ucwords(strtolower($data['product_details']->title))}}
                </span>
            </li>
        </ul>
    </div>
</div>
<!-- Product Main -->
<section class="flat-single-product product-details-page">
    <div class="tf-main-product section-image-zoom">
        <div class="container">
            <div class="row">
                <!-- Product Images -->
                <div class="col-md-6">
                    <div class="tf-product-media-wrap sticky-top">
                        <div class="product-thumbs-slider">
                            <div dir="ltr" class="swiper tf-product-media-thumbs other-image-zoom"
                                data-preview="4" data-direction="vertical">
                                <div class="swiper-wrapper stagger-wrap">
                                    @if($data['product_details']->images->isNotEmpty())
                                    @foreach($data['product_details']->images as $key => $image)
                                    <div class="swiper-slide stagger-item" data-color="black" data-size="small">
                                        <div class="item">
                                            <img class="lazyload"
                                                data-src="{{ asset('images/product/thumb/' . $image->image_path) }}"
                                                src="{{ asset('images/product/thumb/' . $image->image_path) }}"
                                                alt="{{$data['product_details']->title}}" loading="lazy">
                                        </div>
                                    </div>
                                    @endforeach
                                    @else
                                    <div class="swiper-slide stagger-item" data-color="black" data-size="small">
                                        <div class="item">
                                            <img class="lazyload"
                                                data-src="{{ asset('frontend/assets/himgiri-img/logo/1.png')}}"
                                                src="{{ asset('frontend/assets/himgiri-img/logo/1.png')}}"
                                                alt="{{$data['product_details']->title}}" loading="lazy">
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="flat-wrap-media-product">
                                <div dir="ltr" class="swiper tf-product-media-main" id="gallery-swiper-started">
                                    <div class="swiper-wrapper">
                                        <!-- black -->
                                        @if($data['product_details']->images->isNotEmpty())
                                        @foreach($data['product_details']->images as $key => $image)
                                        <div class="swiper-slide" data-color="black" data-size="small">
                                            <a href="{{ asset('images/product/large/' . $image->image_path) }}" target="_blank"
                                                class="item" data-pswp-width="552px" data-pswp-height="827px">
                                                <img class="tf-image-zoom lazyload"
                                                    data-zoom="{{ asset('images/product/large/' . $image->image_path) }}"
                                                    data-src="{{ asset('images/product/large/' . $image->image_path) }}"
                                                    src="{{ asset('images/product/large/' . $image->image_path) }}"
                                                    alt="{{$data['product_details']->title}}"
                                                    loading="lazy">
                                            </a>
                                        </div>
                                        @endforeach
                                        @else
                                        <div class="swiper-slide" data-color="black" data-size="small">
                                            <a href="{{ asset('frontend/assets/himgiri-img/logo/1.png')}}" target="_blank"
                                                class="item" data-pswp-width="552px" data-pswp-height="827px">
                                                <img class="tf-image-zoom lazyload"
                                                    data-zoom="{{ asset('frontend/assets/himgiri-img/logo/1.png')}}"
                                                    data-src="{{ asset('frontend/assets/himgiri-img/logo/1.png')}}"
                                                    src="{{ asset('frontend/assets/himgiri-img/logo/1.png')}}"
                                                    alt="{{$data['product_details']->title}}" loading="lazy">
                                            </a>
                                        </div>
                                        @endif

                                    </div>
                                </div>
                                <div class="swiper-button-next nav-swiper thumbs-next"></div>
                                <div class="swiper-button-prev nav-swiper thumbs-prev"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Product Images -->
                <!-- Product Info -->
                <div class="col-md-6">
                    <div class="tf-product-info-wrap position-relative">
                        <div class="tf-zoom-main"></div>
                        <div class="tf-product-info-list other-image-zoom">
                            <div class="tf-product-info-heading">
                                <h1 class="product-info-name fw-medium">
                                    {{$data['product_details']->title}}
                                </h1>
                                @if($data['product_details']->offer_rate){
                                <div class="product-info-price">
                                    <div class="display-sm price-new price-on-sale">
                                        Rs. {{ $product->offer_rate ?? '0.00' }}
                                    </div>
                                    <div class="display-sm price-old">
                                        Rs. {{ $product->mrp ?? '0.00' }}
                                    </div>
                                    <!-- <span class="badge-sale">20% Off</span> -->
                                </div>
                                }
                                @else
                                <div class="product-info-price">
                                    <div class="display-sm price-new price-on-sale">
                                        Price not Available.
                                    </div>
                                </div>
                                @endif
                            </div>
                            @if(isset($data['product_details']->attributes) && $data['product_details']->attributes->isNotEmpty())
                            <div class="pickup-box">
                                <!--<div class="product-title">
                                        <h4>Store Information</h4>
                                    </div>-->
                                <div class="product-info">
                                    <ul class="product-info-list product-info-list-2">
                                        @foreach($data['product_details']->attributes as $attribute)
                                        @if(isset($attribute->values) && $attribute->values->isNotEmpty())
                                        <li>
                                            {{ $attribute->attribute->title }} :
                                            @foreach($attribute->values as $value)
                                            <a href="javascript:void(0)">{{ $value->attributeValue->name }}</a>@if(!$loop->last),@endif
                                            @endforeach
                                        </li>
                                        @endif
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            @endif
                            <div class="tf-product-total-quantity">
                                <!--<div class="group-btn">
                                    <div class="wg-quantity">
                                        <button class="btn-quantity btn-decrease">-</button>
                                        <input class="quantity-product" type="text" name="number" value="1">
                                        <button class="btn-quantity btn-increase">+</button>
                                    </div>
                                    <a href="#shoppingCart" data-bs-toggle="offcanvas"
                                        class="tf-btn hover-primary btn-add-to-cart">Add to cart</a>
                                </div>-->
                                <a href="#" class="tf-btn btn-primary w-100 animate-btn">
                                    Enquiry Now
                                </a>

                            </div>
                            <!--<div class="tf-product-info-extra-link">
                                <a href="javascript:void(0);" class="product-extra-icon link btn-add-wishlist">
                                    <i class="icon add icon-heart"></i><span class="add">Add to wishlist</span>
                                    <i class="icon added icon-trash"></i><span class="added">Remove from
                                        wishlist</span>
                                </a>
                                <a href="#compare" data-bs-toggle="modal" class="product-extra-icon link">
                                    <i class="icon icon-compare2"></i>Compare
                                </a>
                                <a href="#askQuestion" data-bs-toggle="modal" class="product-extra-icon link">
                                    <i class="icon icon-ask"></i>Ask a question
                                </a>
                                <a href="#shareSocial" data-bs-toggle="modal" class="product-extra-icon link">
                                    <i class="icon icon-share"></i>Share
                                </a>
                            </div>-->

                            <!--<div class="tf-product-info-delivery-return">
                                <div class="product-delivery">
                                    <div class="icon icon-car2"></div>
                                    <p class="text-md">Estimated delivery time: <span class="fw-medium">3-5 days
                                            international</span></p>
                                </div>
                                <div class="product-delivery">
                                    <div class="icon icon-shipping3"></div>
                                    <p class="text-md">Free shipping on <span class="fw-medium">all orders over
                                            Rs 3000</span></p>
                                </div>
                            </div>-->
                        </div>

                    </div>
                </div>
                <!-- /Product Info -->

            </div>
        </div>
    </div>

</section>
<!-- /Product Main -->
<!-- Product Description -->
<section class="flat-spacing-5 pt-0">
    <div class="container">
        <div class="widget-accordion wd-product-descriptions">
            <div class="accordion-title collapsed" data-bs-target="#description" data-bs-toggle="collapse"
                aria-expanded="true" aria-controls="description" role="button">
                <span>Descriptions</span>
                <span class="icon icon-arrow-down"></span>
            </div>
            <div id="description" class="collapse show">
                <div class="accordion-body widget-desc">
                    <div class="table-responsive">
                        @if(!empty($data['product_details']->product_description))
                        <p>
                            {!! $data['product_details']->product_description !!}
                        </p>
                        @else
                        <p>Product description not available !</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <!--<div class="widget-accordion wd-product-descriptions">
            <div class="accordion-title collapsed" data-bs-target="#material" data-bs-toggle="collapse"
                aria-expanded="true" aria-controls="material" role="button">
                <span>Additional info</span>
                <span class="icon icon-arrow-down"></span>
            </div>
            <div id="material" class="collapse show">
                <div class="accordion-body widget-material">
                    <div class="item">
                        <div class="table-responsive">
                            @if($data['product_details']->additionalFeatures->isNotEmpty())
                            <table class="table table">
                                @foreach($data['product_details']->additionalFeatures as $index => $additionalFeature)
                                <tr>
                                    <td>
                                        {{ $additionalFeature->feature->title }}
                                    </td>
                                    <td>
                                        {{ $additionalFeature->product_additional_featur_value }}
                                    </td>
                                </tr>
                                @endforeach

                            </table>
                            @else
                            <span>No additional feature available !</span>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>-->

    </div>
</section>
<!-- /Product Description -->
<!-- People Also Bought -->
@if (!empty($data['related_products']) && $data['related_products']->isNotEmpty())
@php
    $bgColors = ['#f5f5f5', '#fff3d9', '#f4e7fb', '#f4dcdc'];
    $defaultImage = asset('frontend/assets/himgiri-img/logo/1.png');
@endphp
    <section class="flat-spacing-5 pt-0">
        <div class="container">
            <div class="flat-title wow fadeInUp">
                <h4 class="title with-border">People Also Buy</h4>
            </div>
            <div class="hover-sw-nav  wow fadeInUp">
                <div dir="ltr" class="swiper tf-swiper wrap-sw-over" data-swiper='{
                        "slidesPerView": 2,
                        "spaceBetween": 12,
                        "speed": 800,
                        "observer": true,
                        "observeParents": true,
                        "slidesPerGroup": 2,
                        "navigation": {
                            "clickable": true,
                            "nextEl": ".nav-next-bought",
                            "prevEl": ".nav-prev-bought"
                        },
                        "pagination": { "el": ".sw-pagination-bought", "clickable": true },
                        "breakpoints": {
                        "768": { "slidesPerView": 5, "spaceBetween": 12, "slidesPerGroup": 5 },
                        "1200": { "slidesPerView": 5, "spaceBetween": 24, "slidesPerGroup": 5}
                        }
                    }'>
                    <div class="swiper-wrapper">
                        @foreach ($data['related_products'] as $key => $related_product_row)
                            @php
                                $firstImage = $related_product_row->images->get(0)?->image_path;
                                $secondImage = $related_product_row->images->get(1)?->image_path;
                                $image1 = $firstImage ? asset('images/product/thumb/' . $firstImage) : $defaultImage;
                                $image2 = $secondImage ? asset('images/product/thumb/' . $secondImage) : $defaultImage;

                                if($related_product_row->ProductAttributesValues->isNotEmpty()){
                                    $attributes_value = $related_product_row->ProductAttributesValues->first()->attributeValue->slug;
                                }
                            @endphp

                            <div class="swiper-slide">
                                <div class="card-product style-2 card-product-size">
                                    <div class="card-product-wrapper"  style="background-color: {{ $bgColors[$key % count($bgColors)] }}; padding:10px;">
                                        <a
                                        href="{{ route('products', [
                                            'product_slug' => $related_product_row->slug,
                                            'attributes_value_slug' => $attributes_value
                                        ]) }}" 
                                        class="product-img">
                                            <img class="img-product lazyload"
                                                data-src="{{ $image1 }}"
                                                src="{{ $image1 }}" alt="{{ $related_product_row->title }}" loading="lazy">
                                            <!-- <img class="img-hover lazyload"
                                                data-src="{{ $image2 }}"
                                                src="{{ $image2 }}" alt="{{ $related_product_row->title }}" loading="lazy"> -->
                                        </a>
                                    </div>
                                    <div class="card-product-info">
                                        <a
                                        href="{{ route('products', [
                                            'product_slug' => $related_product_row->slug,
                                            'attributes_value_slug' => $attributes_value
                                        ]) }}" 
                                        class="name-product link fw-medium text-md">
                                            {{ $related_product_row->title }}
                                        </a>
                                        @if($related_product_row->offer_rate)
                                        <p class="price-wrap fw-medium">
                                            <span class="price-new text-primary">Rs. {{ $related_product_row->offer_rate ?? '0.00' }}</span>
                                            <span class="price-old">Rs. {{ $related_product_row->mrp ?? '0.00' }}</span>
                                        </p>
                                        @else
                                        <p class="price-wrap fw-medium">
                                            <span class="price-new text-primary">Price Not Available .</span>
                                        </p>
                                        @endif
                                        
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="d-flex d-xl-none sw-dot-default sw-pagination-bought justify-content-center"></div>
                </div>
                <div class="d-none d-xl-flex swiper-button-next nav-swiper nav-next-bought"></div>
                <div class="d-none d-xl-flex swiper-button-prev nav-swiper nav-prev-bought"></div>
            </div>
        </div>
    </section>
@endif
<!-- People Also Bought -->
@endsection
@push('scripts')
<script src="{{asset('frontend/assets/js/photoswipe-lightbox.umd.min.js')}}"></script>
<script src="{{asset('frontend/assets/js/photoswipe.umd.min.js')}}"></script>
<script src="https://unpkg.com/drift-zoom/dist/Drift.min.js"></script>
<script src="{{asset('frontend/assets/js/zoom.js')}}"></script>
@endpush