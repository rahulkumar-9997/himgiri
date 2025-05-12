@extends('frontend.layouts.master')
@section('title','Himgiri : Customer Care')
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
                <span class="text">Customer Care</span>
            </li>
        </ul>
    </div>
</div>
<!-- /Breadcrumb -->
<section class="contact-us-box section_space">
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-lg-8">
                <div class="con-form-section">
                    <div class="form-contact-wrap">

                        <form action="{{ route('customer-care.store') }}" accept="multipart/form-data" method="post" class="form-default" id="customerCare">
                            @csrf
                            <div class="wrap">
                                <div class="cols">
                                    <fieldset>
                                        <label for="category">Select Category *</label>
                                        @if($category->isNotEmpty())
                                        <div class="tf-select select-square ">
                                            <select name="category" id="category" class="form-control">
                                                <option value="">Select Category </option>
                                                @foreach ($category as $categoryRow)
                                                <option value="{{ $categoryRow->id }}">{{ $categoryRow->title }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @endif
                                    </fieldset>
                                    <fieldset>
                                        <label>In Warranty *</label>
                                        <div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" value="Yes" id="in_warranty" name="in_warranty" checked="">
                                                <label class="form-check-label" for="in_warranty">
                                                    Yes
                                                </label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" value="No" id="in_warranty" name="in_warranty">
                                                <label class="form-check-label" for="in_warranty">
                                                    No
                                                </label>
                                            </div>
                                        </div>
                                    </fieldset>
                                </div>
                                <div class="cols">
                                    <fieldset>
                                        <label for="model">Select Model *</label>
                                        <div class="tf-select select-square">
                                            <select name="model" id="model" class="form-control">
                                                
                                            </select>
                                        </div>
                                    </fieldset>
                                    <fieldset>
                                        <label for="problem_type">Problem Type *</label>
                                        <div class="tf-select select-square">
                                            <select name="problem_type" id="problem_type" class="form-control">
                                                <option value="">Select Problem Type</option>
                                                <option value="Pump Problem">Pump Problem</option>
                                                <option value="Motor Problem">Motor Problem</option>
                                                <option value="Connection Problem">Connection Problem</option>
                                                <option value="Body Problem">Body Problem</option>
                                                <option value="Any other problem">Any other problem</option>
                                            </select>
                                        </div>
                                    </fieldset>
                                </div>
                                <div class="cols">
                                    <fieldset>
                                        <label for="name">Name *</label>
                                        <input id="name" class="radius-8 form-control" type="text" name="name">
                                    </fieldset>
                                    <fieldset>
                                        <label for="email">Your email</label>
                                        <input id="email" class="radius-8 form-control" type="email" name="email">
                                    </fieldset>
                                </div>
                                <div class="cols">
                                    <fieldset>
                                        <label for="phone_number">Phone No.*</label>
                                        <input id="phone_number" class="radius-8 form-control" type="text" name="phone_number" maxlength="10">
                                    </fieldset>
                                    <fieldset>
                                        <label for="product_image">Product Image *</label>
                                        <input id="product_image" class="radius-8 form-control" type="file" name="product_image">
                                    </fieldset>
                                    <fieldset>
                                        <label for="invoice_image">Upload Invoice Image (Optional)</label>
                                        <input id="invoice_image" class="radius-8 form-control" type="file" name="invoice_image">
                                    </fieldset>
                                </div>
                                <div class="cols">
                                    <fieldset class="textarea">
                                        <label for="mess">Message</label>
                                        <textarea id="mess" class="radius-8 form-control" cols="60" name="message" rows="3"></textarea>
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
<script>
    $(document).ready(function () {
        $('#category').on('change', function () {
            var category_id = $(this).val();
            if (category_id) {
                $.ajax({
                    url: "{{ route('get.models.by.category') }}",
                    type: "post",
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        category_id: category_id
                    },
                    success: function (data) {
                        $('#model').empty().append('<option value="">Select Model</option>');

                        if (data.length > 0) {
                            $.each(data, function (key, value) {
                                $('#model').append('<option value="' + value.name + '">' + value.name + '</option>');
                            });
                        }
                        $('#model').append('<option value="Any Other Model"  style="font-size: 16px;">Any Other Model</option>');
                    }
                });
            } else {
                $('#model').empty().append('<option value="">Select Model</option>');
            }
        });
    });
</script>
@endpush