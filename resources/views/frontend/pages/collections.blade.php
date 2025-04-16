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
                <a href="index.html" class="text">Home</a>
            </li>
            <li class="item-breadcrumb dot">
                <span></span>
            </li>
            <li class="item-breadcrumb">
                <a href="shop-collection-list.html" class="text">Collections</a>
            </li>
            <li class="item-breadcrumb dot">
                <span></span>
            </li>
            <li class="item-breadcrumb">
                <span class="text">Women</span>
            </li>
        </ul>
    </div>
</div>
<!-- /Breadcrumb -->
<!-- Section Product -->
<section class="flat-spacing-2 pt-0 collections-page">
    <div class="container">
        <div class="row">
            <div class="col-xl-3">
                <div class="canvas-sidebar sidebar-filter canvas-filter left">
                    <div class="canvas-wrapper">
                        <div class="canvas-header d-flex d-xl-none">
                            <span class="title">Filter</span>
                            <span class="icon-close icon-close-popup close-filter"></span>
                        </div>
                        <div class="canvas-body">
                            <div class="widget-facet">
                                <div class="facet-title text-xl fw-medium" data-bs-target="#collections"
                                    data-bs-toggle="collapse" aria-expanded="true" aria-controls="collections">
                                    <span>Collections</span>
                                    <span class="icon icon-arrow-up"></span>
                                </div>
                                <div id="collections" class="collapse show">
                                    <ul class="collapse-body list-categories current-scrollbar">
                                        <li class="cate-item">
                                            <a class="text-sm link" href="shop-default.html">
                                                <span>Men’s top</span>
                                                <span class="count">(20)</span>
                                            </a>
                                        </li>
                                        <li class="cate-item">
                                            <a class="text-sm link" href="shop-default.html">
                                                <span>Men</span>
                                                <span class="count">(20)</span>
                                            </a>
                                        </li>
                                        <li class="cate-item">
                                            <a class="text-sm link" href="shop-default.html">
                                                <span>Women</span>
                                                <span class="count">(20)</span>
                                            </a>
                                        </li>
                                        <li class="cate-item">
                                            <a class="text-sm link" href="shop-default.html">
                                                <span>Kid</span>
                                                <span class="count">(20)</span>
                                            </a>
                                        </li>
                                        <li class="cate-item">
                                            <a class="text-sm link" href="shop-default.html">
                                                <span>T-shirt</span>
                                                <span class="count">(20)</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="widget-facet">
                                <div class="facet-title text-xl fw-medium" data-bs-target="#availability"
                                    role="button" data-bs-toggle="collapse" aria-expanded="true"
                                    aria-controls="availability">
                                    <span>Availability</span>
                                    <span class="icon icon-arrow-up"></span>
                                </div>
                                <div id="availability" class="collapse show">
                                    <ul class="collapse-body filter-group-check current-scrollbar">
                                        <li class="list-item">
                                            <input type="radio" name="availability" class="tf-check"
                                                id="inStock">
                                            <label for="inStock" class="label"><span>In stock</span>&nbsp;<span
                                                    class="count">(20)</span></label>
                                        </li>
                                        <li class="list-item">
                                            <input type="radio" name="availability" class="tf-check"
                                                id="outStock">
                                            <label for="outStock" class="label"><span>Out of
                                                    stock</span>&nbsp;<span class="count">(3)</span></label>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="widget-facet">
                                <div class="facet-title text-xl fw-medium" data-bs-target="#brand" role="button"
                                    data-bs-toggle="collapse" aria-expanded="true" aria-controls="brand">
                                    <span>Brand</span>
                                    <span class="icon icon-arrow-up"></span>
                                </div>
                                <div id="brand" class="collapse show">
                                    <ul class="collapse-body filter-group-check current-scrollbar">
                                        <li class="list-item">
                                            <input type="radio" name="brand" class="tf-check" id="Vineta">
                                            <label for="Vineta" class="label"><span>Vineta</span>&nbsp;<span
                                                    class="count">(11)</span></label>
                                        </li>
                                        <li class="list-item">
                                            <input type="radio" name="brand" class="tf-check" id="Zotac">
                                            <label for="Zotac" class="label"><span>Zotac</span>&nbsp;<span
                                                    class="count">(20)</span></label>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-9">
                <div class="tf-shop-control">
                    <div class="tf-group-filter">
                        <button id="filterShop" class="tf-btn-filter d-flex d-xl-none">
                            <span class="icon icon-filter"></span><span class="text">Filter</span>
                        </button>
                        <div class="tf-dropdown-sort" data-bs-toggle="dropdown">
                            <div class="btn-select">
                                <span class="text-sort-value">Best selling</span>
                                <span class="icon icon-arr-down"></span>
                            </div>
                            <div class="dropdown-menu">
                                <div class="select-item active" data-sort-value="best-selling">
                                    <span class="text-value-item">Best selling</span>
                                </div>
                                <div class="select-item" data-sort-value="a-z">
                                    <span class="text-value-item">Alphabetically, A-Z</span>
                                </div>
                                <div class="select-item" data-sort-value="z-a">
                                    <span class="text-value-item">Alphabetically, Z-A</span>
                                </div>
                                <div class="select-item" data-sort-value="price-low-high">
                                    <span class="text-value-item">Price, low to high</span>
                                </div>
                                <div class="select-item" data-sort-value="price-high-low">
                                    <span class="text-value-item">Price, high to low</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="wrapper-control-shop">
                    <div class="meta-filter-shop">
                        <div id="product-count-grid" class="count-text"></div>
                        <div id="product-count-list" class="count-text"></div>
                        <div id="applied-filters"></div>
                        <button id="remove-all" class="remove-all-filters" style="display: none;">
                            <i class="icon icon-close"></i> Clear all filter
                        </button>
                    </div>
                    @php
                        $images = [
                        '1.png',
                        '2.png',
                        '3.png',
                        '4.png',
                        '5.png',
                        '6.png',
                        '7.png',
                        '8.png',
                        '9.png',
                        '10.png',
                        ];
                        $bgColors = ['#f5f5f5', '#fff3d9', '#f4e7fb', '#f4dcdc'];
                        @endphp
                    <div class="wrapper-shop tf-grid-layout tf-col-4" id="gridLayout">
                        <!-- Card Product 1 -->
                        @foreach ($images as $index => $img)
                            <div class="card-product grid card-product-size">
                                <div class="card-product-wrapper"  style="background-color: {{ $bgColors[$index % count($bgColors)] }}; padding:10px;">
                                    <a href="{{route('products')}}" class="product-img">
                                        <img class="img-product lazyload"
                                            data-src="{{asset('frontend/assets/himgiri-img/coolers/' . $img)}}"
                                            src="{{asset('frontend/assets/himgiri-img/coolers/' . $img)}}" alt="image-product">
                                        <img class="img-hover lazyload"
                                            data-src="{{asset('frontend/assets/himgiri-img/almirah/' . $img)}}"
                                            src="{{asset('frontend/assets/himgiri-img/almirah/' . $img)}}" alt="image-product">
                                    </a>
                                    <div class="on-sale-wrap"><span class="on-sale-item">20% Off</span></div>
                                    <ul class="list-product-btn">
                                        <li>
                                            <a href="#shoppingCart" data-bs-toggle="offcanvas"
                                                class="hover-tooltip tooltip-left box-icon">
                                                <span class="icon icon-cart2"></span>
                                                <span class="tooltip">Add to Cart</span>
                                            </a>
                                        </li>
                                        <li class="wishlist">
                                            <a href="javascript:void(0);"
                                                class="hover-tooltip tooltip-left box-icon">
                                                <span class="icon icon-heart2"></span>
                                                <span class="tooltip">Add to Wishlist</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#quickView" data-bs-toggle="modal"
                                                class="hover-tooltip tooltip-left box-icon quickview">
                                                <span class="icon icon-view"></span>
                                                <span class="tooltip">Quick View</span>
                                            </a>
                                        </li>
                                        <li class="compare">
                                            <a href="#compare" data-bs-toggle="modal" aria-controls="compare"
                                                class="hover-tooltip tooltip-left box-icon">
                                                <span class="icon icon-compare"></span>
                                                <span class="tooltip">Add to Compare</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="card-product-info">
                                    <a href="{{route('products')}}" class="name-product link fw-medium text-md">Loose
                                        Fit
                                        Tee</a>
                                    <p class="price-wrap fw-medium">
                                        <span class="price-new text-primary">Rs. 120.00</span>
                                        <span class="price-old">Rs. 150.00</span>
                                    </p>
                                    
                                </div>
                            </div>
                        @endforeach                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<div id="description" class="flat-spacing pt-0">
    <div class="container">
        <p class="text text-md text-center">
            Our women's collection fuses classic sophistication with modern trends. From versatile daywear to
            statement pieces, each garment is crafted with high-quality fabrics and meticulous attention to
            detail for lasting comfort and a perfect fit.
        </p>
        <p class="mt_12 text-md text-center">Looking for more? Don’t miss out on our other exciting collections
            for <a href="shop-sub-collection.html"
                class="text-primary text-decoration-underline fw-medium">BAGS</a> and
            <a href="shop-sub-collection.html"
                class="text-primary text-decoration-underline fw-medium">ACCESSORIES</a>.
        </p>
    </div>
</div>
<!-- /Section Product -->

@endsection
@push('scripts')

@endpush