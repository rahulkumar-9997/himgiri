@extends('frontend.layouts.master')
@section('title','Himgiri : Contact us')
@section('description', 'Industrial Estate, D 5 & 6, Munshi Pura, Mau, Uttar Pradesh 275101')
<!-- @section('keywords', 'Best Kitchen Retail Store in Varanasi now goes Online') -->
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
                <span class="text">Contact Us</span>
            </li>
        </ul>
    </div>
</div>
<!-- /Breadcrumb -->
<section class="contact-us-box section_space">
    <div class="container">
        <div class="contact-us-page">
            <div class="contact_info_box row mt-none-30">
                <div class="col-lg-4 col-md-4 col-sm-4 mt-30">
                    <div class="contact_iconbox">
                        <div class="iconbox_icon box-icon">
                            <i class="icon icon-phone"></i>
                        </div>
                        <div class="iconbox_content">
                            <h2 class="iconbox_title">Call Us On</h2>
                            <!-- <p>
                                Mon-Fri from 8am to 5pm
                            </p> -->
                            <a href="tel:+918048740318">+91 8048740318</a>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-4 col-sm-4 mt-30">
                    <div class="contact_iconbox">
                        <div class="iconbox_icon box-icon">
                            <i class="icon icon-mail"></i>
                        </div>
                        <div class="iconbox_content">
                            <h2 class="iconbox_title">Email Us</h2>
                           
                            <a href="mailto:info@himgiricoolers.com">
                                info@himgiricooler.com
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 mt-30">
                    <div class="contact_iconbox">
                        <div class="iconbox_icon box-icon">
                            <i class="icon icon-location"></i>
                        </div>
                        <div class="iconbox_content">
                            <h2 class="iconbox_title">Our Location</h2>
                            
                            <a>Industrial Estate, D 5 & 6, Munshi Pura, Mau, <br>Uttar Pradesh 275101</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row contact-area">
            <div class="col-lg-6 d-flex align-items-center">
                <div class="map-section">
                    <div class="google-map-area w-100">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3588.3865243739792!2d83.5610756!3d25.9225304!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39918ae8328c6e67%3A0xc36a0453d5ece215!2sHimgiri%20Coolers!5e0!3m2!1sen!2sin!4v1745651752295!5m2!1sen!2sin" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="con-form-section">
                    <div class="form-contact-wrap">
                        <form  action="{{ route('contact-us.store') }}" accept="multipart/form-data" method="post" class="form-default" id="enquiryForm">
                            @csrf
                            <div class="wrap">
                                <div class="cols">
                                    <fieldset>
                                        <label for="username">Your name*</label>
                                        <input id="name" class="radius-8" type="text" name="name">
                                    </fieldset>
                                    <fieldset>
                                        <label for="email">Your phone no.*</label>
                                        <input id="phone_number" class="radius-8" type="text" name="phone_number" maxlength="10">
                                    </fieldset>
                                </div>
                                <div class="cols">
                                    <fieldset>
                                        <label for="email">Your email</label>
                                        <input id="email" class="radius-8" type="email" name="email">
                                    </fieldset>
                                </div>
                                <div class="cols">
                                    <fieldset class="textarea">
                                        <label for="mess">Message</label>
                                        <textarea id="mess" class="radius-8" cols="60" name="message" rows="3"></textarea>
                                    </fieldset>
                                </div>
                                <div class="button-submit">
                                    <button class="tf-btn animate-btn" type="submit">
                                        Submit
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@push('scripts')

@endpush