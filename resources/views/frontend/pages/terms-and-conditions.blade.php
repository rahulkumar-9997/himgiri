@extends('frontend.layouts.master')
@section('title','Himgiri - Terms & Conditions')
@section('description', 'Best Kitchen Retail Store in Varanasi now goes Online')
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
                <span class="text">Terms & Conditions</span>
            </li>
        </ul>
    </div>
</div>

<section class="flat-spacing-3 privacypolicy">
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-lg-8">
                <div class="privacy-policy-container">
                    <div class="policy-container">
                        <div class="policy-header">
                            <h1 class="mb-2">Terms & Conditions</h1>
                            <p class="text-muted"><strong>Effective Date:</strong> 29/04/2025</p>
                        </div>
                        <p class="highlight">
                            Welcome to <strong>Himgiri Coolers and Almirah</strong>(“we,” “our,” “us”). These Terms & Conditions govern your use of our website <a href="{{ url('/') }}" target="_blank">www.himgiricooler.com</a> and the purchase of products from our online store. You agree to comply with and be bound by these terms by accessing or using our website.
                            
                        </p>

                        <div class="main-privacy mt-3">
                            <div class="mb-3">
                                <h2>Use of the Website</h2>
                                <ul class="custom-list">
                                    <li>
                                        You must be at least 18 years old or accessing the site under the supervision of a legal guardian.
                                    </li>
                                    <li>
                                        You agree not to misuse the website or violate any applicable laws.
                                    </li>
                                    <li>
                                        All information provided by you must be accurate, current, and complete.
                                    </li>
                                    
                                </ul>
                            </div>
                            <div class="mb-3">
                                <h2>Product Information</h2>
                                <ul class="custom-list">
                                    <li>
                                        We strive to display accurate product descriptions, images, and pricing. However, minor variations may occur due to manufacturing differences or screen resolution.
                                    </li>
                                    <li>
                                        Prices are subject to change without notice.
                                    </li>
                                    
                                </ul>
                            </div>
                            <div class="mb-3">
                                <h2>Orders and Payments</h2>
                                <ul class="custom-list">
                                    <li>
                                        All orders are subject to acceptance and availability.
                                    </li>
                                    <li>
                                        Payments must be made through the approved secure payment methods available on the site.
                                    </li>
                                    <li>
                                        We reserve the right to cancel or refuse any order for any reason, including stock unavailability or errors in pricing/information.
                                    </li>
                                </ul>
                            </div>
                            <div class="mb-3">
                                <h2>Shipping & Delivery</h2>
                                <ul class="custom-list">
                                    <li>
                                        Delivery timelines are estimated and may vary due to logistics or external factors.
                                    </li>
                                    <li>
                                        Shipping charges, if any, will be displayed at checkout.
                                    </li>
                                    <li>
                                        Please inspect the product at delivery. Any damage must be reported immediately.
                                    </li>
                                </ul>
                                
                            </div>
                            <div class="mb-3">
                                <h2>Returns & Refunds</h2>
                                <ul class="custom-list">
                                    <li>
                                        Please refer to our [Return Policy] for details on eligibility, timelines, and procedures.
                                    </li>
                                    <li>
                                        Please refer to our [Return Policy] for details on eligibility, timelines, and procedures.
                                    </li>
                                    <li>
                                        Refunds will be processed to the original payment method within a reasonable time.
                                    </li>
                                </ul>
                            </div>
                            <div class="mb-3">
                                <h2>Intellectual Property</h2>
                                <ul class="custom-list">
                                    <li>
                                        All content on the website including logos, images, designs, and text is the property of Himgiri Coolers and Almirah and protected by copyright laws.
                                    </li>
                                    <li>
                                        You may not reproduce, distribute, or commercially use any content without our written permission.
                                    </li>
                                    
                                </ul>
                            </div>
                            
                            <div class="mb-3">
                                <h2>Limitation of Liability</h2>
                                <ul class="custom-list">
                                    <li>
                                        We are not liable for any indirect, incidental, or consequential damages arising from the use of our website or products.
                                    </li>
                                    <li>
                                        We are not responsible for delays or failures due to circumstances beyond our control (e.g., natural disasters, strikes, pandemics).
                                    </li>
                                    
                                </ul>
                            </div>
                            <div class="mb-3">
                                <h2>Privacy</h2>
                                <p>
                                    Your use of the website is also governed by our [Privacy Policy].
                                </p>
                            </div>
                            <div class="mb-3">
                                <h2>Modifications</h2>
                                <p>
                                    We reserve the right to update or modify these Terms & Conditions at any time. Updates will be posted on this page with a new effective date.
                                </p>
                            </div>
                            <div class="mb-3">
                                <h2>Governing Law</h2>
                                <p>
                                    These Terms are governed by and construed in accordance with the laws of <strong>India.</strong> Any disputes shall be subject to the jurisdiction of courts in <strong>Mau, Uttar Pradesh.</strong>
                                </p>
                            </div>
                            <div class="mb-3">
                                <h2>Contact Us</h2>
                                <p>
                                    For questions or concerns about these Terms & Conditions, please contact:
                                </p>
                                <address class="p-address">
                                    <h3 class="mb-2">Himgiri Coolers and Almirah</h3>
                                    <h4 class="mb-2">Industrial Estate, D 5 & 6, Munshi Pura,
                                        <br>
                                    Mau, Uttar Pradesh 275101
                                    </h4>
                                    <h4>
                                        <p>
                                            <strong>Email:</strong>
                                            <a href="mailto:info@himgiricooler.com">info@himgiricooler.com</a>
                                        </p>
                                        
                                    </h4>
                                </address>
                            </div>
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