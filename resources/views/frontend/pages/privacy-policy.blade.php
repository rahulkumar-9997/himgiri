@extends('frontend.layouts.master')
@section('title','Himgiri - Privacy Policy')
@section('description', 'Welcome to Himgiri Coolers and Almirah. We value the trust you place in us and are committed to protecting your privacy.')
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
                <span class="text">Privacy Policy</span>
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
                            <h1 class="mb-2">Privacy Policy</h1>
                            <p class="text-muted"><strong>Effective Date:</strong> 29/04/2025</p>
                        </div>
                        <p class="highlight">
                            Welcome to <strong>Himgiri Coolers and Almirah.</strong> We value the trust you place in us and are committed to protecting your privacy. This Privacy Policy explains how we collect, use, disclose, and safeguard your personal information when you visit our website <a href="{{ url('/') }}" target="_blank">www.himgiricooler.com</a> or contact us via email at
                            <a href="mailto:info@himgiricooler.com">info@himgiricooler.com</a>
                            
                        </p>

                        <div class="main-privacy mt-3">
                            <div class="mb-3">
                                <h2>Information We Collect</h2>
                                <ul class="custom-list">
                                    <li><strong>Personal Information:</strong> Name, address, phone number, email address, payment information.</li>
                                    <li><strong>Order Information:</strong> Products purchased, payment method, billing and shipping address.</li>
                                    <li><strong>Device Information:</strong> IP address, browser type, time zone, pages visited, cookies.</li>
                                    <li><strong>Communication Information:</strong> Emails, messages, or communication you send to us.</li>
                                </ul>
                            </div>
                            <div class="mb-3">
                                <h2>How We Use Your Information</h2>
                                <ul class="custom-list">
                                    <li>Process and fulfill your orders.</li>
                                    <li>Communicate with you about your purchase, shipping, and support requests.</li>
                                    <li>Improve our website, services, and product offerings.</li>
                                    <li>Prevent fraudulent transactions and protect against unauthorized activity.</li>
                                    <li>Send updates, offers, and promotions (if you opt in).</li>
                                </ul>
                            </div>
                            <div class="mb-3">
                                <h2>Sharing Your Information</h2>
                                <p>We do not sell or rent your information. We may share it with:</p>
                                <ul class="custom-list">
                                    <li><strong>Service Providers:</strong> For payment processing, shipping, and analytics.</li>
                                    <li><strong>Legal Authorities:</strong> If required by law or regulation.</li>
                                </ul>
                            </div>
                            <div class="mb-3">
                                <h2>Cookies</h2>
                                <p>Our website uses cookies to enhance your shopping experience. You can control cookie preferences through your browser settings.</p>
                                
                            </div>
                            <div class="mb-3">
                                <h2> Your Rights</h2>
                                <p>You have the right to:</p>
                                <ul class="custom-list">
                                    <li>Access or update your personal information.</li>
                                    <li>Withdraw consent for marketing communications</li>
                                    <li>Request deletion of your data (subject to legal obligations)</li>
                                </ul>
                                <p>To exercise these rights, contact us at: <a href="mailto:info@himgiricooler.com">info@himgiricooler.com.</a></p>
                            </div>
                            <div class="mb-3">
                                <h2>Data Security</h2>
                                <p>
                                    We implement appropriate technical and organizational measures to protect your data. Sensitive information (like payment details) is encrypted and handled through secure gateways.
                                </p>
                            </div>
                            
                            <div class="mb-3">
                                <h2>Changes to This Policy</h2>
                                <p>We may update this Privacy Policy from time to time. The revised version will be posted on our website with the updated date.</p>
                            </div>
                            <div class="mb-3">
                                <h2>Contact Us</h2>
                                <p>
                                If you have any questions or concerns about this Privacy Policy or your personal information, please contact:
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