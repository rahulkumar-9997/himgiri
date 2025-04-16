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
                <a href="" class="text">Home</a>
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
        <div class="row justify-content-lg-between mt-none-30">
            <div class="contact_info_box row mt-none-30">
                <div class="col-lg-3 col-md-6 col-sm-6 mt-30">
                    <div class="contact_iconbox">
                        <div class="iconbox_icon box-icon">
                            <i class="icon icon-phone"></i>
                        </div>
                        <div class="iconbox_content">
                            <h2 class="iconbox_title">Call Us On</h2>
                            <p>
                                Mon-Fri from 8am to 5pm
                            </p>
                            <a href="tel:+919900000000">+91 0000000000</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 mt-30">
                    <div class="contact_iconbox">
                        <div class="iconbox_icon box-icon">
                            <i class="icon icon-phone"></i>
                        </div>
                        <div class="iconbox_content">
                            <h2 class="iconbox_title">Call Us On</h2>
                            <p>
                                Mon-Fri from 8am to 5pm
                            </p>
                            <a href="tel:+919900000000">+91 0000000000</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 mt-30">
                    <div class="contact_iconbox">
                        <div class="iconbox_icon box-icon">
                            <i class="icon icon-mail"></i>
                        </div>
                        <div class="iconbox_content">
                            <h2 class="iconbox_title">Email Us</h2>
                            <p>
                                Speak to our Friendly team.
                            </p>
                            <a href="mailto:info@himgiricoolers.com">
                                info@himgiricooler.com
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 mt-30">
                    <div class="contact_iconbox">
                        <div class="iconbox_icon box-icon">
                            <i class="icon icon-location"></i>
                        </div>
                        <div class="iconbox_content">
                            <h2 class="iconbox_title">Our Location</h2>
                            <p>
                                Visit our shop.
                            </p>
                            <a> #33-01, 77 Sigara Road</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-lg-between contact-area">
            <div class="col-lg-6">
                <div class="map-section">
                    <div class="google-map-area w-100">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d133366.30176332663!2d82.9617778087673!3d25.294305536048245!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x398e2d3ef62a58df%3A0x2b13c40c2d0470b0!2sSanskar%20Sarees!5e0!3m2!1sen!2sin!4v1622203244985!5m2!1sen!2sin" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="con-form-section">
                    <div class="form-contact-wrap">
                        <form action="#" class="form-default">
                            <div class="wrap">
                                <div class="cols">
                                    <fieldset>
                                        <label for="username">Your name*</label>
                                        <input id="username" class="radius-8" type="text" name="username" required="">
                                    </fieldset>
                                    <fieldset>
                                        <label for="email">Your email*</label>
                                        <input id="email" class="radius-8" type="email" name="email" required="">
                                    </fieldset>
                                </div>
                                <div class="cols">
                                    <fieldset class="textarea">
                                        <label for="mess">Message*</label>
                                        <textarea id="mess" class="radius-8" required="" cols="60" rows="5"></textarea>
                                    </fieldset>
                                </div>
                                <div class="button-submit">
                                    <button class="tf-btn animate-btn" type="submit">
                                        Send
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