@php
    $bgColors = ['#f5f5f5', '#fff3d9', '#f4e7fb', '#f4dcdc'];
    $defaultImage = asset('frontend/assets/himgiri-img/logo/1.png');
@endphp
@foreach ($products as $index => $product)
    @php
        $firstImage = $product->images->get(0)?->image_path;
        $secondImage = $product->images->get(1)?->image_path;
        $image1 = $firstImage ? asset('images/product/thumb/' . $firstImage) : $defaultImage;
        $image2 = $secondImage ? asset('images/product/thumb/' . $secondImage) : $defaultImage;
        $attributes_value ='na';
        if($product->ProductAttributesValues->isNotEmpty()){
            $attributes_value = $product->ProductAttributesValues->first()->attributeValue->slug;
        }
    @endphp
    <div class="card-product grid card-product-size">
        <div class="card-product-wrapper"  style="background-color: {{ $bgColors[$index % count($bgColors)] }}; padding:10px;">
            <a href="{{ route('products', [
                'product_slug' => $product->slug,
                'attributes_value_slug' => $attributes_value
            ]) }}" class="product-img">
                <img class="img-product ls-is-cached lazyloaded" data-src="{{ $image1 }}" src="{{ $image1 }}" alt="{{ $product->title }}">
                <img class="img-hover ls-is-cached lazyloaded" data-src="{{ $image2 }}" src="{{ $image2 }}" alt="{{ $product->title }}">
            </a>
        </div>
        <div class="card-product-info">
            <a href="{{ route('products', [
                'product_slug' => $product->slug,
                'attributes_value_slug' => $attributes_value
            ]) }}" class="name-product link fw-medium text-md">
                {{ $product->title }}
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