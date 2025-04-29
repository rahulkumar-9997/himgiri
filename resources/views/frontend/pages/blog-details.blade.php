@extends('frontend.layouts.master')
@section('title', 'Himgiri : ' . $blog->title)
@section('description', \Illuminate\Support\Str::limit(strip_tags($blog->bog_description), 160))

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
                <span class="text">
                    {{$blog->title}}
                </span>
            </li>
        </ul>
    </div>
</div>
<section class="blog-section section-b-space">
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-xxl-9 col-xl-8 col-lg-7 ratio_50 order-md-1">
                <div class="blog-detail-image rounded-3 mb-4">
                    <div class="blog-deta-img">
                        <img src="{{asset($blog->blog_image) }}" class="pc__img_blog bg-img-blog-details blur-up lazyload" alt="{{$blog->title}}">
                    </div>
                    <div class="blog-image-contain">
                        <h1>{{$blog->title}}</h1>
                        <ul class="contain-comment-list">
                            <li>
                                <div class="user-list">
                                    <i class="clock-icon icon icon-clock"></i>
                                    <span>{{$blog->created_at->format('F j, Y')}}</span>
                                </div>
                            </li>

                        </ul>
                    </div>
                </div>

                <div class="blog-detail-contain">
                    {!! $blog->bog_description !!}
                </div>
                @if($blog->paragraphs->isNotEmpty())
                <div class="blog-paragraphs-section">
                    <div class="row">
                        <div class="col-lg-12">
                            @foreach ($blog->paragraphs as $index => $paragraph)
                            @php
                            $linksOne = '';
                            $linksTwo = '';
                            if ($paragraph->productLinks->isNotEmpty()) {
                            $productLink = $paragraph->productLinks->first();
                            $links = json_decode($productLink->links, true);
                            $linksOne = '<p><a href="' . ($links['link_one'] ?? '') . '">' . ($links['link_one'] ?? '') . '</a></p>';
                            $linksTwo = '<p><a href="' . ($links['link_two'] ?? '') . '">' . ($links['link_two'] ?? '') . '</a></p>';
                            }
                            @endphp
                            <div class="blog-paragraphs">
                                <div class="row">
                                    @if($paragraph->bog_paragraph_image)
                                    @if($index % 2 == 0)
                                    <div class="col-lg-4">
                                        <img src="{{ asset($paragraph->bog_paragraph_image) }}" class="rounded-3 img-fluid blur-up lazyloaded" alt="{{ $paragraph->paragraphs_title }}">
                                    </div>
                                    <div class="col-lg-8">
                                        <h3 class="recent-name">{{ $paragraph->paragraphs_title }}</h3>
                                        <div class="paragraphs_description">
                                            {!! $paragraph->bog_paragraph_description !!}
                                        </div>
                                    </div>
                                    @else
                                    <div class="col-lg-8">
                                        <h3 class="recent-name">{{ $paragraph->paragraphs_title }}</h3>
                                        <div class="paragraphs_description">
                                            {!! $paragraph->bog_paragraph_description !!}
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <img src="{{ asset($paragraph->bog_paragraph_image) }}" class="rounded-3 img-fluid blur-up lazyloaded" alt="{{ $paragraph->paragraphs_title }}">
                                    </div>
                                    @endif
                                    @else
                                    <div class="col-lg-12">
                                        <h3 class="recent-name">{{ $paragraph->paragraphs_title }}</h3>
                                        <div class="paragraphs_description">
                                            {!! $paragraph->bog_paragraph_description !!}
                                        </div>
                                        @if ($paragraph->productLinks->isNotEmpty())
                                        <div class="row row-cols-xxl-3 row-cols-xl-4 row-cols-md-3 row-cols-2 g-sm-4 g-3 no-arrow section-b-space blog-product-row justify-content-center">
                                            @foreach ($paragraph->productLinks as $productLink)
                                            @php
                                            $product = $productLink->product;
                                            $firstImageBlog =
                                            $product->images->get(0);
                                            $attributes_value ='na';
                                            $attributes_value_slug ='';
                                            if($product->ProductAttributesValues->isNotEmpty()){
                                            $attributes_value = $product->ProductAttributesValues->first()->attributeValue;
                                            $attributes_value_slug = $attributes_value->slug;
                                            }
                                            @endphp
                                            <div>
                                                <div class="product-box product-white-bg wow fadeIn">
                                                    <div class="product-box blog-product-box">
                                                        <div class="product-image blog-product-img">
                                                            <a href="{{ url('products/'.$product->slug.'/'.$attributes_value_slug) }}">
                                                                @if ($firstImageBlog)
                                                                <img class="blog_pc__img_blog img-fluid blur-up lazyload"
                                                                    data-src="{{ asset('images/product/large/'. $firstImageBlog->image_path) }}"
                                                                    src="{{ asset('images/product/large/'. $firstImageBlog->image_path) }}"
                                                                    alt="{{ $product->title }}" title="{{ $product->title }}">
                                                                @else
                                                                <img src="{{ asset('frontend/assets/gd-img/product/no-image.png') }}"
                                                                    class="img-fluid blur-up lazyload" alt="{{ $product->title }}">
                                                                @endif
                                                            </a>

                                                        </div>
                                                        <div class="product-detail">
                                                            <a href="{{ url('products/'.$product->slug.'/'.$attributes_value_slug) }}">
                                                                <h6 class="name h-100">
                                                                    {{ ucwords(strtolower($product->title)) }}
                                                                </h6>
                                                            </a>
                                                            <h5 class="sold text-content">
                                                                @if ($product->offer_rate === null)
                                                                <span class="theme-color price">
                                                                    Price not available
                                                                </span>
                                                                @else
                                                                @php
                                                                $final_offer_rate = $product->offer_rate;
                                                                if($groupCategory){
                                                                $group_categoty_percentage = (float) ($groupCategory->groupCategory->group_category_percentage ?? 0);
                                                                if ($group_categoty_percentage > 0) {
                                                                $purchase_rate = $product->purchase_rate;
                                                                $offer_rate = $product->offer_rate;
                                                                $percent_discount = 100 / $group_categoty_percentage;
                                                                $final_offer_rate = $purchase_rate + ($offer_rate - $purchase_rate) * $percent_discount / 100;
                                                                $final_offer_rate = floor($final_offer_rate);
                                                                }
                                                                }
                                                                @endphp
                                                                <span class="theme-color">Rs. {{$final_offer_rate}}</span>
                                                                @endif
                                                                @if ($product->mrp !== null)
                                                                <del>Rs. {{ $product->mrp }}</del>
                                                                @endif
                                                            </h5>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                        @endif

                                    </div>
                                    @endif
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endif
            </div>

        </div>
    </div>
</section>
@endsection
@push('scripts')

@endpush