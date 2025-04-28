@extends('frontend.layouts.master')
@section('title', 'Himgiri ' . $category->title . ' ' . $attributeValue->name . ' in Varanasi.')
@section('description', 'Himgiri - ' . $category->title . ' : ' . $attributeValue->name)
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
                <span class="text">{{ $attributeValue->name }}</span>
            </li>
        </ul>
    </div>
</div>
<!-- /Breadcrumb -->
<!-- Section Product -->
<section class="flat-spacing-2 pt-0 collections-page">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="h1-heading">
                    <h1>
                        {{ $attributeValue->name }} {{ $category->title }} 
                    </h1>
                </div>
            </div>
        </div>
        <div class="row" id="product-catalog-frontend">
            @include('frontend.pages.ajax-product-catalog', [$products, $attributes_with_values_for_filter_list])
        </div>
    </div>
</section>
@endsection
@push('scripts')
<script>
    $(document).ready(function() {
        const filters = {};
        let currentPage = 1;
        $(document).on('change', '.filter-checkbox', function() {
            const attributeSlug = $(this).data('attslug');
            const valueSlug = $(this).data('attvslug');
            if (!filters[attributeSlug]) {
                filters[attributeSlug] = [];
            }
            if ($(this).is(':checked')) {
                if (!filters[attributeSlug].includes(valueSlug)) {
                    filters[attributeSlug].push(valueSlug);
                }
            } else {
                filters[attributeSlug] = filters[attributeSlug].filter((slug) => slug !== valueSlug);
                if (filters[attributeSlug].length === 0) {
                    delete filters[attributeSlug];
                }
            }
            updateURL();
        });

        /*Remove individual filters*/
        $(document).on('click', '.remove-filter', function() {
            const attributeSlug = $(this).data('att-slug');
            const valueSlug = $(this).data('value-slug');
            if (filters[attributeSlug]) {
                filters[attributeSlug] = filters[attributeSlug].filter((slug) => slug !== valueSlug);
                if (filters[attributeSlug].length === 0) {
                    delete filters[attributeSlug];
                }
            }
            $(`.filter-checkbox[data-attslug="${attributeSlug}"][data-attvslug="${valueSlug}"]`).prop('checked', false);
            updateURL();
        });

        /*Clear all filters*/
        $(document).on('click', '#clear-filters', function() {
            for (let key in filters) {
                delete filters[key];
            }
            $('.filter-checkbox').prop('checked', false);
            const url = '{{ route("collections", [$category->slug, $attributeValue->slug]) }}';
            window.history.replaceState({}, '', url);
            fetchFilteredProducts(url, false); // Reset products
        });

        /* Handle sorting*/
        $(document).on('click', '.dropdown-menu .select-item', function() {
            const sortId = $(this).data('sortid');
            let urlParams = new URLSearchParams(window.location.search);

            if (sortId) {
                urlParams.set('sort', sortId);
            } else {
                urlParams.delete('sort');
            }
            const newUrl = window.location.pathname + '?' + urlParams.toString();
            showLoader();
            window.history.replaceState({}, '', newUrl);
            fetchFilteredProducts(newUrl, false);
        });

        // Handle Load More functionality
        // $(document).on('click', '#load-more', function() {
        //     currentPage++;
        //     let baseUrl = window.location.href.split('?')[0];
        //     let queryParams = new URLSearchParams(window.location.search);
        //     queryParams.set('page', currentPage);
        //     let url = `${baseUrl}?${queryParams.toString()}`;
        //     fetchFilteredProducts(url, true);
        // });
        // Handle Load More functionality
        $(document).on('click', '#load-more', function() {
            currentPage++;
            let baseUrl = window.location.href.split('?')[0];
            let queryParams = new URLSearchParams(window.location.search);
            queryParams.set('page', currentPage);
            queryParams.set('load_more', true); // Add load_more parameter
            let url = `${baseUrl}?${queryParams.toString()}`;
            fetchFilteredProducts(url, true);
        });


        /*Function to update the URL based on filters*/
        function updateURL() {
            const filterParams = [];
            $.each(filters, function(attributeSlug, valueSlugs) {
                filterParams.push(attributeSlug + '=' + valueSlugs.join(','));
            });

            let queryString = filterParams.join('&');
            let urlParams = new URLSearchParams(window.location.search);
            const sortParam = urlParams.get('sort');
            if (sortParam) {
                queryString += (queryString ? '&' : '') + 'sort=' + sortParam;
            }

            let url = '{{ route("collections", [$category->slug, $attributeValue->slug]) }}';
            if (queryString) url += '?' + queryString;
            window.history.replaceState({}, '', url);
            fetchFilteredProducts(url, false);
        }

        /*Function to fetch filtered or sorted products via AJAX*/
        function fetchFilteredProducts(url, append = false) {
            $.ajax({
                url: url,
                method: 'GET',
                beforeSend: function() {
                    showLoader();
                },
                success: function(response) {
                    // alert(response.hasMore);
                    if (append) {
                        $('#load-more-append').append(response.products);
                    } else {
                        $('#product-catalog-frontend').html(response.products);
                        currentPage = 1;
                    }
                    if (!response.hasMore) {
                        $('#load-more').hide();
                    } else {
                        $('#load-more').show();
                    }
                    hideLoader();
                },
                error: function(xhr) {
                    console.error('Error fetching products:', xhr.responseText);
                    hideLoader();
                }
            });
        }

        /*Show loader*/
        function showLoader() {
            $('#loader').show();
        }

        /*Hide loader*/
        function hideLoader() {
            $('#loader').hide();
        }
    });
    function updateCounter(counterType) {
        $.ajax({
            url: "{{ route('update.counter') }}",
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                counter_type: counterType
            },
            success: function(response) {
                console.log(response.message);
            }
        });
    }
</script>
@endpush