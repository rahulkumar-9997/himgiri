@php
    $urlPath = Request::path();
    $segments = explode('/', $urlPath);
    $lastSegment = end($segments);
    $bgColors = ['#f5f5f5', '#fff3d9', '#f4e7fb', '#f4dcdc'];
    $defaultImage = asset('frontend/assets/himgiri-img/logo/1.png');
@endphp

@foreach ($products as $index => $product)
    @php
        $firstImage = $product->images->get(0)?->image_path;
        $secondImage = $product->images->get(1)?->image_path;
        $image1 = $firstImage ? asset('images/product/thumb/' . $firstImage) : $defaultImage;
        $image2 = $secondImage ? asset('images/product/thumb/' . $secondImage) : $defaultImage;
    @endphp

    <div class="card-product grid card-product-size">
        <div class="card-product-wrapper" style="background-color: {{ $bgColors[$index % count($bgColors)] }}; padding:10px;">
            <a href="{{ route('products', [
                'product_slug' => $product['slug'],
                'attributes_value_slug' => $lastSegment
            ]) }}"
            class="product-img">
                <img class="img-product lazyload" data-src="{{ $image1 }}" src="{{ $image1 }}" alt="{{ $product->title ?? 'No Title' }}" loading="lazy">
                <!--<img class="img-hover lazyload" data-src="{{ $image2 }}" src="{{ $image2 }}" alt="{{ $product->title ?? 'No Title' }}" loading="lazy">-->
            </a>
            <!--<div class="on-sale-wrap">
                <span class="on-sale-item">20% Off</span>
            </div>-->
            <!--<ul class="list-product-btn">
                <li>
                    <a href="#shoppingCart" data-bs-toggle="offcanvas" class="hover-tooltip tooltip-left box-icon">
                        <span class="icon icon-cart2"></span>
                        <span class="tooltip">Add to Cart</span>
                    </a>
                </li>
                <li class="wishlist">
                    <a href="javascript:void(0);" class="hover-tooltip tooltip-left box-icon">
                        <span class="icon icon-heart2"></span>
                        <span class="tooltip">Add to Wishlist</span>
                    </a>
                </li>
                <li>
                    <a href="#quickView" data-bs-toggle="modal" class="hover-tooltip tooltip-left box-icon quickview">
                        <span class="icon icon-view"></span>
                        <span class="tooltip">Quick View</span>
                    </a>
                </li>
                <li class="compare">
                    <a href="#compare" data-bs-toggle="modal" aria-controls="compare" class="hover-tooltip tooltip-left box-icon">
                        <span class="icon icon-compare"></span>
                        <span class="tooltip">Add to Compare</span>
                    </a>
                </li>
            </ul>-->
        </div>
        <div class="card-product-info">
            <a href="{{ route('products', [
                'product_slug' => $product['slug'],
                'attributes_value_slug' => $lastSegment
            ]) }}" class="name-product link fw-medium text-md">
                {{ $product->title ?? 'No Title' }}
            </a>
            @if($product->offer_rate)
            <p class="price-wrap fw-medium">
                <span class="price-new text-primary">Rs. {{ $product->offer_rate ?? '0.00' }}</span>
                <span class="price-old">Rs. {{ $product->mrp ?? '0.00' }}</span>
            </p>
            @else
            <p class="price-wrap fw-medium">
                <span class="price-new text-primary">Price Not Available .</span>
            </p>
            @endif
        </div>
    </div>
@endforeach
