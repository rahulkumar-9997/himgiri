@extends('frontend.layouts.master')
@section('title', ($query ?? 'Search'))
@section('description', 'GD Sons - ' . ($query ?? 'Search'))
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
                    {{$query ?? 'Search'}}
                </span>
            </li>
        </ul>
    </div>
</div>
<section class="flat-spacing-2 pt-0">
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
                        @if (isset($categories) && $categories->isNotEmpty())
                            <div class="widget-facet">
                                <div class="facet-title text-xl fw-medium" data-bs-target="#availability" role="button" data-bs-toggle="collapse" aria-expanded="true" aria-controls="availability">
                                    <span>Category</span>
                                    <span class="icon icon-arrow-up"></span>
                                </div>
                                <div id="availability" class="collapse show">
                                    <ul class="collapse-body filter-group-check current-scrollbar">
                                        @foreach($categories as $category)
                                            <li class="list-item">
                                                <input
                                                type="checkbox"
                                                name="availability"
                                                class="tf-check checkbox_animated filter-checkbox"
                                                data-category-id="{{ $category->id }}"
                                                value="{{ $category->id }}"
                                                id="check_category_{{ $category->id }}"
                                                @if(in_array($category->id, explode(',', request()->query('category', '')))) checked @endif 
                                                >
                                                <label for="inStock" class="label">
                                                    <span>{{ $category->title }}</span>
                                                </label>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-9">
                <div class="tf-shop-control">
                    <div class="tf-group-filter">
                        <h1 class="titleh1">
                            You search on <span>{{$query ?? 'Search'}}</span>
                        </h1>
                    </div>                    
                </div>
                @if (isset($products) && $products->isNotEmpty())
                    <div class="wrapper-control-shop gridLayout-wrapper">
                        <div class="wrapper-shop tf-grid-layout tf-col-4" id="search-catalog-frontend">
                            @include('frontend.pages.partials.ajax-search-catalog', [$products])
                        </div>
                    </div>
                @else
                    <p>No products found on your search query !.</p>
                @endif
            </div>
        </div>
    </div>
</section>
@endsection
@push('scripts')
<script src="{{asset('frontend/assets/js/pages/search-catalog-filter.js')}}"></script>
@endpush