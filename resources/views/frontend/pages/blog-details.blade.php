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
                    Blog Details
                </span>
            </li>
        </ul>
    </div>
</div>

@endsection
@push('scripts')

@endpush