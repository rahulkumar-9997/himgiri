@extends('frontend.layouts.master')
@section('title','Himgiri : Blog')
@section('description', 'Best Coolrs Store in Varanasi now goes Online')
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
                    Blog
                </span>
            </li>
        </ul>
    </div>
</div>
<section class="s-blog-grid-v2 sec-blog">
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-lg-10">
                <div class="s-blog-list-grid grid-2">
                    <div class="blog-item hover-img">
                        <div class="entry_image">
                            <a href="{{ route('blog.details', ['slug' => 'slug1']) }}" class="img-style">
                                <img src="images/blog/blog-1.jpg" data-src="images/blog/blog-1.jpg" alt="" class=" ls-is-cached lazyloaded">
                            </a>
                        </div>
                        <div class="blog-content">
                            
                            <a href="{{ route('blog.details', ['slug' => 'slug1']) }}" class="entry_title d-block text-xl fw-medium link">
                                5 Timeless Wardrobe Essentials Every Wo...
                            </a>
                            <p class="entry_sub text-md text-main">
                                When it comes to fashion, trends come and go, but there are certain pieces
                                that stand...
                            </p>
                            
                        </div>
                    </div>
                    <div class="blog-item hover-img">
                        <div class="entry_image">
                            <a href="{{ route('blog.details', ['slug' => 'slug1']) }}" class="img-style">
                                <img src="images/blog/blog-2.jpg" data-src="images/blog/blog-2.jpg" alt="" class=" ls-is-cached lazyloaded">
                            </a>
                        </div>
                        <div class="blog-content">
                            
                            <a href="{{ route('blog.details', ['slug' => 'slug1']) }}" class="entry_title d-block text-xl fw-medium link">
                                5 Style Staples Every Woman Needs
                            </a>
                            <p class="entry_sub text-md text-main">
                                Trends come and go, but timeless pieces are always in style and easy to wear
                            </p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
@endsection
@push('scripts')

@endpush