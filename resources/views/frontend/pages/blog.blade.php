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

<section class="s-blog-grid-v2 sec-blog blog-top-section">
    <div class="container">
        <div class="row justify-content-md-center">
            @if($blogs->isNotEmpty())
            @php
                $colors = [
                '#FF5733', '#a1521b', '#FF69B4',
                '#8A2BE2', '#efab49', '#00CED1', '#DC143C',
                '#4682B4', '#FF8C00', '#8B008B', '#2E8B57'
                ];
            @endphp
            <div class="col-lg-10">
                <div class="s-blog-list-grid grid-2">
                    @foreach ($blogs as $index =>$blog)
                    <div class="blog-item hover-img">
                        <div class="entry_image">
                            <a href="{{ route('blog.details', ['slug' => $blog->slug]) }}" class="img-style" style="background-color: {{ $colors[$index % count($colors)] }};">
                            @if(!empty($blog->blog_image) && file_exists(public_path($blog->blog_image)))
                                <img src="{{ asset($blog->blog_image) }}"
                                    data-src="{{ asset($blog->blog_image) }}"
                                    alt="{{ $blog->title }}"
                                    class="lazyloaded" loading="lazy">
                            @else
                                <img src="{{ asset('images/default-blog.jpg') }}" alt="Default image" class="lazyloaded">
                            @endif

                            </a>
                        </div>
                        <div class="blog-content">
                            <a href="{{ route('blog.details', ['slug' => $blog->slug]) }}"
                                class="entry_title d-block text-xl fw-medium link">
                                {{ \Illuminate\Support\Str::limit($blog->title, 50) }}
                            </a>
                            <p class="entry_sub text-md text-main">
                                {{ \Illuminate\Support\Str::limit(strip_tags($blog->bog_description), 100) }}
                            </p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @else
            <div class="col-lg-10">
                <p class="text-center">No blogs available.</p>
            </div>
            @endif

        </div>
    </div>
</section>
@endsection
@push('scripts')

@endpush